<?php

namespace App\Http\Livewire;

use App\Events\AddCreditTransactionEvent;
use App\Events\AddWithdrawTransactionEvent;
use App\Models\Reply;
use Carbon\Carbon;
use Livewire\Component;
use App\Notifications\SendTradeEndCode;
use App\Notifications\TradeEnded;
use TransactionsBalance;


class ReplyCode extends Component
{

    public $reply;
    public $code;
    public $status;
    public $dcode;

    protected $rules = [
        'code' => 'required|integer|between:1,10',
    ];

    public function render()
    {
        return view('livewire.reply-code');
    }

    public function checkCode()
    {
        // Plutot que grisé le bouton j'ai fais une validation pour guider au mieux l'user
        $data = $this->validate(
            [
                'code' => ['required', 'integer', 'between:1000,9999'],
            ],
            [
                'code.required' => 'Ce champ doit être completé avec le code 4 chiffres',
                'code.integer' => 'Verifier que vous avez bien saisi des entiers (sans virgule ni espace)',
                'code.between' => 'Verifier que vous avez bien saisi 4 chiffres'
            ]
        );

        // Entre si la 1ere étape de la transaction n'est pas terminé => saisie du 1er code
        if ($this->reply->started_at === null){
            // Incremente le compteur
            $this->reply->increment('starting_code_count');

            if (intval($data['code']) === intval($this->reply->starting_code)) {
                $this->reply->update(['started_at' => Carbon::now()]);
                if (TransactionsBalance::verify_user_balance($this->reply->offer->price, $this->reply->user->kips)){

                    // On appel l'évènement pour prélever les kips
                    event(new AddWithdrawTransactionEvent($this->reply));

                    // Envoie du mail pour la fin de la transaction après la validation du premier code
                    auth()->user()->notify(new SendTradeEndCode($this->reply, auth()->user(), $this->reply->ending_code));

                    return redirect()->route('reply.show', $this->reply->id)->with('success', "Le début de l'échange a bien été enregistré !");
                } else {
                    return redirect()->route('reply.show', $this->reply->id)->with('danger', "Vous n'avez pas assez de kips pour cet échange :(");
                }

            }

            // Code non valide
            // On vide le champs pour limiter les erreurs de frappe et multisend
            $this->code = '';
            // Si 3 code invalide on delete la transaction, informe les 2 partie que la transaction est terminé
            if ($this->reply->starting_code_count == 3) {
                $this->reply->user->notify(new TradeEnded($this->reply, auth()->user(), $this->reply->offer->user));
                $this->reply->offer->user->notify(new TradeEnded($this->reply, $this->reply->offer->user, $this->reply->user));
                return redirect()->route('reply.index')->with('danger', "Vous avez saisie 3 code non valide, la transaction est annulé.");
                $this->reply->delete();
            }

        } elseif ($this->reply->ended_at === null) {
            // 2e étape de la transaction => saisie du code de fin
            // Incremente le compteur
            // Le ->increment() ne fonctionne pas ici pour une raison obscure j'ai fais des save, plein de test etc mais rien... si  quelqu'un arrive a le fix ;)
            $this->reply->ending_code_count += 1;
            $this->reply->save();

            // Si le code est valide on execute
            if (intval($data['code']) === intval($this->reply->ending_code)){
                // On update la transaction pour qu'elle apparaisse terminé
                $this->reply->update(['ended_at' => Carbon::now()]);

                // Credit des kips
                event(new AddCreditTransactionEvent($this->reply));

                // Envoie de mail pour la fin de la transaction aux deux personnes concernés par la transaction
                $this->reply->user->notify(new TradeEnded($this->reply, auth()->user(), $this->reply->offer->user));
                $this->reply->offer->user->notify(new TradeEnded($this->reply, $this->reply->offer->user, $this->reply->user));

                return redirect()->route('reply.show', $this->reply->id);
            }

            // Code non valide
            // On vide le champs pour limiter les erreur de frappe et multisend
            $this->code = '';
            if ($this->reply->ending_code_count == 3) {
                $ending_code = random_int(1000, 9999);
                $this->reply->update([
                    'ending_code' => $ending_code,
                    'ending_code_count' => null
                ]);
                return redirect()->route('reply.show', $this->reply->id)->with('danger', "Vous avez saisie 3 code non valide, un nouveau code a été generer.");
            }
        }

    }
}

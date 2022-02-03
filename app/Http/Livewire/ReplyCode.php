<?php

namespace App\Http\Livewire;

use App\Models\Reply;
use Carbon\Carbon;
use Livewire\Component;

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
        $this->dcode = $this->reply->starting_code;
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
        if(intval($data['code']) === intval($this->reply->starting_code)) {
            Reply::where('id', $this->reply->id)->update([
                'starting_code_count' => $this->reply->starting_code_count,
                'started_at' => Carbon::now(),
            ]);
            return redirect()->route('reply.show', $this->reply->id);
        } else {
            // Increment le compteur
            $this->reply->increment('starting_code_count', 1);
            Reply::where('id', $this->reply->id)->update([
                'starting_code_count' => $this->reply->starting_code_count,
            ]);
            // On vide le champs pour limiter les erreur de frappe et multisend
            $this->code = '';
            if($this->reply->starting_code_count == 3) {
                    Reply::where('id', $this->reply->id)->delete();
            return redirect()->route('reply.index');
            }
        }
    }
}

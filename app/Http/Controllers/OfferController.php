<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Qui a fait ca ??? inutile le paramètre n'est pas passer au "controller" livewire, et la query faite dans ce même controller ne tiens donc pas compte de la query ci dessous.
        $offers = Offer::get();

        return view('dashboard', compact('offers'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myoffers()
    {
        return view('offer.myoffers');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();

        return view('offer.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:10000',
            'offer_day' => 'required|date',
            'price' => 'required|numeric',
            'category_id' => 'required',
        ],
        [
            'name.required' => 'Vous devez indiquer le nom de l\'offre',
            'name.max' => 'Le nom de l\'offre est trop long !',
            'description.required' => 'Vous devez indiquer une description à votre offre',
            'offer_day.required' => 'Vous devez indiquer une date',
            'price.required' => 'Vous devez indiquer un prix à votre offre',
        ]
        );

        $data['user_id'] = auth()->user()->id;

        $offer = Offer::create($data);

        return redirect()->route('offer.show', $offer->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        // C'est pas beau ca :o
        // $reply = Reply::where([['offer_id','=',$offer->id],['user_id','=', auth()->user()->id]])->first();
        $reply = Reply::where('offer_id', $offer->id)->where('user_id', auth()->user()->id)->first();
        return view('offer.show', compact('offer', 'reply'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        $offer = Offer::find($offer->id);
        $categories = Category::get();

        return view('offer.edit', compact('offer', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:10000',
            'offer_day' => 'required|date',
            'price' => 'required|numeric',
            'category_id' => 'required',
        ],
        [
            'name.required' => 'Vous devez indiquer le nom de l\'offre',
            'name.max' => 'Le nom de l\'offre est trop long !',
            'description.required' => 'Vous devez indiquer une description à votre offre',
            'offer_day.required' => 'Vous devez indiquer une date',
            'price.required' => 'Vous devez indiquer un prix à votre offre',
        ]
        );

        $offer_id = $offer->id;

        Offer::whereId($offer->id)->update($data);

        return redirect()->route('offer.show', $offer_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        Offer::find($offer->id)->delete();

        // TODO : route à changer sur la liste des offres plus tard
        return redirect()->route('dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Post;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $duplicata= Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id ==$request->product_id;
        });

        if($duplicata->isNotEmpty()){
            return redirect()->route('welcome')->with('success', 'Le produit a déjà été ajouter');
        }

        $product = Post::find($request->product_id);

        Cart::add($product->id, $product->libelle ,1, $product->prix)
        ->associate('App\Post');
        return redirect()->route('welcome')->with('success','Le produit a bien été ajouter');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        Cart::remove($rowId);
        return back()->with('success','Le produit a été supprimé du panier');
    }
    public function affiche($id)
    {
        $product = Post::where('id', $id);
        return view('show');
    }
}
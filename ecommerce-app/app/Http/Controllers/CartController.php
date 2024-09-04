<?php

namespace App\Http\Controllers;

use Str;

use App\Models\ShoppingCart;
use App\Models\ShoppingCartItem;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(): ShoppingCart
    {
        $cart = new ShoppingCart();
        $cart->id = Str::uuid();
        $cart->user_id = auth()->user()->id;
        $cart->total = 0;
        $cart->save();

        session()->put("card_id", $cart->id);

        return $cart;
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        if (session("card_id")) {
            $cart = ShoppingCart::findOrFail(session("card_id"));
            $order_items = $cart->products()->orderBy("id", "desc")->get()->all();

            return view("cart", ["cart" => $cart, "order_items" => $order_items]);
        } else {
            $cart = null;
            //$cart = $this->store();
            return view("cart", ["cart" => $cart, "order_items" => null]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $card_id = session("card_id") ? session("card_id") : $this->store()->id;
        $cart_items = ShoppingCartItem::where(["shopping_cart_id" => $card_id, "product_id" => request()->product_id])->get()->all();

        if (!count($cart_items)) {
            $new_item = new ShoppingCartItem();
            $new_item->id = Str::uuid();
            $new_item->shopping_cart_id = $card_id;
            $new_item->product_id = request()->product_id;
            $new_item->qty = $request->input("qty");
            $new_item->save();
        } else {
            $item = ShoppingCartItem::findOrFail($cart_items[0]->id);
            $item->qty += $request->input("qty");
            $item->save();
        }
    }

    /**
     * Use to remove item from cart.
     */
    public function removeItem(Request $request)
    {
        $cart_items = ShoppingCartItem::where(["shopping_cart_id" => session("cart_id"), "product_id" => request()->product_id])->get()->all();
        $item = ShoppingCartItem::findOrFail($cart_items[0]->id);
        $item->delete();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = ShoppingCart::findOrFail($id);
        $cart->delete();

        session()->forget("cart_id");

        return redirect("dashboard.index")->with("success", "Clear cart successfully!");
    }
}







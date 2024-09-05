<?php

namespace App\Http\Controllers;


use Str;

use App\Models\Product;
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
        $cart = session("card_id") ? ShoppingCart::find(session("card_id")) : $this->store();
        $cart_items = $cart->shoppingCartItems()->orderBy("id", "desc")->get()->all();
        $cart_items = count($cart_items) ? $cart_items : [];

        $products = Product::with('userReviews')->withAvg('userReviews', 'rating')->withCount('userReviews')->take(3)->get()->sortByDesc(['trendRating']);

        /*
        if (session("card_id")) {
            $cart = ShoppingCart::find(session("card_id"));
            $cart_items = $cart->shoppingCartItems()->orderBy("id", "desc")->get()->all();
            //$order_items = $cart->products()->orderBy("id", "desc")->get()->all();

            return view("cart", ["cart" => $cart, "cart_items" => $cart_items]);
        } else {
            $cart = $this->store();
            $cart_items = $cart->shoppingCartItems()->orderBy("id", "desc")->get()->all();

            return view("cart", ["cart" => $cart, "cart_items" => $cart_items]);
        }
        */

        return view("cart", ["cart" => $cart, "cart_items" => $cart_items, "trend_items" => $products]);
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
        $cart = ShoppingCart::find($card_id);

        $cart_item = ShoppingCartItem::where(["shopping_cart_id" => $card_id, "product_id" => request()->order_item_id])->first();

        if (!$cart_item) {
            $new_item = new ShoppingCartItem();
            $new_item->id = Str::uuid();
            $new_item->shopping_cart_id = $card_id;
            $new_item->product_id = request()->order_item_id;
            $new_item->qty = $request->input("quantity");
            $new_item->save();
        } else {
            $item = ShoppingCartItem::findOrFail($cart_item->id);
            $item->qty += $request->input("quantity");
            $item->save();
        }

        $cart->total += request()->price * $request->input("quantity");
        $cart->save();

        return redirect()->back()->with("success", "Item has been added into your cart!");
    }

    /**
     * Use to remove item from cart.
     */
    public function removeItem(Request $request)
    {
        $cart_item = ShoppingCartItem::where(["shopping_cart_id" => session("card_id"), "product_id" => request()->product_id])->first();
        $cart = ShoppingCart::find(session("card_id"));

        //$item = ShoppingCartItem::find($cart_item[0]->id);
        $cart->total -= $cart_item->product()->price * $cart_item->qty;
        $cart->save();
        $cart_item->delete();

        return redirect()->back()->with("success", "Item has been removed from cart!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = ShoppingCart::findOrFail($id);
        $cart->delete();

        session()->forget("card_id");

        return redirect("dashboard.index")->with("success", "Clear cart successfully!");
    }
}







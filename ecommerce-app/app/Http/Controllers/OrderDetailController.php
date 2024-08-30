<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = OrderDetail::all();
        return view('order-details.index', [
            'orders' => $orders,
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderDetail $orderDetail)
    {
        // $orderItems = OrderItem::join('products', 'order_items.product_id', '=', 'products.id')
        //     ->where('order_detail_id', $orderDetail->id)
        //     ->get(['order_items.*', 'products.name', 'products.price', 'products.image_url']);

        $orderItems = OrderItem::with('product')->where('order_detail_id', $orderDetail->id)->get();
        
        return view('order-details.show', [
            'orderDetail' => $orderDetail,
            'orderItems' => $orderItems,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDetail $orderDetail)
    {
        //
    }
}

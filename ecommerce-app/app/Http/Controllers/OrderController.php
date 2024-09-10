<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class OrderController extends Controller
{
    public function index(): View
    {
        // TODO: Replace this with the authenticated user
        // $user = Auth::user();
        $user = User::all()->random();
        $orderItems = $user->shoppingCarts->first()->shoppingCartItems;
        $defaultAddress = $user->userAddresses->where('is_default', true)->first()->address;

        $totalPrice = $orderItems->sum(function ($item) {
            return $item->product->price * $item->qty;
        });

        return view('components.orders.index', compact('user', 'orderItems', 'defaultAddress', 'totalPrice'));
    }

    public function store(Request $request): RedirectResponse
    {
        $orderDetail = null;

        DB::transaction(function () use ($request, &$orderDetail) {
            // dd(request()->all());
            $orderStatus = OrderStatus::create([
                'status' => 'Pending',
            ]);

            $orderDetail = OrderDetail::create([
                'user_id' => $request->user_id,
                'address_id' => $request->address_id,
                'order_date' => $request->order_date,
                'order_total' => $request->order_total,
                'order_status_id' => $orderStatus->id,
            ]);

            foreach ($request->order_items as $item) {
                OrderItem::create([
                    'order_detail_id' => $orderDetail->id,
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                ]);
            }
        });

        return redirect()->route('orders.confirmation', ['order_id' => $orderDetail->id]);
    }

    public function showConfirmation($order_id): View
    {
        $orderDetail = OrderDetail::with(['user', 'address'])->findOrFail($order_id);

        return view('components.orders.confirmation', [
            'orderDetail' => $orderDetail,
            'user' => $orderDetail->user,
            'address' => $orderDetail->address,
        ]);
    }
}

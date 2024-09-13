<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmed;
use App\Models\OrderDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Psy\Readline\Hoa\Console;

class EmailController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $orderDetail = OrderDetail::with('user')
            ->where('user_id', $request->user()->id)
            ->get()
            ->sortBy('order_details.order_date')
            ->first();

        Mail::to($request->user()->email)->send(new OrderConfirmed($orderDetail, $request->user()->first_name));
        return redirect('/order-details');
    }
}

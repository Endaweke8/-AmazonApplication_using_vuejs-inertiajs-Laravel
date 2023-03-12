<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stripe = new \Stripe\StripeClient('sk_test_51MDlPxLYsCQ2NImb7NjxtGZGHvZ8Ru5w2b2t65j6RdglhIgRbR7zCoU1YsyIwg6YycHFf4g3Vf1HWuhzm63MQAgn004rjW4hd8');

        $order = Order::where('user_id', '=', auth()->user()->id)
            ->where('payment_intent', null)
            ->first();

        if (!is_null($order)) {
            return redirect()->route('checkout_success.index');
        }

        $intent = $stripe->paymentIntents->create([
            // 'amount' => 1000,
            'amount' => 1099,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);

        return Inertia::render('Checkout', [
            'intent' => $intent,
            'order'=>$order
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
        
           $res=Order::where('user_id','=',auth()->id)
           ->where('payment_intent',null)
           ->first();

           if(!is_null($res)){
            $res->total=$request->total;
            $res->total_decimal=$request->total_decimal;
            $res->items=json_encode($request->items);
            $res->save();
           }
           else{
            $order=new Order();
            $order->user_id=auth()->user()->id;
            $order->total=$request->total;
            $order->total_decimal=$request->total_decimal;
            $order->items=json_encode($request->items);
            $order->save();

           }
           return redirect()->route('checkout.index');
       


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $order = Order::where('user_id', '=', auth()->user()->id)
        ->where('payment_intent', null)
        ->first();
         $order->payment_intent = $request['payment_intent'];
         $order->save();

    // Mail::to($request->user())->send(new OrderShipped($order));

    // return redirect()->route('checkout_success.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

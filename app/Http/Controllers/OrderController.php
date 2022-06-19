<?php

namespace App\Http\Controllers;
use App\Notifications\OrderProcessed;
use Database\Factories\OrderFactory;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
      $order = factory(\App\Models\Order::class)->create();
    
    
      $request->user()->notify(new OrderProcessed($order));
    
    
      return redirect()->route('home')->with('status', 'Order Placed!');
    }
  
}

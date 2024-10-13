<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Traits\APIResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use APIResponse;

    /**
     * Display a listing of orders
     */
    public function index()
    {
        $orders = Order::all();

        return $this->success($orders);
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'dish_id' => 'required|exists:dishes,id',
            'amount' => 'required|numeric',
        ]);

        $order = Order::create($request->all());

        return $this->success($order, 'Order created successfully', 201);
    }

    /**
     * Display the specified order.
     */
    public function show(string $id)
    {
        $order = Order::find($id);

        if (! $order) {
            return $this->error('Order not found', 404);
        }

        return $this->success($order);
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::find($id);

        if (! $order) {
            return $this->error('Order not found', 404);
        }

        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'dish_id' => 'required|exists:dishes,id',
            'amount' => 'required|numeric',
        ]);

        $order->update($request->all());

        return $this->success($order, 'Order updated successfully');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);

        if (! $order) {
            return $this->error('Order not found', 404);
        }

        $order->delete();

        return $this->success(null, 'Order deleted successfully');
    }
}

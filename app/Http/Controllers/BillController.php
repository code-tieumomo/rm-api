<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Traits\APIResponse;
use Illuminate\Http\Request;

class BillController extends Controller
{
    use APIResponse;

    /**
     * Display a listing of bills.
     */
    public function index()
    {
        $bills = Bill::all();

        return $this->success($bills);
    }

    /**
     * Store a newly created bill in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|integer',
            'tong_tien' => 'required|numeric',
        ]);

        $bill = Bill::create($request->all());

        return $this->success($bill, 'Bill created successfully', 201);
    }

    /**
     * Display the specified bill.
     */
    public function show(string $id)
    {
        $bill = Bill::find($id);

        if (! $bill) {
            return $this->error('Bill not found', 404);
        }

        return $this->success($bill);
    }

    /**
     * Update the specified bill in storage.
     */
    public function update(Request $request, string $id)
    {
        $bill = Bill::find($id);

        if (! $bill) {
            return $this->error('Bill not found', 404);
        }

        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|integer',
            'tong_tien' => 'required|numeric',
        ]);

        $bill->update($request->all());

        return $this->success($bill, 'Bill updated successfully');
    }

    /**
     * Remove the specified bill from storage.
     */
    public function destroy(string $id)
    {
        $bill = Bill::find($id);

        if (! $bill) {
            return $this->error('Bill not found', 404);
        }

        $bill->delete();

        return $this->success(null, 'Bill deleted successfully');
    }
}

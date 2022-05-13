<?php

namespace App\Services;

use Exception;
use App\Models\Order;

class OrderService
{

    public function list()
    {
        return Order::all();
    }

    public function find($id)
    {
        return Order::findOrFail($id);
    }

    public function store($request)
    {
        try {
            return Order::create([
                'tanggal' => $request->tanggal,
                'status' => 'onprogress'
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($request, $id)
    {
        try {

            $order = Order::findOrFail($id);

            $order->update([
                'tanggal' => $request->tanggal,
                'status' => $request->status
            ]);

            return $order;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($id)
    {

        try {

            $order = Order::findOrFail($id);

            $order->delete();
        } catch (Exception $th) {
            throw $th;
        }
    }
}

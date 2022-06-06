<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;

class OrderItemService
{
    public function list(int $id)
    {
        try {
            return OrderItem::where('order_items.order_id', $id)
                ->select('order_items.id', 'order_id', 'product_id', 'product_name', 'keterangan', 'catatan', 'status')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->get();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function find(int $orderId, int $itemId)
    {
        try {
            return OrderItem::where([
                'order_id' => $orderId,
                'id' => $itemId,
            ])->first();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function store($request, int $id)
    {
        try {
            return OrderItem::create([
                'order_id' => $id,
                'product_id' => $request->product,
                'keterangan' => $request->keterangan,
                'catatan' => $request->cataran,
                'status' => 'ready'
            ]);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function update($request, $orderId, $itemId)
    {
        try {
            $status = DB::table('order_items')->where([
                'order_id' => $orderId,
                'id' => $itemId,
            ])
                ->update([
                    'product_id' => $request->product,
                    'keterangan' => $request->keterangan,
                    'catatan' => $request->catatan,
                ]);

            return $status;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($orderId, $itemId)
    {
        try {
            $status = DB::table('order_items')->where([
                'order_id' => $orderId,
                'id' => $itemId,
            ])->delete();

            return $status;
        } catch (Exception $e) {
            throw $e;
        }
    }
}

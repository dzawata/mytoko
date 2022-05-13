<?php

namespace App\Services;

use Exception;
use App\Models\OrderItem;

class OrderItemService
{
    public function list(int $id)
    {
        try {
            return OrderItem::where('order_items.order_id', $id)
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->get();
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
}

<?php

namespace App\Services;

use Exception;
use App\Models\OrderItem;

class OrderItemService
{
    public function list(int $id)
    {
        try {
            return OrderItem::where('order_id', $id);
        } catch (Exception $e) {
            throw $e;
        }
    }
}

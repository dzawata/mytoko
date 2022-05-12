<?php

namespace App\Http\Controllers;

use Exception;
use App\Services\OrderItemService;
use App\Services\OrderService;

class OrderItemController extends Controller
{

    protected $orderItemService;

    public function __construct(OrderItemService $orderItemService)
    {
        $this->orderItemService = $orderItemService;
    }

    public function list(OrderService $orderService, int $id)
    {
        $order = $orderService->find($id);

        return view('admin.pages.order-items.index', [
            'title' => 'Items',
            'order_id' => $id,
            'date_order' => 'Order Date : ' . $order->tanggal,
            'order_items' => $this->orderItemService->list($id)
        ]);
    }

    public function create()
    {
    }
}

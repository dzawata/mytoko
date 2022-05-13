<?php

namespace App\Http\Controllers;

use Exception;
use App\Services\OrderItemService;
use App\Services\OrderService;
use App\Services\ProductService;

class OrderItemController extends Controller
{

    protected $orderItemService;
    protected $productService;

    public function __construct(OrderItemService $orderItemService, ProductService $productService)
    {
        $this->orderItemService = $orderItemService;
        $this->productService = $productService;
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

    public function create(int $id)
    {
        return view('admin.pages.order-items.create', [
            'title' => 'Tambah Item',
            'order_id' => $id,
            'products' => $this->productService->list()
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\CreateOrderItemRequest;
use App\Http\Requests\UpdateOrderItemRequest;
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

    public function store(CreateOrderItemRequest $createOrderItemRequest, int $id)
    {
        try {

            $orderItem = $this->orderItemService->store($createOrderItemRequest, $id);

            return response()->json([
                'status' => true,
                'data' => $orderItem
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit(int $orderId, int $itemId)
    {
        try {

            return view('admin.pages.order-items.edit', [
                'title' => 'Edit Order',
                'order_id' => $orderId,
                'order_item' => $this->orderItemService->find($orderId, $itemId),
                'products' => $this->productService->list()
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(UpdateOrderItemRequest $request, $orderId, $itemId)
    {
        try {
            $orderItem = $this->orderItemService->update($request, $orderId, $itemId);

            return response()->json([
                'status' => true,
                'data' => $orderItem
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete($orderId, $itemId)
    {
        try {

            $this->orderItemService->delete($orderId, $itemId);

            return response()->json([
                'status' => true,
                'message' => 'Sukses hapus data'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}

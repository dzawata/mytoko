<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        return view('admin.pages.order.index', [
            'title' => 'Orders',
            'orders' => $this->orderService->list()
        ]);
    }

    public function create()
    {
        return view('admin.pages.order.create', [
            'title' => 'Tambah Order'
        ]);
    }

    public function store(CreateOrderRequest $createOrderRequest)
    {
        try {
            $order = $this->orderService->store($createOrderRequest);

            return response()->json([
                'status' => true,
                'data' => $order
            ]);
        } catch (Exception $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}

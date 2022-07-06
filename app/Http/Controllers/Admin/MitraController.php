<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMitraRequest;
use App\Http\Requests\UpdateMitraRequest;
use App\Services\MitraService;

class MitraController extends Controller
{
    protected $mitraService;

    public function __construct(MitraService $mitraService)
    {
        $this->mitraService = $mitraService;
    }

    public function index()
    {
        return view('admin.pages.mitra.index', [
            'title' => 'Mitra',
            'listMitra' => $this->mitraService->list()
        ]);
    }

    public function create()
    {
        return view('admin.pages.mitra.create', [
            'title' => 'Tambah Mitra'
        ]);
    }

    public function store(CreateMitraRequest $createMitraRequest)
    {
        try {
            $mitra = $this->mitraService->store($createMitraRequest);

            return response()->json([
                'status' => true,
                'data' => $mitra
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit(int $id)
    {
        return view('admin.pages.mitra.edit', [
            'title' => 'Edit Mitra',
            'mitra' => $this->mitraService->find($id)
        ]);
    }

    public function update(UpdateMitraRequest $updateMitraRequest, int $id)
    {
        try {
            $data = $this->mitraService->update($updateMitraRequest, $id);

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (Exception $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function delete(int $id)
    {
        try {

            $this->mitraService->delete($id);

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

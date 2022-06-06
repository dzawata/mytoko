<?php

namespace App\Services;

use Exception;
use App\Models\Mitra;

class MitraService
{

    public function list()
    {
        return Mitra::get();
    }

    public function find(int $id)
    {
        return Mitra::findOrFail($id);
    }

    public function store($request)
    {
        try {
            return Mitra::create([
                'mitra' => $request->mitra,
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($request, int $id)
    {
        try {

            $mitra = Mitra::findOrFail($id);

            $mitra->update([
                'mitra' => $request->mitra

            ]);

            return $mitra;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($id)
    {

        try {

            $mitra = Mitra::findOrFail($id);

            $mitra->delete();
        } catch (Exception $th) {
            throw $th;
        }
    }
}

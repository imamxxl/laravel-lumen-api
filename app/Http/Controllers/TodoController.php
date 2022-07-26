<?php

namespace App\Http\Controllers;

use Illuminate\Http\{Request, JsonResponse};
use App\Models\Todo;

class TodoController extends Controller
{
    protected $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    // get semua data 
    public function index(): JsonResponse
    {
        $todos = $this->todo->all();

        return response()->json(
            ['data' => $todos],
            200
        );
    }

    // Store data
    public function store(Request $request): JsonResponse
    {
        // validate incoming request 
        $data = $this->validate($request, [
            'name' => 'required|max:100',
            'description' => 'nullable'
        ]);

        try {
            $todo = $this->todo->create($data);

            //return successful response
            return response()->json([
                'status' => true,
                'message' => 'Data todo berhasil disimpan.',
                'data' => $todo
            ], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json([
                'status' => false,
                'message' => 'Create data todo gagal'
            ], 409);
        }
    }

    // Menampilkan data berdasarkan id yang dipilih
    public function show(int $id): JsonResponse
    {
        $todo = $this->todo->findOrFail($id);

        return response()->json(['data' => $todo], 200);
    }


    // mengupdate data
    public function update(Request $request, int $id): JsonResponse
    {
        //validate incoming request 
        $data = $this->validate($request, [
            'name' => 'required|max:100',
            'description' => 'nullable'
        ]);

        try {
            $todo = $this->todo->findOrFail($id);
            $todo->fill($data);
            $todo->save();

            //return successful response
            return response()->json([
                'status' => true,
                'message' => 'Data todo berhasil diupdate',
                'data' => $todo
            ], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json([
                'status' => false,
                'message' => 'Update data todo gagal'
            ], 409);
        }
    }

    // delete data
    public function destroy(int $id): JsonResponse
    {

        try {
            $todo = $this->todo->findOrFail($id);
            $todo->delete();

            //return successful response
            return response()->json([
                'status' => true,
                'message' => 'Data todo berhasil dihapus',
                'user' => $todo
            ], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json([
                'status' => false,
                'message' => 'Hapus data todo gagal'
            ], 409);
        }
    }
}

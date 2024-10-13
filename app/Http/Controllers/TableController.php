<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Traits\APIResponse;
use Illuminate\Http\Request;

class TableController extends Controller
{
    use APIResponse;

    /**
     * Display a listing of tables.
     */
    public function index()
    {
        $tables = Table::all();

        return $this->success($tables);
    }

    /**
     * Store a newly created table in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'table_name' => 'required',
            'status' => 'required',
            'customer_name' => 'nullable',
        ]);

        $table = Table::create($request->all());

        return $this->success($table, 'Table created successfully', 201);
    }

    /**
     * Display the specified table.
     */
    public function show(string $id)
    {
        $table = Table::find($id);

        if (! $table) {
            return $this->error('Table not found', 404);
        }

        return $this->success($table);
    }

    /**
     * Update the specified table in storage.
     */
    public function update(Request $request, string $id)
    {
        $table = Table::find($id);

        if (! $table) {
            return $this->error('Table not found', 404);
        }

        $request->validate([
            'table_name' => 'required',
            'status' => 'required',
            'customer_name' => 'nullable',
        ]);

        $table->update($request->all());

        return $this->success($table, 'Table updated successfully');
    }

    /**
     * Remove the specified table from storage.
     */
    public function destroy(string $id)
    {
        $table = Table::find($id);

        if (! $table) {
            return $this->error('Table not found', 404);
        }

        $table->delete();

        return $this->success(null, 'Table deleted successfully');
    }
}

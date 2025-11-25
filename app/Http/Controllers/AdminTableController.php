<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class AdminTableController extends Controller
{
    public function index()
    {
        return response()->json([
            'tables' => Table::all()
        ]);
    }

    // create table
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'floor'     => 'required|integer',
            'is_active' => 'boolean'
        ]);

        $table = Table::create($validated);

        return response()->json([
            'message' => 'Table created successfully.',
            'table'   => $table
        ], 201);
    }

    // update table
    public function update(Request $request, Table $table)
    {
        $validated = $request->validate([
            'name'      => 'string|max:255',
            'floor'     => 'integer',
            'is_active' => 'boolean'
        ]);

        $table->update($validated);

        return response()->json([
            'message' => 'Table updated successfully.',
            'table'   => $table
        ]);
    }

    // delete table
    public function destroy(Table $table)
    {
        $table->delete();

        return response()->json([
            'message' => 'Table deleted successfully.'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableSelectionController extends Controller
{
    public function select(Request $request)
    {
        $data = $request->validate([
            'selected' => 'required'
        ]);

        $ids = $data['selected'];
        if (!is_array($ids)) {
            $ids = [$ids];
        }

        $tables = Table::whereIn('id', $ids)->get();

        return response()->json([
            'selected_ids' => $ids,
            'tables' => $tables,
        ]);
    }
}

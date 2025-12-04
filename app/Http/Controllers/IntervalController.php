<?php

namespace App\Http\Controllers;

use App\Models\Interval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class IntervalController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $intervals = Interval::where('user_id', $user->id)
            ->orderBy('last_used_at', 'desc')
            ->get();

        return response()->json([
            'data' => $intervals
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'interval_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $interval = Interval::create([
            'user_id' => $user->id,
            'interval_name' => $request->interval_name,
            'last_used_at' => null,
        ]);

        return response()->json([
            'message' => 'Interval created.',
            'data' => $interval
        ], 201);
    }

    public function update(Request $request, Interval $interval)
    {
        $user = $request->user();

        if ($interval->user_id !== $user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $validator = Validator::make($request->all(), [
            'interval_name' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }

        $interval->update([
            'interval_name' => $request->interval_name ?? $interval->interval_name,
        ]);

        return response()->json([
            'message' => 'Interval updated.',
            'data' => $interval
        ]);
    }

    public function destroy(Request $request, Interval $interval)
    {
        $user = $request->user();

        if ($interval->user_id !== $user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $interval->delete();

        return response()->json(['message' => 'Interval deleted.']);
    }

    // marking interval as used
    public function markAsUsed(Request $request, Interval $interval)
    {
        $user = $request->user();

        if ($interval->user_id !== $user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $interval->update([
            'last_used_at' => Carbon::now(),
        ]);

        return response()->json([
            'message' => 'Interval marked as used.',
            'data' => $interval
        ]);
    }
}
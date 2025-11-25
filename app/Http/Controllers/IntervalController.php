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
            ->orderBy('start_at', 'asc')
            ->get();

        return response()->json([
            'data' => $intervals
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'type'     => 'required|string|max:255',
            'start_at' => 'required|date_format:Y-m-d H:i:s',
            'end_at'   => 'required|date_format:Y-m-d H:i:s',
        ]);

        $validator->after(function($validator) use ($request, $user) {
            $start = $request->start_at;
            $end   = $request->end_at;

            if ($start >= $end) {
                $validator->errors()->add('end_at', 'end_at must be AFTER start_at.');
            }

            if ($this->overlaps($user->id, $start, $end)) {
                $validator->errors()->add('interval', 'This interval overlaps with an existing one.');
            }
        });

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $start = Carbon::parse($request->start_at);
        $end   = Carbon::parse($request->end_at);

        $interval = Interval::create([
            'user_id' => $user->id,
            'type' => $request->type,
            'start_at' => $start,
            'end_at' => $end,
            'duration' => $end->diffInMinutes($start),
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
            'type'     => 'sometimes|required|string|max:255',
            'start_at' => 'sometimes|required|date_format:Y-m-d H:i:s',
            'end_at'   => 'sometimes|required|date_format:Y-m-d H:i:s',
        ]);

        $validator->after(function($validator) use ($request, $user, $interval) {
            $start = $request->start_at ?? $interval->start_at;
            $end   = $request->end_at ?? $interval->end_at;

            if ($start >= $end) {
                $validator->errors()->add('end_at', 'end_at must be AFTER start_at.');
            }

            if ($this->overlaps($user->id, $start, $end, $interval->id)) {
                $validator->errors()->add('interval', 'This interval overlaps with an existing one.');
            }
        });

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }

        $start = Carbon::parse($request->start_at ?? $interval->start_at);
        $end   = Carbon::parse($request->end_at ?? $interval->end_at);

        $interval->update([
            'type'     => $request->type     ?? $interval->type,
            'start_at' => $start,
            'end_at'   => $end,
            'duration' => $end->diffInMinutes($start),
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

    private function overlaps($userId, $start, $end, $ignoreId = null)
    {
        $q = Interval::where('user_id', $userId)
            ->where('start_at', '<', $end)
            ->where('end_at',   '>', $start);

        if ($ignoreId) {
            $q->where('id', '!=', $ignoreId);
        }

        return $q->exists();
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Room;
use App\Models\Table;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Interval;
use App\Models\IntervalProgram;
use Log;
use Str;

class AdminController extends Controller
{
    public function serveBuildings() {
        $buildings = Building::all();
        $floors = Floor::all();

        return view("BuildingControl", [
        'buildings' => $buildings,
        'floors'=> $floors
    ]);
    }

    public function saveBuilding(Request $request) {
        $validated = $request->validate([
            "type" => ["required", "in:building"],
            "name" => ["required", "string", "unique:buildings,name" ],
            "company" =>  ["required", "string"],
            "address" => ["required", "string"],
            "entity_n" => ["required", "integer", "min:1"]
        ]);

        $validated["floor_num"] = $validated["entity_n"];
        $validated["id"] = Str::uuid();

        $building = Building::create($validated);

        return redirect()->route('admin.control');
    }

    public function saveFloor(Request $request) {
        $validated = $request->validate([
            "type" => ["required", "in:floor"],
            "name" => ["required", "string"],
            "company" =>  ["required", "string"],
            "entity_n" => ["required", "integer", "min:1"],
            "building_id" => ["required", "string","exists:buildings,id"]
        ]);

        $validated["room_num"] = $validated["entity_n"];
        $validated["id"] = Str::uuid();
        
        $building = Building::findOrFail( $validated["building_id"] );
        $floor_count = Floor::where("building_id", $building->id)->count();

        if ($floor_count < $building->floor_num) {
            $floor = Floor::create($validated);
        } else {
          return back()
            ->withErrors(['building_id' => 'Cannot add new floor to building'])
            ->withInput();  
        }
        return redirect()->route('admin.control');
    }

    public function saveRoom(Request $request) {
        $validated = $request->validate([
            "type" => ["required", "in:room"],
            "name" => ["required", "string"],
            "company" =>  ["required", "string"],
            "entity_n" => ["required", "integer", "min:1"],
            "floor_id" => ["required", "string","exists:floors,id"]
        ]);

        $validated["table_num"] = $validated["entity_n"];
        $validated["id"] = Str::uuid();
        
        $floor = Floor::findOrFail( $validated["floor_id"] );
        $room_count = Room::where("room_num", $floor->id)->count();

        if ($room_count < $floor->room_num) {
            $room = Room::create($validated);
        } else {
          return back()
            ->withErrors(['building_id' => 'Cannot add new floor to building'])
            ->withInput();  
        }

        for ($i = 0; $i < ($room->table_num); $i++) {
            Table::create([
                'name' => "Table {($i + 1)}",
                'room_id' => $room->id,
                'current_height' => 0,
                'company'=>$room->company
            ]);
        }

        return redirect()->route('admin.control');
    }
}
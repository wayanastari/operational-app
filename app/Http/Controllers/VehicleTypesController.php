<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle_types;
use Illuminate\View\View;

class VehicleTypesController extends Controller implements BasedController
{
    public function index(Request $request) : View{
        $query = Vehicle_types::query();

        //Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('vehicle_type', 'like', '%'.$search.'%');
            });
        }

        $vehicle_types = $query->paginate(10);
        return view ('vehicle_types.index', compact('vehicle_types'));
    }

    public function create() : View{
        if (request()->ajax()) {
            return view('vehicle_types.partials.form');
        }
        return view('vehicle_types.create');
    }

    public function store(Request $request){
        $request->validate([
            'vehicle_type' => 'required|string|max:255',
        ]);

        Vehicle_types::create($request->all());
        return redirect()->route('vehicle_types.index')
                        ->with('success','Vehicle Type created successfully.');
    } 

    public function show($id) : View{
        if(request()->ajax()){
            $vehicle_types = Vehicle_types::findOrFail($id);
            return view('vehicle_types.partials.show', compact('vehicle_types'));
        }
        $vehicle_types = Vehicle_types::findOrFail($id);
        return view('vehicle_types.show', compact('vehicle_types'));
    }

    public function edit($id) : View{
        if (request()->ajax()) {
            $vehicle_types = Vehicle_types::findOrFail($id);
            return view('vehicle_types.partials.form', compact('vehicle_types'));
        }
        $vehicle_types = Vehicle_types::findOrFail($id);
        return view('vehicle_types.edit', compact('vehicle_types'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'vehicle_type' => 'required|string|max:255',
        ]);

        $vehicle_type = Vehicle_types::findOrFail($id);
        $vehicle_type->update($request->all());

        return redirect()->route('vehicle_types.index')
                        ->with('success','Tipe kendaraan berhasil diperbarui.');
    }

    public function destroy($id){
        $vehicle_type = Vehicle_types::findOrFail($id);
        $vehicle_type->delete();

        return redirect()->route('vehicle_types.index')
                        ->with('success','Tipe kendaraan berhasil dihapus.');
    }
}

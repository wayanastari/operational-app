<?php

namespace App\Http\Controllers;

use App\Models\Vehicle_types;
use Illuminate\Http\Request;
use App\Models\VehicleVariant;
use Illuminate\View\View;

class VehicleVariantsController extends Controller implements BasedController
{
    public function index(Request $request) : View{
        $query = VehicleVariant::with('vehicle_type');

        //Search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('vehicle_variant', 'like', "%$search%")
                  ->orWhereHas('vehicle_type', function ($q) use ($search) {
                      $q->where('vehicle_type', 'like', "%$search%");
                  });
        }

        $vehicle_variants = $query->paginate(10);
        return view ('vehicle_variants.index', compact('vehicle_variants'));
    }

    public function create() : View{
        if(request()->ajax()){
            $vehicle_types = Vehicle_types::all();
            return view('vehicle_variants.partials.form', compact('vehicle_types'));
        }
        return view('vehicle_variants.create');
    }

    public function store(Request $request){
        $request->validate([
            'id_vehicle_type' => 'required|exists:vehicle_types,id',
            'vehicle_variant' => 'required|string|max:255',
        ]);

        VehicleVariant::create([
            'id_vehicle_type' => $request->id_vehicle_type,
            'vehicle_variant' => $request->vehicle_variant,
        ]);

        return redirect()->route('vehicle_variants.index')
                        ->with('success','Vehicle Variant created successfully.');
    }

    public function show($id) : View{
        if(request()->ajax()){
            $VehicleVariants = VehicleVariant::findOrFail($id);
            return view('VehicleVariants.partials.show', compact('VehicleVariants'));
        }
        $VehicleVariants = VehicleVariant::findOrFail($id);
        return view('VehicleVariants.show', compact('VehicleVariants'));
    }

    public function edit($id) : View{
        if (request()->ajax()) {
            $VehicleVariants = VehicleVariant::findOrFail($id);
            return view('VehicleVariants.partials.form', compact('VehicleVariants'));
        }
        $VehicleVariants = VehicleVariant::findOrFail($id);
        return view('VehicleVariants.edit', compact('VehicleVariants'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'VehicleVariant' => 'required|string|max:255',
        ]);

        $VehicleVariants = VehicleVariant::findOrFail($id);
        $VehicleVariants->update($request->all());

        return redirect()->route('VehicleVariants.index')
                        ->with('success','Vehicle Variant updated successfully');
    }

    public function destroy($id){
        $VehicleVariants = VehicleVariant::findOrFail($id);
        $VehicleVariants->delete();
        return redirect()->route('VehicleVariants.index')
                        ->with('success','Vehicle Variant deleted successfully');
    }
}

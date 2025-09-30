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
            dd($request->all());
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
        $vehicle_variants = VehicleVariant::with('vehicle_type')->findOrFail($id);

        if(request()->ajax()){
            return view('vehicle_variants.partials.show', compact('vehicle_variants'));
        }

        return view('vehicle_variants.show', compact('vehicle_variants'));
    }


    public function edit($id) : View
    {
        $vehicle_variants = VehicleVariant::findOrFail($id);
        $vehicle_types = Vehicle_types::all();

        if (request()->ajax()) {
            return view('vehicle_variants.partials.form', compact('vehicle_variants', 'vehicle_types'));
        }

        return view('vehicle_variants.partials.form', compact('vehicle_variants', 'vehicle_types'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'id_vehicle_type' => 'required|exists:vehicle_types,id',
            'vehicle_variant' => 'required|string|max:255',
        ]);

        $vehicle_variants = VehicleVariant::findOrFail($id);
        $vehicle_variants->update([
            'id_vehicle_type' => $request->id_vehicle_type,
            'vehicle_variant' => $request->vehicle_variant,
        ]);

        return redirect()->route('vehicle_variants.index')
                        ->with('success','Vehicle Variant updated successfully.');
    }



    public function destroy($id){
        $VehicleVariants = VehicleVariant::findOrFail($id);
        $VehicleVariants->delete();
        return redirect()->route('vehicle_variants.index')
                        ->with('success','Vehicle Variant deleted successfully');
    }
}

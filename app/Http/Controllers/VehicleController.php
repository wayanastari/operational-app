<?php

// app/Http/Controllers/VehicleController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Branch;
use App\Models\VehicleVariant;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function index(Request $request): View
    {
        // load relasi branch & variant
        $query = Vehicle::with(['branch', 'variant']);

        // search
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('plat_number', 'like', "%$search%")
                  ->orWhere('owner_name', 'like', "%$search%")
                  ->orWhere('vehicle_identification_number', 'like', "%$search%")
                  ->orWhereHas('branch', function ($q) use ($search) {
                      $q->where('branch_name', 'like', "%$search%");
                  })
                  ->orWhereHas('variant', function ($q) use ($search) {
                      $q->where('vehicle_variant', 'like', "%$search%");
                  });
        }

        $vehicles = $query->paginate(10);
        return view('vehicles.index', compact('vehicles'));
    }

    public function create(): View
    {
        $branches = Branch::all();
        $variants = VehicleVariant::all();

        if (request()->ajax()) {
            return view('vehicles.partials.form', compact('vehicles','branches', 'variants'));
        }

        return view('vehicles.create', compact('branches', 'variants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'variant_id' => 'required|exists:vehicle_variants,id',
            'plat_number' => 'required|string|max:20|unique:vehicles,plat_number',
            'owner_name' => 'required|string|max:255',
            'vehicle_identification_number' => 'nullable|string|max:50',
            'vehicle_image' => 'nullable|image|max:2048',
        ]);

        Vehicle::create($request->all());

        return redirect()->route('vehicles.index')
                         ->with('success', 'Vehicle created successfully.');
    }

    public function show($id): View
    {
        $vehicle = Vehicle::with(['branch', 'variant'])->findOrFail($id);

        if (request()->ajax()) {
            return view('vehicles.partials.show', compact('vehicle'));
        }

        return view('vehicles.show', compact('vehicle'));
    }

    public function edit($id): View
    {
        $vehicle = Vehicle::findOrFail($id);
        $branches = Branch::all();
        $variants = VehicleVariant::all();

        if (request()->ajax()) {
            return view('vehicles.partials.form', compact('vehicle', 'branches', 'variants'));
        }

        return view('vehicles.edit', compact('vehicle', 'branches', 'variants'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'variant_id' => 'required|exists:vehicle_variants,id',
            'plat_number' => 'required|string|max:20|unique:vehicles,plat_number,' . $id,
            'owner_name' => 'required|string|max:255',
            'vehicle_identification_number' => 'nullable|string|max:50',
            'vehicle_image' => 'nullable|image|max:2048',
        ]);

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($request->all());

        return redirect()->route('vehicles.index')
                         ->with('success', 'Vehicle updated successfully.');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('vehicles.index')
                         ->with('success', 'Vehicle deleted successfully.');
    }
}


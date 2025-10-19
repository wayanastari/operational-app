<?php

namespace App\Http\Controllers;

use App\Models\Vehicle_types;
use App\Models\VehicleVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class VehicleVariantsController extends Controller implements BasedController
{
    public function index(Request $request): View
    {
        $query = VehicleVariant::with('vehicle_type');

        // search
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('vehicle_variant', 'like', "%$search%")
                  ->orWhereHas('vehicle_type', fn($q) =>
                        $q->where('vehicle_type', 'like', "%$search%"));
        }

        $vehicle_variants = $query->paginate(10);
        return view('vehicle_variants.index', compact('vehicle_variants'));
    }


    public function create(): View
    {
        $vehicle_types = Vehicle_types::all();
        return view('vehicle_variants.partials.form', compact('vehicle_types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_vehicle_type' => 'required|exists:vehicle_types,id',
            'vehicle_variant' => 'required|string|max:255',
            'vehicle_image'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->hasFile('vehicle_image')
            ? $request->file('vehicle_image')->store('vehicle_images', 'public')
            : null;

        VehicleVariant::create([
            'id_vehicle_type' => $request->id_vehicle_type,
            'vehicle_variant' => $request->vehicle_variant,
            'vehicle_image'   => $imagePath,
        ]);

        return redirect()->route('vehicle_variants.index')
                         ->with('success', 'Vehicle Variant created successfully.');
    }

    public function show($id): View
    {
        $vehicle_variants = VehicleVariant::with('vehicle_type')->findOrFail($id);
        return view('vehicle_variants.partials.show', compact('vehicle_variants'));
    }

    public function edit($id): View
    {
        $vehicle_variants = VehicleVariant::findOrFail($id);
        $vehicle_types    = Vehicle_types::all();
        return view('vehicle_variants.partials.form', compact('vehicle_variants', 'vehicle_types'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_vehicle_type' => 'required|exists:vehicle_types,id',
            'vehicle_variant' => 'required|string|max:255',
            'vehicle_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $vehicle_variants = VehicleVariant::findOrFail($id);

        // handle image
        if ($request->hasFile('vehicle_image')) {
            // hapus gambar lama
            if ($vehicle_variants->vehicle_image && Storage::disk('public')->exists($vehicle_variants->vehicle_image)) {
                Storage::disk('public')->delete($vehicle_variants->vehicle_image);
            }
            $vehicle_variants->vehicle_image = $request->file('vehicle_image')->store('vehicle_images', 'public');
        }

        $vehicle_variants->id_vehicle_type = $request->id_vehicle_type;
        $vehicle_variants->vehicle_variant = $request->vehicle_variant;
        $vehicle_variants->save();

        return redirect()->route('vehicle_variants.index')
                         ->with('success', 'Vehicle Variant updated successfully.');
    }

    public function destroy($id)
    {
        $vehicle_variants = VehicleVariant::findOrFail($id);

        if ($vehicle_variants->vehicle_image && Storage::disk('public')->exists($vehicle_variants->vehicle_image)) {
            Storage::disk('public')->delete($vehicle_variants->vehicle_image);
        }

        $vehicle_variants->delete();

        return redirect()->route('vehicle_variants.index')
                         ->with('success', 'Vehicle Variant deleted successfully.');
    }
}

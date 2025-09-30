<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GarageController extends Controller implements BasedController
{
    public function index(Request $request) : View{
        $query = Garage::query();

        //Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('garage_name', 'like', '%'.$search.'%')
                ->orWhere('garage_address', 'like', '%'.$search.'%');
            });
        }

        $garage = $query->paginate(10);
        return view ('garage.index', compact('garage'));
    }

    public function create() : View{
        if (request()->ajax()) {
            return view('garage.partials.form');
        }
        return view('garage.create');
    }

    public function store(Request $request){
        $request->validate([
            'garage_name' => 'required|string|max:255',
            'garage_address' => 'required|string|max:255',
        ]);

        Garage::create($request->all());
        return redirect()->route('garage.index')
                        ->with('success','Garage created successfully.');
    }

    public function show($id) : View{
        if(request()->ajax()){
            $garage = Garage::findOrFail($id);
            return view('garage.partials.show', compact('garage'));
        }
        $garage = Garage::findOrFail($id);
        return view('garage.show', compact('garage'));
    }

    public function edit($id) : View{
        if (request()->ajax()) {
            $garage = Garage::findOrFail($id);
            return view('garage.partials.form', compact('garage'));
        }
        $garage = Garage::findOrFail($id);
        return view('garage.edit', compact('garage'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'garage_name' => 'required|string|max:255',
            'garage_address' => 'required|string|max:255',
        ]);

        $garage = Garage::find($id);
        $garage->update($request->all());
        return redirect()->route('garage.index')
                        ->with('success','Garage updated successfully');
    }

    public function destroy($id){
        $garage = Garage::find($id);
        $garage->delete();
        return redirect()->route('garage.index')
                        ->with('success','Garage deleted successfully');
    }
    
}

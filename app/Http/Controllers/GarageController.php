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

        $Garage = $query->paginate(10);
        return view ('garage.index', compact('Garage'));
    }

    public function create() : View{};
    public function store(Request $request){};
    public function show($id) : View{};
    public function edit($id) : View{};
    public function update(Request $request, $id){};
    public function destroy($id){};
    
}

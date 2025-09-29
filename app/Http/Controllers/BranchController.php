<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\View\View;

class BranchController extends Controller implements BasedController
{
    public function index(Request $request) : View{
        $query = Branch::query();

        //Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('branch_name', 'like', '%'.$search.'%')
                ->orWhere('branch_address', 'like', '%'.$search.'%');
            });
        }

        $branch = $query->paginate(10);
        return view ('branch.index', compact('branch'));
    }

    public  function create() : View{
        if (request()->ajax()){
            return view('branch.partials.form');
        }
        return view ('branch.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_name' => 'required|string|max:255',
            'branch_address' => 'required|string|max:255',
        ]);

        try {
            Branch::create($validated);
            return redirect()->route('branch.index')
                             ->with('success', 'Branch created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()
                         ->withErrors(['error' => 'Failed to create branch: ' . $e->getMessage()])
                         ->with('modal-open', 'createBranchModal');
        }
        
    }

    public function show($id) : View{
        if(request()->ajax()){
            $branch = Branch::findOrFail($id);
            return view('branch.partials.show', compact('branch'));
        }
        $branch = Branch::findOrFail($id);
        return view('branch.show', compact('branch'));
    }

    public function edit($id) : View{
        if(request()->ajax()){
            $branch = Branch::findOrFail($id);
            return view('branch.partials.form', compact('branch'));
        }
        $branch = Branch::findOrFail($id);
        return view('branch.edit', compact('branch'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'branch_name' => 'required|string|max:255',
            'branch_address' => 'required|string|max:255',
        ]);

        $branch = Branch::findOrFail($id);
        $branch->update($request->all());

        return redirect()->route('branch.index')
                         ->with('success', 'Branch updated successfully.');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()->route('branch.index')
                         ->with('success', 'Branch deleted successfully.');
    }
}

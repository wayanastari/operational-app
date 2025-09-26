<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\View\View;

class BranchController extends Controller implements BasedController
{
    public function index() : View{
        $branch = Branch::all();
        return view ('branch.index', compact('branch'));
    }

    public  function create() : View{
        return view ('branch.create');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class GarageController extends Controller implements BasedController
{
    public function index() : View{
        return view ('garage.index');
    }
    
}

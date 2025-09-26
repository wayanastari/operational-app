<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;

interface BasedController {
    public function index() : View;
    public function create() : View;
}
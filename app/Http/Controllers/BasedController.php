<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;

interface BasedController {
    public function index() : View;
    public function create() : View;
    public function store(Request $request);
    public function show($id) : View;
    public function edit($id) : View;
    public function update(Request $request, $id);
    public function destroy($id);
}
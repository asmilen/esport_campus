<?php

namespace App\Http\Controllers\Backend;


class MainController extends AdminController
{

    public function index()
    {
        return view('admin.index');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        return $this->view('admin.organization', [

        ]);
    }

    public function update(Request $request)
    {

    }
}

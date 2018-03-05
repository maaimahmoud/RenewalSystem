<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
class ServicesController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Add(Request $request)
    {
      # code...
      return view ('/Servicespages/Add');

    }

    public function Edit(Request $request)
    {
      # code...
      return view ('/Servicespages/Edit');
    }

    public function View($id)
    {
      # code...
      return view ('/Servicespages/View');
    }
    public function Get()
    {
      # code...
      return view ('/Servicespages/Get');
    }
}

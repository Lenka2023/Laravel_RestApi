<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsResource extends Controller
{
    public function index(){
      return 'index';
    }
    public function show($id = null, $code = null){
        return 'users='.$id.'code='.$code;
    }
}

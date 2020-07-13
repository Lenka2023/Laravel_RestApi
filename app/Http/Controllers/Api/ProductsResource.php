<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class ProductsResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $products=DB::select("select * from products");
       return json_encode($products, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { $result=false;
        if($request->has('uuid') & $request->has('name') & $request->has('price') & $request->has('comments')){

        $result=DB::insert("INSERT INTO products (uuid, name, price, comments ) VALUES (:uuid, :name, :price, :comments)",
            [   'uuid'=>$request->input('uuid'),
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'comments'=>$request->input('comments')
            ]);

    }

       return  json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products=DB::select("select * from products where id = :id", ['id'=>$id]);
        return json_encode($products, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result=DB::update("UPDATE products SET uuid = :uuid, name= :name, price=:price, comments= :comments WHERE id= :id",
        [
            'id'=>$id,
            'uuid'=>$request->input('uuid'),
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'comments'=>$request->input('comments')
        ]);
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result=DB::delete("DELETE FROM products WHERE id=:id", [ 'id'=>$id]);
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}

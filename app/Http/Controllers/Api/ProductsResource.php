<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
//use DB;
class ProductsResource
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /*$products=DB::select("select * from products");
       return json_encode($products, JSON_UNESCAPED_UNICODE);*/
        $products=Product::all();
        return $products->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { /*$result=false;
        if($request->has('uuid') & $request->has('name') & $request->has('price') & $request->has('comments')){

        $result=DB::insert("INSERT INTO products (uuid, name, price, comments ) VALUES (:uuid, :name, :price, :comments)",
            [   'uuid'=>$request->input('uuid'),
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'comments'=>$request->input('comments')
            ]);

    }
       return  json_encode($result, JSON_UNESCAPED_UNICODE);*/
        if($request->has('uuid')){
            $uuid=$request->input('uuid');
            $product=Product::find($uuid);
            if(!is_null($product)){
                return json_encode(['error'=>'Продукт с данным uuid уже существует'], JSON_UNESCAPED_UNICODE);
            }
            else{
                $product=new Product;
                $product->uuid=$uuid;
                $product->name=$request->input('name');
                $product->price=$request->input('price');
                $product->comments=$request->input('comments');
                $product->save();
                return json_encode(['response'=>'Добавляем товар с uuid='.$uuid], JSON_UNESCAPED_UNICODE);
            }
        }
        return json_encode(['error'=>' uuid не передан'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*$products=DB::select("select * from products where id = :id", ['id'=>$id]);
        return json_encode($products, JSON_UNESCAPED_UNICODE);*/
        $products=Product::where('uuid','like', $id)->get();
        return $products->toJson(JSON_UNESCAPED_UNICODE);
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
       /* $result=DB::update("UPDATE products SET uuid = :uuid, name= :name, price=:price, comments= :comments WHERE id= :id",
        [
            'id'=>$id,
            'uuid'=>$request->input('uuid'),
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'comments'=>$request->input('comments')
        ]);
        return json_encode($result, JSON_UNESCAPED_UNICODE);*/
        if($request->has('uuid')){
            $uuid=$request->input('uuid');
            $product=Product::find($uuid);
            if(is_null($product)){
                return json_encode(['error'=>'Продукт с данным uuid не найден'], JSON_UNESCAPED_UNICODE);
            }
            else{
              //  $product=new Product;
                $product->uuid=$uuid;
                $product->name = $request->input('name');
                $product->price=$request->input('price');
                $product->comments=$request->input('comments');
                $product->save();
                return json_encode(['response'=>'Обновлён товар с uuid='.$uuid], JSON_UNESCAPED_UNICODE);
            }
        }
        return json_encode(['error'=>' uuid не передан'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        /*$result=DB::delete("DELETE FROM products WHERE id=:id", [ 'id'=>$id]);
        return json_encode($result, JSON_UNESCAPED_UNICODE);*/
        $product=Product::destroy($uuid);
        return json_encode(['response'=>' Товар с uuid='.$uuid.'удалён из базы'], JSON_UNESCAPED_UNICODE);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\product;

class ProductController extends Controller
{
    function index()
    {
        // $productList = product::all();
        $perPage = 10;
        $productList = product::paginate($perPage);
        if ($productList) {
            return response()->json(['status' => true, 'products' => $productList, 'code' => 200]);
        } else {
            return response()->json(['status' => false, 'products' => "error while getting product list", 'code' => 201]);
        }
    }

    function getProductByProductId($id = null)
    {
        $product = $id ? product::find($id) : product::all();
        if ($product) {
            return response()->json(['status' => true, 'products' => $product, 'code' => 200]);
        } else {
            return response()->json(['status' => false, 'products' => "error while fetching record ", 'code' => 201]);
        }
    }

    function addProduct(Request $request)
    {
        $validate = validator::make($request->all(), [
            'title' => 'required|max:100',
        ]);
        if ($validate->fails()) {
            return response()->json(['status' => false, 'error' => $validate->errors(), 'code' => 200]);
        } else {

            $product = new product();
            $product->title = $request->title;

            $result = $product->save();
            if ($result) {
                return response()->json(['status' => true, 'message' => "product added successfully !", 'code' => 200]);
            } else {
                return response()->json(['status' => false, 'message' => "error while adding product ", 'code' => 201]);
            }
        }
    }

    function updateProduct(Request $request)
    {
        $product = product::find($request->id);
        $product->title =  $request->title;
        $product->id   = $request->id;

        $result = $product->save();
        if ($result) {
            return response()->json(['status' => true, 'message' => "product updated successfully !", 'code' => 200]);
        } else {
            return response()->json(['status' => false, 'message' => "error while updating product ", 'code' => 201]);
        }
    }

    function search($search){
        $result = product::where("title","LIKE","%".$search."%")->get();
        if ($result) {
            return response()->json(['status' => true, 'data' => $result, 'code' => 200]);
        } else {
            return response()->json(['status' => false, 'message' => "No product found ", 'code' => 201]);
        }
    }

    function deleteProduct($id){
        $result = product::where("id",$id)->delete();
        if ($result) {
            return response()->json(['status' => true, 'message' => "Product Deleted successfully ", 'code' => 200]);
        } else {
            return response()->json(['status' => false, 'message' => "Error while deleting product ", 'code' => 201]);
        }
    }
}

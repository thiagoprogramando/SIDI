<?php

namespace App\Http\Controllers\Price;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    
    public function products(Request $request) {

        $query = Product::orderBy('name', 'asc');

        if(!empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if(!empty($request->description)) {
            $query->where('description', 'like', '%' . $request->description . '%');
        }

        $products = $query->paginate(30);

        return view('app.price.product', [
            'products' => $products
        ]);
    }

    public function createProduct(Request $request) {

        $product                = new Product();
        $product->name          = $request->name;
        $product->description   = $request->description;
        $product->value         = $this->formatarValor($request->value);

        if($product->save()) {
            return redirect()->back()->with('success', 'Produto cadastrado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível cadastrar Produto!');
    }

    public function updateProduct(Request $request) {

        $product                = Product::find($request->id);
        if(!$product) {
            return redirect()->back()->with('info', 'Produto não encontrado!');
        }
        $product->name          = $request->name;
        $product->description   = $request->description;
        $product->value         = $this->formatarValor($request->value);

        if($product->save()) {
            return redirect()->back()->with('success', 'Produto atualizado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível atualizar o Produto!');
    }

    private function formatarValor($valor) {
        
        $valor = preg_replace('/[^0-9,]/', '', $valor);
        $valor = str_replace(',', '.', $valor);
        $valorFloat = floatval($valor);
    
        return number_format($valorFloat, 2, '.', '');
    } 
}

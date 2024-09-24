<?php

namespace App\Http\Controllers\Price;

use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class PriceController extends Controller {
    
    public function price(Request $request) {

        if($request->client_id) {

            $client = User::find($request->client_id);
            if($client) {

                $query = Price::where('client_id', $client->id)->orderBy('created_at', 'asc');

                if(!empty($request->dateStart)) {
                    $query->whereDate('created_at', '>=', $request->dateStart);
                }

                if(!empty($request->dateEnd)) {
                    $query->whereDate('created_at', '<=', $request->dateEnd);
                }

                if (!empty($request->product_id)) {
                    $query->where('product_id', $request->product_id);
                }

                return view('app.price.price', [
                    'client'    => $client,
                    'prices'    => $query->get(),
                    'products'  => Product::all()
                ]);
            }

            return redirect()->back()->with('info', 'Não foram encontrados dados do cliente!');
        }

        return view('app.price.price', [
            'users'     => User::where('role', 'client')->get(),
        ]);
    }

    public function createPrice(Request $request) {

        $validatedData = $request->validate([
            'client_id'     => 'required',
            'product_id'    => 'required',
        ], [
            'client_id.required'  => 'Escolha um Cliente!',
            'product_id.required' => 'Escolha um Produto!',
        ]);

        $client = User::find($request->client_id);
        if(!$client) {
            return redirect()->back()->with('info', 'Não foram encontrados dados do cliente!');
        }

        $product = Product::find($request->product_id);
        if(!$product) {
            return redirect()->back()->with('info', 'Não foram encontrados dados do produto!');
        }

        $price              = new Price();
        $price->client_id   = $client->id;
        $price->product_id  = $product->id;
        $price->amount      = $request->amount;
        $price->created_at  = $request->created_at;
        $price->value       = $client->isento == 1 ? 0 : ($request->amount * $product->value);

        if($price->save()) {
            return redirect()->back()->with('success', 'Cotação cadastrada com sucesso!');
        }

        return redirect()->back()->with('error', 'Não possível cadastrar cotação!');
    }

    public function updatePrice(Request $request) {

        $price = Price::find($request->id);
        if($price) {

            $client = User::find($price->client_id);
            if(!$client) {
                return redirect()->back()->with('info', 'Não foram encontrados dados do cliente!');
            }

            $product = Product::find($price->product_id);
            if(!$product) {
                return redirect()->back()->with('info', 'Não foram encontrados dados do produto!');
            }

            if($request->amount) {
                $price->amount = $request->amount;
            }
            
            if($request->created_at) {
                $price->created_at = $request->created_at;
            }
            
            $price->value = $client->isento == 1 ? 0 : ($request->amount * $product->value);
            if($price->save()) {
                return redirect()->back()->with('success', 'Cotação atualizada com sucesso!');
            }

            return redirect()->back()->with('error', 'Não possível cadastrar cotação!');
        }

        return redirect()->back()->with('info', 'Não foram encontrados dados da cotação!');
    }

    public function deletePrice(Request $request) {

        $price = Price::find($request->id);
        if($price && $price->delete()) {
            return redirect()->back()->with('success', 'Cotação excluída com sucesso!');
        }

        return redirect()->back()->with('info', 'Não foram encontrados dados da cotação!');
    }
}

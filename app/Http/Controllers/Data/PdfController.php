<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;

use App\Models\Price;
use App\Models\Product;
use App\Models\User;

use Dompdf\Dompdf;
use Dompdf\Options;

use Illuminate\Http\Request;

class PdfController extends Controller {
    
    public function pricePdf(Request $request) {

        $query = Price::where('client_id', $request->client_id)->orderBy('created_at', 'asc');

        if(!empty($request->dateStart)) {
            $query->whereDate('created_at', '>=', $request->dateStart);
        }

        if(!empty($request->dateEnd)) {
            $query->whereDate('created_at', '<=', $request->dateEnd);
        }

        if (!empty($request->product_id)) {
            $query->where('product_id', $request->product_id);
        }

        $prices = $query->get();

        $client  = $request->client_id != null ? User::find($request->client_id) : null;
        $product = $request->product_id != null ? Product::find($request->product_id) : null;

        return view('app.price.pdf.price', [
            'prices'     => $prices,
            'dateStart'  => $request->dateStart,
            'dateEnd'    => $request->dateEnd,
            'client'     => $client != null ? $client : '---',
            'product'    => $product != null ? $product : '---',
        ]);
    }
}

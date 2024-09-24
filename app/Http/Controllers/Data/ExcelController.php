<?php

namespace App\Http\Controllers\Data;

use App\Exports\PriceExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller {
    
    public function priceExcel(Request $request) {
        return Excel::download(new PriceExport($request), 'Cotação.xlsx');
    }
}

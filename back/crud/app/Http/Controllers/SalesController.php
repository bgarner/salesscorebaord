<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Sales;


class SalesController extends Controller
{
    public function getSales( $banner ) {
        
        return Sales::getSales( $banner );

    }

    public function editSales( $banner ) {

        $sales = json_decode(Sales::getSales( $banner ));
        return view('editSales')->with('sales', $sales);

    }

    public function saveSales(Request $request) {

        $json   = json_decode($request->input('file') );
        $banner = $json->banner;
        $file   = $json;
        Sales::saveSales($banner, $json);
        return;

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Pie;


class PieController extends Controller
{
    public function getPie( $banner ) {
        
        return Pie::getPie( $banner );

    }

    public function editPie( $banner ) {

        $pie = json_decode(Pie::getPie( $banner ));
        return view('editPie')->with('pie', $pie);

    }

    public function savePie(Request $request) {

        $json   = json_decode($request->input('file') );
        $banner = $json->banner;
        $file   = $json;
        Pie::savePie($banner, $json);
        return;

    }
}

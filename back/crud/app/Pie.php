<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pie extends Model
{
    public static function getPie( $banner ) {
    	
    	$json = file_get_contents('files/pie/'. $banner .'.json');
    	return( $json );

    }

    public static function savePie( $banner , $file) {
        
    	$banner = strtolower($banner);
    	file_put_contents("/Applications/XAMPP/xamppfiles/htdocs/salesscoreboard/back/crud/public/files/pie/".$banner.".json", json_encode($file));
        return;   	
    }

}

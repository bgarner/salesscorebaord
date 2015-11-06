<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    public static function getSales( $banner ) {
    	
    	$json = file_get_contents('files/'. $banner .'.json');
    	return( $json );

    }

    public static function saveSales( $banner , $file) {
        
        $banner = strtolower($banner);
    	file_put_contents("/var/www/html/salesscoreboard/back/crud/public/files/".$banner.".json", json_encode($file)); 
        return;   	
    }

}

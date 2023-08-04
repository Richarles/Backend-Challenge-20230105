<?php

if (! function_exists('convertByts')) {
    function  convertByts($size,$unit){
        if($unit == "KB")
        {
        return  round($size / 1024,4) . 'KB';	
        }
        if($unit == "MB")
        {
        return  round($size / 1024 / 1024,4) . 'MB';	
        }
        if($unit == "GB")
        {
        return  round($size / 1024 / 1024 / 1024,4) . 'GB';	
        }
    }
}

if (! function_exists('dateInterval')) {
    function dateInterval(){
        $dateStart = strtotime(date('H:i:s',$_SERVER["REQUEST_TIME"]));
        $dateEnd = (strtotime(date('H:i:s')));

        $timeServerHttp = gmdate('H:i:s',$dateEnd-$dateStart);

        return $timeServerHttp.'seg';
    }
}
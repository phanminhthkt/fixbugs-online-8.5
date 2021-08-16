<?php 
namespace App\Http\Helpers;

class helpers {
	public static function reOrderPermission($arr){
        $newArr=[];
        foreach ($arr as $k => $v) {
        	if($v['action']=='view'){
        		$newArr[0] = $v;
        	}elseif($v['action']=='create'){
        		$newArr[1] = $v;
        	}elseif($v['action']=='update'){
        		$newArr[2] = $v;
        	}elseif($v['action']=='delete'){
        		$newArr[3] = $v;
        	}
        }
        ksort($newArr);
        return $newArr;
    }
}
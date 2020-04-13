<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{


    public function index(){
        $dirList = scandir(app_path());
        $models = [];
        foreach ($dirList as $file){
            if(strpos($file,".php") !== false){
                $models[] = str_replace(".php","", $file)."s";
            }
        }
        return view("admin/admin", array("models"=>$models));
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function list($type){
        if(!Schema::hasTable($type)){
         abort(404);
        }
        return view("admin/list",array("type"=>$type));
    }
}

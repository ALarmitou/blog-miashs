<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    public function index(){
        $dirList = scandir(app_path());
        $models = [];
        foreach ($dirList as $file){
            if(strpos($file,".php") !== false){
                $name = str_replace(".php", "", $file) . "s";
                if(Route::has('admin.'.strtolower($name).'.index')) {
                    $models[] = $name;
                }
            }
        }
        return response()->json($models,200);
    }
}

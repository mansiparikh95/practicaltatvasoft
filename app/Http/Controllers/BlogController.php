<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use Illuminate\Support\Facades\Response;
use App\User;
use App\Model\Blog;
use App\Model\BlogTags;
use App\Helpers\Helper;


class BlogController extends Controller
{
    public function index(){

    	return view('/');
    }

    public static function postList(Request $request){ 
        try{           
           return Blog::list($request);
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return view('/');
        } 
    }


    
}

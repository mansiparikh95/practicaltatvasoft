<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\Helper;
use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Yajra\DataTables\DataTables;
use URL;
use Illuminate\Support\Str;
use App\Model\BlogTags;
use Auth;

class Blog extends Model
{
    protected $table = 'blogs';

    public function tags(){
        return $this->hasMany('App\Model\BlogTags','blog_id','id');
    }
    

    public static function createEdit($request,$id=''){
        $info = Blog::find($id);
        if($id !=''){            
            $data = Blog::find($id);

            if(isset($request->tag) && $request->tag != ""){
                $del = BlogTags::where('blog_id',$id)->delete();
            }
        }else{
            $data = new Blog();
        }
        $data->user_id = Auth::user()->id;
        $data->title = isset($request->title)?$request->title:''; 
        $data->description = isset($request->description)?$request->description:NULL; 

        if(isset($request->image) && $request->image !=''){

            # Unlink Image 
            /*if(isset($info->image) && $info->image !=''){
                $imagePath = Helper::blogFileUploadPath().$info->file;
                if(file_exists($imagePath)){
                    unlink($imagePath);    
                }
            }*/
            $filepath  = $request->image;
            $filepathName = 'Blog-'.uniqid().time().'.'. $filepath->getClientOriginalExtension();
            $filepath->move(Helper::blogFileUploadPath(), $filepathName); 
            
            $data->image = $filepathName;
            
        }          
        $data->save();
        
        // Save Multiple Tags from here
        if(isset($request->tag) && !empty($request->tag)){
            foreach($request->tag as $key=>$val){
                $pr = new BlogTags();
                $pr->blog_id = $data->id;
                $pr->user_id = Auth::user()->id;
                $pr->tags = $val;
                $pr->save();

            }
        }        
        return $data;
    }

    public static function postList($request){        
        $query = Blog::with('tags');
        if($request->order ==null){
            $query->orderBy('blogs.id','desc');
        }        
        $searcharray = array();     
        parse_str($request->fromValues,$searcharray); 
        return Datatables::of($query)  
            ->addColumn('image', function ($data) {
               return Helper::getImage($data->image);                
            })
            ->addColumn('tags', function ($data) {                
               $as = BlogTags::tags($data->id); 
               return $as;     
             })
             ->addColumn('description', function ($data) {                
               $description = substr($data->description, 0, 100).'...';
               return $description;     
             })            
            ->addColumn('action', function ($data) {
                if($data->user_id == Auth::user()->id){
                    $editLink = URL::to('/').'/admin/blog/'.$data->id.'/edit'; 
                    $deleteLink = $data->id;
                } 
                else{
                    $editLink = ''; 
                    $deleteLink = '';
                }              
                
               return Helper::Action($editLink,$deleteLink,'');     
             }) 
            ->rawColumns(['action','tags','image','description'])
            ->make(true);
    }

    public static function list($request){        
        $query = Blog::with('tags');
        if($request->order ==null){
            $query->orderBy('blogs.id','desc');
        }        
        $searcharray = array();     
        parse_str($request->fromValues,$searcharray); 
        return Datatables::of($query)  
            ->addColumn('description', function ($data) {                
               $description = substr($data->description, 0, 100).'...';
               return $description;     
             })
            ->addColumn('image', function ($data) {
               return Helper::getImage($data->image);                
            })
            ->addColumn('tags', function ($data) {                
               $as = BlogTags::tags($data->id); 
               return $as;     
             })          
            
            ->rawColumns(['tags','image','description'])
            ->make(true);
    }
}

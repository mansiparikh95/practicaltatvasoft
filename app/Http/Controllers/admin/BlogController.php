<?php

namespace App\Http\Controllers\admin;

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

    	return view('admin.blog.index');
    }

    public static function postList(Request $request){ 
        try{           
           return Blog::postList($request);
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('blog.index');
        } 
    }

    public function create(){        
        return view('admin.blog.create');
    }

    public function store(Request $request){        
        try{       
            $validator = Validator::make($request->all(), [
                'title'=>'required|max:255',
                'description'=>'required|max:65535',
                'tag'=>'required',
                'image'=>'max:100',
            ]);

            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            DB::transaction(function () use ($request) {
                Blog::createEdit($request);            
            });
             
            session()->flash('success',  'Blog created successfully');
            return redirect()->route('blog.index');
        }catch(\Exception $e){                  
            session()->flash('error',$e->getMessage());
            return back()->withInput();
        }
    }

    public function edit($id){
        try{
            
            $data = Blog::find($id); 
            $tags = BlogTags::where('blog_id',$id)->get();
            
            return view('admin.blog.edit',compact('data','tags'));
        }catch(\Exception $e){                  
            session()->flash('error',$e->getMessage());
            return redirect()->route('blog.edit',$id);
        }
    }

    public function update(Request $request, $id){
        try{       
            $validator = Validator::make($request->all(), [
                'title'=>'required|max:255',
                'description'=>'required|max:65535',
                'tag'=>'required',
                'image'=>'max:100',
            ]);

            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
           
            DB::transaction(function () use ($request,$id) {
                Blog::createEdit($request,$id);            
            });
             
            session()->flash('success',  'Blog details updated successfully');
            return redirect()->route('blog.index');
        }catch(\Exception $e){                  
            session()->flash('error',$e->getMessage());
            return back()->withInput();
        }
    }   

    public function destroy($id){
        try{
            $blog = Blog::find($id);
            $data_del = Blog::where('id',$id)->delete();
            BlogTags::where('blog_id',$id)->delete();
            if(isset($blog->image) && $blog->image !=''){
                $imagePath = Helper::blogFileUploadPath().$blog->file;
                if(file_exists($imagePath)){
                    unlink($imagePath);    
                }
            }

            return Response::json($data_del);
        }catch(\Exception $e){
            return Response::json($e);
        }     
    }   

    
}

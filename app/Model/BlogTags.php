<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\Helper;
use URL;
use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use App\User;
use App\Model\Blog;

class BlogTags extends Model
{
    protected $table = 'blog_tags';

    public static function tags($id){
    	$as = BlogTags::where('blog_id',$id)->get();
    	$title = '';
    	foreach($as as $key=>$val){    		
    		$title.= $val->tags.',';
    	}
    	return $title;
    }

}

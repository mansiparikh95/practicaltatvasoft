<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Yajra\DataTables\DataTables;
use App\Helpers\Helper;
use URL;
use DB;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->hasOne('App\Model\Role','id','role_id');
    }

    public static function postList($request){
        $query = User::with('role');
        if($request->order ==null){
            $query->orderBy('users.id','desc');
        }    

        $searcharray = array();     
        parse_str($request->fromValues,$searcharray); 
        return Datatables::of($query)            
            ->addColumn('action', function ($data) {                
               $editLink = URL::to('/').'/admin/users/'.$data->id.'/edit';                  
               $viewLink = URL::to('/').'/admin/users/'.$data->id;
               $deleteLink = $data->id; 
               return Helper::Action($editLink,$deleteLink,$viewLink);     
             }) 
            ->rawColumns(['action'])
            ->make(true);
    }

    public static function createEdit($request,$id=''){

        $info = User::find($id);
        if($id !=''){
            $data = User::find($id);

        }else{
            $data = new User();
        }
        $data->name = isset($request->name)?$request->name:'';  
        $data->email = isset($request->email)?$request->email:'';  
        $data->password = isset($request->password)?Hash::make($request->password):'';     
        $data->role_id = isset($request->role_id)?$request->role_id:'';  
        $data->save();
        return $data;
    }
}

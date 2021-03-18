<?php

namespace App\Helpers;
use Request;
use App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use URL;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator; 

class Helper {

    public static function res($data, $msg, $code) {
        $response = [
            'status' => $code == 200 ? true : false,
            'code' => $code,
            'msg' => $msg,
            'version' => '1.0.0',
            'data' => $data
        ];
        return response()->json($response, $code);
    }

    public static function success($data = [], $msg = 'Success', $code = 200) {
        return Helper::res($data, $msg, $code);
    }

    public static function fail($data = [], $msg = "Some thing wen't wrong!", $code = 203) {
        return Helper::res($data, $msg, $code);
    }

    public static function error_parse($msg) {
        foreach ($msg->toArray() as $key => $value) {
            foreach ($value as $ekey => $evalue) {
                return $evalue;
            }
        }
    }

    public static function active($param = "") {
        return Request::path() == $param ? 'active open' : '';
    }
      
    
    public static function Action($editLink = '', $deleteID = '', $viewLink = '',$recoverylink='',$emailLink='',$progressLink='',$email='') {
        if ($editLink)
            //$edit = '<a href="' . $editLink . '"  data-toggle="tooltip" title="Edit"> <i class="la la-edit"></i></a>';
            $edit = '<a href="' . $editLink . '"  data-toggle="tooltip" title="Edit" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>';
        else
            $edit = '';

        if ($deleteID)
            $delete = '<a onclick="deleteValueSet(' . $deleteID . ')"  class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Delete" data-toggle="modal" data-target="#kt_modal_1" >  <i class="la la-trash"></i></a>';
        else
            $delete = '';

        if ($viewLink)
            $view = '<a href="' . $viewLink . '" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="tooltip" title="View"><i class="la la-eye"></i></a>';
        else
            $view = '';
        
        if ($recoverylink)
            $recovery = '<a onclick="deleteValueSet(' . $recoverylink . ')"  class="btn btn-sm btn-clean btn-icon btn-icon-md"  data-toggle="modal" data-target="#kt_modal_2" data-toggle="tooltip" title="Clear Deceased">  <i class="la la-eraser"></i></a>';
        else
            $recovery = '';
        
        if ($emailLink)
            $email1 = '<a  id='.$emailLink.' email='.$email.' onclick="deleteValueSet(' . $emailLink . ')"  class="btn btn-sm btn-clean btn-icon btn-icon-md sendemailtouser"  data-toggle="modal" data-target="#kt_modal_3" data-toggle="tooltip" title="Send Email" >  <i class="la la-envelope"></i></a>';
        else
            $email1 = '';
        
        if ($progressLink)
            $progress = '<a href="' . $progressLink . '" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="tooltip" title="Progress"><i class="la la-area-chart"></i></a>';
        else
            $progress = '';
        
        return $view . '' . $edit . '' . $delete . '' .$recovery .''.$email1 .''.$progress.'';
    }    
    
    public static function getTimezone(){
        if(Session::get('customTimeZone') && Session::get('customTimeZone') !='')
            return Session::get('customTimeZone');
        else
            return "Europe/Berlin";
    }

    public static function blogFileUploadPath(){
        return storage_path('app/public/blog/');
    }    
   
    public static function displayBlogPath(){
      return URL::to('/').'/storage/blog/';
    }

    public static function getImage($image){
        if(isset($image) && $image!=''){
            $url = Helper::displayBlogPath().''.$image;
            return '<div class="kt-user-card-v2">
                    <div class="kt-user-card-v2__pic">
                        <img src="'.$url.'" class="m-img-rounded kt-marginless profile_cls" alt="photo">
                    </div>                    
                </div>';
        }
    }
    
}

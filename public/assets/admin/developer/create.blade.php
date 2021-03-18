<?php

use Request as Input; 
use App\Helpers\Helper;

$fieldTypes = Helper::timeSheetFieldType();
$option  = "";

if(isset($fieldTypes) && count($fieldTypes) > 0 ){
    foreach ($fieldTypes as $key => $value) {
        $option .= '<option value="'.$key.'" >'.$value.'</option>';
    }
}



?>
@extends('layouts.master')
@section('title','Create '.$data['title'])
@section('css')
@endsection
@section('content')

<style type="text/css">
    .kt-section__body .col-form-label {
        padding-left: 0;
        padding-right: 0;
    }
    .decrease_padding {
        padding: 0 25px !important;
    }
    .row {
        margin-left: 0;
        margin-right: 0;
    }
    .decrease_padding .bg-light {
        background-color: #f1f1f1 !important;
    }
    .remove_left_padding {
        padding-left: 0;
    }
    .remove_total_padding {
        padding: 0;
    }
    .status_padding {
        padding-left: 0;
    }
    .margin_left_auto {
        width: 100%;
    }
    .margin_left_auto .kt-menu__link {
        margin-left: auto !important; 
    }

    @media screen and (max-width: 1440px) {
    	.remove_side_padding {
	    	padding-left: 0 !important;
	    	padding-right: 0 !important;
	    }
    }
    @media screen and (max-width: 1024px) {
        #kt_header_menu_wrapper {
            position: relative;
            width: 100% !important;
            left: 0;
            margin-top: 50px;
            box-shadow: none;
        }
        #kt_header_menu_wrapper .kt-header-menu-mobile .kt-menu__nav {
            padding: 0;
        }
        #kt_header_menu_wrapper.kt-header-menu-wrapper .kt-header-menu .kt-menu__nav > .kt-menu__item {
            display: inline-block;
        }
        .kt-header-mobile--fixed .kt-header__topbar {
            top: 0;
        }
        .kt-header__topbar--mobile-on .kt-header__topbar {
            top: 50px;
            z-index: 9999;
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }
    }
    @media screen and (max-width: 991px) {
        .top_mobile_margin {
            margin-top: 20px;
        }
    }
</style>

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <a href="{{route('timesheet-types.index')}}"><h3 class="kt-subheader__title">{{$data['title']}}</h3></a>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                <span class="kt-subheader__desc">Create {{$data['title']}}</span>
            </div>
        </div>
    </div>

    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-md-12">
                <!--begin::Portlet-->
                @include('errormessage')
                <div class="kt-portlet">
                    
                    <div class="kt-portlet__body">
                        {!! Form::open(['route' => 'timesheet-types.store','class'=>'kt-form','id'=>'createform','name'=>'createform','enctype'=>'multipart/form-data']) !!}
                            <div class="tab-content">
                            <div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
                                <div class="kt-form kt-form--label-right">
                                <div class="kt-form__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group row pl-4 pr-5 decrease_padding">
                                            <label class="col-xl-1 col-lg-1 col-form-label text-left">Title</label>
                                            <div class="col-lg-3 col-xl-3">
                                                {!! Form::text('title',Input::old('title'), ['class' => 'form-control','id'=>"title",'name'=>'title','placeholder'=>'Type Title','autocomplete'=>'off']) !!} 
                                                <!-- <a href="javascript:void(0);" class="add_field_form kt-menu__link ">
                                                <span class="kt-menu__link-text">Add Field</span>
                                            </a> -->
                                            </div>
                                        </div>
                                        <div id="field_type_array" >
                                            <div class="kt-portlet__head">
                                                <div class="kt-portlet__head-label margin_left_auto">
                                                    <h3 class="kt-portlet__head-title">
                                                        Main Section
                                                    </h3>
                                                    <a id="main_section" class="btn btn-success ml-3 add_field_form kt-menu__link" style="color:#fff;">
                                                        Add Section
                                                    </a>
                                                </div>
                                            </div>
                                            
                                                <div id="field_array1"  class="row mt-3 pl-4 pr-4 decrease_padding">                               
                                                <div class="form-group col-xl-3 col-lg-3 remove_left_padding">
                                                    <div class="row">
                                                    <label class="col-3 col-form-label text-left">Title</label>
                                                    <div class="col-9 ">
                                                        {!! Form::text('field_title',Input::old('field_title'), ['class' => 'form-control','id'=>"field_title",'name'=>'main_section[field_title][]','placeholder'=>'Type Title','autocomplete'=>'off']) !!} 
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8 col-lg-8 row">
                                                <div class="form-group col-xl-4 col-lg-4 remove_side_padding">
                                                    <div class="row">
                                                    <label class="col-5 col-form-label text-nowrap">Answer Type</label>
                                                    <div class="col-7">
                                                        <select data-attr="1" class="form-control manage_type" id="type" name="main_section[type][]">
                                                            @foreach($fieldTypes as $key => $values)
                                                            <option value="{{$key}}">{{$values}}</option>
                                                            @endforeach  
                                                        </select> 
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8 col-lg-8">
                                                    <div class="row">
                                                        <div id="values1" class="col-md-6 remove_side_padding"  style="display:none;">
                                                            <div class="row">
                                                             <label class="col-4 col-form-label text-left">Option(s)</label>
                                                            <div class="col-8">
                                                                {!! Form::text('title',Input::old('title'), ['class' => 'form-control','id'=>"options",'name'=>'main_section[options][]','placeholder'=>'Comma separated','autocomplete'=>'off']) !!} 
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-6 remove_side_padding">
                                                            <div class="row">
                                                             <label class="col-4 col-form-label text-right text-nowrap">Sort Order</label>
                                                    <div class="col-8">
                                                        {!! Form::text('sort_order',Input::old('sort_order'), ['class' => 'form-control sort_order','id'=>"sort_order",'name'=>'main_section[sort_order][]','placeholder'=>'#','autocomplete'=>'off']) !!} 
                                                    </div>
                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                               <!--  <div id="values1" class="form-group col-xl-8 col-lg-8" style="display:none;">
                                                    <div class="row">
                                                        <div class="col-md-6 order-1">
                                                            <div class="row">
                                                    <label class="col-4 col-form-label text-left">Option(s)</label>
                                                    <div class="col-8">
                                                        {!! Form::text('title',Input::old('title'), ['class' => 'form-control','id'=>"options",'name'=>'options[]','placeholder'=>'Options (comma separated)','autocomplete'=>'off']) !!} 
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                    <label class="col-4 col-form-label text-left text-nowrap">Sort Order</label>
                                                    <div class="col-8">
                                                        {!! Form::text('title',Input::old('title'), ['class' => 'form-control','id'=>"options",'name'=>'options[]','placeholder'=>'Options (comma separated)','autocomplete'=>'off']) !!} 
                                                    </div>
                                                </div>
                                                </div>
                                                </div>
                                            </div> -->
                                            <div class="col-xl-1 col-lg-1">
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Visit Section Start Here -->
                                        <div class="visit_time" >
                                            <div id="visit_section_div" >
                                                <div class="kt-portlet__head">
                                                    <div class="kt-portlet__head-label margin_left_auto">
                                                        <h3 class="kt-portlet__head-title">
                                                            Visit
                                                        </h3>
                                                        <a id="visit_section" class="btn btn-success ml-3 add_field_form kt-menu__link" style="color:#fff;">
                                                            Add Section
                                                        </a>
                                                    </div>
                                                </div>

                                                <!-- HTML section start here -->
                                                <div id="field_array1"  class="row mt-3 pl-4 pr-4">

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                        </div>
                                    <!-- Visit Section Ends Here -->    
                                        <div class="activity">
                                            <div class="kt-portlet__head">
                                                <div class="kt-portlet__head-label">
                                                    <h3 class="kt-portlet__head-title">
                                                        Activities
                                                    </h3>
                                                    <!-- <input type="checkbox" data-id="check-all" class="custom_permission_checkbox list ml-2 mt-2" id="checkall" name="checkall"/> -->
                                                </div>
                                            </div>
                                          <div class="form-group row pl-5 pr-5 decrease_padding">
                                            
                                            <div class="col-lg-12 col-xl-12 remove_total_padding">
                                                <div class="row">
                                                  
                                                @foreach($activities as $value)
                                                <div class="col-md-3 mt-2 remove_left_padding">
                                                    <div class="bg-light p-3">
                                                    <span>{{$value->title}}</span>
                                                        <input type="checkbox" data-id="{{ $value->activity_id }}" class="activities custom_permission_checkbox float-right" id="activity_{{ $value->activity_id}}" name="activities[{{ $value->activity_id}}]" />
                                                    </div>
                                                    
                                                </div>
                                                @endforeach
                                             <!--    </tbody>
                                            </table>  -->
                                             </div>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="form-group row decrease_padding">
                                            <label class="col-form-label status_padding">Status</label>
                                            <div class="col-lg-4 col-xl-6">
                                                <select class="form-control" id="status" name="status">                             
                                                    <option value="1" >Active</option>  
                                                    <option value="0" >Inactive</option>  
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions ">
                                    <div class="row">
                                        <!-- <div class="col-lg-3 col-xl-3"></div> -->
                                        <div class="col-lg-6 col-xl-12">
                                        <button type="submit" class="btn btn-primary submitbutton">Save</button>
                                        <a href="{{route('timesheet-types.index')}}"><button type="button" class="btn btn-secondary cancelbutton">Cancel</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {!!Form::close()!!}
                    </div>
                </div>
                <!--end::Portlet-->
            </div> 
        </div>
    </div>



    <!-- end:: Content -->
</div>
@section('script')
<script>

    $(document).ready(function () {

        $('#createform').validate({
            rules: {
                title: {
                    required: true,
                    maxlength: 50,
                },
                "activities[]":{
                    required:true,
                },
                status:{
                    required:true,
                }
            },
            submitHandler: function (form) {
                if ($("#createform").validate().checkForm()) {
                    $(".submitbutton").attr("type", "button");
                    $(".cancelbutton").addClass("disabled");
                    $(".submitbutton").addClass("disabled kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
                    form.submit();
                }
            }
        });

        var fieldTypes = '<?php echo $option; ?>';
        $(document).on("click", ".add_field_form",function() {
            
            var div_id = this.id;
            var main_div = (div_id == 'visit_section') ? 'visit_section_div' : 'field_type_array';

            var type_file = (div_id == 'visit_section') ? "manage_section_type" : 'manage_type';
            var option_div =  (div_id == 'visit_section') ? 'visit_sec' : 'values';

            

          var div_length = parseInt($("#"+main_div).children().length)+1;
          var html = '<div id="'+this.id+div_length+'" class="row pl-4 pr-4 top_mobile_margin">';

            /* Title Field*/
            html +='<div class="form-group col-xl-3 col-lg-3">';
                html +='<div class="row"><label class="col-3 col-form-label text-left">Title</label>';
                html +='<div class="col-9">';
                        html +='<input class="form-control" id="field_title" name="'+this.id+'[field_title][]" placeholder="Field Title" autocomplete="off" type="text">';
                html +='</div></div>';
            html +='</div>';

            /* Field Type */
            html +='<div class="col-xl-8 col-lg-8 row"><div class="form-group col-xl-4 col-lg-4 remove_side_padding"><div class="row">';
                html +='<label class="col-5 col-form-label text-right">Answer Type</label>';
                html +='<div class="col-7">';
                        html +='<select data-attr="'+div_length+'" class="form-control '+type_file+'" id="type" name="'+this.id+'[type][]">';
                            /*html +='<option value="1" >Textbox</option>';
                            html +='<option value="2" >Radio</option>';
                            html +='<option value="3" >Checkbox</option>';
                            html +='<option value="4" >Textarea</option>';
                            html +='<option value="5" >Select</option>';*/
                            html +=fieldTypes;
                        html +='</select>';
                html +='</div></div></div>';
                /* Title Field*/
            html +='<div class="form-group col-xl-8 col-lg-8"><div class="row"><div id="'+option_div+div_length+'" style="display:none;" class="col-md-7 remove_side_padding"><div class="row">';
                html +='<label class="col-3 col-form-label text-left">Option(s)</label>';
                html +='<div class="col-9">';
                        html +='<input class="form-control" id="options" name="'+this.id+'[options][]" placeholder="Comma separated" autocomplete="off" type="text">';
                html +='</div>';
            html +='</div>';
            html +='</div><div class="col-md-5 remove_side_padding"><div class="row"><label class="col-5 col-form-label text-right remove_side_padding">Sort Order</label><div class="col-7"><input class="form-control sort_order"  maxlength="2" id="sort_order" name="'+this.id+'[sort_order][]" placeholder="#" autocomplete="off" type="text"></div></div></div></div></div></div>';

            html +='<div class="col-lg-1 text-right" id="'+this.id+div_length+'"><a href="javascript:void(0);" class="remove_field kt-menu__link btn btn-danger"><span class="kt-menu__link-text" id="">Remove</span></a></div>';

          html += '</div>';
          $("#"+main_div).append(html);

        });

        $(document).on("keypress", ".sort_order",function(e) {
             //if the letter is not digit then display error and don't type anything
             if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                console.log('test');
                       return false;
            }
        });

        $(document).on("click", ".remove_field",function() {            
            $("#"+$(this).parent().attr('id')).remove();
        });

        $(document).on("change", ".manage_type",function() {            
            if(this.value == 2 || this.value == 3 || this.value == 5){
                $("#values"+$(this).attr('data-attr')).show();
            }else{
                $("#values"+$(this).attr('data-attr')).hide();
            }
        });

        $(document).on("change", ".manage_section_type",function() {            
            if(this.value == 2 || this.value == 3 || this.value == 5){
                $("#values"+$(this).attr('data-attr')).show();
            }else{
                $("#values"+$(this).attr('data-attr')).hide();
            }

        });

    });

</script>
@endsection
@endsection

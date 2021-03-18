<?php use Request as Input; ?>
@extends('layouts.master')
@section('title','Edit Blog')
@section('css')
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <a href="{{route('blog.index')}}">
                    <h3 class="kt-subheader__title">Blog</h3>
                </a>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                <span class="kt-subheader__desc">Edit Blog</span>                
            </div>            
        </div>
    </div>
    <!-- end:: Content Head -->

    <!-- begin:: Content -->
   
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        @include('errormessage')
        <!--begin::Portlet-->
        <div class="kt-portlet">
            <!-- <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                       Create CMS
                    </h3>
                </div>
            </div> -->

            <!--begin::Form-->
            {{ Form::model($data, ['route' => ['blog.update',$data->id], 'method' => 'patch','id'=>'createform','name'=>'createform','class'=>'kt-form','enctype'=>'multipart/form-data']) }}                                                                                     
            @include('admin.blog.common')

            {!! Form::close() !!}
            <!--end::Form-->
        </div>              
    </div>
    <!-- end:: Content -->
</div>
@section('script')
<script src="{{url('assets/admin/js/pages/custom/user/profile.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('#createform').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255,
                },
                description: {
                    required: true,
                    maxlength: 65535,
                },
                tag: {
                    required: true,
                },                

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

        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row custom_div"><div class="col-md-12"><div class="form-group"><input type="text" name="tag[]" id="tag" value="" class="form-control"></div></div> <a href="javascript:void(0)" class="remove_field">Remove</a></div>');
            } 
            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).closest('.custom_div').remove(); x--;
            })
        });

        

        
    });

</script>

<script>
    $(document).ready(function () {
        $('#createform').validate({
            rules: {
                name: {
                    required: true,
                },
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

        $("#kt_select2_3").select2(); 

        $("#file_name" ).change(function() {
            if(document.getElementById("file_name").files.length ==1){
                var textlab = document.getElementById("file_name").files[0].name;
            }else{
                var textlab = document.getElementById("file_name").files.length+" Files Selected";
            }
            $(".custom-file-label").text(textlab);
        }); 
    });

</script>
@endsection
@endsection

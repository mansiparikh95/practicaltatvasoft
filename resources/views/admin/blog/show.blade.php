<?php use Request as Input; ?>
@extends('layouts.master')
@section('title','Role Details')
@section('css')
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <a href="{{route('role.index')}}">
                    <h3 class="kt-subheader__title">Role</h3>
                </a>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                <span class="kt-subheader__desc">Role Details</span>                
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
                       CMS Details
                    </h3>
                </div>
            </div> -->

            <div class="kt-portlet__body">
                <div class="kt-section kt-section--first">
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                               <label><strong>Name: </strong></label>
                                <label>{{isset($data->name)?ucfirst($data->name):''}}</label>
                            </div>
                        </div> 
                    </div> 
                </div>
            </div>              
    </div>
    <!-- end:: Content -->
</div>
@section('script')

@endsection
@endsection

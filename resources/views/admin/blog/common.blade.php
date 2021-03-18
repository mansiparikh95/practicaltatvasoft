<?php use Request as Input; 
use App\Helpers\Helper;
?>
<div class="kt-portlet__body">
    <div class="kt-section kt-section--first">
        <div class="kt-section__body">  
            <div class="row">
                <div class="form-group row">
                    <label>Profile Pic</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                            @if(isset($data) && $data->image != "")
                            <?php $url = Helper::displayBlogPath().''.$data->image; ?>
                            @else
                            <?php $url = URL::to('/').'/assets/admin/media/users/default.jpg'; ?>
                            @endif
                            <div class="kt-avatar__holder" style="background-image: url({{$url}})"></div>
                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change Profile Picture">
                                <i class="fa fa-pen"></i>
                                <input type="file" name="image" accept="image/*">
                            </label>
                            <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel Profile Picture">
                                <i class="fa fa-times"></i>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Title</label>
                        {!! Form::text('title',Input::old('title'), ['class' => 'form-control','id'=>"title",'placeholder'=>'Enter Title']) !!} 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description</label>
                        {!! Form::textarea('description',null,['class'=>'form-control', 'rows' => 2, 'cols' => 40]) !!}
                    </div>
                </div>  

                <div class="input_fields_wrap">
                <button type="button" class="btn btn-brand btn-bold add_field_button">Add More</button>&nbsp; 
                    @if(isset($tags) && count($tags) > 0)
                    @foreach($tags as $key=>$val)
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tags</label>
                            <input type="text" name="tag[]" id="tag" value="{{$val->tags}}" class="form-control">
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tags</label>
                            <input type="text" name="tag[]" id="tag" value="" class="form-control" required="required">
                        </div>
                    </div>
                    @endif 

                </div>                                                                               
            </div> 
        </div>
    </div>
</div>

<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <div class="row">
            <div class="col-lg-9 col-xl-9">
                @if(isset($data->id))
                <button type="submit" class="btn btn-brand btn-bold submitbutton">Update</button>&nbsp;
                @else
                <button type="submit" class="btn btn-brand btn-bold submitbutton">Create</button>&nbsp;
                @endif
                <a href="{{route('blog.index')}}"><button type="button" class="btn btn-secondary cancelbutton">Cancel</button></a>
            </div>
        </div>
    </div>
</div>
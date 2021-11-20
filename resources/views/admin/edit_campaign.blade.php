@extends('layouts.app')

@section('title') @if(! empty($title)) {{$title}} @endif - @parent @endsection

@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datetimepicker.css')}}">
@endsection

@section('content')

    <div class="dashboard-wrap">
        <div class="container">
            <div id="wrapper">

                @include('admin.menu')

                <div id="page-wrapper">
                    @if( ! empty($title))
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header"> {{ $title }}  </h1>
                            </div> <!-- /.col-lg-12 -->
                        </div> <!-- /.row -->
                    @endif

                    @include('admin.flash_msg')

                    <div class="row">
                        <div class="col-md-10 col-xs-12">


                  
                            <form action="" id="startCampaignForm" class="form-horizontal" method="post" enctype="multipart/form-data" >
                                @csrf

                                <legend>@lang('app.campaign_info')</legend>

                                <div class="form-group  {{ $errors->has('category')? 'has-error':'' }}">
                                    <label for="category" class="col-sm-4 control-label">@lang('app.category') <span class="field-required">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2" name="category">
                                            <option value="">@lang('app.select_a_category')</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @if($campaign->category_id == $category->id) selected="selected" @endif >{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->has('category')? '<p class="help-block">'.$errors->first('category').'</p>':'' !!}
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('title')? 'has-error':'' }}">
                                    <label for="title" class="col-sm-4 control-label">@lang('app.title') <span class="field-required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="title" value="{{ $campaign->title }}" name="title" placeholder="@lang('app.title')">
                                        {!! $errors->has('title')? '<p class="help-block">'.$errors->first('title').'</p>':'' !!}
                                        <p class="text-info"> @lang('app.great_title_info')</p>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('short_description')? 'has-error':'' }}">
                                    <label for="short_description" class="col-sm-4 control-label">@lang('app.short_description')</label>
                                    <div class="col-sm-8">
                                        <textarea name="short_description" class="form-control" rows="3">{{$campaign->short_description}}</textarea>
                                        {!! $errors->has('short_description')? '<p class="help-block">'.$errors->first('short_description').'</p>':'' !!}
                                    </div>
                                </div>


                                <div class="form-group {{ $errors->has('address')? 'has-error':'' }}">
                                    <label for="address" class="col-sm-4 control-label">@lang('app.address')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="address" value="{{ $campaign->address}}" name="address" placeholder="@lang('app.address')">
                                        {!! $errors->has('address')? '<p class="help-block">'.$errors->first('address').'</p>':'' !!}
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('start_date')? 'has-error':'' }}">
                                    <label for="start_date" class="col-sm-4 control-label">@lang('app.start_date')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="start_date" value="{{ $campaign->start_date}}" name="start_date" placeholder="@lang('app.start_date')">
                                        {!! $errors->has('start_date')? '<p class="help-block">'.$errors->first('start_date').'</p>':'' !!}
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('end_date')? 'has-error':'' }}">
                                    <label for="end_date" class="col-sm-4 control-label">@lang('app.end_date')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="end_date" value="{{ $campaign->end_date}}" name="end_date" placeholder="@lang('app.end_date')">
                                        {!! $errors->has('end_date')? '<p class="help-block">'.$errors->first('end_date').'</p>':'' !!}
                                    </div>
                                </div>


                                <div class="form-group {{ $errors->has('feature_image')? 'has-error':'' }}">
                                    <label for="end_date" class="col-sm-4 control-label">@lang('app.feature_image')</label>
                                    <div class="col-sm-8">

                                        <label for="feature_image" class="img_upload"><i class="fa fa-cloud-upload"></i> </label>
                                        <input type="file" id="feature_image" name="feature_image" style="display: none;" />
                                        <div id="feature_image_preview">@if($campaign->feature_image) <img src="{{ $campaign->feature_img_url()}}" /> @endif</div>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button type="submit" class="btn btn-primary">@lang('app.edit_campaign')</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>



                </div>

            </div>
        </div>
    </div>


@endsection

@section('page-js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>

    <script>
        $(function () {
            $('#start_date, #end_date').datetimepicker({format: 'YYYY-MM-DD'});
        });

        $(document).ready(function() {
            $(document).ready(function() {
                CKEDITOR.replaceClass = 'description';
            });

            $('#feature_image').change(function(){
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#feature_image_preview').html('<img src="'+e.target.result+'" />');
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });

    </script>
@endsection
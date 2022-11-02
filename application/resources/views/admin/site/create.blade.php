@extends('layouts.main')
@section('title', 'site')


@section('content')
@push('head')
<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/summernote/dist/summernote-bs4.css') }}">
@endpush
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-sites bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Site')}}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{ __('Site')}}</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- start message area-->
        @include('include.message')
        <!-- end message area-->
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-header">
                    <h3>{{ __('sites')}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-header">
                                    <h3>{{ __('Site elements')}}</h3>
                                </div>
                                <div class="card-body">
                                    <form class="forms-sample" action="{{isset($site) ? route('sites.update', $site->id): route('sites.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputName1">Title</label>
                                            <input name="title" type="text" value="{{isset($site->title) ? $site->title : ''}}" class="form-control" id="exampleInputName1" placeholder="Name">
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        </div>



                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Footer Copyright</label>
                                                    <input name="footer_copyright" type="text" value="{{isset($site->footer_copyright) ? $site->footer_copyright : ''}}" class="form-control" id="exampleInputEmail3" placeholder="Footer Copyright">
                                                    <span class="text-danger">{{ $errors->first('footer_copyright') }}</span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-9">
                                                    <label for="validatedInputGroupCustomFile1">Logo</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">

                                                            <input value="{{ isset($site) ? asset(path_site_logo_image().$site->image1) : ''}}" name="image1" onchange="putImage(this, 'target')" type="file" class="custom-file-input" id="validatedInputGroupCustomFile1">
                                                            <label data-id="showname" class="custom-file-label" for="validatedInputGroupCustomFile">Choose file...</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 mt-3">
                                                    <img id="target" style="height: 50px; width: 50px;" src="{{ isset($site) ? asset(path_site_logo_image().$site->image1) : 'https://via.placeholder.com/50x50'}}">
                                                </div>

                                                <div class="col-lg-9">
                                                    <label for="validatedInputGroupCustomFile2">White Logo</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">

                                                            <input value="{{ isset($site) ? asset(path_site_white_image().$site->image3):''}}" name="image2" onchange="putImage(this, 'target2')" type="file" class="custom-file-input" id="validatedInputGroupCustomFile2" >
                                                            <label data-id="showname" class="custom-file-label" for="validatedInputGroupCustomFile">Choose file...</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 mt-3">
                                                    <img id="target2" style="height: 50px; width: 50px;" src="{{ isset($site) ? asset(path_site_favicon_image().$site->image2) : 'https://via.placeholder.com/50x50'}}">
                                                </div>


                                                <!-- image -->
                                                <div class="col-lg-9">
                                                    <label for="validatedInputGroupCustomFile3">Favicon</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">

                                                            <input value="{{isset($site->image3) ? asset(path_site_favicon_image() . $site->image3): 'https://via.placeholder.com/50x50' }}" name="image3" onchange="putImage(this, 'target3')" type="file" class="custom-file-input" id="validatedInputGroupCustomFile3">
                                                            <label data-id="showname" class="custom-file-label" for="validatedInputGroupCustomFile">Choose file...</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 mt-3">
                                                    <img id="target3" style="height: 50px; width: 50px;" src="{{ isset($site) ? asset(path_site_white_image().$site->image3) : 'https://via.placeholder.com/50x50'}}">

                                                </div>

                                                <!-- image -->
                                            </div>

                                            <br>
                                            <br>
                                            <button type="submit" class="btn btn-primary mr-2">{{ __('Submit')}}</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">

                            <img src="{{isset($site->image3) ? asset(path_site_favicon_image() . $site->image3): 'https://via.placeholder.com/50x50' }}" alt="">
                        </div>
                        <!-- markup -->


                    </div>
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header"><h3>{{ __('Summernote Editor')}}</h3></div>
                                <div class="card-body">
                                    <textarea class="form-control html-editor" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <form class="sample-form">
                                <div class="form-group">
                                    <label for="">{{ __('Multiple select box using select 2')}} </label>
                                    <select class="form-control select2" multiple="multiple">
                                        <option value="cheese">{{ __('Cheese')}}</option>
                                        <option value="tomatoes">{{ __('Tomatoes')}}</option>
                                        <option value="mozarella">{{ __('Mozzarella')}}</option>
                                        <option value="mushrooms">{{ __('Mushrooms')}}</option>
                                        <option value="pepperoni" selected>{{ __('Pepperoni')}}</option>
                                        <option value="onions">{{ __('Onions')}}</option>
                                    </select>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6  mb-30">
                            <h4 class="sub-title">{{ __('Radio Button')}}</h4>
                            <div class="form-radio">
                                <form>
                                    <div class="radio radiofill radio-inline">
                                        <label>
                                            <input type="radio" name="radio" checked="checked">
                                            <i class="helper"></i>{{ __('Radio-fill 1')}}
                                        </label>
                                    </div>
                                    <div class="radio radiofill radio-inline">
                                        <label>
                                            <input type="radio" name="radio">
                                            <i class="helper"></i>{{ __('Radio-fill 2')}}
                                        </label>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>




@endsection

<!-- push external js -->


@push('script')
<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('otherjs/summernote-bs4.min.js') }}"></script>

<script>
        $(".select2").select2();
     $('.html-editor').summernote({
      height: 300,
      tabsize: 2
    });
</script>
@endpush


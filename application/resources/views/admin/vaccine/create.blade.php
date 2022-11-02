@extends('layouts.main')
@section('title', 'Create Vaccine')
@push('head')
<!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">

@endpush

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-users bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ ucfirst(request()->segment(2)) }}</h5>
                        <span>{{ 'List of ' . request()->segment(2) }}</span>
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
                            <a href="#">{{request()->segment(2)}}</a>
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
                    <h3>{{ ucfirst(request()->segment(2)) }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="{{isset($vaccine) ? 'col-lg-9' : 'col-md-12' }}">
                            <div class="card">
                                <div class="card-header">
                                    <h3>{{ __(ucfirst(request()->segment(2)) . ' elements')}}</h3>
                                </div>
                                <div class="card-body">
                                    <form class="forms-sample" action="{{isset($vaccine) ? route('vaccine.update', $vaccine->id) : route('vaccine.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputName1">{{ __('Vaccine Name')}}</label>
                                            <input name="name" type="text" value="{{isset($vaccine) ? $vaccine->name : old('name') }}" class="form-control" id="exampleInputName1" placeholder="Name">
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        </div>


                                        <div class="form-group">
                                            <label for="location">{{ __('Description')}}</label>
                                            <textarea id="summernote" name="description" class="form-control my-editor html-editor" id="exampleTextarea1" rows="4">{{isset($vaccine->description) ? $vaccine->description : '' }}</textarea>
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputName1">{{ __('Scientific Name')}}</label>
                                            <input name="scientific_name" type="text" value="{{isset($vaccine) ? $vaccine->scientific_name : old('scientific_name') }}" class="form-control" id="exampleInputName1" placeholder="Scientific Name">
                                            <span class="text-danger">{{ $errors->first('scientific_name') }}</span>
                                        </div>


                                        <button type="submit" class="btn btn-primary mr-2">{{isset($vaccine) ?  __('Update') :__('Submit')}}</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- markup -->
                        @if (isset($clinic))

                        <div class="col-md-3">
                            <div>
                                <h5>Clinic Info</h5>
                            </div>
                            <div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input name="name" type="text" class="form-control" value="{{($clinic->name) ?? ''}}" disabled>
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input name="location" type="text" class="form-control" value="{{($clinic->location) ?? ''}}" disabled>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection

<!-- push external js -->
@push('script')
<script src=" http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>

<script>
      $('.html-editor').summernote({
      height: 300,
      tabsize: 2
    });
</script>

@endpush

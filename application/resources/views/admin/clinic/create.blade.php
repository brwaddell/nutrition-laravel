@extends('layouts.main')
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
                        <div class="{{isset($clinic) ? 'col-lg-9' : 'col-md-12' }}">
                            <div class="card">
                                <div class="card-header">
                                    <h3>{{ __(ucfirst(request()->segment(2)) . ' elements')}}</h3>
                                </div>
                                <div class="card-body">
                                    <form class="forms-sample" action="{{isset($clinic) ? route('clinic.update', $clinic->id) : route('clinic.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputName1">{{ __('Clinic Name')}}</label>
                                            <input name="name" type="text" value="{{isset($clinic) ? $clinic->name : old('name') }}" class="form-control" id="exampleInputName1" placeholder="Name">
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        </div>


                                        <div class="form-group">
                                            <label for="location">{{ __('Location')}}</label>
                                            <input name="location" type="text" value="{{isset($clinic) ?$clinic->location : old('location')}}" class="form-control" id="location" placeholder="Location">
                                            <span class="text-danger">{{ $errors->first('location') }}</span>
                                        </div>


                                        <button type="submit" class="btn btn-primary mr-2">{{isset($clinic) ?  __('Update') :__('Submit')}}</button>
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

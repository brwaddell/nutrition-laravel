@extends('layouts.main')
@push('head')
<!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">


@endpush

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-users bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Users')}}</h5>
                        <span>{{ __('List of users')}}</span>
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
                            <a href="#">{{ __('Users')}}</a>
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
                    <h3>{{ __('Users')}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header">
                                    <h3>{{ __('Basic form elements')}}</h3>
                                </div>
                                <div class="card-body">
                                    <form class="forms-sample" action="{{isset($user) ? route('user.update', $user->id): ''}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputName1">{{ __('Name')}}</label>
                                            <input name="name" type="text" value="{{$user->name}}" class="form-control" id="exampleInputName1" placeholder="Name">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail3">{{ __('Email address')}}</label>
                                                    <input name="email" type="email" value="{{$user->email}}" class="form-control" id="exampleInputEmail3" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleSelectGender">{{ __('Gender')}}</label>
                                                    <select name="gender" class="form-control" id="exampleSelectGender">
                                                        <option value="male" {{$user->gender == 'male' ? 'selected':''}}>{{ __('Male')}}</option>
                                                        <option value="female" {{$user->gender == 'female' ? 'selected':''}}>{{ __('Female')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword4">{{ __('Password')}}</label>
                                            <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                                        </div>

                                            <div class="form-group">
                                                <label for="exampleSelectGender">{{ __('Role')}}</label>
                                                <select class="form-control" id="gender" name="role">
                                                    <option value="admin" {{ $user->role == 'admin' ? 'selected':'' }}>{{ __('Admin')}}</option>
                                                    <option value="doctor" {{ $user->role == 'doctor' ? 'selected':'' }}>{{ __('Doctor')}}</option>
                                                    <option value="medical assistant" {{ $user->role == 'medical assistant' ? 'selected':'' }}>{{ __('Medical Assistant')}}</option>
                                                    <option value="pathologist" {{ $user->role == 'pathologist' ? 'selected':'' }}>{{ __('Pathologist')}}</option>
                                                </select>
                                            </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-9">
                                                    <label for="validatedInputGroupCustomFile1">User Image</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">

                                                            <input value="{{ isset($user) ? asset(path_user_image().$user->image) : ''}}" name="image" onchange="putImage(this, 'target')" type="file" class="custom-file-input" id="validatedInputGroupCustomFile1">
                                                            <label data-id="showname" class="custom-file-label" for="validatedInputGroupCustomFile">Choose file...</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 mt-3">
                                                    <img id="target" style="height: 50px; width: 50px;" src="{{ isset($user->image) ? asset(path_user_image().$user->image) : Avatar::create($user->name)->toBase64()}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleTextarea1">{{ __('Textarea')}}</label>

                                            <textarea id="summernote" name=" bio" class="form-control my-editor html-editor" id="exampleTextarea1" rows="4">{{isset($user->bio) ? $user->bio : '' }}</textarea>

                                            <!-- markup -->
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">{{ __('Submit')}}</button>
                                        <button class="btn btn-light">{{ __('Cancel')}}</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- markup -->

                        <div class="col-md-3">
                            <div>
                                <h5>User Info</h5>
                            </div>
                            <div>
                                <div class="form-group">
                                    <label for="fname">Name</label>
                                    <input name="fname" type="text" class="form-control" value="{{($user->name) ?? ''}}" disabled>
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    <label for="fname">Email</label>
                                    <input name="fname" type="text" class="form-control" value="{{($user->email) ?? ''}}" disabled>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <img style="width: 200px; height:200px; border-radius:50%" src="{{ isset($user->image) ? asset(path_user_image().$user->image) : Avatar::create($user->name)->toBase64()}}" alt="">
                            </div>
                        </div>

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

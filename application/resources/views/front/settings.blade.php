@extends('layouts.front')
@section('title', 'Settings')
@section('content')
<div class="patient-demographics mb-40">
    @if(count($errors) > 0 )
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="p-0 m-0" style="list-style: none;">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="section-header-two mb-35">
        <h2 class="section-title">{{ __('Change Password') }}</h2>
    </div>
    <div class="primary-form">
        <form action="{{ route('password.change') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="Password">{{ __('Current Password') }}</label>
                        <input type="password" class="form-control" id="Password" name="password" placeholder="Password" />
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="nPassword">{{ __('New Password') }}</label>
                        <input type="password" class="form-control" id="nPassword" name="npassword" placeholder="Password" />
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="cPassword">{{ __('Confirm New Password') }}</label>
                        <input type="password" class="form-control" id="cPassword" name="npassword_confirmation" placeholder="Password" />
                    </div>
                </div>

                <div class="col-lg-12 mt-2">
                    <button type="submit" class="primary-btn-lg btn-rounded min-width-145">{{ __('Save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

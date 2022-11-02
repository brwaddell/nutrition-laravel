@extends('layouts.front')
@section('title', 'Profile Setting')
@section('content')
<div class="patient-top mb-40">
    <div class="row align-items-center">
        <div class="col-lg-12">
            <div class="media align-items-center">
                <form enctype="multipart/form-data" id="imageUpload">
                    @csrf
                <img class="mr-5 profile-image" id="target" src="{{
                    isset($user->image) ? asset(path_user_image().$user->image) : Avatar::create($user->name)->toBase64()
                }}" alt="profile" />
                <a href="#" id="patientPhoto" onclick="changePhoto()" class="primary-btn-lg btn-rounded">Change Photo</a>
                <input type="file" class="d-none" id="patientFile" onchange="imageup(),putImage(this, 'target')" name="image">
                <button id="imgsubmit" class="btn btn-success d-none"></button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="patient-demographics mb-40">
    <div class="section-header-two mb-35">
        <h2 class="section-title">{{ __('Personal Information') }}</h2>
    </div>
    <div class="primary-form">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="Name">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="Name" name="name" placeholder="Jenny" value="{{ $user->name }}" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="Designation">{{ __('Designation') }}</label>
                        <input type="text" class="form-control" id="Designation" name="designation" placeholder="Carddiologist" value="{{ $user->designation }}" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="Email">{{ __('Email') }}</label>
                        <input type="email" class="form-control" id="Email" name="email" placeholder="filimonov@gmail.com" value="{{ $user->email }}" readonly />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="Mobile">{{ __('Mobile Number') }}</label>
                        <input type="text" class="form-control" id="Mobile" name="contact_no" placeholder="+88 012 575 8465" value="{{ $user->contact_no }}" />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="Address">{{ __('Address') }}</label>
                        <input type="text" class="form-control" id="Address" name="address" placeholder="Apt-120, Road-1" value="{{ $user->address }}" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="City">{{ __('City') }}</label>
                        <input type="text" class="form-control" id="City" name="city" placeholder="San Fransisco" value="{{ $user->city }}" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="State">{{ __('State') }}</label>
                        <input type="text" class="form-control" id="State" name="state" placeholder="California" value="{{ $user->state }}" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="Zip">{{ __('Zip Code') }}</label>
                        <input type="text" class="form-control" id="Zip" name="zip_code" placeholder="55413" value="{{ $user->zip_code }}" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="Country">{{ __('Country') }}</label>
                        <input type="text" class="form-control" id="Country" Country="country" placeholder="United State" value="{{ $user->country }}" />
                    </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <button type="submit" class="primary-btn-lg btn-rounded min-width-145">{{ __('Save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>

    function changePhoto(){
        $('#patientFile').click()
    }

    function showImage(src, target) {
        var fr = new FileReader();
        fr.onload = function() {
        target.src = fr.result;
        }
        fr.readAsDataURL(src.files[0]);
    }
  function putImage(src, target) {
    let imagesrc = src.getAttribute('id')
    var src = document.getElementById(imagesrc);
    var target = document.getElementById(target);
    // target.style.width = '120px';
    // target.style.height = '80px';
    showImage(src, target);
  }

  function imageup() {
    $('#imgsubmit').click();
  }

  $('#imageUpload').on('submit', (function(e) {
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var formData = new FormData(this);
    $.ajax({
      type: 'POST',
      url: "{{route('user.image.update', $user->id)}}",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
    }).done(function(data) {
      //location.reload();
    });
  }));
</script>
@endpush
@endsection


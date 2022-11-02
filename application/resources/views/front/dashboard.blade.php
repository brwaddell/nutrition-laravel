@extends('layouts.front')
@section('title', 'Dashboard')
@section('content')
<div class="row mt-15">
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card-icon-box text-center">
            <div class="card-icon">
                <img src="{{ asset('front/assets/images/medical-mask.png') }}" alt="card iamge" />
            </div>
            <div class="card-content">
                <h5>{{ __('Total Patients') }}</h5>
                <h2 class="counter">{{ $patientCount }}</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card-icon-box text-center">
            <div class="card-icon">
                <img src="{{ asset('front/assets/images/businesswoman.png') }}" alt="card iamge" />
            </div>
            <div class="card-content">
                <h5>{{ __('Encounters') }}</h5>
                <h2 class="counter">{{ $clinicalEncounterCount }}</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card-icon-box text-center">
            <div class="card-icon">
                <img src="{{ asset('front/assets/images/patients.png') }}" alt="card iamge" />
            </div>
            <div class="card-content">
                <h5>{{ __('New Patients') }}</h5>
                <h2 class="counter">{{ $todaysAddedPatients }}</h2>
            </div>
        </div>
    </div>
</div>
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
<div class="section-header mb-20">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h2 class="section-title">{{ __('Patient list') }}</h2>
        </div>
        <div class="col-sm-6 text-sm-right">
            <a class="primary-btn" data-toggle="modal" data-target="#addnewpatient" href="#">{{ __('Add New Patient') }}</a>
        </div>
    </div>
</div>
<div class="primary-table">
    <div class="table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">{{ __('Last Name') }}</th>
                <th scope="col">{{ __('First Name') }}</th>
                <th scope="col">{{ __('Date of Birth') }}</th>
                <th scope="col">{{ __('Clinic Site') }}</th>
                <th scope="col">{{ __('Location') }}</th>
                <th scope="col" colspan="2">{{ __('Conditions') }}</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($patients as $patient)
                    <tr>
                        <td>
                            <div class="media patient-info align-items-center">
                                <img src="{{
                                    isset($patient->image) ? asset(path_patient_image().$patient->image) : Avatar::create($patient->first_name . ' ' . $patient->last_name)->toBase64()
                                }}" class="mr-3" alt="patient" />
                                <div class="media-body">
                                <h5>{{ $patient->last_name }}</h5>
                                <span>#{{ $patient->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td>{{ $patient->first_name }}</td>
                        <td>{{ $patient->dob }}</td>
                        <td>{{ $patient->clinic->name }}</td>
                        <td>
                            @if (checkInStatus($patient->id) == 1)
                                {{ __('Already Done') }}
                            @elseif (isCEComplete($patient->id) == 1)
                                {{ __('Clinical Encounter') }}
                            @elseif (isVSComplete($patient->id) == 1)
                                {{ __('Vital Sign') }}
                            @elseif (isPHComplete($patient->id) == 1)
                                 {{ __('Public Health') }}
                            @endif
                        </td>
                        <td>{{ $patient->conditions }}</td>
                        <td>
                            <ul class="options-btn">
                                <li>
                                    <div class="dropdown">
                                        <a class="edite-btn" href="#" data-toggle="dropdown">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <div class="dropdown-menu">
                                        <a href="{{ route('edit.patient-chart', $patient->id) }}">{{ __('Patient Chart') }}</a>
                                        <a href="{{ route('clinicals.checkin', $patient->id) }}">{{ __('Check in Patient') }}</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a class="delet-btn" onclick="return deleteConfirmation()" href="{{ route('patient.delete', $patient->id) }}"><i class="fas fa-trash-alt"></i></a>
                                </li>
                            </ul>
                        </td>
                    </tr>

                @empty
                <tr>
                    <td colspan="7" align="center"><h2>{{ __('No Patient Found!') }}</h2></td>
                </tr>

                @endforelse
            </tbody>
        </table>

    </div>
    <div class="table-pagination mt-30">
        <div class="row">
            {{ $patients->links('pagination::custom') }}
        </div>
    </div>
</div>



@push('modal')
    <!--Add New Patient  Modal -->
    <div class="modal fade" id="addnewpatient" tabindex="-1" >
        <div class="modal-dialog large-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ __('Add New Patient') }}</h2>
                    <form action="{{route('patient.store')}}" method="POST" id="editform" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="clinic_id" value="{{ session()->get('clinic_id') }}">
                        <div class="user-image mb-40">
                            <img  src="https://via.placeholder.com/50x50" alt="profile-image" id="uplode-img" />
                            <div class="custom-fileuplode">
                                <label for="fileuplode" class="file-uplode-btn primary-btn-lg btn-rounded">{{ __('Upload Photo') }}</label>
                                <input name="image" type="file" id="fileuplode">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="first_name">{{ __('Patient First Name') }}</label>
                                    <input onkeyup="addvalidation('#editform #pname', '#editform .fnameerror')" type="text" class="form-control" id="pname" name="first_name" placeholder="Alexander" />
                                    <small class=" text-danger d-none fnameerror">{{ __('Patient first name field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="last_name">{{ __('Patient Last Name') }}</label>
                                    <input  onkeyup="addvalidation('#editform #lname', '#editform .lnameerror')" type="text" class="form-control" id="lname" name="last_name" placeholder="Alexander" />
                                    <small class=" text-danger d-none lnameerror">{{ __('Patient Last name field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input onkeyup="addvalidation('#editform #email', '#editform .emailerror')" type="email" class="form-control" id="email" name="email" placeholder="alexander@gmail.com" />
                                    <small class=" text-danger d-none emailerror">{{ __('Email field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="DoctorAssign">{{ __('Date Of Birth') }}</label>
                                    <input onchange="addvalidation('#editform #datebirth', '#editform .doberror')" type="date" class="form-control" id="datebirth" name="dob" placeholder="06/12/21" />
                                    <small class=" text-danger d-none doberror">{{ __('Date of birth field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="DoctorAssign">{{ __('Gender') }}</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="male" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                          {{ __('Male') }}
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="female">
                                        <label class="form-check-label" for="exampleRadios2">
                                         {{ __('Female') }}
                                        </label>
                                      </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="conditions">{{ __('Conditions') }}</label>
                                    <input onkeyup="addvalidation('#editform #conditions', '#editform .conditionserror')" type="text" class="form-control" id="conditions" name="conditions" placeholder="Mumps Stage II" />
                                    <small class=" text-danger d-none conditionserror">{{ __('Conditions field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <button type="submit" class="primary-btn-lg btn-rounded changesave disable-color" disabled>{{ __('Add Patient') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Add New Patient  Modal -->

@endpush


@endsection



@push('scripts')

@if($errors->any())

@endif


<script>
    //edit form validation
    var $ = jQuery;
    function addvalidation($class, $formeroorclass) {
        checkthevalue();

        if ($($class).val() == '') {
            $($formeroorclass).removeClass('d-none');
        } else {
            $($formeroorclass).addClass('d-none');
        }
    }

  function checkthevalue(){
        if($('#pname').val() == '' || $('#lname').val() == '' || $('#email').val() == '' || $('#datebirth').val() == '' || $('#conditions').val() == ''){
            $('.changesave').attr("disabled", true).addClass('disabled disable-color');
            return;
        }else{
            $('.changesave').attr("disabled", false).removeClass('disabled disable-color');
        }
    }


</script>
@endpush

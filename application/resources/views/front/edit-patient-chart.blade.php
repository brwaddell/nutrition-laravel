@extends('layouts.front')
@section('title', 'Edit Patient Chart')
@section('content')
<div class="patient-top mb-40">
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
    <div class="row align-items-center">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="media align-items-center">
                <form enctype="multipart/form-data" id="imageUpload">
                    @csrf
                <img class="mr-5 profile-image" id="target" src="{{
                    isset($patient->image) ? asset(path_patient_image().$patient->image) : Avatar::create($patient->first_name . ' ' . $patient->last_name)->toBase64()
                }}" alt="profile" />
                <a href="#" id="patientPhoto" onclick="changePhoto()" class="primary-btn-lg btn-rounded">{{ __('Change Photo') }}</a>
                <input type="file" class="d-none" id="patientFile" onchange="imageup(),putImage(this, 'target')" name="image">
                <button id="imgsubmit" class="btn btn-success d-none"></button>
                </form>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 text-center text-sm-right">
            <a href="{{ route('patient.delete', $patient->id) }}" class="primary-btn-lg btn-rounded delet-btn">{{ __('Delete Profile') }}</a>
        </div>
    </div>
</div>
<div class="patient-demographics mb-40">
    <div class="section-header-two mb-35">
        <h2 class="section-title">{{ __('Patient Demographics') }}</h2>
    </div>
    <div class="primary-form">
        {{-- <form action="#"> --}}
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="FirstName2">{{ __('First Name') }}</label>
                        <input type="text" class="form-control" id="FirstName2" name="FirstName2" placeholder="Jenny" value="{{ $patient->first_name }}" readonly/>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="LastName1">{{ __('Last Name') }}</label>
                        <input type="text" class="form-control" id="LastName1" name="LastName1" placeholder="Wilson" value="{{ $patient->last_name }}" readonly/>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="dateofbirth">{{ __('Date of Birth') }}</label>
                        <input type="text" class="form-control" id="dateofbirth" name="dateofbirth" placeholder="10 Jan 1990" value="{{ \Carbon\Carbon::parse($patient->dob)->toFormattedDateString() }}" readonly/>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="homeaddress1">{{ __('Home Address') }}</label>
                        <input type="text" class="form-control" id="homeaddress1" name="homeaddress1" placeholder="Vauxhall, NJ, USA" value="{{ $patient->home_address }}" readonly/>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="Street">{{ __('Street') }}</label>
                        <input type="text" class="form-control" id="Street" name="Street" placeholder="4950  Mount Street" value="{{ $patient->street }}" readonly/>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="City1">{{ __('City') }}</label>
                        <input type="text" class="form-control" id="City1" name="City1" placeholder="VAUXHALL" value="{{ $patient->city }}" readonly/>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="Province">{{ __('State/Province') }}</label>
                        <input type="text" class="form-control" id="Province" name="Province" placeholder="NJ" value="{{ $patient->state }}" readonly/>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="Country1">{{ __('Country') }}</label>
                        <input type="text" class="form-control" id="Country1" name="Country1" placeholder="USA" value="{{ $patient->country }}" readonly/>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="PostalCode">{{ __('Postal Code') }}</label>
                        <input type="text" class="form-control" id="PostalCode" name="PostalCode" placeholder="07088" value="{{ $patient->postal_code }}" readonly/>
                    </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <button data-toggle="modal" data-target="#editpatient" class="primary-btn-lg btn-rounded min-width-145">{{ __('Edit') }}</button>
                </div>
            </div>
        {{-- </form> --}}
    </div>
</div>
<div class="parental-information mb-40">
    <div class="section-header-two mb-40">
        <h2 class="section-title ">{{ __('Parental Information') }}</h2>
    </div>
    <div class="secondary-table Information-table">
        <div class="table-responsive mb-15">
            <table class="table">
                <thead>
                  <tr>
                    {{-- <th scope="col"><input type="checkbox" id="exampleCheck1" /></th> --}}
                    <th scope="col">Sl</th>
                    <th scope="col">{{ __('Parent Type') }}</th>
                    <th scope="col">{{ __('First Name') }}</th>
                    <th scope="col">{{ __('Last Name') }}</th>
                    <th scope="col">{{ __('Date of Birth') }}</th>
                    <th scope="col">{{ __('Primary Language') }}</th>
                    <th scope="col">{{ __('Racial Identity') }}</th>
                    <th scope="col">{{ __('Martial Status') }}</th>
                    <th scope="col">{{ __('Phone No') }}</th>
                    <th scope="col">{{ __('Whatsapp No') }}</th>
                    <th scope="col">{{ __('District') }}</th>
                    <th scope="col">{{ __('DPI') }}</th>
                    <th scope="col">{{ __('Occupation') }}</th>
                    <th scope="col">{{ __('migrant') }}</th>
                    <th scope="col">{{ __('Primary Caregiver') }}</th>
                    <th scope="col">{{ __('Caregiver Information') }}</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($parents as $key => $parent)
                        <tr>
                            <td> <span class="id-number">{{ $key + 1 }}</span></td>
                            <td>{{ $parent->parent_type }}</td>
                            <td>{{ $parent->first_name }}</td>
                            <td>{{ $parent->last_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($parent->dob)->toFormattedDateString() }}</td>
                            <td>{{ $parent->language }}</td>
                            <td>{{ $parent->racial_identity }}</td>
                            <td>{{ $parent->martial_status }}</td>
                            <td>{{ $parent->cell_phone }}</td>
                            <td>{{ $parent->whatsapp }}</td>
                            <td>{{ $parent->district }}</td>
                            <td>{{ $parent->dpi }}</td>
                            <td>{{ $parent->occupation }}</td>
                            <td>{{ $parent->is_migrant == '1' ? 'Yes' : 'No' }}</td>
                            <td>{{ $parent->primay_caregiver == '1' ? 'Yes' : 'No' }}</td>
                            <td>{{ $parent->caregiver_info }}</td>
                        </tr>
                    @empty
                    <tr><td colspan="9" align="center"><h2>{{ __('No information found!') }}</h2></td></tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        <a href="#" data-toggle="modal" data-target="#AddParent" class="primary-btn">{{ __('Add Family Member') }}</a>
    </div>
</div>
<div class="prenatal-history mb-40">
    <div class="section-header-two mb-40">
        <h2 class="section-title ">{{ __('Prenatal History') }}</h2>
    </div>
    <div class="secondary-table history-table">
        <div class="table-responsive mb-15">
            <table class="table">
                <thead>
                  <tr>
                    {{-- <th scope="col"><input type="checkbox" id="exampleCheck3" /></th> --}}
                    <th scope="col">Sl</th>
                    <th scope="col">{{ __('Prenatal Course') }}</th>
                    <th scope="col">{{ __('Pregnancy Number') }}</th>
                    <th scope="col">{{ __('High Risk') }}</th>
                    <th scope="col">{{ __('Risk of Abortion') }}</th>
                    <th scope="col">{{ __('Risk of Premature Parturition') }}</th>
                    <th scope="col">{{ __('Prenatal Diagnosis') }}</th>
                  </tr>
                </thead>
                <tbody>
                    @if (isset($prenatal))
                            <tr>
                                <td> <span class="id-number">1</span></td>
                                <td>{{ $prenatal->course }}</td>
                                <td>{{ $prenatal->pregnancy_no }}</td>
                                <td>{{ $prenatal->high_risk == '1' ? 'Yes' : 'No' }}</td>
                                <td>{{ $prenatal->abortion == '1' ? 'Yes' : 'No' }}</td>
                                <td>{{ $prenatal->premature_parturition == '1' ? 'Yes' : 'No' }}</td>
                                <td>{{ $prenatal->diagnosis }}</td>

                            </tr>
                            @else
                            <tr><td colspan="8" align="center"><h2>{{ __('No information found!') }}</h2></td></tr>
                    @endif

                </tbody>
            </table>
        </div>
        @if (isset($prenatal))
        <a href="#" data-toggle="modal" data-target="#addPrenatalHistory" class="primary-btn">{{ __('Edit Prenatal History') }}</a>
        @else

        <a href="#" data-toggle="modal" data-target="#addPrenatalHistory" class="primary-btn">{{ __('Add Prenatal History') }}</a>
        @endif
    </div>
</div>

<div class="prenatal-history mb-40">
    <div class="section-header-two mb-40">
        <h2 class="section-title ">{{ __('Birth information') }}</h2>
    </div>
    <div class="secondary-table birth-table">
        <div class="table-responsive mb-15">
            <table class="table">
                <thead>
                  <tr>
                    {{-- <th scope="col"><input type="checkbox" id="exampleCheck5" /></th> --}}
                    <th scope="col">Sl</th>
                    <th scope="col">{{ __('Birth Weight') }}</th>
                    <th scope="col">{{ __('Birth Length') }}</th>
                    <th scope="col">{{ __('Apgars') }}</th>
                    <th scope="col">{{ __('Skin to skin immediately') }}</th>
                    <th scope="col">{{ __('Immediate Breastfeeding') }}</th>
                    <th scope="col">{{ __('History of Respiratory Distress') }}</th>
                    <th scope="col">{{ __('Jaundice') }}</th>
                    <th scope="col">{{ __('Sepsis') }}</th>
                    <th scope="col">{{ __('Infant Required hospitalization?') }} </th>
                    <th scope="col">{{ __('How old was the baby when starting solid foods') }} </th>
                    <th scope="col">{{ __('Does the baby eat fresh fruits') }} </th>
                  </tr>
                </thead>
                <tbody>
                    @if (isset($birth_info))
                  <tr>
                      <td> <span class="id-number">1</span></td>
                      <td>{{ $birth_info->birth_weight }} {{ $birth_info->weight_unit }}</td>
                      <td>{{ $birth_info->birth_length }} {{ $birth_info->length_unit }}</td>
                      <td>{{ $birth_info->apgars }}</td>
                      <td>{{ $birth_info->skin_immediately == '1' ? 'Yes' : 'No' }}</td>
                      <td>{{ $birth_info->breastfeeding == '1' ? 'Yes' : 'No' }}</td>
                      <td>{{ $birth_info->respiratory_distress == '1' ? 'Yes' : 'No' }}</td>
                      <td>{{ $birth_info->jaundice == '1' ? 'Yes' : 'No' }}</td>
                      <td>{{ $birth_info->spesis == '1' ? 'Yes' : 'No' }}</td>
                      <td>{{ $birth_info->hospitalization == '1' ? 'Yes' : 'No' }}</td>
                      <td>{{ $birth_info->solid_foods }}</td>
                      <td>{{ $birth_info->fresh_fruits == '1' ? 'Yes' : 'No' }}</td>

                    </tr>
                    @else
                    <tr><td colspan="7" align="center"><h2>{{ __('No information found!') }}</h2></td></tr>

                    @endif
                </tbody>
            </table>
        </div>
        @if (isset($birth_info))
        <a href="#" data-toggle="modal" data-target="#Birthinformation" class="primary-btn">{{ __('Edit Birth Information') }}</a>
        @else

        <a href="#" data-toggle="modal" data-target="#Birthinformation" class="primary-btn">{{ __('Add Birth Information') }}</a>
        @endif
    </div>
</div>

<div class="prenatal-history mb-40">
    <div class="section-header-two mb-40">
        <h2 class="section-title ">{{ __('Immunizations') }}</h2>
    </div>
    <div class="secondary-table birth-table">
        <div class="table-responsive mb-15">
            <table class="table">
                {{-- <thead>
                  <tr>
                      @forelse ($vacciness as $vaccine)
                      <th scope="col">{{ $vaccine->name }}</th>
                      @empty
                      <th scope="col">No data is available for now</th>
                      @endforelse
                  </tr>
                </thead> --}}
                <tbody>
                    @foreach ($vacciness as $vaccine)
                        <tr>
                            <td>{{ $vaccine->name }}</td>
                            @foreach ($vaccine->immunization as $immunization)
                            @php
                                $ent = $vdc - $immunization->date_count;
                            @endphp
                                @foreach ($immunization->next_date as $nd)
                                    <td>
                                        {{ $nd }} 
                                    </td>
                                @endforeach
                            @endforeach
                            @if ($ent != 0)
                                @for ($i = 0; $i < $ent; $i++)
                                    <td></td> 
                                @endfor
                                
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="#" data-toggle="modal" data-target="#Vaccine" class="primary-btn">{{ __('Click Here To Give Vaccine') }}</a>
    </div>
</div>

<div class="prenatal-history">
    <div class="section-header-two mb-40">
        <h2 class="section-title ">{{ __('Encounter History') }}</h2>
    </div>
    <div class="secondary-table birth-table">
        <div class="table-responsive mb-15">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">{{ __('Chief Complaint') }}</th>
                    <th scope="col">{{ __('History') }}</th>
                    <th scope="col">{{ __('Physical Exam') }}</th>
                    <th scope="col">{{ __('Assessment') }}</th>
                    <th scope="col">{{ __('Date') }}</th>
                    <th scope="col">{{ __('Doctor Sign') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($clinical_encounters as $cle)
                        <tr>
                            <td>{{ $cle->chief_complaint }}</td>
                            <td>{{ $cle->history_illness }}</td>
                            <td>{{ $cle->physical_exam }}</td>
                            <td>{{ $cle->assesment }}</td>
                            <td>{{ \Carbon\Carbon::parse($cle->created_at)->diffForHumans() }}</td>
                            <td>{{ $cle->doctor_sign }} ({{ $cle->signing_date }})</td>
                            <td>
                                <button class="btn btn-info btn-lg" data-toggle="modal" data-target="#Encounter{{ $cle->id }}">View</button>
                            </td>
                        </tr>
                    @empty

                    <tr>
                        <td colspan="7" align="center"><h2>{{ __('No Encounter Found!') }}</h2></td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('modal')
    <!--Add New Patient  Modal -->
    <div class="modal fade" id="editpatient" tabindex="-1" >
        <div class="modal-dialog large-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ __('Patient Demographics') }}</h2>
                    <form action="{{ route('edit.patient-chart.post', $patient->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="FirstName3">{{ __('First Name') }}</label>
                                    <input type="text" class="form-control" id="FirstName3" name="first_name" placeholder="Jenny" value="{{ $patient->first_name }}" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="LastName2">{{ __('Last Name') }}</label>
                                    <input type="text" class="form-control" id="LastName2" name="last_name" placeholder="Wilson" value="{{ $patient->last_name }}" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="dateofbirth1">{{ __('Date of Birth') }}</label>
                                    <input type="date" class="form-control" id="dateofbirth1" name="dob" placeholder="10 Jan 1990" value="{{ $patient->dob }}" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="homeaddress">{{ __('Home Address') }}</label>
                                    <input type="text" class="form-control" id="homeaddress" name="home_address" placeholder="Vauxhall, NJ, USA" value="{{ $patient->home_address }}" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="Street1">{{ __('Street') }}</label>
                                    <input type="text" class="form-control" id="Street1" name="street" placeholder="4950  Mount Street" value="{{ $patient->street }}" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="City">{{ __('City') }}</label>
                                    <input type="text" class="form-control" id="City" name="city" placeholder="VAUXHALL" value="{{ $patient->city }}" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="Province1">{{ __('State/Province') }}</label>
                                    <input type="text" class="form-control" id="Province1" name="state" placeholder="NJ" value="{{ $patient->state }}" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="Country">{{ __('Country') }}</label>
                                    <input type="text" class="form-control" id="Country" name="country" placeholder="USA" value="{{ $patient->country }}" />
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="PostalCode1">{{ __('Postal Code') }}</label>
                                    <input type="text" class="form-control" id="PostalCode1" name="postal_code" placeholder="07088" value="{{ $patient->postal_code }}" />
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <button type="submit" class="primary-btn-lg btn-rounded min-width-145">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Add New Patient  Modal -->
    <!--AddParent  Modal -->
    <div class="modal fade" id="AddParent" tabindex="-1" >
        <div class="modal-dialog large-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ __('Add Parent') }}</h2>
                    <form id="prntform" action="{{ route('add-parent', $patient->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="ParentType">{{ __('Parent Type') }}</label>
                                    <select class="form-control" id="ParentType" name="parent_type">
                                        <option value="Father">{{ __('Father') }}</option>
                                        <option value="Mother">{{ __('Mother') }}</option>
                                        <option value="Brother">{{ __('Brother') }}</option>
                                        <option value="Sister">{{ __('Sister') }}</option>
                                        <option value="Other">{{ __('Other') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="FirstName1">{{ __('First Name') }}</label>
                                    <input onkeyup="parentaddvalidation('#prntform #FirstName1', '#prntform .FirstName1error')" type="text" class="form-control" id="FirstName1" name="first_name" placeholder="Jenny" />
                                    <small class=" text-danger d-none FirstName1error">{{ __('First Name field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="lastname3">{{ __('Last Name') }}</label>
                                    <input onkeyup="parentaddvalidation('#prntform #lastname3', '#prntform .lastname3error')" type="text" class="form-control" id="lastname3" name="last_name" placeholder="Copper" />
                                    <small class=" text-danger d-none lastname3error">{{ __('Last Name field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="birthdate">{{ __('Date of Birth') }}</label>
                                    <input type="date" class="form-control" id="birthdate" name="dob" placeholder="10 Jan 1990" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="Language">{{ __('Primary Language') }}</label>
                                    <select class="form-control" id="Language" name="language">
                                        <option>Select Language</option>
                                        <option value="English">English </option>
                                        <option value="Spanish">Spanish </option>
                                        <option value="Latin">Latin </option>
                                        <option value="French">French </option>
                                        <option value="Bangla">Bangla</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="Identity">{{ __('Racial Identity') }}</label>
                                    <input onkeyup="parentaddvalidation('#prntform #Identity', '#prntform .Identityerror')" type="text" name="racial_identity" class="form-control" id="Identity" placeholder="Racial Identity">
                                    <small class=" text-danger d-none Identityerror">{{ __('Racial Identity field is required') }}</small>
                                    {{-- <select class="form-control" id="Identity" name="racial_identity">
                                        <option value="">Select Racial Identity</option>
                                    </select> --}}
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="MaritalStatus">{{ __('Marital Status') }}</label>
                                    <select class="form-control" id="MaritalStatus" name="martial_status">
                                        <option value="Married">{{ __('Married') }}</option>
                                        <option value="Unmarried">{{ __('Unmarried') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="phone">{{ __('Cell Phone') }}</label>
                                    <input onkeyup="parentaddvalidation('#prntform #phone', '#prntform .phoneerror')" onkeypress="return isNumber(event)" type="text" class="form-control" id="phone" name="cell_phone" placeholder="989-571-7058" />
                                    <small class=" text-danger d-none phoneerror">{{ __('Cell phone field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="whatapps">{{ __('What’s App') }}</label>
                                    <input onkeyup="parentaddvalidation('#prntform #whatapps', '#prntform .whatappserror')" onkeypress="return isNumber(event)" type="text" class="form-control" id="whatapps" name="whatsapp" placeholder="989-571-7058" />
                                    <small class=" text-danger d-none whatappserror">{{ __('Whatsapp field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="District">{{ __('District') }}</label>
                                    <input onkeyup="parentaddvalidation('#prntform #District', '#prntform .Districterror')" type="text" name="district" class="form-control" id="District" placeholder="District">
                                    <small class=" text-danger d-none Districterror">{{ __('District field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="DPINumber">{{ __('DPI Number') }}</label>
                                    <input onkeyup="parentaddvalidation('#prntform #DPINumber', '#prntform .DPINumbererror')" onkeypress="return isNumber(event)" type="text" class="form-control" id="DPINumber" name="dpi_no" placeholder="542665658" />
                                    <small class=" text-danger d-none DPINumbererror">{{ __('DPI Number is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="Occupation">{{ __('Occupation') }}</label>
                                    <input onkeyup="parentaddvalidation('#prntform #Occupation', '#prntform .Occupationerror')" type="text" class="form-control" id="Occupation" name="occupation" placeholder="Business" />
                                    <small class=" text-danger d-none Occupationerror">{{ __('Ocupation is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="Migrant">{{ __('Migrant') }}</label>
                                    <select class="form-control" id="Migrant" name="migrant">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="Caregiver">{{ __('Primary Caregiver') }}</label>
                                    <select class="form-control" id="primary_caregiver" name="primary_caregiver">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="information">{{ __('If there is a different caregiver please provide their information') }}</label>
                                    <input onkeyup="parentaddvalidation('#prntform #information', '#prntform .informationerror')" type="text" class="form-control" id="information" name="caregiver_info" placeholder="No" />
                                    <small class=" text-danger d-none informationerror">{{ __('Information is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <button disabled type="submit" class="primary-btn-lg btn-rounded prntsave disable-color">{{ __('Add Family Member') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--AddParent  Modal -->
    <!--addPrenatalHistory  Modal -->
    <div class="modal fade" id="addPrenatalHistory" tabindex="-1" >
        <div class="modal-dialog large-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ __('Prenatal History') }}</h2>
                    <form action="{{ isset($prenatal) ? route('edit-prenatal-history', $patient->id) : route('add-prenatal-history', $patient->id) }}" id="phform" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="pCourse">{{ __('Prenatal Course') }}</label>
                                    <input onkeyup="addvalidation('#phform #pCourse', '#phform .pCourseerror')" type="text" class="form-control" id="pCourse" name="course" placeholder="Lorem Ipsum" value="{{ isset($prenatal) ? $prenatal->course : '' }}" />
                                    <small class=" text-danger d-none pCourseerror">{{ __('Prenatal Course field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="PregnancyNumber">{{ __('Pregnancy Number') }}</label>
                                    <input onkeyup="addvalidation('#phform #PregnancyNumber', '#phform .PregnancyNumbererror')" onkeypress="return isNumber(event)" type="text" class="form-control" id="PregnancyNumber" name="pregnancy_no" placeholder="2" value="{{ isset($prenatal) ? $prenatal->pregnancy_no : '' }}" />
                                    <small class=" text-danger d-none PregnancyNumbererror">{{ __('Prenatal Course field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkbox-lsit d-flex">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="HighRisk" name="high_risk" {{ isset($prenatal) ? $prenatal->high_risk == 1 ? 'checked' : '' : '' }}>
                                        <label class="form-check-label" for="HighRisk">{{ __('High Risk') }}</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="RiskAbortion" name="abortion" {{ isset($prenatal) ? $prenatal->abortion == 1 ? 'checked' : '' : '' }}>
                                        <label class="form-check-label" for="RiskAbortion">{{ __('Risk of Abortion') }}</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="RiskParturition" name="premature_parturition" {{ isset($prenatal) ? $prenatal->premature_parturition == 1 ? 'checked' : '' : '' }}>
                                        <label class="form-check-label" for="RiskParturition">{{ __('Risk of Premature Parturition') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Diagnosis">{{ __('Prenatal Diagnosis') }}</label>
                                    <textarea onkeyup="addvalidation('#phform #Diagnosis', '#phform .diagnosiserror')" class="form-control message-box" id="Diagnosis" rows="3" placeholder="Add Diagnosis" name="diagnosis">{{ isset($prenatal) ? $prenatal->diagnosis : '' }}</textarea>
                                    <small class=" text-danger d-none diagnosiserror">{{ __('Prenatal Diagnosis field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <button disabled type="submit" class="primary-btn-lg btn-rounded changesave disable-color">{{ isset($prenatal) ? 'Edit' : 'Add' }} {{ __('Prenatal History') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--addPrenatalHistory  Modal -->
    <!--Birthinformation  Modal -->
    <div class="modal fade" id="Birthinformation" tabindex="-1" >
        <div class="modal-dialog large-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ __('Birth information') }}</h2>
                    <form action="{{ isset($birth_info) ? route('edit-birth-information', $patient->id) : route('add-birth-information', $patient->id) }}" id="birthinfo" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="pCourse1">{{ __('Birth Weight (kg or g)') }}</label>
                                    <input onkeyup="birthinfovalidation('#birthinfo #pCourse1', '#birthinfo .pCourse1error')" onkeypress="return isNumber(event)" type="text" class="form-control" id="pCourse1" name="birth_weight" placeholder="30" value="{{ isset($birth_info) ? $birth_info->birth_weight : '' }}" />
                                    <small class=" text-danger d-none pCourse1error">{{ __('Birth Weight field is required') }}</small>
                                    <select class="form-right-option" name="weight_unit">
                                        <option value="kg" {{ isset($birth_info) ? $birth_info->weight_unit == 'kg' ? 'selected' : '' : '' }}>KG</option>
                                        <option value="g" {{ isset($birth_info) ? $birth_info->weight_unit == 'g' ? 'selected' : '' : '' }}>G</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="BirthLength">{{ __('Birth Length (cm or inches)') }}</label>
                                    <input onkeyup="birthinfovalidation('#birthinfo #BirthLength', '#birthinfo .BirthLength')" onkeypress="return isNumber(event)" type="text" class="form-control" id="BirthLength" name="birth_length" placeholder="30" value="{{ isset($birth_info) ? $birth_info->birth_length : '' }}" />
                                    <small class=" text-danger d-none BirthLength">{{ __('Birth Length field is required') }}</small>
                                    <select class="form-right-option" name="length_unit">
                                        <option value="cm" {{ isset($birth_info) ? $birth_info->length_unit == 'cm' ? 'selected' : '' : '' }}>CM</option>
                                        <option value="ml" {{ isset($birth_info) ? $birth_info->length_unit == 'ml' ? 'selected' : '' : '' }}>Ml</option>
                                        <option value="m" {{ isset($birth_info) ? $birth_info->length_unit == 'm' ? 'selected' : '' : '' }}>M</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="Apgars">{{ __('Apgars') }}</label>
                                    <input onkeypress="return isNumber(event)" type="text" class="form-control" id="Apgars" name="apgars" placeholder="9.9" value="{{ isset($birth_info) ? $birth_info->apgars : '' }}" />
                                    <small class=" text-danger d-none Apgarserror">{{ __('Apgars field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkbox-lsit d-flex">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="immediately" name="skin_immediately" {{ isset($birth_info) ? $birth_info->skin_immediately == '1' ? 'checked' : '' : '' }}>
                                        <label class="form-check-label" for="immediately">Skin to skin immediately</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="Breastfeeding" name="breastfeeding" {{ isset($birth_info) ? $birth_info->breastfeeding == '1' ? 'checked' : '' : '' }}>
                                        <label class="form-check-label" for="Breastfeeding">Immediate Breastfeeding</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="Distress" name="respiratory_distress" {{ isset($birth_info) ? $birth_info->respiratory_distress == '1' ? 'checked' : '' : '' }}>
                                        <label class="form-check-label" for="Distress">History of Respiratory Distress</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="Jaundice" name="jaundice" {{ isset($birth_info) ? $birth_info->jaundice == '1' ? 'checked' : '' : '' }}>
                                        <label class="form-check-label" for="Jaundice">Jaundice</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="Sepsis" name="spesis" {{ isset($birth_info) ? $birth_info->spesis == '1' ? 'checked' : '' : '' }}>
                                        <label class="form-check-label" for="Sepsis">Sepsis</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="hospitalization">{{ __('Infant Required hospitalization?') }} </label>
                                    <select class="form-control" id="hospitalization" name="hospitalization">
                                        <option value="1" {{ isset($birth_info) ? $birth_info->hospitalization == '1' ? 'selected' : '' : '' }}>Yes</option>
                                        <option value="0" {{ isset($birth_info) ? $birth_info->hospitalization == '0' ? 'selected' : '' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6">
                                <div class="form-group">
                                    <label for="foods">{{ __('How old was the baby when starting solid foods') }}</label>
                                    <input type="text" class="form-control" id="foods" name="solid_foods" placeholder="2 Years" value="{{ isset($birth_info) ? $birth_info->solid_foods : '' }}" />
                                    <small class=" text-danger d-none foodserror">{{ __('Solid foods field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="fruits">{{ __('Does the baby eat fresh fruits') }}</label>
                                    <select class="form-control" id="fruits" name="fresh_fruits">
                                        <option value="1" {{ isset($birth_info) ? $birth_info->fresh_fruits == '1' ? 'selected' : '' : '' }}>Yes</option>
                                        <option value="0" {{ isset($birth_info) ? $birth_info->fresh_fruits == '0' ? 'selected' : '' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <button disabled type="submit" class="primary-btn-lg btn-rounded birtninfobtn disable-color">{{ isset($birth_info) ? 'Edit' : 'Add' }} {{ __('Birth Information') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Birthinformation  Modal -->

    <div class="modal fade" id="Vaccine" tabindex="-1" >
        <div class="modal-dialog small-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">Vaccine</h2>
                    <form action="{{ route('immunization.add', $patient->id) }}" method="post">
                        @csrf
                        {{-- <input type="hidden" name="vaccine_id" value="{{ $vaccine->id }}" /> --}}
                        {{-- <input type="hidden" name="today" value="{{ date("Y-m-d") }}"> --}}
                        <div class="form-group">
                            <select name="vaccine_id" class="form-control">
                                <option value="">--Please Select a vaccine--</option>
                                @foreach ($vaccines as $id => $v)
                                <option value="{{ $id }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="vaccine_date[]">
                        </div>
                        <button type="submit" class="primary-btn-lg btn-rounded d-block w-100">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($clinical_encounters as $clm)
    <div class="modal fade" id="Encounter{{ $clm->id }}" tabindex="-1" >
        <div class="modal-dialog large-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ __('Encounter Details') }}</h2>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="DosageForm">{{ __('Chief Complaint') }} </label>
                                    <input type="text" class="form-control" name="dosage_form" value="{{ $clm->chief_complaint }}" disabled />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Period">{{ __('History of Illness') }}</label>
                                    <textarea class="form-control message-box" id="dnotes" rows="3" disabled>{{ $clm->history_illness }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Period">{{ __('Physical Exam') }}</label>
                                    <textarea onkeyup="addvalidation('#Suppliments #dnotes', '#Suppliments .notes')" class="form-control message-box" id="dnotes" rows="3" disabled>{{ $clm->physical_exam }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Period">{{ __('Assessment') }}</label>
                                    <textarea onkeyup="addvalidation('#Suppliments #dnotes', '#Suppliments .notes')" class="form-control message-box" id="dnotes" rows="3" disabled>{{ $clm->assesment }}</textarea>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="secondary-table birth-table">
                    <div class="table-responsive mb-15">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">{{ __('Medical Code') }}</th>
                                <th scope="col">{{ __('Description') }}</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse ($clm->medical_problems as $mp)
                                    <tr>
                                        <td>{{ $mp->medical_code }}</td>
                                        <td>{{ $mp->description }}</td>
                                    </tr>
                                @empty

                                <tr>
                                    <td colspan="7" align="center"><h2>{{ __('No Encounter Found!') }}</h2></td>
                                </tr>

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="secondary-table birth-table">
                    <div class="table-responsive mb-15">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">{{ __('Medicine') }}</th>
                                <th scope="col">{{ __('Dosage') }}</th>
                                <th scope="col">{{ __('Quantity') }}</th>
                                <th scope="col">{{ __('Period') }}</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse ($clm->medications as $med)
                                    <tr>
                                        <td>{{ $med->description }}</td>
                                        <td>{{ $med->dosage }}</td>
                                        <td>{{ $med->order_qty }}</td>
                                        <td>{{ $med->period }}</td>
                                    </tr>
                                @empty

                                <tr>
                                    <td colspan="7" align="center"><h2>{{ __('No Encounter Found!') }}</h2></td>
                                </tr>

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="secondary-table birth-table">
                    <div class="table-responsive mb-15">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">{{ __('Supplements') }}</th>
                                <th scope="col">{{ __('Per Day') }}</th>
                                <th scope="col">{{ __('Order Qty') }}</th>
                                <th scope="col">{{ __('Period') }}</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse ($clm->suppliments as $spl)
                                    <tr>
                                        <td>{{ $spl->description }}</td>
                                        <td>{{ round($spl->per_day_qty) }}</td>
                                        <td>{{ $spl->order_qty }}</td>
                                        <td>{{ $med->period }}</td>
                                    </tr>
                                @empty

                                <tr>
                                    <td colspan="7" align="center"><h2>{{ __('No Encounter Found!') }}</h2></td>
                                </tr>

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endpush
@endsection

@push('scripts')

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

        if($('#pCourse').val() == '' || $('#PregnancyNumber').val() == '' || $('#Diagnosis').val() == ''){
            $('.changesave').attr("disabled", true).addClass('disabled disable-color');
            return;
        }else{
            $('.changesave').attr("disabled", false).removeClass('disabled disable-color');
        }
    }


</script>
<script>
    //edit form validation
    var $ = jQuery;
    function parentaddvalidation($class, $formeroorclass) {
        parentcheckthevalue();

        if ($($class).val() == '') {
            $($formeroorclass).removeClass('d-none');
        } else {
            $($formeroorclass).addClass('d-none');
        }
    }

  function parentcheckthevalue(){
        if($('#FirstName1').val() == '' || $('#lastname3').val() == '' || $('#Identity').val() == '' || $('#phone').val() == '' || $('#whatapps').val() == '' || $('#DPINumber').val() == '' || $('#Occupation').val() == '' || $('#information').val() == ''){
            $('.prntsave').attr("disabled", true).addClass('disabled disable-color');
            return;
        }else{
            $('.prntsave').attr("disabled", false).removeClass('disabled disable-color');
        }
    }


</script>

<script>
    //edit form validation
    var $ = jQuery;
    function birthinfovalidation($class, $formeroorclass) {
        birthcheckthevalue();

        if ($($class).val() == '') {
            $($formeroorclass).removeClass('d-none');
        } else {
            $($formeroorclass).addClass('d-none');
        }
    }

  function birthcheckthevalue(){
        if($('#pCourse1').val() == '' || $('#BirthLength').val() == ''){
            $('.birtninfobtn').attr("disabled", true).addClass('disabled disable-color');
            return;
        }else{
            $('.birtninfobtn').attr("disabled", false).removeClass('disabled disable-color');
        }
    }


</script>

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
      url: "{{route('patient.image.update', $patient->id)}}",
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

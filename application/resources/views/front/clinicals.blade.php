@extends('layouts.front')
@section('title', 'Clinicals')
@section('content')
<div class="section-header mb-20">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="section-title">Check In Patient</h2>
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
<div class="primary-form mb-10">
    <div class="row">
        <div class="col-lg-10 col-md-8">
            <form action="#">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group" id="pnamegroup">
                            <label for="pname">{{ __('Patient Name') }}</label>
                            <input autocomplete="off" onkeyup="searchpatientbyname(this)" type="text" class="form-control" id="pname" name="pname" value="{{ isset($patientId) ? $patientId->name : '' }}" placeholder="Write patient name" />

                            <ul class="serachnamelist search-list d-none" id="searchItem">

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="PatientID">{{ __('Patient ID') }}</label>
                            <input readonly type="text" class="form-control" id="PatientID" name="PatientID"  value="{{ isset($patientId) ? $patientId->id : '' }}" placeholder="#" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-2 col-md-4">
            <div class="form-group mt-md-5 pt-2">
                <button disabled id="add_now" data-toggle="modal" data-target="#addPatient" class="primary-btn-lg btn-rounded disable-color">{{ __('Add Now') }}</button>
            </div>
        </div>
    </div>
</div>
<div class="section-header mb-20">
    <div class="row">
        @include('include.message')
        <div class="col-sm-12">
            <h2 class="section-title">{{ __('Clinic Dashboard') }}</h2>
        </div>
    </div>
</div>
<div class="primary-table">
    <div class="table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">{{ __('Last Name') }}</th>
                <th scope="col">{{ __('Visit Reason') }}</th>
                <th scope="col">{{ __('Arrival Time') }}</th>
                <th scope="col">{{ __('Doctor') }}</th>
                <th scope="col" colspan="2">{{ __('Status') }}</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($checked_ins as $checked_in)
                    <tr>
                        <td>
                            <div class="media patient-info align-items-center">
                                <img src="{{
                                    isset($checked_in->patient->image) ? asset(path_patient_image().$checked_in->patient->image) : Avatar::create($checked_in->patient->first_name . ' ' . $checked_in->patient->last_name)->toBase64()
                                }}" class="mr-3" alt="patient" />
                                <div class="media-body">
                                    <h5>{{ $checked_in->patient->first_name }}</h5>
                                    <span>#{{ $checked_in->patient->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td>{{ $checked_in->reason }}</td>
                        <td>{{ $checked_in->created_at->format('jS \\of F Y h:i A') }}</td>
                        <td><b>{{ $checked_in->doctor->name }}</b></td>
                        <td>
                            @if ($checked_in->status == 1)
                                <span class="check-in status">{{ __('Checked In') }}</span>
                            @elseif ($checked_in->status == 2)
                                <span class="processing status">{{ __('Processing') }}</span>
                            @else
                                <span class="checked-out status">{{ __('Checked Out') }}</span>
                            @endif

                        </td>
                        <td>
                            <ul class="options-btn">
                                <li>
                                    <div class="dropdown">
                                        <a class="edite-btn" href="#" data-toggle="dropdown">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if ($checked_in->status != 3)
                                            <div class="dropdown-menu">
                                                <a href="{{ route('edit.patient-chart.post', $checked_in->patient->id) }}">{{ __('Patient Chart') }}</a>
                                                @if ($checked_in->status == 2)
                                                    <a href="{{ route('patient.public-health',  ['patient_id' =>$checked_in->patient->id, 'checkin_id' => $checked_in->id]) }}">{{ __('Public Health') }}</a>
                                                @else
                                                    <a href="{{ route('patient.public-health',  ['patient_id' =>$checked_in->patient->id, 'checkin_id' => $checked_in->id]) }}">{{ __('Public Health') }}</a>
                                                @endif

                                                <a href="{{ route('patient.vital-sign', $checked_in->patient->id) }}">{{ __('Vital Signs') }}</a>
                                                <a href="{{ route('patient.clinical-encounter', $checked_in->patient->id) }}">{{ __('Clinic Note') }}</a>
                                                <a href="{{ route('patient.order.index', ['patient_id' =>$checked_in->patient->id] ) }}">{{ __('Orders') }}</a>
                                                <a href="{{ route('patient.suppliment.order.index', ['patient_id' =>$checked_in->patient->id] ) }}">{{ __('Supplements') }}</a>
                                                <a href="{{ route('checkout', ['patient_id' =>$checked_in->patient->id, 'checkin_id' => $checked_in->id] ) }}">{{ __('Checkout') }}</a>
                                            </div>
                                        @endif

                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <a class="delet-btn" onclick="return deleteConfirmation()" href="{{ route('clinical.delete', $checked_in->id) }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="7" align="center"><h2>{{ __('No Action Found!') }}</h2></td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
    <div class="table-pagination mt-30">
        <div class="row">
            {!! $checked_ins->links('pagination::custom') !!}
        </div>
    </div>
</div>
@endsection

@push('modal')
<!--Add New Patient  Modal -->
<div class="modal fade" id="addPatient" tabindex="-1" >
    <div class="modal-dialog large-model modal-dialog-centered">
        <div class="modal-content container">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="primary-form">
                <h2 class="form-title mb-25">{{ __('Check In Patient') }}</h2>

                <form id="checkinform" action="{{ route('clinicals.add.checkedin') }}" method="POST">
                    @csrf
                    <input type="hidden" id="pid" name="patient_id" value="{{ isset($patientId) ? $patientId->id : '' }}">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="Reason">{{ __('Visit Reason') }}</label>
                                <input onkeyup="birthinfovalidation('#checkinform #Reason', '#checkinform .foodserror')" type="text" class="form-control" id="Reason" name="reason" placeholder="Write reason" />
                                <small class="text-danger d-none foodserror">{{ __('Visit Reason field is required') }}</small>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="LastName2">{{ __('Assign Doctor') }}</label>

                                <select id="docoption" class="select wide" name="doctor_id">
                                    {{-- <option value="">--SELECT A DOCTOR--</option> --}}
                                    @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger d-none docoption">{{ __('Doctor field is required') }}</small>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <button disabled type="submit" class="primary-btn-lg btn-rounded min-width-145 birtninfobtn disable-color">{{ __('Add Now') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Add New Patient  Modal -->
@endpush

@push('scripts')

<script>
    //edit form validation
    var $ = jQuery;
    function birthinfovalidation($class, $formeroorclass) {
        checkthevalue();
        console.log($($class).val() == '');
        if ($($class).val() == '') {
            $($formeroorclass).removeClass('d-none');
        } else {
            $($formeroorclass).addClass('d-none');
        }
    }

  function checkthevalue(){
        if($('#Reason').val() == ''){
            $('.birtninfobtn').attr("disabled", true).addClass('disabled disable-color');
            return;
        }else{
            $('.birtninfobtn').attr("disabled", false).removeClass('disabled disable-color');
        }
    }


</script>

<script>

$(document).ready(function(){
    if($('#PatientID').val() != ''){
        enableAddnow()
    }
});

function enableAddnow(){
    $('#add_now').removeAttr('disabled').removeClass('disable-color');
}

function searchpatientbyname(data){
    if(data.value == ''){
        $('.serachnamelist').hide();
        $('#add_now').addClass('disable-color');

        return;
    }
    $('.serachnamelist').show();
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: 'POST',
      url: "{{ route('clinicals.searchbyname') }}",
      data: {
          name:data.value,
      },

    }).done(function(data) {
        $('#searchItem').removeClass('d-none');
        html = '';
        if(data != false){
            data.forEach(element => {
                html += `
                    <li class="searchname" data-id=${element.id} data-fname=${element.first_name} data-lname=${element.last_name} onclick="addparentid(this)">
                        <a href="javascript:void(0)">${element.first_name+ ' ' + element.last_name}</a>

                        </li>
                `;
            });

            $('.serachnamelist').html(html)
            html =''
        }else{
            html = '';
            html += `
                    <li>
                        No Result Found
                        </li>
                `;
           $('.serachnamelist').html(html);
        }
    });

}

function addparentid(data){
    $('.serachnamelist').hide();
    let patientid = $(data).data('id');
    let patientname = $(data).data('fname');
    let lastname = $(data).data('lname');
    let fullname = patientname + ' ' +lastname;
    $('#PatientID').val(patientid);
    $('#pid').val(patientid);
    $('#pname').val(fullname);
    console.log();
    enableAddnow()
}
$(document).on('click', function () {
    $('.serachnamelist').hide();
});
$('#pnamegroup').click(function(event) {
    event.stopPropagation();
})
</script>
@endpush

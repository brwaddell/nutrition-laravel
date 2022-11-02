@extends('layouts.front')
@section('title', 'Clinical Encounter')
@section('content')
<div class="profile-area mb-40">
    @if(isVSComplete($patient_id->id) != 1)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="p-0 m-0" style="list-style: none;">
                {{ __('This section is disabled! First you have to complete') }} <a href="{{ route('patient.vital-sign', $patient_id->id) }}">{{ __('vital signs') }}</a>!
            </ul>
        </div>
    @endif
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
    {{ breadcumb($patient_id->id) }}
</div>
<div class="row">
    <div class="col-lg-7 col-md-6 order-last order-md-first">
        <div class="section-header-two mb-35">
            <h2 class="section-title">{{ __('Clinical Encounter') }}</h2>
        </div>
        <div class="primary-form mb-35">
            <form action="{{ route('publichealth.clinical-encounter') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="Complaint">{{ __('Chief Complaint') }}</label>
                    <input type="text" class="form-control" id="Complaint" onkeyup="saveLocal(this.value, 'Complaint')" name="chief_complaint" placeholder="Mumps Stage II" value="{{ isset($clinical) ? $clinical->chief_complaint : '' }}" {{ isVSComplete($patient_id->id) != 1 || Auth::user()->role != 'doctor' ? 'disabled' : '' }}  />
                </div>
                <div class="form-group">
                    <label for="History">{{ __('History of Illness') }}</label>
                    <textarea class="form-control message-box" id="History" onkeyup="saveLocal(this.value, 'History')" name="history_illness" rows="3" placeholder="Lorem Ipsum Dolor Sit Amet" {{ isVSComplete($patient_id->id) != 1 || Auth::user()->role != 'doctor' ? 'disabled' : '' }}>{{ isset($clinical) ? $clinical->history_illness : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="Physical">{{ __('Physical Exam') }}</label>
                    <textarea class="form-control message-box" id="Physical" onkeyup="saveLocal(this.value, 'Physical')" name="physical_exam" rows="3" placeholder="Lorem Ipsum Dolor Sit Amet" {{ isVSComplete($patient_id->id) != 1 || Auth::user()->role != 'doctor' ? 'disabled' : '' }}>{{ isset($clinical) ? $clinical->physical_exam : '' }}</textarea>
                </div>

        </div>
        {{-- <div class="section-header-two mb-35">
            <h2 class="section-title">{{ __('Clinical Encounter') }}</h2>
        </div> --}}
    </div>
    <div class="col-lg-5 col-md-6 order-first order-md-last">
        <div class="single-info-box">
            <h3 class="info-title">{{ __('Vital Signs') }} </h3>
            <ul>
                <li>
                    <div class="info-left">
                        <span>{{ __('Height') }}</span>
                        <b>{{ isset($vital) ? $vital->height .' '. strtolower($vital->height_unit) : 'N/A' }}</b>
                    </div>
                    <div class="info-right">
                        <span>{{ __('Weight') }} </span>
                        <b>{{ isset($vital) ? $vital->weight .' '. strtolower($vital->weight_unit) : 'N/A' }}</b>
                    </div>
                </li>
                <li>
                    <div class="info-left">
                        <span>{{ __('Height for Age') }}</span>
                        <b>{{ isset($vital) ? 'N/A' : 'N/A' }}</b>
                    </div>
                    <div class="info-right">
                        <span>{{ __('Weight for Age') }} </span>
                        <b>{{ isset($vital) ? 'N/A' : 'N/A' }}</b>
                    </div>
                </li>
            </ul>
        </div>
        <div class="single-info-box">
            <h3 class="info-title">{{ __('Medical Problems') }}</h3>
            <ul>
                <li>
                    <div class="info-left">
                        <span>{{ __('Diagnosis') }}</span>
                    </div>
                    <div class="info-right">
                        <span>{{ __('Date of Diagnosis') }} </span>
                    </div>
                </li>
                @foreach ($medicalProblems as $mp)
                    <li>
                        <div class="info-left">
                            <b>{{ $mp->description }}</b>
                        </div>
                        <div class="info-right">
                            <b>{{ $mp->created_at->format('d/m/Y') }}</b>
                        </div>
                    </li>
                    @endforeach

            </ul>
        </div>
        <div class="single-info-box">
            <h3 class="info-title">{{ __('Current Treatment Plan') }}</h3>
            <ul>
                <li>
                    <div class="info-left">
                        <span>{{ __('Supplements') }}</span>
                    </div>
                    <div class="info-right">
                        <span>{{ __('Medications') }}</span>
                    </div>
                </li>
                <li>
                    <div class="info-left">
                        @foreach ($suppliment_orders as $cso)
                            @php
                                $current_day_count_supp = \Carbon\Carbon::parse($cso->updated_at)->diffInDays(\Carbon\Carbon::now());
                            @endphp
                            @if ($current_day_count_supp <= $cso->period)
                                <b>{{ $cso->suppliment->food_name }} {{ $cso->per_day_qty }} pack/day </b><br>
                            @endif


                        @endforeach
                        {{-- <b>Nutributters 1 pack/day</b> --}}
                    </div>
                    <div class="info-right">
                        @foreach ($medications as $cm)
                            @php
                                $current_day_count = \Carbon\Carbon::parse($cm->updated_at)->diffInDays(\Carbon\Carbon::now());
                            @endphp
                            @if ($current_day_count <= $cm->period)
                                <b>{{ $cm->drug->item_name }} </b><small>({{ $cm->period - $current_day_count }} days left)</small><br>
                            @endif


                        @endforeach
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="section-border-wrap mb-40">
    <div class="section-inner-header">
        <h3 class="title">{{ __('Encounter Impression') }}</h3>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="primary-form mb-35">
                    <div class="form-group">
                        <label for="Assessment">{{ __('Assessment') }}</label>
                        <textarea class="form-control big-message-box" id="Assessment" onkeyup="saveLocal(this.value, 'Assessment')"  name="assesment" rows="3" placeholder="Free type text here" {{ isVSComplete($patient_id->id) != 1 || Auth::user()->role != 'doctor' ? 'disabled' : '' }}>{{ isset($clinical) ? $clinical->assesment : '' }}</textarea>
                    </div>
                    <input type="hidden" name="patient_id" value="{{ $patient_id->id }}">
                    <input type="hidden" name="clinic_id" value="{{ session()->get('clinic_id') }}">

            </div>
        </div>
        <div class="col-md-5">
            <div class="section-inner-header mb-3">
                <h3 class="title">{{ __('Weight for Age') }}</h3>
            </div>
            <div class="single-chart pt-0">
                <div id="WeightAge"></div>
            </div>
        </div>
    </div>
    <div class="secondary-table medication-table">
        <input type="text" id="codeid" placeholder="Search code here">
        <div class="text-danger code-error"></div>
        <div class="text-danger code-delerror"></div>
        <ul id="code" class="search-list">

        </ul>

        <div class="table-responsive mb-15">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col"><input type="checkbox" id="exampleCheck6" /></th>
                    <th scope="col">{{ __('Medical Code') }}</th>
                    <th scope="col">{{ __('Code') }}</th>
                    <th scope="col">{{ __('Description') }}</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="addData">


                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="plan-area">
    <div class="section-header-two mb-35">
        <h2 class="section-title">{{ __('Plan') }}</h2>
    </div>
    <div class="section-border-wrap">
        <div class="medication-area mb-40">
            <div class="section-inner-header">
                <h3 class="title">{{ __('Medication') }}</h3>
            </div>
            <div class="secondary-table medication-table">
                <div class="table-responsive mb-15">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"><input type="checkbox" id="exampleCheck2" /></th>
                            <th scope="col">{{ __('Drug') }}</th>
                            <th scope="col">{{ __('Description') }}</th>
                            <th scope="col">{{ __('Dosage') }}</th>
                            <th scope="col">{{ __('Period') }}</th>
                            <th scope="col">{{ __('Prescribed By') }}</th>
                            <th scope="col">{{ __('Date') }}</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($medications as $medication)
                                <tr>
                                    <td><input type="checkbox" id="exampleCheck3" /> <span class="id-number">1</span></td>
                                    <td>{{ $medication->drug->item_name }}</td>
                                    <td>{{ $medication->description }}</td>
                                    <td>{{ $medication->dosage }}</td>
                                    <td>{{ $medication->period }} days</td>
                                    <td>{{ $medication->doctor->name }}</td>
                                    <td>{{ $medication->created_at->diffForHumans() }}</td>
                                    <td class="text-center"><a href="#" class="text-center"><i class="fas fa-angle-down"></i></a></td>
                                </tr>
                            @empty

                            <tr>
                                <td colspan="8" align="center"><h2>{{ __('No Medication Found!') }}</h2></td>
                            </tr>

                            @endforelse

                        </tbody>
                    </table>
                </div>

                <a href="#" data-toggle="modal" data-target="#{{ Auth::user()->role != 'doctor' ? '' : 'Medication' }}" class="primary-btn {{ Auth::user()->role != 'doctor' ? 'disable-color' : '' }}">{{ __('Add Medication') }}</a>
            </div>
        </div>
        <div class="medication-area mb-40">
            <div class="section-inner-header">
                <h3 class="title">{{ __('Supplements') }}</h3>
            </div>
            <div class="secondary-table medication-table">
                <div class="table-responsive mb-15">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"><input type="checkbox" id="exampleCheck2" /></th>
                            <th scope="col">{{ __('Food') }}</th>
                            <th scope="col">{{ __('Description') }}</th>
                            <th scope="col">{{ __('Qty') }}</th>
                            <th scope="col">{{ __('Period') }}</th>
                            <th scope="col">{{ __('Prescribed By') }}</th>
                            <th scope="col">{{ __('Date') }}</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($suppliment_orders as $suppliment_order)
                                <tr>
                                    <td><input type="checkbox" id="exampleCheck3" /> <span class="id-number">1</span></td>
                                    <td>{{ $suppliment_order->suppliment->food_name }}</td>
                                    <td>{{ $suppliment_order->description }}</td>
                                    <td>{{ $suppliment_order->per_day_qty }}</td>
                                    <td>{{ $suppliment_order->period }} days</td>
                                    <td>{{ $suppliment_order->doctor->name }}</td>
                                    <td>{{ $suppliment_order->created_at->diffForHumans() }}</td>
                                    <td class="text-center"><a href="#" class="text-center"><i class="fas fa-angle-down"></i></a></td>
                                </tr>
                            @empty

                            <tr>
                                <td colspan="8" align="center"><h2>{{ __('No Medication Found!') }}</h2></td>
                            </tr>

                            @endforelse

                        </tbody>
                    </table>
                </div>
                <a href="#" data-toggle="modal" data-target="#{{ Auth::user()->role != 'doctor' ? '' : 'Suppliments' }}" class="primary-btn {{ Auth::user()->role != 'doctor' ? 'disable-color' : '' }}">{{ __('Add Supplements') }}</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="primary-form mb-35">
                    <div class="form-group">
                        <label for="Complaint">{{ __('Doctor Sign') }}</label>
                        <input type="text" class="form-control" name="doctor_sign" placeholder="John Doe" {{ isVSComplete($patient_id->id) != 1 || Auth::user()->role != 'doctor' ? 'disabled' : '' }}  />
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="primary-form mb-35">
                    <div class="form-group">
                        <label for="Complaint">{{ __('Date') }}</label>
                        <input type="date" class="form-control" name="signing_date" {{ isVSComplete($patient_id->id) != 1 || Auth::user()->role != 'doctor' ? 'disabled' : '' }}  />
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mt-2">
            <button type="submit" onclick="beforeSubmit()" class="primary-btn-lg btn-rounded min-width-145 {{ isVSComplete($patient_id->id) != 1 || Auth::user()->role != 'doctor' ? 'disable-color' : '' }}" {{ isVSComplete($patient_id->id) != 1 || Auth::user()->role != 'doctor' ? 'disabled' : '' }}>{{ __('Sign & Save') }}</button>
        </div>
    </form>
        {{-- <div class="laboratory">
            <div class="section-inner-header">
                <h3 class="title">Laboratory</h3>
            </div>
            <div class="secondary-table">
                <div class="table-responsive mb-15">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"><input type="checkbox" id="exampleCheck4" /></th>
                            <th scope="col">Test</th>
                            <th scope="col">Result</th>
                            <th scope="col">Dosage</th>
                            <th scope="col">Period</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><input type="checkbox" id="exampleCheck5" /> <span class="id-number">1</span></td>
                            <td>Azithromycin</td>
                            <td>Azithromycin</td>
                            <td>1-0-1</td>
                            <td>Period</td>
                            <td class="text-center"><a href="#" class="text-center"><i class="fas fa-angle-down"></i></a></td>
                          </tr>
                        </tbody>
                    </table>
                </div>
                <a href="#" class="primary-btn">Add Row</a>
            </div>
        </div> --}}
    </div>
</div>

@push('modal')
    <!--Add New Patient  Modal -->
    <div class="modal fade" id="Medication" tabindex="-1" >
        <div class="modal-dialog large-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ __('Medication') }}</h2>
                    <form id="medicationform" action="{{ route('add.medication') }}" method="POST">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient_id->id }}">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="Drug">{{ __('Drug') }}</label>
                                    <select name="drug_id" class="form-control" onchange="descValue(this.value)">
                                        <option value="">----SELECT A DRUG----</option>
                                        @foreach ($drugs as $drug)
                                            <option value="{{ $drug->id }}">{{ $drug->item_name }} ({{ $drug->category }} - {{ $drug->type }})</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" class="form-control" id="Drug" name="Drug" placeholder="azithromycin" /> --}}
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="DrugName">{{ __('Drug Description') }}</label>

                                    <input type="text" class="form-control" id="description" name="description" placeholder="azithromycin" readonly />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="Dosage">{{ __('Dosage') }}</label>
                                    <input onkeyup="birthinfovalidation('#Medication #dosage', '#Medication .foodserror')" type="text" class="form-control" id="dosage" name="dosage" placeholder="1-0-1" />
                                    <small class=" text-danger d-none foodserror">{{ __('Dosage field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="Period1">{{ __('Period') }}</label>
                                    <input onkeyup="birthinfovalidation('#Medication #period', '#Medication .perioderror')" type="number" class="form-control" min="1" id="period" name="period" placeholder="In days" />
                                    <small class=" text-danger d-none perioderror">{{ __('Period field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="DosageForm">{{ __('Dosage Form') }} </label>
                                    <input type="text" class="form-control" id="dosage_form" name="dosage_form" placeholder="" readonly />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Period">{{ __('Notes') }}</label>
                                    <textarea onkeyup="birthinfovalidation('#Medication #notes', '#Medication .noteserror')" class="form-control message-box" id="notes" rows="3" placeholder="Write notes"></textarea>
                                    <small class=" text-danger d-none noteserror">{{ __('Notes field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <button disabled type="submit" class="primary-btn-lg btn-rounded min-width-145 birtninfobtn disable-color">{{ __('Insert') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Suppliments" tabindex="-1" >
        <div class="modal-dialog large-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ __('Suppliments') }}</h2>
                    <form action="{{ route('add.suppliment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient_id->id }}">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="Drug">{{ __('Food') }}</label>
                                    <select name="suppliment_id" class="form-control" onchange="descValueSuup(this.value)">
                                        <option>Select</option>
                                        @forelse ($suppliments as $suppliment)
                                            <option value="{{ $suppliment->id }}">{{ $suppliment->food_name }} ({{ $suppliment->category }} - {{ $drug->type }})</option>
                                        @empty
                                            <option value="">{{ __('No suppliment here') }}</option>
                                        @endforelse
                                    </select>
                                    {{-- <input type="text" class="form-control" id="Drug" name="Drug" placeholder="azithromycin" /> --}}
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="DrugName">{{ __('Description') }}</label>

                                    <input type="text" class="form-control" id="description_supp" name="description" placeholder="azithromycin" readonly />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="Dosage">{{ __('Per Day Qty') }}</label>
                                    <input onkeyup="addvalidation('#Suppliments #dosage_supp', '#Suppliments .pCourseerror')" type="number" step="0.1" class="form-control" id="dosage_supp" name="per_day_qty" placeholder="1" />
                                    <small class=" text-danger d-none pCourseerror">{{ __('Per Day Qty field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="Period1">{{ __('Period') }}</label>
                                    <input onkeyup="addvalidation('#Suppliments #period_supp', '#Suppliments .period_supp')" type="number" class="form-control" min="1" id="period_supp" name="period" placeholder="In days" />
                                    <small class=" text-danger d-none period_supp">{{ __('Period field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="DosageForm">{{ __('Dosage Form') }} </label>
                                    <input type="text" class="form-control" id="dosage_form_supp" name="dosage_form" placeholder="Lorem Ipsum" readonly />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Period">{{ __('Notes') }}</label>
                                    <textarea onkeyup="addvalidation('#Suppliments #dnotes', '#Suppliments .notes')" class="form-control message-box" id="dnotes" rows="3" placeholder="write notes here"></textarea>
                                    <small class=" text-danger d-none notes">{{ __('Notes field is required') }}</small>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <button disabled type="submit" class="primary-btn-lg btn-rounded min-width-145 supplimentform disable-color">{{ __('Insert') }}</button>
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

        if ($($class).val() == '') {
            $($formeroorclass).removeClass('d-none');
        } else {
            $($formeroorclass).addClass('d-none');
        }
    }

  function checkthevalue(){
        if($('#dosage').val() == '' || $('#notes').val() == '' || $('#period').val() == ''){
            $('.birtninfobtn').attr("disabled", true).addClass('disabled disable-color');
            return;
        }else{
            $('.birtninfobtn').attr("disabled", false).removeClass('disabled disable-color');
        }
    }


</script>
<script>
    //edit form validation
    var $ = jQuery;
    function addvalidation($class, $formeroorclass) {
        checkthevalueS();

        if ($($class).val() == '') {
            $($formeroorclass).removeClass('d-none');
        } else {
            $($formeroorclass).addClass('d-none');
        }
    }

  function checkthevalueS(){
        if($('#dosage_supp').val() == '' || $('#dnotes').val() == '' || $('#period_supp').val() == ''){
            $('.supplimentform').attr("disabled", true).addClass('disabled disable-color');
            return;
        }else{
            $('.supplimentform').attr("disabled", false).removeClass('disabled disable-color');
        }
    }


</script>
<script>

    let wfachart = `{{ $wfaCharttoString }}`
    let month = `{{ $monthCharttoString }}`
    // Length chart
    var options = {
        chart: {
            type: 'line',
            height: '180px' ,
            toolbar: {
                show: false,
            }
        },
        series: [{
            data: wfachart.split(',')
        }],
        stroke: {
            show: true,
            curve: 'straight',
            colors: "#00D9B2",
            width: 2,
        },
        markers: {
            size: 0,
            colors: "#00D9B2",
            strokeColors: '#fff',
            strokeWidth: 0,
            strokeOpacity: 0.9,
            strokeDashArray: 0,
            fillOpacity: 1,
            shape: "circle",
            radius: 2,
            offsetX: 0,
            offsetY: 0,
            onClick: undefined,
            onDblClick: undefined,
            showNullDataPoints: true,
            hover: {
                size: undefined,
                sizeOffset: 3
            }
        },
        xaxis: {
            categories: month.split(','),
            axisBorder: {
                show: false,
                color: '#EEEEEE',
                height: 2,
                width: '100%',
                offsetX: 0,
                offsetY: 0
            },
            axisTicks: {
                show: false,
            },
            tooltip: {
                enabled: false,
            },
        },
        grid: {
            show: true,
            borderColor: '#EEEEEE',
            strokeDashArray: 0,
            position: 'back',
            xaxis: {
                lines: {
                    show: false
                },
            },
            yaxis: {
                lines: {
                    show: true
                },
            },
        },
        tooltip: {
            enabled: false,
        }
    }
    var chart = new ApexCharts(document.querySelector("#WeightAge"), options);
    chart.render();


</script>

<script>
    let codeId = document.querySelector('#code');

    $('#codeid').keyup(function(e){
        fetchICDCode(e.target.value)
    })

    function fetchICDCode(search_data)
    {
        $('#code').show();
        // document.getElementsByName("profile_id").readOnly = true;
        html = '';
      if(search_data.length >= 3){
          callfuncajax(search_data)
      }
      else if(search_data.length == 0) {
        $('#code').hide();
      }
      else{
        html += `
                <li>Write three letters</li>
               `
      };
      codeId.innerHTML = html
    };

    function callfuncajax(search_data){
        $.ajax({
               type:'GET',
            //url:'http://icd10api.com/?s=' + search_data + '&desc=short&r=json',
                url: `{{ asset ('json/icd-code.json') }}`,
               dataType: 'json',
               success:function(response) {
                // console.log(response);
               let code =  response.filter(function(data){
                  return data.desc.toLowerCase().includes(search_data)
                })
                //    console.log(code==[]);
                html = '';
                if(code != []){
                    code.forEach(data => {
                        html += `
                        <li onclick="addToRow(this)" data-code="${data.code}" data-desc="${data.desc}">${data.code}-${data.desc}</li>
                    `
                    });
                }else{
                    console.log('no');
                    html += `
                        <li> No Data Found </li>
                    `
                }


               codeId.innerHTML = html
               }
            });
    }

    function addToRow(code){
        $('#code').hide();
       let codeData = code.getAttribute('data-code');
       let descData = code.getAttribute('data-desc');
       let addData = document.querySelector('#addData');

        // const row =  document.createElement('tr');

        // row.innerHTML = `
        //     <tr>
        //         <td></td>
        //         <td>${codeData}</td>
        //         <td>${codeData}</td>
        //         <td>${descData}</td>
        //         <td data-id="${data.id}" onClick="removeFromDb(this)">Remove</>
        //     </tr>
        // `;
        // addData.appendChild(row)

        addToDb(codeData, descData);

    }

    let patient_id = `{{ $patient_id->id }}`

    function addToDb(codeData, descData){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
                type:'POST',
               url: `/patient/clinical-encounter/storecode/` + patient_id,
               dataType: 'json',
               data:{
                medical_code: codeData,
                code: codeData,
                description: descData
               },
               success:function(response) {
                   if(response.message){
                       $('.code-error').text(response.message)
                   }
                getfromDb();
               }
        })
    }

    $(document).ready(function(){
        $('#code').hide();
        getfromDb();
    });

    function getfromDb(){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
                type:'GET',
               url: `/patient/clinical-encounter/getcode/` + patient_id,
               dataType: 'json',
               success:function(response) {
                let addData = document.querySelector('#addData');
                // while(addData.firstChild){
                //     addData.removeChild(addData.firstChild)
                // }
                addData.innerHTML = '';
                response.forEach(function(data){
                const rows =  document.createElement('tr');
                  rows.innerHTML= `<tr>
                            <td></td>
                            <td>${data.medical_code}</td>
                            <td>${data.code}</td>
                            <td>${data.description}</td>
                            <td data-id="${data.id}"  id="removefromdb" onClick="removeFromDb(this)">
                            <button class="primary-btn-lg btn-rounded min-width-145">
                            Remove
                            </button>
                            </>
                            </tr>`;

                    addData.appendChild(rows)
                })

            }
        })
    }

    // $('#removefromdb').click(function(e){
    //     console.log(e);
    // });

    function removeFromDb(value){
         codeId = value.getAttribute('data-id');
        $.ajax({
                type:'POST',
               url: `/patient/clinical-encounter/deletecode/` + patient_id + '/' + codeId,
               dataType: 'json',
               success:function(response) {
                if(response.message){
                       $('.code-delerror').text(response.message)
                       return;
                   }
                let addData = document.querySelector('#addData');

                getfromDb();
                location.reload();
               }
            })
        }

</script>

<script>
    function descValue(drug=0)
    {
        $.ajax({
               type:'GET',
               url: '/drugs/'+ drug,
               dataType: 'json',
               success:function(response) {
                document.getElementById('description').value = response.category + ' - ' + response.type;
                document.getElementById('dosage').value = '1-0-1';
                document.getElementById('dosage_form').value = response.type;
               }
            });
    }

    function descValueSuup(suppliment=0)
    {
        $.ajax({
               type:'GET',
               url: '/foods/'+ suppliment,
               dataType: 'json',
               success:function(response) {
                document.getElementById('description_supp').value = response.category + ' - ' + response.type;
                document.getElementById('dosage_supp').value = '1';
                document.getElementById('dosage_form_supp').value = response.type;
               }
            });
    }
    document.getElementById('Complaint').value = localStorage.getItem('Complaint');
    document.getElementById('History').value = localStorage.getItem('History');
    document.getElementById('Physical').value = localStorage.getItem('Physical');
    document.getElementById('Assessment').value = localStorage.getItem('Assessment');
    function saveLocal(value, idName)
    {
        localStorage.setItem(idName, value);

    }

    function beforeSubmit()
    {
        localStorage.removeItem("Complaint");
        localStorage.removeItem("History");
        localStorage.removeItem("Physical");
        localStorage.removeItem("Assessment");
    }
</script>

@endpush
@endsection

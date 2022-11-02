@extends('layouts.front')
@section('title', 'Public Health Question')
@section('content')

<style>
    .percentCount{
        display: none;
    }
</style>
<div class="profile-area mb-40">
    @if(isPHComplete($patient_id->id) != 1)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="p-0 m-0" style="list-style: none;">
                {{ __('This section is disabled! First you have to complete ') }}<a href="{{ route('patient.public-health', $patient_id->id) }}">{{ __('public health questions') }}</a>!
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
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="media align-items-center">
                <img  src="{{
                    isset($patient_id->image) ? asset(path_patient_image().$patient_id->image) : Avatar::create($patient_id->first_name . ' ' . $patient_id->last_name)->toBase64()
                }}" class="profile-image mr-5" alt="profile image" />
                <div class="media-body">
                  <h3 class="profile-name mt-0">{{ $patient_id->last_name }}, {{ $patient_id->first_name }}</h3>
                  <ul class="profile-info">
                      <li><span>Patient ID</span> <b>#WP-{{ $patient_id->id }}</b></li>
                      <li><span>DOB</span> <b>{{ \Carbon\Carbon::parse($patient_id->dob)->format('m/d/Y') }}</b></li>
                  </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="progress-tabs">
                <ul class="progress-list">
                    <li class="single-progress checked">
                        <span class="check-box"></span>
                        <span class="progress-text">Checkin</span>
                    </li>
                    <li class="single-progress checked">
                        <span class="check-box"></span>
                        <a href="{{ route('patient.public-health', $patient_id->id) }}">
                            <span class="progress-text">Public Health</span>
                        </a>
                    </li>
                    <li class="single-progress current-tab">
                        <span class="check-box"></span>
                        <a href="{{ route('patient.vital-sign', $patient_id->id) }}">
                            <span class="progress-text">Vitals</span>
                        </a>
                    </li>
                    <li class="single-progress">
                        <span class="check-box"></span>
                        <a href="{{ route('patient.clinical-encounter', $patient_id->id) }}">
                            <span class="progress-text">Encounter</span>
                        </a>
                    </li>
                    <li class="single-progress">
                        <span class="check-box"></span>
                        <a href="{{ route('patient.order.index', $patient_id->id) }}">
                            <span class="progress-text">Orders</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="anthropometric-calculator mb-40">
    <div class="section-header-two mb-40">
        <h2 class="section-title ">{{ __('Anthropometric Calculator') }}</h2>
    </div>
    <div class="primary-form">
        <h2 class="form-title mb-25">{{ __('Birth information') }}</h2>
        <form action="{{ route('patient.vital-sign.store') }}" method="POST" id="vform">
            @csrf
            <input type="hidden" value="{{ $patient_id->id }}" name="patient_id">
            <input type="hidden" value="{{ session()->get('clinic_id') }}" name="clinic_id">
            <input type="hidden" name="dob" value="{{ $patient_id->dob }}">
            <input type="hidden" name="gender" value="{{ $patient_id->gender }}">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="Height">{{ __('Height') }}</label>
                        <input onkeyup="getheight(this)" onkeypress="return isNumber(event)" value="{{ old('height') }}" type="text" class="form-control" id="Height" name="height" placeholder="30" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }} />
                        <select name="height_unit"  class="form-right-option" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }}>
                            <option value="CM">CM</option>
                        </select>
                    </div>
                    {{-- <span class="text-danger">{{ $errors->first('height') }}</span> --}}
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="Weight">{{ __('Weight') }}</label>
                        <input onkeyup="getweight(this)" onkeypress="return isNumber(event)" value="{{ old('weight') }}" type="text" class="form-control" id="Weight" name="weight" placeholder="05" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }} />
                        <select name="weight_unit" class="form-right-option" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }}>
                            <option value="KG">KG</option>
                            <option value="G">G</option>
                        </select>
                    </div>
                    {{-- <span class="text-danger">{{ $errors->first('weight') }}</span> --}}
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="HeadCircumference">{{ __('Head Circumference') }}</label>
                        <input onkeyup="gethc(this)" min="1" value="{{ old('head_circumference') }}" type="number" class="form-control" id="HeadCircumference" name="head_circumference" placeholder="45.00" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }} />
                    </div>
                    {{-- <span class="text-danger">{{ $errors->first('head_circumference') }}</span> --}}
                </div>
                {{-- <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="Circumference">{{ __('Subscapular Circumference') }}</label>
                        <input  min="1" value="{{ old('triceps_circumference') }}" type="number" class="form-control" id="Circumference" name="subscapular_circumference" placeholder="8.00" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }} />

                    </div>
                </div> --}}
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="Circumference">{{ __('Is the patient american') }}</label>
                        <select class="form-control" name="american" id="american" onchange="getamerican(this)">
                            <option value="true">Yes</option>
                            <option value="false">No</option>
                        </select>
                        {{-- <span class="text-danger">{{ $errors->first('triceps_circumference') }}</span> --}}
                    </div>
                </div>
                {{-- <div class="col-lg-4 col-md-6">
                    <div class="radiio-group-list d-flex align-items-center mt-50">
                        <p class="label-text mb-0 mr-4">{{ __('Edema') }}:</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="edema" id="inlineRadio1" value="1" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }}>
                            <label class="form-check-label" for="inlineRadio1">{{ __('Yes') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="edema" id="inlineRadio2" value="0" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }}>
                            <label class="form-check-label" for="inlineRadio2">{{ __('No') }}</label>
                        </div>
                    </div>

                </div> --}}
                {{-- <div class="col-lg-4 col-md-6">
                    <div class="radiio-group-list d-flex align-items-center mt-50">
                        <p class="label-text mb-0 mr-4">{{ __('Measured recumbent') }}:</p>
                        <div class="form-check form-check-inline">
                            <input  class="form-check-input" type="radio" name="mesure_recumbent" id="inlineRadio3" value="1" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }}>
                            <label class="form-check-label" for="inlineRadio3">{{ __('Yes') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input  class="form-check-input" type="radio" name="mesure_recumbent" id="inlineRadio4" value="0" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }}>
                            <label class="form-check-label" for="inlineRadio4">{{ __('No') }}</label>
                        </div>

                    </div>
                </div> --}}
                <div class="col-lg-12 mt-2">
                    <button onclick="getinfo()" class="primary-btn-lg btn-rounded min-width-145 {{ isPHComplete($patient_id->id) != 1 ? 'disable-color' : '' }}" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }}>Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="result-area">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="single-progress d-flex">
                <div class="progress-left">
                    <h4 class="progress-title">{{ __('Weight for') }} {{ $patient_age <= 24 ? 'Length' : 'Height' }}</h4>
                    <div line-progressbar  data-percentage="{{ isset($growth->wfhp) ? round($growth->wfhp) : '' }}" data-progress-color="#00D9B2"></div>
                </div>
                <div class="progress-right">
                    <h5 class="score-title">{{ __('Z-Score') }}</h5>
                    <ul class="d-flex align-items-center">
                        <li><span class="score-box">{{  isset($growth->wfh) ?  number_format($growth->wfh, 2) : '' }}</span></li>
                        <li><img src="{{ asset('front/assets/images/shape.png') }}" alt="shape" /></li>
                    </ul>
                </div>
            </div>

            <div class="single-progress d-flex">
                <div class="progress-left">
                    <h4 class="progress-title">{{ __('Weight for Age') }}</h4>
                    <div line-progressbar  data-percentage="{{isset($growth->wfap) ? round($growth->wfap) : '' }}" data-progress-color="#00D9B2"></div>
                </div>
                <div class="progress-right">
                    <h5 class="score-title">{{ __('Z-Score') }}</h5>
                    <ul class="d-flex align-items-center">
                        <li><span class="score-box">{{ isset($growth->wfa) ? number_format($growth->wfa, 2) : ''}}</span></li>
                        <li><img src="{{ asset('front/assets/images/shape.png') }}" alt="shape" /></li>
                    </ul>
                </div>
            </div>

            <div class="single-progress d-flex">
                <div class="progress-left">
                    <h4 class="progress-title">{{ $patient_age <= 24 ? 'Length' : 'Height' }} for Age</h4>
                    <div line-progressbar data-percentage="{{ isset($growth->hfap) ? round($growth->hfap) : '' }}" data-progress-color="#00D9B2"></div>
                </div>
                <div class="progress-right">
                    <h5 class="score-title">{{ __('Z-Score') }}</h5>
                    <ul class="d-flex align-items-center">
                        <li><span class="score-box">{{ isset($growth->hfa) ? number_format($growth->hfa, 2) : '' }}</span></li>
                        <li><img src="{{ asset('front/assets/images/shape.png') }}" alt="shape" /></li>
                    </ul>
                </div>
            </div>
            {{-- <div class="single-progress d-flex">
                <div class="progress-left">
                    <h4 class="progress-title">Length for Age</h4>
                    <div line-progressbar  data-percentage="60" data-progress-color="#00D9B2"></div>
                </div>
                <div class="progress-right">
                    <h5 class="score-title">Z-Score</h5>
                    <ul class="d-flex align-items-center">
                        <li><span class="score-box">0.29</span></li>
                        <li><img src="{{ asset('front/assets/images/shape.png') }}" alt="shape" /></li>
                    </ul>
                </div>
            </div> --}}
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="single-progress d-flex">
                <div class="progress-left">
                    <h4 class="progress-title">{{ __('Head Circumference for Age') }}</h4>
                    <div line-progressbar  data-percentage="{{ isset($growth->cfap) ? round($growth->cfap) : '' }}" data-progress-color="#00D9B2"></div>
                </div>
                <div class="progress-right">
                    <h5 class="score-title">{{ __('Z-Score') }}</h5>
                    <ul class="d-flex align-items-center">
                        <li><span class="score-box">{{ isset($growth->cfa) ? number_format($growth->cfa, 2) : '' }}</span></li>
                        <li><img src="{{ asset('front/assets/images/shape.png') }}" alt="shape" /></li>
                    </ul>
                </div>
            </div>
            {{-- <div class="single-progress d-flex">
                <div class="progress-left">
                    <h4 class="progress-title">BMI</h4>
                    <div line-progressbar  data-percentage="{{ round($growth->bmi) }}" data-progress-color="#00D9B2"></div>
                </div>
                <div class="progress-right">
                    <h5 class="score-title">Z-Score</h5>
                    <ul class="d-flex align-items-center">
                        <li><span class="score-box">N/A</span></li>
                        <li><img src="{{ asset('front/assets/images/shape.png') }}" alt="shape" /></li>
                    </ul>
                </div>
            </div> --}}
            <div class="single-progress d-flex">
                <div class="progress-left">
                    <h4 class="progress-title">{{ __('BMI for Age') }}</h4>
                    <div line-progressbar  data-percentage="{{ isset($growth->bfap) ? round($growth->bfap) : '' }}" data-progress-color="#00D9B2"></div>
                </div>
                <div class="progress-right">
                    <h5 class="score-title">{{ __('Z-Score') }}</h5>
                    <ul class="d-flex align-items-center">
                        <li><span class="score-box">{{ isset($growth->bfa) ? number_format($growth->bfa, 2) : '' }}</span></li>
                        <li><img src="{{ asset('front/assets/images/shape.png') }}" alt="shape" /></li>
                    </ul>
                </div>
            </div>
            {{-- <div class="single-progress d-flex">
                <div class="progress-left">
                    <h4 class="progress-title">{{ __('Subscapular for age') }}</h4>
                    <div line-progressbar  data-percentage="{{isset($growth->sfap) ? round($growth->sfap) : '' }}" data-progress-color="#00D9B2"></div>
                </div>
                <div class="progress-right">
                    <h5 class="score-title">{{ __('Z-Score') }}</h5>
                    <ul class="d-flex align-items-center">
                        <li><span class="score-box">{{ isset($growth->sfa) ? number_format($growth->sfa, 2) : '' }}</span></li>
                        <li><img src="{{ asset('front/assets/images/shape.png') }}" alt="shape" /></li>
                    </ul>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<div class="chart-area mb-10">
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="single-chart">
                <h3 class="chart-title">{{ __('Weight for Age') }}</h3>
                <div id="Weightchart"></div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="single-chart">
                <h3 class="chart-title">{{ __('Length for Age') }}</h3>
                <div id="Lengthchart"></div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="single-chart">
                <h3 class="chart-title">{{ __('Weight for Height') }} </h3>
                <div id="Heightchart"></div>
            </div>
        </div>
    </div>
</div>
<div class="history-vitals">
    <div class="section-header-two mb-40">
        <h2 class="section-title ">{{ __('Historical Vitals') }}</h2>
    </div>
    <div class="secondary-table">
        <div class="table-responsive mb-15">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col"><input type="checkbox" id="exampleCheck1" /></th>
                    <th scope="col">{{ __('Date Collected') }}</th>
                    <th scope="col">{{ __('Height') }}</th>
                    <th scope="col">{{ __('Weight') }}</th>
                    <th scope="col">{{ __('HC') }}</th>
                    <th scope="col">{{ $patient_age <= 24 ? 'W/L' : 'W/H' }}</th>
                    <th scope="col">W/A</th>
                    {{-- <th scope="col">{{ $patient_age <= 24 ? 'L/A' : 'H/A' }}</th> --}}
                    <th scope="col">{{ __('bmi') }}</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($vitalSigns as $vitalsign)
                    <tr>
                      <td><input type="checkbox" id="exampleCheck2" /> <span class="id-number">{{ $loop->iteration }}</span></td>
                      <td>{{ $vitalsign->created_at->format('d/m/y') }}</td>
                      <td>{{ $vitalsign->height }}  {{ $vitalsign->height_unit }} </td>
                      <td>{{ $vitalsign->weight }}  {{ $vitalsign->weight_unit }} </td>
                      <td>{{ $vitalsign->head_circumference }}</td>
                      <td>{{ $vitalsign->wfh }}</td>
                      <td>{{ $vitalsign->wfa }}</td>
                      {{-- <td>{{ $vitalsign->hfa }}</td> --}}
                      <td>{{ $vitalsign->bfa }}</td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" align="center"><h2>{{ __('No Action Found!') }}</h2></td>
                      </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- <a href="#" class="primary-btn">Add Row</a> --}}
    </div>
</div>

@push('scripts')
<script>
    let wfachart = `{{ $wfaCharttoString }}`
    let month = `{{ $monthCharttoString }}`

    let lfachart = `{{ $lfaCharttoString }}`

    let wfhChart = `{{ $wfhCharttoString }}`
    // Weightchart
    var options = {
        chart: {
            type: 'line',
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
    var chart = new ApexCharts(document.querySelector("#Weightchart"), options);
    chart.render();
    // Length chart
    var options = {
        chart: {
            type: 'line',
            toolbar: {
                show: false,
            }
        },
        series: [{
            data: lfachart.split(',')
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
    var chart = new ApexCharts(document.querySelector("#Lengthchart"), options);
    chart.render();
    // Length chart
    var options = {
        chart: {
            type: 'line',
            toolbar: {
                show: false,
            }
        },
        series: [{
            data:wfhChart.split(','),
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
            categories:month.split(','),
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
    var chart = new ApexCharts(document.querySelector("#Heightchart"), options);
    chart.render();
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>

    $('#vform').on('submit', function(e){
        e.preventDefault();
    });

    let height = '';
    let weight = '';
    let age = `{{ $patient_age }}`;
    let gender = `{{ $patient_id->gender }}`;
    let genderforapi = '';
    let american = true;
    let hc = '';


    $(document).ready(function(){
        if(gender == 'male'){
            genderforapi = "M"
        }else{
            genderforapi = "F"
        }


    });


   function getheight(e){
        height = e.value;
    }
   function getweight(e){
        weight = e.value;
    }

    function getamerican(e){
        if(e.value == 'true'){
            american = true
        }else{
            american = false
        };
    }

    function gethc(e){
        hc = e.value
    }

    let WEIGHT_FOR_LENGTH = '';
    let WEIGHT_FOR_HEIGHT = '';
    let WEIGHT_FOR_AGE = '';
    let LENGTH_HEIGHT_FOR_AGE = '';
    let HEAD_CIRC_FOR_AGE = '';
    let bmi = '';

function getinfo(){
    getweightforlength()
//     //getweightforage()
//     //getlenghtheightforage()

//     //getheadcircforage()
//    // getbmi()
     //store()

};



function getweightforlength(){
    $.ajax({
    type: "GET", /* or type:"GET" or type:"PUT" */
    timeout: 5000,
    url:`http://growth-chart.brainyts.xyz/?height=${height}&weight=${weight}&age=${age}&gender=${genderforapi}&american=${american}`

}).done(function (data) {
    if(age < 24){
        WEIGHT_FOR_LENGTH = data.wfl;
    }else{
        WEIGHT_FOR_LENGTH = data.wfh;
    }

    WEIGHT_FOR_AGE = data.wfa;
    LENGTH_HEIGHT_FOR_AGE = data.hfa;
    HEAD_CIRC_FOR_AGE = data.hcfa;
    bmi = data.bfa;
    //getweightforage()
    //setTimeout(function() { alert("my message"); }, 5000);

    store()
    //console.log(data);
}).fail(function(x, t, m){
    if(t==="timeout") {
            alert("Please put valid Number");
        } else {
            alert("There is a problem");
        }

});
}



function getweightforheight(){
    $.ajax({
    type: "GET", /* or type:"GET" or type:"PUT" */

    // async: true,
    url: `http://growth-chart.brainyts.xyz/?height=${height}&weight=${weight}&age=${age}&gender=${genderforapi}&american=${american}&indicator=WEIGHT_FOR_HEIGHT`
}).done(function (data) {
    WEIGHT_FOR_LENGTH= data;
    console.log(data);
});
}
function getweightforage(){
    $.ajax({
    type: "GET", /* or type:"GET" or type:"PUT" */

    // async: true,
    url: `http://growth-chart.brainyts.xyz/?height=${height}&weight=${weight}&age=${age}&gender=${genderforapi}&american=${american}&indicator=WEIGHT_FOR_AGE`
}).done(function (data) {
    WEIGHT_FOR_AGE = data;
    getlenghtheightforage()
    console.log(data);
});
}
function getlenghtheightforage(){
    $.ajax({
    type: "GET", /* or type:"GET" or type:"PUT" */

    // async: true,
    url: `http://growth-chart.brainyts.xyz/?height=${height}&weight=${weight}&age=${age}&gender=${genderforapi}&american=${american}&indicator=LENGTH_HEIGHT_FOR_AGE`
}).done(function (data) {
    LENGTH_HEIGHT_FOR_AGE = data;
    //console.log(data);
});
}
function getheadcircforage(){
    $.ajax({
    type: "GET", /* or type:"GET" or type:"PUT" */

    url: `http://growth-chart.brainyts.xyz/?height=${height}&weight=${weight}&age=${age}&gender=${genderforapi}&american=${american}&indicator=HEAD_CIRC_FOR_AGE`
}).done(function (data) {
    HEAD_CIRC_FOR_AGE = data;
    getheadcircforage()
    //console.log(data);
});
}
function getbmi(){
    $.ajax({
    type: "GET", /* or type:"GET" or type:"PUT" */
    // async: true,
    url: `http://growth-chart.brainyts.xyz/?height=${height}&weight=${weight}&age=${age}&gender=${genderforapi}&american=${american}&indicator=BODY_MASS_INDEX_FOR_AGE`
}).done(function (data) {
    bmi = data;
    getbmi()
    //console.log(data);
});
}

let patient_id = `{{ $patient_id->id }}`
let clinic_id = `{{ session()->get('clinic_id') }}`

function store(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
    type: "POST", /* or type:"GET" or type:"PUT" */
    data: {
        height:height,
        weight:weight,
        head_circumference: hc,
        wfh:WEIGHT_FOR_LENGTH,
        wfa:WEIGHT_FOR_AGE,
        hfa:LENGTH_HEIGHT_FOR_AGE,
        cfa:HEAD_CIRC_FOR_AGE,
        bfa:bmi,
        patient_id:patient_id,
        clinic_id:clinic_id

    },
    url: '/patient/vital-sign/storeajax'
}).done(function (data) {
    //console.log(data);
    window.location.reload();
});
}

</script>


@endpush
@endsection

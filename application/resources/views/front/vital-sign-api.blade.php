@extends('layouts.front')
@section('title', 'Vital Sign')
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
    {{ breadcumb($patient_id->id) }}
</div>
<div class="anthropometric-calculator mb-40">
    <div class="section-header-two mb-40">
        <h2 class="section-title ">{{ __('Anthropometric Calculator') }}</h2>
    </div>
    <div class="primary-form">
        <h2 class="form-title mb-25">{{ __('Birth information') }} ({{ $patient_age }} Days)</h2>
        <form id="vform">
            @csrf
            <input type="hidden" value="{{ $patient_id->id }}" name="patient_id" id="patient_id">
            <input type="hidden" value="{{ session()->get('clinic_id') }}" name="clinic_id" id="clinic_id">
            <input type="hidden" name="dob" id="age" value="{{ $patient_age }}">
            <input type="hidden" name="gender" id="gender" value="{{ $patient_id->gender == 'male' ? 'm' : 'f' }}">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="Height">{{ __('Height') }}</label>
                        <input onkeypress="return isNumber(event)" value="{{ old('height') }}" type="text" class="form-control" id="height" name="height" placeholder="30" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }} />
                        <select name="height_unit" id="height_unit"  class="form-right-option" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }}>
                            <option value="CM">CM</option>
                            <option value="Inch">Inch</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="Weight">{{ __('Weight') }}</label>
                        <input onkeypress="return isNumber(event)" value="{{ old('weight') }}" type="text" class="form-control" id="weight" name="weight" placeholder="05" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }} />
                        <select name="weight_unit" id="weight_unit" class="form-right-option" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }}>
                            <option value="KG">KG</option>
                            <option value="G">G</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="HeadCircumference">{{ __('Head Circumference') }}</label>
                        <input min="1" value="{{ old('head_circumference') }}" type="number" class="form-control" id="head_circumference" name="head_circumference" placeholder="45.00" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }} />
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="subscapular_skinfold">{{ __('Subscapular Skinfold') }}</label>
                        <input onkeypress="return isNumber(event)" value="{{ old('subscapular_skinfold') }}" type="text" class="form-control" id="subscapular_skinfold" name="subscapular_skinfold" placeholder="05" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }} />
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="triceps_skinfold">{{ __('Triceps Skinfold') }}</label>
                        <input onkeypress="return isNumber(event)" value="{{ old('triceps_skinfold') }}" type="text" class="form-control" id="triceps_skinfold" name="triceps_skinfold" placeholder="05" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }} />
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="arm_circumference">{{ __('Arm Circumference') }}</label>
                        <input onkeypress="return isNumber(event)" value="{{ old('arm_circumference') }}" type="text" class="form-control" id="arm_circumference" name="arm_circumference" placeholder="05" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }} />
                    </div>
                </div>

                <div class="col-lg-12 mt-2">
                    <button class="anthroAPIR primary-btn-lg btn-rounded min-width-145 {{ isPHComplete($patient_id->id) != 1 ? 'disable-color' : '' }}" {{ isPHComplete($patient_id->id) != 1 ? 'disabled' : '' }}>Save</button>
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
                    <h4 class="progress-title">{{ __('Weight for Age') }} </h4>
                    <div line-progressbar  data-percentage="{{isset($growth->wfap) ? round($growth->wfap) : 0 }}" data-progress-color="#00D9B2"></div>
                </div>
                <div class="progress-right">
                    <h5 class="score-title">{{ __('Z-Score') }}</h5>
                    <ul class="d-flex align-items-center">
                        <li><span class="score-box" id="weight_for_age">{{ isset($growth->wfa) ? number_format($growth->wfa, 2) : 'N/A'}}</span></li>
                        <li><img src="{{ asset('front/assets/images/shape.png') }}" alt="shape" /></li>
                    </ul>
                </div>
            </div>

            <div class="single-progress d-flex">
                <div class="progress-left">
                    <h4 class="progress-title">{{ $patient_age <= 24 ? 'Length' : 'Height' }} for Age</h4>
                    <div line-progressbar data-percentage="{{ isset($growth->hfap) ? round($growth->hfap) : 0 }}" data-progress-color="#00D9B2"></div>
                </div>
                <div class="progress-right">
                    <h5 class="score-title">{{ __('Z-Score') }}</h5>
                    <ul class="d-flex align-items-center">
                        <li><span class="score-box" id="length_for_age">{{ isset($growth->hfa) ? number_format($growth->hfa, 2) : 'N/A' }}</span></li>
                        <li><img src="{{ asset('front/assets/images/shape.png') }}" alt="shape" /></li>
                    </ul>
                </div>
            </div>

            <div class="single-progress d-flex">
                <div class="progress-left">
                    <h4 class="progress-title">{{ __('Subscapular Skinfold For Age') }}</h4>
                    <div line-progressbar  data-percentage="0" data-progress-color="#00D9B2"></div>
                </div>
                <div class="progress-right">
                    <h5 class="score-title">{{ __('Z-Score') }}</h5>
                    <ul class="d-flex align-items-center">
                        <li><span class="score-box" id="subscapular_skinfold_for_age">{{ isset($growth->subscapular_skinfold_for_age) ? number_format($growth->subscapular_skinfold_for_age, 2) : 'N/A' }}</span></li>
                        <li><img src="{{ asset('front/assets/images/shape.png') }}" alt="shape" /></li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-lg-6 col-md-6">
            <div class="single-progress d-flex">
                <div class="progress-left">
                    <h4 class="progress-title">{{ __('Head Circumference for Age') }} <small>(Percentile: {{ isset($growth->cfap) ? $growth->cfap : 'N/A'  }})</small></h4>
                    <div line-progressbar  data-percentage="{{ isset($growth->cfap) ? round($growth->cfap) : 0 }}" data-progress-color="#00D9B2"></div>
                </div>
                <div class="progress-right">
                    <h5 class="score-title">{{ __('Z-Score') }}</h5>
                    <ul class="d-flex align-items-center">
                        <li><span class="score-box" id="hc_for_age">{{ isset($growth->cfa) ? number_format($growth->cfa, 2) : 'N/A' }}</span></li>
                        <li><img src="{{ asset('front/assets/images/shape.png') }}" alt="shape" /></li>
                    </ul>
                </div>
            </div>

            <div class="single-progress d-flex">
                <div class="progress-left">
                    <h4 class="progress-title">{{ __('BMI for Age') }}
                    @if (isset($growth->bfap) && $growth->bfap != 0)
                        <small>(Percentile: {{ isset($growth->bfap) ? $growth->bfap : 'N/A' }})</small>
                    @endif </h4>
                    <div line-progressbar  data-percentage="{{ isset($growth->bfap) ? round($growth->bfap) : 0 }}" data-progress-color="#00D9B2"></div>
                </div>
                <div class="progress-right">
                    <h5 class="score-title">{{ __('Z-Score') }}</h5>
                    <ul class="d-flex align-items-center">
                        <li><span class="score-box" id="bmi_for_age">{{ isset($growth->bfa) ? number_format($growth->bfa, 2) : 'N/A' }}</span></li>
                        <li><img src="{{ asset('front/assets/images/shape.png') }}" alt="shape" /></li>
                    </ul>
                </div>
            </div>

            <div class="single-progress d-flex">
                <div class="progress-left">
                    <h4 class="progress-title">{{ __('Arm Circumference For Age') }}</h4>
                    <div line-progressbar  data-percentage="0" data-progress-color="#00D9B2"></div>
                </div>
                <div class="progress-right">
                    <h5 class="score-title">{{ __('Z-Score') }}</h5>
                    <ul class="d-flex align-items-center">
                        <li><span class="score-box" id="arm_circumference_for_age">{{ isset($growth->arm_circumference_for_age) ? number_format($growth->arm_circumference_for_age, 2) : 'N/A' }}</span></li>
                        <li><img src="{{ asset('front/assets/images/shape.png') }}" alt="shape" /></li>
                    </ul>
                </div>
            </div>

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
                    <th scope="col">{{ __('B/A') }}</th>
                    <th scope="col">{{ __('Chart') }}</th>
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
                      <td>{{ $vitalsign->chart != null ? $vitalsign->chart : 'N/A' }}</td>
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
<script src="{{ asset('front/assets/js/custom.js') }}"></script>

<script>

    $('#vform').on('submit', function(e){
        e.preventDefault();
    });

    let gender = '';
    let age = '';
    let height = '';
    let weight = '';
    let height_unit = '';
    let weight_unit = '';
    let head_circumference = '';
    let charttt = '';
    let patient_id = '';
    let clinic_id = '';
    let subscapular_skinfold = '';
    let triceps_skinfold = '';
    let arm_circumference = '';

    let WEIGHT_FOR_LENGTH = '';
    let WEIGHT_FOR_HEIGHT = '';
    let WEIGHT_FOR_AGE = '';
    let LENGTH_HEIGHT_FOR_AGE = '';
    let HEAD_CIRC_FOR_AGE = '';
    let bmi = '';
    let arm_circumference_for_age = '';
    let subscapular_skinfold_for_age = '';
    let triceps_skinfold_for_age = '';

function getZscore()
    {
        gender = document.getElementById('gender').value;
        age = document.getElementById('age').value;
        height_unit = document.getElementById('height_unit').value;
        weight_unit = document.getElementById('weight_unit').value;
        if(height_unit == 'Inch') {
            height = document.getElementById('height').value * 2.54;
        }
        else {
            height = document.getElementById('height').value;
        }

        if(weight_unit == 'G') {
            weight = document.getElementById('weight').value * 0.001;
        }
        else {
            weight = document.getElementById('weight').value;
        }
        head_circumference = document.getElementById('head_circumference').value;
        charttt = document.getElementById('charttt').value;
        patient_id = document.getElementById('patient_id').value;
        clinic_id = document.getElementById('clinic_id').value;
        subscapular_skinfold = document.getElementById('subscapular_skinfold').value;
        triceps_skinfold = document.getElementById('triceps_skinfold').value;
        arm_circumference = document.getElementById('arm_circumference').value;

        $.ajax({
            type:'POST',
            url:'http://165.232.133.43/gcc_calculator',
            data:JSON.stringify({
                age : age,
                gender : gender,
                weight : weight,
                height : height,
                head_circumference : head_circumference,
                chart : charttt,
            }),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success:function(data) {
                console.log(height);
                console.log(weight);
                if(data.response == "The provided data doesn't match our data sources") {
                    alert("The provided data doesn't match our data sources. Check API.");
                }
                else {
                    if(charttt == 'who') {
                        WEIGHT_FOR_LENGTH = 0;
                        hfap = data.length_or_height_for_age_percentile;
                    }
                    else {
                        WEIGHT_FOR_LENGTH = data.weight_for_length;
                        hfap = data.length_or_height_percentile;
                    }
                    $("#weight_for_length").html(data.weight_for_length);
                    $("#weight_for_age").html(data.weight_for_age);
                    $("#length_for_age").html(data.length_or_height_for_age);
                    $("#hc_for_age").html(data.head_circumference_for_age);
                    $("#bmi_for_age").html(data.bmi_for_age);

                    WEIGHT_FOR_HEIGHT = data.weight_for_length;
                    WEIGHT_FOR_AGE = data.weight_for_age;
                    LENGTH_HEIGHT_FOR_AGE = data.length_or_height_for_age;
                    HEAD_CIRC_FOR_AGE = data.head_circumference_for_age;
                    bmi = data.bmi_for_age;
                    bfap = data.bmi_percentile;
                    cfap = data.head_circumference_percentile;

                    wfap = data.weight_for_age_percentile;
                    wfhp = data.weight_for_length_percentile;

                    console.log(data);

                    getMeasureZ();
                }


            }
        });
    }

function getMeasureZ()
{
    $.ajax({
            type:'POST',
            url:'http://165.232.133.43/extra_measurements',
            data:JSON.stringify({
                age : age,
                gender : gender,
                subscapular_skinfold : subscapular_skinfold,
                triceps_skinfold : triceps_skinfold,
                arm_circumference : arm_circumference
            }),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success:function(data) {
                if(data.response == "The provided data doesn't match our data sources") {
                    alert("The provided data doesn't match our data sources. Check API.");
                }
                else {
                    $("#subscapular_skinfold_for_age").html(data.subscapular_skinfold_for_age);
                    $("#triceps_skinfold_for_age").html(data.triceps_skinfold_for_age);
                    $("#arm_circumference_for_age").html(data.arm_circumference_for_age);
                    subscapular_skinfold_for_age = data.subscapular_skinfold_for_age;
                    triceps_skinfold_for_age = data.triceps_skinfold_for_age;
                    arm_circumference_for_age = data.arm_circumference_for_age;
                    console.log(data);

                    store();
                }


            }
    });
}





</script>



@endpush
@endsection

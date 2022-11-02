@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-pie-chart bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Nutrition Dashboard')}}</h5>
                        {{-- <span>{{ __('lorem ipsum dolor sit amet, consectetur adipisicing elit')}}</span> --}}
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
                            <a href="#">{{ __('Dashboard')}}</a>
                        </li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h3>No of Patient</h3>
                </div>
                <div class="card-block text-center">
                    <h2>{{ $patientCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h3>No of pharmacist</h3>
                </div>
                <div class="card-block text-center">
                    <h2>{{ $pharmacistCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h3>No of Medical Assistant</h3>
                </div>
                <div class="card-block text-center">
                    <h2>{{ $medicalAssistantCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h3>No of Clinical encounter</h3>
                </div>
                <div class="card-block text-center">
                    <h2>{{ $numberofclinicalencounterCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h3>No of Medicine</h3>
                </div>
                <div class="card-block text-center">
                    <h2>{{ $medicineCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h3>No of Suppliments</h3>
                </div>
                <div class="card-block text-center">
                    <h2>{{ $supplimentsCount }}</h2>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- push external js -->
@push('script')

@endpush
@endsection

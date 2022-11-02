@extends('layouts.front')
@section('title', 'Immunization')
@section('content')
<div class="immunization-area mb-40">
    <div class="section-header-two mb-35">
        <h2 class="section-title">Vaccine Here</h2>
    </div>
    <div class="row">
        @foreach ($vaccines as $vaccine)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-immunization">
                    <div class="immunization-top">
                        <h3 class="immunization-title">{{ $vaccine->name }}</h3>
                        <ul class="immunization-info">
                            @forelse ($vaccine->immunization as $immunization)
                                    <li>{{ \Carbon\Carbon::parse($immunization->next_date)->format('m/d/y') }}  {{ $immunization->vaccine->scientific_name }}
                                    @if ($immunization->status == 0)
                                        <img src="{{ asset('img/cross.png') }}" height="15px" width="15px" alt="">
                                    @else
                                        <img src="{{ asset('img/tick.png') }}" height="15px" width="15px" alt="">
                                    @endif
                                    </li>
                            @empty
                                <li> <b>N/A</b> </li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="immunization-bottom">
                        <a href="#" data-toggle="modal" data-target="#Addimmunization{{ $vaccine->id }}" class="secondary-btn">Click to Add</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('modal')
    <!--Add New Patient  Modal -->
    @foreach ($vaccines as $vaccine)
    <div class="modal fade" id="Addimmunization{{ $vaccine->id }}" tabindex="-1" >
        <div class="modal-dialog small-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ $vaccine->name }}</h2>
                    <form action="{{ route('immunization.add', $patient_id->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="vaccine_id" value="{{ $vaccine->id }}" />
                        {{-- <input type="hidden" name="today" value="{{ date("Y-m-d") }}"> --}}
                        <div class="form-group">
                            <label for="date">Select Date</label>
                            <input type="date" class="form-control" name="next_date" placeholder="10 Jan 1990" />
                        </div>
                        <button type="submit" class="primary-btn-lg btn-rounded d-block w-100">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!--Add New Patient  Modal -->
@endpush
@endsection

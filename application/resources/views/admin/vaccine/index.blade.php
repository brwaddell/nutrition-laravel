@extends('layouts.main')
@section('title', 'Vaccine List')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-users bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __(ucfirst(request()->segment(2)))}}</h5>
                        <span>{{ __('List of '. ucfirst(request()->segment(2)))}}</span>
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
                            <a href="#">{{ __(ucfirst(request()->segment(2)))}}</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- start message area-->
        @include('include.message')
        <!-- end message area-->
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-header">
                    <h3>{{ __('Users')}}</h3>
                </div>
                <div class="card-body">
                    {{$dataTable->table()}}
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($vaccines as $vaccine)

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter{{$vaccine->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ ucfirst(request()->segment(2)). ' '. 'info' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Vaccine Detail</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Name: {{$vaccine->name}}</li>
                        <li class="list-group-item">Description: {!! $vaccine->description !!}</li>
                        <li class="list-group-item">Scientific Name: {{$vaccine->scientific_name}}</li>
                        <li class="list-group-item">Created: {{$vaccine->created_at->diffForHumans()}}</li>
                    </ul>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endforeach

@endsection

@push('script')
{{$dataTable->scripts()}}
@endpush

@extends('layouts.front')
@section('title', 'Orders')
@section('content')
<div class="profile-area mb-40">
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
<div class="section-header mb-20">
    <h2 class="section-title">{{ __('Order List') }}</h2>
</div>
<div class="primary-tabs">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tabthree-tab" data-toggle="tab" href="#tabthree" role="tab" aria-controls="tabthree" aria-selected="true">{{ __('New Orders') }}</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="tabtwo-tab" data-toggle="tab" href="#tabtwo" role="tab" aria-controls="tabtwo" aria-selected="false">{{ __('Completed') }}</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="tabtwo" role="tabpanel" aria-labelledby="tabtwo-tab">
            <div class="primary-table-two">
                <div class="table-responsive mb-15">
                    <table class="table">
                        <thead>

                                    <tr>
                                        <th scope="col"><input type="checkbox" id="exampleCheck1" /><span class="order">{{ __('Order') }}</span> </th>
                                        <th scope="col">{{ __('Medicine') }}</th>
                                        <th scope="col">{{ __('Quantity') }}</th>
                                        <th scope="col">{{ __('Status') }}</th>
                                        <th scope="col">{{ __('Date Created') }}</th>
                                        <th scope="col">{{ __('Last Updates') }}</th>
                                        <th scope="col">{{ __('Actions') }}</th>
                                    </tr>


                        </thead>
                        <tbody>
                            @forelse ($confirm_orders as $confirm_order)
                                <tr>
                                    <td><input type="checkbox" id="exampleCheck1" /> <span class="id-number">#SW-{{ $confirm_order->id }}</span></td>
                                    <td>{{ $confirm_order->drug->item_name }}</td>
                                    <td>{{ $confirm_order->order_qty }} {{ $confirm_order->drug->type }}</td>
                                    <td>
                                        <span class="status confirmed">Confirmed</span>

                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($confirm_order->created_at)->format('j M, Y') }}</td>
                                    <td>{{ $confirm_order->updated_at->diffForHumans() }}</td>
                                    <td>
                                        <ul class="active-btn">
                                            <li><a class="edit-btn" data-toggle="modal" data-target="#Editorder{{ $confirm_order->id }}" href="#"><i class="fas fa-edit"></i></a></li>
                                            {{-- <li><a class="delet-btn" href="#"><i class="fas fa-trash-alt"></i></a></li> --}}
                                        </ul>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" align="center"><h2>{{ __('No Active Order Found!') }}</h2></td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <div class="table-pagination mt-30">
                    <div class="row">
                        {!! $confirm_orders->links('pagination::custom') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show active" id="tabthree" role="tabpanel" aria-labelledby="tabthree-tab">
            <div class="primary-table-two">
                <div class="table-responsive mb-15">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"><input type="checkbox" id="exampleCheck1" /><span class="order">{{ __('Order') }}</span> </th>
                            <th scope="col">{{ __('Medicine') }}</th>
                            <th scope="col">{{ __('Quantity') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col">{{ __('Date Created') }}</th>
                            <th scope="col">{{ __('Last Updates') }}</th>
                            <th scope="col">{{ __('Actions') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($pending_orders as $pending_order)
                                <tr>
                                    <td><input type="checkbox" id="exampleCheck1" /> <span class="id-number">#SW-{{ $pending_order->id }}</span></td>
                                    <td>{{ $pending_order->drug->item_name }}</td>
                                    <td>{{ $pending_order->order_qty }} {{ $pending_order->drug->type }}</td>
                                    <td>
                                        <span class="status pending">{{ __('Pending') }}</span>

                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($pending_order->created_at)->format('j M, Y') }}</td>
                                    <td>{{ $pending_order->updated_at->diffForHumans() }}</td>
                                    <td>
                                        <ul class="active-btn">
                                            <li><a class="edit-btn" data-toggle="modal" data-target="#Editorder{{ $pending_order->id }}" href="#"><i class="fas fa-edit"></i></a></li>
                                            <li><a class="delet-btn" href="#"><i class="fas fa-trash-alt"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" align="center"><h2>{{ __('No Pending Order Found!') }}</h2></td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <div class="table-pagination mt-30">
                    <div class="row">
                        {!! $pending_orders->links('pagination::custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('modal')
    <!--Add New Patient  Modal -->
    @foreach ($all_orders as $order)
    <div class="modal fade" id="Editorder{{ $order->id }}" tabindex="-1" >
        <div class="modal-dialog small-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ $order->drug->item_name }}</h2>
                    <form action="{{ route('order.update', $order->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="drug_id" value="{{ $order->drug->id }}">
                        <input type="hidden" name="drug_qty" value="{{ $order->order_qty }}">
                        <input type="hidden" name="checkin_id" value="{{ isset($checkin_id) ? $checkin_id : 0 }}">
                        <div class="form-group">
                            <label for="date">Select An Option</label>
                            <select name="store_type" id="date" class="form-control" {{ $order->status != 0 ? 'disabled' : '' }}>
                                <option value="Confirmed">{{ __('Order Confirmed') }}</option>
                                <option value="Canceled">{{ __('Order Canceled') }}</option>
                            </select>
                            {{-- <input type="date" class="form-control" id="date" name="next_date" placeholder="10 Jan 1990" /> --}}
                        </div>
                        <button type="submit" class="primary-btn-lg btn-rounded d-block w-100 {{ $order->status != 0 ? 'disable-color' : '' }}" {{ $order->status != 0 ? 'disabled' : '' }}>{{ __('Add') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!--Add New Patient  Modal -->
@endpush
@endsection

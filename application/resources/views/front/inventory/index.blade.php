@extends('layouts.front')
@section('title', 'Inventory')
@section('content')
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
    <h2 class="section-title">{{ __('Product List') }}</h2>
</div>
<div class="primary-tabs">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="tabone-tab" data-toggle="tab" href="#tabone" role="tab" aria-controls="tabone" aria-selected="true">{{ __('Availble Stock') }}</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="tabtwo-tab" data-toggle="tab" href="#tabtwo" role="tab" aria-controls="tabtwo" aria-selected="false">{{ __('Add New Product') }}</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="tabone" role="tabpanel" aria-labelledby="tabone-tab">
            <div class="primary-table-two">
                <div class="table-responsive mb-15">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">{{ __('Item  Name') }}</th>
                            <th scope="col">{{ __('Quantity') }}</th>
                            <th scope="col">{{ __('Category') }}</th>
                            <th scope="col">{{ __('Type') }}</th>
                            <th scope="col">{{ __('Added on') }}</th>
                            <th scope="col">{{ __('Actions') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->item_name }}</td>
                                    <td>{{ $product->qty }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>{{ $product->type }}</td>
                                    <td>{{ \Carbon\Carbon::parse($product->created_at)->format('j M Y') }}</td>
                                    <td>
                                        <ul class="active-btn">
                                            <li><a class="edit-btn" href="#" data-toggle="modal" data-target="#InventoryModal{{ $product->id }}"><i class="fas fa-edit"></i></a></li>
                                            <li><a class="delet-btn" onclick="return deleteConfirmation()" href="{{ route('inventory.delete', $product->id) }}"><i class="fas fa-trash-alt"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" align="center"><h2>{{ __('No Product Found!') }}</h2></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="table-pagination mt-30">
                    <div class="row">
                        {!! $products->links('pagination::custom') !!}
                    </div>
                </div>

            </div>
        </div>
        <div class="tab-pane fade" id="tabtwo" role="tabpanel" aria-labelledby="tabtwo-tab">
            <div class="section-border-wrap border-radius-0">
                <div class="primary-form">
                    <form action="{{ route('inventory.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="ItemName">{{ __('Item Name') }}</label>
                                    <input type="text" class="form-control" id="ItemName" name="item_name" placeholder="Medicine 1, Medicine 2, Medicine 3" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="Quentity">{{ __('Quantity') }}</label>
                                    <input type="number" class="form-control" id="Quentity" name="qty" min="1" placeholder="150" />
                                </div>
                            </div>
                            {{-- <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="Unit">Unit</label>
                                    <input type="number" class="form-control" id="Unit" name="unit" min="1" step="0.01" placeholder="10 Jan 2021" />
                                </div>
                            </div> --}}
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="Catagories">{{ __('Catagories') }}</label>
                                    <input type="text" class="form-control" id="Catagories" name="category" placeholder="Ham Tika" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="Types">{{ __('Type') }}</label>
                                    <input type="text" class="form-control" id="Types" name="type" placeholder="Tika" />
                                </div>
                            </div>
                            {{-- <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="Added">Added on</label>
                                    <input type="text" class="form-control" id="Added" name="Added" placeholder="20 Feb 2021" />
                                </div>
                            </div> --}}
                            <div class="col-lg-12 mt-2">
                                <button type="submit" class="primary-btn-lg btn-rounded">{{ __('Add Now') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('modal')
@foreach ($products as $productm)
<div class="modal fade" id="InventoryModal{{ $productm->id }}" tabindex="-1" >
    <div class="modal-dialog large-model modal-dialog-centered">
        <div class="modal-content container">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="primary-form">
                <h2 class="form-title mb-25">{{ $productm->item_name }}</h2>
                <form action="{{ route('inventory.update', $productm->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="Drug">{{ __('Item Name') }}</label>
                                <input  onkeyup="addvalidation({{ $productm->id }},'#InventoryModal{{ $productm->id }} #itemname{{ $productm->id }}', '#InventoryModal{{ $productm->id }} .itemnameerror{{ $productm->id }}')" type="text" id="itemname{{ $productm->id }}" class="form-control" name="item_name" placeholder="azithromycin" value="{{ $productm->item_name }}" />
                                <small class=" text-danger d-none itemnameerror{{ $productm->id }}">Item name field is required</small>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="DrugName">{{ __('Quantity') }}</label>
                                <input onkeyup="addvalidation({{ $productm->id }},'#InventoryModal{{ $productm->id }} #qty{{ $productm->id }}', '#InventoryModal{{ $productm->id }} .qtyerror{{ $productm->id }}')" type="number" class="form-control" id="qty{{ $productm->id }}" name="qty" value="{{ $productm->qty }}" min="1" />
                                <small class=" text-danger d-none qtyerror{{ $productm->id }}">Quantity field is required</small>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="Dosage">{{ __('Categories') }}</label>
                                <input onkeyup="addvalidation({{ $productm->id }},'#InventoryModal{{ $productm->id }} #category{{ $productm->id }}', '#InventoryModal{{ $productm->id }} .categoryerror{{ $productm->id }}')" id="category{{ $productm->id }}" type="text" class="form-control" name="category" value="{{ $productm->category }}" />
                                <small class=" text-danger d-none categoryerror{{ $productm->id }}">Category field is required</small>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="Period1">{{ __('Period') }}</label>
                                <input onkeyup="addvalidation({{ $productm->id }},'#InventoryModal{{ $productm->id }} #period{{ $productm->id }}', '#InventoryModal{{ $productm->id }} .perioderror{{ $productm->id }}')" type="text" class="form-control" name="type" id="period{{ $productm->id }}" value="{{ $productm->type }}" />
                                <small class=" text-danger d-none perioderror{{ $productm->id }}">Period field is required</small>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <button type="submit" class="primary-btn-lg btn-rounded min-width-145 inventorysubmit{{ $productm->id }}">{{ __('Edit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endpush

@push('scripts')
<script>
    //edit form validation
    var $ = jQuery;
    function addvalidation($id,$class, $formeroorclass) {
        checkthevalue($id);
        if ($($class).val() == '') {
            $($formeroorclass).removeClass('d-none');
        } else {
            $($formeroorclass).addClass('d-none');
        }
    }

  function checkthevalue($id){
        if($('#itemname'+$id).val() == '' || $('#qty'+$id).val() == '' || $('#category'+$id).val() == '' || $('#period'+$id).val() == '' ){
            $('.inventorysubmit'+$id).attr("disabled", true).addClass('disabled disable-color');
            return;
        }else{
            $('.inventorysubmit'+$id).attr("disabled", false).removeClass('disabled disable-color');
        }
    }

</script>
@endpush
@endsection

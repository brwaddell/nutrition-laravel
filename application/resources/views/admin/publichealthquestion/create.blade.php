@extends('layouts.main')
@section('title', 'site')


@section('content')
@push('head')
<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">


<style>
    div#attr #remove {
    margin-left: 20px;
    color: red;
    }

    div#attr div {
        margin-bottom: 10px;
    }

    a#addattr p {
        color: #19b5fe;
        text-transform: capitalize;
        font-weight: 900;
    }

    select#pattern {
        margin-left: 10px;
    }
    div#attr #remove:hover {
        cursor: pointer;
    }
</style>
@endpush
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-sites bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Create Intermittent Question')}}</h5>
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
                            <a href="#">{{ __('Intermittent Question')}}</a>
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
                    <h3>{{ __('Intermittent Question')}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-header">
                                    <h3>{{ __('Intermittent Question elements')}}</h3>
                                </div>
                                <div class="card-body">
                                    <form class="forms-sample" action="{{isset($publicHealthQuestion) ? route('publichealthquestion.update', $publicHealthQuestion->id) : route('publichealthquestion.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="form_id" value="{{ isset($publicHealthQuestion) ? $publicHealthQuestion->form_id : $form->id }}">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Question</label>
                                            <input name="question" type="text" class="form-control" id="exampleInputName1" placeholder="Name" value="{{ isset($publicHealthQuestion) ? $publicHealthQuestion->question : '' }}">
                                            <span class="text-danger">{{ $errors->first('question') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input name="slug" type="text" class="form-control" id="slug" placeholder="Name" value="{{ isset($publicHealthQuestion) ? $publicHealthQuestion->slug : '' }}">
                                            <span class="text-danger">{{ $errors->first('slug') }}</span>
                                        </div>



                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pattern">Pattern</label>
                                                    <select name="pattern" class="form-control" id="pattern">
                                                        <option value="">----Select----</option>
                                                        <option value="selectbox" {{ isset($publicHealthQuestion) ? $publicHealthQuestion->pattern == 'selectbox' ? 'selected' : '' : '' }}>Select Box</option>
                                                        <option value="checkbox" {{ isset($publicHealthQuestion) ? $publicHealthQuestion->pattern == 'checkbox' ? 'selected' : '' : '' }}>Check Box</option>
                                                        <option value="inputbox" {{ isset($publicHealthQuestion) ? $publicHealthQuestion->pattern == 'inputbox' ? 'selected' : '' : '' }}>Input Box</option>
                                                        <option value="radiobox" {{ isset($publicHealthQuestion) ? $publicHealthQuestion->pattern == 'radiobox' ? 'selected' : '' : '' }}>radio Box</option>
                                                    </select>
                                                </div>

                                                @if (isset($publicHealthQuestion->attributes))
                                                <a  href="javascript:void(0);" id="addattr">
                                                    <p>add attribute</p>
                                                </a>
                                                <div class="form-group" id="attr">
                                                @else
                                                <a  href="javascript:void(0);" id="addattr" class="d-none">
                                                    <p>add attribute</p>
                                                </a>
                                                <div class="form-group d-none" id="attr">
                                                @endif
                                                    @if (isset($publicHealthQuestion->attributes))
                                                        @php
                                                        $attributes = $publicHealthQuestion->attributes;

                                                        $attributesArray = explode(',', $attributes);
                                                        @endphp
                                                        @foreach ($attributesArray as $array)
                                                            <label for="attrname[]">Attributes : </label>
                                                            <div class="d-flex align-items-center">
                                                                <input type="text" name="attrname[]" value="{{ $array }}" class="form-control"><span id="remove">X</span>
                                                            </div>
                                                        @endforeach

                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- markup -->
                        <div class="field_wrapper">


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<!-- push external js -->
@push('script')
<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>

<script>
    $(".select2").select2();

    $('#pattern').on('change', function(){
        if($('#pattern').val() == 'checkbox' || $('#pattern').val() == 'selectbox' || $('#pattern').val() == 'radiobox'){
            $('#attr').removeClass('d-none');
            $('#addattr').removeClass('d-none');

            $('#attr').show();
            $('#addattr').show();
        }else{
            $('#attr').hide();
            $('#addattr').hide();
        }
    })
</script>

<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10;
        var addButton = $('#addattr');
        var wrapper = $('#attr');
        var fieldHTML = '<div class="d-flex"><label for="attrname[]">Attributes : </label><input type="text" name="attrname[]"><p id="remove">X</p></div>';

        function addInputField(){
            $(wrapper).append(fieldHTML);
        }

       // addInputField()
        $(addButton).click(function(){
            addInputField()
        });


        $(wrapper).on('click', '#remove', function(e){
            e.preventDefault();
            $(this).parent('div').remove();
        });
    });
    </script>
@endpush


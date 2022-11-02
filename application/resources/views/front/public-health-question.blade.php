@extends('layouts.front')
@section('title', 'Public Health Question')
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
<div class="intermittent-information mb-40">
    <div class="section-header-three mb-40">
        <div class="row align-items-center">
            <div class="col-md-6 col-sm-6">
                <h2 class="section-title ">{{ $publicHealthForm->first()->name }}</h2>
            </div>
            <div class="col-md-6 col-sm-6 text-sm-right">
                @if (isset($paternal))
                    <span class="date">{{ __('Last Collected Date:') }} {{ \Carbon\Carbon::parse($intermittentHealth->updated_at)->format('j F, Y') }}</span>
                @else
                    <span class="date">{{ __('No Data Collected Yet') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="secondary-table">
        <div class="table-responsive mb-15">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col"><input type="checkbox" id="exampleCheck1" /></th>
                    @foreach ($publicHealthForm->first()->questions as $question)
                    <th scope="col">{{ __($question->slug) }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>

                    @if ($i!=[])
                        <tr>
                            <td><input type="checkbox" id="exampleCheck8" /> <span class="id-number"></span></td>
                            @foreach ($i as $answer)
                            <td>{{ __($answer) }}</td>
                        @endforeach
                        </tr>
                    @else
                        <tr><td colspan="9" align="center"><h2>{{ __('No information found!') }}</h2></td></tr>
                    @endif
                </tbody>
            </table>
        </div>
        @if (isCheckedIn($checkin_id))
            @if ($i!=[] )
            <a href="#" data-toggle="modal" data-target="#intermittent-edit" class="primary-btn">{{ __('Click Here To Edit') }}</a>
            @else
            <a href="#" data-toggle="modal" data-target="#intermittent" class="primary-btn">{{ __('Click Here To Save') }}</a>
            @endif
            {{-- <a href="#" data-toggle="modal" data-target="#intermittent" class="primary-btn">{{isset($intermittentHealth) ? 'Edit ' : 'Add ' }} Intermittent Health</a> --}}

        @endif

    </div>
</div>
<div class="maternal-history mb-40">
    <div class="section-header-three mb-40">
        <div class="row align-items-center">
            <div class="col-md-6 col-sm-6">
                <h2 class="section-title ">{{ __('MATERNAL HEALTH QUESTIONAIRRE') }}</h2>
            </div>
            <div class="col-md-6 col-sm-6 text-sm-right">
                @if (isset($maternal_health))
                    <span class="date">{{ __('Last Collected Date:') }} {{ \Carbon\Carbon::parse($maternal_health->updated_at)->format('j F, Y') }}</span>
                @else
                    <span class="date">{{ __('No Data Collected Yet') }}</span>
                @endif

            </div>
        </div>
    </div>
    <div class="secondary-table">
        <div class="table-responsive mb-15">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col"><input type="checkbox" id="exampleCheck3" /></th>
                    @foreach ($maternaltHealthForm->questions as $question)
                    <th scope="col">{{ __($question->slug) }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>

                    @if ($i2!=[])
                    <tr>
                        <td><input type="checkbox" id="exampleCheck8" /> <span class="id-number"></span></td>
                        @foreach ($i2 as $answer)
                        <td>{{ $answer }}</td>
                    @endforeach
                    </tr>
                @else
                    <tr><td colspan="9" align="center"><h2>{{ __('No information found!') }}</h2></td></tr>
                @endif


                </tbody>
            </table>
        </div>

        @if (isCheckedIn($checkin_id))
        @if ($i2!=[] )
        <a href="#" data-toggle="modal" data-target="#maternal-edit" class="primary-btn">{{ __('Click Here To Edit') }}</a>
        @else
        <a href="#" data-toggle="modal" data-target="#maternal" class="primary-btn">{{ __('Click Here To Save') }}</a>
        @endif

    @endif
    </div>
</div>
<div class="parental-history mb-40">
    <div class="section-header-three mb-40">
        <div class="row align-items-center">
            <div class="col-md-6 col-sm-6">
                <h2 class="section-title ">{{ __('Parental History Questionnaire') }}</h2>
            </div>
            <div class="col-md-6 col-sm-6 text-sm-right">
                @if (isset($paternal))
                    <span class="date">{{ __('Last Collected Date:') }} {{ \Carbon\Carbon::parse($paternal->updated_at)->format('j F, Y') }}</span>
                @else
                    <span class="date">{{ __('No Data Collected Yet') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="secondary-table">
        <div class="table-responsive mb-15">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col"><input type="checkbox" id="exampleCheck5" /></th>
                    @foreach ($parentalHealthForm->questions as $question)
                    <th scope="col">{{ __($question->slug) }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>

                    @if ($i3!=[])
                    <tr>
                        <td><input type="checkbox" id="exampleCheck8" /> <span class="id-number"></span></td>
                        @foreach ($i3 as $answer)
                        <td>{{ __($answer) }}</td>
                    @endforeach
                    </tr>
                @else
                    <tr><td colspan="9" align="center"><h2>{{ __('No information found!') }}</h2></td></tr>
                @endif


                </tbody>
            </table>
        </div>
        @if (isCheckedIn($checkin_id))
        @if ($i3!=[] )
        <a href="#" data-toggle="modal" data-target="#parentalform-edit" class="primary-btn">{{ __('Click Here To Edit') }}</a>
        @else
        <a href="#" data-toggle="modal" data-target="#parentalform" class="primary-btn">{{ __('Click Here To Save') }}</a>
        @endif


    @endif
    </div>
</div>
<div class="agricultural-history">
    <div class="section-header-three mb-40">
        <div class="row align-items-center">
            <div class="col-md-6 col-sm-6">
                <h2 class="section-title ">{{ __('AGRICULTURAL QUESTIONNAIRE') }}</h2>
            </div>
            <div class="col-md-6 col-sm-6 text-sm-right">
                @if (isset($agricultural))
                    <span class="date">{{ __('Last Collected Date:') }} {{ \Carbon\Carbon::parse($agricultural->updated_at)->format('j F, Y') }}</span>
                @else
                    <span class="date">{{ __('No Data Collected Yet') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="secondary-table">
        <div class="table-responsive mb-15">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col"><input type="checkbox" id="exampleCheck7" /></th>
                    @foreach ($agriculturalForm->questions as $question)
                    <th scope="col">{{ __($question->slug) }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                    @if ($i4!=[])
                        <tr>
                            <td><input type="checkbox" id="exampleCheck8" /> <span class="id-number"></span></td>
                            @foreach ($i4 as $answer)
                            <td>{{ __($answer) }}</td>
                        @endforeach
                        </tr>
                    @else
                        <tr><td colspan="9" align="center"><h2>{{ __('No information found!') }}</h2></td></tr>
                    @endif

                </tbody>
            </table>
        </div>


        @if (isCheckedIn($checkin_id))
            @if ($i4!=[] )
            <a href="#" data-toggle="modal" data-target="#agricultural-edit" class="primary-btn">{{ __('Click Here To Edit') }}</a>
            @else
            <a href="#" data-toggle="modal" data-target="#agricultural" class="primary-btn">{{ __('Click Here To Save') }}</a>
            @endif
        @endif
    </div>
</div>

@push('modal')
    <!--intermittent  Modal -->
    <div class="modal fade" id="intermittent" tabindex="-1" >
        <div class="modal-dialog large-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ __('INTERMITTENT HEALTH FORM') }}</h2>
                    <form action="{{route('intermittenthealthanswer.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="clinic_id" value="{{ session()->get('clinic_id') }}">
                        <input type="hidden" name="patient_id" value="{{ $patient_id->id }}">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                            @forelse ($publicHealthForm->first()->questions as $question)
                                <div class="form-group">
                                    <label>{{ $question->question }}</label>
                                    @if ($question->pattern == 'selectbox')

                                    @php
                                        $selectattributes = $question->attributes;
                                        $selectattributesArray = explode(',', $selectattributes);
                                    @endphp
                                        <select name="{{ $question->id }}" class="form-control" >
                                            @foreach ($selectattributesArray as $attribute)
                                                <option value="{{ $attribute }}">{{ $attribute }}</option>
                                            @endforeach
                                        </select>
                                    @elseif ($question->pattern == 'checkbox')
                                    <div class="d-flex">
                                            @php
                                                $attributes = $question->attributes;
                                                $attributesArray = explode(',', $attributes);
                                                $array = array_chunk($attributesArray, 2);
                                                $i = 0;
                                            @endphp

                                            @foreach ($array as $attribute)
                                            <div class="row">
                                                <div class="col-lg-4">

                                            @foreach ($attribute as $key=>$attr)
                                                    @php
                                                        $i++
                                                    @endphp
                                                <div class="form-group form-check">
                                                    <input name="checkbox[{{$question->id}}][]" value="{{ $attr }}" type="checkbox" class="form-check-input" id="distress{{ $key }}">
                                                    <label class="form-check-label" for="distress">{{ $attr }}</label>
                                                </div>
                                            @endforeach
                                                </div>
                                            </div>
                                            @endforeach
                                    </div>

                                    @elseif ($question->pattern == 'inputbox')
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="methods" name="{{ $question->id }}" placeholder="Lorem Ipsum" />
                                    </div>
                                    @elseif ($question->pattern == 'radiobox')
                                        @php
                                            $radioattributes = $question->attributes;
                                            $radioattributesArray = explode(',', $radioattributes);
                                        @endphp

                                        @foreach ($radioattributesArray as $key=>$attr)
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="{{ $question->id }}" id="inlineRadio{{ $key }}" value="{{ $attr }}">
                                                <label class="form-check-label" for="inlineRadio{{ $key }}">{{ $attr }}</label>
                                            </div>
                                        </div>

                                        @endforeach
                                    @endif
                                </div>
                                @empty
                                <span>No Question Here To Save</span>
                                @endforelse
                            </div>

                            <div class="col-lg-12 mt-2">
                                <button type="submit" class="primary-btn-lg btn-rounded min-width-145">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--intermittent  Modal -->
    <!--intermittent  Modal -->
    <div class="modal fade" id="intermittent-edit" tabindex="-1" >
        <div class="modal-dialog large-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ __('INTERMITTENT HEALTH FORM') }}</h2>
                    <form action="{{route('intermittenthealthanswer.update', $patient_id->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="clinic_id" value="{{ session()->get('clinic_id') }}">
                        <input type="hidden" name="patient_id" value="{{ $patient_id->id }}">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                            @forelse ($publicHealthAnswer as $question)
                                <div class="form-group">
                                    <label>{{ $question->question->question }}</label>
                                    @if ($question->question->pattern == 'selectbox')

                                    @php
                                        $selectattributes = $question->question->attributes;
                                        $selectattributesArray = explode(',', $selectattributes);
                                    @endphp
                                        <select name="{{ $question->id }}" class="form-control" >
                                            @foreach ($selectattributesArray as $attribute)
                                                <option {{ $attribute == $question->answer ? 'selected' : '' }} value="{{ $attribute }}">{{ $attribute }}</option>
                                            @endforeach
                                        </select>
                                    @elseif ($question->question->pattern == 'checkbox')
                                    <div class="d-flex">
                                            @php
                                                $attributes = $question->question->attributes;
                                                $attributesArray = explode(',', $attributes);
                                                $array = array_chunk($attributesArray, 2);
                                            @endphp

                                            @foreach ($array as $attribute)
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    @php
                                                        $answer = explode(',',$question->question->answer->answer);
                                                    @endphp
                                            @foreach ($attribute as $key=>$attr)
                                                <div class="form-group form-check">
                                                    <input {{ in_array($attr, $answer) && $question->question->answer->id == $question->id  ? 'checked' : ''}} name="checkbox[{{$question->id}}][]" value="{{ $attr }}" type="checkbox" class="form-check-input" id="distress{{ $key }}">
                                                    <label class="form-check-label" for="distress">{{ $attr }}</label>
                                                </div>
                                            @endforeach
                                                </div>
                                            </div>
                                            @endforeach
                                    </div>

                                    @elseif ($question->question->pattern == 'inputbox')
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="methods" value="{{ $question->answer }}" name="{{ $question->id }}" placeholder="Lorem Ipsum" />
                                    </div>
                                    @elseif ($question->question->pattern == 'radiobox')
                                        @php
                                            $radioattributes = $question->question->attributes;
                                            $radioattributesArray = explode(',', $radioattributes);
                                        @endphp

                                        @foreach ($radioattributesArray as $key=>$attr)
                                        <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input {{ $attr == $question->answer ? 'checked' : '' }} class="form-check-input" type="radio" name="{{ $question->id }}" id="inlineRadio{{ $key }}" value="{{ $attr }}">
                                                    <label class="form-check-label" for="inlineRadio{{ $key }}">{{ $attr }}</label>
                                                </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                                @empty
                                <span>No Question Here To Save</span>
                                @endforelse
                            </div>

                            <div class="col-lg-12 mt-2">
                                <button type="submit" class="primary-btn-lg btn-rounded min-width-145">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--intermittent  Modal -->
    <!--maternal  Modal -->
    <div class="modal fade" id="maternal" tabindex="-1" >
        <div class="modal-dialog large-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ __('MATERNAL HEALTH QUESTIONAIRRE') }}</h2>
                    <form action="{{route('intermittenthealthanswer.maternalstore') }}" method="POST">
                        @csrf
                        <input type="hidden" name="clinic_id" value="{{ session()->get('clinic_id') }}">
                        <input type="hidden" name="patient_id" value="{{ $patient_id->id }}">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                            @forelse ($maternaltHealthForm->questions as $question)
                                <div class="form-group">
                                    <label>{{ $question->question }}</label>
                                    @if ($question->pattern == 'selectbox')

                                    @php
                                        $selectattributes = $question->attributes;
                                        $selectattributesArray = explode(',', $selectattributes);
                                    @endphp
                                        <select name="{{ $question->id }}" class="form-control" >
                                            @foreach ($selectattributesArray as $attribute)
                                                <option value="{{ $attribute }}">{{ $attribute }}</option>
                                            @endforeach
                                        </select>
                                    @elseif ($question->pattern == 'checkbox')
                                    <div class="d-flex">
                                            @php
                                                $attributes = $question->attributes;
                                                $attributesArray = explode(',', $attributes);
                                                $array = array_chunk($attributesArray, 2);
                                                $i = 0;
                                            @endphp

                                            @foreach ($array as $attribute)
                                            <div class="row">
                                                <div class="col-lg-4">


                                            @foreach ($attribute as $key=>$attr)
                                                    @php
                                                        $i++
                                                    @endphp
                                                <div class="form-group form-check">
                                                    <input name="checkbox[{{$question->id}}][]" value="{{ $attr }}" type="checkbox" class="form-check-input" id="distress{{ $key }}">
                                                    <label class="form-check-label" for="distress">{{ $attr }}</label>
                                                </div>
                                            @endforeach
                                                </div>
                                            </div>
                                            @endforeach
                                    </div>

                                    @elseif ($question->pattern == 'inputbox')
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="methods" name="{{ $question->id }}" placeholder="Lorem Ipsum" />
                                    </div>
                                    @elseif ($question->pattern == 'radiobox')
                                        @php
                                            $radioattributes = $question->attributes;
                                            $radioattributesArray = explode(',', $radioattributes);
                                        @endphp

                                        @foreach ($radioattributesArray as $key=>$attr)
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="{{ $question->id }}" id="inlineRadio{{ $key }}" value="{{ $attr }}">
                                                <label class="form-check-label" for="inlineRadio{{ $key }}">{{ $attr }}</label>
                                            </div>
                                        </div>

                                        @endforeach
                                    @endif
                                </div>
                                @empty
                                <span>No Question Here To Save</span>
                                @endforelse
                            </div>

                            <div class="col-lg-12 mt-2">
                                <button type="submit" class="primary-btn-lg btn-rounded min-width-145">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--maternal  Modal -->
    <!--maternal  Modal -->
    <div class="modal fade" id="maternal-edit" tabindex="-1" >
        <div class="modal-dialog large-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ __('MATERNAL HEALTH QUESTIONAIRRE') }}</h2>
                    <form action="{{route('intermittenthealthanswer.maternalupdate', $patient_id->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="clinic_id" value="{{ session()->get('clinic_id') }}">
                        <input type="hidden" name="patient_id" value="{{ $patient_id->id }}">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                            @forelse ($maternalHealthAnswer as $question)
                                <div class="form-group">
                                    <label>{{ $question->question->question }}</label>
                                    @if ($question->question->pattern == 'selectbox')

                                    @php
                                        $selectattributes = $question->question->attributes;
                                        $selectattributesArray = explode(',', $selectattributes);
                                    @endphp
                                        <select name="{{ $question->id }}" class="form-control" >
                                            @foreach ($selectattributesArray as $attribute)
                                                <option {{ $attribute == $question->answer ? 'selected' : '' }} value="{{ $attribute }}">{{ $attribute }}</option>
                                            @endforeach
                                        </select>
                                    @elseif ($question->question->pattern == 'checkbox')
                                    <div class="d-flex">
                                            @php
                                                $attributes = $question->question->attributes;
                                                $attributesArray = explode(',', $attributes);
                                                $array = array_chunk($attributesArray, 2);
                                            @endphp

                                            @foreach ($array as $attribute)
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    @php
                                                        $answer = explode(',',$question->question->answer->answer);
                                                    @endphp
                                            @foreach ($attribute as $key=>$attr)
                                                <div class="form-group form-check">
                                                    <input {{ in_array($attr, $answer) && $question->question->answer->id == $question->id  ? 'checked' : ''}} name="checkbox[{{$question->id}}][]" value="{{ $attr }}" type="checkbox" class="form-check-input" id="distress{{ $key }}">
                                                    <label class="form-check-label" for="distress">{{ $attr }}</label>
                                                </div>
                                            @endforeach
                                                </div>
                                            </div>
                                            @endforeach
                                    </div>

                                    @elseif ($question->question->pattern == 'inputbox')
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="methods" value="{{ $question->answer }}" name="{{ $question->id }}" placeholder="Lorem Ipsum" />
                                    </div>
                                    @elseif ($question->question->pattern == 'radiobox')
                                        @php
                                            $radioattributes = $question->question->attributes;
                                            $radioattributesArray = explode(',', $radioattributes);
                                        @endphp

                                        @foreach ($radioattributesArray as $key=>$attr)
                                        <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input {{ $attr == $question->answer ? 'checked' : '' }} class="form-check-input" type="radio" name="{{ $question->id }}" id="inlineRadio{{ $key }}" value="{{ $attr }}">
                                                    <label class="form-check-label" for="inlineRadio{{ $key }}">{{ $attr }}</label>
                                                </div>

                                        </div>

                                        @endforeach
                                    @endif
                                </div>
                                @empty
                                <span>No Question Here To Save</span>
                                @endforelse
                            </div>

                            <div class="col-lg-12 mt-2">
                                <button type="submit" class="primary-btn-lg btn-rounded min-width-145">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--maternal  Modal -->
    <!--addPrenatalHistory  Modal -->
    <div class="modal fade" id="parentalform" tabindex="-1" >
        <div class="modal-dialog large-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ __('Parental History Questionnaire') }}</h2>
                    <form action="{{route('intermittenthealthanswer.parentalstore') }}" method="POST">
                        @csrf
                        <input type="hidden" name="clinic_id" value="{{ session()->get('clinic_id') }}">
                        <input type="hidden" name="patient_id" value="{{ $patient_id->id }}">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                            @forelse ($parentalHealthForm->questions as $question)
                                <div class="form-group">
                                    <label>{{ $question->question }}</label>
                                    @if ($question->pattern == 'selectbox')

                                    @php
                                        $selectattributes = $question->attributes;
                                        $selectattributesArray = explode(',', $selectattributes);
                                    @endphp
                                        <select name="{{ $question->id }}" class="form-control" >
                                            @foreach ($selectattributesArray as $attribute)
                                                <option value="{{ $attribute }}">{{ $attribute }}</option>
                                            @endforeach
                                        </select>
                                    @elseif ($question->pattern == 'checkbox')
                                    <div class="d-flex">
                                            @php
                                                $attributes = $question->attributes;
                                                $attributesArray = explode(',', $attributes);
                                                $array = array_chunk($attributesArray, 2);
                                                $i = 0;
                                            @endphp

                                            @foreach ($array as $attribute)
                                            <div class="row">
                                                <div class="col-lg-4">

                                            @foreach ($attribute as $key=>$attr)
                                                    @php
                                                        $i++
                                                    @endphp
                                                <div class="form-group form-check">
                                                    <input name="checkbox[{{$question->id}}][]" value="{{ $attr }}" type="checkbox" class="form-check-input" id="distress{{ $key }}">
                                                    <label class="form-check-label" for="distress">{{ $attr }}</label>
                                                </div>
                                            @endforeach
                                                </div>
                                            </div>
                                            @endforeach
                                    </div>

                                    @elseif ($question->pattern == 'inputbox')
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="methods" name="{{ $question->id }}" placeholder="Lorem Ipsum" />
                                    </div>
                                    @elseif ($question->pattern == 'radiobox')
                                        @php
                                            $radioattributes = $question->attributes;
                                            $radioattributesArray = explode(',', $radioattributes);
                                        @endphp

                                        @foreach ($radioattributesArray as $key=>$attr)
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="{{ $question->id }}" id="inlineRadio{{ $key }}" value="{{ $attr }}">
                                                <label class="form-check-label" for="inlineRadio{{ $key }}">{{ $attr }}</label>
                                            </div>
                                        </div>

                                        @endforeach
                                    @endif
                                </div>
                                @empty
                                <span>No Question Here To Save</span>
                                @endforelse
                            </div>

                            <div class="col-lg-12 mt-2">
                                <button type="submit" class="primary-btn-lg btn-rounded min-width-145">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--addPrenatalHistory  Modal -->
    <!--addPrenatalHistory  Modal -->
    <div class="modal fade" id="parentalform-edit" tabindex="-1" >
        <div class="modal-dialog large-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ __('Parental History Questionnaire') }}</h2>
                    <form action="{{route('intermittenthealthanswer.parentalupdate', $patient_id->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="clinic_id" value="{{ session()->get('clinic_id') }}">
                        <input type="hidden" name="patient_id" value="{{ $patient_id->id }}">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                            @forelse ($parentalHealthAnswer as $question)
                                <div class="form-group">
                                    <label>{{ $question->question->question }}</label>
                                    @if ($question->question->pattern == 'selectbox')

                                    @php
                                        $selectattributes = $question->question->attributes;
                                        $selectattributesArray = explode(',', $selectattributes);
                                    @endphp
                                        <select name="{{ $question->id }}" class="form-control" >
                                            @foreach ($selectattributesArray as $attribute)
                                                <option {{ $attribute == $question->answer ? 'selected' : '' }} value="{{ $attribute }}">{{ $attribute }}</option>
                                            @endforeach
                                        </select>
                                    @elseif ($question->question->pattern == 'checkbox')
                                    <div class="d-flex">
                                            @php
                                                $attributes = $question->question->attributes;
                                                $attributesArray = explode(',', $attributes);
                                                $array = array_chunk($attributesArray, 2);
                                            @endphp

                                            @foreach ($array as $attribute)
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    @php
                                                        $answer = explode(',',$question->question->answer->answer);
                                                    @endphp
                                            @foreach ($attribute as $key=>$attr)
                                                <div class="form-group form-check">
                                                    <input {{ in_array($attr, $answer) && $question->question->answer->id == $question->id  ? 'checked' : ''}} name="checkbox[{{$question->id}}][]" value="{{ $attr }}" type="checkbox" class="form-check-input" id="distress{{ $key }}">
                                                    <label class="form-check-label" for="distress">{{ $attr }}</label>
                                                </div>
                                            @endforeach
                                                </div>
                                            </div>
                                            @endforeach
                                    </div>

                                    @elseif ($question->question->pattern == 'inputbox')
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="methods" value="{{ $question->answer }}" name="{{ $question->id }}" placeholder="Lorem Ipsum" />
                                    </div>
                                    @elseif ($question->question->pattern == 'radiobox')
                                        @php
                                            $radioattributes = $question->question->attributes;
                                            $radioattributesArray = explode(',', $radioattributes);
                                        @endphp

                                        @foreach ($radioattributesArray as $key=>$attr)
                                        <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input {{ $attr == $question->answer ? 'checked' : '' }} class="form-check-input" type="radio" name="{{ $question->id }}" id="inlineRadio{{ $key }}" value="{{ $attr }}">
                                                    <label class="form-check-label" for="inlineRadio{{ $key }}">{{ $attr }}</label>
                                                </div>

                                        </div>

                                        @endforeach
                                    @endif
                                </div>
                                @empty
                                <span>No Question Here To Save</span>
                                @endforelse
                            </div>

                            <div class="col-lg-12 mt-2">
                                <button type="submit" class="primary-btn-lg btn-rounded min-width-145">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--addPrenatalHistory  Modal -->
    <!--Birthinformation  Modal -->
    <div class="modal fade" id="agricultural" tabindex="-1" >
        <div class="modal-dialog large-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ __('AGRICULTURAL QUESTIONNAIRE') }}</h2>
                    <form action="{{route('intermittenthealthanswer.agriculturalstore') }}" method="POST">
                        @csrf
                        <input type="hidden" name="clinic_id" value="{{ session()->get('clinic_id') }}">
                        <input type="hidden" name="patient_id" value="{{ $patient_id->id }}">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                            @forelse ($agriculturalForm->questions as $question)
                                <div class="form-group">
                                    <label>{{ $question->question }}</label>
                                    @if ($question->pattern == 'selectbox')

                                    @php
                                        $selectattributes = $question->attributes;
                                        $selectattributesArray = explode(',', $selectattributes);
                                    @endphp
                                        <select name="{{ $question->id }}" class="form-control" >
                                            @foreach ($selectattributesArray as $attribute)
                                                <option value="{{ $attribute }}">{{ $attribute }}</option>
                                            @endforeach
                                        </select>
                                    @elseif ($question->pattern == 'checkbox')
                                    <div class="d-flex">
                                            @php
                                                $attributes = $question->attributes;
                                                $attributesArray = explode(',', $attributes);
                                                $array = array_chunk($attributesArray, 2);
                                                $i = 0;
                                            @endphp

                                            @foreach ($array as $attribute)
                                            <div class="row">
                                                <div class="col-lg-4">

                                            @foreach ($attribute as $key=>$attr)
                                                    @php
                                                        $i++
                                                    @endphp
                                                <div class="form-group form-check">
                                                    <input name="checkbox[{{$question->id}}][]" value="{{ $attr }}" type="checkbox" class="form-check-input" id="distress{{ $key }}">
                                                    <label class="form-check-label" for="distress">{{ $attr }}</label>
                                                </div>
                                            @endforeach
                                                </div>
                                            </div>
                                            @endforeach
                                    </div>

                                    @elseif ($question->pattern == 'inputbox')
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="methods" name="{{ $question->id }}" placeholder="Lorem Ipsum" />
                                    </div>
                                    @elseif ($question->pattern == 'radiobox')
                                        @php
                                            $radioattributes = $question->attributes;
                                            $radioattributesArray = explode(',', $radioattributes);
                                        @endphp

                                        @foreach ($radioattributesArray as $key=>$attr)
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="{{ $question->id }}" id="inlineRadio{{ $key }}" value="{{ $attr }}">
                                                <label class="form-check-label" for="inlineRadio{{ $key }}">{{ $attr }}</label>
                                            </div>
                                        </div>

                                        @endforeach
                                    @endif
                                </div>
                                @empty
                                <span>No Question Here To Save</span>
                                @endforelse
                            </div>

                            <div class="col-lg-12 mt-2">
                                <button type="submit" class="primary-btn-lg btn-rounded min-width-145">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Birthinformation  Modal -->
    <!--Birthinformation  Modal -->
    <div class="modal fade" id="agricultural-edit" tabindex="-1" >
        <div class="modal-dialog large-model modal-dialog-centered">
            <div class="modal-content container">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="primary-form">
                    <h2 class="form-title mb-25">{{ __('AGRICULTURAL QUESTIONNAIRE') }}</h2>
                    <form action="{{route('intermittenthealthanswer.agriculturalupdate', $patient_id->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="clinic_id" value="{{ session()->get('clinic_id') }}">
                        <input type="hidden" name="patient_id" value="{{ $patient_id->id }}">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                            @forelse ($argiculturalAnswer as $question)
                                <div class="form-group">
                                    <label>{{ $question->question->question }}</label>
                                    @if ($question->question->pattern == 'selectbox')

                                    @php
                                        $selectattributes = $question->question->attributes;
                                        $selectattributesArray = explode(',', $selectattributes);
                                    @endphp
                                        <select name="{{ $question->id }}" class="form-control" >
                                            @foreach ($selectattributesArray as $attribute)
                                                <option {{ $attribute == $question->answer ? 'selected' : '' }} value="{{ $attribute }}">{{ $attribute }}</option>
                                            @endforeach
                                        </select>
                                    @elseif ($question->question->pattern == 'checkbox')
                                    <div class="d-flex">
                                            @php
                                                $attributes = $question->question->attributes;
                                                $attributesArray = explode(',', $attributes);
                                                $array = array_chunk($attributesArray, 2);
                                            @endphp

                                            @foreach ($array as $attribute)
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    @php
                                                        $answer = explode(',',$question->question->answer->answer);
                                                    @endphp
                                            @foreach ($attribute as $key=>$attr)
                                                <div class="form-group form-check">
                                                    <input {{ in_array($attr, $answer) && $question->question->answer->id == $question->id  ? 'checked' : ''}} name="checkbox[{{$question->id}}][]" value="{{ $attr }}" type="checkbox" class="form-check-input" id="distress{{ $key }}">
                                                    <label class="form-check-label" for="distress">{{ $attr }}</label>
                                                </div>
                                            @endforeach
                                                </div>
                                            </div>
                                            @endforeach
                                    </div>

                                    @elseif ($question->question->pattern == 'inputbox')
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="methods" value="{{ $question->answer }}" name="{{ $question->id }}" placeholder="Lorem Ipsum" />
                                    </div>
                                    @elseif ($question->question->pattern == 'radiobox')
                                        @php
                                            $radioattributes = $question->question->attributes;
                                            $radioattributesArray = explode(',', $radioattributes);
                                        @endphp

                                        @foreach ($radioattributesArray as $key=>$attr)
                                        <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input {{ $attr == $question->answer ? 'checked' : '' }} class="form-check-input" type="radio" name="{{ $question->id }}" id="inlineRadio{{ $key }}" value="{{ $attr }}">
                                                    <label class="form-check-label" for="inlineRadio{{ $key }}">{{ $attr }}</label>
                                                </div>

                                        </div>

                                        @endforeach
                                    @endif
                                </div>
                                @empty
                                <span>No Question Here To Save</span>
                                @endforelse
                            </div>

                            <div class="col-lg-12 mt-2">
                                <button type="submit" class="primary-btn-lg btn-rounded min-width-145">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Birthinformation  Modal -->
@endpush

@push('scripts')
    <script>
       function checkHospitalization()
       {
            var hosp = document.getElementById('Hospitalization');
            var field = document.getElementById('hospitalized');
            if(hosp.checked == false) {
                field.setAttribute('disabled', true);
            }
            else {
                field.removeAttribute('disabled');
                field.setAttribute('required', true);
            }
       }
    </script>
@endpush
@endsection

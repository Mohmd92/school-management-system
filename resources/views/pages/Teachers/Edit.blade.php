@extends('layouts.master')

@section('css')
    @toastr_css
@endsection

@section('title')
    {{ trans('teachers.Edit_Teacher') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
@endsection

@section('PageTitle')
    {{ trans('teachers.Edit_Teacher') }}
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{ route('teachers.update','test') }}" method="post">
                                {{ method_field('patch') }}
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{ trans('teachers.Email') }}</label>
                                        <input type="hidden" value="{{ $teacher->id }}" name="id">
                                        <input type="email" name="email" value="{{$teacher->email}}"
                                               class="form-control">
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('teachers.Password')}}</label>
                                        <input type="password" name="password" value="{{ $teacher->password }}"
                                               class="form-control">
                                        @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{ trans('teachers.Name_ar') }}</label>
                                        <input type="text" name="name"
                                               value="{{ $teacher->getTranslation('name', 'ar') }}"
                                               class="form-control">
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{ trans('teachers.Name_en') }}</label>
                                        <input type="text" name="name_en"
                                               value="{{ $teacher->getTranslation('name', 'en') }}"
                                               class="form-control">
                                        @error('name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputCity">{{ trans('teachers.specialization') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="specialization_id">
{{--                                            <option value="{{ $teacher->specialization_id }}">{{ $teacher->specialization->name }}</option>--}}
                                            @foreach($specializations as $specialization)
                                                <option value="{{ $specialization->id }}" @if($teacher->specialization_id == $specialization->id) selected @endif>{{ $specialization->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('specialization_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputState">{{ trans('teachers.Gender') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="gender_id">
{{--                                            <option value="{{$teacher->gender_id}}">{{$teacher->gender->name}}</option>--}}
                                            @foreach($genders as $gender)
                                                <option value="{{$gender->id}}" @if($teacher->gender_id == $gender->id) selected @endif>{{$gender->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('gender_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('teachers.Joining_Date')}}</label>
                                        <div class='input-group date'>
                                            <input class="form-control" type="text" id="datepicker-action"
                                                   value="{{$teacher->joining_date}}" name="joining_date"
                                                   data-date-format="yyyy-mm-dd" required>
                                        </div>
                                        @error('joining_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label
                                        for="exampleFormControlTextarea1">{{ trans('teachers.Address') }}</label>
                                    <textarea class="form-control" name="address"
                                              id="exampleFormControlTextarea1"
                                              rows="4">{{ $teacher->address }}</textarea>
                                    @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-success btn-sm nextBtn"
                                        type="submit">{{ trans('parents.Next') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection

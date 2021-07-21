@if($currentStep != 1)
    <div style="display: none" class="row setup-content" id="step-1">
@endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>
                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('parents.Email')}}</label>
                        <input type="email" wire:model="email" class="form-control">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parents.Password')}}</label>
                        <input type="password" wire:model="password" class="form-control">
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('parents.Name_Father')}}</label>
                        <input type="text" wire:model="father_name" class="form-control">
                        @error('father_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parents.Name_Father_en')}}</label>
                        <input type="text" wire:model="father_name_en" class="form-control">
                        @error('father_name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">{{trans('parents.Job_Father')}}</label>
                        <input type="text" wire:model="father_job" class="form-control">
                        @error('father_job')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{trans('parents.Job_Father_en')}}</label>
                        <input type="text" wire:model="father_job_en" class="form-control">
                        @error('father_job_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('parents.National_ID_Father')}}</label>
                        <input type="text" wire:model="father_id" class="form-control">
                        @error('father_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

{{--                    <div class="col">--}}
{{--                        <label for="title">{{trans('parents.Passport_ID_Father')}}</label>--}}
{{--                        <input type="text" wire:model="Passport_ID_Father" class="form-control">--}}
{{--                        @error('Passport_ID_Father')--}}
{{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

                    <div class="col">
                        <label for="title">{{trans('parents.Phone_Father')}}</label>
                        <input type="text" wire:model="father_mobile" class="form-control">
                        @error('father_mobile')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('parents.Nationality_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="father_nationality_id">
                            <option selected>{{trans('parents.Choose')}}...</option>
                            @foreach($nationalities as $nationality)
                                <option value="{{$nationality->id}}">{{$nationality->name}}</option>
                            @endforeach
                        </select>
                        @error('father_nationality_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('parents.Blood_Type_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="father_blood_type_id">
                            <option selected>{{trans('parents.Choose')}}...</option>
                            @foreach($blood_types as $blood_type)
                                <option value="{{$blood_type->id}}">{{$blood_type->name}}</option>
                            @endforeach
                        </select>
                        @error('father_blood_type_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--                    <div class="form-group col">--}}
                    {{--                        <label for="inputZip">{{trans('parents.Religion_Father_id')}}</label>--}}
                    {{--                        <select class="custom-select my-1 mr-sm-2" wire:model="Religion_Father_id">--}}
                    {{--                            <option selected>{{trans('parents.Choose')}}...</option>--}}
                    {{--                            @foreach($Religions as $Religion)--}}
                    {{--                                <option value="{{$Religion->id}}">{{$Religion->Name}}</option>--}}
                    {{--                            @endforeach--}}
                    {{--                        </select>--}}
                    {{--                        @error('Religion_Father_id')--}}
                    {{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
                    {{--                        @enderror--}}
                    {{--                    </div>--}}
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('parents.Address_Father')}}</label>
                    <textarea class="form-control" wire:model="father_address" id="exampleFormControlTextarea1"
                              rows="4"></textarea>
                    @error('father_address')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                @if($updateMode)
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit_edit"
                            type="button">{{trans('parents.Next')}}
                    </button>
                @else
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit"
                            type="button">{{trans('parents.Next')}}
                    </button>
                @endif

            </div>
        </div>
    </div>

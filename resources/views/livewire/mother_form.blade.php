@if($currentStep != 2)
    <div style="display: none" class="row setup-content" id="step-2">
@endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>

                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('parents.Name_Mother')}}</label>
                        <input type="text" wire:model="mother_name" class="form-control">
                        @error('mother_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parents.Name_Mother_en')}}</label>
                        <input type="text" wire:model="mother_name_en" class="form-control">
                        @error('mother_name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">{{trans('parents.Job_Mother')}}</label>
                        <input type="text" wire:model="mother_job" class="form-control">
                        @error('mother_job')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{trans('parents.Job_Mother_en')}}</label>
                        <input type="text" wire:model="mother_job_en" class="form-control">
                        @error('Job_Mother_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('parents.National_ID_Mother')}}</label>
                        <input type="text" wire:model="mother_id" class="form-control">
                        @error('mother_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

{{--                    <div class="col">--}}
{{--                        <label for="title">{{trans('parents.Passport_ID_Mother')}}</label>--}}
{{--                        <input type="text" wire:model="Passport_ID_Mother" class="form-control">--}}
{{--                        @error('Passport_ID_Mother')--}}
{{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

                    <div class="col">
                        <label for="title">{{trans('parents.Phone_Mother')}}</label>
                        <input type="text" wire:model="mother_mobile" class="form-control">
                        @error('mother_mobile')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('parents.Nationality_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="mother_nationality_id">
                            <option selected>{{trans('parents.Choose')}}...</option>
                            @foreach($nationalities as $nationality)
                                <option value="{{$nationality->id}}">{{$nationality->name}}</option>
                            @endforeach
                        </select>
                        @error('mother_nationality_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('parents.Blood_Type_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="mother_blood_type_id">
                            <option selected>{{trans('parents.Choose')}}...</option>
                            @foreach($blood_types as $blood_type)
                                <option value="{{$blood_type->id}}">{{$blood_type->name}}</option>
                            @endforeach
                        </select>
                        @error('mother_blood_type_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
{{--                    <div class="form-group col">--}}
{{--                        <label for="inputZip">{{trans('parents.Religion_Father_id')}}</label>--}}
{{--                        <select class="custom-select my-1 mr-sm-2" wire:model="Religion_Mother_id">--}}
{{--                            <option selected>{{trans('parents.Choose')}}...</option>--}}
{{--                            @foreach($Religions as $Religion)--}}
{{--                                <option value="{{$Religion->id}}">{{$Religion->Name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        @error('Religion_Mother_id')--}}
{{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('parents.Address_Mother')}}</label>
                    <textarea class="form-control" wire:model="mother_address" id="exampleFormControlTextarea1"
                              rows="4"></textarea>
                    @error('mother_address')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button" wire:click="back(1)">
                    {{trans('parents.Back')}}
                </button>

                @if($updateMode)
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="secondStepSubmit_edit"
                            type="button">{{trans('parents.Next')}}
                    </button>
                @else
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button"
                            wire:click="secondStepSubmit">{{trans('parents.Next')}}</button>
                @endif

            </div>
        </div>
    </div>


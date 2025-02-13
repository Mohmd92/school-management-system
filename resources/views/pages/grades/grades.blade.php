@extends('layouts.master')

@section('css')
    @toastr_css
@endsection

@section('title')
    {{ trans('main_sidebar.Grades_List') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('main_sidebar.Grades_List') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Page Title</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    {{--    <div class="row">--}}
    {{--        <div class="col-sm-6">--}}
    {{--            <h5 class="mb-0">Data HTML Table </h5>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <!-- main body -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('grades.add_grade') }}
                    </button>
                    <br/><br/>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('grades.name') }}</th>
                                <th>{{ trans('grades.notes') }}</th>
                                <th>{{ trans('grades.processes') }}</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($grades as $grade)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $grade->name }}</td>
                                    <td>{{ $grade->notes }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $grade->id }}"
                                                title="{{ trans('grades.edit') }}"><i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $grade->id }}"
                                                title="{{ trans('grades.delete') }}"><i
                                                    class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Start edit modal -->
                                <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('grades.edit_grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{ route('grades.update', 'test') }}" method="post">
                                                    {{ method_field('patch') }}
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name"
                                                                   class="mr-sm-2">{{ trans('grades.stage_name_ar') }}
                                                                :</label>
                                                            <input id="Name" type="text" name="name"
                                                                   class="form-control"
                                                                   value="{{ $grade->getTranslation('name', 'ar') }}"
                                                                   required>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                   value="{{ $grade->id }}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="Name_en"
                                                                   class="mr-sm-2">{{ trans('grades.stage_name_en') }}
                                                                :</label>
                                                            <input id="Name_en" type="text" class="form-control"
                                                                   value="{{ $grade->getTranslation('name', 'en') }}"
                                                                   name="name_en" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                                for="exampleFormControlTextarea1">{{ trans('grades.notes') }}
                                                            :</label>
                                                        <textarea class="form-control" name="notes"
                                                                  id="exampleFormControlTextarea1"
                                                                  rows="3">{{ $grade->notes }}</textarea>
                                                    </div>
                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('grades.close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-success">{{ trans('grades.submit') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End edit modal -->

                                <!-- Start delete modal -->
                                <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('grades.delete_grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('grades.destroy', 'test') }}" method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('grades.warning_grade') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $grade->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('grades.close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">{{ trans('grades.delete') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End delete modal -->

                            @endforeach
                            </tbody>

{{--                            <tfoot>--}}
{{--                            <tr>--}}
{{--                                <th>#</th>--}}
{{--                                <th>{{ trans('grades.name') }}</th>--}}
{{--                                <th>{{ trans('grades.notes') }}</th>--}}
{{--                                <th>{{ trans('grades.processes') }}</th>--}}
{{--                            </tr>--}}
{{--                            </tfoot>--}}
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add modal start -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('grades.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                {{ trans('grades.add_grade') }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- add_form -->
                            <div class="row">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ trans('grades.stage_name_ar') }}
                                        :</label>
                                    <input id="Name" type="text" name="name" class="form-control" required>
                                </div>
                                <div class="col">
                                    <label for="Name_en" class="mr-sm-2">{{ trans('grades.stage_name_en') }}
                                        :</label>
                                    <input id="Name_en" type="text" class="form-control" name="name_en" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{ trans('grades.notes') }}
                                    :</label>
                                <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                                          rows="3"></textarea>
                            </div>
                            <br><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('grades.close') }}</button>
                            <button type="submit" class="btn btn-success">{{ trans('grades.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add modal end-->

    </div>
    <!-- row closed -->
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection

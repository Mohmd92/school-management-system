@extends('layouts.master')

@section('css')
    @toastr_css
@endsection

@section('title')
    {{ trans('sections.title_page') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
@endsection

@section('PageTitle')
    {{ trans('sections.title_page') }}
<!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('sections.add_section') }}</a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">

                            @foreach ($grades as $grade)

                                <div class="acd-group">
                                    <a href="#" class="acd-heading">{{ $grade->name }}</a>
                                    <div class="acd-des">

                                        <div class="row">
                                            <div class="col-xl-12 mb-30">
                                                <div class="card card-statistics h-100">
                                                    <div class="card-body">
                                                        <div class="d-block d-md-flex justify-content-between">
                                                            <div class="d-block">
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive mt-15">
                                                            <table class="table center-aligned-table mb-0">
                                                                <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th>{{ trans('sections.Name_Section') }}
                                                                    </th>
                                                                    <th>{{ trans('sections.Name_Class') }}</th>
                                                                    <th>{{ trans('sections.Status') }}</th>
                                                                    <th>{{ trans('sections.Processes') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php $i = 0; ?>
                                                                @foreach ($grade->sections as $section)
                                                                    <tr>
                                                                        <?php $i++; ?>
                                                                        <td>{{ $i }}</td>
                                                                        <td>{{ $section->name }}</td>
                                                                        <td>{{ $section->classroom->name }}</td>
                                                                        <td>
                                                                            @if ($section->status === 1)
                                                                                <label
                                                                                    class="badge badge-success">{{ trans('sections.Status_Section_AC') }}</label>
                                                                            @else
                                                                                <label
                                                                                    class="badge badge-danger">{{ trans('sections.Status_Section_No') }}</label>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <a href="#"
                                                                               class="btn btn-outline-info btn-sm"
                                                                               data-toggle="modal"
                                                                               data-target="#edit{{ $section->id }}">{{ trans('sections.Edit') }}</a>
                                                                            <a href="#"
                                                                               class="btn btn-outline-danger btn-sm"
                                                                               data-toggle="modal"
                                                                               data-target="#delete{{ $section->id }}">{{ trans('sections.Delete') }}</a>
                                                                        </td>
                                                                    </tr>

                                                                    <!--تعديل قسم جديد -->
                                                                    <div class="modal fade"
                                                                         id="edit{{ $section->id }}"
                                                                         tabindex="-1" role="dialog"
                                                                         aria-labelledby="exampleModalLabel"
                                                                         aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        style="font-family: 'Cairo', sans-serif;"
                                                                                        id="exampleModalLabel">
                                                                                        {{ trans('sections.edit_Section') }}
                                                                                    </h5>
                                                                                    <button type="button" class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form
                                                                                    action="{{ route('sections.update', 'test') }}"
                                                                                    method="POST">
                                                                                    {{ method_field('patch') }}
                                                                                    {{ csrf_field() }}
                                                                                    <div class="modal-body">

                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <input type="text"
                                                                                                       name="name_ar"
                                                                                                       class="form-control"
                                                                                                       value="{{ $section->getTranslation('name', 'ar') }}">
                                                                                            </div>

                                                                                            <div class="col">
                                                                                                <input type="text"
                                                                                                       name="name_en"
                                                                                                       class="form-control"
                                                                                                       value="{{ $section->getTranslation('name', 'en') }}">
                                                                                                <input id="id"
                                                                                                       type="hidden"
                                                                                                       name="id"
                                                                                                       class="form-control"
                                                                                                       value="{{ $section->id }}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <br>

                                                                                        <div class="col">
                                                                                            <label for="inputName"
                                                                                                   class="control-label">{{ trans('sections.Name_Grade') }}</label>
                                                                                            <select name="grade_id"
                                                                                                    class="custom-select">
                                                                                                @foreach ($grades_list as $grade)
                                                                                                    <option @if($grade->id == $section->grade_id) selected @endif
                                                                                                        value="{{ $grade->id }}">
                                                                                                        {{ $grade->name }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        <br>

                                                                                        <div class="col">
                                                                                            <label for="inputName"
                                                                                                   class="control-label">{{ trans('sections.Name_Class') }}</label>
                                                                                            <select name="classroom_id"
                                                                                                    class="custom-select">
                                                                                                @foreach ($section->grade->classrooms as $classroom)
                                                                                                    <option @if($classroom->id == $section->classroom_id) selected @endif
                                                                                                        value="{{ $classroom->id }}">
                                                                                                        {{ $classroom->name }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        <br>

                                                                                        <div class="col">
                                                                                            <div class="form-check">

                                                                                                <input
                                                                                                    type="checkbox"
                                                                                                    @if ($section->status === 1) checked @endif
                                                                                                    class="form-check-input"
                                                                                                    name="status"
                                                                                                    id="exampleCheck1">
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="exampleCheck1">{{ trans('sections.Status') }}</label><br>

                                                                                                    <!-- Teachers -->
{{--                                                                                                <div class="col">--}}
{{--                                                                                                    <label--}}
{{--                                                                                                        for="inputName"--}}
{{--                                                                                                        class="control-label">{{ trans('sections.Name_Teacher') }}</label>--}}
{{--                                                                                                    <select multiple--}}
{{--                                                                                                            name="teacher_id[]"--}}
{{--                                                                                                            class="form-control"--}}
{{--                                                                                                            id="exampleFormControlSelect2">--}}
{{--                                                                                                        @foreach($section->teachers as $teacher)--}}
{{--                                                                                                            <option--}}
{{--                                                                                                                selected--}}
{{--                                                                                                                value="{{$teacher['id']}}">{{$teacher['Name']}}</option>--}}
{{--                                                                                                        @endforeach--}}

{{--                                                                                                        @foreach($teachers as $teacher)--}}
{{--                                                                                                            <option--}}
{{--                                                                                                                value="{{$teacher->id}}">{{$teacher->Name}}</option>--}}
{{--                                                                                                        @endforeach--}}
{{--                                                                                                    </select>--}}
{{--                                                                                                </div>--}}
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-dismiss="modal">{{ trans('sections.Close') }}</button>
                                                                                        <button type="submit"
                                                                                                class="btn btn-danger">{{ trans('sections.submit') }}</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <!-- delete_modal_Grade -->
                                                                    <div class="modal fade"
                                                                         id="delete{{ $section->id }}"
                                                                         tabindex="-1" role="dialog"
                                                                         aria-labelledby="exampleModalLabel"
                                                                         aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                        class="modal-title"
                                                                                        id="exampleModalLabel">
                                                                                        {{ trans('sections.delete_Section') }}
                                                                                    </h5>
                                                                                    <button type="button" class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form
                                                                                        action="{{ route('sections.destroy', 'test') }}"
                                                                                        method="post">
                                                                                        {{ method_field('Delete') }}
                                                                                        @csrf
                                                                                        {{ trans('sections.Warning_Section') }}
                                                                                        <input id="id" type="hidden"
                                                                                               name="id"
                                                                                               class="form-control"
                                                                                               value="{{ $section->id }}">
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                    class="btn btn-secondary"
                                                                                                    data-dismiss="modal">{{ trans('sections.Close') }}</button>
                                                                                            <button type="submit"
                                                                                                    class="btn btn-danger">{{ trans('sections.submit') }}</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>

                    <!--اضافة قسم جديد -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;"
                                        id="exampleModalLabel">
                                        {{ trans('sections.add_section') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('sections.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <div class="row">

                                            <div class="col">
                                                <input type="text" name="name_ar" class="form-control"
                                                       placeholder="{{ trans('sections.Section_name_ar') }}">
                                            </div>

                                            <div class="col">
                                                <input type="text" name="name_en" class="form-control"
                                                       placeholder="{{ trans('sections.Section_name_en') }}">
                                            </div>
                                        </div>
                                        <br>

                                        <div class="col">
                                            <label for="inputName"
                                                   class="control-label">{{ trans('sections.Name_Grade') }}</label>
                                            <select name="grade_id" class="custom-select">
                                                <!--placeholder-->
                                                <option value="" selected
                                                        disabled>{{ trans('sections.Select_Grade') }}
                                                </option>
                                                @foreach ($grades_list as $grade)
                                                    <option value="{{ $grade->id }}"> {{ $grade->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>

                                        <div class="col">
                                            <label for="inputName"
                                                   class="control-label">{{ trans('sections.Name_Class') }}</label>
                                            <select name="classroom_id" class="custom-select">

                                            </select>
                                        </div>
                                        <br>

                                        <!-- Teachers -->
{{--                                        <div class="col">--}}
{{--                                            <label for="inputName"--}}
{{--                                                   class="control-label">{{ trans('sections.Name_Teacher') }}</label>--}}
{{--                                            <select multiple name="teacher_id[]" class="form-control"--}}
{{--                                                    id="exampleFormControlSelect2">--}}
{{--                                                @foreach($teachers as $teacher)--}}
{{--                                                    <option value="{{$teacher->id}}">{{$teacher->Name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('sections.Close') }}</button>
                                        <button type="submit"
                                                class="btn btn-danger">{{ trans('sections.submit') }}</button>
                                    </div>
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

            <script>
                $(document).ready(function () {
                    $('select[name="grade_id"]').on('change', function () {
                        var grade_id = $(this).val();
                        if (grade_id) {
                            $.ajax({
                                url: "{{ URL::to('getGradeClasses') }}/" + grade_id,
                                type: "GET",
                                dataType: "json",
                                success: function (data) {
                                    $('select[name="classroom_id"]').empty();
                                    $.each(data, function (key, value) {
                                        $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                                    });
                                },
                            });
                        } else {
                            console.log('AJAX load did not work');
                        }
                    });
                });
            </script>

@endsection

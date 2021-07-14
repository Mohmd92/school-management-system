@extends('layouts.master')

@section('css')
    @toastr_css
@endsection

@section('title')
    {{ trans('my_classes.title_page') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
@endsection

@section('PageTitle')
    {{ trans('my_classes.title_page') }}
@endsection

@section('content')
    <!-- row -->
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
                        {{ trans('my_classes.add_class') }}
                    </button>

                    <button type="button" class="button x-small" id="btn_delete_all">
                        {{ trans('my_classes.delete_checkbox') }}
                    </button>

                    <br><br>

                    <form action="{{ route('filter_classes') }}" method="POST">
                        {{ csrf_field() }}
                        <select class="selectpicker" data-style="btn-info" name="grade_id" required
                                onchange="this.form.submit()">
                            <option selected value="" disabled>{{ trans('my_classes.Search_By_Grade') }}</option>
                            @foreach ($grades as $grade)
                                <option @if (isset($selected_grade_id) and $selected_grade_id == $grade->id) selected @endif value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                        </select>
                    </form>
                    <br/>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th><input name="select_all" id="example-select-all" type="checkbox"
                                           onclick="CheckAll('box1', this)"/></th>
                                <th>#</th>
                                <th>{{ trans('my_classes.Name_class') }}</th>
                                <th>{{ trans('my_classes.Name_Grade') }}</th>
                                <th>{{ trans('my_classes.Processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if (isset($details))
                                <?php if (!empty($details)) {
                                    $rooms = $details;
                                } ?>

                            @else
                                <?php $rooms = $rooms; ?>
                            @endif

                            <?php $i = 0; ?>

                            @foreach ($rooms as $room)
                                <tr>
                                    <?php $i++; ?>
                                    <td><input type="checkbox" value="{{ $room->id }}" class="box1"></td>
                                    <td>{{ $i }}</td>
                                    <td>{{ $room->name }}</td>
                                    <td>{{ $room->grade->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $room->id }}"
                                                title="{{ trans('my_classes.Edit') }}"><i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $room->id }}"
                                                title="{{ trans('my_classes.Delete') }}"><i
                                                    class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $room->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('my_classes.edit_class') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- edit_form -->
                                                <form action="{{ route('classrooms.update', 'test') }}" method="post">
                                                    {{ method_field('patch') }}
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name"
                                                                   class="mr-sm-2">{{ trans('my_classes.Name_class') }}
                                                                :</label>
                                                            <input id="Name" type="text" name="name"
                                                                   class="form-control"
                                                                   value="{{ $room->getTranslation('name', 'ar') }}"
                                                                   required>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                   value="{{ $room->id }}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="name_en"
                                                                   class="mr-sm-2">{{ trans('my_classes.Name_class_en') }}
                                                                :</label>
                                                            <input id="name_en" type="text" class="form-control"
                                                                   value="{{ $room->getTranslation('name', 'en') }}"
                                                                   name="name_en" required>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <label
                                                                for="exampleFormControlSelect1">{{ trans('my_classes.Name_Grade') }}
                                                            :</label>
                                                        <select class="form-control form-control-lg"
                                                                id="exampleFormControlSelect1" name="grade_id">
                                                            {{-- <option value="{{ $room->grade->id }}">
                                                                {{ $room->grade->name }}
                                                            </option> --}}
                                                            @foreach ($grades as $grade)
                                                                <option @if($grade->id == $room->grade_id) selected @endif value="{{ $grade->id }}">
                                                                    {{ $grade->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('my_classes.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-success">{{ trans('my_classes.submit') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- delete_modal_Grade -->
                                <div class="modal fade" id="delete{{ $room->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('my_classes.delete_class') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('classrooms.destroy', 'test') }}"
                                                      method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('my_classes.Warning_Grade') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $room->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('my_classes.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">{{ trans('my_classes.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- add_modal_class -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('my_classes.add_class') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class=" row mb-30" action="{{ route('classrooms.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="repeater">
                                    <div data-repeater-list="classes_list">
                                        <div data-repeater-item>
                                            <div class="row">

                                                <div class="col">
                                                    <label for="Name"
                                                           class="mr-sm-2">{{ trans('my_classes.Name_class') }}
                                                        :</label>
                                                    <input id="Name" class="form-control" type="text" name="name"/>
                                                </div>

                                                <div class="col">
                                                    <label for="Name_en"
                                                           class="mr-sm-2">{{ trans('my_classes.Name_class_en') }}
                                                        :</label>
                                                    <input id="Name_en" class="form-control" type="text" name="name_en"/>
                                                </div>

                                                <div class="col">
                                                    <label for="Grade"
                                                           class="mr-sm-2">{{ trans('my_classes.Name_Grade') }}
                                                        :</label>

                                                    <div class="box">
                                                        <select id="Grade" class="fancyselect" name="grade_id">
                                                            @foreach ($grades as $grade)
                                                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label for="Processes"
                                                           class="mr-sm-2">{{ trans('my_classes.Processes') }}
                                                        :</label>
                                                    <input id="Processes" class="btn btn-danger btn-block" data-repeater-delete
                                                           type="button" value="{{ trans('my_classes.delete_row') }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button"
                                                   value="{{ trans('my_classes.add_row') }}"/>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('my_classes.Close') }}</button>
                                        <button type="submit"
                                                class="btn btn-success">{{ trans('my_classes.submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- حذف مجموعة صفوف -->
    <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('my_classes.delete_class') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="#" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        {{ trans('my_classes.Warning_Grade') }}
                        <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('my_classes.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('my_classes.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection

@section('js')
    @toastr_js
    @toastr_render

    <script type="text/javascript">
        $(function () {
            $("#btn_delete_all").click(function () {
                var selected = [];
                $("#datatable input[type=checkbox]:checked").each(function () {
                    selected.push(this.value);
                });
                if (selected.length > 0) {
                    $('#delete_all').modal('show')
                    $('input[id="delete_all_id"]').val(selected);
                }
            });
        });
    </script>

@endsection

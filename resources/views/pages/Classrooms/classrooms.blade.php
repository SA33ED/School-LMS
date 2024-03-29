@extends('layouts.master')
@section('css')

@toastr_css
@section('title')
    {{ trans('classroom_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('classroom_trans.title_page') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color"> {{ trans('classroom_trans.title_page') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('grades_trans.pageTitle') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
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
                    {{ trans('classroom_trans.add_class') }}
                </button>
                <button type="button" class="button x-small" id="btn_delete_all" >
                    {{ trans('classroom_trans.delete_class_checkbox') }}
                </button>
                <br><br>

                <form action="{{route('classroomsFilter')}}" method="POST">
                    @csrf
                    <select class="selectpicker" data-style="btn-info" name="Grade_id" required
                    onchange="this.form.submit()" >
                    <option  selected disabled>{{ trans('classroom_trans.filterbygrade') }}</option>
                    <option value="all">{{ trans('classroom_trans.showAllClasses') }}</option>
                        @foreach ($grades as $Grade)
                            <option value="{{ $Grade->id }}">{{ $Grade->name }}</option>
                        @endforeach
                    </select>
                </form><br>

                <div class="table-responsive">

                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1',this)"></th>
                                <th>#</th>
                                <th>{{ trans('classroom_trans.classname') }}</th>
                                <th>{{ trans('classroom_trans.name_grade') }}</th>
                                <th>{{ trans('classroom_trans.processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @empty($classes)
                                <?php $i = 0; ?>
                                @foreach ($classroom as $My_Class)
                                    <tr>
                                        <?php $i++; ?>
                                        <td><input type="checkbox" value="{{$My_Class->id}}" class="box1"></td>
                                        <td>{{ $i }}</td>
                                        <td>{{ $My_Class->name }}</td>
                                        <td>{{ $My_Class->grade->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $My_Class->id }}"
                                                title="{{ trans('classroom_trans.edit') }}"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $My_Class->id }}"
                                                title="{{ trans('grades_trans.delete') }}"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>




                                    <!-- edit_modal_Grade -->
                                    <div class="modal fade" id="edit{{ $My_Class->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('grades_trans.edit_grade') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- edit_form -->
                                                    <form action="{{ route('classroomsEdit') }}" method="post">

                                                        @csrf
                                                        <div class="row">

                                                            <div class="col">
                                                                <label for="Name"
                                                                    class="mr-sm-2">{{ trans('classroom_trans.name_class_ar') }}
                                                                    :</label>
                                                                <input class="form-control" type="text" name="Name" value="{{$My_Class->getTranslation('name','ar')}}" />
                                                                <input type="hidden" class="form-control" name="id" id="id" value="{{$My_Class->id}}">
                                                            </div>


                                                            <div class="col">
                                                                <label for="Name"
                                                                    class="mr-sm-2">{{ trans('classroom_trans.name_class_en') }}
                                                                    :</label>
                                                                <input class="form-control" type="text" name="Name_class_en"  value="{{$My_Class->getTranslation('name','en')}}"/>
                                                            </div>


                                                            <div class="col">
                                                                <label for="Name_en"
                                                                    class="mr-sm-2">{{ trans('grades_trans.name') }}
                                                                    :</label>

                                                                <div class="box">
                                                                    <select class="fancyselect" name="Grade_id" required>

                                                                        @foreach ($grades as $grade)
                                                                            <option value="{{ $grade->id }}" <?php if($My_Class->grade_id == $grade->id){?> SELECTED <?php } ?> >{{ $grade->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>


                                                        </div>

                                                        <br><br>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>






                                    <!-- delete_modal_Grade -->
                                    <div class="modal fade" id="delete{{ $My_Class->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('grades_trans.delete_grade') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('classroomsDestroy',$My_Class->id) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        {{ trans('grades_trans.warning_grade') }}
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $My_Class->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ trans('Grades_trans.submit') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <?php $i = 0; ?>
                                @foreach ($classes as $My_Class)
                                    <tr>
                                        <?php $i++; ?>
                                        <td><input type="checkbox" value="{{$My_Class->id}}" class="box1"></td>
                                        <td>{{ $i }}</td>
                                        <td>{{ $My_Class->name }}</td>
                                        <td>{{ $My_Class->grade->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $My_Class->id }}"
                                                title="{{ trans('classroom_trans.edit') }}"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $My_Class->id }}"
                                                title="{{ trans('grades_trans.delete') }}"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>




                                    <!-- edit_modal_Grade -->
                                    <div class="modal fade" id="edit{{ $My_Class->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('grades_trans.edit_grade') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- edit_form -->
                                                    <form action="{{ route('classroomsEdit') }}" method="post">

                                                        @csrf
                                                        <div class="row">

                                                            <div class="col">
                                                                <label for="Name"
                                                                    class="mr-sm-2">{{ trans('classroom_trans.name_class_ar') }}
                                                                    :</label>
                                                                <input class="form-control" type="text" name="Name" value="{{$My_Class->getTranslation('name','ar')}}" />
                                                                <input type="hidden" class="form-control" name="id" id="id" value="{{$My_Class->id}}">
                                                            </div>


                                                            <div class="col">
                                                                <label for="Name"
                                                                    class="mr-sm-2">{{ trans('classroom_trans.name_class_en') }}
                                                                    :</label>
                                                                <input class="form-control" type="text" name="Name_class_en"  value="{{$My_Class->getTranslation('name','en')}}"/>
                                                            </div>


                                                            <div class="col">
                                                                <label for="Name_en"
                                                                    class="mr-sm-2">{{ trans('grades_trans.name') }}
                                                                    :</label>

                                                                <div class="box">
                                                                    <select class="fancyselect" name="Grade_id" required>

                                                                        @foreach ($grades as $grade)
                                                                            <option value="{{ $grade->id }}" <?php if($My_Class->grade_id == $grade->id){?> SELECTED <?php } ?> >{{ $grade->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>


                                                        </div>

                                                        <br><br>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>






                                    <!-- delete_modal_Grade -->
                                    <div class="modal fade" id="delete{{ $My_Class->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('grades_trans.delete_grade') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('classroomsDestroy',$My_Class->id) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        {{ trans('grades_trans.warning_grade') }}
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $My_Class->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ trans('Grades_trans.submit') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endempty



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
                        {{ trans('classroom_trans.add_class') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class=" row mb-30" action="{{route('classroomsStore')}}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="List_Classes">
                                    <div data-repeater-item>

                                        <div class="row">

                                            <div class="col">
                                                <label for="Name"
                                                    class="mr-sm-2">{{ trans('classroom_trans.name_class_ar') }}
                                                    :</label>
                                                <input class="form-control" type="text" name="Name"  />
                                            </div>


                                            <div class="col">
                                                <label for="Name"
                                                    class="mr-sm-2">{{ trans('classroom_trans.name_class_en') }}
                                                    :</label>
                                                <input class="form-control" type="text" name="Name_class_en"  />
                                            </div>


                                            <div class="col">
                                                <label for="Name_en"
                                                    class="mr-sm-2">{{ trans('grades_trans.name') }}
                                                    :</label>

                                                <div class="box">
                                                    <select class="fancyselect" name="Grade_id">
                                                        @foreach ($grades as $grade)
                                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="Name_en"
                                                    class="mr-sm-2">{{ trans('classroom_trans.processes') }}
                                                    :</label>
                                                <input class="btn btn-danger btn-block" data-repeater-delete
                                                    type="button" value="{{ trans('classroom_trans.delete') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button" value="{{ trans('classroom_trans.add_row') }}"/>

                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('Grades_trans.close') }}</button>
                                    <button type="submit"
                                        class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                </div>


                            </div>
                        </div>
                    </form>
                </div>


            </div>

        </div>

    </div>




    <!-- حذف مجموعة صفوف -->
    <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('classroom_trans.delete_class') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('classroomsDeleteAll')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        {{ trans('classroom_trans.warning') }}
                        <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('classroom_trans.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('classroom_trans.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




</div>
<!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script type="text/javascript">
        $(function() {
            $("#btn_delete_all").click(function() {
                var selected = new Array();
                $("#datatable input[type=checkbox]:checked").each(function() {
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

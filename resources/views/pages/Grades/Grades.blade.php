@extends('layouts.master')
@section('css')

@section('title')
    Grades
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.Grades') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('main_trans.Grades') }}</a></li>
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
                {{ trans('grades_trans.add_grade') }}
            </button>
            <br><br>
          <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('grades_trans.name') }}</th>
                    <th>{{ trans('grades_trans.notes') }}</th>
                    <th>{{ trans('grades_trans.processes') }}</th>

                </tr>
            </thead>
            <tbody>
            {{-- START FOR EACH --}}
                <?php $i=0; ?>
                @foreach ($grades as $grade)

                    <?php $i++; ?>
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$grade->name}}</td>
                        <td>{{$grade->notes}}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{$grade->id}}"
                                title="{{trans('grades_trans.edit')}}"><i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$grade->id}}"
                                title="{{trans('grades_trans.delete')}}"><i class="fa fa-trash"></i>
                            </button>
                        </td>

                    </tr>

                        <!-- edit_modal_Grade -->
                        <div class="modal fade" id="edit{{$grade->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                            {{ trans('grades_trans.add_grade') }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- edit_form -->
                                        <form action="{{route('gradesEdit','test')}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col">
                                                    <label for="Name" class="mr-sm-2">{{ trans('grades_trans.stage_name_ar') }}
                                                        :</label>
                                                    <input id="Name" type="text" name="Name" class="form-control" value="{{$grade->getTranslation('name','ar')}}" required>
                                                </div>
                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2">{{ trans('grades_trans.stage_name_en') }}
                                                        :</label>
                                                    <input type="text" class="form-control" name="Name_en" value="{{$grade->getTranslation('name','en')}}" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="id" id="id" value="{{$grade->id}}">
                                                <label for="exampleFormControlTextarea1">{{ trans('grades_trans.notes') }}
                                                    :</label>
                                                <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1"
                                                    rows="3"></textarea>
                                            </div>
                                            <br><br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('grades_trans.close') }}</button>
                                        <button type="submit" class="btn btn-success">{{ trans('grades_trans.submit') }}</button>
                                    </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <!--delete_Modal_Grade -->
                        <div class="modal fade" id="delete{{$grade->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('grades_trans.delete_grade') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('greadsDestroy', $grade->id)}}" method="post">
                                            @method("DELETE")
                                            @csrf
                                            {{ trans('grades_trans.warning_grade') }} {{$grade->name}} {{ trans('grades_trans.how') }}
                                            <input type="hidden" id="id" name="id" class="form-control" value="{{$grade->id}}">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('grades_trans.close')}}</button>
                                                <button type="submit" class="btn btn-danger">{{trans('grades_trans.submit')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                @endforeach

            {{-- END FOR EACH --}}
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>{{ trans('grades_trans.name') }}</th>
                    <th>{{ trans('grades_trans.notes') }}</th>
                    <th>{{ trans('grades_trans.processes') }}</th>

                </tr>
            </tfoot>

         </table>
        </div>
        </div>
      </div>
    </div>

    <!-- add_modal_Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('grades_trans.add_grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{route('gradesStore')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="Name" class="mr-sm-2">{{ trans('grades_trans.stage_name_ar') }}
                                    :</label>
                                <input id="Name" type="text" name="Name" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="Name_en" class="mr-sm-2">{{ trans('grades_trans.stage_name_en') }}
                                    :</label>
                                <input type="text" class="form-control" name="Name_en" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{ trans('grades_trans.notes') }}
                                :</label>
                            <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1"
                                rows="3"></textarea>
                        </div>
                        <br><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('grades_trans.close') }}</button>
                    <button type="submit" class="btn btn-success">{{ trans('grades_trans.submit') }}</button>
                </div>
                </form>

            </div>
        </div>
    </div>



<!-- row closed -->
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection

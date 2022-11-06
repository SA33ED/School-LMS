<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrades;
use App\Models\Grade;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class GradeController extends Controller
{
    public function index()
    {
        $grades=Grade::all();
        return view('pages.Grades.Grades',compact('grades'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

            $grade = new Grade;
            $grade->name=['en' => $request->Name_en, 'ar' => $request->Name];
            $grade->notes=$request->Notes;
            $grade->save();

            toastr()->success(trans('grades_trans.success'));
            return redirect()->route('gradesList');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}

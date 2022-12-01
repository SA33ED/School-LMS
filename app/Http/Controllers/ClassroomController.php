<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;
use PhpParser\Builder\Class_;

class ClassroomController extends Controller
{

    public function index(){

        $classroom=Classroom::all();
        $grades=Grade::all();
        return view('pages.CLassrooms.classrooms',compact('classroom','grades'));
    }


    public function create(){
        //
    }

    public function store(Request $request){



        $List_CLasses = $request->List_Classes;

        try{
            foreach ($List_CLasses as $class) {
                $c = new Classroom;
                $c->name = ['en' => $class['Name_class_en'],'ar'=>$class['Name']];
                $c->grade_id = $class['Grade_id'];
                $c->save();
            }
            toastr()->success(trans('grades_trans.success'));
            return redirect(route('classroomsList'));

        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    public function show($id){
        //
    }

    public function edit($id){
        //
    }

    public function update(Request $request){
        try{

            $class= Classroom::find($request->id);
            $class->name =['en' => $request->Name_class_en, 'ar' => $request->Name];
            $class->grade_id=$request->Grade_id;
            $class->save();
            toastr()->success(trans('grades_trans.success'));
            return redirect()->route('classroomsList');


        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    public function destroy($id){
        $classroom= Classroom::find($id);
        $classroom->delete();
        toastr()->success(trans('grades_trans.success'));
        return redirect()->route('classroomsList');
    }

    public function deleteall(Request $request){
        $delete_all_id = explode(",", $request->delete_all_id);
        $classes=Classroom::whereIn( 'id', $delete_all_id);
        $classes->delete();
        toastr()->success(trans('grades_trans.success'));
        return redirect()->route('classroomsList');

    }

    public function filter(Request $request){

    }


}

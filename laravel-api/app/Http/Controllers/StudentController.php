<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        $student = new Student;
        $student->fname = $request->input('fname');
        $student->lname = $request->input('lname');
        $student->phone = $request->input('phone');
        $student->save();
        return response()->json([
            'success' => 1,
            'message' => 'Created Student Sucessfully'
        ], 200);
    }

    public function index()
    {
        $students = Student::all();
        return response()->json([
            'success' => 1,
            'data' => $students
        ], 200);
    }

    public function show($id)
    {
        $student = Student::find($id);
        return response()->json([
            'success' => 1,
            'data' => $student
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $student->fname = $request->get('fname');
        $student->lname = $request->get('lname');
        $student->phone = $request->get('phone');
        $student->save();
        return response()->json([
            'success' => 1,
            'message' => 'Update Student Successfully'
        ], 200);
    }

    public function destroy($id){
        $student = Student::find($id);
        $student->delete();
        return response()->json([
            'success'=>1,
            'message'=>'Delete Student Successfully'
        ]);
    }
}

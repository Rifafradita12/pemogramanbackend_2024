<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;


class StudentController extends Controller
{

    //Method index
    public function index()
    {
        //variable menampung fungsi untuk menampilkan data
        $students = Student::all();

        //variable array untuk menampung hasil data dan pesan
        $response = [
            'data' => $students,
            'message' => 'Berhasil menampilkan semua data students'
        ];

        return response()->json($response, 200);
    }

    //Method untuk menambahkan data
       public function store(Request $request)
    {
       $input = [
        'name' => $request->name,
        'nim' => $request->nim,
        'email' => $request->email,
        'majority' => $request->majority
       ];

       $students = Student::create($input);

       $response = [
        'message' => 'Successfully create new student',
        'data' => $students
       ];
       
       return response()->json($response, 201);
    }

    //Method untuk memperbarui data
    public function update(Request $request, $id)
    {
        $students = Student::find($id);
        if (!$students) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $students->update($request->only(['name', 'nim', 'email', 'majority']));
        
        $response = [
            'message' => 'Successfully updated student',
            'data' => $students
        ];

        return response()->json($response, 200);
    }

    //Method untuk menghapus data
    public function destroy($id)
    {
        $students = Student::find($id);
        if (!$students) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $students->delete();

        $response = [
            'message' => 'Successfully deleted student',
            'data' => $students
        ];

        return response()->json($response, 200);
    }
}
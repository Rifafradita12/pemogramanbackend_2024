<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Validator;

class StudentController extends Controller
{
    // Method index
    public function index()
    {
        $students = Student::all();

        return response()->json([
            'data' => $students,
            'message' => 'Berhasil menampilkan semua data students'
        ], 200);
    }

    // Method untuk menambahkan data
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:students,nim',
            'email' => 'required|email|unique:students,email',
            'majority' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $student = Student::create($request->all());

        return response()->json([
            'message' => 'Berhasil membuat student baru',
            'data' => $student
        ], 201);
    }

    // Method untuk memperbarui data
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'nim' => 'sometimes|string|max:20|unique:students,nim,' . $id,
            'email' => 'sometimes|email|unique:students,email,' . $id,
            'majority' => 'sometimes|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $student->update($request->all());

        return response()->json([
            'message' => 'Berhasil memperbarui student',
            'data' => $student
        ], 200);
    }

    // Method untuk menghapus data
    public function destroy($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student tidak ditemukan'], 404);
        }

        $student->delete();

        return response()->json([
            'message' => 'Berhasil menghapus student',
            'data' => $student
        ], 200);
    }
}

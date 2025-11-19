<?php

namespace App\Http\Controllers;

use App\Models\Student;


use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('index', ['students' => Student::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'address' => 'required|string|max:255',
        ]);

        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
        ]);
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        //
    }
    public function read(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'address' => 'required|string|max:255',

        ]);

        return view('read', ['students' => $input]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return redirect()->route('index')->with('error', 'Estudiante no encontrado');
        }

        return view('edit', compact('student')); 
    
    }





    //


    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, Student $student,$id)
    {
        $student = Student::find($id);

       
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'address' => 'required|string|max:255',
        ]);


        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return redirect()->route('index');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
    $estudiant = Student::findOrFail($id);
        $estudiant->delete();
        return redirect()->route('index');

}
public function principal(){
    return view('principal');
}
}

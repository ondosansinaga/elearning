<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class LecturerController extends Controller
{
    public function get() {
        $lecturers = Lecturer::all();
        return view('pages.admin.lecturer.main', [
            'lecturers' => $lecturers,
        ]);
    }

    public function add() {
        $pageType = 'add';

        return view('pages.admin.lecturer.form', compact('pageType'));
    }

    public function edit($lecturerId) {
        $lecturer = Lecturer::all()->where('lecturer_id', $lecturerId)->first();
        $pageType = "update";

        return view('pages.admin.lecturer.form', compact('lecturer', 'pageType'));
    }

    public function update($lecturerId, Request $request) {
        $payload = $request->validate([
            'lecturer_number' => ['required'],
            'fullname' => ['required'],
            'email' => ['required'],
            'gender' => ['required'],
        ]);

        Lecturer::query()->where('lecturer_id', $lecturerId)->update($payload);

        return back();
    }

    public function store(Request $request) {
        $payload = $request->validate([
            'lecturer_number' => ['required'],
            'fullname' => ['required'],
            'email' => ['required'],
            'gender' => ['required'],
            'password' => ['required'],
        ]);
        $payload['lecturer_id'] = Uuid::uuid4();
        
        $lecturer = new Lecturer();
        $lecturer->lecturer_id = Uuid::uuid4();
        $lecturer->lecturer_number = $payload['lecturer_number'];
        $lecturer->fullname = $payload['fullname'];
        $lecturer->email = $payload['email'];
        $lecturer->password = Hash::make($payload['password']);
        $lecturer->gender = $payload['gender'];
        $lecturer->save();

        return redirect('/admin/lecturers');
    }

    public function delete($lecturerId, Request $request) {
        Lecturer::destroy($lecturerId);
        return back();
    }
}

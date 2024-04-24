<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachStudentRequest;
use App\Http\Requests\UpdateAttachStudentRequest;
use App\Models\Student;

class StudentController extends Controller
{
    public function attachStudent(AttachStudentRequest $request)
    {
        Student::create([
            'user_id' => $request->user_id,
            'group_id' => $request->group_id,
        ]);

        return response()->json(["message" => "O'quvchi muvaffaqqiyatli biriktrildi!"], 200);
    }

    public function updateAttachStudent(UpdateAttachStudentRequest $request, $student_id)
    {
        $student = Student::find($student_id);
        if (!$student) {
            return response()->json(["message" => "Ma'lumot topilmadi!"], 401);
        }
        $student->update([
            'group_id' => $request->group_id,
        ]);
        return response()->json(["message" => "O'quvchi biriktirish muvaffaqqiyatli o'zgartirildi!"], 200);
    }

    public function getStudent(){

        $groupName = request('group_name');
        return Student::select('users.username', 'groups.group_name')
        ->join('users', 'users.id', '=', 'students.user_id')
        ->join('groups', 'groups.id', '=', 'students.group_id')
        ->paginate(15);
    }
}

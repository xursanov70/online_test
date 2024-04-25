<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachStudentRequest;
use App\Http\Requests\UpdateAttachStudentRequest;
use App\Models\Group;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        if ($this->can('get', 'student') == 'denied'){
            return response()->json(["message" => "Amaliyotga huquq yo'q"], 403);
        }

        return Student::select('users.username', 'groups.group_name', 'subject_name')
        ->join('users', 'users.id', '=', 'students.user_id')
        ->join('groups', 'groups.id', '=', 'students.group_id')
        ->join('subject_types', 'subject_types.id', '=', 'groups.subject_type_id')
        ->where('groups.organization_id', Auth::user()->organization_id)
        ->orderBy('users.username', 'asc')
        ->paginate(15);
    }
}

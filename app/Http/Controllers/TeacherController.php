<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachTeacherRequest;
use App\Http\Requests\UpdateAttachTeacherRequest;
use App\Models\Teacher;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function attachTeacher(AttachTeacherRequest $request)
    {
        Teacher::create([
            'user_id' => $request->user_id,
            'degree' => $request->degree,
            'subject_type_id' => $request->subject_type_id,
        ]);

        return response()->json(["message" => "O'qituvchi muvaffaqqiyatli biriktrildi!"], 200);
    }

    public function updateAttachTeacher(UpdateAttachTeacherRequest $request, $teacher_id)
    {
        $teacher = Teacher::find($teacher_id);
        if (!$teacher) {
            return response()->json(["message" => "Ma'lumot topilmadi!"], 401);
        }
        $teacher->update([
            'degree' => $request->degree,
            'subject_type_id' => $request->subject_type_id,
        ]);
        return response()->json(["message" => "O'qituvchi biriktirish muvaffaqqiyatli o'zgartirildi!"], 200);
    }

    public function getTeacher()
    {
        if ($this->can('get', 'teacher') == 'denied'){
            return response()->json(["message" => "Amaliyotga huquq yo'q"], 403);
        }

        return  Teacher::select('users.username', 'teachers.degree', 'subject_types.subject_name')
            ->join('users', 'users.id', '=', 'teachers.user_id')
            ->join('subject_types', 'subject_types.id', '=', 'teachers.subject_type_id')
            ->where('users.organization_id', Auth::user()->organization_id)
            ->orderByRaw("FIELD(degree, 'high', 'medium', 'low')")
            ->paginate(15);
    }
}

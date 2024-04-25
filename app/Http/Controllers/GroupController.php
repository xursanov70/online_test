<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function createGroup(GroupRequest $request){
        
        $group = Group::where('organization_id', $request->organization_id)
        ->where('subject_type_id', $request->subject_type_id)->first();
        if ($group){
            return response()->json(["message" => "Kiritilgan filialga oldin kiritlgan guruh biriktirmoqdasiz!"], 403);
        }
        Group::create([
            'group_name' => $request->group_name,
            'subject_type_id' => $request->subject_type_id,
            'organization_id' => $request->organization_id,
        ]);
        return response()->json(["message" => "Guruh muvaffaqqiyatli yaratildi!"], 200);
    }

    public function updateGroup(UpdateGroupRequest $request, $group_id){
        $group = Group::find($group_id);
        if (!$group){
            return response()->json(["message" => "Ma'lumot topilmadi!"], 404);
        }
        $group->update([
            'group_name' => $request->group_name,
            'subject_type_id' => $request->subject_type_id
        ]);
        return response()->json(["message" => "Guruh muvaffaqqiyatli o'zgartirildi!"], 200);
    }

    public function getGroup(){
        return Group::select('groups.group_name', 'organizations.organization_name', 'subject_types.subject_name')
        ->join('organizations', 'organizations.id', '=', 'groups.organization_id')
        ->join('subject_types', 'subject_types.id', '=', 'groups.subject_type_id')
        ->paginate();
    }
}

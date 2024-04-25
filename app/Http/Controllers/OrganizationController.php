<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddOrganizationRequest;
use App\Http\Requests\AttachOrganizationRequest;
use App\Http\Requests\UpdateRentRequest;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    public function addOrganization(AddOrganizationRequest $request){

        if ($this->can('add', 'organization') == 'denied'){
            return response()->json(["message" => "Amaliyotga huquq yo'q"], 403);
        }
        
        Organization::create([
            'organization_name' => $request->organization_name,
            'owner_name' => Auth::user()->username,
            'rent' => $request->rent,
            'rent_expire_date' => $request->rent_expire_date,
        ]);
        return response()->json(["message" => "Filial muvaffaqqiyatli bitiktirildi"], 201);
    }

    public function updateRent(UpdateRentRequest $request, int $organization_id){

        $organization = Organization::find($organization_id);
        if (!$organization){
            return response()->json(["message" => "Ma'lumot mavjud emas!"], 404);
        }
        $organization->update([
            'rent' => $request->rent,
            'rent_expire_date' => $request->rent_expire_date,
        ]);
        return response()->json(["message" => "Filial ijarasi muvaffaqqiyatli o'zgartirildi"], 200);
    }


    public function attachOrganization(AttachOrganizationRequest $request, int $organization_id){

        $organization = Organization::find($organization_id);
        if (!$organization){
            return response()->json(["message" => "Ma'lumot mavjud emas!"], 404);
        }

        $user = User::where('id', $request->user_id)->first();
        $user->update([
            'organization_id' => $organization_id
        ]);

        return response()->json(["message" => "Filial biriktirish muvaffaqqiyatli bajarildi"], 200);
    }

    public function getOrganization(){
        return Organization::orderBy('organizations.id', 'asc')
        ->paginate(15);
    }


}

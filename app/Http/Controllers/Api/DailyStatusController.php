<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Models\DailyStatus;
use App\Http\Controllers\Controller;
use JWTAuth;
class DailyStatusController extends Controller
{
    use ResponseTrait;
    
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['login']]);
    }


    public function save(Request $request)
    {
        $token = $request->header('Authorization');
        $user = JWTAuth::parseToken()->authenticate();
        if($user->roles()->get()[0]->title == "Super Admin" || $user->roles()->get()[0]->title == "Admin")
        {
            DailyStatus::create($request->input());
        }
        return json_encode("success");
        
    }
    // public function getList(Request $request)
    // {
    //     $personel = Personel::get();
    //     return json_encode($personel);
    // }

}
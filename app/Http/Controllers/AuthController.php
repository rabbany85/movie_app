<?php
namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\Movie as MovieResource;
use App\Http\Resources\MovieCollection;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;
use App\Models\Movie;
use Hash;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!$request->email)
        {
            return response(['message' => 'Missing Email!'], 400);
        }
        if (!$request->password)
        {
            return response(['message' => 'Missing Password!'], 400);
        }
        $user = User::where('email', $request->email)
            ->where('is_active', 1)
            ->first();
        if (!$user)
        {
            return response(['message' => 'Invalid Email!'], 400);
        }
        if (!Hash::check($request->password, $user->password))
        {
            return response(['message' => 'Invalid Password!'], 400);
        }

        $dashboard = $this->getRoleDashboardInfo($user);
        return response(['dashboard' => $dashboard, 'accessToken' => $user->createToken('authToken')->accessToken], 200);
    } //end of login method
    private function getRoleDashboardInfo($user)
    {
        $role = $user->role;
        $dashboard_data = array();

        switch ($role)
        {
            case "Admin":
                $dashboard_data['userList'] = $this->getUserList();
                $dashboard_data['movies'] = $this->getAllMovieList();
                $dashboard_data['profile'] = $this->getProfileInfo($user);
            break;

            default:
                $dashboard_data['movies'] = $this->getUserMovieList($user);
                $dashboard_data['profile'] = $this->getProfileInfo($user);
            break;
        } //end of switch
        return $dashboard_data;
    } //end of method
    

    private function getUserList()
    {
        return new UserCollection(User::get());
    }

    private function getAllMovieList()
    {
        return new MovieCollection(Movie::get());
    }

    private function getUserMovieList($user)
    {
        return new MovieCollection(Movie::where('user_id', $user->id)->get());
    }


    private function getProfileInfo($user)
    {
        return new UserResource($user);
    }
}


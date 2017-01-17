<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    //
    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $access_token = null;
        try {
            $access_token = AccesToken:where('user_id',1)->token;
        } catch (\Exception) {
            //Execute code to obtain token
            // Redirect to /redirect
        }

        $data = [
            "access_token" => $access_token
        ];
        return view('tasks',$data);
    }

}

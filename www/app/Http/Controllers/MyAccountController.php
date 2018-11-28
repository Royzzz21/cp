<?php
/**
 * Created by PhpStorm.
 * User: android
 * Date: 2018-08-28
 * Time: 오후 12:02
 */

namespace App\Http\Controllers;


class MyAccountController extends Controller{
    public function __construct(){

    }
    public function index(){

        return view('_mypage/myinfo');
    }
    public function myaccount_update(Request $request){

    }
}
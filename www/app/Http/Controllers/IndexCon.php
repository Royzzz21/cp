<?php
namespace App\Http\Controllers;

use Auth;
use DB;

use App\User;
use App\DataTables\Buttons\UsersQueryBuilderDataTable;
//use Input;
use Illuminate\Support\Facades\Input;
//use Yajra\DataTables\Utilities\Request;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;



class IndexCon {

	// 사용자 정보
	private $uid       = '';
	private $email     = '';


    // auth
    private function auth()
    {

		// get auth data
		glo()->get_auth_data();

		// check if not admin and on admin page, go login
//		glo()->check_admin_auth();

    }

	public function __construct(){

//        // 페이지 정보를 설정합니다.
//        glo()->page_obj->set_pageId('task');
//        glo()->page_obj->set_pageName('task management');
//        glo()->page_obj->set_pageDesc('');
	}

	// index
	public function index(Request $request){
        $this->auth();
		return view('index');

//        return $this->run($bbs_cmd,$request);
	}

}
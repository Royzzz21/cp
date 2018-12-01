<?php
namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\DataTables\Buttons\UsersQueryBuilderDataTable;
//use Input;
use Illuminate\Support\Facades\Input;
//use Yajra\DataTables\Utilities\Request;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class APICon extends Controller{

	// 사용자 정보
	private $uid       = '';
	private $email     = '';

  // 인증체크
  private function auth()
  {


		//glo()->get_auth_data();

		// check if not admin and on admin page, go login
		// glo()->check_admin_auth();

  }

  private $cat;

	public function __construct()	{
        // $this->set_bbsId('qna');
        // $this->set_write_title('Post QNA');
        // $this->set_guest_write(false);
        // $this->set_guest_allowlist(true);
				// $this->set_guest_allowview(true);

        // 페이지 정보를 설정합니다.
        // glo()->page_obj->set_pageId('qna');
        // glo()->page_obj->set_pageName('Question &amp; Answer');
        // glo()->page_obj->set_pageDesc('');
				$this->middleware('auth:api')->only('profile');
	}

	// 게시판 호출 처리
	public function api_run($cmd,Request $request){

		if($cmd=='login'){
			return $this->login($request);
		}
		if($cmd=='profile'){
			return $this->profile($request);
		}
	}


	// 처리
	public function login(Request $request)
  {


		// 1. prepare input values
		$id = $request->input('id', '0');
		$pass = $request->input('pass', '0');

		// try login
		$login_result=glo()->api_login($id,$pass);

// if true login successful
// return ok code
		if($login_result){
			// echo 1;
			//echo 'login ok';
			$arr=[
				'result_code'=>100,
				'new_token'=>glo()->token

			];
			echo json_encode($arr);
			// exit;
		}
		// return error code
		else {

			// echo 'login failed';
			$arr=[
				'result_code'=>503,
				'new_token'=>''

			];
			echo json_encode($arr);

		}

		exit;

		// DB::update("update board_{$bbs_id} set sts=? where idx=?",[$new_status_code, $idx]);
		// return $this->make_return('list');


//        $this->notice_run('list',$request);
      // return redirect('/qna/list');
  }
	//
	// // 처리
	// public function event_run($bbs_cmd,Request $request){
	//
	// 		$this->auth();
  //     return $this->run($bbs_cmd,$request);
	// }
	//
	// // admin > 처리
	// public function event_admin($bbs_cmd,Request $request){
	//     glo()->set_adminpage(true);
	//
	//     $this->auth();
	//     return $this->run($bbs_cmd,$request);
	// }
}

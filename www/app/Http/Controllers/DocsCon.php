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



class DocsCon extends BbsCon {

	// 사용자 정보
	private $uid       = '';
	private $email     = '';


    // 인증체크
    private function auth()
    {

        // 로그인이 되어있으면.
        glo()->get_auth_data();

        // check if not admin and on admin page, go login
		glo()->check_admin_auth();

    }

    private $cat;

	public function __construct()	{
        $this->set_bbsId('qna');
        $this->set_write_title('Post QNA');
        $this->set_guest_write(false);
        $this->set_guest_allowlist(true);
		$this->set_guest_allowview(true);

        // 페이지 정보를 설정합니다.
        glo()->page_obj->set_pageId('qna');
        glo()->page_obj->set_pageName('Question &amp; Answer');
        glo()->page_obj->set_pageDesc('');
	}

	// 처리
	public function list(Request $request)
    {
        return redirect('/docs/list');
    }

	// 처리
	public function event_run($bbs_cmd,Request $request){


		$this->auth();
        return $this->run($bbs_cmd,$request);
	}

    // admin > 처리
    public function event_admin($bbs_cmd,Request $request){
        glo()->set_adminpage(true);

        $this->auth();
        return $this->run($bbs_cmd,$request);
    }
}
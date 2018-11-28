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



class NewsCon extends BbsCon {

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
        $this->set_bbsId('news');
        $this->set_theme('news');
        $this->set_write_title('Post News');
        $this->set_guest_write(false);
        $this->set_guest_allowlist(true);
        $this->set_guest_allowview(true);

        // 페이지 정보를 설정합니다.
        glo()->page_obj->set_pageId('news');
        glo()->page_obj->set_pageName('news');
        glo()->page_obj->set_pageDesc('');
	}

	// 처리
	public function list(Request $request)
    {
//        $this->notice_run('list',$request);
        return redirect('/news/list');
    }

	// 처리
	public function news_run($bbs_cmd,Request $request){
        $this->auth();
        return $this->run($bbs_cmd,$request);
	}

    // admin > 처리
    public function news_admin($bbs_cmd,Request $request){
        glo()->set_adminpage(true);

        $this->auth();
        return $this->run($bbs_cmd,$request);
    }

}
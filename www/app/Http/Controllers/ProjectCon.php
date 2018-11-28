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



class ProjectCon extends BbsCon {

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

	public function __construct(){
        $this->set_bbsId('project');

        $this->set_theme('project');
        $this->set_write_title('Create New Project');
        $this->set_guest_write(true);


//        $this->set_guest_allowlist(false);
        $this->set_guest_allowlist(true);


        // set custom function
        $this->set_prepare_input_func('prepare_new_project');
        $this->set_save_input_func('save_new_project');
        $this->set_update_input_func('update_new_project');

        // 페이지 정보를 설정합니다.
        glo()->page_obj->set_pageId('project');
        glo()->page_obj->set_pageName('project');
        glo()->page_obj->set_pageDesc('');
	}

	// 처리
	public function list(Request $request){
		return redirect('/project/list');
	}

	// prepare function
	public function prepare_new_project(Request $request){
		$this->prepared_values['project_id'] = $request->input('project_id');
		$this->prepared_values['project_name'] = $request->input('project_name');

		return true;

	}

	// save function
	public function save_new_project(){

		// user nickname
		$user_nick=glo()->user_name;

		// project id
		$project_id=$this->prepared_values['project_id'];

		// task name
		$project_name=$this->prepared_values['project_name'];


		/////// insert query
		$q="insert into board_{$this->bbs_id} set
				bbs_id		=		?,
								
				project_id=?,
				project_name=?,
				
				bbs_writer	=		?,
				
				cat			=		?,
				cat0		=		?,
				link1		=		?,
				bbs_regtt=?
				";

		$bbs_file='';
		$selected_cat='';
		$cat0='';
		$link1='';
		$ts=time();

		$insert_cnt=DB::insert($q,[
			$this->bbs_id,

			$project_id,
			$project_name,

			$user_nick,$cat0,$cat0,$link1,$ts]);

		return $insert_cnt;
	}

	// 업데이트한다.
	public function update_new_project($idx){

		// user nickname
		$user_nick=glo()->user_name;

		// project id
		$project_id=$this->prepared_values['project_id'];

		// project name
		$project_name=$this->prepared_values['project_name'];


		/////// 저장하는 부분
		$q="update board_{$this->bbs_id} set
				bbs_id		=		?,
								
				project_id=?,
				project_name=?,
				
				bbs_writer	=		?,
				
				cat			=		?,
				cat0		=		?,
				link1		=		?,
				bbs_regtt=?
				where idx=?
				";

		$bbs_file='';
		$selected_cat='';
		$cat0='';
		$link1='';
		$ts=time();

		$affected_cnt=DB::update($q,[

			$this->bbs_id,

			$project_id,
			$project_name,

			$user_nick,$cat0,$cat0,$link1,$ts,

			$idx]);


		return $affected_cnt;
	}


	// route link
	public function project_run($bbs_cmd,Request $request){

        $this->auth();

        return $this->run($bbs_cmd,$request);
	}
    // admin > 처리
    public function project_admin($bbs_cmd,Request $request){
        glo()->set_adminpage(true);

        $this->auth();
        return $this->run($bbs_cmd,$request);
    }

}
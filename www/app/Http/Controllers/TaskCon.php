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



class TaskCon extends BbsCon {

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
        $this->set_bbsId('task');
        $this->set_theme('task');
        $this->set_write_title('가맹점 등록 신청');
        $this->set_guest_write(true);


//        $this->set_guest_allowlist(false);
        $this->set_guest_allowlist(true);


        // set custom function
        $this->set_prepare_input_func('prepare_new_task');
        $this->set_save_input_func('save_new_task');
        $this->set_update_input_func('update_new_task');

        // 페이지 정보를 설정합니다.
        glo()->page_obj->set_pageId('task');
        glo()->page_obj->set_pageName('task management');
        glo()->page_obj->set_pageDesc('');
	}

	// 처리
	public function list(Request $request){
		return redirect('/task/list');
	}

	// prepare function
	public function prepare_new_task(Request $request){
		$this->prepared_values['project_id'] = $request->input('project_id');
		$this->prepared_values['parent_task_idx'] = $request->input('parent_task_idx');


		$this->prepared_values['task_name'] = $request->input('task_name');
		$this->prepared_values['task_type'] = $request->input('task_type');
		$this->prepared_values['task_priority'] = $request->input('task_priority');
		$this->prepared_values['starting_date'] = strtotime($request->input('starting_date'));
		$this->prepared_values['ending_date'] = strtotime($request->input('ending_date'));
		$this->prepared_values['task_progress'] = $request->input('task_progress');
		$this->prepared_values['assign_to'] = $request->input('assign_to');
		$this->prepared_values['task_note'] = $request->input('task_note');



//		print_r($this->prepared_values);
//exit;

		return true;

	}

	// save function
	public function save_new_task(){

		// user nickname
		$user_nick=glo()->user_name;

		// project id
		$project_id=$this->prepared_values['project_id'];
		// parent_task_idx
		$parent_task_idx=$this->prepared_values['parent_task_idx'];

		// task name
		$task_name=$this->prepared_values['task_name'];

		// task progress
		$task_progress=$this->prepared_values['task_progress'];

		// task type
		$task_type=$this->prepared_values['task_type'];

		// task priority
		$task_priority=$this->prepared_values['task_priority'];

		// starting_date
		$starting_date=$this->prepared_values['starting_date'];

		// ending_date
		$ending_date=$this->prepared_values['ending_date'];

		// assign to
		$assign_to=$this->prepared_values['assign_to'];

        // task note
        $task_note=$this->prepared_values['task_note'];


		/////// insert query
		$q="insert into board_{$this->bbs_id} set
				bbs_id		=		?,
								
				project_id=?,
				parent_task_idx=?,
				task_name=?,
				task_progress=?,
				task_type=?,
				task_priority=?,
				
				starting_date=?,
				ending_date=?,
				
				assign_to=?,
				task_note=?,
								
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
			$parent_task_idx,
			$task_name,
			$task_progress,
			$task_type,
			$task_priority,

			$starting_date,
			$ending_date,

			$assign_to,
			$task_note,

			$user_nick,$cat0,$cat0,$link1,$ts]);

		return $insert_cnt;
	}

	// 업데이트한다.
	public function update_new_task($idx){

		// user nickname
		$user_nick=glo()->user_name;

		// project id
		$project_id=$this->prepared_values['project_id'];

		// parent_task_idx
		$parent_task_idx=$this->prepared_values['parent_task_idx'];

		// task name
		$task_name=$this->prepared_values['task_name'];

		// task progress
		$task_progress=$this->prepared_values['task_progress'];

		// task type
		$task_type=$this->prepared_values['task_type'];

		// task priority
		$task_priority=$this->prepared_values['task_priority'];

		// starting_date
		$starting_date=$this->prepared_values['starting_date'];

		// ending_date
		$ending_date=$this->prepared_values['ending_date'];

		// assign to
		$assign_to=$this->prepared_values['assign_to'];

        // Task note
        $task_note=$this->prepared_values['task_note'];


		/////// 저장하는 부분
		$q="update board_{$this->bbs_id} set
				bbs_id		=		?,
								
				project_id=?,
				parent_task_idx=?,
				task_name=?,
				
				task_progress=?,
				task_type=?,
				task_priority=?,
				
				starting_date=?,
				ending_date=?,
				assign_to=?,				
				task_note=?,				
			
				
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

//		print_r([
//
//			$this->bbs_id,
//
//			$project_id,
//			$task_name,
//			$task_period,
//			$task_progress,
//			$task_type,
//			$task_priority,
//			$starting_date,
//			$ending_date,
//			$assign_to,
//			$task_note,
//
//			$user_nick,$cat0,$cat0,$link1,$ts,
//
//			$idx]);
//		exit;

		$affected_cnt=DB::update($q,[

			$this->bbs_id,

			$project_id,
			$parent_task_idx,
			$task_name,
			$task_progress,
			$task_type,
			$task_priority,
			$starting_date,
			$ending_date,
			$assign_to,
			$task_note,

			$user_nick,$cat0,$cat0,$link1,$ts,

			$idx]);


		return $affected_cnt;
	}

	public function task_getTaskList_json(Request $request){
		$project_id=$request->input('project_id','');
		$arr=DB::select("select idx,task_name from board_{$this->bbs_id} where project_id=? order by idx desc",[$project_id]);
		echo json_encode($arr);
		exit;

	}

	public function task_set_deleted(Request $request){

		$task_idx=$request->input('idx',0);
		//			$new_status=$request->input('new_status','READY');
		$new_status='DELETED';

		DB::update("update board_{$this->bbs_id} set sts=? where idx=?",[$new_status,$task_idx]);

		return $this->make_return('list');
//		header("Location: list");
//		exit;
	}


	// 처리
	public function task_run($bbs_cmd,Request $request){


        $this->auth();

		// getTaskList.json
		$this->set_custom_cmd('getTaskList.json','task_getTaskList_json');


		// delete
		$this->set_custom_cmd('set_deleted','task_set_deleted');


        return $this->run($bbs_cmd,$request);
	}

    // admin > 처리
    public function task_admin($bbs_cmd,Request $request){
        glo()->set_adminpage(true);

        $this->auth();
        return $this->run($bbs_cmd,$request);
    }

}
<?php
namespace App\Http\Controllers;

use Auth;
use DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\User;
use App\DataTables\Buttons\UsersQueryBuilderDataTable;
use PhpParser\Node\Expr\Cast\String_;
use Yajra\Datatables\Datatables;
//use Input;

use Illuminate\Http\Request;
//use Yajra\DataTables\Utilities\Request;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Input;



class BbsCon extends Controller{
	/////////////////////////////////////////
	// 데이타
	/////////////////////////////////////////
									// view 페이지
	private $page      = '';
									// 사용자 정보
	private $uid       = '';
	private $email     = '';
									// 지갑정보
	private $my_wallet = Array();	// wallet에 넣을 sql용
	private $wallet    = Array();	// view에서 사용할데이터

	private $subject  = Array();
    public $write_title=''; // 글쓰기 페이지의 타이틀
    public $guest_posting=false; // 손님이 글쓰기 가능하게
    public $guest_listaccess=false; // 손님이 리스트 볼수있게
    public $guest_viewaccess=false; // 손님 뷰페이지 접근권한
	public $file_limit=10; // 한번에 업로드 가능한 파일의 수 제한.

	public $bbs_id;

	// 테마 id
    public $theme_id='';

    // error
	public $error_msg='';

	// prepare_input_values
	public $user_prepare_input_values=false;

	// save_input_values
	public $user_save_input_values=false;

	// update_input_values
	public $user_update_input_values=false;



	public function __construct()	{
        $this->set_write_title('글쓰기');
	}

    public function set_bbsId($bbs_id){
	    $this->bbs_id=$bbs_id;
    }

    public function set_prepare_input_func($user_func){
	    $this->user_prepare_input_values=$user_func;
    }

    public function set_save_input_func($user_func){
	    $this->user_save_input_values=$user_func;
    }

    public function set_update_input_func($user_func){
	    $this->user_update_input_values=$user_func;
    }

    public function set_file_limit($file_limit){
	    $this->file_limit=$file_limit;
    }

    public function set_theme($theme_id){
	    $this->theme_id=$theme_id;
    }

    // 글쓰기 페이지의 타이틀 지정
    public function set_write_title($title){
	    $this->write_title=$title;
    }

    // 글쓰기 페이지 > 손님 글쓰기 허용
    public function set_guest_write($allow_guest_posting){
	    $this->guest_posting=$allow_guest_posting;
    }

    // 글쓰기 페이지 > 손님 리스트접근 허용
    public function set_guest_allowlist($allow_or_not){
	    $this->guest_listaccess=$allow_or_not;
    }

    // 글쓰기 페이지 > 손님 뷰페이지 접근 허용
    public function set_guest_allowview($allow_or_not){
	    $this->guest_viewaccess=$allow_or_not;
    }

    // when error exists
    public function error_page($error_msg){
//        $error_msg='로그인이 필요 합니다.';
        return view('error/error', compact('error_msg'));
    }



	public $custom_cmds=[];

	// set custom cmd & function name
	public function set_custom_cmd($cmd_name,$func_name){
		$this->custom_cmds[$cmd_name]=$func_name;
	}


	public $prepared_values=[];

	// processing 123
	// 1. prepare_input_values 2. save_input_values 3. update_input_values
	function prepare_input_values($request){
		// 제목
		$bbs_subject = $request->input('bbs_subject');

		// 내용
		$bbs_content = $request->input('wr_content');

		if(strlen($bbs_subject) == 0 || strlen($bbs_content) == 0){
			$this->error_msg = '필수 항목이 빠졌습니다';
			return false;
		}

		$this->prepared_values['bbs_subject']=$bbs_subject;
		$this->prepared_values['bbs_content']=$bbs_content;
		$this->prepared_values['user_nick']=glo()->user_name;

		return true;
	}

	// 저장한다.
	public function save_input_values(){

		$user_nick=$this->prepared_values['user_nick'];

		$bbs_subject=$this->prepared_values['bbs_subject'];
		$bbs_content=$this->prepared_values['bbs_content'];

//		$bbs_file=$this->prepared_values['bbs_file'];
//		$selected_cat=$this->prepared_values['selected_cat'];

		/////// 저장하는 부분
		$q="insert into board_{$this->bbs_id} set
				bbs_id		=		?,
				bbs_subject	=		?,
				bbs_writer	=		?,
				bbs_content	=		?,
				bbs_file	=		?,
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

		$insert_cnt=DB::insert($q,[$this->bbs_id,$bbs_subject,$user_nick,$bbs_content,$bbs_file,$selected_cat,$cat0,$link1,$ts]);

		return $insert_cnt;
	}


	// 업데이트한다.
	public function update_input_values($idx){


		$bbs_subject=$this->prepared_values['bbs_subject'];
		$bbs_content=$this->prepared_values['bbs_content'];

		$user_nick=$this->prepared_values['user_nick'];

//		$bbs_file=$this->prepared_values['bbs_file'];
//		$selected_cat=$this->prepared_values['selected_cat'];

		/////// 저장하는 부분
		$q="update board_{$this->bbs_id} set
				bbs_id		=		?,
				bbs_subject	=		?,
				bbs_writer	=		?,
				bbs_content	=		?,
				bbs_file	=		?,
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

		$affected_cnt=DB::update($q,[$this->bbs_id,$bbs_subject,$user_nick,$bbs_content,$bbs_file,$selected_cat,$cat0,$link1,$ts,$idx]);

		return $affected_cnt;
	}

	public $share_arr=[];


	// add array to member variable 'share_arr' , will be used by view file
	public function add_share($arr){
		foreach($arr as $k=>$v){
			// overwrite!
			$this->share_arr[$k]=$v;
		}
	}

	// 게시판 호출 처리
	public function run($bbs_cmd,Request $request){
        //$this->auth();


		$bbs_id=$this->bbs_id;

		$user_idx=0;
		$user_nick='';

		// 로그인 되어있으면
		if(Auth::check()) {
			// 사용자 정보
			$user_idx = Auth::user()->id;
			$user_nick = Auth::user()->email;
		}

		// id=free, qna, hello
		// cmd=list, write, view, del, mod
		//
		$_CFG=array();
		$_CFG['default_date_format']='Y-m-d';

		// 요청 주소
		$path_arr=[];
		$path_arr['req_path3'] = '/'.$request->path(); // 명령까지
		$path_arr['req_path2'] = dirname($path_arr['req_path3']); // id까지
		$path_arr['req_path1'] = dirname($path_arr['req_path2']); // 메뉴


		//$page = $request->input('page',1);
		$page = $request->input('page',1);


		$idx = $request->input('idx', '0');


		$is_admin=glo()->is_admin;

        $guest_posting=$this->guest_posting;

		//$uri = $request->url();
//echo $uri;


//		print_r($_SERVER);
//		exit;

		//print_r($a);
		//exit;

		//return view('_info.info',['infos'=>$infos]);
		// 나중에 리스트에 닉네임이 나왔으면 좋겠다...

		//$list_info2 =$this->name = Auth::user()->name;

		$list_priv=false;
		$view_priv=false;
		$write_priv=false;

		// if admin
		if(glo()->is_admin){
			$list_priv=true;
			$view_priv=true;
			$write_priv=true;

		}

		// if guest can post
		if($guest_posting){
			$write_priv=true;
		}

		// if guest can see list
		if($this->guest_listaccess){
			$list_priv=true;
		}

		// if guest can view posting
		if($this->guest_viewaccess){
			$view_priv=true;
		}

		// for <list>
		$startpadding = 0;
		$list_row_limit = 20;

		$this->share_arr=[
			// BBS
			'bbs_id'=>$bbs_id,

			// PRIVILEGES
			'is_admin'=>$is_admin,
			'list_priv'=>$list_priv,
			'view_priv'=>$view_priv,
			'write_priv'=>$write_priv,
			'guest_posting'=>$guest_posting,

			// PAGE & LINK
			'page'=>$page,
			'path_arr'=>$path_arr,
			'req_path1'=>$path_arr['req_path1'],
			'req_path2'=>$path_arr['req_path2'],
			'req_path3'=>$path_arr['req_path3'],
			'list_row_limit'=>$list_row_limit,

			// SETTING
			'_CFG'=>$_CFG,

			//			'list_info'=>$list_info,
		];


		// update status code
		// TODO: 소유자 (owner_priv) 체크
		if($bbs_cmd=='update_status'){
			$idx = $request->input('idx', '0');
			$new_status_code = $request->input('new_status', 'READY');
			DB::update("update board_{$bbs_id} set sts=? where idx=?",[$new_status_code, $idx]);
			return $this->make_return('list');
		}

		// list
		else if($bbs_cmd=='list') {

			if(!$list_priv){
				return $this->error_page('you dont have access permission');
            }

			$list_info = DB::select("select * from board_{$bbs_id} order by idx DESC limit $startpadding,$list_row_limit");
			$this->share_arr['list_info']=$list_info;

			// set view file name
			$view_file='bbs/list';

			if($this->theme_id){
                $view_file.='/'.$this->theme_id;
            }
            else {
                $view_file.='/default';
            }

			return view($view_file, $this->share_arr);

		}

		// view
		else if($bbs_cmd=='view') {
			if(!$view_priv){
				return $this->error_page('you dont have access permission');
			}

            $list_info = DB::select("select * from board_{$bbs_id} where idx=?",[$idx]);
            $row=$list_info[0];

            // set view file name
            $view_file='bbs/view';

            if($this->theme_id){
                $view_file.='/'.$this->theme_id;
            }
            else {
                $view_file.='/default';
            }

            $this->add_share(['row'=>$row]);

            return view($view_file, $this->share_arr);
		}

		// write or modify
		else if ($bbs_cmd == 'write' || $bbs_cmd == 'modify') {

            if(!$write_priv){
                return $this->error_page('글쓰기 권한이 없습니다.');
            }

            $mode='write';
			$rows=false;

            // not editing
            if (intval($idx) == 0) {
                $edit_mode = 0;

            }
            // editing
            else {
                $edit_mode = 1;
				$mode='update';

				$orig_data = DB::select("select * from board_{$bbs_id} where idx=? limit 1", [$idx]);
                $rows=$orig_data[0];
            }

            $write_title=$this->write_title;

            // prepare sharing data
			$this->add_share([
				'rows'=>$rows,
				'write_title'=>$write_title,
				'idx'=>$idx,
				'edit_mode'=>$edit_mode,
				'mode'=>$mode,
			]);

            // set view file name
            $view_file='bbs/write';

            if($this->theme_id){
                $view_file.='/'.$this->theme_id;
            }
            else {
                $view_file.='/default';
            }

            return view($view_file,$this->share_arr);

        }

        // 저장 하기
		// process request
		else if($bbs_cmd=='write_ok') {

            if(glo()->is_admin){

            }
            else if($guest_posting==false){
                return $this->error_page('글쓰기 권한이 없습니다.');
            }

            // 입력값 체크
			// preparing input values
			if($this->user_prepare_input_values){
            	$func=$this->user_prepare_input_values;
				if(!$this->$func($request)){
					return view('error/error', ['error_msg' => $this->error_msg]);
				}
			}
			// default(subject,content,nick only)
			else{
				if(!$this->prepare_input_values($request)){
					return view('error/error', ['error_msg' => $this->error_msg]);
				}
			}

			// 파일 처리
			// process file
			$upload_files=[];
			$total_upload_cnt=0;
			for($file_idx=0;$file_idx<$this->file_limit;$file_idx++){
				$file_key='uploadfile_'.$file_idx;

				if($request->hasFile($file_key)){
					$upload_files[$file_idx]=$this->get_file_info($file_key);
					$total_upload_cnt++;
				}
			}

			/////// 저장하는 부분
			$mode=$request->input('mode');

			// 기존 수정
			if($mode=='update' && intval($idx)>0) {
				$updated_cnt=0;

				// 입력값 저장
				if($this->user_update_input_values){
					$func=$this->user_update_input_values;
					$updated_cnt=$this->$func($idx);
					if(!$updated_cnt){
						return view('error/error', ['error_msg' => $this->error_msg]);
					}
				}
				else{
					$updated_cnt=$this->update_input_values($idx);
					if(!$updated_cnt){
						return view('error/error', ['error_msg' => $this->error_msg]);
					}
				}

				// 입력이 잘 되었다면..
				if($updated_cnt){


					// 삭제 체크한 파일은 삭제한다.
					if(isset($_POST['deletefile'])){
                            if (is_array($_POST['deletefile'])) {
							foreach($_POST['deletefile'] as $val){
								$file_idx=$val;
								$this->delete_file($bbs_id,$idx,$file_idx);

							}
						}
					}

					// 업로드 파일이 있다면
					if($total_upload_cnt) {

						// move upload files
						$this->move_uploaded_files($bbs_id,$idx,$upload_files);

//						exit;
//						$chked_deletefile=
//						print_r($chked_deletefile);
//						exit;

					}
				}
			}

			// 신규 등록
			else if(strlen($idx)==0 || intval($idx)==0){

				$insert_cnt=0;

				// 입력값 저장
				if($this->user_save_input_values){
					$func=$this->user_save_input_values;
					$insert_cnt=$this->$func();
					if(!$insert_cnt){
						return view('error/error', ['error_msg' => $this->error_msg]);
					}
				}
				else{
					$insert_cnt=$this->save_input_values();
					if(!$insert_cnt){
						return view('error/error', ['error_msg' => $this->error_msg]);
					}
				}

				// 입력이 잘 되었다면..
				if($insert_cnt){
					$insert_id = DB::getPdo()->lastInsertId();

					if($total_upload_cnt) {

						// move upload files
						$this->move_uploaded_files($bbs_id,$insert_id,$upload_files);
					}
				}
			}


//			///// uploadfile 말고 다른 이름을 사용해 업로드 한것이 있으면 해당 이름을 태그값으로 디비에 저장한다.
//			foreach($upload_tags as $tag_val){
//				if(is_array($_FILES[$tag_val]['name'])){
//					foreach($_FILES[$tag_val]['name'] as $k=>$v){
//
//						$file_path=$_FILES[$tag_val]['tmp_name'][$k];
//						$orig_name=$_FILES[$tag_val]['name'][$k];
//						$fsize=$_FILES[$tag_val]['size'][$k];
//						if($orig_name){
//							uploadfile($cafe_id,$id,$doc_idx,$file_path,$orig_name,$fsize,$tag_val);
//						}
//					}
//				}
//			}

		/*	// 기본으로 uploadfile 은 업로드 처리를 합니다!!
			if(is_array($_FILES['uploadfile']['name'])){
				foreach($_FILES['uploadfile']['name'] as $k=>$v){

					$file_path=$_FILES['uploadfile']['tmp_name'][$k];
					$orig_name=$_FILES['uploadfile']['name'][$k];
					$fsize=$_FILES['uploadfile']['size'][$k];
					if($orig_name){
						uploadfile($cafe_id,$id,$doc_idx,$file_path,$orig_name,$fsize,$default_tag_val);
					}
				}
			}

			*/

			// 이동할 페이지 주소
//            $move_url=$req_path2.'/list';
//            echo $req_path2;exit;
//            $move_url='list';
//            return view('bbs/write_ok', compact('bbs_subject','bbs_content','move_url'));
//            return \redirect($move_url);

			return $this->make_return('list');


		}

        // TODO: 권한체크 후 관리자 또는 소유자인경우에만 삭제가 되도록 한다.
		// delete
		else if($bbs_cmd=='delete') {

			$idx = $request->input('idx', '0');
			if (intval($idx) == 0) {
				//$error_msg='idx가 안넘어왔다';
				return view('error/error', compact('error_msg'));
			}

			$result = DB::delete("delete from board_{$this->bbs_id} where idx=?", [$idx]);

			return $this->make_return('list');
		}

		else {

			if(isset($this->custom_cmds[$bbs_cmd])){
				$func=$this->custom_cmds[$bbs_cmd];
				return $this->$func($request);
			}

		}
	}

	// make <return url> or ??
	function make_return($page_id){
		if($page_id=='list'){
			$move_url = $this->share_arr['req_path2'].'/list';
			return redirect($move_url);
		}
	}

	function get_file_info($file_key){
		$orig_name = Input::file($file_key)->getClientOriginalName();
		$filename = pathinfo($orig_name, PATHINFO_FILENAME);
		$ext = pathinfo($orig_name, PATHINFO_EXTENSION);
		return [
			'file_key'=>$file_key,
			'orig_name'=>$orig_name,
			'filename'=>$filename,
			'ext'=>$ext
		];
	}

	function move_uploaded_files($bbs_id,$doc_idx,$files_arr){
		foreach($files_arr as $file_idx=>$v){
			$new_name = $bbs_id.'.'.$doc_idx .'-'.$file_idx. '.' . $v['ext'];

			DB::insert("insert into file_{$bbs_id} set orig_name=?,f_name=?,f_ext=?,doc_idx=?", [$v['orig_name'],$new_name,$v['ext'], $doc_idx]);
			$insert_id = DB::getPdo()->lastInsertId();

			Input::file($v['file_key'])->move('files/'.$bbs_id, $new_name);

		}
	}

	// TODO: 삭제전에 권한체크 할것.
	function delete_file($bbs_id,$doc_idx,$file_idx){

		// 1. 디비에서 삭제한다.
		DB::delete("delete from file_{$bbs_id} where idx=? and doc_idx=?",[$file_idx,$doc_idx]);

		// 2. 실제로 삭제한다.
		// TODO: 저장된 파일명을 얻어서 실제로 삭제한다.
//			$new_name = $bbs_id.'.'.$doc_idx .'-'.$file_idx. '.' . $v['ext'];

	}

}
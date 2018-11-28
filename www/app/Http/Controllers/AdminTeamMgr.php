<?php
namespace App\Http\Controllers;

use Auth;
use DB;

use App\User;
use App\DataTables\Buttons\UsersQueryBuilderDataTable;
//use Input;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\Utilities\Request;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Storage;


class AdminTeamMgr extends Controller{

	// 사용자 정보
	private $uid       = '';
	private $email     = '';


    // 인증체크
    private function auth()
    {

        // 로그인이 되어있으면.
        if(glo()->get_auth_data() && glo()->is_admin()) {
//            $this->shared_data = glo()->wallet_obj->wallet_data;
        }
        // 로그인이 안되어있으면 로그인페이지로 이동한다.
        else {
            header("Location: /login");
            exit;

        }

    }

    private $cat;

	public function __construct()	{
        $this->set_category('team');

	}

	public function set_category($cat_name)	{
	    $this->cat=$cat_name;
	}

	// 팀 > 전체 목록
//	public function team_list(Request $request){
//        $this->auth();
//		$bbs_cmd='list';
//
//		return $this->run($bbs_cmd,$request);
//
//	}
//	 어드바이저 > 전체 목록
//	public function advisor_list(Request $request){
//        $this->auth();
//		$bbs_cmd='list';
//
//		return $this->run_advisor($bbs_cmd,$request);
//
//	}

	// team 처리
	public function run($category,$bbs_cmd,Request $request){

	    if($category=='developer'){
            $this->set_category('team');
        }
        else if($category=='advisor') {
            $this->set_category('advisor');
        }
        else {
	        exit;
        }

        $this->auth();

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
		$req_path3 = '/'.$request->path(); // 명령까지
		$req_path2 = dirname($req_path3); // id까지
		$req_path1 = dirname($req_path2); // 메뉴

		//$page = $request->input('page',1);
		$page = $request->input('page',1);

		$is_admin=1;

//		echo $bbs_cmd;exit;

		// bbs_cmd == list
		if($bbs_cmd=='list') {

		    //			$users = User::orderBy('id', 'desc')->paginate(10);
//			return view('admin.member.list')->with('users', $users);

			$startpadding = 0;
			$padding = 1000;

			$list_info = DB::select("select * from team where cat=? order by seq ASC",[$this->cat]);

//			print_r($list_info);
			return view('admin/team/list', compact('list_info','req_path1','req_path2','req_path3','page','bbs_id','_CFG','is_admin'));

		}

        //-------------------------------------------------------
        // bbs_cmd == update_order
        if(Auth::check()) {
            if ($bbs_cmd == 'update_order') {

                $new_order_val = $request->input('new_order_val', 0);
//                echo $new_order_val;
                $new_seq=json_decode($new_order_val,1);
                foreach($new_seq as $k=>$v){
                    DB::update("update team set seq=? where idx=?",[$v,$k]);
                }
//echo 1;
//                return view('admin/team/add_ok', compact('move_url'));
                header("Location: list");
                exit;
//				return view('admin/team/add', compact('idx','list_info', 'req_path1', 'req_path2', 'req_path3', 'page', 'bbs_id', '_CFG', 'is_admin', 'rows', 'edit_mode'));
            }
        }
        else{
            $error_msg='로그인이 필요 합니다.';
            return view('error/error', compact('error_msg'));
        }


		//-------------------------------------------------------
		// bbs_cmd == write
		if(Auth::check()) {
			if ($bbs_cmd == 'add') {

				$idx = $request->input('idx', '0');
				if (intval($idx) == 0) {
					//$error_msg='idx가 안넘어왔다';
					//return view('error/error', compact('error_msg'));

					//$rows=new \stdClass();
					$edit_mode = 0;
				} // 수정시
				else {

					$edit_mode = 1;
					$rows = DB::select("select * from team where idx=? limit 1", [$idx]);

					$rows=$rows[0];

				}

				return view('admin/team/add', compact('idx','list_info', 'req_path1', 'req_path2', 'req_path3', 'page', 'bbs_id', '_CFG', 'is_admin', 'rows', 'edit_mode'));
			}
		}
		else{
			$error_msg='로그인이 필요 합니다.';
			return view('error/error', compact('error_msg'));
		}

        //-------------------------------------------------------
		// bbs_cmd == write_ok
		if($bbs_cmd=='add_ok') {

            // 영문
            $name_en=$request->input('name_en');
            // 한글
            $name_ko=$request->input('name_ko');
            // job title
            $job_position=$request->input('job_position');

            // memo
            $memo=$request->input('memo');

            // cat
            $cat=$request->input('selected_cat');

//				 내용
//				$bbs_content=$request->input('wr_content');
//
            if(strlen($cat)==0 || strlen($job_position)==0 || strlen($name_en)==0 || strlen($name_ko)==0){
                $error_msg='필수 항목이 빠졌습니다';
                return view('error/error', compact('error_msg'));
            }

            // 파일 처리
            $extension='';
            $file_is_uploaded=0;

            if($request->hasFile('photo1')){
                $file_is_uploaded=1;
                $orig_name=Input::file('photo1')->getClientOriginalName();
                $filename = pathinfo($orig_name, PATHINFO_FILENAME);
                $extension = pathinfo($orig_name, PATHINFO_EXTENSION);
//                echo $extension;exit;

            }
            else {
                $file_is_uploaded=0;
                $extension='';
    //				    echo "파일을 올리세요";exit;
            }

            /////// 저장하는 부분
            $idx=$request->input('idx');
//            echo $idx;exit;

            // 신규 등록
            if(strlen($idx)==0 || intval($idx)==0){

                // 기본테이블 업데이트
                $q="insert into team set
                            name_en		=		?,
                            name_ko		=		?,
                            job_position		=		?,
                            cat		=		?,
                            memo = ?
                            ";

                $insert_cnt=DB::insert($q,[$name_en,$name_ko,$job_position,$cat,$memo]);

                // 입력이 잘 되었다면..
                if($insert_cnt){
                    $insert_id = DB::getPdo()->lastInsertId();

                    if($file_is_uploaded) {
                        $new_name = $insert_id . '.' . $extension;
                        Input::file('photo1')->move('photo/team_photo', $new_name);
                        DB::update("update team set photo_ext=? where idx=?",[$extension,$insert_id]);

                    }
                }
            }
            // 기존 수정
            else {
                // 기본테이블 업데이트
                $q="update team set
                        name_en		=		?,
                        name_ko		=		?,
                        job_position		=		?,
                        cat		=		?,
                        
                            memo = ?                      
                        where idx=?
                        ";

                DB::update($q,[$name_en,$name_ko,$job_position,$cat,$memo,$idx]);

                // 입력이 잘 되었다면..
//                if(1 || $update_cnt){
//                    $insert_id = DB::getPdo()->lastInsertId();

                    if($file_is_uploaded) {
                        $new_name = $idx . '.' . $extension;
                        Input::file('photo1')->move('photo/team_photo', $new_name);
                        DB::update("update team set photo_ext=? where idx=?",[$extension,$idx]);
                    }
//                }
            }


			// 이동할 페이지 주소
            $move_url=$req_path2;
            return view('admin/team/add_ok', compact('move_url'));

		}

        //-------------------------------------------------------
		// bbs_cmd == delete
		if($bbs_cmd=='delete') {
			$idx = $request->input('idx', '0');
			if (intval($idx) == 0) {
				//$error_msg='idx가 안넘어왔다';
				return view('error/error', compact('error_msg'));
			}

			$result = DB::delete("delete from team where idx=?", [$idx]);

			// 삭제후 이동할 페이지 주소
			$move_url = $req_path2;
			return view('bbs/delete', compact('move_url'));
		}

	}

	// advisor 처리
//	public function run_advisor($bbs_cmd,Request $request){
//        $this->set_category('advisor');
//        $this->run($bbs_cmd,$request);
//	}

	public function cmd_list(){
        $this->auth();

	}
//
//	public function write(){
//        $this->auth();
//        if (Auth::check()) {
//			$this->uid = Auth::user()->id;
//			$this->email = Auth::user()->email;
//
//			return view('_info/write');
//
//		}else{
//			return view('auth/login');
//		}
//	}

//	//글 등록되고 그 페이지를 보여줘야된다.
//	public function info_write_ok(request $req){
//        $this->auth();
//
//		//로그인 한 사람들만 글 등록
//		if (Auth::check()) {
//			$info_subject=$req->input('info_subject');
//			$contents=$req->input('contents');
//			//print_r($_SERVER);
//
//			$ip=$_SERVER['REMOTE_ADDR'];
//			$datatime1 = \Carbon\Carbon::now();
//			$datatime1->toDateString();
//			$datatime1->toTimeString();
//			$datatime=$datatime1;
//			//$datatime=$_SERVER['REQUEST_TIME'];
//				//$_SERVER['REMOTE_ADDR']
//
//
//			//$ip=$req->input('ip');
////			$ip=  request::getClientIp();
////			$data_ip = Location::get($ip);
////			$data_ip=$req->getClientIp();
//
//
//			// 사용자 정보
//			$this->uid = Auth::user()->id;
//			$this->email = Auth::user()->email;
//			$write_info = db::insert('insert into info(subject,user_idx,ipaddress,contents,datatime,name,user_id) values (?,?,?,?,?,?,?)',[$info_subject,$this->uid = Auth::user()->id,$ip,$contents,$datatime,$this->name = Auth::user()->name,$this->email = Auth::user()->email]);
//
//			return view('_info/write', compact('write_info'));
//			//return redirect()->route('_info/info');
//
//		}else{
//			return view('auth/login');
//		}
//	}

	//글 수정되고 보여주자
	public function info_update_view(Request $request){
        $this->auth();
		return view('_info/info_update_view');
	}

	//글 확인
	public function info_baord_view(Request $request){
        $this->auth();
		$idx=$request->input('idx');
		$info_board_view= DB::select('select * from info where idx =?',[$idx]);
		return view('_info/view',compact('info_board_view'));
	}

	//글 삭제하기
	public function info_delete(Request $request){
        $this->auth();
		//계정 정보를 갖고와서 본인이 등록한 글 삭제
		if(Auth::check()) {
			// 사용자 정보
			$this->uid = Auth::user()->id;
			$this->email = Auth::user()->email;
			$user_id=$this->email = Auth::user()->email;
			$idx=$request->input('idx');
			$delete= DB::delete('delete from info where idx =? and user_id = ?',[$idx,$user_id]);
			//print_r($delete);
			//exit;
			//삭재는 되는데 다음페이지로 넘어가는 방법을 모르겠습니다.
			return view('/info',compact('delete'));
			//return redirect(compact('delete'))->action('info.index');
		}else{
			return view('auth/login');
		}
	}

}
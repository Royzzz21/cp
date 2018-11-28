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


class AdminStoreMgr extends Controller{

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

	}

//	public function set_category($cat_name)	{
//	    $this->cat=$cat_name;
//	}

	// team 처리
	public function run($bbs_cmd,Request $request){

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

			$list_info = DB::select("select * from store order by seq ASC");

//			print_r($list_info);
			return view('admin/store/list', compact('list_info','req_path1','req_path2','req_path3','page','bbs_id','_CFG','is_admin'));

		}

        //-------------------------------------------------------
        // bbs_cmd == update_order
        if(Auth::check()) {
            if ($bbs_cmd == 'update_order') {

                $new_order_val = $request->input('new_order_val', 0);
//                echo $new_order_val;
                $new_seq=json_decode($new_order_val,1);
                foreach($new_seq as $k=>$v){
                    DB::update("update store set seq=? where idx=?",[$v,$k]);
                }

                header("Location: list");
                exit;
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
					$rows = DB::select("select * from store where idx=? limit 1", [$idx]);

					$rows=$rows[0];

				}

				return view('admin/store/add', compact('idx','list_info', 'req_path1', 'req_path2', 'req_path3', 'page', 'bbs_id', '_CFG', 'is_admin', 'rows', 'edit_mode'));
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

            // 웹주소
            $web_url=$request->input('web_url');


            // job title
//            $job_position=$request->input('job_position');

            // memo
            $memo=$request->input('memo');

            // cat
//            $cat=$request->input('selected_cat');

//				 내용
//				$bbs_content=$request->input('wr_content');
//
            if(strlen($name_en)==0 || strlen($name_ko)==0){
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
                $q="insert into store set
                            name_en		=		?,
                            name_ko		=		?,
                            web_url		=		?,
                            memo = ?
                            ";

                $insert_cnt=DB::insert($q,[$name_en,$name_ko,$web_url,$memo]);

                // 입력이 잘 되었다면..
                if($insert_cnt){
                    $insert_id = DB::getPdo()->lastInsertId();

                    if($file_is_uploaded) {
                        $new_name = $insert_id . '.' . $extension;
                        Input::file('photo1')->move('photo/store_photo', $new_name);
                        DB::update("update store set photo_ext=? where idx=?",[$extension,$insert_id]);
                    }

                }
            }
            // 기존 수정
            else {
                // 기본테이블 업데이트
                $q="update store set
                        name_en		=		?,
                        name_ko		=		?,
                        web_url		=		?,

                            memo = ?                      
                        where idx=?
                        ";

                DB::update($q,[$name_en,$name_ko,$web_url,$memo,$idx]);

                // 입력이 잘 되었다면..
//                if(1 || $update_cnt){
//                    $insert_id = DB::getPdo()->lastInsertId();

                    if($file_is_uploaded) {
                        $new_name = $idx . '.' . $extension;
                        Input::file('photo1')->move('photo/store_photo', $new_name);
                        DB::update("update store set photo_ext=? where idx=?",[$extension,$idx]);
                    }
//                }
            }


			// 이동할 페이지 주소
            $move_url=$req_path2;
            return view('admin/store/add_ok', compact('move_url'));

		}

        //-------------------------------------------------------
		// bbs_cmd == delete
		if($bbs_cmd=='delete') {
			$idx = $request->input('idx', '0');
			if (intval($idx) == 0) {
				//$error_msg='idx가 안넘어왔다';
				return view('error/error', compact('error_msg'));
			}

			$result = DB::delete("delete from store where idx=?", [$idx]);

			// 삭제후 이동할 페이지 주소
			$move_url = $req_path2;
			return view('bbs/delete', compact('move_url'));
		}

	}

}
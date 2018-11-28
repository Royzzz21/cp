<?php
namespace App\Http\Controllers;

use Auth;
use DB;



use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\User;
use App\Cafe;

use App\DataTables\Buttons\UsersQueryBuilderDataTable;
use PhpParser\Node\Expr\Cast\String_;
use Yajra\Datatables\Datatables;
use Input;
use Yajra\DataTables\Utilities\Request;
use App\Http\Controllers\Redirect;



class AdminCon extends Controller{
	/////////////////////////////////////////
	// 데이타
	/////////////////////////////////////////
									// view 페이지
	private $page      = '';
									// 사용자 정보
	private $uid       = '';

	// 로그인한 사용자 정보
	private $user_id     = '';
	private $user_email     = '';
									// 지갑정보
	private $my_wallet = Array();	// wallet에 넣을 sql용
	private $wallet    = Array();	// view에서 사용할데이터

	private $subject  = Array();

	public function index(){


//		/////////////////////////////////////////
//		// 로그인 했다면
//		/////////////////////////////////////////
//		if(Auth::check()){
//			// 사용자 정보
//			$this->uid   = Auth::user()->id;
//			$this->email = Auth::user()->email;
//
//		}

		// 인증체크
		$ret=$this->auth();
		if($ret){
			return $ret;
		}

		return view('admin/index', compact('is_admin'));

	}


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

	public function __construct(){

		// 로그인 여부 체크
		if(Auth::check()) {


		}
		// 로그인이 필요합니다
		else{
			$error_msg='로그인이 필요 합니다.';
			return view('error/error', compact('error_msg'));
			exit;

		}


	}

    // 카페관리 호출 처리
    public function bbs_mgr($cmd, Request $request)
    {
        $this->auth();



        //$page = $request->input('page',1);
        $page = $request->input('page',1);

        $is_admin=1;


        // id=free, qna, hello
        // cmd=list, write, view, del, mod
        //
        $_CFG=array();
        $_CFG['default_date_format']='Y-m-d';

        // 목록을 출력한다
        if ($cmd == 'list') {
            $startpadding = 0;
            $padding = 20;

            $list_info = DB::select("select * from bbs order by id DESC limit $startpadding,$padding");
            return view('admin/bbs/list', compact('list_info', 'page', 'bbs_id', '_CFG', 'is_admin'));

        }

        // 추가폼을 출력한다
        else if ($cmd == 'create') {

//            $list_info = DB::select("select * from cafe order by id DESC limit $startpadding,$padding");
            return view('admin/bbs/create', compact( 'page', 'bbs_id', '_CFG', 'is_admin'));

        }
        // 게시판을 생성 한다
        else if ($cmd == 'create_ok') {

            // input values
            $bbs_name=$request->input('bbs_name','');
            $bbs_aid=$request->input('bbs_aid','');
			$board_type=$request->input('board_type','default');

            // memo
            $bbs_memo=$request->input('wr_content','');



            if(strlen($bbs_name)==0 || strlen($bbs_aid)==0){
                $error_msg='필수 항목이 빠졌습니다';
                return view('error/error', compact('error_msg'));
            }

//			$owner_id=$this->user_id;



			$board_type='dev';

            // bbs manager class
            $cafe_mgr=new Cafe();
            $cafe_mgr->create_bbs(0,$board_type,$bbs_name,$bbs_aid,$bbs_memo);

            return view('admin/bbs/create_ok', compact( 'page', 'bbs_id', '_CFG', 'is_admin'));
        }
    }



	// 카페관리 호출 처리
	public function cafe_mgr($cafe_cmd,Request $request){
        $this->auth();

		// 인증체크
		$ret=$this->auth();
		if($ret){
			return $ret;
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


		//$uri = $request->url();
//echo $uri;


//		print_r($_SERVER);
//		exit;

		//print_r($a);
		//exit;

		/////////////////////////////////////////
		//비로그인이라면 로그인페이지로 이동시킨다
//		$this->middleware('auth');

//		// 지갑정보
//		$this->getMyWallet();
		//$infos=Info2::all();
//phpinfo();exit;

	//	echo 2;
		//return view('_info.info',['infos'=>$infos]);
		// 나중에 리스트에 닉네임이 나왔으면 좋겠다...

		//$list_info2 =$this->name = Auth::user()->name;

		// 카페 목록을 출력한다
		if($cafe_cmd=='list') {


			$startpadding = 0;
			$padding = 20;

			$list_info = DB::select("select * from cafe order by id DESC limit $startpadding,$padding");
			return view('admin/cafe/list', compact('list_info','req_path1','req_path2','req_path3','page','bbs_id','_CFG','is_admin'));

		}

		// create 카페 생성하기

		if ($cafe_cmd == 'create') {

			//$rows=array();
			/*
						// 로그인안되어있으면..
						if (!$_USER[id]) {
							$err_code = 'NOT_COMMENT';
							include('_error.html');
							exit;
						}


						if ($_GET[idx]) {
							$idx = $_GET[idx];
						}


						if ($cat_id) {
							$idx = $db->fa1("select idx from board_{$cafe_id}_{$id} where cat='$cat_id' limit 1");
							if ($idx) {
								$mode = $_GET[mode] = 'modify';
							}
						}


						// 수정일때
						if($_GET[mode]=='modify'){

							$q = "select * from board_{$cafe_id}_{$id} where idx = $idx";
							$rows = $db->fa($q);
							//$rows = mysql_fetch_array($rs);

							// 권한이 없습니다.
							if($rows[user_id]!=$_USER[id]){
								msgbox('권한이 없습니다.');
								go_back();
								exit;
							}

							$edit_mode=1;
						}
						else {
							$edit_mode=0;
						}


						*/


//			$startpadding = 0;
//			$padding = 20;

//			$list_info = DB::select("select * from info order by idx DESC limit $startpadding,$padding");


			$idx = $request->input('idx', '0');
			if (intval($idx) == 0) {
				//$error_msg='idx가 안넘어왔다';
				//return view('error/error', compact('error_msg'));

				//$rows=new \stdClass();
				$edit_mode = 0;
			} // 수정시
			else {

				$edit_mode = 1;
				$rows = DB::select("select * from board_housebook_travel where idx=? limit 1", [$idx]);

			}

			return view('admin/cafe/create', compact('list_info', 'req_path1', 'req_path2', 'req_path3', 'page', 'bbs_id', '_CFG', 'is_admin', 'rows', 'edit_mode'));

		}


		// 카페 등록
		if($cafe_cmd=='create_ok') {
//				echo 1;exit;

			// 생성할 카페 이름과 아이디
			$cafe_name=$request->input('cafe_name','');
			$cafe_aid=$request->input('cafe_aid','');

			// 카페 설명
			$cafe_memo=$request->input('wr_content','');

			if(strlen($cafe_name)==0 || strlen($cafe_aid)==0){
				$error_msg='필수 항목이 빠졌습니다';
				return view('error/error', compact('error_msg'));
			}

			$owner_id=$this->user_id;

			// 카페 클래스를 호출해서 카페를 생성한다
			Cafe::create_cafe($owner_id,$cafe_aid,$cafe_name,$cafe_memo);

			// 이동할 페이지 주소
			$move_url=$req_path2;
			return view('bbs/create_ok', compact('cafe_name','cafe_aid','cafe_memo','move_url'));

		}


		// 카페 삭제
		if($cafe_cmd=='delete') {


			$cafe_id = $request->input('cafe_id', '0');
			if (intval($cafe_id) == 0) {
				//$error_msg='id가 안넘어왔다';
				return view('error/error', compact('error_msg'));
			}

//			$result = DB::delete("delete from board_housebook_travel where idx=?", [$idx]);

			// 카페 클래스를 호출해서 카페를 삭제한다
			Cafe::delete_cafe($cafe_id);


			// 삭제후 이동할 페이지 주소
			$move_url = $req_path2;
			return view('bbs/delete', compact('move_url'));

		}


	}




	// 게시판관리 호출 처리
	public function bbs_run($bbs_cmd,Request $request){
        $this->auth();

		// 인증체크
		$ret=$this->auth();
		if($ret){
			return $ret;
		}


		$_CFG=array();
		$_CFG['default_date_format']='Y-m-d';



		// 요청 주소
		$req_path3 = '/'.$request->path(); // 명령까지
		$req_path2 = dirname($req_path3); // id까지
		$req_path1 = dirname($req_path2); // 메뉴


		//$page = $request->input('page',1);
		$page = $request->input('page',1);


		$is_admin=1;


		// 게시판 목록을 출력한다
		if($bbs_cmd=='list') {


			$startpadding = 0;
			$padding = 20;

			$list_info = DB::select("select * from bbs order by id DESC limit $startpadding,$padding");
			return view('admin/bbs/list', compact('list_info','req_path1','req_path2','req_path3','page','bbs_id','_CFG','is_admin'));

		}

		// create 게시판 생성하기

		if ($bbs_cmd == 'create') {


			$idx = $request->input('idx', '0');
			if (intval($idx) == 0) {
				//$error_msg='idx가 안넘어왔다';
				//return view('error/error', compact('error_msg'));

				//$rows=new \stdClass();
				$edit_mode = 0;
			} // 수정시
			else {

				$edit_mode = 1;
				$rows = DB::select("select * from board_housebook_travel where idx=? limit 1", [$idx]);

			}

			return view('admin/bbs/create', compact('list_info', 'req_path1', 'req_path2', 'req_path3', 'page', 'bbs_id', '_CFG', 'is_admin', 'rows', 'edit_mode'));

		}


		// 게시판 등록
		if($bbs_cmd=='create_ok') {
//				echo 1;exit;

			// 생성할 게시판 이름과 아이디
			$bbs_name=$request->input('bbs_name','');
			$bbs_aid=$request->input('bbs_aid','');

			// 게시판 설명
			$bbs_memo=$request->input('wr_content','');

			if(strlen($bbs_name)==0 || strlen($bbs_aid)==0){
				$error_msg='필수 항목이 빠졌습니다';
				return view('error/error', compact('error_msg'));
			}

//			$owner_id=$this->user_id;
//$arr=[
//  'id'=>$bbs_aid,
//  'name'=>$bbs_name,
//  'board_type'=>'bbs'
//
//];
			// 카페 클래스를 호출해서 카페를 생성한다
			Cafe::create_bbs(0,$bbs_name,$bbs_id,$bbs_memo);

			// 이동할 페이지 주소
			$move_url=$req_path2;
			return view('bbs/create_ok', compact('cafe_name','cafe_aid','cafe_memo','move_url'));

		}


		// 카페 삭제
		if($bbs_cmd=='delete') {


			$cafe_id = $request->input('cafe_id', '0');
			if (intval($cafe_id) == 0) {
				//$error_msg='id가 안넘어왔다';
				return view('error/error', compact('error_msg'));
			}

//			$result = DB::delete("delete from board_housebook_travel where idx=?", [$idx]);

			// 카페 클래스를 호출해서 카페를 삭제한다
			Cafe::delete_cafe($cafe_id);


			// 삭제후 이동할 페이지 주소
			$move_url = $req_path2;
			return view('bbs/delete', compact('move_url'));

		}


	}







//
//
//
//
//
//
//	public function write()
//	{
//        $this->auth();
//		if (Auth::check()) {
//			$this->uid = Auth::user()->id;
//			$this->email = Auth::user()->email;
//
//			return view('_info/write');
//
//		}else{
//			return view('auth/login');
//		}
//
//	}
//	//글 등록되고 그 페이지를 보여줘야된다.
//	public function info_write_ok(request $req)
//	{
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
//	//글 수정되고 보여주자
//	public function info_update_view(Request $request){
//        $this->auth();
//		return view('_info/info_update_view');
//	}
//	//글 확인
//	public function info_baord_view(Request $request){
//        $this->auth();
//		$idx=$request->input('idx');
//		$info_board_view= DB::select('select * from info where idx =?',[$idx]);
//		return view('_info/view',compact('info_board_view'));
//	}
//
//	//글 삭제하기
//	public function info_delete(Request $request){
//        $this->auth();
//		//계정 정보를 갖고와서 본인이 등록한 글 삭제
//		if(Auth::check()) {
//			// 사용자 정보
//			$this->uid = Auth::user()->id;
//			$this->email = Auth::user()->email;
//			$user_id=$this->email = Auth::user()->email;
//			$idx=$request->input('idx');
//			$delete= DB::delete('delete from info where idx =? and user_id = ?',[$idx,$user_id]);
//			//print_r($delete);
//			//exit;
//			//삭재는 되는데 다음페이지로 넘어가는 방법을 모르겠습니다.
//			return view('/info',compact('delete'));
//			//return redirect(compact('delete'))->action('info.index');
//		}else{
//			return view('auth/login');
//		}
//	}



}
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


class NewsletterCon extends Controller{

	// 사용자 정보
	private $uid       = '';
	private $email     = '';


    // 인증체크
    private function auth()
    {

        // 로그인이 되어있으면.
//        if(glo()->auth() && glo()->is_admin()) {
//        }
//         로그인이 안되어있으면 로그인페이지로 이동한다.
//        else {
//            header("Location: /login");
//            exit;
//
//        }

    }

    private $cat;

	public function __construct()	{

	}

	public function set_category($cat_name)	{
	    $this->cat=$cat_name;
	}

	// Newsletter 등록 신청 처리
	public function subscribe(Request $request){

        $this->auth();

        //-------------------------------------------------------

        // 이메일 주소
        $email=$request->input('email');
        $email=trim($email);

        if(strlen($email)==0){
            $error_msg='필수 항목이 빠졌습니다';
            return view('error/error', compact('error_msg'));
        }

        // 기본테이블 업데이트
        $q="insert into newsletter set
                    email = ?
                    ";

        $insert_cnt=DB::insert($q,[$email]);

        // 이동할 페이지 주소
        $move_url="/";
        return view('newsletter/add_ok', compact('move_url'));

//        return redirect()->back()->with('alert', '뉴스레터 구독신청이 완료되었습니다. 감사합니다.');

//        header("Location: http://tibab.io");
//        exit;

//        header("Location: $move_url");
//        exit;

	}

}
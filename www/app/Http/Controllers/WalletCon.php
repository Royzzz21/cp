<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Cookie;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\User;
use App\DataTables\Buttons\UsersQueryBuilderDataTable;
use Yajra\Datatables\Datatables;

use BCXLibs\Coins;

// use Illuminate\Http\Request;
class WalletCon extends Controller
{
	/////////////////////////////////////////
	// 데이타
	/////////////////////////////////////////
									// view 페이지
//	private $page      = '';
									// 사용자 정보
	private $uid       = '';
	private $email     = '';
									// 지갑정보
	private $shared_data    = Array();	// view에서 사용할데이터
	private $coins_obj;


	/////////////////////////////////////////
    /**
	 * 함수 모음
     */

	// 기본지갑정보 가져오기
	private function auth()
    {

        // 로그인이 되어있으면.
        if(glo()->get_auth_data()) {
            $this->shared_data = glo()->wallet_obj->wallet_data;
        }
        // 로그인이 안되어있으면 로그인페이지로 이동한다.
        else {
            header("Location: /login");
            exit;

        }

	}
	
//	// krw 거래내역
//	private function getBookKrw(){
//		if(Auth::check()){
//			// 사용자 정보
//			$this->uid      = Auth::user()->id;
//			$this->book_krw = DB::select(" select * from user_wallet where uid = '$this->uid' and money_type = 'krw' ");
//
//			// krw 장부 데이터 가져오기
//			$this->shared_data['book_krw'] = $this->book_krw;
//		}
//	}
//
//	// btc 거래내역
//	private function getBookBtc(){
//		if(Auth::check()){
//			// 사용자 정보
//			$this->uid      = Auth::user()->id;
//			$this->book_btc = DB::select(" select * from user_wallet where uid = '$this->uid' and money_type = 'btc' ");
//
//			// krw 장부 데이터 가져오기
//			$this->shared_data['book_btc'] = $this->book_btc;
//		}
//	}
//
//	// eth 거래내역
//	private function getBookEth(){
//		if(Auth::check()){
//			// 사용자 정보
//			$this->uid      = Auth::user()->id;
//			$this->book_eth = DB::select(" select * from user_wallet where uid = '$this->uid' and money_type = 'eth' ");
//
//			// krw 장부 데이터 가져오기
//			$this->shared_data['book_eth'] = $this->book_eth;
//		}
//	}
	/////////////////////////////////////////
	
	
	
	
	/////////////////////////////////////////
    /**
	 * 초기화
     */
    public function __construct()
    {

        $this->coins_obj= &glo()->coins_obj;

    }
	/////////////////////////////////////////
	
	
	
	
	/////////////////////////////////////////
	// 여기부터 페이지
	/////////////////////////////////////////
    /**
     * 랜딩페이지
     */
//    public function index(){
//		// 지갑정보
//		// $this->getMyWallet();
//
//		// \Cookie::queue(\Cookie::forget('myCookie'));
//		// session()->forget('mycookie');
//		// return ['ok' => true];
//
//		// if (Request::has('io'))
//		// {
//			// //
//			// return view('index', $this->wallet);
//		// }
//
//		return view('index', $this->wallet);
//
//    }
	
	/**
     * 지갑 - 첫페이지
     */
    public function index(){

        // auth check
        $this->auth();

		$page_id=PAGEID_MYPAGE;

//		return view('_myaccount/manage', $this->wallet);
		$pass=array();
		$pass=$this->shared_data;
		$pass['page_id']=$page_id;

		return view('_wallet/index', $pass);
    }

	/**
     *  지갑 - 입출금
     */
//    public function manage(){
//		// 지갑정보
//		$this->getMyWallet();
//
//		$page_id=PAGEID_MYPAGE;
//
//		$pass=array();
//		$pass=$this->shared_data;
//		$pass['page_id']=$page_id;
//
//		return view('_wallet/manage', $pass);
//    }


	public function deposit_status(){

        // auth check
        $this->auth();


		//return view('pages.index', compact('title'));
		return view('_wallet.wallet.deposit_status');

	}

    /**
    wallet > deposit
     */
	public function deposit($curr){

        // auth check
        $this->auth();

        // 존재하지 않는 코인을 요청한경우.
        if(!$this->coins_obj->is_exists($curr)){
            exit;
        }

        // 선택한 코인의 정보를 기억
        $curr_data=$this->coins_obj->get($curr);
        $this->shared_data['curr']=$curr;
        $this->shared_data['curr_uc']=strtoupper($curr);
        $this->shared_data['curr_data']=$curr_data;

        // 지갑정보
        //$this->getMyWallet();

//        print_r($this->shared_data);
//        exit;

        if($curr=='krw'){
            return view('_wallet/deposit/krw', $this->shared_data);
        }
        if($curr=='xrp'){
            return view('_wallet/deposit/xrp', $this->shared_data);
        }

        return view('_wallet/deposit/default', $this->shared_data);
    }

    /**
    wallet > withdrawal
     */
    public function withdrawal($curr){

        // auth check
        $this->auth();

        // 존재하지 않는 코인을 요청한경우.
        if(!$this->coins_obj->is_exists($curr)){
            exit;
        }

        // 선택한 코인의 정보를 기억
        $curr_data=$this->coins_obj->get($curr);
        $this->shared_data['curr']=$curr;
        $this->shared_data['curr_data']=$curr_data;


        $this->uid = Auth::user()->id;

        $r=DB::SELECT("select * from users where id=?",[$this->uid]);
        $bankinfo=array();
        $bankinfo['bank_bankname']=$r[0]->bank_bankname;
        $bankinfo['bank_accnum']=$r[0]->bank_accnum;
        $bankinfo['bank_accholder']=$r[0]->bank_accholder;

        $this->shared_data['bank_info']=$bankinfo;

        if($curr=='krw'){
            return view('_wallet/withdrawal/krw', $this->shared_data);
        }

        return view('_wallet/withdrawal/default', $this->shared_data);


    }

	/**
     wallet > balance
     */
    public function balance($curr){

        // auth check
        $this->auth();

        // 존재하지 않는 코인을 요청한경우.
        if(!$this->coins_obj->is_exists($curr)){
            exit;
        }

        // 선택한 코인의 정보를 기억
        $curr_data=$this->coins_obj->get($curr);
        $this->shared_data['curr']=$curr;
        $this->shared_data['curr_uc']=strtoupper($curr);
        $this->shared_data['curr_data']=$curr_data;

		return view('_wallet/balance/default', $this->shared_data);
    }

//	public function dashboard(){
//		/////////////////////////////////////////
//		// 비로그인이라면
//		$this->middleware('auth');
//
//		// 지갑정보
//		$this->getMyWallet();
//		$this->getBookKrw();
//		return view('_wallet/krw/index', $this->shared_data);
//	}


	// export data for datatables
	public function data(Datatables $datatables){


        // auth check
        $this->auth();


		// dbtables user 예제
		// $builder = User::query()->select('id', 'name', 'email', 'created_at', 'updated_at');
		// return $datatables->eloquent($builder)
                          // ->rawColumns([1, 3])
                          // ->make();
		

		// 로그인 했다면
		if(Auth::check()){
			// 사용자 정보
			$this->uid   = Auth::user()->id;
			$this->email = Auth::user()->email;

			$sql="select DATE_FORMAT(tb2.wd_date, '%Y-%m-%d %T') as wd_date,
					case tb2.deposit_withdraw
						when 'd' then '입금'
						when 'w' then '출금'
					end as deposit_withdraw,
					tb2.amount,
					tb1.the_owner,
					concat(tb1.bank, ' ', tb1.account_number) as bank_acc,
					tb2.krw
					from user_bank_acc tb1
				left join user_wallet tb2
				on tb1.idx = tb2.wid
				where tb1.money_type = 'krw'
				  and tb2.uid={$this->uid}
			";

//			$sql = '
//			select * from (
//				select
//					DATE_FORMAT(tb2.wd_date, \'%Y-%m-%d %T\') as wd_date,
//					case tb2.deposit_withdraw
//						when \'d\' then \'입금\'
//						when \'w\' then \'출금\'
//					end as deposit_withdraw,
//					tb2.amount,
//					tb1.the_owner,
//					concat(tb1.bank, \' \', tb1.account_number) as bank_acc,
//					tb2.krw,
//					tb2.krw_charge,
//					case tb2.wd_state
//						when \'0\' then \'미완료\'
//						when \'1\' then \'완료\'
//						when \'2\' then \'취소\'
//					end as wd_state
//				from user_bank_acc tb1
//				left join user_wallet tb2
//				on tb1.idx = tb2.wid
//				where tb1.money_type = \'krw\'
//				  and tb2.uid=\''. $this->uid .'\'
//			) user_wallet
//			';
			
			// select * from user_wallet where uid=\''. $this->uid .'\'
			
			$source = DB::table(DB::raw("($sql) as user_wallet"));
			return Datatables::of($source)->make(true);
		}
		/////////////////////////////////////////
	}


	// 은행 계좌 등록
	public function bank(){

        // auth check
        $this->auth();


		$page_id=PAGEID_MYPAGE;

		$pass=array();
		$pass=$this->shared_data;
		$pass['page_id']=$page_id;

		// 로그인 했다면
		if(Auth::check()){
			// 지갑정보
//			$this->getMyWallet();
//			$this->getBookKrw();
			return view('_wallet/bank', $pass);
		}
		else {
			$error_msg = '로그인이 필요합니다.';
			return view('error/error', compact('error_msg'));
		}
	}

	// update bank information
	public function bankUpdate(Request $request){

        // auth check
        $this->auth();

		if(Auth::check()) {
			// 사용자 정보
			$this->uid = Auth::user()->id;
			$this->email = Auth::user()->email;


			$bank_bankname = $request->input('bank_bankname');
			$bank_accnum = $request->input('bank_accnum');
			$bank_accholder = $request->input('bank_accholder');

			DB::UPDATE("update users set bank_bankname=?, bank_accnum=?,bank_accname=? where id=?", [$bank_bankname, $bank_accnum, $bank_accholder,$this->uid]);

			$error_msg = '처리가 완료되었습니다.';
			return view('error/error', compact('error_msg'));
		}
		else {
			$error_msg = '로그인이 필요합니다.';
			return view('error/error', compact('error_msg'));
		}


	}
}
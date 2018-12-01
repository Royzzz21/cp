<?php
namespace TLibs;

use DB;
use Auth;
use Cookie;
use Illuminate\Support\Facades\Hash;



class Glo {

    public $page_obj;

    public $coins_obj;
    public $pairs_obj;

    public $wallet_obj;

    public $user_id;
    public $user_name;
    public $user_email;
    public $user_role; // admin, ...

    public $is_logged; // is logged?

    public $is_admin_page;
    public $is_admin=false;

    public $pdo;

    function __construct()
    {
        $this->is_logged=false;
        $this->is_admin_page=false;
    }

    function set_adminpage($is_adminpage){
        $this->is_admin_page=$is_adminpage;
    }

    function init(){
        $this->is_logged=false;

        $this->page_obj=new PageClass();
        $this->pairs_obj=new Pairs();
        $this->wallet_obj=new Wallet();

        $this->pdo = DB::getPdo();

    }

    // 사용자 지갑 읽기
    function get_user_wallet(){

        $this->is_logged=true;

//        echo $user_id;exit;

        // 지갑정보 가져오기
        $this->wallet_obj->prepare($this->user_id);

        $this->wallet_obj->wallet_data['id']= $this->user_id;
        $this->wallet_obj->wallet_data['email']= $this->user_email;

    }

    function check_admin_auth(){
    	// in admin page
		if($this->is_admin_page){
			// logged
			if($this->is_logged){
				// not admin
				if(!$this->is_admin){
					header("Location: /logout?move_to=/admin");
					exit;
				}
			}
			else {
				header("Location: /login?move_to=/admin");
				exit;
			}
		}
	}


  function make_token($user_id){
    // $str='ey1y23y23kh1l2h21kj3h43lkj4h';
    $str=md5(uniqid(rand(), true));
    $token=str_shuffle($str);
    $this->token=$token;
    DB::update("update users set api_token=? where id=?",[$token,$user_id]);
  }


public $token='';
  function api_login($email,$pass){

    // try Login
    // 1. select user data
    $rows=DB::select("select * from users where email=?",[$email]);
    // print_r($rows);exit;

    if(count($rows)>0){
      $row=$rows[0];

      // we make hashed password
      // $input_hash_pass = Hash::make($pass);
      $ret=Hash::check($pass,$row->password);



// echo "{$input_hash_pass} == {$row->password}";
// exit;

      //!strcmp($input_hash_pass))
      // compare password input_pass and users.password
      // if($input_hash_pass==$row->password){
      if($ret){
        // if login successful
        $this->is_logged=true;

        $this->user_id=$row->id;
        $this->user_name=$row->name;
        $this->user_email=$row->email;
        $this->user_role=$row->user_role;

        // is admin ?
        $this->is_admin=$this->is_admin();

        $this->make_token($this->user_id);
        // echo 1;exit;

        return true;
      }
    }

    return false;
	}

    function get_auth_data(){
        if(Auth::check()) {

            $this->is_logged=true;
            $this->user_id=Auth::user()->id;
            $this->user_name=Auth::user()->name;
            $this->user_email=Auth::user()->email;
            $this->user_role=Auth::user()->user_role;

            // is admin ?
            $this->is_admin=$this->is_admin();

//            $this->get_user_wallet($this->user_id);
            return true;
        }
        else {
		}

        $this->is_logged=false;
        return false;
    }


    // check is admin?
    function is_admin(){
        if($this->user_role=='admin'){
            return true;
        }
//        echo $this->user_id=Auth::user()->user_role;
//        exit;

        return false;
    }
}


////////////////////////////////////////
// stores page data
class PageClass
{
//    public $coins = array();
    public $page_id;
    public $page_name;
    public $page_desc;

    function __construct(){
    }
    function set_pageId($page_id){
        $this->page_id=$page_id;
    }
    function set_pageName($page_name){
        $this->page_name=$page_name;
    }
    function set_pageDesc($page_desc){
        $this->page_desc=$page_desc;
    }
}

////////////////////////////////////////
// stores coin data
// check if exists
class Coins
{
    public $coins=array();

    function __construct()
    {
        $this->coins=$this->get_currency_all();
    }

    // 모든 통화 확인
    function get_currency_all(){
        $arr=array();
//        echo "Coins->get_currency_all()";

        // 페어정보 얻기
        $rows = DB::select("select * from coins order by seq asc");
        if (count($rows) == 0) {
            return $arr;
        }

        foreach($rows as $k=>$v){
            $arr[$v->coin_id]=(array)$v;
        }

        //$data = $rows[0];
        return $arr;
    }

    // DB에 존재하는 코인인지 확인한다.
    function is_exists($coin_id){
//		$this->print_coins();

        if(isset($this->coins[$coin_id])){
            return true;
        }
        return false;
    }

    function get($coin_id){
        if(isset($this->coins[$coin_id])){
            return (array)$this->coins[$coin_id];
        }
        return array();
    }
    function print_coins(){
        print_R($this->coins);
    }
}


////////////////////////////////////////
// stores pair data
// check if exists
class Pairs
{
    public $pairs=array();

    function __construct()
    {
        $this->pairs=$this->get_pair_all();
    }

    // 모든 페어 확인
    function get_pair_all(){
        $arr=array();


        return $arr;
    }


    // DB에 존재하는 코인인지 확인한다.
    function is_exists($coin_id){

        if(isset($this->pairs[$coin_id])){
            return true;
        }
        return false;
    }

    function get($pair_id){
        if(isset($this->pairs[$pair_id])){
            return (array)$this->pairs[$pair_id];
        }
        return array();
    }

    function print_coins(){
        print_R($this->pairs);
    }

}

////////////////////////////////////////
// wallet
class Wallet
{
//    public $coins=array();
    public $wallet_data;

    function __construct()
    {
        $this->wallet_data=[];
    }

    // 기본지갑정보 가져오기
    public function prepare($user_id)
    {

        $ro=DB::select("select * from user_wallet where user_id={$user_id}");

        // 지갑데이타
        $this->wallet_data['bank_info'] =
//            array(
//            'id'         => $this->uid,
//            'email'      => $this->email,
//            'bank_info'  => array(
            array(
                'bank_bankname'    => Auth::user()->bank_bankname,
                'bank_accnum'    => Auth::user()->bank_accnum,
                'bank_accholder'    => Auth::user()->bank_accholder,
            );

        $this->wallet_data['balance'] = (array)$ro[0];
//        print_R($this->wallet_data);
    }

    public function get(){
        return $this->wallet_data;

    }
}

?>

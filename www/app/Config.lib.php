<?php

define('DEV_SHOW_ERROR',1);

require_once __DIR__.'/Libs.php';


// 활성화하면 시스템이 부하를 받지않도록 체결 속도를 늦춥니다.
//define('ENABLE_DEVMODE',true);
define('ENABLE_DEVMODE',false);

// 페이지 아이디 정의
define('PAGEID_HOME',1);
define('PAGEID_EXCHANGE',2);
define('PAGEID_MYPAGE',3);


// SERVER_HTTP_HOST
if(isset($_SERVER['HTTP_HOST'])){
	define('HTTP_HOST', $_SERVER['HTTP_HOST']);
}

// 환경설정
$_CFG=array();
//////// withdrawal 처리는 일일 1회
$_CFG['confirm_min']=1; // 비트코인 입금으로 처리할 confirmation 수 (비트코인은 공식적으로 6을 권장함. 1로 할경우 리스크 감수해야함.)

//// 현재 timestamp
$_CFG['ts']=time();


if(!defined('ENABLE_SERVER_MODE')) {
    $GLOBALS['glo_obj'] = new \TLibs\Glo();
    glo()->init();
}

//print_R($glo_obj);

//echo 1;
//glo();





// get project list
function get_project_list(){
	$r=DB::select("select * from board_project order by idx asc");
	return $r;
}



// get project list child
function get_project_list_child($val){
    $r=DB::select("select * from board_task where project_id = '$val' order by starting_date asc");
    return $r;
}

// get member list
function get_member_list(){
	$r=DB::select("select * from users order by name asc");
	return $r;
}

// get user data
function get_user_data($val){
	$r=DB::select("select * from users where id = {$val} order by name asc");
	if(count($r)>0){
		return $r[0];

	}

	//return $r;
	return false;
}




// 팀 카테고리 셀렉트를 위한 배열 생성
function get_team_category(){
	$arr=array();
	$arr['team']="팀";
	$arr['advisor']="자문/고문";
	return $arr;
}

// BBS common status code to text
function get_status_text($sts){
	if($sts=='READY'){
		return '승인대기';
	}
	if($sts=='DECL'){
		return '거부';
	}
	if($sts=='OK'){
		return '승인';
	}

}

function get_file_cnt($bbs_id,$doc_idx){

	$r=DB::select("select count(*) as cnt from file_{$bbs_id} where doc_idx=?",[$doc_idx]);
	if(count($r) > 0){
		return $r[0]->cnt;
	}
	//return $r;
	return 0;

}

// get last 1 row from notice bbs
// 공지사항 최근글 한개 얻음
function get_notice_last1(){

	$r=DB::select("select * from board_notice order by idx desc limit 1");
	if(count($r) > 0){
		return $r[0];
	}

	return false;
}

function get_files_all($bbs_id,$doc_idx){

	$r=DB::select("select * from file_{$bbs_id} where doc_idx=? order by idx asc",[$doc_idx]);
	if(count($r) > 0){
		return $r;
	}
//	return 0;
//	return $r;
	return false;

}

function get_team_all($sel_cat){
	$r=DB::select("select * from team where cat=? and is_active='1' order by seq asc",[$sel_cat]);
	return $r;
}

function get_partner_all(){
	$r=DB::select("select * from partner where is_active='1' order by seq asc");
	return $r;
}


function get_store_all(){
	$r=DB::select("select * from store where is_active='1' order by seq asc");
	return $r;
}

function get_media_all(){
	$r=DB::select("select * from media where is_active='1' order by seq asc");
	return $r;
}

function get_press_all(){
	$r=DB::select("select * from press where is_active='1' order by seq asc");
	return $r;
}


function msgbox($msg){
    debugmsg($msg);
}

// wrapper
function reg_route($path,$con,$func,$method='get'){
    if($method=='post'){
        Route::post($path,"$con@$func");
    }
    else if($method=='get'){
        Route::get($path,"$con@$func");
    }
}


function tibab_number_format($num, $curr){
	if($curr=='krw'){
		return number_format($num);
	}
	if($curr=='usd'){
		return number_format($num,2);
	}
	return number_format($num,8);
}

// 리턴타입 지정
// global object
function glo(): \TLibs\Glo{
//function glo(){
	global $GLOBALS;

	$aaa=$GLOBALS['glo_obj'];
	return $aaa;

}

// get object value
function get_obj_val($obj,$key){
	if(is_object($obj)){
		if(property_exists($obj, $key)){
			return $obj->$key;
		}
	}
	return '';
}

function make_cleanName($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function obj2arr($obj){
	$new_arr=array();

	$arr=(array)$obj;
    foreach($arr as $k=>$v ){
        $k=make_cleanName($k);
        $new_arr[$k]=$v;
    }

    return $new_arr;

}

// 회원 가입 처리
function member_register($user_obj){
	//print_r($user_arr);exit;

	$user_arr=obj2arr($user_obj);

	// 유저 지갑을 만든다.
	$user_id=$user_arr['attributes']['id'];
	create_user_wallet($user_id);

}

// 유저 지갑을 만든다.
function create_user_wallet($user_id){
//	DB::insert("insert into user_wallet set user_id='$user_id'");
}


// fetch_array
function fa($q){
    $rows=DB::select($q);
    if(count($rows)>0){
        return $rows[0];
    }
    return 0;
}

// fetch_array + get value of specified key
function fa1($q,$key_name){
    $rows=DB::select($q);
    if(count($rows)>0){
        return $rows[0]->$key_name;
    }
    return 0;
}

// 거래 페어 확인
function get_pair_info($pair_id){
}

// 모든 페어 확인
function get_pair_all(){
}


// 유저지갑 확인
function get_user_balance($user_num){
    // 유저지갑 얻기
    $rows = DB::select("select * from user_wallet where user_id=? limit 1",[$user_num]);
    if (count($rows) == 0) {
        return 0;
    }

    $balance = $rows[0];

    // get price
//        $price = $balance->price;
    return $balance;
}


function debugmsg($str){
	//return;
	echo "\n".$str;
	flush();

}

// 글자 자르기
function cut_str($str, $len, $suffix=''){
	$s = mb_strimwidth($str, 0, $len,$suffix,"utf-8");  // PHP5용 함수 UTF-8 짜르기
	return $s;
}

/*
 * UTF8 한글 자르기

	파라미터 설명

	String $str: 원본 문자열
	Integer $len: 문자열을 자를 길이
	Boolean $checkmb: 이 값을 true로 하면 한글을 영문2자와 같이 취급한다. 기본값은 false
	String $tail: 생략후 붙일 줄임 기호

*/
function strcut_utf8($str, $len, $tail='...',$checkmb=false) {
	preg_match_all('/[\xEA-\xED][\x80-\xFF]{2}|./', $str, $match);

	$m    = $match[0];
	$slen = strlen($str);  // length of source string
	$tlen = strlen($tail); // length of tail string
	$mlen = count($m); // length of matched characters

	if ($slen <= $len) return $str;
	if (!$checkmb && $mlen <= $len) return $str;

	$ret   = array();
	$count = 0;

	for ($i=0; $i < $len; $i++) {
		$count += ($checkmb && strlen($m[$i]) > 1)?2:1;

		if ($count + $tlen > $len) break;
		$ret[] = $m[$i];
	}

	return join('', $ret).$tail;
}

// 랜덤값을 생성한다.
function make_random($len=10){
	$s=md5(uniqid(rand(), true));
	if($len){
		$s=substr($s,0,$len);
	}
	return $s;
}


function make_set($a,$splitter=','){
	$q='';
	//$v_arr=array();
	foreach($a as $k=>$v){
	//	$v_arr[]=$v;
		if($q){
			$q.=$splitter;
		}
		$q.="$k=?";
	}
	return $q;
}


function make_set_kv($a,$splitter=','){
	$q='';
	$v_arr=array();
	foreach($a as $k=>$v){
		$v_arr[]=$v;
		if($q){
			$q.=$splitter;
		}
		$q.="$k=?";
	}
	return array($q,$v_arr);
}


?>
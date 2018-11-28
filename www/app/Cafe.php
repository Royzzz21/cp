<?php

namespace App;

use Auth;
use DB;

class Cafe {


    /*************************
     * 카페(그룹) 생성 함수
     *
     */
    static function create_cafe($owner_id,$cafe_id,$cafe_name,$cafe_memo){
        //global $db;

        // 카페아이디가 지정되지않으면 생성이 불가능하다.
        if(!$cafe_id){
            return 0;
        }

        // 카페 소유자 아이디가 지정되지않으면 가입이 불가능.
        if(!$owner_id){
            return 0;
        }

        // 카페명이 지정되지않으면 생성이 불가능하다.
        if(!$cafe_name){
            return 0;
        }


        $tt = time();

//        // 게시판 목록 (관리 테이블)
//        DB::create("create table lst_board_{$cafe_id} (
//				idx int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//				cafe_id varchar(20),
//				bbs_name varchar(50),
//				read_lv int(11) NOT NULL default 0,
//				write_lv int(11) NOT NULL default 0,
//				list_lv int(11) NOT NULL default 0,
//				regtt int(11),
//			  `id` varchar(100) DEFAULT NULL,
//			  `have_heap` int(11) NOT NULL DEFAULT '0',
//			  `board_type` varchar(20) NOT NULL DEFAULT '',
//			  `group_idx` int(11) NOT NULL DEFAULT '0',
//			  `seq` int(11) NOT NULL DEFAULT '0',
//			  `bbs_guest_write` char(1) NOT NULL DEFAULT ''
//				) default charset=utf8"
//        );

//        // 멤버 목록 (관리 테이블)
//        DB::create("create table lst_member_{$cafe_id} (
//				idx int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//				id char(20),
//				nick char(50), -- 닉네임
//				lv int(11) NOT NULL DEFAULT '0', -- 레벨지정 0은 손님(비회원)과 동일한 권한.
//				team int NOT NULL DEFAULT '0', -- 팀지정
//				confirm varchar(10),
//				regtt int(11)
//				) default charset=utf8"
//        );
//
//        // 메뉴 목록 관리
//        DB::create("create table lst_menu_{$cafe_id} (
//				idx int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//				cafe_id varchar(20),
//				cafe_menu_name varchar(50),
//				regtt int(11),
//				id varchar(100) NOT NULL
//				) default charset=utf8"
//        );


        // 카페 목록 관리테이블에 등록

        DB::insert("INSERT INTO cafe set
			  aid=?,
				cafe_name=?,
				cafe_memo=?,
				user_id=?,
				open_sts=?,
				join_sts=?,
				ts=?
				",[$cafe_id,$cafe_name,$cafe_memo,$owner_id,1,1,$tt]);

        return 1;

    }


    // 카페를 삭제한다
    static function delete_cafe($cafe_id){
        //global $db;

        // 카페아이디가 지정되지않으면 불가능하다.
        if(!$cafe_id){
            return 0;
        }


        // 카페 목록 관리테이블에서 삭제한다

        DB::delete("DELETE FROM cafe where id=?",[$cafe_id]);

        return 1;

    }

    /****************************
     * 게시판 생성 함수
     * 게시판은 카페가 있어야 생성이 가능함.
     */
    function create_bbs($cafe_id,$board_type,$bbs_name,$bbs_id,$bbs_memo){
//        echo 1;exit;

//        global $db;
//        global $lib_dir;
        //echo $lib_dir;exit;


//        $bbs_id=$a['id'];
//        $board_type=$a['board_type'];
//        if(!($bbs_id && $a['board_type'])){
//            return false;
//        }

        $tt=time();

        // 파일 테이블
        $q2="
            CREATE TABLE `file_{$bbs_id}` (
              `idx` int(11) NOT NULL auto_increment,
              `doc_idx` int(11) NOT NULL,
              `f_name` char(255) NOT NULL,
              `orig_name` char(255) NOT NULL,
              `f_size` double NOT NULL default '0',
               com_idx int not null,
               `tag` char(50) not null,
               `set_idx` int not null,
               `f_ext` char(10) not null,
              PRIMARY KEY  (`idx`),
              KEY `doc_idx` (`doc_idx`)
            ) DEFAULT CHARSET=utf8
        ";

        //echo $lib_dir;exit;

//        $board_type='default';

		// check requested board_type
		if($board_type=='dev'){

		}
		else {
			$board_type='default';
		}


        $app_dir=dirname(__FILE__);

        // 게시판 타입에따라 테이블구조가 다르다.
        $sql_path=$app_dir.'/sql/bbs.'.$board_type.'.php';
        if(!file_exists($sql_path)){
            $sql_path=$app_dir.'/sql/bbs.default.php';
        }


//        echo $sql_path;exit;

        include($sql_path);



        $q1 = "create table comment_{$bbs_id} (
					`idx` INT(11) NOT NULL AUTO_INCREMENT,
                    `bbs_idx` INT(11) NULL DEFAULT NULL,
                    `bbs_com_name` VARCHAR(100) NULL DEFAULT NULL,
                    `bbs_com_content` TEXT NULL,
                    `bbs_com_regdate` INT(11) NULL DEFAULT NULL,
                    `user_id` VARCHAR(50) NULL DEFAULT NULL,
                    `seq` INT(11) NOT NULL,
                    `sub_seq` INT(11) NOT NULL,
                    `parent_com_idx` INT(11) NOT NULL,
                    `depth` INT(11) NOT NULL,
                    `is_del` INT(11) NOT NULL,
                    PRIMARY KEY (`idx`),
                    INDEX `sub_seq` (`sub_seq`),
                    INDEX `parent_com_idx` (`parent_com_idx`),
                    INDEX `seq` (`seq`)
			) default charset=utf8";

        //echo $q;exit;

        $result=glo()->pdo->query($q);
        if($q1) {
            $result1 = glo()->pdo->query($q1);
        }
        if($q2) {
            $result2 = glo()->pdo->query($q2);
        }


        // 게시판 생성이 성공되었으면..
        if(1){
//
//            cat_create_table('_'.$bbs_id,'게시판 사용을 위한 카테고리','자동생성');
//
//            // query 생성
//            $s=make_set($a);
//
            // 게시판 리스트에 등록
//            $q = "insert into bbs set $s,regtt			=		'$tt'			";

//            glo()->pdo->query($q);

            $ts=time();
            DB::insert("insert into bbs set bbs_sid=?,bbs_name=?,board_type=?,ts=?",[$bbs_id,$bbs_name,$board_type,$ts]);
//
//            //echo $q;exit;
//
//            //echo $q;exit;
//            $db->query($q);

        }

        //exit;

        return 1;
    }

// 게시판 삭제함수
    function delete_bbs($cafe_id,$id){
        global $db;

        $db->query("delete from lst_board_{$cafe_id} where id='$id'"); // 게시판 목록에서 제거
        $db->query("delete from cat where ct_id='_$id'"); // 카테고리에서 제거
        $db->query("DROP TABLE cat__{$id}"); // 카테고리 테이블 드랍
        $db->query("DROP TABLE board_{$cafe_id}_{$id}"); // 게시판
        $db->query("DROP TABLE file_{$cafe_id}_{$id}"); // 파일
        $db->query("DROP TABLE comment_{$cafe_id}_{$id}"); // 코멘트
    }
}

-- --------------------------------------------------------
-- 호스트:                          192.168.219.222
-- 서버 버전:                        5.7.21 - Homebrew
-- 서버 OS:                        osx10.11
-- HeidiSQL 버전:                  9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 테이블 tibab.bbs 구조 내보내기
CREATE TABLE IF NOT EXISTS `bbs` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '게시판id(숫자)',
  `cafe_id` int(11) DEFAULT NULL COMMENT '카페id(숫자)',
  `bbs_aid` char(50) DEFAULT NULL COMMENT '게시판 영문id',
  `bbs_name` char(50) NOT NULL DEFAULT '' COMMENT '게시판 이름',
  `board_type` char(50) NOT NULL DEFAULT '' COMMENT '게시판 종류(갤러리,일반 등)',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `seq` int(11) NOT NULL DEFAULT '0' COMMENT '정렬순서',
  `bbs_guest_write` char(1) NOT NULL DEFAULT '',
  `ts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1124 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 테이블 데이터 tibab.bbs:0 rows 내보내기
/*!40000 ALTER TABLE `bbs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bbs` ENABLE KEYS */;

-- 테이블 tibab.bbs_group 구조 내보내기
CREATE TABLE IF NOT EXISTS `bbs_group` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` char(50) NOT NULL DEFAULT '',
  `is_open` int(11) NOT NULL DEFAULT '0',
  `tot_board` int(11) NOT NULL DEFAULT '0',
  `group_desc` char(200) NOT NULL DEFAULT '',
  `group_admin` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`idx`),
  UNIQUE KEY `group_name` (`group_name`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- 테이블 데이터 tibab.bbs_group:1 rows 내보내기
/*!40000 ALTER TABLE `bbs_group` DISABLE KEYS */;
INSERT INTO `bbs_group` (`idx`, `group_name`, `is_open`, `tot_board`, `group_desc`, `group_admin`) VALUES
	(62, 'nextstudio', 0, 0, '', '');
/*!40000 ALTER TABLE `bbs_group` ENABLE KEYS */;

-- 테이블 tibab.bitcoin_send 구조 내보내기
CREATE TABLE IF NOT EXISTS `bitcoin_send` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `coin_from` char(34) NOT NULL DEFAULT '',
  `coin_to` char(34) NOT NULL DEFAULT '',
  `send_hist_idx` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL DEFAULT '0',
  `ts` int(11) NOT NULL DEFAULT '0',
  `curr_pair` int(11) NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '0',
  `amount` double NOT NULL DEFAULT '0',
  `send_type` int(11) NOT NULL DEFAULT '0',
  `sts` int(11) NOT NULL DEFAULT '0',
  `send_result` char(200) NOT NULL DEFAULT '',
  `site_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idx`),
  KEY `uid` (`uid`),
  KEY `send_type` (`send_type`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 테이블 데이터 tibab.bitcoin_send:~0 rows (대략적) 내보내기
/*!40000 ALTER TABLE `bitcoin_send` DISABLE KEYS */;
/*!40000 ALTER TABLE `bitcoin_send` ENABLE KEYS */;

-- 테이블 tibab.board_comment 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_comment` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `bbs_idx` int(11) DEFAULT NULL,
  `bbs_com_name` varchar(100) DEFAULT NULL,
  `bbs_com_content` text,
  `bbs_com_regdate` int(11) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `seq` int(11) NOT NULL,
  `sub_seq` int(11) NOT NULL,
  `parent_com_idx` int(11) NOT NULL,
  `depth` int(11) NOT NULL,
  `is_del` int(11) NOT NULL,
  PRIMARY KEY (`idx`),
  KEY `sub_seq` (`sub_seq`),
  KEY `parent_com_idx` (`parent_com_idx`),
  KEY `seq` (`seq`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 테이블 데이터 tibab.board_comment:0 rows 내보내기
/*!40000 ALTER TABLE `board_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `board_comment` ENABLE KEYS */;

-- 테이블 tibab.board_test 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_test` (
  `is_secret` int(11) NOT NULL DEFAULT '0',
  `pw` char(20) NOT NULL DEFAULT '',
  `file_idx` int(11) NOT NULL DEFAULT '0',
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `link1` char(255) NOT NULL,
  `link2` char(255) NOT NULL,
  `rcpt` char(20) NOT NULL,
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `bbs_id` int(11) DEFAULT NULL,
  `bbs_name` varchar(20) DEFAULT NULL,
  `bbs_subject` varchar(200) DEFAULT NULL,
  `bbs_content` longtext,
  `bbs_writer` varchar(100) DEFAULT NULL,
  `bbs_regtt` int(11) DEFAULT NULL,
  `bbs_file` varchar(200) DEFAULT NULL,
  `bbs_hit` int(11) NOT NULL DEFAULT '0',
  `bbs_comment_tot` int(11) NOT NULL DEFAULT '0',
  `bbs_vote_up` int(11) NOT NULL DEFAULT '0',
  `bbs_vote_down` int(11) NOT NULL DEFAULT '0',
  `main_view` int(11) NOT NULL DEFAULT '0',
  `cat` varchar(20) NOT NULL,
  `cat0` varchar(20) NOT NULL,
  `sts` enum('OK','READY','STOP','DECL') NOT NULL DEFAULT 'READY',
  `user_id` char(20) NOT NULL DEFAULT '0',
  `file_count` int(11) NOT NULL DEFAULT '0',
  `file_totsize` double NOT NULL DEFAULT '0',
  `cat_idx0` int(11) NOT NULL DEFAULT '0',
  `cat_idx` int(11) NOT NULL DEFAULT '0',
  `is_notice` int(11) NOT NULL,
  `user_idx` int(11) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 테이블 데이터 tibab.board_test:0 rows 내보내기
/*!40000 ALTER TABLE `board_test` DISABLE KEYS */;
/*!40000 ALTER TABLE `board_test` ENABLE KEYS */;

-- 테이블 tibab.cafe 구조 내보내기
CREATE TABLE IF NOT EXISTS `cafe` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '카페idx',
  `aid` char(50) NOT NULL COMMENT '카페id',
  `cafe_name` char(50) NOT NULL COMMENT '카페명',
  `cafe_memo` text NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '소유자',
  `open_sts` char(1) DEFAULT NULL,
  `join_sts` char(1) DEFAULT NULL,
  `ts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`aid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- 테이블 데이터 tibab.cafe:0 rows 내보내기
/*!40000 ALTER TABLE `cafe` DISABLE KEYS */;
/*!40000 ALTER TABLE `cafe` ENABLE KEYS */;

-- 테이블 tibab.cat 구조 내보내기
CREATE TABLE IF NOT EXISTS `cat` (
  `ct_idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `ct_id` char(20) NOT NULL DEFAULT '' COMMENT '???? ??? id',
  `ct_name` char(255) NOT NULL DEFAULT '' COMMENT '??????? ??',
  `ct_comment` char(255) NOT NULL DEFAULT '' COMMENT '??????? ??',
  PRIMARY KEY (`ct_idx`),
  UNIQUE KEY `id` (`ct_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1164 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- 테이블 데이터 tibab.cat:12 rows 내보내기
/*!40000 ALTER TABLE `cat` DISABLE KEYS */;
INSERT INTO `cat` (`ct_idx`, `ct_id`, `ct_name`, `ct_comment`) VALUES
	(1151, '_show', '상품진열', '자동생성'),
	(1148, '_house', '좌측카테고리', '자동생성'),
	(1152, '_banner', '게시판 사용을 위한 카테고리', '자동생성'),
	(1153, '_housetype', '하우스타입', '자동생성'),
	(1154, '_distancetype', '거리', '자동생성'),
	(1155, '_travel', '게시판 사용을 위한 카테고리', '자동생성'),
	(1156, '_notice', '게시판 사용을 위한 카테고리', '자동생성'),
	(1157, '_cultural_tourism', '게시판 사용을 위한 카테고리', '자동생성'),
	(1160, '_transportation', '게시판 사용을 위한 카테고리', '자동생성'),
	(1161, '_foodnfun', '게시판 사용을 위한 카테고리', '자동생성'),
	(1162, '_academies', '게시판 사용을 위한 카테고리', '자동생성'),
	(1163, '_festivities', '게시판 사용을 위한 카테고리', '자동생성');
/*!40000 ALTER TABLE `cat` ENABLE KEYS */;

-- 테이블 tibab.chat 구조 내보내기
CREATE TABLE IF NOT EXISTS `chat` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `member_idx` int(11) NOT NULL,
  `memo` char(255) NOT NULL DEFAULT '',
  `reg_ts` int(11) NOT NULL,
  `group_idx` int(11) NOT NULL,
  `sender_idx` int(11) NOT NULL,
  `sts` int(11) NOT NULL DEFAULT '0',
  `is_popup` int(11) NOT NULL DEFAULT '0',
  `push_idx` int(11) NOT NULL DEFAULT '0',
  `memo_subject` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`idx`),
  KEY `member_idx` (`member_idx`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- 테이블 데이터 tibab.chat:0 rows 내보내기
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;

-- 테이블 tibab.chat_room 구조 내보내기
CREATE TABLE IF NOT EXISTS `chat_room` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rnum` int(10) unsigned NOT NULL,
  `rtype` varchar(45) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `chat` varchar(1000) NOT NULL,
  `chat_time` datetime NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 테이블 데이터 tibab.chat_room:~0 rows (대략적) 내보내기
/*!40000 ALTER TABLE `chat_room` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat_room` ENABLE KEYS */;

-- 테이블 tibab.coins 구조 내보내기
CREATE TABLE IF NOT EXISTS `coins` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `seq` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_coin` int(11) NOT NULL DEFAULT '1',
  `coin_id` char(20) NOT NULL DEFAULT '',
  `coin_name_en` char(255) NOT NULL,
  `coin_name_ko` char(255) NOT NULL,
  PRIMARY KEY (`idx`),
  UNIQUE KEY `coin_id` (`coin_id`),
  KEY `seq` (`seq`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 테이블 데이터 tibab.coins:8 rows 내보내기
/*!40000 ALTER TABLE `coins` DISABLE KEYS */;
INSERT INTO `coins` (`idx`, `seq`, `is_active`, `is_coin`, `coin_id`, `coin_name_en`, `coin_name_ko`) VALUES
	(31, 0, 1, 0, 'usd', 'US dollar', '미국달러'),
	(32, 0, 1, 0, 'krw', 'Korean Won', '원'),
	(33, 0, 1, 0, 'jpy', 'Japanese Yen', '엔'),
	(34, 0, 1, 0, 'cny', 'Chinese Yuan', '위안'),
	(35, 0, 1, 1, 'btc', 'Bitcoin', '비트코인'),
	(36, 0, 1, 1, 'eth', 'ethereum', '이더리움'),
	(37, 0, 1, 1, 'xrp', 'ripple', '리플'),
	(38, 0, 1, 0, 'php', 'Philippines Peso', '필리핀페소');
/*!40000 ALTER TABLE `coins` ENABLE KEYS */;

-- 테이블 tibab.config 구조 내보내기
CREATE TABLE IF NOT EXISTS `config` (
  `idx` int(3) NOT NULL,
  `rating_1` char(5) NOT NULL COMMENT '일반회원의 보상 배율',
  `rating_2` char(5) NOT NULL COMMENT '리뷰스타의 보상 배율',
  `shop_bank_name` varchar(120) NOT NULL COMMENT '착한소비 수취인',
  `shop_bank_number` varchar(120) NOT NULL COMMENT '계좌번호',
  `shop_bank` varchar(120) NOT NULL COMMENT '은행명',
  `versionCode` int(3) NOT NULL COMMENT '안드로이드 버전코드',
  `main_popup` text NOT NULL COMMENT '메인 실행 시 팝업 공지 내용',
  `is_main_popup` int(1) NOT NULL COMMENT '0:팝업없음, 1: 팝업 공지 띄우기',
  `is_img_popup` int(1) NOT NULL COMMENT '이미지 팝업 활성화 여부',
  `img_popup_src` varchar(255) NOT NULL COMMENT '이미지 팝업',
  `check_msg` text NOT NULL COMMENT '점검중이라면 점검 메세지 내용',
  `is_check` int(1) NOT NULL COMMENT '0: 활성화, 1: 점검중',
  KEY `idx` (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 테이블 데이터 tibab.config:1 rows 내보내기
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`idx`, `rating_1`, `rating_2`, `shop_bank_name`, `shop_bank_number`, `shop_bank`, `versionCode`, `main_popup`, `is_main_popup`, `is_img_popup`, `img_popup_src`, `check_msg`, `is_check`) VALUES
	(1, '', '', '', '', '', 0, '', 0, 0, '', '', 0);
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- 테이블 tibab.exchanges 구조 내보내기
CREATE TABLE IF NOT EXISTS `exchanges` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `exchange_id` char(20) NOT NULL DEFAULT '',
  `exchange_name_en` char(255) NOT NULL,
  `exchange_name_ko` char(255) NOT NULL,
  PRIMARY KEY (`idx`),
  UNIQUE KEY `coin_id` (`exchange_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 테이블 데이터 tibab.exchanges:0 rows 내보내기
/*!40000 ALTER TABLE `exchanges` DISABLE KEYS */;
/*!40000 ALTER TABLE `exchanges` ENABLE KEYS */;

-- 테이블 tibab.files 구조 내보내기
CREATE TABLE IF NOT EXISTS `files` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `doc_idx` int(11) NOT NULL,
  `f_name` char(255) NOT NULL,
  `orig_name` char(255) NOT NULL,
  `f_size` double NOT NULL DEFAULT '0',
  `com_idx` int(11) NOT NULL,
  `tag` char(50) NOT NULL,
  `set_idx` int(11) NOT NULL,
  PRIMARY KEY (`idx`),
  KEY `doc_idx` (`doc_idx`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- 테이블 데이터 tibab.files:4 rows 내보내기
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` (`idx`, `doc_idx`, `f_name`, `orig_name`, `f_size`, `com_idx`, `tag`, `set_idx`) VALUES
	(4, 3, '1493805235_2880403378.jpg', '1330.jpg', 121058, 0, '', 0),
	(6, 6, '1493871193_8432036792.jpg', 'housebook myeongdong.jpg', 341698, 0, '', 0),
	(7, 7, '1493874349_4938690600.jpg', 'housebook hongdae.jpg', 379635, 0, '', 0),
	(8, 8, '1500607884_5504833658.jpg', 'gangnam housebook.jpg', 348979, 0, '', 0);
/*!40000 ALTER TABLE `files` ENABLE KEYS */;

-- 테이블 tibab.media 구조 내보내기
CREATE TABLE IF NOT EXISTS `media` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `seq` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `team_id` char(20) NOT NULL DEFAULT '',
  `name_en` char(255) NOT NULL COMMENT '이름영문',
  `name_ko` char(255) NOT NULL COMMENT '이름한글',
  `web_url` char(255) DEFAULT '' COMMENT 'web',
  `nationality` char(255) NOT NULL COMMENT '국적',
  `photo_name` char(255) NOT NULL,
  `photo_ext` char(255) NOT NULL,
  `cat` char(255) NOT NULL,
  `memo` text NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 테이블 데이터 tibab.media:2 rows 내보내기
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` (`idx`, `seq`, `is_active`, `team_id`, `name_en`, `name_ko`, `web_url`, `nationality`, `photo_name`, `photo_ext`, `cat`, `memo`) VALUES
	(40, 0, 1, '', 'sunday', '선데이뉴스', NULL, '', '', 'png', '', '<p>&nbsp;</p>'),
	(41, 0, 1, '', 'mirae', '미래한국', NULL, '', '', 'png', '', '<p>&nbsp;</p>');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;

-- 테이블 tibab.migrations 구조 내보내기
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 테이블 데이터 tibab.migrations:~7 rows (대략적) 내보내기
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(37, '2014_10_12_100000_create_password_resets_table', 1),
	(38, '2017_11_13_000000_create_orders_bitcoin_table', 1),
	(39, '2017_11_13_000000_create_sessions_table', 1),
	(48, '2017_11_13_000000_create_charge_table', 2),
	(49, '2017_11_13_000000_create_user_wallet_table', 2),
	(50, '2017_11_13_000000_create_users_table', 2),
	(51, '2017_11_27_000000_create_user_bank_acc_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- 테이블 tibab.newsletter 구조 내보내기
CREATE TABLE IF NOT EXISTS `newsletter` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `seq` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `name_en` char(255) DEFAULT NULL COMMENT '이름영문',
  `name_ko` char(255) DEFAULT NULL COMMENT '이름한글',
  `email` char(255) NOT NULL COMMENT '직책',
  `memo` text,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 테이블 데이터 tibab.newsletter:5 rows 내보내기
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;
INSERT INTO `newsletter` (`idx`, `seq`, `is_active`, `name_en`, `name_ko`, `email`, `memo`) VALUES
	(44, 0, 1, NULL, NULL, 'email@test.com', NULL),
	(45, 0, 1, NULL, NULL, 'email@test.com', NULL),
	(46, 0, 1, NULL, NULL, 'test2@test.com', NULL),
	(47, 0, 1, NULL, NULL, 'asd@asda.com', NULL),
	(48, 0, 1, NULL, NULL, 'zsdvzsdv@dsgasdg.com', NULL);
/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;

-- 테이블 tibab.partner 구조 내보내기
CREATE TABLE IF NOT EXISTS `partner` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `seq` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `team_id` char(20) NOT NULL DEFAULT '',
  `name_en` char(255) NOT NULL COMMENT '이름영문',
  `name_ko` char(255) NOT NULL COMMENT '이름한글',
  `web_url` char(255) DEFAULT NULL COMMENT 'URL',
  `nationality` char(255) NOT NULL COMMENT '국적',
  `photo_name` char(255) NOT NULL,
  `photo_ext` char(255) NOT NULL,
  `cat` char(255) NOT NULL,
  `memo` text NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 테이블 데이터 tibab.partner:15 rows 내보내기
/*!40000 ALTER TABLE `partner` DISABLE KEYS */;
INSERT INTO `partner` (`idx`, `seq`, `is_active`, `team_id`, `name_en`, `name_ko`, `web_url`, `nationality`, `photo_name`, `photo_ext`, `cat`, `memo`) VALUES
	(29, 1, 1, '', '미래지식경영원', '미래지식경영원', '', '', '', 'png', '', '<p>&nbsp;</p>'),
	(30, 2, 1, '', '서울경영인협회', '서울경영인협회', '', '', '', 'png', '', '<p>&nbsp;</p>'),
	(31, 3, 1, '', '한국창조경영인협회', '한국창조경영인협회', '', '', '', 'png', '', '<p>&nbsp;</p>'),
	(32, 4, 1, '', '한국재능기부협회', '한국재능기부협회', '', '', '', 'png', '', '<p>&nbsp;</p>'),
	(33, 5, 1, '', '세계신지식인협회', '세계신지식인협회', '', '', '', 'png', '', '<p>&nbsp;</p>'),
	(34, 6, 1, '', 'OPPFI', 'OPPFI', '', '', '', 'png', '', '<p>&nbsp;</p>'),
	(35, 7, 1, '', '코인발전소', '코인발전소', '', '', '', 'png', '', '<p>&nbsp;</p>'),
	(36, 8, 1, '', '비트서울', '비트서울', '', '', '', 'png', '', '<p>&nbsp;</p>'),
	(37, 9, 1, '', '블록체인타임즈', '블록체인타임즈', '', '', '', 'png', '', '<p>&nbsp;</p>'),
	(38, 10, 1, '', 'ATUDE', 'ATUDE', '', '', '', 'png', '', '<p>&nbsp;</p>'),
	(39, 11, 1, '', 'SUCON', 'SUCON', '', '', '', 'jpeg', '', '<p>&nbsp;</p>'),
	(40, 12, 1, '', '블록체인투데이', '블록체인투데이', '', '', '', 'png', '', '<p>&nbsp;</p>'),
	(41, 13, 1, '', '철도신문', '철도신문', '', '', '', 'png', '', '<p>&nbsp;</p>'),
	(42, 14, 1, '', 'JNC', 'JNC', '', '', '', 'png', '', '<p>&nbsp;</p>'),
	(43, 15, 1, '', 'Magic Castle Korea', 'Magic Castle Korea', '', '', '', 'png', '', '<p>&nbsp;</p>');
/*!40000 ALTER TABLE `partner` ENABLE KEYS */;

-- 테이블 tibab.password_resets 구조 내보내기
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 테이블 데이터 tibab.password_resets:~0 rows (대략적) 내보내기
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- 테이블 tibab.point_log 구조 내보내기
CREATE TABLE IF NOT EXISTS `point_log` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `member_idx` int(11) NOT NULL,
  `p_take` int(10) NOT NULL COMMENT '추가 포인트',
  `p_give` int(10) NOT NULL COMMENT '감소 포인트',
  `p_result` int(10) NOT NULL COMMENT '결과 포인트',
  `type` enum('CAMPAIGN','EXCHANGE','WITHDRAW','ADMIN','SHOP','RECOMMEND','AD','P2G') NOT NULL,
  `var_text` varchar(255) NOT NULL COMMENT '부가 설명',
  `log_num` int(11) NOT NULL COMMENT '로그 : 숫자(캠페인번호, 거래 번호 등)',
  `ip` char(16) NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`idx`),
  KEY `member_idx` (`member_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=8672 DEFAULT CHARSET=utf8;

-- 테이블 데이터 tibab.point_log:~0 rows (대략적) 내보내기
/*!40000 ALTER TABLE `point_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `point_log` ENABLE KEYS */;

-- 테이블 tibab.popup 구조 내보내기
CREATE TABLE IF NOT EXISTS `popup` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `regiNum` int(10) NOT NULL DEFAULT '0',
  `state` varchar(20) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '0',
  `content` varchar(500) NOT NULL DEFAULT '0',
  `img_1` varchar(255) NOT NULL DEFAULT '0',
  `img_2` varchar(255) NOT NULL DEFAULT '0',
  `img_3` varchar(255) NOT NULL DEFAULT '0',
  `img_4` varchar(255) NOT NULL DEFAULT '0',
  `img_5` varchar(255) NOT NULL DEFAULT '0',
  `img_sub` varchar(255) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 테이블 데이터 tibab.popup:~0 rows (대략적) 내보내기
/*!40000 ALTER TABLE `popup` DISABLE KEYS */;
/*!40000 ALTER TABLE `popup` ENABLE KEYS */;

-- 테이블 tibab.press 구조 내보내기
CREATE TABLE IF NOT EXISTS `press` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `seq` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `team_id` char(20) NOT NULL DEFAULT '',
  `name_en` char(255) NOT NULL COMMENT '이름영문',
  `name_ko` char(255) NOT NULL COMMENT '이름한글',
  `posting_date` char(255) NOT NULL COMMENT '날짜',
  `link_url` char(255) NOT NULL COMMENT '링크',
  `news_title` char(255) NOT NULL COMMENT '제목',
  `photo_name` char(255) NOT NULL,
  `photo_ext` char(255) NOT NULL,
  `cat` char(255) NOT NULL,
  `memo` text NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 테이블 데이터 tibab.press:~10 rows (대략적) 내보내기
/*!40000 ALTER TABLE `press` DISABLE KEYS */;
INSERT INTO `press` (`idx`, `seq`, `is_active`, `team_id`, `name_en`, `name_ko`, `posting_date`, `link_url`, `news_title`, `photo_name`, `photo_ext`, `cat`, `memo`) VALUES
	(44, 100, 1, '', 'sun', 'sun', 'October 16, 2018', 'http://newssunday.co.kr/bbs/board.php?bo_table=news&wr_id=34187', 'TiBAB Project ,구슬함박과 가맹점 MOU 체결', '', 'png', '', '<p>TiBAB Project (회장 박영택)과 구슬함박(대표 김영복)은 10월 11일 구슬함박 본사에서 가맹점 협력을 위한 MOU를 체결했다.​</p>'),
	(45, 200, 1, '', 'mirae', 'mirae', 'October 16, 2018', 'http://www.futurekorea.co.kr/news/articleView.html?idxno=111511', '티밥프로젝트, ㈜동양키친나라와 가맹점 MOU 체결 후 TiBAB PAY 주방용품 사업까지 진출', '', 'png', '', '<p>TiBAB(회장 박영택)과 ㈜동양키친나라(회장 최세규)가 10월 11일 ㈜동양키친나라 사무실에서 전략적 협력을 위한 양해각서(이하 MOU)를 체결했다.  출처 : 미래한국(http://www.futurekorea.co.kr)​</p>'),
	(46, 300, 1, '', 'fn', 'fn', 'October 10, 2018', 'http://www.fntoday.co.kr/news/articleView.html?idxno=170484', '‘티밥(TiBAB) 플랫폼’, 즐거운 쇼핑과 티밥토큰 채굴로 더 많은 혜택을 주는 신개념 멀티블록체인', '', 'png', '', '<p>4차 산업혁명의 빅데이터, 인공지능, 블록체인 혁신 기술을 넘어선 ‘TiBAB’ 오는 오는 10월 \r\n10일(수), 티밥 1차 프라이빗세일을 기점으로 새롭게 선보일 ‘티밥플랫폼’은 이러한 블록체인의 혁신적 기술과 암호화폐의 문제점을\r\n 극복한 ‘하이퍼체인’(더욱 뛰어난)임을 선언했다​</p>'),
	(47, 400, 1, '', 'shin', 'shin', 'October 7, 2018', 'http://www.shinmoongo.net/sub_read.html?uid=120131', '티밥그룹-철도신문, TiBAB 플랫폼 기반 홍보 서비스 인프라 구축 MOU', '', 'png', '', '<p>TiBAB Group(대표 박영택)과 철도신문사(회장 윤재환)는 지난 10월 4일, TiBAB Group 서울 사무소에서 TiBAB 플랫폼 기반 홍보 서비스 구축을 위한 MOU를 체결했다.​</p>'),
	(48, 500, 1, '', 'the', 'the', 'October 7, 2018', 'http://theleader.mt.co.kr/articleView.html?no=2018100710047878254&sec=L0701&pDepth=1&page=1', 'TiBAB그룹 – 오션스타와 전략적 業務협약식 성료', '', 'png', '', '<p>TiBAB Group (대표 박영택)과 오션스타(회장 윤재환)는 10월 4일, TiBAB Group 서울 구로동 사무소에서 전략적 협력을 위한 양해각서(Memorandum of Understanding, MOU)를 체결했다.​</p>'),
	(49, 600, 1, '', 'seoul', 'seoul', 'October 2, 2018', 'http://www.seoulilbo.com/news/articleView.html?idxno=333282', '티밥(TiBAB)-유엔 국제평화재단, 업무협약 체결', '', 'png', '', '<p>실시간 통합 결재플랫폼 프로젝트를 주도하고 있는 티밥(TiBAB)(대표 박영택)과 UN국제평화재단(아시아 총재 김용철)이 지난 28일  TiBAB 프로젝트 성공과 지속가능 발전을 위한 협약을 서울사무소에서 체결했다.​</p>'),
	(50, 700, 1, '', 'sisa', 'sisa', 'October 1, 2018', 'http://www.urinews.co.kr/sub_read.html?uid=42628#09jn', '실시간 결제 블록체인 프로젝트 티밥(TiBAB)-유엔 국제평화재단, 업무협약 체결', '', 'png', '', '<p>실시간 결제가 가능한 블록체인 프로젝트를 진행하는 티밥(TiBAB)(대표 박영택)과 UN국제평화재단(아시아 총재 김용철)이 지난 28일  서울사무소에서 TiBAB 프로젝트 성공과  업무협약을 체결했다.​</p>'),
	(51, 800, 1, '', 'news', 'news', 'October 1, 2018', 'http://www.newsfreezone.co.kr/news/articleView.html?idxno=81803', '유엔 국제평화재단-멀티 블록체인 티밥(TiBAB) , 업무협약 체결', '', 'png', '', '<p>지난 28일 신개념 실물경제의 실시간 통합 결재플랫폼 프로젝트를 주도하고 있는 TiBAB(대표 박영택)과 UN국제평화재단(아시아 총재 김용철)이 TiBAB 프로젝트 성공과 지속가능 발전을 위한 협약을 서울사무소에서 체결했다.​</p>'),
	(52, 900, 1, '', 'the', 'the', 'September 27, 2018', 'http://theleader.mt.co.kr/articleView.html?no=2018092718127876623&sec=L0800&pDepth=L0806&page=1', '박영택 티밥대표, 신개념 실시간 통화결재 ...실물경제 적용 가능', '', 'png', '', '<p>멀티 블록체인 티밥(대표 박영택)이 내놓은 티밥페이(TiBAB PAY)는 암호화폐가 거래소에만 머물지 않고, 스마트폰만 있으면 언제 어디서든 즉시 실시간 결재가 가능하다고 밝혔다. ...​</p>'),
	(53, 1000, 1, '', 'the', 'the', 'September 27, 2018', 'http://theleader.mt.co.kr/articleView.html?no=2018092716187831527&sec=L0800&pDepth=L0806&page=1', '티밥프로젝트, 서울경제연합과 相生 협약식 개최', '', 'png', '', '<p>신개념 실물경제의 실시간 통합 결재플랫폼 프로젝트를 주도하고 있는 티밥(대표 박영택)과 서울경제연합(회장 박희영)이 티밥프로젝트 확장을 위한 협약을 서울경제연합 광화문 사무소에서 지난 20일 체결했다. ..​</p>');
/*!40000 ALTER TABLE `press` ENABLE KEYS */;

-- 테이블 tibab.push 구조 내보내기
CREATE TABLE IF NOT EXISTS `push` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `member_idx` int(11) NOT NULL DEFAULT '0',
  `title` char(255) NOT NULL DEFAULT '',
  `activity` char(255) NOT NULL DEFAULT '',
  `target` char(255) NOT NULL DEFAULT '',
  `memo` char(255) NOT NULL DEFAULT '',
  `img_1` char(255) NOT NULL DEFAULT '',
  `img_2` char(255) NOT NULL DEFAULT '',
  `img_3` char(255) NOT NULL DEFAULT '',
  `img_4` char(255) NOT NULL DEFAULT '',
  `img_5` char(255) NOT NULL DEFAULT '',
  `reg_ts` int(11) NOT NULL,
  `group_idx` int(11) NOT NULL,
  `sender_idx` int(11) NOT NULL,
  `sts` int(11) NOT NULL DEFAULT '0',
  `is_popup` int(11) NOT NULL DEFAULT '0',
  `img_sub` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`idx`),
  KEY `member_idx` (`member_idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 테이블 데이터 tibab.push:~0 rows (대략적) 내보내기
/*!40000 ALTER TABLE `push` DISABLE KEYS */;
/*!40000 ALTER TABLE `push` ENABLE KEYS */;

-- 테이블 tibab.send_history 구조 내보내기
CREATE TABLE IF NOT EXISTS `send_history` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `addr` char(34) NOT NULL DEFAULT '',
  `recv_uid` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL DEFAULT '0',
  `ts` int(11) NOT NULL DEFAULT '0',
  `curr_pair` int(11) NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '0',
  `amount` double NOT NULL DEFAULT '0',
  `send_type` int(11) NOT NULL DEFAULT '0',
  `sender_addr` char(34) NOT NULL DEFAULT '',
  `hide_sender` int(11) NOT NULL DEFAULT '0',
  `hide_recvr` int(11) NOT NULL DEFAULT '0',
  `sts` int(11) NOT NULL DEFAULT '0',
  `is_send` int(11) NOT NULL DEFAULT '0',
  `sender_uid` int(11) NOT NULL DEFAULT '0',
  `site_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idx`),
  KEY `uid` (`uid`),
  KEY `curr_pair` (`curr_pair`),
  KEY `send_type` (`send_type`),
  KEY `recv_uid` (`recv_uid`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 테이블 데이터 tibab.send_history:~0 rows (대략적) 내보내기
/*!40000 ALTER TABLE `send_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `send_history` ENABLE KEYS */;

-- 테이블 tibab.sessions 구조 내보내기
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 테이블 데이터 tibab.sessions:~2 rows (대략적) 내보내기
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('2kwjfPQ4Op4OEMnEuWAuugbtD9Qvoal1M7bfIrnv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiak5yekFZaGRPVEZZQWRCendabDNvYzBiTWcybkxvZHBZMm1teHdPTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9tb25peC5sb2NhbC5wYXRvLm5ldC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1536759601),
	('VIfSplsBJDJGL1Ls3Qavsnc5EPizRafwlGcnTOkb', 4, '192.168.2.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSHhqcVA5Yng2R3NidVJ6Qk80bmp5b0ttdVpsTlp0NWNjeXZoaFlCbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8yMjI5OS5nb3dlYi5rci9leGNoYW5nZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1526599740);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- 테이블 tibab.store 구조 내보내기
CREATE TABLE IF NOT EXISTS `store` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `seq` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `team_id` char(20) NOT NULL DEFAULT '',
  `name_en` char(255) NOT NULL COMMENT '이름영문',
  `name_ko` char(255) NOT NULL COMMENT '이름한글',
  `web_url` char(255) DEFAULT '' COMMENT 'web',
  `nationality` char(255) NOT NULL COMMENT '국적',
  `photo_name` char(255) NOT NULL,
  `photo_ext` char(255) NOT NULL,
  `cat` char(255) NOT NULL,
  `memo` text NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 테이블 데이터 tibab.store:~11 rows (대략적) 내보내기
/*!40000 ALTER TABLE `store` DISABLE KEYS */;
INSERT INTO `store` (`idx`, `seq`, `is_active`, `team_id`, `name_en`, `name_ko`, `web_url`, `nationality`, `photo_name`, `photo_ext`, `cat`, `memo`) VALUES
	(29, 1, 1, '', '체리쉬', '체리쉬', 'http://www.cgagu.com/', '', '', 'png', '', '<p>&nbsp;</p>'),
	(30, 2, 1, '', '돈치킨', '돈치킨', 'http://www.donchicken.co.kr/2018/html/', '', '', 'png', '', '<p>&nbsp;</p>'),
	(31, 3, 1, '', '토프레소', '토프레소', 'http://www.topresso.com/', '', '', 'png', '', '<p>&nbsp;</p>'),
	(32, 4, 1, '', '땡큐맘치킨', '땡큐맘치킨', 'http://www.tkmomck.com/', '', '', 'png', '', '<p>&nbsp;</p>'),
	(33, 5, 1, '', '엔터라인', '엔터라인', 'http://www.enterline.co.kr/', '', '', 'png', '', '<p>&nbsp;</p>'),
	(34, 6, 1, '', '동양키친나라', '동양키친나라', 'http://www.kcnr.co.kr/shop/', '', '', 'png', '', '<p>&nbsp;</p>'),
	(35, 7, 1, '', '오션스타리조트', '오션스타리조트', 'http://www.o-star.kr/m_start3.asp', '', '', 'png', '', '<p>&nbsp;</p>'),
	(36, 8, 1, '', '좋은나라', '좋은나라', 'http://watertowel.com/home/index.asp', '', '', 'png', '', '<p>&nbsp;</p>'),
	(37, 9, 1, '', '이사박사', '이사박사', 'https://www.24박사.com/', '', '', 'png', '', '<p>&nbsp;</p>'),
	(38, 10, 1, '', '고래', '고래', NULL, '', '', 'png', '', '<p>&nbsp;</p>'),
	(39, 11, 1, '', '구슬함박', '구슬함박', 'http://www.gooseulhambak.com/', '', '', 'png', '', '<p>&nbsp;</p>');
/*!40000 ALTER TABLE `store` ENABLE KEYS */;

-- 테이블 tibab.team 구조 내보내기
CREATE TABLE IF NOT EXISTS `team` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `seq` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `team_id` char(20) NOT NULL DEFAULT '',
  `name_en` char(255) NOT NULL COMMENT '이름영문',
  `name_ko` char(255) NOT NULL COMMENT '이름한글',
  `job_position` char(255) NOT NULL COMMENT '직책',
  `nationality` char(255) NOT NULL COMMENT '국적',
  `photo_name` char(255) NOT NULL,
  `photo_ext` char(255) NOT NULL,
  `cat` char(255) NOT NULL,
  `memo` text NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 테이블 데이터 tibab.team:~35 rows (대략적) 내보내기
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` (`idx`, `seq`, `is_active`, `team_id`, `name_en`, `name_ko`, `job_position`, `nationality`, `photo_name`, `photo_ext`, `cat`, `memo`) VALUES
	(11, 1, 1, '', 'YoungTaek Park', '박영택', 'FOUNDER / CEO', '', '', 'png', 'team', '<p>-&nbsp;티밥프로젝트&nbsp;대표</p><p>-&nbsp;세계신지식인협회&nbsp;공동회장</p><p>-&nbsp;동학문화재단&nbsp;이사장</p><p>-&nbsp;대한황토협회&nbsp;회장</p><p>-&nbsp;서울경제연합&nbsp;부회장</p><p>-&nbsp;도전한국인협회&nbsp;부회장</p><p>-&nbsp;민주평통&nbsp;상임위원</p>'),
	(13, 14, 1, '', 'JuYoung Sim', '심주영', 'Engineer', '', '', 'png', 'team', '<p>개발&nbsp;엔지니어</p>'),
	(14, 2, 1, '', 'TaeSoon Kim', '김태순', 'CSO', '', '', 'jpeg', 'team', '<p>​-&nbsp;서울대학교&nbsp;학사</p><p>-&nbsp;LIG&nbsp;손해보험&nbsp;상무</p><p>-&nbsp;티밥프로젝트&nbsp;최고전략책임자</p>'),
	(15, 3, 1, '', 'ShinYong Jo', '조신용', 'COO', '', '', 'jpeg', 'team', '<p>-&nbsp;솔로몬팁건설팅&nbsp;대표</p><p>-&nbsp;(주)KSB스카트가&nbsp;대표</p><p>-&nbsp;KSB스마트&nbsp;방송국&nbsp;본부장</p><p>-&nbsp;전)&nbsp;대한기자협회&nbsp;운영위원</p><p>-&nbsp;전)&nbsp;한국선진문화체육연합&nbsp;위원</p>'),
	(16, 4, 1, '', 'Sam Chung', '정현우', 'Team Leader', '', '', 'png', 'team', '<p>-&nbsp;성균관대&nbsp;철학과&nbsp;졸업</p><p>-&nbsp;중국하북경무대학교&nbsp;경영학&nbsp;석사&nbsp;수료</p><p>-&nbsp;뉴프렉스&nbsp;마켓팅팀</p>'),
	(17, 5, 1, '', 'Belle Ro', 'Belle Ro', 'CCO', '', '', 'jpeg', 'team', '<p>고객지원실장</p>'),
	(18, 6, 1, '', 'DongWan Seo', 'DongWan Seo', 'CMO', '', '', 'jpeg', 'team', '<p>-&nbsp;단국대학교&nbsp;졸업</p><p>-&nbsp;금융수탁업&nbsp;전문경영</p><p>-&nbsp;유사투자자문업&nbsp;지도</p><p>-&nbsp;경영컨설턴트&nbsp;및&nbsp;기업분석가</p><p>-&nbsp;(주)에프피모기지&nbsp;대표</p>'),
	(19, 7, 1, '', 'YoungJI Noh', 'YoungJI Noh', 'Social Marketor', '', '', 'png', 'team', '<p>SNS&nbsp;Manager</p>'),
	(20, 8, 1, '', 'DongUk Lee', 'DongUk Lee', 'Market Survey', '', '', 'jpeg', 'team', '<p>Market&nbsp;Survey&nbsp;&amp;&nbsp;Support​</p>'),
	(21, 9, 1, '', 'HyeRim Sim', 'HyeRim Sim', 'Web Designer', '', '', 'jpeg', 'team', '<p>Web&nbsp;Designer</p>'),
	(22, 10, 1, '', 'doyle kim', 'doyle kim', 'brand value creator', '', '', 'png', 'team', '<p>-&nbsp;중앙대학교&nbsp;공예학과&nbsp;졸업</p><p>-&nbsp;중앙대학교&nbsp;대학원&nbsp;광고전공</p><p>-&nbsp;㈜삼성전자&nbsp;디자인연구소</p><p>-&nbsp;㈜신세계&nbsp;근무</p><p>-&nbsp;한국마사회렛츠런&nbsp;자문위원</p><p>-&nbsp;㈜LUMION&nbsp;고문</p><p>-&nbsp;브랜드밸류&nbsp;크리에이터</p>'),
	(23, 11, 1, '', 'SungDu Hwang', 'SungDu Hwang', 'Designer', '', '', 'png', 'team', '<p>-&nbsp;어린왕자&nbsp;한국&nbsp;특별전&nbsp;참여&nbsp;작가&nbsp;선정</p><p>-&nbsp;현대그룹&nbsp;사보&nbsp;표지작가선정&nbsp;</p><p>-&nbsp;롯데&nbsp;백화점&nbsp;본점&nbsp;:&nbsp;메인&nbsp;디스플레이&nbsp;그래픽&nbsp;제작</p><p>-&nbsp;아모레퍼시픽&nbsp;아이오페&nbsp;:&nbsp;제품&nbsp;패키피&nbsp;패턴&nbsp;콜라보&nbsp;제작</p><p>-&nbsp;그래픽&nbsp;디자이너</p>'),
	(24, 12, 1, '', 'James Corles', 'James Corles', 'Global Leader', '', '', 'jpeg', 'team', '<p>-&nbsp;USA&nbsp;AUBURN&nbsp;UNIVERSITY</p><p>-&nbsp;Global&nbsp;Marketing&nbsp;Manager</p>'),
	(25, 13, 1, '', 'Haiqing Yan', 'Haiqing Yan', 'Marketing Manager', '', '', 'png', 'team', '<p>INTERNATIONAL&nbsp;FASHION&nbsp;ACADEMY&nbsp;in&nbsp;France</p><p>Global&nbsp;Marketing&nbsp;Manager</p>'),
	(26, 15, 1, '', 'HyunJin Jo', 'HyunJin Jo', 'engineer', '', '', 'jpeg', 'team', '<p>System&nbsp;Administrator</p>'),
	(27, 20, 1, '', 'Gerold Falcutela', 'Gerold Falcutela', 'engineer', '', '', 'png', 'team', '<p>STI&nbsp;college&nbsp;Diploma&nbsp;in&nbsp;Information&nbsp;and&nbsp;Communication&nbsp;Technology</p>'),
	(28, 30, 1, '', 'Ralph Patinio', 'Ralph Patinio', 'engineer', '', '', 'png', 'team', '<p>Regis&nbsp;Marie&nbsp;College&nbsp;Bachelor&nbsp;of&nbsp;Science&nbsp;in&nbsp;Computer&nbsp;Science</p>'),
	(29, 1, 1, '', 'HeeYoung Park', 'HeeYoung Park', 'Adviser', '', '', 'jpeg', 'advisor', '<p>-&nbsp;서울경제인연합회&nbsp;회장</p><p>-&nbsp;서울대&nbsp;지식정보위&nbsp;운영이사장</p><p>-&nbsp;전국경제인연합회&nbsp;총동문회장</p><p>-&nbsp;G20청소년미래포럼&nbsp;총재</p><p>-&nbsp;도전한국인협회&nbsp;회장</p><p>-&nbsp;조선일보&nbsp;문화예술포럼&nbsp;원장</p><p>-&nbsp;서울시&nbsp;홍보대사</p>'),
	(30, 2, 1, '', 'HwanMin Ryu', 'HwanMin Ryu', 'Adviser', '', '', 'jpeg', 'advisor', '<p>-&nbsp;서울대학교&nbsp;경제학과</p><p>-&nbsp;영국버밍대학교&nbsp;경제학&nbsp;박사</p><p>-&nbsp;국회기획조정실장</p><p>-&nbsp;국회예산결산특위&nbsp;전문위원</p><p>-&nbsp;국회기획재정위&nbsp;수석전문위원</p><p>-&nbsp;국회사무처&nbsp;의정연수원&nbsp;교수</p>'),
	(31, 3, 1, '', 'MyungEui Song', 'MyungEui Song', 'Adviser', '', '', 'jpeg', 'advisor', '<p>-&nbsp;한국외식산업협동조합&nbsp;이사장</p><p>-&nbsp;서울대학교&nbsp;Ampfri&nbsp;고문</p><p>-&nbsp;서울대학교&nbsp;총동문회&nbsp;종신이사</p><p>-&nbsp;한국외식산업협회&nbsp;수석부회장</p><p>-&nbsp;한국프렌차이즈협회&nbsp;이사</p><p>-&nbsp;㈜고래푸드&nbsp;회장&nbsp;</p>'),
	(32, 4, 1, '', 'SaeGyu Choi', 'SaeGyu Choi', 'Adviser', '', '', 'png', 'advisor', '<p>-&nbsp;한국창조경영인협회&nbsp;회장</p><p>-&nbsp;한국재능기부협회&nbsp;이사장</p><p>-&nbsp;&nbsp;미래지식경영원&nbsp;회장</p><p>-&nbsp;한국프랜차이즈산업협회&nbsp;상임부회장</p><p>-&nbsp;제주특별자치도&nbsp;홍보대사</p><p>-&nbsp;테팔,&nbsp;㈜동양키친나라&nbsp;회장​</p>'),
	(33, 5, 1, '', 'JaeSung Park', 'JaeSung Park', 'Adviser', '', '', 'png', 'advisor', '<p>-&nbsp;캘리포니아주립대&nbsp;MBA(금융)</p><p>-&nbsp;전국경제인연합&nbsp;경영지원실장</p><p>-&nbsp;기협기술금융&nbsp;전무이사</p><p>-&nbsp;금융전문벤처기업&nbsp;인큐베이팅</p><p>-&nbsp;티밥프로젝트&nbsp;금융&nbsp;어드바이저&nbsp;</p>'),
	(34, 6, 1, '', 'SeungJae Choi', 'SeungJae Choi', 'Consultation', '', '', 'jpeg', 'advisor', '<p>-&nbsp;소상공인연합회&nbsp;중앙회장</p><p>-&nbsp;중소상공인희망재단&nbsp;이사장</p><p>-&nbsp;국회&nbsp;국정감사&nbsp;NGO모니터단&nbsp;공동단장</p><p>-&nbsp;동반성장위원회&nbsp;위원</p><p>-&nbsp;중소기업중앙회&nbsp;이사</p><p>-&nbsp;법제처&nbsp;국민법제관</p>'),
	(35, 7, 1, '', 'HoJin Hwang', 'HoJin Hwang', 'Consultation', '', '', 'png', 'advisor', '<p>-&nbsp;1982&nbsp;행정고등고시&nbsp;합격</p><p>-&nbsp;전라북도&nbsp;부교육감&nbsp;역임</p><p>-&nbsp;전)&nbsp;OECD&nbsp;대표부&nbsp;일등서기관</p><p>-&nbsp;서울특별시교육청&nbsp;사무관&nbsp;역임</p><p>-&nbsp;경희대&nbsp;초빙교수​</p>'),
	(36, 8, 1, '', 'YongChul Kim', 'YongChul Kim', 'Consultation', '', '', 'jpeg', 'advisor', '<p>-&nbsp;유엔올로프팔메&nbsp;국제평화재단&nbsp;아시아총재</p><p>-&nbsp;말레이시아&nbsp;백작&nbsp;작위</p><p>-&nbsp;말레이시아&nbsp;혜명그룹&nbsp;회장</p><p>-&nbsp;민주평통&nbsp;말레이시아&nbsp;협의회장&nbsp;</p>'),
	(37, 9, 1, '', 'SuJin Jeong', 'SuJin Jeong', 'Consultation', '', '', 'jpeg', 'advisor', '<p>-&nbsp;연세대&nbsp;경영학박사</p><p>-&nbsp;한국경영교육학회&nbsp;회장</p><p>-&nbsp;한국인적자원개발학회&nbsp;회장</p><p>-&nbsp;제2대&nbsp;송강학원&nbsp;이사장</p><p>-&nbsp;대학국제교류처장</p><p>-&nbsp;고용노동부&nbsp;자문위원​</p>'),
	(38, 10, 1, '', 'JaeHwan Yoon', 'JaeHwan Yoon', 'Consultation', '', '', 'png', 'advisor', '<p>-&nbsp;한국철도신문사&nbsp;회장</p><p>-&nbsp;철도신문&nbsp;·&nbsp;코레일뉴스&nbsp;·&nbsp;레일뉴스&nbsp;발행인</p><p>-&nbsp;세계벨리댄스총연맹&nbsp;총재</p><p>-&nbsp;한국선진문화체육연합&nbsp;명예회장</p><p>-&nbsp;사회적기업학회&nbsp;부회장</p><p>-&nbsp;오션스타리조트&nbsp;회장&nbsp;</p>'),
	(39, 11, 1, '', 'YoungJun Lee', 'YoungJun Lee', 'Consultation', '', '', 'jpeg', 'advisor', '<p>-&nbsp;고려대학교&nbsp;경영학과</p><p>-&nbsp;KT&nbsp;법인사업단장</p><p>-&nbsp;KT&nbsp;상무</p>'),
	(40, 12, 1, '', 'Gijonr Ahn', 'Gijonr Ahn', 'Consultation', '', '', 'jpeg', 'advisor', '<p>-&nbsp;재뉴상공인연합회&nbsp;회장</p><p>-&nbsp;세계한인총연합회&nbsp;수석부회장</p><p>-&nbsp;Goodinfo&nbsp;Holdings&nbsp;Ltd&nbsp;회장</p>'),
	(41, 13, 1, '', 'MiHyang Gang', 'MiHyang Gang', 'Consultation', '', '', 'jpeg', 'advisor', '<p>-&nbsp;미&nbsp;카이로스대학교&nbsp;교수</p><p>-&nbsp;교육학박사</p><p>-&nbsp;Stanton&nbsp;university&nbsp;교학처장</p><p>-&nbsp;대한기자협회&nbsp;어머니기자단&nbsp;중앙단장</p>'),
	(42, 14, 1, '', 'YongTak Lee', 'YongTak Lee', 'Consultation', '', '', 'png', 'advisor', '<p>-&nbsp;연세대학교&nbsp;행정대학원&nbsp;석사</p><p>-&nbsp;SBS&nbsp;보도본부&nbsp;사회부&nbsp;기자</p><p>-&nbsp;JIBS&nbsp;(SBS&nbsp;제주민방)&nbsp;보도제작본부장,&nbsp;앵커</p>'),
	(43, 15, 1, '', 'DaeKwon Kim', 'DaeKwon Kim', 'Consultation', '', '', 'png', 'advisor', '<p>-&nbsp;전)&nbsp;청와대&nbsp;서기관</p><p>-&nbsp;한국외식산업협회&nbsp;상근부회장&nbsp;</p>'),
	(44, 16, 1, '', 'EungMun Kim', 'EungMun Kim', 'Consultation', '', '', 'png', 'advisor', '<p>-&nbsp;에스원&nbsp;재무팀</p><p>-&nbsp;에스원&nbsp;감사팀</p><p>-&nbsp;에스텍시스템&nbsp;경영지원실장</p>'),
	(45, 17, 1, '', 'ManGi Jeong', 'ManGi Jeong', 'Consultation', '', '', 'jpeg', 'advisor', '<p>-&nbsp;한‧러&nbsp;농생명산업&nbsp;자문그룹&nbsp;대표</p><p>-&nbsp;일광기념관&nbsp;관장</p>'),
	(46, 18, 1, '', 'HyunJin Ham', 'HyunJin Ham', 'Consultation', '', '', 'jpeg', 'advisor', '<p>-&nbsp;한국교육마술협회&nbsp;회장</p><p>-&nbsp;열린사이버대학교&nbsp;특임교수</p><p>-&nbsp;아시아&nbsp;매직&nbsp;네트워크&nbsp;한국지부장</p><p>-&nbsp;(사)세계&nbsp;신지식인협회&nbsp;이사</p>');
/*!40000 ALTER TABLE `team` ENABLE KEYS */;

-- 테이블 tibab.users 구조 내보내기
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nick` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bank_bankname` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_accnum` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_accholder` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 테이블 데이터 tibab.users:~27 rows (대략적) 내보내기
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `user_role`, `password`, `name`, `nick`, `lv`, `remember_token`, `created_at`, `updated_at`, `bank_bankname`, `bank_accnum`, `bank_accholder`) VALUES
	(4, '2@2.com', '', '$2y$10$.EKTGBwvRo4JUfA2TIXBmuWPbdo8pBXPHHqeDEPj0xgiEogCiRomy', 'dev', NULL, NULL, 'fc6AqpylGldcD8z6nWSym2yMZVz7imUVJrzbncsxy1WtDiKvyBxAilERdvDt', '2018-03-19 08:55:58', '2018-03-19 08:55:58', NULL, NULL, NULL),
	(5, 'tibabceo@daum.net', 'admin', '$2y$10$.EKTGBwvRo4JUfA2TIXBmuWPbdo8pBXPHHqeDEPj0xgiEogCiRomy', '1', NULL, NULL, 'j5mhh77iiwxTZXFIjgAfmMluNeUdmCTlkCQjRJktNO3YHKcwyRej5wOSusx1', '2018-03-25 14:28:26', '2018-03-25 14:28:26', NULL, NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- 테이블 tibab.user_log 구조 내보내기
CREATE TABLE IF NOT EXISTS `user_log` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `member_idx` int(11) NOT NULL,
  `item_idx` int(11) NOT NULL,
  `action` enum('NO_INSTALL','INSTALL','PREV_INSTALL','RUN','REVIEW','POSTING','DAY','SHARE','TAKE','DAY_INSTALL','SHARE_NONE_PAY','SHARE_ADD_POINT','PLAY_BOUNCE_POINT') NOT NULL COMMENT '행동',
  `act_sub` char(30) NOT NULL,
  `act_num1` int(10) NOT NULL,
  `act_var1` varchar(255) NOT NULL,
  `fit_point` int(10) NOT NULL COMMENT '받을 포인트',
  `is_take` int(1) NOT NULL COMMENT '포인트를 받았는가? 1이면 안받은 경우, 0이면 받은 경우',
  `except` enum('NO','ITEM_STOP','END_TIME','END_NUM') NOT NULL COMMENT '예외(코인 지급 안한 사유)',
  `time` int(10) NOT NULL,
  `ip` char(16) NOT NULL,
  `fit_gmoney` int(11) NOT NULL DEFAULT '0',
  `take_gmoney` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idx`),
  KEY `member_idx` (`member_idx`),
  KEY `item_idx` (`item_idx`),
  KEY `action` (`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 테이블 데이터 tibab.user_log:~0 rows (대략적) 내보내기
/*!40000 ALTER TABLE `user_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_log` ENABLE KEYS */;

-- 테이블 tibab.user_wallet 구조 내보내기
CREATE TABLE IF NOT EXISTS `user_wallet` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '유저 id 와 동일한 값이다.',
  `krw` double NOT NULL,
  `usd` double NOT NULL,
  `btc` double NOT NULL,
  `eth` double NOT NULL,
  `xrp` double NOT NULL,
  `krw_used` double NOT NULL,
  `usd_used` double NOT NULL,
  `btc_used` double NOT NULL,
  `eth_used` double NOT NULL,
  `xrp_used` double NOT NULL,
  `ts` int(11) NOT NULL,
  `update_cnt` int(11) NOT NULL COMMENT '락 구현용 select시 기억후 업데이트조건에 포함 맞지않으면 재계산',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 테이블 데이터 tibab.user_wallet:~0 rows (대략적) 내보내기
/*!40000 ALTER TABLE `user_wallet` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_wallet` ENABLE KEYS */;

-- 테이블 tibab.wallet_log 구조 내보내기
CREATE TABLE IF NOT EXISTS `wallet_log` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `coin_idx` int(11) NOT NULL DEFAULT '0' COMMENT 'coins.idx',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT 'users.id',
  `is_coin` int(11) NOT NULL DEFAULT '0',
  `coin_from` char(34) NOT NULL DEFAULT '',
  `coin_to` char(34) NOT NULL DEFAULT '',
  `price` double NOT NULL DEFAULT '0',
  `amount` double NOT NULL DEFAULT '0',
  `send_type` int(11) NOT NULL DEFAULT '0',
  `send_result` char(200) NOT NULL DEFAULT '',
  `sts` int(11) NOT NULL DEFAULT '0' COMMENT 'status',
  `ts` int(11) NOT NULL DEFAULT '0' COMMENT 'timestamp',
  PRIMARY KEY (`idx`),
  UNIQUE KEY `coin_id_user_id` (`coin_idx`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 테이블 데이터 tibab.wallet_log:~0 rows (대략적) 내보내기
/*!40000 ALTER TABLE `wallet_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `wallet_log` ENABLE KEYS */;

-- 테이블 tibab.withdrawal_history 구조 내보내기
CREATE TABLE IF NOT EXISTS `withdrawal_history` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `ts` int(11) NOT NULL DEFAULT '0',
  `curr_pair` int(11) NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '0',
  `amount` double NOT NULL DEFAULT '0',
  `bank` char(200) DEFAULT '',
  `account` char(200) DEFAULT '',
  `name` char(200) DEFAULT '',
  `sts` int(11) NOT NULL DEFAULT '0',
  `end_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idx`),
  KEY `uid` (`uid`),
  KEY `curr_pair` (`curr_pair`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 테이블 데이터 tibab.withdrawal_history:~0 rows (대략적) 내보내기
/*!40000 ALTER TABLE `withdrawal_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `withdrawal_history` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

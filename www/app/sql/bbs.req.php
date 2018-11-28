<?
$q = "create table board_{$bbs_id} (
				file_idx int not null default 0,

				start_date int not null,
				end_date int not null,

				link1 char(255) not null,
				link2 char(255) not null,
				rcpt char(20) not null,

				post_type enum('add','change','debug','idea','bug'),
				prog_per int not null,

				idx int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				bbs_id int(11),
				bbs_name varchar(20),
				bbs_subject varchar(200),
				bbs_content longtext,
				bbs_writer varchar(100),
				bbs_regtt int(11),
				bbs_file varchar(200),
				bbs_hit int(11) NOT NULL default 0,
				bbs_comment_tot int(11) NOT NULL default 0,
				bbs_vote_up int(11) NOT NULL default 0,
				bbs_vote_down int(11) NOT NULL default 0,
				main_view int(11) NOT NULL default 0,
				cat	varchar(20) NOT NULL,
				cat0 varchar(20) NOT NULL,
				sts enum('OK','READY','STOP','DECL') NOT NULL default 'READY',
				user_id char(20) NOT NULL default 0,
				file_count int(11) NOT NULL default 0,
				file_totsize double NOT NULL default 0,
				
				cat_idx0 int(11) NOT NULL default 0,
				cat_idx int(11) NOT NULL default 0,
				adult_cont enum('Y','N'),

				gold int not null default 0,
				is_hide int not null default 0,
				is_confirm int not null default 0,
				priority int not null default 0,
				useridx_worked int not null default 0

) default charset=utf8";

?>
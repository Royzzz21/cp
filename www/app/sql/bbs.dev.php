<?
		$q = "create table board_{$bbs_id} (
				`idx` int(11) NOT NULL AUTO_INCREMENT,
				`file_idx` int(11) NOT NULL DEFAULT '0',
				`start_date` int(11) NOT NULL,
				`end_date` int(11) NOT NULL,
				`link1` char(255) NOT NULL,
				`link2` char(255) NOT NULL,
				`rcpt` char(20) NOT NULL,
				`post_type` enum('add','change','debug','idea','bug') DEFAULT NULL,
				`prog_per` int(11) NOT NULL,
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
				`user_id` char(20) NOT NULL DEFAULT '0',
				`file_count` int(11) NOT NULL DEFAULT '0',
				`file_totsize` double NOT NULL DEFAULT '0',
				`cat_idx0` int(11) NOT NULL DEFAULT '0',
				`cat_idx` int(11) NOT NULL DEFAULT '0',
				`adult_cont` enum('Y','N') DEFAULT NULL,
				`gold` int(11) NOT NULL DEFAULT '0',
				`is_hide` int(11) NOT NULL DEFAULT '0',
				`is_confirm` int(11) NOT NULL DEFAULT '0',
				`useridx_worked` int(11) NOT NULL DEFAULT '0',
				`priority` int(11) NOT NULL DEFAULT '0',
				`sts` enum('OK','READY','STOP','DECL') NOT NULL DEFAULT 'READY',

				PRIMARY KEY (`idx`),
				KEY `is_hide` (`is_hide`),
				KEY `is_hide_2` (`is_hide`),
				KEY `priority` (`priority`)


			) default charset=utf8";

?>
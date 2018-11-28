<?php
 	$sFileInfo = '';
	$headers = array();
	 
	foreach($_SERVER as $k => $v) {
		if(substr($k, 0, 9) == "HTTP_FILE") {
			$k = substr(strtolower($k), 5);
			$headers[$k] = $v;
		} 
	}
	
	$file = new stdClass;
	$file->name = str_replace("\0", "", rawurldecode($headers['file_name']));


	$filename_ext = strtolower(array_pop(explode('.',$file->name)));

	$wdate = date('Ymd_His_',time());	// 포멧 지정하여 시간값 저장
	$ExtractFileName = (explode('.',$file->name));	// 파일명만 추출
	$ExtractFileName[0] = $wdate.uniqid();	// 시간값(추후 게시글 타임싱크 편의성고려) + 유니크 아이디로 파일명 생성(긴파일이름 및 한글문제 탈피)
	$file->name = $ExtractFileName[0].".".$filename_ext;	// 생성된 파일명 과 확장자를 다시 변수에 삽입


	$file->size = $headers['file_size'];
	$file->content = file_get_contents("php://input");
	
	


	$allow_file = array("jpg", "png", "bmp", "gif"); 
	
	if(!in_array($filename_ext, $allow_file)) {
		echo "NOTALLOW_".$file->name;
	} else {
		$uploadDir = '../../upload/';
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}
		
		$newPath = $uploadDir.iconv("utf-8", "cp949", $file->name);
		
		if(file_put_contents($newPath, $file->content)) {
			$sFileInfo .= "&bNewLine=true";
			$sFileInfo .= "&sFileName=".$file->name;
			$sFileInfo .= "&sFileURL=/nse/upload/".$file->name;
		}
		
		echo $sFileInfo;
	}
?>
<?php
// default redirection
$url = $_REQUEST["callback"].'?callback_func='.$_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

// SUCCESSFUL
if(bSuccessUpload) {
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$name = $_FILES['Filedata']['name'];

	$filename_ext = strtolower(array_pop(explode('.',$name)));

	$wdate = date('Ymd_His_',time());	// 포멧 지정하여 시간값 저장
	$ExtractFileName = (explode('.',$name));	// 파일명만 추출
	$ExtractFileName[0] = $wdate.uniqid();	// 시간값(추후 게시글 타임싱크 편의성고려) + 유니크 아이디로 파일명 생성(긴파일이름 및 한글문제 탈피)
	$name = $ExtractFileName[0].".".$filename_ext;	// 생성된 파일명 과 확장자를 다시 변수에 삽입	

	$allow_file = array("jpg", "png", "bmp", "gif");


	if(!in_array($filename_ext, $allow_file)) {
		$url .= '&errstr='.$name;
	}

	else {
		$uploadDir = '../../upload/';
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}
		
		$newPath = $uploadDir.$name;
		
		@move_uploaded_file($tmp_name, $newPath);
		
		$url .= "&bNewLine=true";
		$url .= "&sFileName=".urlencode($name);
		$url .= "&sFileURL=/nse/upload/".$name;
	}

}
// FAILED
else {
	$url .= '&errstr=error';
}
	
header('Location: '. $url);
?>
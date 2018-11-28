{{--@php ($layout_file = "layouts.admin.app")--}}
<?php
if(glo()->is_admin_page){
	$layout_file='layouts.admin.app';
}
else {
	$layout_file='layouts.coin.sub';

}
?>
@extends($layout_file)
@section('content')

    <section class="content">
        <div class="clearfix">
            {{--<div class="aboutus-top">
                   <h2 class="font-30">정보2</h2>
            </div>--}}
            <div>

            </div>
            <div>

                <div id='content_bbs' style="">


                    <script>

                        function fwrite_check(is_onsubmit){
                            //alert('a');
                            var f=document.fwrite;

                            // 전송을 해도 되나 체크
                            // 값이 있으면 전송
                            if(f.bbs_subject.value==''){
                                alert('제목을 입력해주세요.');
                                //editor_wr_ok();
                                return false;
                            }

                            //f.wr_content.value = myeditor.outputBodyHTML();
                            //alert(f.wr_content.value);

                            //alert(f.wr_content.value);
                            //f.wr_content.value=geditor.get_content();

                            oEditors.getById["wr_content"].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용됩니다.

                            if (is_onsubmit) {
                                return true;
                            }

                            f.submit();

                        }


                    </script>

                    <form action="<?=$req_path2?>/write_ok" id="fwrite" name="fwrite" onsubmit="return fwrite_check(1)" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <input type='hidden' id='mode' name='mode'  value='<? if($mode){echo $mode;} ?>' />
                        <input type='hidden' id='idx' name='idx'  value='<? if($idx){echo $idx;} ?>' />

                        <div>
                            <h2>
								<?=$write_title?>
                            </h2>
                        </div>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="037bd9" bgcolor="037bd9" style="border:1px solid #dddddd;">
                            <tr>
                                <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

                                        <input type=hidden name=selected_cat value="<?php

										if(isset($cat_id) && $cat_id){
											echo $cat_id;
										}
										else {
											if($rows){
												echo $rows->cat;
											}
										}

										?>">

                                        <tr>
                                            <td>

                                                <!-- 상태/타입/제목 -->
                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#a5c9dc"
                                                       bgcolor="#C3C3C3">
                                                    <tr>
                                                        <td>

                                                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"
                                                                   bgcolor="#FFFFFF">

                                                                <tr>
                                                                    <td width="100" height="35" align="center" bgcolor="#EFEFEF" style="font-size:12px;">
                                                                        <strong>Subject</strong>
                                                                    </td>
                                                                    <td height="35" style="padding-left:5px;">
                                                                        <input type='text' id='bbs_subject'
                                                                               name='bbs_subject'
                                                                               value='<?php if($rows){echo $rows->bbs_subject; } ?>'
                                                                               onkeydown="if(event.keycode==9)alert('tab');"
                                                                               style="width:80%;height:25px;line-height:25px;border:1px solid #bebebe;outline-style:none;padding:0;margin:0"
                                                                               AUTOCOMPLETE="OFF"/>
                                                                    </td>
                                                                </tr>



                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td height="77">

                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#a5c9dc" bgcolor="#a5c9dc">
                                                    <tr>
                                                        <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

                                                                <tr bgcolor="effaff">
                                                                    <td width="100%" align="center" bgcolor="#FFFFFF">

                                                                  <textarea id="wr_content" name="wr_content" class="gray_txt"
                                                                            style="FONT-SIZE: 12px;background-color:#FFFFFF;min-width:260px;height:300px;width:100%;"
                                                                            rows=15 itemname="내용"
                                                                            required><?php if($rows){echo $rows->bbs_content;} ?></textarea>


                                                                        <script type="text/javascript" src="/nse/js/HuskyEZCreator.js"
                                                                                charset="utf-8"></script>

                                                                        <script type="text/javascript">
                                                                            var oEditors = [];
                                                                            nhn.husky.EZCreator.createInIFrame({
                                                                                oAppRef: oEditors,
                                                                                elPlaceHolder: "wr_content",
                                                                                sSkinURI: "/nse/SmartEditor2Skin.html",
                                                                                fCreator: "createSEditor2"
                                                                            });
                                                                            function submitContents(elClickedObj) {
                                                                                //oEditors.getById["wr_content"].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용됩니다.
                                                                                // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.

                                                                                try {
                                                                                    //elClickedObj.form.submit();
                                                                                } catch (e) {
                                                                                }
                                                                            }
                                                                        </script>


                                                                    </td>
                                                                </tr>
                                                            </table></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>


                                        <!-- 파일추가 -->
                                        <tr>
                                            <td>

                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#a5c9dc" bgcolor="#C3C3C3">

													<?php
													if($edit_mode){
													?>
                                                    <tr>
                                                        <td>
                                                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                                                <tr>
                                                                    <td width="100" height="35" align="center" bgcolor="effaff"><strong>업로드된 파일</strong></td>
                                                                    <td  height="35" style="padding-left:5px;">
																		<?php


																		if($idx){
																		$file_all=get_files_all($bbs_id,$idx);

																		// 파일이 있습니다.
																		if($file_all){
																		foreach($file_all as $k=>$file_data){
																		$img_url="/files/{$bbs_id}/".$file_data->f_name;

																		?>
                                                                        <div>
                                                                            <a href="/files/<?=$bbs_id?>/<?= $file_data->f_name ?>"
                                                                               target="_blank"><?= $file_data->orig_name ?></a>&nbsp;
                                                                            <input type=checkbox name="deletefile[]"
                                                                                   value="<?= $file_data->idx ?>"
                                                                                   id="uploaded_<?= $k ?>"><label
                                                                                    for="uploaded_<?= $k ?>">삭제</label>
                                                                        </div>
																		<?php
																		}
																		}
																		}

																		?>
                                                                    </td>
                                                                </tr>

                                                            </table>
                                                        </td>
                                                    </tr>
													<?php } ?>


                                                    <tr>
                                                        <td>

                                                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                                                <tr>
                                                                    <td width="100" height="35" align="center" valign=top bgcolor="#EFEFEF">
                                                                        <div style="padding:10px;font-size:12px;">
                                                                            <strong>file </strong>
                                                                            <br />
                                                                            <span class="button small"><a onclick="more_file();" role="button" class="btn btn-primary btn-sm btn-dark" >add</a></span>
                                                                        </div>
                                                                    </td>
                                                                    <td height="35" style="padding-left:5px;">
                                                                        <div id='upload_div'>
                                                                            <input type=file name="uploadfile_0">
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            <script>
                                                                var uploadfile_idx=0;
                                                                $(document).ready(function(){

                                                                    more_file();
                                                                    more_file();
                                                                    more_file();
                                                                    more_file();
                                                                    more_file();

                                                                });

                                                            </script>

                                                        </td>
                                                    </tr>
                                                </table>

                                            </td>
                                        </tr>

                                        <!-- 버튼-->

                                        <tr>
                                            <td style="padding-top:15px;">

                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td align="center">


                                                            <a href="javascript:void(fwrite_check());" role="button" class="btn btn-primary btn-sm btn-dark" >저장</a>
                                                            <a href="javascript:location.href='<?=$req_path2?>/list?page=<?=$page?>';" role="button" class="btn btn-primary btn-sm btn-dark" >취소</a>



                                                        </td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table>

                    </form>

                    <script>
                        // 파일추가
                        function more_file(){
                            uploadfile_idx++;
                            document.getElementById('upload_div').innerHTML+='<br><input type=file name="uploadfile_'+uploadfile_idx+'">';
                        }
                    </script>

                    <div style="clear:both;"></div>
                    <br />


                </div>




            </div>
        </div>
    </section>
@endsection
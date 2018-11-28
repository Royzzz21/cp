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
                            if(f.project_id.value==''){
                                alert('project_id');
                                //editor_wr_ok();
                                return false;
                            }
                            if(f.project_name.value==''){
                                alert('project_name');
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
                            <h2 style="padding-top:10px;padding-bottom:10px;">
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
                                                       bgcolor="">
                                                    <tr>
                                                        <td style="padding:10px;">

                                                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"
                                                                   bgcolor="#FFFFFF">

                                                                <tr>
                                                                    <td width="100" align="center" bgcolor="" style="font-size:12px;">
                                                                        <strong>Project ID *</strong>
                                                                    </td>
                                                                    <td style="padding-left:5px;">
                                                                        <input type='text' id='project_id'
                                                                               name='project_id'
                                                                               value='<?php if($rows){echo $rows->project_id; } ?>'
                                                                               onkeydown="if(event.keycode==9)alert('tab');"
                                                                               style="width:200px;height:25px;line-height:25px;border:1px solid #bebebe;outline-style:none;padding:0;margin:0"
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
                                            <td>

                                                <!-- 상태/타입/제목 -->
                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#a5c9dc"
                                                       bgcolor="">
                                                    <tr>
                                                        <td style="padding:10px;">

                                                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"
                                                                   bgcolor="#FFFFFF">

                                                                <tr>
                                                                    <td width="100" align="center" bgcolor="" style="font-size:12px;">
                                                                        <strong>Project Name *</strong>
                                                                    </td>
                                                                    <td style="padding-left:5px;">
                                                                        <input type='text' id='project_name'
                                                                               name='project_name'
                                                                               value='<?php if($rows){echo $rows->project_name; } ?>'
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
                                            <td>

                                                <!-- 상태/타입/제목 -->
                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#a5c9dc"
                                                       bgcolor="">
                                                    <tr>
                                                        <td style="padding:10px;">

                                                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"
                                                                   bgcolor="#FFFFFF">

                                                                <tr>
                                                                    <td width="100" align="center" bgcolor="" style="font-size:12px;">
                                                                        <strong>Project Status*</strong>
                                                                    </td>
                                                                    <td style="padding-left:5px;">
                                                                        <input type='text' id='project_status'
                                                                               name='project_name'
                                                                               value='<?php if($rows){echo $rows->project_name; } ?>'
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
                                            <td>

                                                <!-- 상태/타입/제목 -->
                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#a5c9dc"
                                                       bgcolor="">
                                                    <tr>
                                                        <td style="padding:10px;">

                                                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"
                                                                   bgcolor="#FFFFFF">

                                                                <tr>
                                                                    <td width="100" align="center" bgcolor="" style="font-size:12px;">
                                                                        <strong>Starting Date *</strong>
                                                                    </td>
                                                                    <td style="padding-left:5px;">
                                                                        <input class="form-control" id="starting_date" name="starting_date" placeholder="MM/DD/YYY" type="text"/>
                                                                        <script>
                                                                            <?php if($mode=='update'){ ?>

                                                                            $('#starting_date').val('<?php
                                                                                $starting_ts=get_obj_val($rows,'start_date');
                                                                                if($starting_ts){
                                                                                    echo date('m/d/Y',$starting_ts);
                                                                                }
                                                                                ?>');

                                                                            $('#ending_date').val('<?php
                                                                                $ending_ts=get_obj_val($rows,'end_date');
                                                                                if($ending_ts){
                                                                                    echo date('m/d/Y',$ending_ts);
                                                                                }
                                                                                ?>');

                                                                            $('#task_progress').val('<?=get_obj_val($rows,'task_progress')?>');
                                                                            $('#assign_to').val('<?=get_obj_val($rows,'assign_to')?>');
                                                                            <?php } ?>
                                                                        </script>
                                                                    </td>
                                                                </tr>
                                                                <script>
                                                                    $(document).ready(function() {
                                                                        // var date_input=$('input[name="date"]'); //our date input has the name "date"
                                                                        var date_input1=$('#starting_date'); //our date input has the name "date"
                                                                        var date_input2=$('#ending_date'); //our date input has the name "date"
                                                                        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                                                                        var options={
                                                                            format: 'mm/dd/yyyy',
                                                                            container: container,
                                                                            todayHighlight: true,
                                                                            autoclose: true,
                                                                        };

                                                                        date_input1.datepicker(options);
                                                                        date_input2.datepicker(options);
                                                                    })
                                                                </script>

                                                            </table>
                                                        </td>

                                                        <td style="padding:10px;">

                                                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"
                                                                   bgcolor="#FFFFFF">

                                                                <tr>
                                                                    <td width="100" align="center" bgcolor="" style="font-size:12px;">
                                                                        <strong>Ending Date *</strong>
                                                                    </td>
                                                                    <td style="padding-left:5px;">
                                                                        <input class="form-control" id="ending_date" name="ending_date" placeholder="MM/DD/YYY" type="text"/>
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

                                                                    // more_file();

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
                                                            <a href="javascript:void(fwrite_check());" role="button" class="btn btn-primary btn-sm btn-dark" >create</a>
                                                            <a href="javascript:location.href='<?=$req_path2?>/list?page=<?=$page?>';" role="button" class="btn btn-primary btn-sm btn-dark" >cancel</a>
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

        <script>
            <?php if($mode=='update'){ ?>

            $('#starting_date').val('<?php
                $starting_ts=get_obj_val($rows,'starting_date');
                if($starting_ts){
                    echo date('m/d/Y',$starting_ts);
                }
                ?>');

            $('#ending_date').val('<?php
                $ending_ts=get_obj_val($rows,'ending_date');
                if($ending_ts){
                    echo date('m/d/Y',$ending_ts);
                }
                ?>');

            $('#task_progress').val('<?=get_obj_val($rows,'task_progress')?>');
            $('#assign_to').val('<?=get_obj_val($rows,'assign_to')?>');
            <?php } ?>

            $(document).ready(function() {
                // var date_input=$('input[name="date"]'); //our date input has the name "date"
                var date_input1=$('#starting_date'); //our date input has the name "date"
                var date_input2=$('#ending_date'); //our date input has the name "date"
                var options={
                    format: 'mm/dd/yyyy',
                    container: container,
                    todayHighlight: true,
                    autoclose: true,
                };

                date_input1.datepicker(options);
                date_input2.datepicker(options);
            })
        </script>

    </section>
@endsection
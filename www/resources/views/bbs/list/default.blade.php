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
    <style>
        .bbs_table th,td {
            padding:10px;
        }
    </style>

    <section class="content">
        <div class="clearfix">
            <div>

            </div>
            <div>

                <div id='content_bbs' style="">


                    <script>
                        function form_chk() {
                            var frm = document.search_form;
                            if (frm.search_box.value == "") {
                                alert('검색어를 입력하세요');
                                return false;
                            }
                            else {
                                return true;
                            }
                        }
                    </script>


                    <style>
                        .col_header {
                            height: 24px;
                            color: black;
                            font-weight: bold;
                            font-size: 11px;
                            font-family: dotum;
                            background-color: white;
                            border-bottom: 1px solid #dddddd;
                        }
                    </style>

                    <script>
                        var total_faq_cnt=<?=count($list_info)?>;

                        function close_all_faq(){
                            for(var i=0;i<total_faq_cnt;i++){
                                $('#faq_tr_'+i).hide();

                            }
                        }
                        function faq(num){
                            close_all_faq();
                            $('#faq_tr_'+num).show();

                        }
                    </script>
					<?php

					//                    $no = ($page*$list_row_limit);

					//페이지 변수가 없을땐 페이지는 1이다
					//					if(!$page){
					//						$page=1;
					//					}

					$s=($page-1)*$list_row_limit; // 시작번호
					$tot=count($list_info);
					$no=$tot-$s; // 가상 번호

					?>

                    <table id='bbs_table' class="table-bordered" border=1 cellspacing='0' cellpadding='0' width=100% style="padding:0 !important;;border:1px solid #d5d5d5;">
                        <!--
                        <colgroup>
                            <col size="10%" />
                            <col />
                            <col size="20%" />
                            <col />

                        </colgroup>
                        -->
                        <tr>
                            <th style="width:10%;padding:10px;">no.</th>
                            <th style="width:50%;text-align:center;">title</th>
                            <th style="width:10%;text-align:center;">posted by</th>
                            <th style="width:10%;text-align:center;">date</th>

                        </tr>
					<?php
					foreach($list_info as $row){

					$reg_time = $row->bbs_regtt;

					?>

                    <!-- 제목 -->
                        <tr>
                            <td style="font-size:12px;background-color:#FFFFFF;padding:10px;font-weight:bold;">
								<?=$no?>
                            </td>
                            <td style="font-size:12px;background-color:#FFFFFF;padding:10px;font-weight:bold;">
                                <a href="view?idx=<?=$row->idx?>"><?=$row->bbs_subject?></a>
                            </td>
                            <td style="font-size:12px;background-color:#FFFFFF;padding:10px;font-weight:bold;text-align:center;">
								<?=$row->bbs_writer?>
                            </td>
                            <td style="font-size:12px;background-color:#FFFFFF;padding:10px;font-weight:bold;text-align:center;">
								<?=date($_CFG['default_date_format'],$reg_time)?>
                            </td>
                        <!--
                                <td>

                                    <?php if($is_admin){ ?>
                                <div class="buttons"
                                     style="text-align:right;background-color:white;white-space: nowrap;">
                                    <a onclick="location.href='<?=$req_path2;?>?idx=<?=$row->idx?>"
                                           title="수정하기" class="normal-btn small1" style=""><em>수정하기</em></a>
                                        <a onclick="if(confirm('정말 삭제하시겠습니까?')){location.href='<?=$req_path2;?>/delete?idx=<?=$row->idx?>&a=del_process&bbs_writer=<?=$row->bbs_name;?>&page=<?=$page?>&id=<?=$bbs_id;?>';}"
                                           class="normal-btn small1" style=""><em>삭제하기</em></a>
                                    </div>
                                    <?php } ?>

                                </td>
                                -->
                        </tr>
						<?php
						$no = $no - 1;
						}
						?>



                    </table>


                    <style>
                        @media (max-width: 2000px) {
                            .divcont img {
                                display: inline-block;
                                width: auto \9 !important; /* ie8 */
                                width: auto !important;
                                max-width: 100%;
                                min-width: 100%;
                                height: auto !important;
                            }
                        }
                    </style>

                    <table border=0 cellspacing='0' cellpadding='7' width=100% height=25 style="padding-top:20px;">

                        <tr>
                            <td width=100>
                                <a href="list?page=<?=$page?>" role="button"  class="btn btn-primary btn-sm ladda-button" data-style="expand-right" data-size="l" style="float:;"><em>list</em></a>
                            </td>
                            <td colspan='3' align='center'>
								<?php
								//echo $pagelink;
								//echo $pg->getPage();
								?>
                            </td>
                            <td align='right' width=100>
								<? if($write_priv){ ?>
                                <a href="write" role="button" class="btn btn-primary btn-sm btn-dark" style="float:;"><em>post</em></a>
								<? } ?>
                            </td>
                        </tr>
                    </table>

                <!-- 검색
                    <div id='search' align='center'>
                        <form id='search_form' name='search_form' method='GET' action=<?=$req_path2;?> onsubmit="return
                              form_chk();
                        ">
                        <input type='hidden' id='page' name='page' value='<?=$page?>'/>
                        <input type='hidden' id='id' name='id' value='<?=$bbs_id;?>'/>
                        <input type='hidden' id='search_mode' name='search_mode' value='1'/>
                        <input type='text' id='search_box' name='search_box' style="height:24px;"/>

                        <a onclick="document.getElementById('search_form').submit();" class="normal-btn small1"
                           style="float:;"><em>Search</em></a>
                        </form>
                    </div>
                    -->

                    <!-- 불펌방지 코드 시작 -->
                    <script type="text/javascript">
                        var omitformtags = ["input", "textarea", "select"]
                        omitformtags = omitformtags.join("|")

                        function disableselect(e) {
                            if (omitformtags.indexOf(e.target.tagName.toLowerCase()) == -1)
                                return false
                        }

                        function reEnable() {
                            return true
                        }

                        if (typeof document.onselectstart != "undefined")
                            document.onselectstart = new Function("return false")
                        else {
                            document.onmousedown = disableselect
                            document.onmouseup = reEnable
                        }
                    </script>
                    <!-- 불펌방지 코드 종료 -->

                </div>

            </div>
        </div>
    </section>
@endsection
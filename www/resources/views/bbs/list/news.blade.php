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


                        {{--<tr>--}}
                            {{--<th style="width:10%;padding:10px;">번호</th>--}}
                            {{--<th style="width:50%;text-align:center;">제목</th>--}}
                            {{--<th style="width:10%;text-align:center;">작성자</th>--}}
                            {{--<th style="width:10%;text-align:center;">날짜</th>--}}

                        {{--</tr>--}}
					<?php
					foreach($list_info as $row){
						$file_cnt=get_file_cnt($bbs_id,$row->idx);
                        $img_url='';
						if($file_cnt){
							$file_all=get_files_all($bbs_id,$row->idx);
//							print_r($file_all);

                            // 파일이 있습니다.
                            if($file_all){
                            	$img_url="/files/{$bbs_id}/".$file_all[0]->f_name;
							}
						}
                        $reg_time = $row->bbs_regtt;

					?>

                    <!-- 제목 -->
                            <div class="well">
                                <div class="media">
                                    <a class="pull-left" href="view?idx=<?=$row->idx?>">
                                        <? if($img_url){ ?>
                                            <img src="<?=$img_url?>" style="max-height:200px;width:300px;border:1px solid #eeeeee;" />
                                        <? } else { ?>
                                            <img src="/img/news-default-300×200.png" style="max-height:200px;width:300px;border:1px solid #eeeeee;" />
                                        <? } ?>
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading" style="font-size:25px;font-weight:bolder;"><a href="view?idx=<?=$row->idx?>"><?=$row->bbs_subject?></a></h4>
                                            <p class="text-right">By <?=$row->bbs_writer?></p>
                                            <p class="text-right"><span><i class="glyphicon glyphicon-calendar"></i><?=date($_CFG['default_date_format'],$reg_time)?></span></p>
                                            <p><?=strcut_utf8(strip_tags($row->bbs_content),300,'...')?></p>
                                     </div>
                                </div>
                            </div>


                            <?php
						    $no = $no - 1;
						}
						?>






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
                                <a href="list?page=<?=$page?>" role="button"  class="btn btn-primary btn-sm ladda-button" data-style="expand-right" data-size="l" style="float:;"><em>목록</em></a>
                            </td>
                            <td colspan='3' align='center'>
								<?php
								//echo $pagelink;
								//echo $pg->getPage();
								?>
                            </td>
                            <td align='right' width=100>
								<? if($write_priv){ ?>
                                <a href="write" role="button" class="btn btn-primary btn-sm btn-dark" style="float:;"><em>글쓰기</em></a>
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

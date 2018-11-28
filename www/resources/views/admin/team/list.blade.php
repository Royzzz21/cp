@extends('layouts.admin.app')
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
                        function form_chk(){
                            var frm = document.search_form;
                            if(frm.search_box.value==""){
                                alert('검색어를 입력하세요');
                                return false;
                            }
                            else{
                                return true;
                            }

                        }
                    </script>

                    <style>
                        .col_header {
                            height:24px;
                            color:black;
                            font-weight:bold;
                            font-size:11px;
                            font-family:dotum;
                            background-color:white;
                            border-bottom:1px solid #dddddd;
                        }
                    </style>




                    <table id='bbs_table' class="boardList cBlue" border=0 cellspacing='0' cellpadding='7' width="100%" style="border:1px solid #dddddd;margin-bottom:10px;">
                        <tr>
                            <td>
                                <table class="sorted_table table-bordered" border=0 cellspacing='0' cellpadding='0' width=100% style="table-layout:fixed;border-top:1px solid #EFEFEF;">

                                    <!-- 제목 -->
                                    <thead>
                                        <tr>
                                            <th style="font-size:13px;background-color:#FFFFFF;padding:10px;font-weight:bold;">
                                                출력순서
                                            </th>
                                            <th >사진</th>
                                            <th >성명</th>
                                            <th >영문 성명</th>
                                            <th >직책</th>
                                            <th >설명</th>
                                            <th >등록일자</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php

                                    $no=0;

                                    foreach($list_info as $row){

                                    ?>
                                    <!-- 제목 -->
                                        <tr>
                                            <td style="font-size:13px;background-color:#FFFFFF;padding:10px;font-weight:bold;">
                                                <input type="text" class="list_order_value" name="seq.<?=$row->idx?>" value="<?=$row->seq?>" size="4"> <span style="float:right;"></span>
                                            </td>
                                            <td ><?
                                                if($row->photo_ext){
                                                    ?>
                                                    <img src="/photo/team_photo/<?=$row->idx?>.<?=$row->photo_ext?>" style="width:100px;" />
                                                    <?
                                                }

                                                ?></td>
                                            <td ><?=$row->name_ko?></td>
                                            <td ><?=$row->name_en?></td>
                                            <td ><?=$row->job_position?></td>
                                            <td style="word-break: break-all;">
                                                <?=nl2br(strip_tags(str_replace('</p>',"</p>\n",$row->memo)))?>

                                            </td>
                                            <td >
                                                <a onclick="location.href='add?idx=<?=$row->idx?>&mode=modify&a=write&id=<?;?>&page=<?=$page?>'" title="수정하기" class="normal-btn small1" style=""><em>수정하기</em></a>
                                                <a onclick="if(confirm('정말 삭제하시겠습니까?')){location.href='delete?idx=<?=$row->idx?>&a=del_process&page=<?=$page?>&id=<?;?>';}" class="normal-btn small1" style=""><em>삭제하기</em></a>
                                            </td>
                                        </tr>

                                        <?
                                        $no=$no-1;
                                    }
                                    ?>

                                    </tbody>


                                </table>

                            </td>
                        </tr>
                    </table>

<script>
    //---------------------------------- 줄 순서 변경기능 활성화
    // Sortable rows
    $('.sorted_table').sortable({
        containerSelector: 'table',
        itemPath: '> tbody',
        itemSelector: 'tr',
        placeholder: '<tr class="placeholder"/>'
    });

    // Sortable column heads
    var oldIndex;
    $('.sorted_head tr').sortable({
        containerSelector: 'tr',
        itemSelector: 'th',
        placeholder: '<th class="placeholder"/>',
        vertical: false,
        onDragStart: function ($item, container, _super) {
            oldIndex = $item.index();
            $item.appendTo($item.parent());
            _super($item, container);
        },
        onDrop: function  ($item, container, _super) {
            var field,
                newIndex = $item.index();

            if(newIndex != oldIndex) {
                $item.closest('table').find('tbody tr').each(function (i, row) {
                    row = $(row);
                    if(newIndex < oldIndex) {
                        row.children().eq(newIndex).before(row.children()[oldIndex]);
                    } else if (newIndex > oldIndex) {
                        row.children().eq(newIndex).after(row.children()[oldIndex]);
                    }
                });
            }

            _super($item, container);
        }
    });

    // --------------------------- 출력순서 번호 지정.
    // submit form update listring order
    function save_list_order(){
        var req_json={};
        $('.list_order_value').each(function (){
            // console.log($(this).val())
            var name=$(this).attr("name");
            var arr=name.split(".");
            req_json[arr[1]]=$(this).val();

        });

        $('#new_order_val').val(JSON.stringify(req_json));

        // console.log(req_json);
        $('#update_form').submit();

    }
</script>

                    <style>
                        @media (max-width: 2000px) {.divcont img {display:inline-block; width:auto\9 !important; /* ie8 */ width:auto !important; max-width:100%; min-width:100%; height:auto !important;}}

                    </style>


                    <!-- 출력순서 변경 -->
                    <form id="update_form" method="post" action="update_order">
                        {{ csrf_field() }}

                        <input type="hidden" id="new_order_val" name="new_order_val">
                    </form>

                    <table border=0 cellspacing='0' cellpadding='7' width=100% height=25 style="padding-top:20px;">

                        <tr>
                            <td width=100>
                                <!--<span class="button black small">-->
                                <a href='list?page=<?=$page?>' class="normal-btn small1" style="float:;"><em>목록</em></a>
                                | <a href='#' onclick="save_list_order();" class="normal-btn small1" style="float:;"><em>순서 저장</em></a>
                            </td>
                            <td colspan='3' align='center'>
                                <?
                                //echo $pagelink;
                                //echo $pg->getPage();
                                ?>
                            </td>
                            <td align='right' width=100>
                                <? if($is_admin){ ?>
                                <a href="add" class="normal-btn small1" style="float:;"><em>추가</em></a>
                                <? } ?>


                            </td>
                        </tr>
                    </table>







                    <!-- 검색 -->



                    <!-- 불펌방지 코드 시작 -->
                    <script type="text/javascript">
                        var omitformtags=["input", "textarea", "select"]
                        omitformtags=omitformtags.join("|")
                        function disableselect(e){
                            if (omitformtags.indexOf(e.target.tagName.toLowerCase())==-1)
                                return false
                        }
                        function reEnable(){
                            return true
                        }
                        if (typeof document.onselectstart!="undefined")
                            document.onselectstart=new Function ("return false")
                        else{
                            document.onmousedown=disableselect
                            document.onmouseup=reEnable
                        }
                    </script>
                    <!-- 불펌방지 코드 종료 -->


                </div>




            </div>
        </div>
    </section>
@endsection
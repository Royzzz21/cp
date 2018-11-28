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
        .bbs_table th {
            width:20%;
        }
    </style>
    <div class="xans-element- xans-board xans-board-read-1002 xans-board-read xans-board-1002"><div class="boardView ">
            <table class="bbs_table table-bordered" border="1" summary="" style="width:100%;">
                <tbody>
                <tr>
                    <th scope="row">제목</th>
                    <td><?=$row->bbs_subject?></td>
                </tr>
                <tr>
                    <th scope="row">작성자</th>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">작성일</th>
                    <td><?=date($_CFG['default_date_format'], $row->bbs_regtt)?></td>
                </tr>
                {{--<tr class="grade displaynone">--}}
                    {{--<th scope="row">평점</th>--}}
                    {{--<td><img src="http://img.echosting.cafe24.com/skin/base_ko_KR/board/ico_point0.gif" alt="0점"></td>--}}
                {{--</tr>--}}
                <tr class="view">
                    <td colspan="2">
                        <div class="detail" style="min-height:300px;"><?=$row->bbs_content;?></div>
                    </td>
                </tr>
                <tr class="attach displaynone">
                    <th scope="row">첨부파일</th>
                    <td></td>
                </tr>
                {{--<tr class="">
                    <th scope="row">비밀번호</th>
                    <td><input id="password" name="password" fw-filter="" fw-label="비밀번호" fw-msg="" onkeydown="if (event.keyCode == 13 || event.which == 13) { return false; }" value="" type="password"> <span class="info"> <img src="http://img.echosting.cafe24.com/skin/base_ko_KR/board/ico_warning.gif" alt=""> 삭제하려면 비밀번호를 입력하세요.</span>
                    </td>
                </tr>--}}
                </tbody>
            </table>
        </div>

        <div class="btnArea" style="margin-top:10px;">
            <a href="list" role="button" class="btn btn-primary btn-sm btn-dark" style="float:left;">목록</a>
            <a href="delete?idx=<?=$row->idx?>" role="button" class="btn btn-primary btn-sm btn-dark" style="float:right;">삭제</a>
            <a href="modify?idx=<?=$row->idx?>" role="button" class="btn btn-primary btn-sm btn-dark" style="float:right;margin-right:10px;">수정</a>
            {{--<div role="button" class="btn btn-primary btn-sm btn-dark">답변</div>--}}

        </div>
    </div>


@endsection
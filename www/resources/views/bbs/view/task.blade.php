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
                    <th scope="row">Task id</th>
                    <td><?=$row->idx?></td>
                </tr>

                <tr>
                    <th scope="row">Project id</th>
                    <td><?=$row->project_id?></td>
                </tr>

                <tr>
                    <th scope="row">Task name</th>
                    <td><?=$row->task_name?></td>
                </tr>

                <tr>
                    <th scope="row">date</th>
                    <td><?=date($_CFG['default_date_format'], $row->bbs_regtt)?></td>
                </tr>

                <tr>
                    <th scope="row">assignee history</th>
                    <td>we can see assignee changing history and time</td>
                </tr>
                <tr>
                    <th scope="row">estimated time</th>
                    <td>estimated by assignee</td>
                </tr>

                <tr>
                    <th scope="row">spent time</th>
                    <td>time spent</td>
                </tr>

                <tr>
                    <th scope="row">started at</th>
                    <td>we can see when assignee started</td>
                </tr>


                {{--<tr class="grade displaynone">--}}
                    {{--<th scope="row">평점</th>--}}
                    {{--<td><img src="http://img.echosting.cafe24.com/skin/base_ko_KR/board/ico_point0.gif" alt="0점"></td>--}}
                {{--</tr>--}}
                <tr class="view">
                    <td colspan="2">
                        <div class="detail" style="min-height:300px;"><?=$row->task_note;?></div>
                    </td>
                </tr>
                <tr class="attach displaynone">
                    <th scope="row">Files</th>
                    <td>

                        <div>

							<?php

							$file_all=get_files_all($bbs_id,$row->idx);

							// 파일이 있습니다.
							if($file_all){
                                foreach($file_all as $k=>$v){
                                    $img_url="/files/{$bbs_id}/".$v->f_name;

                                    ?>
                                    <div><img src="<?=$img_url?>" style="max-width:100%;" /></div>
                                    <?php
                                }
							}


							?>
                        </div>


                    </td>
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
            <a href="list" role="button" class="btn btn-primary btn-sm btn-dark" style="float:left;">List</a>
			<?php if($write_priv){ ?>
            <a href="delete?idx=<?=$row->idx?>" role="button" class="btn btn-primary btn-sm btn-dark" style="float:right;">delete</a>
            <a href="modify?idx=<?=$row->idx?>" role="button" class="btn btn-primary btn-sm btn-dark" style="float:right;margin-right:10px;">edit</a>
            <?php }?>
            {{--<div role="button" class="btn btn-primary btn-sm btn-dark">답변</div>--}}

        </div>
    </div>


@endsection
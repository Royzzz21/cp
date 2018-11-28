{{--@php ($layout_file = "layouts.admin.app")--}}
<?php
if(glo()->is_admin_page){
    $layout_file='layouts.admin.app';
}
else {
    $layout_file='layouts.coin.sub';

}
?>

<style>
    .tibab-title{
        color: #2dabd3;
        display: block;
        font-size: 25px;
        font-weight: 700;
    }
    .tibab-line{
        margin: 0;
        margin-top: 15px !important;
        border: 1px solid #2dabd3;
    }
    .star{
        color: #2dabd3;
    }
    .text-detail{
        color: #4b4b4b;
        margin-top: 15px;
    }
    .register-title{
        color: #000;
        font-weight: bold;
        font-size:20px;
        padding-left: 15px;
        margin-top: 50px;
        margin-bottom: 50px;
        border-left: 3px solid #2dabd3;
    }
    .form-control{
        margin-top: 15px;
        margin-bottom: 15px;
    }
    .store_company_cert{
        resize: none !important;
    }
    .tibab-style{
        text-align: center;
        padding-top: 50px;
    }
    .button-styles{
        margin-top: 50px;
        text-align: center !important;
    }
    .button-styles a:link,
    .button-styles a:visited{
        padding: 20px 0;
        color: #fff;
        width: 220px;
        text-decoration: none;
        font-weight: bold;
        text-align: center;
        display: inline-block;
        margin-right: 35px;
    }
    .form-group{
        width: 100%;
        height: auto;
        white-space: nowrap;
        border-top: 1px solid #cecece;
    }
    .label-form{
        width: 200px;
        background-color: #F7F7F7;
        padding: 25px 25px 25px 10px;
        margin-right: 45px;
    }
    .input-style{
        max-width: 580px;
        height: 35px;
    }
    .images-holder{
        display: inline-block;
        width: auto;
        height: auto;
        margin-left: 250px;
    }
    .images-holder img{
        margin-top: 15px;
        margin-bottom: 15px;
    }
    .text-detail-1{
        display: inline-block;
        margin-top: 15px;
        margin-left: 45px;
    }
    .text-group{
        display: inline-block;
        position: absolute;
    }
    .label-group{
        position: absolute;
        display: inline-block;
        padding-bottom: 230px !important;
    }
    .label-form-1{
        width: 200px;
        background-color: #F7F7F7;
        padding: 25px 25px 108px 10px;
        margin-right: 45px;
    }
    .label-form-2{
        width: 200px;
        background-color: #F7F7F7;
        padding: 25px 25px 273px 10px;
        margin-right: 45px;
    }
    .progress{

    }
</style>

@extends($layout_file)
@section('content')
    <?php

    // if set
    //        if($rows){
    //        	$row_arr=(array)$rows;
    //		}
    // not set
    //		else {
    //        	$row_arr=[
    //        		'project_id'=>'',
    //        		'task_name'=>'',
    //        		'task_period'=>'',
    //        		'assign_to'=>'',
    //        		'task_progress'=>'',
    //            ];
    //		}

    ?>
    <section class="content">
        <div class="">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="tibab-title">Add New Task</h3>
                    <hr class="tibab-line">
                    <p class="text-detail"><span class="star">*</span> Please write your request</p>

                    <p class="register-title">task details</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <form id="form_task_reg" method="post" class="form-inline" action="write_ok" enctype="multipart/form-data" autocomplete="off">
                        {{ csrf_field() }}
                        <input type='hidden' id='mode' name='mode'  value='<? if($mode){echo $mode;} ?>' />
                        <input type='hidden' id='idx' name='idx'  value='<? if($idx){echo $idx;} ?>' />

                        {{--checkbox--}}
                        {{--<input type="checkbox" id="chkbox_1" name="chkbox_1" value="1" class="checkbox-tibab text-center"> <!--<span class="checkmark"></span>--> <label for="chkbox_1"> ????</label>--}}


                        <div class="form-group">
                            <label for="exampleInputName2" class="label-form">project *</label>
                            <select id="project_id" name="project_id" class="form-control" size="5" style="min-width:300px;">
                                <?php
                                $project_list=get_project_list();
                                foreach($project_list as $k=>$v){
                                ?>
                                <option value="<?=$v->project_id?>"><?=$v->project_name?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputName2" class="label-form">parent task(optional)</label>
                            <select id="parent_task_idx" name="parent_task_idx" class="form-control" size="5" style="min-width:300px;">
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputName2" class="label-form">task name *</label>
                            <input type="text" class="form-control input-style" id="task_name" name="task_name" value="<?=get_obj_val($rows,'task_name')?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName2" class="label-form">Period</label>

                            Starting date: <input class="form-control" id="starting_date" name="starting_date" placeholder="MM/DD/YYY" type="text"/>
                            &amp;
                            Ending date: <input class="form-control" id="ending_date" name="ending_date" placeholder="MM/DD/YYY" type="text"/>
                            <p class="text-detail-1"><span class="star">*</span></p>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputName2" class="label-form">task progress *</label>
                            <select class="form-control input-style" id="task_progress" name="task_progress">
                                <?php for($i=0;$i<100;$i+=10){ ?>
                                <option value="<?=$i?>"><?=$i?>%</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName2" class="label-form">task type</label>
                            <select class="form-control input-style" id="task_type" name="task_type">
                                <option>bug fix</option>
                                <option>design</option>
                                <option>fatal error</option>
                                <option>others</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName2" class="label-form">priority</label>
                            <select class="form-control input-style" id="task_priority" name="task_priority">
                                <option>normal</option>
                                <option>urgent</option>
                                <option>VIP</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName2" class="label-form">assign to</label>
                            <select name="assign_to" id="assign_to" class="form-control">
                                <?php
                                $member_list= get_member_list();
                                foreach($member_list as $k=>$v){
                                ?>
                                <option value="<?=$v->id?>"><?=$v->name?></option>
                                <?php
                                }
                                ?>
                            </select>

                        <!--
                            <input type="text" class="form-control input-style" id="assign_to" name="assign_to" value="<?=get_obj_val($rows,'assign_to')?>"> (list of members)
                            -->
                        </div>


                        <div class="form-group" style="height: 315px;">
                            <label for="exampleInputName2" class="label-form-2">task notes</label>
                            <textarea name="task_note" style="position: absolute; align-content:center; overflow:auto;" id="task_note" cols="40" rows="13" class="form-control">
                                <?=get_obj_val($rows,'task_note')?>
                            </textarea>
                        </div>

                        <div class="form-group" style="height: 150px;">
                            <div class="label-group">
                                <label for="exampleInputName2" class="label-form-1">issue image1</label>
                            </div>
                            <div class="images-holder">
                                <img id="preview_img1" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="" style="border:1px solid #dddddd;width:230px;height:115px;">
                            </div>
                            <p class="text-detail-1"><span class="star">*</span>
                                <br>
                                <input type="file" id="input_img" name="uploadfile_0" value="upload">
                            </p>
                        </div>

                        <div class="form-group" style="height: 315px;">
                            <div class="label-group">
                                <label for="exampleInputName2" class="label-form-2">other files</label>
                            </div>
                            <div class="images-holder">
                                <img id="preview_img2" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="" style="border:1px solid #dddddd;width:230px;height:285px;">
                            </div>
                            <div class="text-group">
                                <p class="text-detail-1"><span class="star">*</span>
                                    <br>
                                    {{--<a href="#" class="primary-button">UPLOAD</a>--}}
                                    <input type="file" id="input_img2" name="uploadfile_1" value="upload">
                                </p>
                            </div>
                        </div>


                        <div class="form-group text-center tibab-style">
                            <div class="col-sm-12 button-styles ">
                                <a href="javascript:void(post_task());" role="button" style="background-color: #2dabd3;">Post</a>
                                <a href="javascript:location.href='list';" role="button" style="background-color: #cecece;">cancel</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>




        <script>
            function post_task(){
                /*
                // check checkbox
                if($("input:checkbox[id='chkbox_1']").is(":checked")==false){
                    alert('주의사항에 동의하시는 경우 체크박스에 체크 후 다시한번 버튼을 눌러 주십시오.');
                    return;
                }
                */

                // if($("#store_name").val()==''){
                //     alert('상호명은 필수 입력 항목입니다.');
                //     return;
                // }
                //
                // if($("#store_reg_num").val()==''){
                //     alert('사업자 등록번호는 필수 입력 항목입니다.');
                //     return;
                // }
                //
                // if($("#store_owner_name").val()==''){
                //     alert('대표자 성명은 필수 입력 항목입니다.');
                //     return;
                // }
                //
                // if($("#store_phone_num").val()==''){
                //     alert('대표 번호는 필수 입력 항목입니다.');
                //     return;
                // }


                $('#form_task_reg').submit();


            }

            var sel_file;


            function handleImgFileSelect(e) {
                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);

                filesArr.forEach(function(f) {
                    if(!f.type.match("image.*")) {
                        alert("확장자는 이미지 확장자만 가능합니다.");
                        return;
                    }

                    sel_file = f;

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("#preview_img1").attr("src", e.target.result);
                    }
                    reader.readAsDataURL(f);
                });
            }

            function handleImgFileSelect2(e) {
                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);

                filesArr.forEach(function(f) {
                    if(!f.type.match("image.*")) {
                        alert("확장자는 이미지 확장자만 가능합니다.");
                        return;
                    }

                    sel_file = f;

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("#preview_img2").attr("src", e.target.result);
                    }
                    reader.readAsDataURL(f);
                });
            }

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



            $('#project_id').val('<?=get_obj_val($rows,'project_id')?>');
            update_parent_task_selector(true);

            $('#task_progress').val('<?=get_obj_val($rows,'task_progress')?>');
            $('#task_type').val('<?=get_obj_val($rows,'task_type')?>');
            $('#task_priority').val('<?=get_obj_val($rows,'task_priority')?>');
            $('#assign_to').val('<?=get_obj_val($rows,'assign_to')?>');
            <?php } ?>

            // if is_init is true, please set default option selected
            function update_parent_task_selector(is_init){
                var sel_project_id=$('#project_id').val();
                if(sel_project_id!='') {
                    // alert(sel_project_id);
                    // load_task_list(sel_project_id);

                    var curr_task_idx=$('#idx').val();
                    // alert(curr_task_idx);

                    $.ajax({

                        url:'/task/getTaskList.json?project_id='+sel_project_id,
                        type:'get',

                        // data:$('form').serialize(),
                        success:function(data){
                            var json_data=JSON.parse(data);

                            // console.log(data.length);
                            // console.log(data);

                            // $('#time').text(data);

                            $('#parent_task_idx').empty()

                            for(var i=0;i<json_data.length;i++){
                                // alert(data[i].task_name);
                                if(json_data[i].idx!=curr_task_idx) {
                                    $('#parent_task_idx').append($('<option>', {
                                        value: json_data[i].idx,
                                        text: '' + json_data[i].task_name
                                    }));
                                }
                            }

                            // set selected option
                            $('#parent_task_idx').val('<?=get_obj_val($rows,'parent_task_idx')?>');

                        }
                    })

                }
            }

            $(document).ready(function() {

                $("#project_id" ).change(function() {
                    //alert( "Handler for .change() called." );
                    update_parent_task_selector(false);
                });

                $("#input_img").on("change", handleImgFileSelect);
                $("#input_img2").on("change", handleImgFileSelect2);

                // });
                //
                // $(document).ready(function(){

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


    </section>
@endsection{{--@php ($layout_file = "layouts.admin.app")--}}

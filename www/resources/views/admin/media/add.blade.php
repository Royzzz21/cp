@extends('layouts.admin.app')
@section('content')

<section class="content">  
  <div class="clearfix">
      <div>
          <div id='content_bbs' style="">
              <script>

                  function fwrite_check(is_onsubmit){
                      //alert('a');
                      var f=document.fwrite;

                      // 전송을 해도 되나 체크
                      // 값이 있으면 전송
                      // if(f.coin_id.value==''){
                      //     alert('id를 입력해주세요.');
                      //     return false;
                      // }

                      //f.wr_content.value = myeditor.outputBodyHTML();
                      //alert(f.wr_content.value);
                      //alert(f.wr_content.value);
                      //f.wr_content.value=geditor.get_content();

                      oEditors.getById["wr_content"].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용됩니다.
                      //
                      if (is_onsubmit) {
                          return true;
                      }

                      f.submit();

                  }


              </script>

              <form action="add_ok" id="fwrite" name="fwrite" onsubmit="return fwrite_check(1)" enctype="multipart/form-data" method="POST">
                  {{ csrf_field() }}
                  <input type='hidden' id='mode' name='mode'  value='<? if(isset($mode)){echo $mode;} ?>' />
                  <input type='hidden' id='idx' name='idx'  value='<? if(isset($idx)){echo $idx;} ?>' />

                  <div>
                      <br><br>
                      <p>
                          미디어 추가
                      </p>
                  </div>
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="037bd9" bgcolor="037bd9" style="border:1px solid #dddddd;">
                      <tr>
                          <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">


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
                                                              <td width="100" height="35" align="center"
                                                                  bgcolor="#EFEFEF" style="font-size:12px;">
                                                                  <strong>이름(영문)</strong>
                                                              </td>
                                                              <td height="35" style="padding-left:5px;">
                                                                  <input type='text' id='name_en'
                                                                         name='name_en'
                                                                         value="<? if (isset($rows)) {
                                                                             echo $rows->name_en;
                                                                         } ?>"
                                                                         style="width:200px;height:25px;line-height:25px;border:1px solid #bebebe;outline-style:none;padding:0;margin:0"
                                                                         AUTOCOMPLETE="OFF" />
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td width="100" height="35" align="center"
                                                                  bgcolor="#EFEFEF" style="font-size:12px;">
                                                                  <strong>이름(한글)</strong>
                                                              </td>
                                                              <td height="35" style="padding-left:5px;">
                                                                  <input type='text' id='name_ko'
                                                                         name='name_ko'
                                                                         value="<? if (isset($rows)) {
                                                                             echo $rows->name_ko;
                                                                         } ?>"

                                                                         style="width:200px;height:25px;line-height:25px;border:1px solid #bebebe;outline-style:none;padding:0;margin:0"
                                                                         AUTOCOMPLETE="OFF" />
                                                              </td>
                                                          </tr>


                                                          <tr>
                                                              <td width="100" height="35" align="center"
                                                                  bgcolor="#EFEFEF" style="font-size:12px;">
                                                                  <strong>URL</strong>
                                                              </td>
                                                              <td height="35" style="padding-left:5px;">
                                                                  <input type='text' id='web_url' name='web_url'
                                                                         value="<? if (isset($rows)) {
                                                                             echo $rows->web_url;
                                                                         } ?>"

                                                                         style="width:200px;height:25px;line-height:25px;border:1px solid #bebebe;outline-style:none;padding:0;margin:0"
                                                                         AUTOCOMPLETE="OFF"/>
                                                              </td>
                                                          </tr>


                                                          <tr>
                                                              <td width="100" height="35" align="center"
                                                                  bgcolor="#EFEFEF" style="font-size:12px;">
                                                                  <strong>사진</strong>
                                                              </td>
                                                              <td height="35" style="padding-left:5px;">
                                                                  <input type=file name="photo1">
                                                              </td>
                                                          </tr>


                                                      </table>
                                                  </td>
                                              </tr>
                                          </table>

                                      </td>
                                  </tr>

                                  <tr>
                                      <td height="77" align="left">

                                          <table border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#a5c9dc" bgcolor="#a5c9dc">
                                              <tr>
                                                  <td><table border="0" align="center" cellpadding="0" cellspacing="0">

                                                          <tr bgcolor="effaff">
                                                              <td align="center" bgcolor="#FFFFFF">


							<textarea id="wr_content" name="memo" class="gray_txt"
                                      style="FONT-SIZE: 12px;background-color:#FFFFFF;min-width:300px;height:100px;width:100%;"
                                      rows=15 itemname="설명"
                                      required><? if(isset($rows)){echo $rows->memo;} ?></textarea>


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

                                  <!-- 버튼-->
                                  <tr>
                                      <td style="padding-top:15px;">
                                          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr>
                                                  <td align="center">
                                                      <a href="javascript:void(fwrite_check());" class="normal-btn small1" style=""><em>저장</em></a>
                                                      <a href="javascript:location.href='list?page=<?=$page?>';" class="normal-btn small1" style=""><em>취소</em></a>
                                                  </td>
                                              </tr>
                                          </table>
                                      </td>
                                  </tr>

                              </table></td>
                      </tr>
                  </table>

              </form>

              <script>
                  // 파일추가
                  function more_file(){
                      document.getElementById('upload_div').innerHTML+='<br><input type=file name="uploadfile[]">';
                  }
              </script>



              <div style="clear:both;"></div>
              <br />


          </div>




      </div>
  </div>  
</section>
@endsection
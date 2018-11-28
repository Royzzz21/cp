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

     <div>

     </div>
      <div>
            삭제되었습니다.


            <table align="center">
                <tr>

                    <td>
                        <a href="<?=$move_url?>/list">리스트로 이동</a>

                    </td>
                </tr>

            </table>
      </div>
  </div>  
</section>
@endsection











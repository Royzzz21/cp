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
            <div class="aboutus-top">
                <h2 class="font-30">ERROR</h2>
            </div>
            <div>

            </div>
            <div>
                <br>
                sorry. error occurred
                <br><br>

                <?


                    // 에러메시지 지정되어있으면 출력한다
                if(isset($error_msg)){
                    echo $error_msg;


                }

                ?>
<br>
<br><br>


                <table>
                    <tr>

                        <td>
                            <a href="/">lets go main</a>

                        </td>
                    </tr>

                </table>
            </div>
        </div>
    </section>
@endsection
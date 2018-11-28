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
<section>
    <div>
            등록되었습니다
    </div>

            <table align="center">
                <tr>

                    <td>


                        <a href="list">리스트로 이동</a>

                    </td>
                </tr>

            </table>

</section>
@endsection
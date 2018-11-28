@extends('layouts.admin.app')

@section('content')
    <div class="container">
<br><br>

        <p>Member</p>

<script>
    function save_user_password(user_id){
        var new_val=$('#newpw_'+user_id).val();
        if(new_val==''){
            alert('암호를 입력해주십시오.');
            return;
        }
        //alert(new_val);
        location.href='/admin/member/updatePassword?user_id='+user_id+'&new_pw='+new_val;
    }
</script>
        <div class="col-12">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>New Password</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($users)> 0)
                            {{ session('status') }}
                            @foreach($users as $user )

                                <tr>
                                    <td><a href="#">{{$user->name}}</a></td>
                                    <td><a href="#">{{$user->email}}</a></td>
                                    <td><a href="#"></a></td>
                                    <td>
                                        <input type="text" id="newpw_<?=$user->id?>" value="" placeholder="New Password">
                                        <a href="#" onclick="if(confirm('정말로 변경하겠습니까?')){save_user_password('<?=$user->id?>');}" >Update</a></td>
                                    <td><a href="#">Edit</a> | <a href="#" onclick="if(confirm('정말로 삭제하겠습니까?')){del_user('<?=$user->id?>');}" >Delete</a> </td>
                                </tr>

                                {{--  {!!Form::open(['action' => ['AdminMemberController@destroy', $user->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                  {{Form::hidden('_method', 'DELETE')}}
                                  {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                  {!!Form::close()!!}--}}


                            @endforeach

                        @else
                            <p>No posts found</p>
                        @endif
                        </tbody>
                    </table>


                </div>
            </div>

            <table align="center">
                <tr><td>
                        <div class="row justify-content-center ">
                            {{$users->links()}}
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>


@endsection

<?php

namespace App\Http\Controllers;


use Illuminate\Database\Query\Builder;
use App\User;
use App\Post;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AdminMemberController extends Controller
{
    // 인증체크
    private function auth()
    {

        // 로그인이 되어있으면.
        if(glo()->get_auth_data() && glo()->is_admin()) {
//            $this->shared_data = glo()->wallet_obj->wallet_data;
        }
        // 로그인이 안되어있으면 로그인페이지로 이동한다.
        else {
            header("Location: /login");
            exit;

        }

    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->auth();
        $users = User::orderBy('id', 'desc')->paginate(5);
        return view('admin.member.list')->with('users', $users);


    }
    public function updatePassword(Request $req)
    {
        $this->auth();

//        echo 1;exit;
        $user_id=$req->input("user_id");
        $new_pw=$req->input("new_pw");
        $new_pw=trim($new_pw);

//        echo $new_pass;exit;
//        echo $user_id;exit;

        $new_pass = Hash::make($new_pw);

        DB::update("update users set password=? where id=?",[$new_pass,$user_id]);
//        $users = User::orderBy('id', 'desc')->paginate(5);
//        return view('admin.member.list')->with('users', $users);

        return redirect('/admin/member');



    }
    public function destroy($id){
        $this->auth();

        $users = User::find($id);
        $post = Post::find($id);

        $post->delete();
        $users->delete();
        return redirect('/admin/member')->with('success', 'Post Removed');

    }
}

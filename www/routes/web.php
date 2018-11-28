<?php

require_once __DIR__.'/../app/Config.lib.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// index
Route::get('/', 'IndexCon@index');

// chat
Route::get('chat', 'ChatCon@index');

// Route::get('publish', function () {
    // // Route logic...
    // Redis::publish('test-channel', json_encode(['foo' => 'bar']));
// });


// Route::resource('board/{bo_id}/board', 'BBS 컨트롤러');


// 거래소
Route::get('/exchange', 'ExchangeCon@overview');
Route::get('/exchange/{base_id}/{quote_id}', 'ExchangeCon@run')->name('exchange.get');
Route::post('/exchange/{base_id}/{quote_id}', 'ExchangeCon@run')->name('exchange.post');



// about
Route::get('/about', function () {
//    return view('_pages/aboutus');
});

// faq
Route::get('/faq', function () {
    return view('_pages/faq');
});


//// guide
//Route::get('/guide', function () {
//    return view('_pages/guide');
//});

// 이용약관
// Route::get('/terms', function () {
    // return view('_terms/basic');
	// // return view('AdminBSBMaterialDesign/index');
// });
//// 이용약관 : 기본약관
//Route::get('/terms', function () {
//    return view('_pages/terms');
//	// return view('AdminBSBMaterialDesign/index');
//});
//Route::get('/terms/basic', function () {
//    return view('_pages/terms');
//	// return view('AdminBSBMaterialDesign/index');
//});
//// 이용약관 : 개인정보처리방침
//Route::get('/terms/privacy', function () {
//    return view('_pages/privacy');
//	// return view('AdminBSBMaterialDesign/index');
//});
//
//// 지갑
//Route::get('/wallet', function () {
//    return view('_pages/wallet');
//});


// Route::get('auth/login', function(){
   // $credentials = [
        // 'email' => 'asdf@b.c',
       // 'password' => 'qwer1234#'
    // ];

    // if(!auth()->attempt($credentials)){
        // return '로그인 정보가 정확하지 않습니다.';
    // }

    // return redirect('protected');

// });

// Route::get('protected', function(){
   // dump(session()->all());

    // if(! auth()->check()){
        // return '누구세요?';
    // }

    // return '어서 오세요' . auth()->user()->name;
// });

// Route::get('auth/logout', function(){
   // auth()->logout();
    // return '또 봐요~';
// });



$route_define=[];
//$route_define['WalletCon']=[];



// 계좌관리
Route::get('/myaccount', 'WalletCon@myAccount');


//mypage
reg_route('/myaccount/mypage','MyAccountController','index');


reg_route('/dashboard','DashboardController','index');

// wallet
reg_route('/wallet','WalletCon','index');




//////////////////////
// admin

{
    Route::get('/admin', 'AdminCon@index')->name('admin.index');

    // BBS 관리
    Route::get('/admin/bbs/{cmd}', 'AdminCon@bbs_mgr');
    Route::post('/admin/bbs/{cmd}', 'AdminCon@bbs_mgr');

    // admin > 공지
    Route::get('/admin/notice/{cmd}', 'NoticeCon@notice_admin')->name('admin.notice.get');
    Route::post('/admin/notice/{cmd}', 'NoticeCon@notice_admin')->name('admin.notice.post');

    // admin > project
    Route::get('/admin/project/{cmd}', 'ProjectCon@project_admin')->name('admin.project.get');
    Route::post('/admin/project/{cmd}', 'ProjectCon@project_admin')->name('admin.project.post');

    // admin > news
    Route::get('/admin/news/{cmd}', 'NewsCon@news_admin')->name('admin.news.get');
    Route::post('/admin/news/{cmd}', 'NewsCon@news_admin')->name('admin.news.post');

    // admin > event
    Route::get('/admin/event/{cmd}', 'EventCon@event_admin')->name('admin.event.get');
    Route::post('/admin/event/{cmd}', 'EventCon@event_admin')->name('admin.event.post');

    // admin > schedule
    Route::get('/admin/schedule/{cmd}', 'ScheduleCon@schedule_admin')->name('admin.schedule.get');
    Route::post('/admin/schedule/{cmd}', 'ScheduleCon@schedule_admin')->name('admin.schedule.post');

    // admin > task
    Route::get('/admin/task/{cmd}', 'TaskCon@task_admin')->name('admin.task.get');
    Route::post('/admin/task/{cmd}', 'TaskCon@task_admin')->name('admin.task.post');

    // admin > faq
    Route::get('/admin/faq/{cmd}', 'FAQCon@faq_admin')->name('admin.faq.get');
    Route::post('/admin/faq/{cmd}', 'FAQCon@faq_admin')->name('admin.faq.post');


    // admin - 회원관리
    Route::get('admin/member', 'AdminMemberController@index')->name('admin.member.index');
//    Route::resource('admin/member', 'AdminMemberController');

    // admin - 회원 암호 저장
    Route::get('/admin/member/updatePassword', 'AdminMemberController@updatePassword');


//
//    // admin -> BBS 관리메뉴
//    Route::get('/admin/bbs/{cmd}', 'AdminCon@bbs_run')->name('admin.bbs.get');
//    Route::post('/admin/bbs/{cmd}', 'AdminCon@bbs_run')->name('admin.bbs.post');

}




//////////////////////
// api
{


    Route::get('/api/user/{cmd}', 'APICon@api_run')->name('api.user.get');
    Route::post('/api/user/{cmd}', 'APICon@api_run')->name('api.user.post');

}


//////////////////////
// 프론트
{

    // 뉴스레터
//    Route::post('/newsletter/subscribe', 'NewsletterCon@subscribe')->name('front.newsletter');

    // BBS > project
    Route::get('/project', 'ProjectCon@list');
    Route::get('/project/{cmd}', 'ProjectCon@project_run')->name('front.project.get');
    Route::post('/project/{cmd}', 'ProjectCon@project_run')->name('front.project.post');

    // BBS > Notice
    Route::get('/notice', 'NoticeCon@list');
    Route::get('/notice/{cmd}', 'NoticeCon@notice_run')->name('front.notice.get');
    Route::post('/notice/{cmd}', 'NoticeCon@notice_run')->name('front.notice.post');

    // BBS > NEWS
    Route::get('/news', 'NewsCon@list');
    Route::get('/news/{cmd}', 'NewsCon@news_run')->name('front.news.get');
    Route::post('/news/{cmd}', 'NewsCon@news_run')->name('front.news.post');

    // BBS > QNA
    Route::get('/qna', 'QNACon@list');
    Route::get('/qna/{cmd}', 'QNACon@event_run')->name('front.qna.get');
    Route::post('/qna/{cmd}', 'QNACon@event_run')->name('front.qna.post');

    // BBS > DOCS
    Route::get('/docs', 'DocsCon@list');
    Route::get('/docs/{cmd}', 'DocsCon@event_run')->name('front.docs.get');
    Route::post('/docs/{cmd}', 'DocsCon@event_run')->name('front.docs.post');

    // BBS > Schedule
    Route::get('/schedule', 'ScheduleCon@list');
    Route::get('/schedule/{cmd}', 'ScheduleCon@schedule_run')->name('front.schedule.get');
    Route::post('/schedule/{cmd}', 'ScheduleCon@schedule_run')->name('front.schedule.post');

    // BBS > Task management
    Route::get('/task', 'TaskCon@list');
    Route::get('/task/{cmd}', 'TaskCon@task_run')->name('front.task.get');
    Route::post('/task/{cmd}', 'TaskCon@task_run')->name('front.task.post');

    // BBS > FAQ
    Route::get('/faq', 'FAQCon@list');
    Route::get('/faq/{cmd}', 'FAQCon@faq_run')->name('front.faq.get');
    Route::post('/faq/{cmd}', 'FAQCon@faq_run')->name('front.faq.post');

}


Auth::routes();

//////////// 인증

// Authentication Routes...
//Route::get('login', [
//    'as' => 'login',
//    'uses' => 'Auth\LoginController@showLoginForm'
//]);
//Route::post('login', [
//    'as' => '',
//    'uses' => 'Auth\LoginController@login'
//]);
Route::get('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
]);

//
//// Password Reset Routes...
//Route::post('password/email', [
//    'as' => 'password.email',
//    'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
//]);
//Route::get('password/reset', [
//    'as' => 'password.request',
//    'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
//]);
//Route::post('password/reset', [
//    'as' => '',
//    'uses' => 'Auth\ResetPasswordController@reset'
//]);
//Route::get('password/reset/{token}', [
//    'as' => 'password.reset',
//    'uses' => 'Auth\ResetPasswordController@showResetForm'
//]);

// Registration Routes...
//Route::get('register', [
//    'as' => 'register',
//    'uses' => 'Auth\RegisterController@showRegistrationForm'
//]);





//Route::get('/home', 'HomeCon@index')->name('home.index');

@extends('layouts.coin.app')

@section('content')

    <header>
        {{--<div class="header-content">
            <div class="header-content-inner">
                <!--<h2 id="homeHeading">
                   <span class="color-red">머닝페이</span> 쓰면<br>
                   <span class="color-cyan">티밥토큰</span> 받는<br>
                   하이퍼체인 통합 결제플랫폼
                </h2>
                <h3 class="stit">1차 프라이빗 세일 <p><span> 3 </span> 주차 종료까지</p></h3>-->
                <h2 id="homeHeading">
                    <img src="img/main_title.png" alt="머닝페이 쓰면 티밥토큰 받는 하이퍼체인 통합 결제플랫폼">
                </h2>


                <h3 class="stit"><span class="txt1" id="div_small_title1">1차 프라이빗 세일</span> <span class="week" id="div_small_title2">&nbsp;</span><span class="txt2" id="div_small_title3">주차 종료까지</span></h3>

                <ul class="timer" id="div_timer1">
                    <li>00<span>일</span></li>
                    <li>00<span>시</span></li>
                    <li>00<span>분</span></li>
                    <li>00<span>초</span></li>
                </ul>
                <div id="div_schedule_table" class="sale-tb clearfix">
                    <table class="table-bordered table-hover col-xs-11 col-sm-6 col-md-6 col-lg-5">
                        <colgroup>
                            <col width="">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>분류</th>
                            <th>기간</th>
                            <th>토큰</th>
                            <th>달러</th>
                            <th>원화</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr id="timer_tr_1">
                            <th scope="row">1주차</th>
                            <td>2018.10.10 - 10.17</td>
                            <td>1</td>
                            <td>0.09</td>
                            <td>100</td>
                        </tr>
                        <tr id="timer_tr_2">
                            <th scope="row">2주차</th>
                            <td>2018.10.17 - 10.24</td>
                            <td>1</td>
                            <td>0.10</td>
                            <td>110</td>
                        </tr>
                        <tr id="timer_tr_3">
                            <th scope="row">3주차</th>
                            <td>2018.10.24 - 10.31</td>
                            <td>1</td>
                            <td>0.11</td>
                            <td>120</td>
                        </tr>
                        <tr id="timer_tr_4">
                            <th scope="row">4주차</th>
                            <td>2018.10.31 - 11.07</td>
                            <td>1</td>
                            <td>0.12</td>
                            <td>130</td>
                        </tr>
                        <tr id="timer_tr_5">
                            <th scope="row">5주차</th>
                            <td>2018.11.07 - 11.14</td>
                            <td>1</td>
                            <td>0.13</td>
                            <td>140</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>--}}
    </header>

    <section id="about" style="background-color:#e7f0f5;">

        <div class="container-fluid" style="max-width:1200px;padding:0 !important;border:0px solid red;overflow:hidden;margin:0 auto;">
            <div class="bg-cyan" style="-webkit-background-size: cover; -moz-background-size: cover; background-size: cover; -o-background-size: cover; background-position: left; background-image: url('/img/main.png');height:300px;">
                <div class="container">
                    <div class="row">

                        <div class="col-xs-12 col-sm-12">
                            <h2 class="section-heading2" ><b>Project Name: CP</b><br />
                                </h2>
                        </div>

                        {{--<div class="col-xs-12 col-sm-5 col-sm-offset-1 col-lg-offset-1 mb5 img mt25"><img src="img/platform.png" alt="티밥 플랫폼"></div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid" style="background-color:#279bc8;height:55px;">
        <?php
        $notice_last1=get_notice_last1();
        ?>
        <div style="max-width:1200px;height:55px;background-color:#279bc8;padding:0 !important;border:0px solid red;overflow:hidden;margin:0 auto;">
            <div class="container" style="padding:0 !important;">

                <div style="float:left;width:80%;padding-top:17px;">
                    <span style="font-size:20px;margin-top:0px;color:#fff">Project Notice</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					<?php if($notice_last1){ ?>
                    <a href="/notice/view?idx=<?=$notice_last1->idx?>"><span style="font-size:16px;margin-top:0px;color:#fff"><?=$notice_last1->bbs_subject?></span></a>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span style="font-size:12px;margin-top:0px;color:#fff"><?=date('Y-m-d',$notice_last1->bbs_regtt)?></span>
					<?php } ?>
                </div>


                <div style="float:left;width:20%;">
					<?php if($notice_last1){ ?>
                    <a href="/notice/view?idx=<?=$notice_last1->idx?>"><img src="img/plus.png" style="float:right;" /></a>
					<?php } ?>

                </div>

            </div>
        </div>

    </section>


{{--
    <section class="container-fluid" style="margin-top:85px;">

        <div >
            <div class="container" style="max-width:1200px; padding:0 !important;">
                <div class="row">


                </div>
            </div>
        </div>

    </section>
--}}







    <style>
        .image-cropper {
            background-color:white;

            /*width: 100px;*/
            height: 115px;
            position: relative;
            overflow: hidden;
            border: 1px solid #e7e7e7;
            border-radius: 5px;
        }

        .image-cropper > img {
            display: inline;
            margin: 0 auto;
            height: 100%;
            /*border:1px solid black;*/
            width: auto;
        }

        .image-cropper-media {
            background-color:white;
            /*width: 100px;*/
            line-height:115px;
            height: 115px;
            position: relative;
            overflow: hidden;
            border: 1px solid #e7e7e7;
            border-radius: 5px;
            /*vertical-align:middle;*/
        }

        .image-cropper-media > img {
            /*margin: auto auto;*/
            /*height: 100%;*/
            /*border:1px solid black;*/
            width: auto;
            vertical-align: middle;
        }
    </style>





    {{--<script src="/js/jquery.min.js"></script>--}}

    <script>


        function leading0pad(number, length) {

            var str = '' + number;
            while (str.length < length) {
                str = '0' + str;
            }

            return str;

        }

        // 15 days from now!
        function get15dayFromNow() {
            return new Date(new Date().valueOf() + 15 * 24 * 60 * 60 * 1000);
        }


        function conv_str2ts(str) {
            return Math.floor(Date.parse(str) / 1000);
        }

        function get_saledatestring(){
            // get15dayFromNow()

            // return '2018/11/14 10:00:00';
            // var str=new Date(now_end * 1000).format('YYYY/MM/DD HH:mm:ss');
            var str=timeConverter(now_end);
            // alert(str);

            return str;

        }


        function timeConverter(UNIX_timestamp) {
            var a = new Date(UNIX_timestamp * 1000);
            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            var year = a.getFullYear();
            var month = months[a.getMonth()];
            var mm = a.getMonth()+1;
            var date = a.getDate();
            var hour = a.getHours();
            var min = a.getMinutes();
            var sec = a.getSeconds();

            // var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
            var time = year + '/' + leading0pad(mm, 2) + '/' + leading0pad(date, 2) + ' ' + leading0pad(hour, 2) + ':' + leading0pad(min, 2) + ':' + leading0pad(sec, 2);
            return time;
        }


        var now_stage = 0;
        var now_end = 0;

        $(document).ready(function() {


            var sale_schedule = [];
            sale_schedule[sale_schedule.length] = {
                "gubun": "1",
                "gigan_start": "2018/10/10 10:00:00",
                "gigan_end": "2018/10/17 10:00:00"
            };
            sale_schedule[sale_schedule.length] = {
                "gubun": "2",
                "gigan_start": "2018/10/17 10:00:00",
                "gigan_end": "2018/10/24 10:00:00"
            };
            sale_schedule[sale_schedule.length] = {
                "gubun": "3",
                "gigan_start": "2018/10/24 10:00:00",
                "gigan_end": "2018/10/31 10:00:00"
            };
            sale_schedule[sale_schedule.length] = {
                "gubun": "4",
                "gigan_start": "2018/10/31 10:00:00",
                "gigan_end": "2018/11/07 10:00:00"
            };
            sale_schedule[sale_schedule.length] = {
                "gubun": "5",
                "gigan_start": "2018/11/07 10:00:00",
                "gigan_end": "2018/11/14 10:00:00"
            };

            // console.log(sale_schedule);


            var curr_ts = Math.floor(new Date() / 1000);


            // 1st
            // curr_ts=Math.floor(conv_str2ts('2018/10/10 10:00:00'));

            // 3rd
            // curr_ts=Math.floor(conv_str2ts('2018/10/31 09:59:59'));



            for (var i = 0; i < sale_schedule.length; i++) {
                var start_ts = conv_str2ts(sale_schedule[i].gigan_start);
                var end_ts = conv_str2ts(sale_schedule[i].gigan_end);

                if (curr_ts >= start_ts && end_ts > curr_ts) {
                    now_stage = sale_schedule[i].gubun;
                    now_end=end_ts;
                    break;
                }
            }

            // alert(end_ts);

            // function timeConverter(UNIX_timestamp) {
            //     return (new Date(UNIX_timestamp*1000).format("yyyy/MM/dd hh:mm:ss"));
            // }


            // 진행중
            if (true && now_stage > 0) {

                $('#div_small_title2').text(now_stage);
                $('#div_small_title2_foot').text(now_stage+"주차 종료까지");

                $('#timer_tr_' + now_stage).css('background-color', '#6db2d6');
                // alert(get_saledatestring());

                var $clock = $('#div_timer1');

                $clock.countdown(get_saledatestring(), function (event) {

                    var d = event.strftime('%D');
                    var h = event.strftime('%H');
                    var m = event.strftime('%M');
                    var s = event.strftime('%S');
                    var r = '<li>' + d + '<span>일</span></li>\n' +
                        '    <li>' + h + '<span>시</span></li>\n' +
                        '    <li>' + m + '<span>분</span></li>\n' +
                        '    <li>' + s + '<span>초</span></li>';

                    $(this).html(r);
                });

                var $clock2 = $('#div_timer2');
// alert($clock2);
                $clock2.countdown(get_saledatestring(), function (event) {

                    var d = event.strftime('%D');
                    var h = event.strftime('%H');
                    var m = event.strftime('%M');
                    var s = event.strftime('%S');
                    var r = '<li>' + d + '<span>일</span></li>\n' +
                        '    <li>' + h + '<span>시</span></li>\n' +
                        '    <li>' + m + '<span>분</span></li>\n' +
                        '    <li>' + s + '<span>초</span></li>';

                    $(this).html(r);
                });

            }
            // 시작 전이거나 끝났습니다.
            else {
                $('#div_small_title1_foot').text("2차 프라이빗 세일");
                $('#div_small_title2_foot').text(" Coming Soon");

                $('#div_small_title1').text("2차 프라이빗 세일");
                $('#div_small_title3').text(" Coming Soon");
                $('#div_schedule_table').hide();

            }



            // $('#myModal').modal({
            //     show: false,
            //     remote: '/privacy/privacy.htm'
            // });


        });

        //alert(now_stage);

        //'2020/10/10',



        // $('#btn-reset').click(function() {
        //     $clock.countdown(get15dayFromNow());
        // });


    </script>


    {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalQuickView">Launch modal</button>--}}

    <!-- Modal: 이용약관 -->
    <div class="modal fade" id="modal_agreement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div style="height:450px;overflow-y: scroll;">
                        @include('privacy.agreement')
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal: 개인정보 -->
    <div class="modal fade" id="modal_privacy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div style="height:450px;overflow-y: scroll;">
                        @include('privacy.privacy')
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal: 법적고지 -->
    <div class="modal fade" id="modal_legal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div style="height:450px;overflow-y: scroll;">
                        @include('privacy.legal')
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if (session('alert'))
        <script>
            alert('{{ session('alert') }}');
        </script>
        {{--<div class="alert alert-success">--}}
        {{--</div>--}}
    @endif



@endsection

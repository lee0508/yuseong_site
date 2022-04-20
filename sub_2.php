<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="57x57" href="./img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="./img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="./img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="./img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="./img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="./img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="./img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="./img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="./img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="./img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="./img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./img/favicon-16x16.png">
    <link rel="manifest" href="./img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>유성구 데이타시각화</title>
    <!-- <link rel="stylesheet" href="./css/index.css" type="text/css" /> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/main02.css" />
    <script src="./js/index.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
    <!-- sub_1.html -->
	<div id="wrap">
		<a href="#contens" class="skip">본문바로가기</a>
		<header>
			<div class="hd_wrapper">
                <h1>
                    <a href="./index.html">유성구데이타시각화</a>
                </h1>
                <!-- <a href="./main02.html"><img class="logo" src="yuseong_logo.png" alt="유성구데이타시각화로고"></a> -->
                <h2 class="hide">대메뉴</h2>
<style>
    /* .hd_wrapper .hd_menu nav > ul#main_menu > li:last-child{ position: relative; } */
    /* ul#sub_menu { border:1px solid #ccc;background: #fcfafc;position:absolute; text-align: center; margin:0; opacity:0;visibility:none; z-index:999; }
    ul#sub_menu > li { border-bottom: 1px solid #ccc; line-height:30px; }
    ul#sub_menu > li > a { display:block; text-decoration: none; }
    #main_menu > li:hover #sub_menu { opacity:1;visibility:visible; } */

    ul#sub_menu { border:1px solid #ccc;background: #fcfafc;position:absolute; text-align: center; margin:0; opacity:0;visibility:none; z-index:999; }
    ul#sub_menu > li { border-bottom: 1px solid #ccc;  }
    ul#sub_menu > li > a { display:block; text-decoration: none; height:100%; line-height: 82px;}
    #main_menu > li:hover #sub_menu { opacity:1;visibility:visible; }    
    
</style>                  
                <div class="hd_menu">
                    <nav>
                        <ul id="main_menu">
                            <li>
                                <a href="./sub_1.html"><span>가게현황 분석</span></a>
                            </li>
                            <li>
                                <a href="./sub_2.html"><span>매출정보 분석</span></a>
                            </li>
                            <li>
                                <a href="./sub_3.html"><span>유동인구 분석</span></a>
                            </li>
                            <li>
                                <a href="./sub_4.html"><span>온통대전 소비분석</a>
                            </li>
                            <li>
                                <a href="./sub_5.html"><span>방문객 소비분석</span></a>
                            </li>
                            <li>
                                <a href="./sub_about.html"><span>도움말</span></a>
                                <ul id="sub_menu">
                                    <li><a href="./sub_about.html"><span>사이트소개</span></a></li>
                                    <li><a href="./sub_sitemap.html"><span>사이트맵</span></a></li>
                                </ul>                                
                            </li>
                        </ul>
                    </nav>
                </div>            
			</div>
		</header>

        <!-- SECTION FIRST PART  -->
        <style>
            .sec01 {
                position: relative;
                /* width: 100%; */
                /* z-index: -1; */
                height:166px;
                background:#E6EDF8;
                text-align: center;
                /* overflow: hidden; */
            }
            .sec01 .sec01_inner {
                /* position:absolute; */
                /* top:0; */
                /* left:0; */
                display: inline-block;
                /* border: 1px solid #ccc; */
                /* position: relative; */

                width: 1420px;
                height: 166px;
                /* margin: 0 auto; */
                background:url(./sub1/sec01_img.png) no-repeat center center;                
                position: relative;
            
            }
            .sec01 .sec01_inner > .sec01_img01 {
                /* display: inline-block; */
                /* border: 1px solid #ccc; */
                /* display:inline; */
                display:inline-block;
                width: 212px;
                height: 132px;
                position: absolute;
                left: 0;
                top: 0px;                
                /* position:relative; */
                /* vertical-align: top; */
                /* position: relative; */
            }.sec01 .sec01_inner > .sec01_img02 {
                /* display: inline-block; */
                /* border: 1px solid #ccc; */
                /* display:inline;                 */
                z-index: 30;
                width: 290px;
                height: 196px;
                position: absolute;
                right: 0;
                top: 0;                
                /* position:relative; */
                /* vertical-align: top; */
                /* position: relative; */
            }
            .sec01 .sec01_inner > .sec01_img01 > img {
                /* display: block; */
                /* position: absolute; */
                /* right: 0; */
                /* bottom:0; */
                width: 142px;
                height:104px;
                float: right;
                /* left:0; */
                /* bottom: 0; */
                /* display: inline-block; */
                /* width: 100%; */
                /* height: 100%; */


            }
            .sec01 .sec01_inner > .sec01_img01 > p {
                text-align: left;
                padding:0;
                position: absolute;
                left:0;
                bottom: 0;
                width: 85px; 
                height: 79px;                
                font-size: 20px;
                color: #036eb8;
            }
            .sec01 .sec01_inner > .sec01_img02 > img {
                /* display: block; */
                /* position: absolute; */
                /* right: 0; */
                /* bottom:0; */
                width: 290px;
                height:196px;
                float: right;
                /* left:0; */
                /* bottom: 0; */
                /* display: inline-block; */
                /* width: 100%; */
                /* height: 100%; */


            }
            .sec01 .sec01_inner > .sec01_title {
                /* display: inline-block; */
                /* position: absolute; */
                /* border: 1px solid #ccc; */
                width: 611px;
                height: 48px;
                /* position: absolute; */
                /* left: 0; */
                /* top:0; */
                margin: 0 auto;
                /* padding: 0 40px; */
                /* font-size: 36px; */
                text-align: center;
                /* position: absolute; */
                /* padding-top: 50%; */
                /* transform:translateY(-50%); */
                margin-top: 48px;
                
            }
            .sec01 .sec01_inner > .sec01_title > h1 {
                /* display:inline-block; */
                font-size: 36px;
                font-weight: bold;
                color: #404751;
            }
            .sec02 {
                background-color: #fff;
            }
            .sec02 .sec02_inner {
                border: 1px solid #ccc;
                background-color: #fff;
                width: 1420px;
                height:888px; /* 22.01.27 */
                /* height:688px; */
                margin: 0 auto;
                position: relative;
            }
            .sec02 .sec02_inner .sec02_left_part {
                border-right: 1px solid #ccc;
                position:absolute;
                left: 0;
                top:0;
                width: 320px;
                height: 100%; /* 754 44*/
                background:#f2f2f2;
                z-index:999;
            }
            
            .sec02 .sec02_inner .sec02_right_part {
                /* border-right: 1px solid #ccc; */
                position: absolute;
                right: 0;
                top:0;
                width: 1100px;
                height: 100%;
            }
                    
            .period_layout .period_wrap .select_btn button#btn.btn {
                background-color: #fff;color:#404751;
            }
            
            .period_layout .period_wrap .select_btn button#btn.btn.on{
                background-color: #00B7BF;color:#fff;
            }
        </style>

        <!-- SECTION_01 PART START  -->
		<div class="sec01">
            <div class="sec01_inner">
                <h1 class="hide">매출정보 분석</h1>
                <div class="sec01_img01">
                    <img src="./sub1/left_img.png" alt="매출정보분석 왼쪽이미지">
                    <p>
                        유성구<br>
                        동네상권<br>
                        알아보기
                    </p>
                </div>
                <div class="sec01_img02">
                    <img src="./sub1/right_img.png" alt="매출정보분석 오른쪽이미지">
                </div>
                <div class="sec01_title">
                    <h1>매출정보 분석</h1>
                </div>
            </div>            
        </div>
        <!-- 의인은 그의 믿음으로 말미암아 살리라....  -->
        <!-- 왼쪽 부분 사이즈 widith:320px 오른쪽 부분 사이즈 width: 1100px; 네비게이션바 높이 height:52px; -->
        <!-- SECTION_02 PART START  -->
        <style>
            .sec02 .sec02_inner .sec02_left_part .sec02_location .top_bar .title { width:320px;height:50; text-align: center;background:#036EB8}
            .sec02 .sec02_inner .sec02_left_part .sec02_location .top_bar .title h2 { font-size:18px; color:#fff; line-height: 50px;}
            /* .sec02_right_part{position:relative;} */
            /* .sec02 .sec02_inner .sec02_right_part .util_wrap .location_wrap { float:left; position:absolute;left:0;top:10px; } */
            /* .sec02 .sec02_inner .sec02_right_part .util_wrap .print_wrap { float:right; position:absolute;left:0;top:10px;  } */
            .sec02_right_part .util_wrap { position:absolute;left:0px;top:0;width:100%; height: 50px; }
            .sec02_right_part .util_wrap .location_wrap { float:left; transition: all 0.5s ;-webkit-transition: all 0.5s; }
            .sec02_right_part .util_wrap .location_wrap li {display:inline;width:100%;height:50px;padding: 0 10px;}
            .sec02_right_part .util_wrap .location_wrap li a { display:inline-block;color:#404751;font-family:inherit;font-size:1em;line-height: 50px; }
            .sec02_right_part .util_wrap .location_wrap > li:nth-child(1) > a { position:relative; padding-left: 0; }
            .sec02_right_part .util_wrap .location_wrap > li:nth-child(1) > a:after {content:"";position:absolute;left:50%;top:50%;margin-left: 20px;width: 100%; height: 100%;background:url(arrow_1.png) no-repeat; }

            .sec02_right_part .util_wrap .location_wrap > li:nth-child(2) > a { position:relative; }
            .sec02_right_part .util_wrap .location_wrap > li:nth-child(2) > a:after {content:"";position:absolute;left:50%;top:50%;margin-left: 58px;width: 100%; height: 100%;background:url(arrow_1.png) no-repeat; }


            /*  지도 표시  부분  */
            .sec02_right_part .util_wrap .print_wrap {float:right; /*background:orange;overflow:auto;*/margin-right:10px;margin-top:10px;}
            .sec02_right_part .util_wrap .print_wrap li {display:inline;width:30px;height:30px;padding: 0 10px; text-align: center;}
            .sec02_right_part .util_wrap .print_wrap li a { display:block;width:100%;color:#404751;font-size:1.2em; /*background:orange;*/ padding:5px}
            /* .sec02_right_part .util_wrap .print_wrap li a:hover { cursor: pointer; background-color:orange; } */
            .sec02_right_part .util_wrap .print_wrap li a span { display:block;width:30px;height:30px;border:2px solid #ccc; border-radius:50%; padding:5px; }
            .sec02_right_part .util_wrap .print_wrap li a span:hover{ cursor: pointer; background-color:orange; color:#fff; }
            /* .sec02_right_part .map_layout { position:absolute;left:60%; top:0px;z-index: 90;width:100%;height:100%;transform:translateX(-40%); text-align: center; } */            
            .sec02_right_part .map_layout { position:absolute;left:56%; top:0px;margin-top:40px;z-index: 90;width:50%;height:100%; transform:translateX(-30%); text-align: center; }
            /* width:575px;height:669px; */
            /* 이미지 위치부분  margin-left로 수정 오른쪽 폭 1100 중에서 지도 위치 495px 나중에 스크립트 작업시 지도가 오른쪽으로 이동하는 동작을 표시*/
            .sec02_right_part .map_layout { animation-duration: 3s; animation-name: slidein; }
            @keyframes slidein{ from{margin-left:100%; width:300%;} to{margin-left:0; width:100%;} }
            
            /* .sec02_right_part .map_layout > img { display:inline-block;width:575px;height:700px;margin-left:90px; }  */

            /* 차트 표시 부분 */
            /* .sec02_right_part .chart_layout { border:1px solid #ccc;position:absolute; top: 50px; left:0;width:560px;height:860px;  } */

            /* select[name="catagory1"], select[name="catagory2"], select[name="catagory3"] {  margin: 10px 0; }  */
            #sec02_input_layer{ position:relative; background:#f2f2f2; }
            #sec02_input_layer .select_layout { width:272px; height: 112px; margin:28px auto; position:relative;}
            #sec02_input_layer .select_layout h2 { position: absolute;left:0px;top:0px;width: 40px;font-family:'Malgun Gothic';font-size:15px; font-weight:bold; text-indent: 2%;}
            #sec02_input_layer .select_layout .select_wrap { position:absolute;left:0px;top:0px;margin-left: 54px; width:218px;}
            #sec02_input_layer .select_layout .select_wrap .n2 { margin: 8px 0; }
            select[name="catagory1"], select[name="catagory2"], select[name="catagory3"] {border: 1px solid #C2CDDE;border-radius:6px;width:218px;height:30px; font-size:13px; cursor: pointer; }
            #sec02_input_layer .period_layout { width:272px;height: 100px;margin:12px auto; position:relative;}
            #sec02_input_layer .period_layout h2 { position: absolute;left:0px;top:0px;width: 40px;font-family:'Malgun Gothic';font-size:15px; font-weight:bold; text-indent: 2%;}
            #sec02_input_layer .period_layout .select_btn {  position:absolute;left:0px;top:0px;margin-left: 54px; width:218px;text-align: center;}
            #sec02_input_layer .period_layout .select_btn button { border: 1px solid #C2CDDE;border-radius:6px;width:50px;height:30px;font-family:'Malgun Gothic';font-size:13px; background:#fff;}
            #sec02_input_layer .period_layout .select_ymd {  position:absolute;left:0px;top:0px;margin-left: 54px; margin-top:40px;width:230px; background:#f2f2f2; box-sizing: border-box; }
            #sec02_input_layer .period_layout .select_ymd > select { border:1px solid #C2CDDE;border-radius: 6px; font-family:'Malgun Gothic';font-size:13px; background:#fff; text-align:center; }
            #sec02_input_layer .period_layout .select_ymd .select_year {width:84px;height:30px; cursor: pointer;}
            /* .period_layout .select_ymd span {font-size:14px;} */
            #sec02_input_layer .period_layout .select_ymd .select_fmonth,
            #sec02_input_layer .period_layout .select_ymd .select_tmonth { width:66px;height:30px;margin-left:26px; text-align: center; }

            #sec02_input_layer .period_layout .select_ymd .select_fmonth { margin-left:26px; text-align: center; cursor: pointer; }

            #sec02_input_layer .area_layout { width:272px; height: 100px; margin:12px auto; position:relative;}
            #sec02_input_layer .area_layout h2 { position: absolute;left:0px;top:0px;width: 48px;font-family:'Malgun Gothic';font-size:15px; font-weight:bold; text-indent: 2%; }
            /* #sec02_input_layer .area_layout h2:hover { background-color: #fff; color: #191919; border-radius: 8px; rgba(0,0,0, 0.2); } */
            #sec02_input_layer .area_layout .area_wrap { position:absolute;left:0px;top:0px;margin-left: 54px; width:218px;}
            select[name="select_area"] {border: 1px solid #C2CDDE;border-radius:6px;width:218px;height:30px; font-size:13px;margin-top: 10px; cursor: pointer; }

            .sec02_left_part #sec02_input_layer .action_layer .action_wrap { position:relative; /* box-sizing: border-box;float:right;margin-right:20px; */ text-align: center; margin-top: 30px;  }
            .sec02_left_part #sec02_input_layer .action_layer .action_wrap button { border: 1px solid #C2CDDE;border-radius:6px;width:106px;height:30px;font-family:'Malgun Gothic';font-size:15px; background:#fff;}
            .sec02_left_part #sec02_input_layer .action_layer .action_wrap > button.n1 {background:#036EB8;color:#fff; }
            /* .period_layout .select_ymd .select_tmonth {width:62px;height:30px;} */
            /* .sec02_left_part .result_layout {border:1px solid #ccc;z-index:999;position:absolute;left:320px;top:50%;width:26px;height:48px; vertical-align:top;} */
            /* .sec02_left_part .result_layout:hover { cursor: pointer; } */
            /* .sec02_left_part .result_layout > img#result_btn { display:inline-block;z-index:999;width:100%;height:100%; } */
            /* .sec02_left_part .result_layout > img#result_btn:hover { cursor: pointer; } */
            /* .sec02_left_part .result_layout > p { border:1px solid #ccc;position:absolute;left:0px; top:-396px; width:0px;height:838px;z-index:-1; background:#ddd; transition: all 0.5s ;-webkit-transition: all 0.5s; } */
            /* .sec02_left_part .result_layout > p.on {width:320px;} */
            /* .sec02_left_part #sec02_input_layer { position:absolute; left:0;transition: all 0.5s ;-webkit-transition: all 0.5s; } */
            /* .sec02_left_part #sec02_input_layer.on { display:none; } */

            /* .sec02 .sec02_inner .sec02_left_part{ border-right: 1px solid #ccc; position: absolute; left: 0; top: 0; width: 320px; height: 100%;} */
            /* .sec02 .sec02_inner .sec02_left_part.on { display:none; } */

            .sec02_inner .result_layout {border:1px solid #ccc;z-index:999;position:absolute;left:320px;top:50%;width:26px;height:48px; vertical-align:top; transition: all 0.5s ;-webkit-transition: all 0.5s; }
            .sec02_inner .result_layout > p { opacity: 0; visibility: hidden; }
            .sec02_inner .result_layout > img#result_btn { display:inline-block;z-index:999;width:100%;height:100%; }
            /* .sec02_inner .result_layout > img#result_btn:hover {  position:relative; cursor: pointer; } */

            /* .sec02_inner .result_layout:hover { position:relative;display: inline-block; } */
            .sec02_inner .result_layout:hover > p { opacity:1; visibility:visible; }

            .sec02 .sec02_inner .sec02_left_part.on{display:none;}
            .sec02 .sec02_inner .result_layout.on{ left:0px; }

            .sec02_right_part .util_wrap .location_wrap.on{ position:absolute;left:-320px; }

            .sec02_inner .result_layout > img#result_btn.on{ transform:rotate(180deg); border:1px solid #f0f; }
            /* 말풍선 적절한 top 과 margin-left 로 위치조정 */
            .sec02 .sec02_inner .result_layout p#arrow-box {
            display: none;
            position: absolute;
            width: 100px;
            padding: 8px;
            left: 0;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 8px;
            background: #333;
            color: #fff;
            font-size: 14px;
            }

            .sec02 .sec02_inner .result_layout p#arrow-box:after {
            position: absolute;
            bottom: 100%;
            left: 50%;
            width: 0;
            height: 0;
            margin-left: -10px;
            border: solid transparent;
            border-color: rgba(51, 51, 51, 0);
            border-bottom-color: #333;
            border-width: 10px;
            pointer-events: none;
            content: ' ';
            }
            .sec02 .sec02_inner .result_layout p#arrow-box { display:block; text-align:center; }
            /* .print_wrap > .n1 > span { border:1px solid; border-radius: 50%; } */
            .sec02 .sec02_inner .kinds_graph::before
            {
                margin:0;
                padding:0;
            }
            .sec02 .sec02_inner .kinds_graph
            {
                position: relative;
            }
            /* .sec02 .sec02_inner .kinds_graph
            {
                
                box-sizing: border-box;
                position: absolute;
                content: '';
                left: 320px;
                top: 50px;
                width: 820px;
                height: 60px;
                background-color: #fefefc;                
                z-index: 99999;
            } */
            /* .sec02 .sec02_inner .kinds_graph ul.graph_list
            {
                opacity:0;
                width: 820px;
                height: 30px;
                padding: 10px 0;
            } */
            /* .sec02 .sec02_inner .kinds_graph ul.graph_list > li
            {
                
                float: left;
                width: 82px;
                height: 20px;
                text-align:center;
            } */
            /* .sec02 .sec02_inner .kinds_graph ul.graph_list > li > a
            {
                border: 1px solid #222;
                display: block;
                font-family:'Noto Sans KR', sans-serif;
                font-size: 9px;
                word-break: break-all;
                word-spacing: -2px;
                color: #333;
                line-height: 10px;
                padding: 2px;
                
            } */
            table.gr_list
            {
                /* border: 1px solid #333; */
                position:absolute;
                left: 680px;
                top: 50px;
                border-collapse: collapse;
                width:380px;
                /* width:8rem; */
                /* height:480px; */
                font-family: 'Noto Sans KR', sans-serif;
                font-size: 9px;
                /* color:#333; */
                white-space: nowrap;
                word-break: break-all;
                word-spacing: -2px;
                background-color: #fefefe;
                z-index: 99991;
            }
            table.gr_list > thead
            {
                border: 1px solid #ccc;
            }
            table.gr_list > thead > tr> th
            {
                font-size: 12px;
                font-weight: 600;
            }
            table.gr_list > tbody {
                margin: 0;
                padding: 0;

            }
            table.gr_list > tbody > tr , td
            {
                border: 1px solid #ccc;
                margin: 0;
                /* padding:0; */
                text-align:center;
                color:#333;
            }
            table.gr_list > tbody > tr > td > a
            {
                /* margin: 0; */
                /* padding:0; */
                display:block;
                width:100%;
                /* line-height:20px; */
                font-weight: 500;
                color:#333;
                /* word-wrap: break-word; */
                /* word-break: break-all; */
            }
            table.gr_list > tbody > tr > td > a:hover
            {
                background-color:#23bce2;
                color: #fff;
            }

            table.gr_list > thead > tr > th:hover
            {
                background-color: #ecbd22;
                color: #f4f4f4;
                cursor: pointer;
            }

            /* table.gr_list > tbody > tr > td > a:hover
            {
                background-color:#2dc7ee;
                color: #f4f4f4;
            } */
            .rd__modal--open
            {
                visibility: visible;                
            }
            .rd__modal
            {
                visibility:hidden;
            }
            .rd__modal--open .rd__modal__overlay
            {
                -webkit-transform:none;
                transform:none;                
            }
            .rd__modal .rd__modal__overlay {
                -webkit-transform: translateX(200vw);
                transform: translateX(200vw);
            }
            .photo-page-navbar
            {
                display:none;
            }
            
            .level {
                display: -webkit-box;
                display: flex;
                -webkit-box-align: center;
                align-items: center;
                -webkit-box-pack: justify;
                justify-content: space-between;
                width: 100%;
            }
            .level__right,
            .level__left
            {
                max-width:100%;
                flex-basis:auto;
                -webkit-box-flex:0;
                flex-grow:0;
                flex-shrink:0;
            }
            .level__item
            {
                display: -webkit-box;
                display:flex;
                -webkit-box-align:center;
                align-items:center;
                -webkit-box-pack:center;
                justify-content:center;
                flex-basis: auto;
                -webkit-box-flex:0;
                flex-grow:0;
                flex-shrink:0;
            }
            .level__item * {
                margin-top:0;
                margin-bottom:0;
            }
            .rd__modal__overlay
            {
                /* transform: none; */
                position: fixed;
                top:0;
                left:0;
                right:0;
                width:100%;
                height:100%;
                display:flex;
                -webkit-box-orient:vertical;
                -webkit-box-direction: normal;
                flex-direction: column;
                -webkit-box-align: center;
                align-items:center;
                background-color:rgba(12,15,19,0.9);
                overflow-y:auto;
                z-index: 999999;
            }
            .rd__modal__exit,
            .rd__modal_content_forward-button,
            .rd__modal_content_back-button
            {
                opacity: .6;
            }
            .rd_modal__exit
            {
                position: fixed;
                top: 1.15rem;
                left: 1.15rem;
            }
            .rd__button--circle-icon
            {
                padding: 0;
                width: 40px;
                height: 40px;
                border-radius: 50%;
            }
            .rd__button--text,
            .rd__button--text-primary, .rd__button--text-secondary
            {
                display:block;
                font-size:16px;
                line-height:25px;
                font-weight:300;
                margin-top:0;
                margin-bottom:0;
                display:-webkit-inline-box;
                display:inline-flex;
            }
            .rd__button--text
            {
                background:transparent;
                color:inherit;
                border-color: transparent;
                box-shadow:none;

            }
            .rd__button--circle-icon .rd__svg-icon {
                width: 34px;
                height: 34px;
            }
            .rd__button--circle-icon--large .rd__svg-icon {
                width: 51px;
                height: 51px;
            }
            .rd__svg-icon {
                position: relative;
                display: -webkit-inline-box;
                display: inline-flex;
                -webkit-box-align: center;
                align-items: center;
                -webkit-box-pack: center;
                justify-content: center;
                width: 14px;
                height: 14px;
                background-repeat: no-repeat;
                background-size: contain;
                font-style: normal;
            }               
            /* .rd__button--circle-icon {
                padding: 0;
                width: 40px;
                height: 40px;
                border-radius: 50%;
            } */
            .rd__button--text-white
            {
                background: transparent;
                color: #fff;
                border-color: transparent;
                box-shadow: none;
            }
            .rd__button
            {
                line-height:1;
                display: inline-flex;
                -webkit-box-align:center;
                align-items:center;
                -webkit-box-pack:center;
                justify-content:center;
                border-width:1px;
                cursor: pointer;
                font-size:16px;
                text-decoration: none;
                white-space: nowrap;
            }
            .rd__modal__content
            {
                position: absolute;
                max-width: 1200px;
                width: calc(100vw - (80px * 2));
                outline: none;
                background-color:#fff;
                border-radius: 6px;
                padding: 15px;
                margin-bottom: 1.15rem;
                margin-top: 2.3rem;
            }            
            button>i.fa
            {
                font-size: 2em !important;
            }
            .rd__modal__content__back-button {
                position: absolute;
                left: 0;
                transform: translateX(-125%);
                top: 250px;
            }
            .rd__button--circle-icon--large {
                padding: 0;
                width: 60px;
                height: 60px;
                border-radius: 50%;
            }
            .js-loading
            {
                overflow: hidden;
                position:relative;
                height:40px;
                width:100%;
                margin-top:-15px;
            }
            .sk-folding-cube {
                margin: 20px auto;
                width: 20px;
                height: 20px;
                position: relative;
                -webkit-transform: rotateZ(45deg);
                transform: rotateZ(45deg);
            }    
            .photo-page
            {
                display: flex;
                -webkit-box-orient: vertical;
                -webkit-box-direction:normal;
                flex-direction:column;
                padding-bottom: 1.75rem;
                min-height:1000px;
            }
            .photo-page__section--action-bar {
                margin-bottom: 35px;
                padding: 0;
            }
            .photo-page__section {
                position: relative;
                padding: 0 5px;
            }
            .photo-page__section--photo {
                margin-bottom: 1.75rem;
            }
            .photo-page__section--photo-details {
                margin-bottom: 20px;
            }
        </style>
		<div class="sec02">
            <div class="sec02_inner">
                <!-- 그래프버튼 툴바 -->
                <div class="kinds_graph">
                    <h1 class="hide">그래프버튼</h1>
                    <!--
                    <ul class="graph_list">
                        <li><a href="">6개월간 매출금액 및 건수추이</a></li>
                        <li><a href="">6개월간 매출금액 및 차월예상 매출금액</a></li>
                        <li><a href="">지역별 <br>매출금액</a></li>
                        <li><a href="">지역별 <br>매출건수</a></li>
                        <li><a href="">업종별 <br>매출금액</a></li>
                        <li><a href="">업종별 <br>매출건수</a></li>
                        <li><a href="">성별기준 <br>매출금액</a></li>
                        <li><a href="">성별기준 <br>매출건수</a></li>
                        <li><a href="">연령대기준 <br>매출금액</a></li>
                        <li><a href="">연령대기준 <br>매출건수</a></li>
                        <li><a href="">평휴일 <br>매출금액</a></li>
                        <li><a href="">평휴일 <br>매출건수</a></li>
                    </ul>
                -->
                    <!-- kinds of graph table -->
                    <table class="gr_list">
                        <thead>
                            <tr>
                                <th colspan="3">그래프종류</th>
                            </tr>
                        </thead>
                        <tr>
                            <td><a class="graph1" href="#">6개월간 매출금액<br> 및 건수추이</a></td>
                            <td><a href="">6개월간 매출금액<br> 및 차월예상 매출금액</a></td>
                            <td><a href="">지역별 <br>매출금액</a></td>
                        </tr>
                        <tr>              
                            <td><a href="">지역별 <br>매출건수</a></td>
                            <td><a href="">업종별 <br>매출금액</a></td>
                            <td><a href="">업종별 <br>매출건수</a></td>
                        </tr>
                        <tr>    
                            <td><a href="">성별기준 <br>매출금액</a></td>
                            <td><a href="">성별기준 <br>매출건수</a></td>
                            <td><a href="">연령대기준 <br>매출금액</a></td>
                        </tr>
                        <tr>    
                            <td><a href="">연령대기준 <br>매출건수</a></td>
                            <td><a href="">평휴일 <br>매출금액</a></td>
                            <td><a href="">평휴일 <br>매출건수</a></td>
                        </tr>
                    </table>
                </div>
                <div class="rd__modal" id="photo-modal">
                    <div class="photo-page-navbar">
                        <div class="level" style="height:100%">
                            <div class="level__left">
                                <div class="level__item">
                                    <buttom class="js-modal-close-button rd__button rd__button--text rd__button--circle-icon">
                                        <i class="rd__svg-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></svg>
                                        </i>
                                    </buttom>
                                </div>
                            </div>
                            <div class="level__right"></div>
                        </div>
                    </div>
                    <div class="rd__modal__overlay">
                        <button class="js-modal-close-button rd__modal__exit rd__button rd__button--text-white rd__button--circle-icon">
                            <i class="rd__svg-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></svg>
                            </i> 
                        </button>
                        <div class="rd__modal__content" role="dialog" tabindex="0">
                            <button class="js-modal-backwards-request-button rd__modal__content__back-button rd__button rd__button--circle-icon--large rd__button--text-white" style="display:none">
                                <i class="rd__svg-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"></path></svg>
                                </i>
                            </button>
                            <button class="js-modal-forward-request-button rd__modal__content__back-button rd__button rd__button--circle-icon--large rd__button--text-white" style="display:none">
                                <i class="js-not-loading rd__svg-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"></path></svg>
                                </i>
                                <i class="js-loading rd__svg-icon" style="display: none">
                                    <div class="sk-folding-cube">
                                    <div class="sk-cube1 sk-cube"></div>
                                    <div class="sk-cube2 sk-cube"></div>
                                    <div class="sk-cube4 sk-cube"></div>
                                    <div class="sk-cube3 sk-cube"></div>
                                    </div>
                                </i>
                            </button>
                        </div>
                        <div class="photo-page">
                            <section class="photo-page__section photo-page__section--action-bar" id="photo-page-top"></section>
                            <section class="photo-page__section photo-page__section--photo"></section>
                            <section class="photo-page__section photo-page__section--photo-details"></section>
                            <div class="js-modal-below-the-fold-content"></div>
                        </div>
                    </div>
                </div>

      <script>
        // $(document).ready(function() {
        //     $("graph1").click(function(){
        //         $("rd__modal").toggleClass('rd__modal--open');
        //         console.log("rd__modal");
        //     });
        // });  
        const modal_view = document.querySelector(".rd__modal");
        const table_element = document.querySelector(".graph1");
        table_element.addEventListener("mousedown", (e) =>{
            console.log("1111");
            modal_view.classList.toggle("rd__modal--open");
        });
        // move to table of contents on mouse click
        const container = document.querySelector(".sec02_inner");
        const box = container.querySelector(".gr_list");

        const {width:containerWidth, height:containerHeight} =
        container.getBoundingClientRect();
        const {width:boxWidth, height:boxHeight} = box.getBoundingClientRect();

        let isDragging = null;
        let originLeft = null;
        let originTop = null;
        let originX = null;
        let originY = null;

        box.addEventListener('mousedown', (e) =>{
            isDragging=true;
            originX=e.clientX;
            originY=e.clientY;
            originLeft=box.offsetLeft;
            originTop=box.offsetTop;
        });

        document.addEventListener('mouseup', (e) =>{
            isDragging=false;
        });

        document.addEventListener('mousemove', (e) =>{
            //isDragging=true;
            if(isDragging)
            {
                const diffX = e.clientX - originX;
                const diffY = e.clientY - originY;

                const endOfXPoint = containerWidth - boxWidth;
                const endOfYPoint = containerHeight - boxHeight;

                //box.style.left = originLeft + diffX + "px";
                //box.style.top = originTop + diffY + "px";
                box.style.left = `${Math.min(Math.max(0, originLeft + diffX), endOfXPoint)}px`;
                box.style.top = `${Math.min(Math.max(0, originTop + diffX), endOfYPoint)}px`;
            }
        });
        
      </script>                
                <!-- 펼쳐보기 버튼 -->
                <div class="result_layout">
                    <h1 class="hide">펼쳐보기버튼</h1>
                    <!-- <span>마우스를 갖다 대세요.</span>  -->
                    <img src="result_btn.png"  alt="펼쳐보기" id="result_btn">
                    <p id="arrow-box">펼쳐보기</p>
                    <p id="demo" class=""></p>
                </div>
                <div class="sec02_left_part ">
                    <h1 class="hide">매출정보 분석 왼쪽메뉴</h1>
                    <div class="sec02_location">
                        <div class="top_bar">
                            <h1 class="hide">매출정보 분석 분석메뉴</h1>
                            <div class="title">                                
                                <h2>매출정보 분석</h2>
                            </div>
                        </div>
                    </div>
                    <div id="sec02_input_layer" class="sec02_input_layer">
                        <!-- 업종선택 -->
                        <div class="select_layout">
                            <h1 class="hide">업종 선택</h1>
                            <h2>업종 선택</h2>
                            <div class="select_wrap">                            
                                <!-- 대분류 -->
                                <div class="n1">                            
                                    <h1 class="hide">대분류업종 선택</h1>
                                    <select name="catagory1" id="catagory1">
                                        <option value="*">대분류</option>
                                        <option value="소매">소매</option>
                                        <option value="생활서비스">생활서비스</option>
                                        <option value="부동산">부동산</option>
                                        <option value="관광/여가/오락">관광/여가/오락</option>
                                        <option value="숙박">숙박</option>
                                        <option value="스포츠">스포츠</option>
                                        <option value="음식">음식</option>
                                        <option value="학문/교육">학문/교육</option>
                                    </select>
                                </div>
                                <!-- 중분류 -->
                                <div class="n2">
                                    <h1 class="hide">중분류업종 선택</h1>
                                        <select name="catagory2" id="catagory2">
                                            <option value="*">중분류</option>
                                            <option value="소매">소매</option>
                                            <option value="생활서비스">생활서비스</option>
                                            <option value="부동산">부동산</option>
                                            <option value="관광/여가/오락">관광/여가/오락</option>
                                            <option value="숙박">숙박</option>
                                            <option value="스포츠">스포츠</option>
                                            <option value="음식">음식</option>
                                            <option value="학문/교육">학문/교육</option>
                                        </select>
                                </div>
                                <!-- 소분류 -->
                                <div class="n3">
                                    <h1 class="hide">소분류업종 선택</h1>
                                    <select name="catagory3" id="catagory3">
                                        <option value="*">소분류</option>
                                        <option value="소매">소매</option>
                                        <option value="생활서비스">생활서비스</option>
                                        <option value="부동산">부동산</option>
                                        <option value="관광/여가/오락">관광/여가/오락</option>
                                        <option value="숙박">숙박</option>
                                        <option value="스포츠">스포츠</option>
                                        <option value="음식">음식</option>
                                        <option value="학문/교육">학문/교육</option>
                                    </select>
                                </div>
                            
                            </div>
                        </div>
                        <!-- 기간선택 -->
                        <div class="period_layout">
                            <h1 class="hide">분기별 기간선택</h1>
                            <h2>기간 선택</h2>
                            <div class="period_wrap">
                                <div class="select_btn">
                                    <h1 class="hide">1분기버튼</h1>
                                    <button id="btn" name="quart1" class="btn">1분기</button>
                                    <h1 class="hide" class="btn">2분기버튼</h1>
                                    <button id="btn" name="quart2" class="btn">2분기</button>
                                    <h1 class="hide" class="btn">3분기버튼</h1>
                                    <button id="btn" name="quart3" class="btn">3분기</button>
                                    <h1 class="hide" class="btn">4분기버튼</h1>
                                    <button id="btn" name="quart4" class="btn">4분기</button>
                                </div>
                                <div class="select_ymd">
                                    <select name="select_year" id="select_year" class="select_year">
                                        <h1 class="hide">해당년도 선택</h1>
                                        <option value="*">기준연도</option>
                                        <!-- <option value="2018">2018년도</option> -->
                                        <!-- <option value="2019">2019년도</option> -->
                                        <option value="2020">2020년도</option>
                                        <option value="2021">2021년도</option>
                                    </select>
                                    <select name="select_fmonth" id="select_fmonth" class="select_fmonth">
                                        <h1 class="hide">해당월 선택</h1>
                                        <option value="*">기준월</option>
                                        <option value="01">01월</option>
                                        <option value="02">02월</option>
                                        <option value="03">03월</option>
                                        <option value="04">04월</option>
                                        <option value="05">05월</option>
                                        <option value="06">06월</option>
                                        <option value="07">07월</option>
                                        <option value="08">08월</option>
                                        <option value="09">09월</option>
                                        <option value="10">10월</option>
                                        <option value="11">11월</option>
                                        <option value="12">12월</option>
                                    </select>
                                <!--                                
                                    <span>~</span>
                                    <select name="select_tmonth" id="select_tmonth" class="select_tmonth">
                                        <h1 class="hide">해당월 선택</h1>
                                        <option value="">월</option>
                                        <option value="">01</option>
                                        <option value="">02</option>
                                        <option value="">03</option>
                                        <option value="">04</option>
                                        <option value="">05</option>
                                        <option value="">06</option>
                                        <option value="">07</option>
                                        <option value="">08</option>
                                        <option value="">09</option>
                                        <option value="">10</option>
                                        <option value="">11</option>
                                        <option value="">12</option>
                                    </select>
                                -->
                                </div>
                            </div>
                        </div>
                        <!-- 법정동선택 -->
                        <div class="area_layout">
                            <h1 class="hide">지역선택</h1>
                            <h2>지역 선택</h2>
                            <div class="area_wrap">
                                <div class="n1">                            
                                    <h1 class="hide">지역선택하기</h1>
                                    <select name="select_area" id="select_area">
                                        <option value="*">지역선택</option>
                                        <option value="금탄동">금탄동</option>
                                        <option value="대동">대동</option>
                                        <option value="금고동">금고동</option>
                                        <option value="신동">신동</option>
                                        <option value="둔곡동">둔곡동</option>
                                        <option value="구룡동">구룡동</option>
                                        <option value="봉산동">봉산동</option>
                                        <option value="송강동">송강동</option>
                                        <option value="궁동">궁동</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="action_layer">
                            <h1 class="hide">조회버튼</h1>
                            <div class="action_wrap">
                                <h1 class="hide">초회버튼</h1>
                                <button type="button" class="n1" name="submit_data" id="submit_data"><img src="search.png" alt="검색버튼">검색</button>
                                <h1 class="hide">검색버튼</h1>
                                <button type="button" class="n2">초기화</button>
                            </div>
                        </div>
                    </div>
                    <!-- result button layout -->
                    <!--
                    <div class="result_layout">                        
                        <img src="result_btn.png"  alt="펼쳐보기" id="result_btn">
                        <p id="demo"class=""></p>
                    </div>
                -->
                </div>
                <div class="sec02_right_part">
                    <div class="util_wrap">
                        <!-- 로케이션시작 -->
                        <ul class="location_wrap">
                            <li><a href="./"><img src="home_ic.png" alt="홈이미지"></a></li>                            
                            <li><a href="./sub_2.html">매출정보 분석</a></li>                            
                            <li><a href="#!">동네별로 보기</a></li>
                        </ul>
                        <!-- 프린트시작 -->
                        <ul class="print_wrap">
                            <li class="n1"><a href=""><span><i class="fa fa-facebook" aria-hidden="true"></i></span></a></li>
                            <li class="n2"><a href=""><span><i class="fa fa-share-alt" aria-hidden="true"></i></span></a></li>
                            <li class="n3"><a href=""><span><i class="fa fa-print" aria-hidden="true"></i></span></a></li>
                        </ul>
                    </div>
                    <!-- 유성구법정동지도 -->
                    <div class="map_layout">
                        <h1 class="hide">법정동 지도</h1>
                        <img src="sub220127_map.png" alt="법정동 지도" usemap="#Map" />
                    </div>

                    <!-- 그래프 챠트 -->
                    <div class="chart_layout">
                        <div class="chartBox">
                           <canvas id="chart01"></canvas>
                        </div>
                        <div class="chartBox">
                            <canvas id="chart02"></canvas>
                        </div>
                        <div class="chartBox">
                           <canvas id="chart03"></canvas>
                        </div>
                        <div class="chartBox">
                            <canvas id="chart04"></canvas>
                        </div>
                        <div class="chartBox">
                            <canvas id="chart05"></canvas>
                        </div>
                        <div class="chartBox">
                            <canvas id="chart06"></canvas>
                        </div>
                        <div class="chartBox">
                            <canvas id="chart07"></canvas>
                        </div>
                        <div class="chartBox">
                            <canvas id="chart08"></canvas>
                        </div>
                        <div class="chartBox">
                            <canvas id="chart09"></canvas>
                        </div>
                        <div class="chartBox">
                            <canvas id="chart10"></canvas>
                        </div>
                        <div class="chartBox">
                            <canvas id="chart11"></canvas>
                        </div>
                        <div class="chartBox">
                            <canvas id="chart12"></canvas>
                        </div>
                    </div>
                </div>
                <!-- end sec02_inner -->
            </div>
        </div>
        <style>
            .chart_layout{ 
                position:absolute;
                left:0px;
                top:50px;
                width:320px;
                height: 800px;
                /* padding: 30px 0; */
                box-sizing: border-box;
                overflow-y: auto;
                transition: all 0.5s;
                -webkit-transition: all 0.5s;  
            }
            .chart_layout.on{ left:-320px; width: 640px; }
            .chartBox {
                visibility:hidden;
                margin: 30px 0;
                width: 250px;
                /* height:200px; */
                padding: 20px;
                border-radius: 20px;
                border: solid 3px rgba(255, 26, 104, 1);
                background: white;                
            }
            .chartBox.on {
                width:480px;
                height: auto;
            }
            #chart01,#chart02,#chart03,#chart04,#chart05,
            #chart06,#chart07,#chart08,#chart09,#chart10,#chart11,#chart12 { width:100%;height:480px;margin:0;padding:0; }
        </style>
        <map name="Map">
            <area shape="poly" coords="388,6,376,26,357,40,355,51,362,68,367,78,374,81,384,75,393,63,397,56,404,58,409,49,419,51,429,45,435,43,416,21" href="#url1" class="imap1" alt="금탄동">
            <area shape="poly" coords="432,41,404,53,395,63,388,68,400,78,413,94,426,102,440,99,449,92,452,74,446,49" href="#url2" class="imap2" alt="대동">
            <area shape="poly" coords="330,35,327,48,324,60,328,68,328,78,334,86,339,94,335,103,342,113,350,127,360,140,363,125,367,119,379,122,383,103,388,94,372,81,358,69,353,41" href="#url3" class="imap3" alt="신동">
            <area shape="poly" coords="328,106,328,118,322,129,321,140,324,155,329,166,341,170,350,177,361,181,369,186,367,172,366,159" href="#url4" class="imap4" alt="둔곡동">
            <area shape="poly" coords="388,75,390,93,385,113,379,124,372,124,365,142,371,160,381,176,402,172,419,161,429,165,437,152,443,155,441,117,445,102,421,108" href="#url5" class="imap5" alt="금고동">
            <area shape="poly" coords="322,162,314,179,301,189,291,199,283,203,280,220,270,236,273,248,289,255,298,257,308,248,317,239,329,234,336,246,341,246,346,235,357,232,357,216,357,199,364,198,370,196,368,191" href="#url6" class="imap6" alt="구룡동">
            <area shape="poly" coords="373,174,371,185,375,198,363,201,360,229,370,228,379,223,397,223,407,235,418,226,414,218,408,201,416,184,426,176,434,173,444,158,407,171,388,177" href="#url7" class="imap7" alt="봉산동">
            <area shape="poly" coords="361,235,369,245,373,258,381,267,382,277,390,282,397,270,403,252,407,240,401,233,391,228" href="#url8" class="imap8" alt="송강동">
            <area shape="poly" coords="327,239,311,247,302,257,314,265,323,270,326,284,335,292,346,303,356,308,365,300,375,297,383,291,385,285,379,274,372,264,365,248,359,236,340,248" href="#url9" class="imap9" alt="덕진동">
            <area shape="poly" coords="422,228,410,239,402,263,396,282,388,286,381,297,387,302,392,313,391,321,398,326,403,334,406,327,404,314,404,304,408,302,412,297,420,291,423,282,431,271,440,254,441,249" href="#url10" class="imap10" alt="관평동">              
            <area shape="poly" coords="440,252,426,282,414,302,408,309,412,316,421,319,427,319,438,311,443,308,462,278,462,270,460,261" href="#url11" class="imap11" alt="용산동">
            <area shape="poly" coords="466,276,454,300,438,319,425,322,435,328,451,328,465,322,472,317,477,315,484,320,489,328,496,313,491,296,484,282,476,273" href="#url12" class="imap12" alt="탑립동">
            <area shape="poly" coords="409,320,408,341,398,345,388,354,388,368,395,373,408,372,420,369,428,368,440,362,453,371,471,372,476,370,480,353,487,336,488,331,477,321,449,331" href="#url13" class="imap13" alt="전민동">
            <area shape="poly" coords="407,376,390,376,387,382,392,396,398,403,407,402,421,402,434,404,454,404,466,397,474,397,475,377,459,375,443,369" href="#url14" class="imap14" alt="문지동">
            <area shape="poly" coords="409,404,400,407,404,421,410,425,421,426,429,435,439,443,449,445,460,438,472,430,476,418,471,406,474,402,451,412" href="#url15" class="imap15" alt="윈촌동">
            <area shape="poly" coords="381,385,372,389,358,387,353,396,359,407,367,414,377,422,382,428,381,438,384,447,383,457,398,458,409,458,419,457,428,451,437,451,441,447,426,438,404,427,396,407" href="#url16" class="imap16" alt="도룡동">
            <area shape="poly" coords="348,399,340,409,334,415,327,426,320,427,328,438,342,443,354,444,363,437,373,439,381,450,379,435,376,426" href="#url17" class="imap17" alt="가정동">
            <area shape="poly" coords="376,298,371,303,364,308,356,313,360,322,369,331,371,339,363,352,359,360,353,369,352,379,364,383,373,383,383,381,388,373,384,362,389,348,397,339,403,340,391,328,387,315,384,307" href="#url18" class="imap18" alt="화암동">
            <area shape="poly" coords="327,291,322,302,319,314,317,329,321,334,329,344,336,353,345,342,350,347,360,348,365,345,366,336,360,325,352,313,338,301" href="#url19" class="imap19" alt="방현동">
            <area shape="poly" coords="272,253,257,261,248,271,235,280,236,290,251,289,262,300,273,303,284,317,290,320,303,321,311,329,316,317,317,298,321,290,322,277,309,266,289,259" href="#url20" class="imap20" alt="추목동">
            <area shape="poly" coords="308,332,298,329,302,338,308,359,315,369,320,381,323,399,326,416,336,406,347,391,356,389,347,373,352,362,359,354,347,350,329,357,322,345" href="#url21" class="imap21" alt="장동">
            <area shape="poly" coords="231,292,235,305,233,322,222,331,229,348,229,365,241,358,248,369,259,368,264,365,262,347,267,335,280,328,284,322,273,309,259,302,251,296" href="#url22" class="imap22" alt="신봉동">
            <area shape="poly" coords="288,325,282,332,271,338,267,350,270,363,272,379,283,382,293,385,299,387,307,375,310,371,299,348,298,336" href="#url23" class="imap23" alt="자운동">
            <area shape="poly" coords="240,366,231,369,226,378,239,385,249,390,251,400,248,415,259,420,270,424,270,409,277,400,288,397,289,390,277,385,267,375,260,373,248,373" href="#url24" class="imap24" alt="하기동">
            <area shape="poly" coords="314,375,303,389,293,394,288,403,278,408,276,420,273,435,284,437,291,440,296,449,299,458,303,444,308,432,311,427,319,426,321,418,322,412" href="#url25" class="imap25" alt="신성동">
            <area shape="poly" coords="344,450,332,450,336,457,330,462,330,471,333,487,344,483,336,488,352,475,364,458,377,458,376,451,369,443,357,447" href="#url26" class="imap26" alt="구성동">
            <area shape="poly" coords="317,432,310,441,308,457,301,468,297,478,303,481,309,492,314,496,323,493,324,484,324,472,322,461,325,460,327,450,332,446,323,441" href="#url27" class="imap27" alt="어은동">
            <area shape="poly" coords="277,440,274,457,270,466,268,480,273,488,271,502,278,502,288,500,297,503,303,495,293,483,293,472,293,464,296,461,292,452,286,445" href="#url28" class="imap28" alt="궁동">
            <area shape="poly" coords="259,425,249,455,247,466,252,474,261,476,265,468,267,457,271,447,272,438,267,431" href="#url29" class="imap29" alt="죽동">
            <area shape="poly" coords="242,418,239,427,231,438,236,447,240,456,245,446,252,431,255,424,247,421" href="#url30" class="imap30" alt="죽동2">
            <area shape="poly" coords="223,415,218,421,222,430,227,433,235,425,241,419,235,414,228,419" href="#url31" class="imap31" alt="죽동3">
            <area shape="poly" coords="221,378,215,383,211,397,212,408,218,416,221,410,228,412,234,409,241,413,243,404,247,399,241,393,231,388" href="#url32" class="imap32" alt="하기동2">
            <area shape="poly" coords="199,372,192,376,196,385,203,393,209,400,209,387,206,379" href="#url33" class="imap33" alt="반석동2">
            <area shape="poly" coords="160,322,147,351,155,352,166,358,180,362,193,366,205,369,212,377,220,366,221,357,224,345,216,335,205,339,196,333,186,326,172,328" href="#url34" class="imap34" alt="외삼동">
            <area shape="poly" coords="183,273,174,272,161,277,169,291,177,307,177,314,189,320,200,326,210,327,222,323,230,315,227,302,226,286,217,282,206,291,193,283" href="#url35" class="imap35" alt="수남동">
            <area shape="poly" coords="147,278,141,286,135,300,121,305,106,311,105,326,104,338,99,357,95,369,110,360,121,357,129,357,136,357,146,344,154,325,160,316,166,321,175,321,168,308,162,298,159,289,152,284" href="#url36" class="imap36" alt="안산동">
            <area shape="poly" coords="140,365,128,364,110,368,93,377,95,390,106,388,115,393,124,389,131,400,142,401,155,397,171,395,185,395,198,399,196,391,187,381,185,372,178,366,168,366,159,364,150,358" href="#url37" class="imap37" alt="반석동">
            <area shape="poly" coords="93,394,92,404,93,412,98,419,105,418,116,420,127,424,142,424,158,433,159,444,166,453,178,452,186,457,195,456,192,443,197,426,204,415,199,406,189,400,173,399,152,402,134,407,127,400,122,395,105,394" href="#url38" class="imap38" alt="지족동">
            <area shape="poly" coords="211,416,204,430,198,440,208,440,215,441,222,439,221,433,217,425" href="#url39" class="imap39" alt="지족동2">
            <area shape="poly" coords="199,449,199,457,212,457,221,457,227,452,224,445,212,447" href="#url40" class="imap40" alt="지족동3">
            <area shape="poly" coords="101,424,95,428,98,444,98,461,93,471,91,478,88,486,79,493,74,501,75,523,90,534,98,526,115,515,132,509,149,496,160,490,166,475,166,464,159,452,150,443,147,434,131,431,116,432" href="#url41" class="imap41" alt="갑동">
            <area shape="poly" coords="190,461,179,458,175,464,178,474,184,480,188,489,197,492,211,495,224,487,237,472,236,465,236,458,231,452,220,463" href="#url42" class="imap42" alt="노은동">
            <area shape="poly" coords="247,476,236,481,231,493,220,496,221,503,234,503,245,509,253,512,262,512,270,508,268,497,268,490,265,481" href="#url43" class="imap43" alt="장대동">
            <area shape="poly" coords="174,477,171,487,168,497,175,502,183,511,186,519,183,531,198,539,217,546,224,540,242,536,252,540,261,539,259,531,248,524,240,515,230,509,215,507,193,496,183,493" href="#url44" class="imap44" alt="구암동">
            <area shape="poly" coords="328,495,320,500,309,501,298,505,285,506,274,507,266,517,258,517,261,524,268,537,272,526,279,524,292,527,304,523,314,517,320,509" href="#url45" class="imap45" alt="봉명동">
            <area shape="poly" coords="276,530,273,542,273,555,273,562,282,555,295,550,296,542,295,534,286,532" href="#url46" class="imap46" alt="봉명동2">
            <area shape="poly" coords="291,557,279,565,270,575,264,586,257,592,252,599,273,600,289,600,304,599,310,594,303,581,304,571,298,557" href="#url47" class="imap47" alt="원신흥동">
            <area shape="poly" coords="259,543,247,546,239,553,230,564,241,570,246,575,243,581,236,582,239,596,247,599,254,591,261,573,268,567,266,557,268,549" href="#url48" class="imap48" alt="상대동">
            <area shape="poly" coords="228,544,226,555,235,551,240,548,239,545" href="#url49" class="imap49" alt="상대동2">
            <area shape="poly" coords="159,497,149,501,142,512,127,518,113,521,101,534,92,543,95,555,86,563,74,564,64,577,57,587,64,601,79,605,87,601,91,612,98,605,94,591,96,579,106,568,124,552,136,552,150,551,160,554,165,555,169,554,172,550,165,544,166,538,172,537,179,536,178,528,179,518,178,513,168,507" href="#url50" class="imap50" alt="덕명동">
            <area shape="poly" coords="189,538,178,542,180,551,174,555,179,563,198,575,214,582,226,588,233,599,231,584,240,577,236,574,228,571,224,562,205,551,196,546" href="#url51" class="imap51" alt="복용동">
            <area shape="poly" coords="166,564,155,561,137,560,124,560,117,568,108,579,100,589,106,600,110,605,121,601,128,600,134,608,137,620,143,627,155,627,166,632,177,636,185,632,184,623,180,618,171,610,161,604,155,593,159,588,165,586,162,579" href="#url52" class="imap52" alt="계산동">
            <area shape="poly" coords="175,567,172,576,172,588,166,593,171,601,179,607,185,611,187,600,195,599,202,605,210,612,217,614,223,616,226,606,228,600,223,592,211,587,195,579,183,573" href="#url53" class="imap53" alt="학하동">
            <area shape="poly" coords="234,604,233,616,227,623,217,620,209,620,199,617,193,610,189,623,192,633,193,639,206,642,214,644,227,644,236,647,248,644,260,649,258,638,259,625,253,614,257,608,259,604" href="#url54" class="imap54" alt="용계동">
            <area shape="poly" coords="140,631,135,643,142,654,149,662,156,674,169,669,184,666,191,661,199,662,210,676,218,682,230,687,242,693,248,686,255,670,259,668,266,664,262,656,249,651,234,654,222,651,208,651,195,644,175,641,163,637,151,633" href="#url55" class="imap55" alt="대정동">
            <area shape="poly" coords="122,605,110,610,100,617,85,616,78,610,61,611,62,626,81,653,81,669,91,680,91,704,104,716,106,730,115,749,121,757,136,757,146,761,154,763,151,755,144,746,152,740,158,738,169,736,179,735,171,729,166,713,159,697,150,679,137,663,132,648,129,637,134,629,132,617" href="#url56" class="imap56" alt="성북동">
            <area shape="poly" coords="193,667,179,674,165,675,164,685,166,699,174,713,179,723,186,719,193,716,196,716,197,706,204,701,209,701,210,692,205,682" href="#url57" class="imap57" alt="교촌동">
            <area shape="poly" coords="217,687,216,701,206,709,199,719,192,723,183,730,187,740,193,746,198,755,199,765,204,765,210,759,215,740,215,722,224,716,233,712,240,707,246,704,238,696,229,692" href="#url58" class="imap58" alt="원내동">
            <area shape="poly" coords="180,737,166,741,156,745,159,760,160,772,149,768,136,763,120,766,113,772,107,788,102,800,93,793,87,785,78,791,68,807,73,808,62,813,81,826,101,835,110,837,132,838,142,828,157,815,170,811,179,809,179,794,186,776,191,769,193,760,194,754,186,750" href="#url59" class="imap59" alt="방동">
            <area shape="poly" coords="42,710,38,726,38,731,23,735,9,738,6,755,10,765,19,775,24,786,31,797,41,804,45,802,53,805,62,802,69,797,73,784,67,773,55,768,52,747,52,735,48,724,52,715,48,710" href="#url60" class="imap60" alt="송정동">
            <area shape="poly" coords="52,620,41,625,44,638,44,649,37,660,36,680,34,698,41,704,47,699,55,707,57,719,59,737,57,750,61,763,70,767,79,778,79,785,90,781,98,788,106,778,108,766,113,762,104,746,99,726,91,715,86,695,86,682,77,667,75,660,73,648,64,635" href="#url61" class="imap61" alt="세동">            
          </map>        
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- FOOTER PART -->
        <footer include-html="footer.html"></footer>
        <!-- FOOTER PART END-->
	</div>
    <script type="text/javascript">
        includeHTML();
        var result = document.querySelector(".result_layout");
        var demo = document.querySelector(".sec02_left_part");
        var btn = document.querySelector(".result_layout");
        var locate = document.querySelector(".location_wrap");
        var btn_img = document.querySelector("#result_btn");
        var chart_area = document.querySelector(".chart_layout");
        var chart_box = document.querySelector(".chartBox");
        result.onclick = function(){
            // console.log("1");
            demo.classList.toggle("on");
            btn.classList.toggle("on");
            locate.classList.toggle("on");
            btn_img.classList.toggle("on");
            chart_area.classList.toggle("on");
            chart_box.classList.toggle("on");
        };

        // var sec02_left_part = document.querySelector(".sec02_left_part");
        // sec02_left_part.onclick = function(){
        //     sec02_left_part.classList.toggle("on");
        // }

        
        async function fetchData(){
            const url = '';
            const response = await fetch(url);
            const datapoints = await response.json();
            console.log(datapoints);
        }


        $(document).ready(function(){
            //.select_btn button #btn .btn.on

            var find_year="";
            var find_month1="";
            var find_month2="";
            var find_biz1="";
            var find_biz2="";
            var find_biz3="";
            var find_area="";

            var select_year="";
            var select_month1="";
            var select_biz1="";
            var select_biz2="";
            var select_biz3="";
            var select_area="";

            // $('button#submit_data').on('click', function(){
            //     console.log("button#submit_data");
            //     $("div.sec02_left_part").removeClass('on');
            //     $(this).addClass('on');
            // });

            $('button#btn').on('click',function(){
                //console.log($this);
                $('button#btn').removeClass('on');
                $(this).addClass('on');
                // if($(this).hasClass('on')){
                //     //
                //     $(this).removeClass("on");
                // }else{                    
                //     $(this).toggleClass("on");
                // }
            });

            //
            $('img#result').on('click',function(){
                if($(this).hasClass('on'))
                {
                    $("div.checkBox").toggleClass("on");
                }
            });

            //
            $("div.checkBox").on('click',function(){
                //
            });

            //분기별 버틍 클릭
            $("button[name='quart1']").click(function(){
                console.log('quart1');
                $("#select_fmonth").val("03").prop("selected", true);                
                //$("#select_tmonth").val("03").prop("selected", true);
                select_month1 = $("#select_fmonth option:selected").val();
                //find_month2 = $("#select_tmonth option:selected").val();

            });
            $("button[name='quart2']").click(function(){
                console.log('quart2');                
                $("#select_fmonth").val("06").prop("selected", true);
                //$("#select_tmonth").val("06").prop("selected", true);
                select_month1 = $("#select_fmonth option:selected").val();
                //find_month2 = $("#select_tmonth option:selected").val();

            });
            $("button[name='quart3']").click(function(){
                console.log('quart3');                
                $("#select_fmonth").val("09").prop("selected", true);
                //$("#select_tmonth").val("09").prop("selected", true);
                select_month1 = $("#select_fmonth option:selected").val();
                //find_month2 = $("#select_tmonth option:selected").val();

            });
            $("button[name='quart4']").click(function(){
                console.log('quart4');                
                $("#select_fmonth").val("12").prop("selected", true);
                //$("#select_tmonth").val("12").prop("selected", true);
                select_month1 = $("#select_fmonth option:selected").val();
                //find_month2 = $("#select_tmonth option:selected").val();
            });

            $("#submit_data").click(function(){
                // console.log('1');
                $("div.chartBox").css("visibility", "visible");

                select_biz1 = $("#catagory1 option:selected").val();
                select_biz2 = $("#catagory2 option:selected").val();
                select_biz3 = $("#catagory3 option:selected").val();

                select_year = $("#select_year option:selected").val();

                select_area = $("#select_area option:selected").val();

                console.log(select_biz1);

                $.ajax({
                    url:"data.php",
                    method:"POST",
                    data:{action:'fetch', select_biz1:select_biz1,select_biz2:select_biz2,select_biz3:select_biz3,select_year:select_year,select_month1:select_month1,select_area:select_area},
                    beforeSend:function()
                    {
                        $('#submit_data').attr('disabled', 'disabled');
                    },
                    success:function(data)
                    {
                        $('#submit_data').attr('disabled', false);
                        alert("Wait ....");
                        console.log(data);
                        res = JSON.parse(data);
                        console.log(res[0].기준년월+","+res[0].법정동+","+res[0].업종_대분류+","+res[0].업종_중분류+","+res[0].업종_소분류+","+res[0].출력지역_매출금액+","+res[0].출력지역_매출금액_1개월전);
                        // graph1
                        // 기준년월,법정동명,업종_대분류,업종_중분류,업종_소분류,
                        // 출력지역_매출금액,
                        // 출력지역_매출금액_1개월전,
                        // 출력지역_매출금액_2개월전,
                        // 출력지역_매출금액_3개월전,
                        // 출력지역_매출금액_4개월전,
                        // 출력지역_매출금액_5개월전,
                        // 출력지역_매출건수,
                        // 출력지역_매출건수_1개월전,
                        // 출력지역_매출건수_2개월전,
                        // 출력지역_매출건수_3개월전,
                        // 출력지역_매출건수_4개월전,
                        // 출력지역_매출건수_5개월전                        
                        // graph1=[];                        
                        makechart01(res);
                        makechart02(res);
                        makechart03(res);
                        makechart04(res);
                        makechart05(res);
                        makechart06(res);
                        makechart07(res);
                        makechart08(res);
                        makechart09(res);
                        makechart10(res);
                        makechart11(res);
                        makechart12(res);
                        
                    }
                });
                

                // $.ajax({
                //     url:"data.php",
                //     method:"POST",
                //     data:{action:'insert',bind_biz1:find_biz1, bind_biz2:find_biz2,find_biz3:find_biz3,find_month1:find_month1,find_area:find_area},
                //     beforeSend:function(){
                //         $('#submit_data').attr('disabled', 'disabled');
                //     },
                //     success:function(data){
                //         $('#submit_data').attr('disabled', false);
                //         alert("Wait ....");
                //         makechart01();
                //         makechart02();
                //         makechart03();
                //         makechart04();
                //         makechart05();
                //         makechart06();
                //         makechart07();
                //         makechart08();
                //         makechart09();
                //         makechart10();
                //         makechart11();
                //         makechart12();
                //     }
                // });
                //makechart01(select_biz1,select_biz2,select_biz3,select_year,select_month1,select_area);
                //makechart02(select_biz1,select_biz2,select_biz3,select_year,select_month1,select_area);

            });

            $(".imap1").on("click", function(e){
                e.preventDefault();
                alert("금탄동");
            });

            $(".imap2").on("click", function(e){
                e.preventDefault();
                alert("대동");
            });

            $(".imap3").on("click", function(e){
                e.preventDefault();
                alert("신동");
            });

            $(".imap4").on("click", function(e){
                e.preventDefault();
                alert("둔곡동");
            });

            $(".imap5").on("click", function(e){
                e.preventDefault();
                alert("금고동");
            });
            $(".imap6").on("click", function(e){
                e.preventDefault();
                alert("구룡동");
            });
            $(".imap7").on("click", function(e){
                e.preventDefault();
                alert("봉산동");
            });
            $(".imap8").on("click", function(e){
                e.preventDefault();
                alert("송강동");
            });
            $(".imap9").on("click", function(e){
                e.preventDefault();
                alert("덕진동");
            });
            $(".imap10").on("click", function(e){
                e.preventDefault();
                alert("관평동");
            });
            $(".imap11").on("click", function(e){
                e.preventDefault();
                alert("용산동");
            });                
            $(".imap12").on("click", function(e){
                e.preventDefault();
                alert("탑립동");
            });                
            $(".imap13").on("click", function(e){
                e.preventDefault();
                alert("전민동");
            });                
            $(".imap14").on("click", function(e){
                e.preventDefault();
                alert("문지동");
            });                
            $(".imap15").on("click", function(e){
                e.preventDefault();
                alert("원촌동");
            });                
            $(".imap16").on("click", function(e){
                e.preventDefault();
                alert("도룡동");
            });                
            $(".imap17").on("click", function(e){
                e.preventDefault();
                alert("가정동");
            });                
            $(".imap18").on("click", function(e){
                e.preventDefault();
                alert("화암동");
            });                
            $(".imap19").on("click", function(e){
                e.preventDefault();
                alert("방현동");
            });                
            $(".imap20").on("click", function(e){
                e.preventDefault();
                alert("추목동");
            });                
            $(".imap21").on("click", function(e){
                e.preventDefault();
                alert("장동");  
            });                              
            $(".imap22").on("click", function(e){
                e.preventDefault();
                alert("신봉동");
            });                              
            $(".imap23").on("click", function(e){
                e.preventDefault();
                alert("자운동");            
            });                              
            $(".imap24").on("click", function(e){
                e.preventDefault();
                alert("하기동");            
            });                              
            $(".imap25").on("click", function(e){
                e.preventDefault();
                alert("신성동");            
            });                              
            $(".imap26").on("click", function(e){
                e.preventDefault();
                alert("구성동");            
            });                              
            $(".imap27").on("click", function(e){
                e.preventDefault();
                alert("어은동");            
            });                              
            $(".imap28").on("click", function(e){
                e.preventDefault();
                alert("궁동");            
            });                              
            $(".imap29").on("click", function(e){
                e.preventDefault();
                alert("죽동");            
            });                              
            $(".imap30").on("click", function(e){
                e.preventDefault();
                alert("죽동");            
            });                              
            $(".imap31").on("click", function(e){
                e.preventDefault();
                alert("죽동");            
            });                                          
            $(".imap32").on("click", function(e){
                e.preventDefault();
                alert("하기동");            
            });                              
            $(".imap33").on("click", function(e){
                e.preventDefault();
                alert("반석동");            
            });                              
            $(".imap34").on("click", function(e){
                e.preventDefault();
                alert("외삼동");            
            });                              
            $(".imap35").on("click", function(e){
                e.preventDefault();
                alert("수남동");            
            });                              
            $(".imap36").on("click", function(e){
                e.preventDefault();
                alert("안산동");            
            });                              
            $(".imap37").on("click", function(e){
                e.preventDefault();
                alert("반석동");            
            });                              
            $(".imap38").on("click", function(e){
                e.preventDefault();
                alert("죽동");            
            });                              
            $(".imap39").on("click", function(e){
                e.preventDefault();
                alert("지족동");            
            });                              
            $(".imap40").on("click", function(e){
                e.preventDefault();
                alert("지족동");            
            });                              
            $(".imap41").on("click", function(e){
                e.preventDefault();
                alert("갑동");            
            });                              
            $(".imap42").on("click", function(e){
                e.preventDefault();
                alert("노은동");            
            });                              
            $(".imap43").on("click", function(e){
                e.preventDefault();
                alert("장대동");            
            });                              
            $(".imap44").on("click", function(e){
                e.preventDefault();
                alert("구암동");            
            });                              
            $(".imap45").on("click", function(e){
                e.preventDefault();
                alert("봉명동");            
            });                              
            $(".imap46").on("click", function(e){
                e.preventDefault();
                alert("동명동");            
            });                              
            $(".imap47").on("click", function(e){
                e.preventDefault();
                alert("원신흥동");            
            });                              
            $(".imap48").on("click", function(e){
                e.preventDefault();
                alert("상대동");            
            });                              
            $(".imap49").on("click", function(e){
                e.preventDefault();
                alert("상대동"); 
            });                                             
            $(".imap50").on("click", function(e){
                e.preventDefault();
                alert("덕명동");            
            });                                             
            $(".imap51").on("click", function(e){
                e.preventDefault();
                alert("복용동");            
            });                                            
            $(".imap52").on("click", function(e){
                e.preventDefault();
                alert("계산동");            
            });                                            
            $(".imap53").on("click", function(e){
                e.preventDefault();
                alert("학하동");            
            });                                            
            $(".imap54").on("click", function(e){
                e.preventDefault();
                alert("용계동");            
            });                                            
            $(".imap55").on("click", function(e){
                e.preventDefault();
                alert("대정동");            
            });                                            
            $(".imap56").on("click", function(e){
                e.preventDefault();
                alert("성북동");            
            });                                            
            $(".imap57").on("click", function(e){
                e.preventDefault();
                alert("교촌동");            
            });                                                        
            $(".imap58").on("click", function(e){
                e.preventDefault();
                alert("원내동");            
            });                                            
            $(".imap59").on("click", function(e){
                e.preventDefault();
                alert("방동");            
            });                                            
            $(".imap60").on("click", function(e){
                e.preventDefault();
                alert("송정동");            
            });                                             
            $(".imap61").on("click", function(e){
                e.preventDefault();
                alert("세동");            
            });         
            
           
        });
        
        // makeChart
        // makechart01();
        // makechart02();
        // makechart03();
        // makechart04();
        // makechart05();
        // makechart06();
        // makechart07();
        // makechart08();
        // makechart09();
        // makechart10();
        // makechart11();
        // makechart12();

        // makechar01
        function makechart01(res)
        {
            var n1 = res[0].출력지역_매출금액_1개월전;
            var n2 = res[0].출력지역_매출금액_2개월전;
            var n3 = res[0].출력지역_매출금액_3개월전;
            var n4 = res[0].출력지역_매출금액_4개월전;
            var n5 = res[0].출력지역_매출금액_5개월전;

            var m1 = res[0].출력지역_매출건수_1개월전;
            var m2 = res[0].출력지역_매출건수_2개월전;
            var m3 = res[0].출력지역_매출건수_3개월전;
            var m4 = res[0].출력지역_매출건수_4개월전;
            var m5 = res[0].출력지역_매출건수_5개월전;            

            if(n1 == "NULL")
            {
                n1 = 0;
            }
            if(n2 == "NULL")
            {
                n2 = 0;
            }
            if(n3 == "NULL")
            {
                n3 = 0;
            }
            if(n4 == "NULL")
            {
                n4 = 0;
            }
            if(n5 == "NULL")
            {
                n5 = 0;
            }

            if(m1 == "NULL")
            {
                m1 = 0;
            }
            if(m2 == "NULL")
            {
                m2 = 0;
            }
            if(m3 == "NULL")
            {
                m3 = 0;
            }
            if(m4 == "NULL")
            {
                m4 = 0;
            }
            if(m5 == "NULL")
            {
                m5 = 0;
            }

            const data01 = {
                labels: [
                    '출력지역_매출금액_1개월전',
                    '출력지역_매출금액_2개월전',
                    '출력지역_매출금액_3개월전',
                    '출력지역_매출금액_4개월전',
                    '출력지역_매출금액_5개월전',
                    '출력지역_매출건수_1개월전',
                    '출력지역_매출건수_2개월전',
                    '출력지역_매출건수_3개월전',
                    '출력지역_매출건수_4개월전',
                    '출력지역_매출건수_5개월전'
                ],
                datasets: [
                    {
                        label: '출력지역_매출금액',
                        data: [n1,n2,n3,n4,n5],
                        fill: false,
                        // backgroundColor: 'rgba(255, 255, 255, 0.2)',
                        // borderColor: 'rgb(255, 99, 132)',
                        // pointBackgroundColor: 'rgb(255, 255, 255)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(204, 101, 254)',
                        backgroundColor: 'rgba(204, 101, 254, 0.5)',                        
                        yAxisID: 'y',
                    },                    
                    {
                        label: '출력지역_매출건수',
                        data: [m1,m2,m3,m4,m5],
                        fill: false,
                        // backgroundColor: 'rgba(255, 255, 255, 0.2)',
                        // backgroundColor: 'rgba(231, 188, 188, 0.2)',
                        // borderColor: 'rgb(231, 188, 188)',
                        //pointBackgroundColor: 'rgb(231, 188, 188)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(132, 188, 188)',
                        borderColor: 'rgb(54,162,235)',
                        backgroundColor: 'rgba(54,162,235, 0.5)',                        
                        yAxisID: 'y1',
                    }
                ]
            };
            // End
            const config = {
                type: 'bar',
                data: data01,
                options: {
                    responsive: true,
                    plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: '01_매출분석'
                    }
                    }
                },
            }

            const config2 = {
                type: 'bar',
                data: data01,
                options: {
                    responsive: true,
                    interaction: {
                    mode: 'index',
                    intersect: false,
                    },
                    stacked: false,
                    plugins: {
                    title: {
                        display: true,
                        text: '01_매출분석'
                    }
                    },
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',

                            // grid line settings
                            grid: {
                            drawOnChartArea: true, // only want the grid lines for one axis to show up
                            },
                        },
                    }
                },
            };

            const chart01 = new Chart(
                document.getElementById('chart01'),
                config2
            );

            // chart01.destroy();           

            // $.ajax({
            //     url:"data01.php",
            //     method:"POST",
            //     data:{select_biz1:select_biz1,select_biz2:select_biz2,select_biz3:select_biz3,select_year:select_year,select_month1:select_month1,select_area:select_area},
            //     dataType:"JSON",
            //     success:function(data)
            //     {
            //         var find_biz1 = [];
            //         var find_biz2 = [];
            //         var find_biz3 = [];
            //         var find_month1 = [];
            //         var find_month1 = [];
            //         var total = [];
            //         var color = [];

            //         console.log(data);

            //         for(var count=0; count<data.length; count++)
            //         {
            //             find_biz1.push(data[count].biz1);
            //             find_biz2.push(data[count].biz2);
            //             find_biz3.push(data[count].biz3);

            //             total.push(data[count].total);
            //             color.push(data[count].color);
            //         }

            //         var chart_data = {
            //             label:sales,
            //             dataset:[
            //                 {
            //                     label:'chart01',
            //                     backgroundColor:color,
            //                     color: '#fff',
            //                     data: total
            //                 }
            //             ]
            //         };

            //         var options ={
            //             responsive:true,
            //             scales:{
            //                 yAxes:[{
            //                     ticks:{
            //                         min:0
            //                     }
            //                 }]
            //             }
            //         };

            //         var group_chart1 = $('#chart01');

            //         var graph1 = new Chart(group_chart1, {
            //             type:"line",
            //             data:chart_data
            //         });
            //     }
            // });
        }

        // makechar02
        function makechart02(res)
        {
            var k1 = res[1].출력지역_매출금액_1개월전;
            var k2 = res[1].출력지역_매출금액_2개월전;
            var k3 = res[1].출력지역_매출금액_3개월전;
            var k4 = res[1].출력지역_매출금액_4개월전;
            var k5 = res[1].출력지역_매출금액_5개월전;


            if(k1 == "NULL")
            {
                k1 = 0;
            }
            if(k2 == "NULL")
            {
                k2 = 0;
            }
            if(k3 == "NULL")
            {
                k3 = 0;
            }
            if(k4 == "NULL")
            {
                k4 = 0;
            }
            if(k5 == "NULL")
            {
                k5 = 0;
            }

            const data02 = {
                labels: [
                    '출력지역_매출금액_1개월전',
                    '출력지역_매출금액_2개월전',
                    '출력지역_매출금액_3개월전',
                    '출력지역_매출금액_4개월전',
                    '출력지역_매출금액_5개월전'
                ],
                datasets: [
                    {
                        label: '출력지역_매출금액',
                        data: [k1,k2,k3,k4,k5],
                        fill: false,
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(204, 101, 254)',
                        backgroundColor: 'rgba(204, 101, 254, 0.5)',                        
                        yAxisID: 'y',
                    }
                ]
            };
            // End
            const config = {
                type: 'bar',
                data: data02,
                options: {
                    responsive: true,
                    plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: '02_매출분석'
                    }
                    }
                },
            }

            const config2 = {
                type: 'bar',
                data: data02,
                options: {
                    responsive: true,
                    interaction: {
                    mode: 'index',
                    intersect: false,
                    },
                    stacked: false,
                    plugins: {
                    title: {
                        display: true,
                        text: '02_매출분석'
                    }
                    },
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',

                            // grid line settings
                            grid: {
                            drawOnChartArea: true, // only want the grid lines for one axis to show up
                            },
                        },
                    }
                },
            };

            const chart02 = new Chart(
                document.getElementById('chart02'),
                config
            );
            // $.ajax({
            //     url:"data02.php",
            //     method:"POST",
            //     data:{action:'fetch',select_biz1:select_biz1,select_biz2:select_biz2,select_biz3:select_biz3,select_year:select_year,select_month1:select_month1,select_area:select_area},
            //     dataType:"JSON",
            //     success:function(data)
            //     {
            //         var find_biz1 = [];
            //         var find_biz2 = [];
            //         var find_biz3 = [];
            //         var find_month1 = [];
            //         var find_month1 = [];
            //         var total = [];
            //         var color = [];

            //         for(var count=0; count<data.length; count++)
            //         {
            //             find_biz1.push(data[count].biz1);
            //             find_biz2.push(data[count].biz2);
            //             find_biz3.push(data[count].biz3);

            //             total.push(data[count].total);
            //             color.push(data[count].color);
            //         }

            //         var chart_data = {
            //             label:sales,
            //             dataset:[
            //                 {
            //                     label:'char02',
            //                     backgroundColor:color,
            //                     color: '#fff',
            //                     data: total
            //                 }
            //             ]
            //         };

            //         var options ={
            //             responsive:true,
            //             scales:{
            //                 yAxes:[{
            //                     ticks:{
            //                         min:0
            //                     }
            //                 }]
            //             }
            //         };

            //         var group_chart2 = $('#chart02');

            //         var graph2 = new Chart(group_chart2, {
            //             type:"line",
            //             data:chart_data
            //         });
            //     }
            // });
        }

        // makechar03
        function makechart03(res)
        {
            var n1 = res[2].매출금액_지역1위명;
            var n2 = res[2].매출금액_지역2위명;
            var n3 = res[2].매출금액_지역3위명;
            var n4 = res[2].매출금액_지역4위명;
            var n5 = res[2].매출금액_지역5위명;

            var k1 = res[2].지역1위_매출금액;
            var k2 = res[2].지역2위_매출금액;
            var k3 = res[2].지역3위_매출금액;
            var k4 = res[2].지역4위_매출금액;
            var k5 = res[2].지역5위_매출금액;

            
            if(k1 == "NULL")
            {
                k1 = 0;
            }
            if(k2 == "NULL")
            {
                k2 = 0;
            }
            if(k3 == "NULL")
            {
                k3 = 0;
            }
            if(k4 == "NULL")
            {
                k4 = 0;
            }
            if(k5 == "NULL")
            {
                k5 = 0;
            }

            console.log(n1);
            const data03 = {
                labels: [
                    n1, // '매출금액_지역1위명',
                    n2, // '매출금액_지역2위명',
                    n3, // '매출금액_지역3위명',
                    n4, // '매출금액_지역4위명',
                    n5  // '매출금액_지역5위명'
                ],
                datasets: [
                    {
                        label: '03_매출분석',
                        data: [k1,k2,k3,k4,k5],
                        fill: false,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgb(54, 162, 235)',
                        borderWidth: 1,
                    }
                ]
            };
            // End
            const config = {
                type: 'line',
                data: data03,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: '03_매출분석'
                        }
                    }
                },
            }

            const config2 = {
                type: 'line',
                data: data03,
                options: {
                    scales: {
                        x: {
                            grid: {
                                borderColor: 'red'
                            }
                        }
                    }
                },
            };

            const chart03 = new Chart(
                document.getElementById('chart03'),
                config
            );
            // $.ajax({
            //     url:"data03.php",
            //     method:"POST",
            //     data:{action:'fetch'},
            //     dataType:"JSON",
            //     success:function(data)
            //     {
            //         var find_biz1 = [];
            //         var find_biz2 = [];
            //         var find_biz3 = [];
            //         var find_month1 = [];
            //         var find_month1 = [];
            //         var total = [];
            //         var color = [];

            //         for(var count=0; count<data.length; count++)
            //         {
            //             find_biz1.push(data[count].biz1);
            //             find_biz2.push(data[count].biz2);
            //             find_biz3.push(data[count].biz3);

            //             total.push(data[count].total);
            //             color.push(data[count].color);
            //         }

            //         var chart_data = {
            //             label:sales,
            //             dataset:[
            //                 {
            //                     label:'chart03',
            //                     backgroundColor:color,
            //                     color: '#fff',
            //                     data: total
            //                 }
            //             ]
            //         };

            //         var options ={
            //             responsive:true,
            //             scales:{
            //                 yAxes:[{
            //                     ticks:{
            //                         min:0
            //                     }
            //                 }]
            //             }
            //         };

            //         var group_chart3 = $('#chart03');

            //         var graph3 = new Chart(group_chart3, {
            //             type:"line",
            //             data:chart_data
            //         });
            //     }
            // });
        }

        // makechar04
        function makechart04(res)
        {
            var n1 = res[3].매출건수_지역1위명;
            var n2 = res[3].매출건수_지역2위명;
            var n3 = res[3].매출건수_지역3위명;
            var n4 = res[3].매출건수_지역4위명;
            var n5 = res[3].매출건수_지역5위명;

            var k0 = res[3].출력지역_매출건수랭킹;
            var k1 = res[3].지역1위_매출건수;
            var k2 = res[3].지역2위_매출건수;
            var k3 = res[3].지역3위_매출건수;
            var k4 = res[3].지역4위_매출건수;
            var k5 = res[3].지역5위_매출건수;

            console.log("makechart04 -> "+k0+","+k1+","+k2+","+k3+","+k4+","+k5);

            const data04 = {
                labels: [
                    n1, // 매출건수_지역1위명
                    n2, // 매출건수_지역2위명
                    n3, // 매출건수_지역3위명
                    n4, // 매출건수_지역4위명
                    n5  // 매출건수_지역5위명
                ],
                datasets: [
                    {
                        label: '04_매출분석',
                        data: [k1,k2,k3,k4,k5],
                        fill: false,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgb(54, 162, 235)',                       
                        borderWidth: 1,
                    }
                ]
            };
            // End
            const config = {
                type: 'line',
                data: data04,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: '04_매출분석'
                        }
                    }
                },
            }

            const config2 = {
                type: 'line',
                data: data04,
                options: {
                    scales: {
                        x: {
                            grid: {
                                borderColor: 'red'
                            }
                        },
                        y: {
                            suggestedMin: 0,
                            suggestedMax: k0
                        }
                    }
                },
            };

            const chart04 = new Chart(
                document.getElementById('chart04'),
                config2
            );
            // $.ajax({
            //     url:"data04.php",
            //     method:"POST",
            //     data:{action:'fetch'},
            //     dataType:"JSON",
            //     success:function(data)
            //     {
            //         var find_biz1 = [];
            //         var find_biz2 = [];
            //         var find_biz3 = [];
            //         var find_month1 = [];
            //         var find_month1 = [];
            //         var total = [];
            //         var color = [];

            //         for(var count=0; count<data.length; count++)
            //         {
            //             find_biz1.push(data[count].biz1);
            //             find_biz2.push(data[count].biz2);
            //             find_biz3.push(data[count].biz3);

            //             total.push(data[count].total);
            //             color.push(data[count].color);
            //         }

            //         var chart_data = {
            //             label:sales,
            //             dataset:[
            //                 {
            //                     label:'chart04',
            //                     backgroundColor:color,
            //                     color: '#fff',
            //                     data: total
            //                 }
            //             ]
            //         };

            //         var options ={
            //             responsive:true,
            //             scales:{
            //                 yAxes:[{
            //                     ticks:{
            //                         min:0
            //                     }
            //                 }]
            //             }
            //         };

            //         var group_chart4 = $('#chart04');

            //         var graph4 = new Chart(group_chart4, {
            //             type:"line",
            //             data:chart_data
            //         });
            //     }
            // });
        }

        // makechart05
        function makechart05(res)
        {
            var n1 = res[4].매출금액_업종1위명;
            var n2 = res[4].매출금액_업종2위명;
            var n3 = res[4].매출금액_업종3위명;
            var n4 = res[4].매출금액_업종4위명;
            var n5 = res[4].매출금액_업종5위명;

            n1 = n1.replace(/^\s+|\s+$/gm,'');
            n2 = n2.replace(/^\s+|\s+$/gm,'');
            n3 = n3.replace(/^\s+|\s+$/gm,'');
            n4 = n4.replace(/^\s+|\s+$/gm,'');
            n5 = n5.replace(/^\s+|\s+$/gm,'');

            var k0 = res[4].출력업종_매출금액랭킹;
            var k1 = res[4].업종1위_매출금액;
            var k2 = res[4].업종2위_매출금액;
            var k3 = res[4].업종3위_매출금액;
            var k4 = res[4].업종4위_매출금액;
            var k5 = res[4].업종5위_매출금액;


            if(k1 == "NULL")
            {
                k1 = 0;
            }
            if(k2 == "NULL")
            {
                k2 = 0;
            }
            if(k3 == "NULL")
            {
                k3 = 0;
            }
            if(k4 == "NULL")
            {
                k4 = 0;
            }
            if(k5 == "NULL")
            {
                k5 = 0;
            }

            console.log("makechart05 -> "+k1+","+k2+","+k3+","+k4+","+k5);
            console.log("makechart05 -> "+n1+","+n2+","+n3+","+n4+","+n5);

            const data05 = {
                labels: [
                    n1, // 매출건수_지역1위명
                    n2, // 매출건수_지역2위명
                    n3, // 매출건수_지역3위명
                    n4, // 매출건수_지역4위명
                    n5  // 매출건수_지역5위명
                ],
                datasets: [
                    {
                        label: '05_매출분석',
                        data: [k1,k2,k3,k4,k5],
                        fill: false,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgb(54, 162, 235)',                       
                        borderWidth: 1,
                    }
                ]
            };
            // End
            const config = {
                type: 'line',
                data: data05,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: '05_매출분석'
                        }
                    }
                },
            }

            const config2 = {
                type: 'line',
                data: data05,
                options: {
                    scales: {
                        x: {
                            grid: {
                                borderColor: 'red'
                            }
                        },
                        y: {
                            suggestedMin: 0,
                            suggestedMax: k0
                        }
                    }
                },
            };

            const chart05 = new Chart(
                document.getElementById('chart05'),
                config
            );
            // $.ajax({
            //     url:"data05.php",
            //     method:"POST",
            //     data:{action:'fetch'},
            //     dataType:"JSON",
            //     success:function(data)
            //     {
            //         var find_biz1 = [];
            //         var find_biz2 = [];
            //         var find_biz3 = [];
            //         var find_month1 = [];
            //         var find_month1 = [];
            //         var total = [];
            //         var color = [];

            //         for(var count=0; count<data.length; count++)
            //         {
            //             find_biz1.push(data[count].biz1);
            //             find_biz2.push(data[count].biz2);
            //             find_biz3.push(data[count].biz3);

            //             total.push(data[count].total);
            //             color.push(data[count].color);
            //         }

            //         var chart_data = {
            //             label:sales,
            //             dataset:[
            //                 {
            //                     label:'chart05',
            //                     backgroundColor:color,
            //                     color: '#fff',
            //                     data: total
            //                 }
            //             ]
            //         };

            //         var options ={
            //             responsive:true,
            //             scales:{
            //                 yAxes:[{
            //                     ticks:{
            //                         min:0
            //                     }
            //                 }]
            //             }
            //         };

            //         var group_chart5 = $('#chart05');

            //         var graph5 = new Chart(group_chart5, {
            //             type:"line",
            //             data:chart_data
            //         });
            //     }
            // });
        }

        // makechar06
        function makechart06(res)
        {
            var n1 = res[5].매출건수_업종1위명;
            var n2 = res[5].매출건수_업종2위명;
            var n3 = res[5].매출건수_업종3위명;
            var n4 = res[5].매출건수_업종4위명;
            var n5 = res[5].매출건수_업종5위명;

            var k0 = res[5].출력업종_매출건수랭킹;
            var k1 = res[5].업종1위_매출건수;
            var k2 = res[5].업종2위_매출건수;
            var k3 = res[5].업종3위_매출건수;
            var k4 = res[5].업종4위_매출건수;
            var k5 = res[5].업종5위_매출건수;

            if(k1 == "NULL")
            {
                k1 = 0;
            }
            if(k2 == "NULL")
            {
                k2 = 0;
            }
            if(k3 == "NULL")
            {
                k3 = 0;
            }
            if(k4 == "NULL")
            {
                k4 = 0;
            }
            if(k5 == "NULL")
            {
                k5 = 0;
            }

            console.log("makechart06 -> "+k0+","+k1+","+k2+","+k3+","+k4+","+k5);

            const data06 = {
                labels: [
                    n1, // 매출건수_지역1위명
                    n2, // 매출건수_지역2위명
                    n3, // 매출건수_지역3위명
                    n4, // 매출건수_지역4위명
                    n5  // 매출건수_지역5위명
                ],
                datasets: [
                    {
                        label: '06_매출분석',
                        data: [
                            res[5].업종1위_매출건수,
                            res[5].업종2위_매출건수,
                            res[5].업종3위_매출건수,
                            res[5].업종4위_매출건수,
                            res[5].업종5위_매출건수
                        ],
                        fill: false,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgb(54, 162, 235)',                       
                        borderWidth: 1,
                    }
                ]
            };
            // End
            const config = {
                type: 'line',
                data: data06,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: '06_매출분석'
                        }
                    }
                },
            }

            const config2 = {
                type: 'line',
                data: data06,
                options: {
                    scales: {
                        x: {
                            grid: {
                                borderColor: 'red'
                            }
                        }
                    }
                },
            };

            const chart06 = new Chart(
                document.getElementById('chart06'),
                config2
            );
            // $.ajax({
            //     url:"data06.php",
            //     method:"POST",
            //     data:{action:'fetch'},
            //     dataType:"JSON",
            //     success:function(data)
            //     {
            //         var find_biz1 = [];
            //         var find_biz2 = [];
            //         var find_biz3 = [];
            //         var find_month1 = [];
            //         var find_month1 = [];
            //         var total = [];
            //         var color = [];

            //         for(var count=0; count<data.length; count++)
            //         {
            //             find_biz1.push(data[count].biz1);
            //             find_biz2.push(data[count].biz2);
            //             find_biz3.push(data[count].biz3);

            //             total.push(data[count].total);
            //             color.push(data[count].color);
            //         }

            //         var chart_data = {
            //             label:sales,
            //             dataset:[
            //                 {
            //                     label:'chart06',
            //                     backgroundColor:color,
            //                     color: '#fff',
            //                     data: total
            //                 }
            //             ]
            //         };

            //         var options ={
            //             responsive:true,
            //             scales:{
            //                 yAxes:[{
            //                     ticks:{
            //                         min:0
            //                     }
            //                 }]
            //             }
            //         };

            //         var group_chart6 = $('#chart06');

            //         var graph6 = new Chart(group_chart6, {
            //             type:"line",
            //             data:chart_data
            //         });
            //     }
            // });
        }

        //makechar07
        function makechart07(res)
        {
            var n1 = '남성_매출금액'; // res[6].남성_매출금액;
            var n2 = '여성_매출금액'; // res[6].여성_매출금액;
            var n3 = ''; // res[6].매출건수_업종3위명;
            var n4 = ''; // res[6].매출건수_업종4위명;
            var n5 = ''; // res[6].매출건수_업종5위명;

            var k1 = res[6].성별통합_매출금액;
            var k2 = res[6].남성_매출금액;
            var k3 = res[6].여성_매출금액;
            // var k4 = res[6].업종4위_매출건수;
            // var k5 = res[6].업종5위_매출건수;

            console.log(n1+","+k2);

            const data07 = {
                labels: [
                    n1, // 남성_매출금액
                    n2  // 여성_매출금액
                ],
                datasets: [
                    {
                        label: '07_매출분석',
                        data: [res[6].남성_매출금액,res[6].남성_매출금액],
                        fill: false,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgb(54, 162, 235)',                       
                        borderWidth: 1,
                    }
                ]
            };
            // End
            const config = {
                type: 'line',
                data: data07,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: '07_매출분석'
                        }
                    }
                },
            }

            const config2 = {
                type: 'line',
                data: data07,
                options: {
                    scales: {
                        x: {
                            grid: {
                                borderColor: 'red'
                            }
                        }
                    }
                },
            };

            const chart07 = new Chart(
                document.getElementById('chart07'),
                config
            );
            // $.ajax({
            //     url:"data07.php",
            //     method:"POST",
            //     data:{action:'fetch'},
            //     dataType:"JSON",
            //     success:function(data)
            //     {
            //         var find_biz1 = [];
            //         var find_biz2 = [];
            //         var find_biz3 = [];
            //         var find_month1 = [];
            //         var find_month1 = [];
            //         var total = [];
            //         var color = [];

            //         for(var count=0; count<data.length; count++)
            //         {
            //             find_biz1.push(data[count].biz1);
            //             find_biz2.push(data[count].biz2);
            //             find_biz3.push(data[count].biz3);

            //             total.push(data[count].total);
            //             color.push(data[count].color);
            //         }

            //         var chart_data = {
            //             label:sales,
            //             dataset:[
            //                 {
            //                     label:'chart07',
            //                     backgroundColor:color,
            //                     color: '#fff',
            //                     data: total
            //                 }
            //             ]
            //         };

            //         var options ={
            //             responsive:true,
            //             scales:{
            //                 yAxes:[{
            //                     ticks:{
            //                         min:0
            //                     }
            //                 }]
            //             }
            //         };

            //         var group_chart7 = $('#chart07');

            //         var graph7 = new Chart(group_chart7, {
            //             type:"line",
            //             data:chart_data
            //         });
            //     }
            // });
        }

        // makechar08
        function makechart08(res)
        {
            var n1 = '남성_매출건수'; // res[6].남성_매출건수;
            var n2 = '여성_매출건수'; // res[6].여성_매출건수;
            var n3 = ''; // res[6].매출건수_업종3위명;
            var n4 = ''; // res[6].매출건수_업종4위명;
            var n5 = ''; // res[6].매출건수_업종5위명;

            var k1 = res[7].성별통합_매출건수;
            var k2 = res[7].남성_매출건수;
            var k3 = res[7].여성_매출건수;
            // var k4 = res[6].업종4위_매출건수;
            // var k5 = res[6].업종5위_매출건수;
            if(k1 == "NULL")
            {
                k1=0;
            }
            if(k2 == "NULL")
            {
                k2=0;
            }

            console.log("makechart08 -> "+k1+","+k2+","+k3);

            const data08 = {
                labels: [
                    n1, // 남성_매출건수
                    n2  // 여성_매출건수
                ],
                datasets: [
                    {
                        label: '08_매출분석',
                        data: [k1,k2,k3],
                        fill: false,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgb(54, 162, 235)',                       
                        borderWidth: 1,
                    }
                ]
            };
            // End
            const config = {
                type: 'line',
                data: data08,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: '08_매출분석'
                        }
                    }
                },
            }

            const config2 = {
                type: 'line',
                data: data08,
                options: {
                    scales: {
                        x: {
                            grid: {
                                borderColor: 'red'
                            }
                        },
                        y: {
                            suggestedMin: 0,
                            suggestedMax: k1
                        }
                    }
                },
            };

            const chart08 = new Chart(
                document.getElementById('chart08'),
                config2
            );
            // $.ajax({
            //     url:"data08.php",
            //     method:"POST",
            //     data:{action:'fetch'},
            //     dataType:"JSON",
            //     success:function(data)
            //     {
            //         var find_biz1 = [];
            //         var find_biz2 = [];
            //         var find_biz3 = [];
            //         var find_month1 = [];
            //         var find_month1 = [];
            //         var total = [];
            //         var color = [];

            //         for(var count=0; count<data.length; count++)
            //         {
            //             find_biz1.push(data[count].biz1);
            //             find_biz2.push(data[count].biz2);
            //             find_biz3.push(data[count].biz3);

            //             total.push(data[count].total);
            //             color.push(data[count].color);
            //         }

            //         var chart_data = {
            //             label:sales,
            //             dataset:[
            //                 {
            //                     label:'chart08',
            //                     backgroundColor:color,
            //                     color: '#fff',
            //                     data: total
            //                 }
            //             ]
            //         };

            //         var options ={
            //             responsive:true,
            //             scales:{
            //                 yAxes:[{
            //                     ticks:{
            //                         min:0
            //                     }
            //                 }]
            //             }
            //         };

            //         var group_chart8 = $('#chart08');

            //         var graph8 = new Chart(group_chart8, {
            //             type:"line",
            //             data:chart_data
            //         });
            //     }
            // });
        }

        //makechar09
        function makechart09(res)
        {
            var n1 = '20대_매출금액'; // res[6].남성_매출건수;
            var n2 = '30대_매출금액'; // res[6].여성_매출건수;
            var n3 = '40대_매출금액'; // res[6].매출건수_업종3위명;
            var n4 = '50대_매출금액'; // res[6].매출건수_업종4위명;
            var n5 = '60대이상_매출금액' ; // res[6].매출건수_업종5위명;

            var k0 = res[8].연령통합_매출금액;
            var k1 = res[8].K20대_매출금액;
            var k2 = res[8].K30대_매출금액;
            var k3 = res[8].K40대_매출금액;
            var k4 = res[8].K50대_매출금액;
            var k5 = res[8].K60대이상_매출금액;
            
            if(k1 == "NULL")
            {
                k1 = 0;
            }
            if(k2 == "NULL")
            {
                k2 = 0;
            }if(k3 == "NULL")
            {
                k3 = 0;
            }if(k4 == "NULL")
            {
                k4 = 0;
            }if(k5 == "NULL")
            {
                k5 = 0;
            }
            console.log("makechart09 -> "+k1+","+k2+","+k3+","+k4+","+k5);

            const data09 = {
                labels: [
                    n1,
                    n2,
                    n3,
                    n4,
                    n5
                ],
                datasets: [
                    {
                        label: '09_매출분석',
                        data: [k1,k2,k3,k4,k5],
                        fill: false,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)'
                        ],
                        borderWidth: 1,
                    }
                ]
            };
            // End
            const config = {
                type: 'bar',
                data: data09,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: '09_매출분석'
                        }
                    }
                },
                scales: {
                    y: {
                        suggestedMin: 0,
                        suggestedMax: k0,
                    }
                }
            }

            const config2 = {
                type: 'line',
                data: data09,
                options: {
                    scales: {
                        x: {
                            grid: {
                                borderColor: 'red'
                            }
                        },
                        y: {
                            suggestedMin: 0,
                            suggestedMax: k0
                        }
                    }
                },
            };

            const chart09 = new Chart(
                document.getElementById('chart09'),
                config2
            );
            // $.ajax({
            //     url:"data09.php",
            //     method:"POST",
            //     data:{action:'fetch'},
            //     dataType:"JSON",
            //     success:function(data)
            //     {
            //         var find_biz1 = [];
            //         var find_biz2 = [];
            //         var find_biz3 = [];
            //         var find_month1 = [];
            //         var find_month1 = [];
            //         var total = [];
            //         var color = [];

            //         for(var count=0; count<data.length; count++)
            //         {
            //             find_biz1.push(data[count].biz1);
            //             find_biz2.push(data[count].biz2);
            //             find_biz3.push(data[count].biz3);

            //             total.push(data[count].total);
            //             color.push(data[count].color);
            //         }

            //         var chart_data = {
            //             label:sales,
            //             dataset:[
            //                 {
            //                     label:'chart09',
            //                     backgroundColor:color,
            //                     color: '#fff',
            //                     data: total
            //                 }
            //             ]
            //         };

            //         var options ={
            //             responsive:true,
            //             scales:{
            //                 yAxes:[{
            //                     ticks:{
            //                         min:0
            //                     }
            //                 }]
            //             }
            //         };

            //         var group_chart9 = $('#chart09');

            //         var graph9 = new Chart(group_chart9, {
            //             type:"line",
            //             data:chart_data
            //         });
            //     }
            // });
        }

        // makechart10
        function makechart10(res)
        {
            var n1 = '20대_매출건수'; // res[6].남성_매출건수;
            var n2 = '30대_매출건수'; // res[6].여성_매출건수;
            var n3 = '40대_매출금액'; // res[6].매출건수_업종3위명;
            var n4 = '50대_매출건수'; // res[6].매출건수_업종4위명;
            var n5 = '60대이상_매출건수' ; // res[6].매출건수_업종5위명;

            var k0 = res[9].연령통합_매출건수;
            var k1 = res[9].K20대_매출건수;
            var k2 = res[9].K30대_매출건수;
            var k3 = res[9].K40대_매출건수;
            var k4 = res[9].K50대_매출건수;
            var k5 = res[9].K60대이상_매출건수;

            if(k1 == "NULL")
            {
                k1 = 0;
            }

            if(k2 == "NULL")
            {
                k2 = 0;
            }

            if(k3 == "NULL")
            {
                k3 = 0;
            }

            if(k4 == "NULL")
            {
                k4 = 0;
            }

            if(k5 == "NULL")
            {
                k5 = 0;
            }

            console.log("makechart10 -> "+k0+","+k1+","+k2+","+k3+","+k4+","+k5);

            const data10 = {
                labels: [
                    n1,
                    n2,
                    n3,
                    n4,
                    n5
                ],
                datasets: [
                    {
                        label: '10_매출분석',
                        data: [k1,k2,k3,k4,k5],
                        fill: false,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgb(54, 162, 235)',                       
                        borderWidth: 1,
                    }
                ]
            };
            // End
            const config = {
                type: 'line',
                data: data10,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: '10_매출분석'
                        }
                    }
                },
            }

            const config2 = {
                type: 'line',
                data: data10,
                options: {
                    scales: {
                        x: {
                            grid: {
                                borderColor: 'red'
                            }
                        },
                        y: {
                            suggestedMin: 0,
                            suggestedMax: k0
                        }
                    }
                },
            };

            const chart10 = new Chart(
                document.getElementById('chart10'),
                config2
            );
            // $.ajax({
            //     url:"data10.php",
            //     method:"POST",
            //     data:{action:'fetch'},
            //     dataType:"JSON",
            //     success:function(data)
            //     {
            //         var find_biz1 = [];
            //         var find_biz2 = [];
            //         var find_biz3 = [];
            //         var find_month1 = [];
            //         var find_month1 = [];
            //         var total = [];
            //         var color = [];

            //         for(var count=0; count<data.length; count++)
            //         {
            //             find_biz1.push(data[count].biz1);
            //             find_biz2.push(data[count].biz2);
            //             find_biz3.push(data[count].biz3);

            //             total.push(data[count].total);
            //             color.push(data[count].color);
            //         }

            //         var chart_data = {
            //             label:sales,
            //             dataset:[
            //                 {
            //                     label:'chart10',
            //                     backgroundColor:color,
            //                     color: '#fff',
            //                     data: total
            //                 }
            //             ]
            //         };

            //         var options ={
            //             responsive:true,
            //             scales:{
            //                 yAxes:[{
            //                     ticks:{
            //                         min:0
            //                     }
            //                 }]
            //             }
            //         };

            //         var group_chart10 = $('#chart10');

            //         var graph10 = new Chart(group_chart10, {
            //             type:"line",
            //             data:chart_data
            //         });
            //     }
            // });
        }

        // makechart11
        function makechart11(res)
        {
            var n1 = '평일_매출금액'; // res[6].남성_매출건수;
            var n2 = '휴일_매출금액'; // res[6].여성_매출건수;
            //var n3 = '40대_매출금액'; // res[6].매출건수_업종3위명;
            //var n4 = '50대_매출건수'; // res[6].매출건수_업종4위명;
            //var n5 = '60대이상_매출건수' ; // res[6].매출건수_업종5위명;

            // var k1 = res[9].K20대_매출건수;
            // var k2 = res[9].K30대_매출건수;
            // var k3 = res[9].K40대_매출건수;
            // var k4 = res[9].K50대_매출건수;
            // var k5 = res[9].K60대이상_매출건수;

            console.log(n1);

            const data11 = {
                labels: [
                    n1,
                    n2
                ],
                datasets: [
                    {
                        label: '11_매출분석',
                        data: [res[10].평일_매출금액,res[10].휴일_매출금액],
                        fill: false,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgb(54, 162, 235)',                       
                        borderWidth: 1,
                    }
                ]
            };
            // End
            const config = {
                type: 'line',
                data: data11,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: '11_매출분석'
                        }
                    }
                },
            }

            const config2 = {
                type: 'line',
                data: data11,
                options: {
                    scales: {
                        x: {
                            grid: {
                                borderColor: 'red'
                            }
                        }
                    }
                },
            };

            const chart11 = new Chart(
                document.getElementById('chart11'),
                config2
            );
            // $.ajax({
            //     url:"data11.php",
            //     method:"POST",
            //     data:{action:'fetch'},
            //     dataType:"JSON",
            //     success:function(data)
            //     {
            //         var find_biz1 = [];
            //         var find_biz2 = [];
            //         var find_biz3 = [];
            //         var find_month1 = [];
            //         var find_month1 = [];
            //         var total = [];
            //         var color = [];

            //         for(var count=0; count<data.length; count++)
            //         {
            //             find_biz1.push(data[count].biz1);
            //             find_biz2.push(data[count].biz2);
            //             find_biz3.push(data[count].biz3);

            //             total.push(data[count].total);
            //             color.push(data[count].color);
            //         }

            //         var chart_data = {
            //             label:sales,
            //             dataset:[
            //                 {
            //                     label:'chart11',
            //                     backgroundColor:color,
            //                     color: '#fff',
            //                     data: total
            //                 }
            //             ]
            //         };

            //         var options ={
            //             responsive:true,
            //             scales:{
            //                 yAxes:[{
            //                     ticks:{
            //                         min:0
            //                     }
            //                 }]
            //             }
            //         };

            //         var group_chart11 = $('#chart11');

            //         var graph11 = new Chart(group_chart11, {
            //             type:"line",
            //             data:chart_data
            //         });
            //     }
            // });
        }
        
        // makechart12
        function makechart12(res)
        {
            var n1 = '평일_매출건수'; // res[6].남성_매출건수;
            var n2 = '휴일_매출건수'; // res[6].여성_매출건수;
            //var n3 = '40대_매출금액'; // res[6].매출건수_업종3위명;
            //var n4 = '50대_매출건수'; // res[6].매출건수_업종4위명;
            //var n5 = '60대이상_매출건수' ; // res[6].매출건수_업종5위명;

            // var k1 = res[9].K20대_매출건수;
            // var k2 = res[9].K30대_매출건수;
            // var k3 = res[9].K40대_매출건수;
            // var k4 = res[9].K50대_매출건수;
            // var k5 = res[9].K60대이상_매출건수;

            console.log(n1);

            const data12 = {
                labels: [
                    n1,
                    n2
                ],
                datasets: [
                    {
                        label: '12_매출분석',
                        data: [res[11].평일_매출건수,res[11].휴일_매출건수],
                        fill: false,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgb(54, 162, 235)',                       
                        borderWidth: 1,
                    }
                ]
            };
            // End
            const config = {
                type: 'line',
                data: data12,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: '12_매출분석'
                        }
                    }
                },
            }

            const config2 = {
                type: 'line',
                data: data12,
                options: {
                    scales: {
                        x: {
                            grid: {
                                borderColor: 'red'
                            }
                        }
                    }
                },
            };

            const chart12 = new Chart(
                document.getElementById('chart12'),
                config2
            );
            // $.ajax({
            //     url:"data12.php",
            //     method:"POST",
            //     data:{action:'fetch'},
            //     dataType:"JSON",
            //     success:function(data)
            //     {
            //         var find_biz1 = [];
            //         var find_biz2 = [];
            //         var find_biz3 = [];
            //         var find_month1 = [];
            //         var find_month1 = [];
            //         var total = [];
            //         var color = [];

            //         for(var count=0; count<data.length; count++)
            //         {
            //             find_biz1.push(data[count].biz1);
            //             find_biz2.push(data[count].biz2);
            //             find_biz3.push(data[count].biz3);

            //             total.push(data[count].total);
            //             color.push(data[count].color);
            //         }

            //         var chart_data = {
            //             label:sales,
            //             dataset:[
            //                 {
            //                     label:'chart12',
            //                     backgroundColor:color,
            //                     color: '#fff',
            //                     data: total
            //                 }
            //             ]
            //         };

            //         var options ={
            //             responsive:true,
            //             scales:{
            //                 yAxes:[{
            //                     ticks:{
            //                         min:0
            //                     }
            //                 }]
            //             }
            //         };

            //         var group_chart12 = $('#chart12');

            //         var graph12 = new Chart(group_chart12, {
            //             type:"line",
            //             data:chart_data
            //         });
            //     }
            // });
        }
         // setup 
        // const data = {
        //     labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        //     datasets: [{
        //         label: 'Weekly Sales',
        //         data: [18, 12, 6, 9, 12, 3, 9],
        //         backgroundColor: [
        //         'rgba(255, 26, 104, 0.2)',
        //         'rgba(54, 162, 235, 0.2)',
        //         'rgba(255, 206, 86, 0.2)',
        //         'rgba(75, 192, 192, 0.2)',
        //         'rgba(153, 102, 255, 0.2)',
        //         'rgba(255, 159, 64, 0.2)',
        //         'rgba(0, 0, 0, 0.2)'
        //         ],
        //         borderColor: [
        //         'rgba(255, 26, 104, 1)',
        //         'rgba(54, 162, 235, 1)',
        //         'rgba(255, 206, 86, 1)',
        //         'rgba(75, 192, 192, 1)',
        //         'rgba(153, 102, 255, 1)',
        //         'rgba(255, 159, 64, 1)',
        //         'rgba(0, 0, 0, 1)'
        //         ],
        //         borderWidth: 1
        //     }]
        // };

        // config 
        // const config = {
        //     type: 'bar',
        //     data,
        //     options: {
        //         scales: {
        //         y: {
        //             beginAtZero: true
        //         }
        //         }
        //     }
        // };
        // const config2 = {
        //     type: 'line',
        //     data,
        //     options: {
        //         scales: {
        //         y: {
        //             beginAtZero: true
        //         }
        //         }
        //     }
        // };
        // const config3 = {
        //     type: 'line',
        //     data,
        //     options: {}
        // };
        // const config4 = {
        //     type: 'line',
        //     data,
        //     options: {}
        // };
        // const config5 = {
        //     type: 'line',
        //     data,
        //     options: {}
        // };
        // const config6 = {
        //     type: 'line',
        //     data,
        //     options: {}
        // };
        // const config7 = {
        //     type: 'line',
        //     data,
        //     options: {}
        // };
        // const config8 = {
        //     type: 'line',
        //     data,
        //     options: {}
        // };
        // const config9 = {
        //     type: 'line',
        //     data,
        //     options: {}
        // };
        // const config10 = {
        //     type: 'line',
        //     data,
        //     options: {}
        // };

        // const config11 = {
        //     type: 'line',
        //     data,
        //     options: {}
        // };
        // const config12 = {
        //     type: 'line',
        //     data,
        //     options: {}
        // };
        // // render init block
        // const myChart = new Chart(
        // document.getElementById('chart01'),
        // config
        // );// render init block
        // myChart.destroy();

        // const myChart2 = new Chart(
        // document.getElementById('chart02'),
        // config2
        // );// render init block
        // myChart2.destroy();

        // const myChart3 = new Chart(
        // document.getElementById('chart03'),
        // config3
        // );// render init block
        // myChart3.destroy();

        // const myChart4 = new Chart(
        // document.getElementById('chart04'),
        // config4
        // );
        // myChart4.destroy();

        // const myChart5 = new Chart(
        // document.getElementById('chart05'),
        // config5
        // );
        // myChart5.destroy();

        // const myChart6 = new Chart(
        // document.getElementById('chart06'),
        // config6
        // );
        // myChart6.destroy();

        // const myChart7 = new Chart(
        // document.getElementById('chart07'),
        // config7
        // );
        // myChart7.destroy();

        // const myChart8 = new Chart(
        // document.getElementById('chart08'),
        // config8
        // );
        // myChart8.destroy();

        // const myChart9 = new Chart(
        // document.getElementById('chart09'),
        // config9
        // );
        // myChart9.destroy();

        // const myChart10 = new Chart(
        // document.getElementById('chart10'),
        // config10
        // );
        // myChart10.destroy();

        // const myChart11 = new Chart(
        // document.getElementById('chart11'),
        // config11
        // );
        // myChart11.destroy();

        // const myChart12 = new Chart(
        // document.getElementById('chart12'),
        // config12
        // );
        // myChart12.destroy();

    </script>    
    
</body>
</html>
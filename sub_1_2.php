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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="./css/main02.css" />
    <script src="./js/index.js"></script>
</head>
<body>
    <!-- sub_1.html -->
	<div id="wrap">
		<a href="#contens" class="skip">본문바로가기</a>
		<header>
			<div class="hd_wrapper">
                <h1>
                    <a href="./index.php">유성구데이타시각화</a>
                </h1>
                <!-- <a href="./main02.html"><img class="logo" src="yuseong_logo.png" alt="유성구데이타시각화로고"></a> -->
                <h2 class="hide">대메뉴</h2>
<style>
    /* .hd_wrapper .hd_menu nav > ul#main_menu > li:last-child{ position: relative; } */
    /* ul#sub_menu { border:1px solid #ccc;background: #fcfafc;position:absolute; text-align: center; margin:0; opacity:0;visibility:none; z-index:999; } */
    /* ul#sub_menu > li { border-bottom: 1px solid #ccc; line-height:30px; } */
    /* ul#sub_menu > li > a { display:block; text-decoration: none; } */
    /* #main_menu > li:hover #sub_menu { opacity:1;visibility:visible; } */
 
    ul#sub_menu { border:1px solid #ccc;background: #fcfafc;position:absolute; width:180px;height:auto;text-align: center; margin:0; opacity:0;visibility:none; z-index:999; }
    ul#sub_menu > li { display:inline-block;border-bottom: 1px solid #ccc; line-height:82px; }
    ul#main > ul#sub_menu > li > a { display:block; text-decoration: none;  }
    #main_menu li:hover #sub_menu { opacity:1;visibility:visible; }
</style>                  
                <div class="hd_menu">
                    <nav>
                        <ul id="main_menu">
                            <li>
                                <a href="./sub_1.php"><span>가게현황 분석</span></a>
                                <ul id="sub_menu">
                                    <li><a href="./sub_1_1.php"><span>법정동별</span></a></li>
                                    <li><a href="./sub_1_2.php"><span>상권별</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="./sub_2.php"><span>매출정보 분석</span></a>
                            </li>
                            <li>
                                <a href="./sub_3.php"><span>유동인구 분석</span></a>
                            </li>
                            <li>
                                <a href="./sub_4.php"><span>온통대전 소비분석</a>
                            </li>
                            <li>
                                <a href="./sub_5.php"><span>방문객 소비분석</span></a>
                            </li>
                            <li>
                                <a href="./sub_about.php"><span>도움말</span></a>
                                <ul id="sub_menu">
                                    <li><a href="./sub_about.php"><span>사이트소개</span></a></li>
                                    <li><a href="./sub_sitemap.php"><span>사이트맵</span></a></li>
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
                height:688px;
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
                <h1 class="hide">가게현황 분석</h1>
                <div class="sec01_img01">
                    <img src="./sub1/left_img.png" alt="가게분석현황 왼쪽이미지">
                    <p>
                        유성구<br>
                        동네상권<br>
                        알아보기
                    </p>
                </div>
                <div class="sec01_img02">
                    <img src="./sub1/right_img.png" alt="가게분석현황 오른쪽이미지">
                </div>
                <div class="sec01_title">
                    <h1>가게현황 분석(상권별)</h1>
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
            .sec02_right_part .util_wrap .location_wrap { float:left}
            .sec02_right_part .util_wrap .location_wrap li {display:inline;width:100%;height:50px;padding: 0 10px;}
            .sec02_right_part .util_wrap .location_wrap li a { display:inline-block;color:#404751;font-family:'Malgun Gothic';font-size:16px;line-height: 50px; }
            .sec02_right_part .util_wrap .location_wrap > li:nth-child(1) > a { position:relative; padding-left: 0; }
            .sec02_right_part .util_wrap .location_wrap > li:nth-child(1) > a:after {content:"";position:absolute;left:50%;top:50%;margin-left: 20px;width: 100%; height: 100%;background:url(arrow_1.png) no-repeat; }

            .sec02_right_part .util_wrap .location_wrap > li:nth-child(2) > a { position:relative; }
            .sec02_right_part .util_wrap .location_wrap > li:nth-child(2) > a:after {content:"";position:absolute;left:50%;top:50%; margin-left: 58px;width: 100%; height: 100%;background:url(arrow_1.png) no-repeat; }


            /*  지도 표시  부분  */

            .sec02_right_part .util_wrap .print_wrap {float:right}
            .sec02_right_part .util_wrap .print_wrap li {display:inline;width:100%;height:50px; padding: 0 10px; }
            .sec02_right_part .util_wrap .print_wrap li a { display:inline-block;color:#404751;font-size:16px;line-height: 50px; }
            .sec02_right_part .map_layout { position:absolute;left:60%; top:0px;z-index: 90;width:100%;height:100%;transform:translateX(-40%); text-align: center;}
            /* width:575px;height:669px; */
            /* 이미지 위치부분  margin-left로 수정 오른쪽 폭 1100 중에서 지도 위치 495px 나중에 스크립트 작업시 지도가 오른쪽으로 이동하는 동작을 표시*/
            /* .sec02_right_part .map_layout > img { display:inline-block;width:575px;height:700px;margin-left:90px; }  */
            .sec02_right_part .map_layout { animation-duration: 3s; animation-name: slidein; }
            @keyframes slidein{ from{margin-left:100%; width:300%;} to{margin-left:0; width:100%;} }

            /* select[name="catagory1"], select[name="catagory2"], select[name="catagory3"] {  margin: 10px 0; }  */
            .select_layout { width:272px; height: 112px; margin:28px auto; position:relative;}
            .select_layout h2 { position: absolute;left:0px;top:0px;width: 40px;font-family:'Malgun Gothic';font-size:15px; font-weight:bold; text-indent: 2%;}
            .select_layout .select_wrap { position:absolute;left:0px;top:0px;margin-left: 54px; width:218px;}
            .select_layout .select_wrap .n2 { margin: 8px 0; }
            select[name="catagory1"], select[name="catagory2"], select[name="catagory3"] {border: 1px solid #C2CDDE;border-radius:6px;width:218px;height:30px; font-size:13px;}
            .period_layout { width:272px;height: 100px;margin:28px auto; position:relative;}
            .period_layout h2 { position: absolute;left:0px;top:0px;width: 40px;font-family:'Malgun Gothic';font-size:15px; font-weight:bold; text-indent: 2%;}
            .period_layout .select_btn {  position:absolute;left:0px;top:0px;margin-left: 54px; width:218px;text-align: center;}
            .period_layout .select_btn button { border: 1px solid #C2CDDE;border-radius:6px;width:50px;height:30px;font-family:'Malgun Gothic';font-size:13px; background:#fff;}
            .period_layout .select_ymd {  position:absolute;left:0px;top:0px;margin-left: 54px; margin-top:40px;width:230px; background:#fff;box-sizing: border-box; }
            .period_layout .select_ymd > select { border:1px solid #C2CDDE;border-radius: 6px; font-family:'Malgun Gothic';font-size:13px; background:#fff;}
            .period_layout .select_ymd .select_year {width:72px;height:30px;}
            /* .period_layout .select_ymd span {font-size:14px;} */
            .period_layout .select_ymd .select_fmonth,
            .period_layout .select_ymd .select_tmonth {width:62px;height:30px; }

            .period_layout .select_ymd .select_fmonth { margin-left:26px; text-align: center;}

            .sec02_left_part .action_layer .action_wrap { position:relative; box-sizing: border-box;float:right;margin-right:20px;}
            .sec02_left_part .action_layer .action_wrap button { border: 1px solid #C2CDDE;border-radius:6px;width:106px;height:30px;font-family:'Malgun Gothic';font-size:15px; background:#fff;}
            .sec02_left_part .action_layer .action_wrap > button.n1 {background:#036EB8;color:#fff; }
            /* .period_layout .select_ymd .select_tmonth {width:62px;height:30px;} */
            .sec02_left_part .result_layout {border:1px solid #ccc;z-index:999;position:absolute;left:320px;top:50%;width:26px;height:48px; vertical-align:top;}
            /* .sec02_left_part .result_layout:hover { cursor: pointer; } */
            .sec02_left_part .result_layout > img#result_btn { display:inline-block;z-index:999;width:100%;height:100%; }
            .sec02_left_part .result_layout > img#result_btn:hover { cursor: pointer; }
            .sec02_left_part .result_layout > p { border:1px solid #ccc;position:absolute;left:0px; top:-310px; width:0px;height:651px;z-index:-1; background:#ddd; transition: all 0.5s ;-webkit-transition: all 0.5s; }
            .sec02_left_part .result_layout > p.on {width:320px;}

        </style>
		<div class="sec02">
            <div class="sec02_inner">
                <div class="sec02_left_part">
                    <h1 class="hide">가게현황 분석 왼쪽메뉴</h1>
                    <div class="sec02_location">
                        <div class="top_bar">
                            <h1 class="hide">가게현황 분석 분석메뉴</h1>
                            <div class="title">                                
                                <h2>가게현황 분석</h2>
                            </div>
                        </div>
                    </div>
                    <!-- 업종선택 -->
                    <div class="select_layout">
                        <h1 class="hide">업종 선택</h1>
                        <h2>업종 선택</h2>
                        <div class="select_wrap">                            
                            <!-- 대분류 -->
                            <div class="n1">                            
                                <h1 class="hide">전체업종 선택</h1>
                                <select name="catagory1" id="catagory1">
                                    <option value="">전체업종</option>
                                    <option value="">소매</option>
                                    <option value="">생활서비스</option>
                                    <option value="">부동산</option>
                                    <option value="">관광/여가/오락</option>
                                    <option value="">숙박</option>
                                    <option value="">스포츠</option>
                                    <option value="">음식</option>
                                    <option value="">학문/교육</option>
                                </select>
                            </div>
                            <!-- 중분류 -->
                            <div class="n2">
                                <h1 class="hide">중분류업종 선택</h1>
                                    <select name="catagory2" id="catagory2">
                                        <option value="">중분류</option>
                                        <option value="">소매</option>
                                        <option value="">생활서비스</option>
                                        <option value="">부동산</option>
                                        <option value="">관광/여가/오락</option>
                                        <option value="">숙박</option>
                                        <option value="">스포츠</option>
                                        <option value="">음식</option>
                                        <option value="">학문/교육</option>
                                    </select>
                            </div>
                            <!-- 소분류 -->
                            <div class="n3">
                                <h1 class="hide">소분류업종 선택</h1>
                                <select name="catagory3" id="catagory3">
                                    <option value="">소분류</option>
                                    <option value="">소매</option>
                                    <option value="">생활서비스</option>
                                    <option value="">부동산</option>
                                    <option value="">관광/여가/오락</option>
                                    <option value="">숙박</option>
                                    <option value="">스포츠</option>
                                    <option value="">음식</option>
                                    <option value="">학문/교육</option>
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
                                    <option value="">기준연도</option>
                                    <option value="2018">2018년도</option>
                                    <option value="2019">2019년도</option>
                                    <option value="2020">2020년도</option>
                                    <option value="2021">2021년도</option>
                                </select>
                                <select name="select_fmonth" id="select_fmonth" class="select_fmonth">
                                    <h1 class="hide">해당월 선택</h1>
                                    <option value="">기준월</option>
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
                    <div class="action_layer">
                        <h1 class="hide">조회버튼</h1>
                        <div class="action_wrap">
                            <h1 class="hide">조회버튼</h1>
                            <button type="button" class="n1"><img src="search.png" alt="검색버튼">검색</button>
                            <h1 class="hide">검색버툰</h1>
                            <button type="button" class="n2">초기화</button>
                        </div>
                    </div>
                    <!-- result button layout -->
                    <div class="result_layout">                        
                        <img src="result_btn.png"  alt="" id="result_btn">
                        <p id="demo" class=""></p>
                    </div>
                </div>
                <div class="sec02_right_part">
                    <div class="util_wrap">
                        <!-- 로케이션시작 -->
                        <ul class="location_wrap">
                            <li><a href="./"><img src="home_ic.png" alt="홈이미지"></a></li>                            
                            <li><a href="./sub_1.php">가게현황 분석</a></li>                            
                            <li><a href="./sub_1_2.php">상권별 보기</a></li>
                        </ul>
                        <!-- 프린트시작 -->
                        <ul class="print_wrap">
                            <li class="n1"><a ><span>sns</span></a></li>
                            <li class="n2"><a ><span>copy</span></a></li>
                            <li class="n3"><a ><span>print</span></a></li>
                        </ul>
                    </div>
                    <!-- 유성구법정동지도 -->
                    <div class="map_layout">
                        <h1 class="hide">법정동 지도</h1>
                        <img src="sub220127_map.png" alt="법정동 지도">
                    </div>
                </div>
            </div>
        </div>

        <!-- FOOTER PART -->
        <footer include-html="footer.html"></footer>
        <!-- FOOTER PART END-->
	</div>
    <script type="text/javascript">
        includeHTML();
        var result = document.querySelector(".result_layout");
        var demo = document.getElementById("demo");
        result.onclick = function(){
            // console.log("1");
            demo.classList.toggle("on");
        };  
        $(document).ready(function(){
            //.select_btn button #btn .btn.on
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
        });
    </script>    
    
</body>
</html>
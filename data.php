<?php
// data.php
$connect = mysqli_connect("192.168.0.201", "root", "1234", "yuseong_data");
// ....................................................................
$output = '';
$find_biz1 = "";
$find_biz2 = "";
$find_biz3 = "";

$find_year = "";
$find_month1 = "";

$find_area = "";

$find_ymd = "";

$data = array();

if(isset($_POST["action"]))
{
    if($_POST["action"] == 'fetch')
    {
        if(isset($_POST["select_biz1"]) && isset($_POST["select_biz2"]) && isset($_POST["select_biz3"]) && isset($_POST["select_year"]) && $_POST["select_month1"] && isset($_POST["select_area"]))
        {
            $find_biz1 = $_POST["select_biz1"];
            $find_biz2 = $_POST["select_biz2"];
            $find_biz3 = $_POST["select_biz3"];
            
            $find_year = $_POST["select_year"];
            $find_month1 = $_POST["select_month1"];
            
            $find_area = $_POST["select_area"];
            $find_ymd = $find_year . $find_month1;

            // 테스트용으로 임의값 적용.
            $find_ymd = '202003'; 
            $find_biz1='교육';
            $find_biz2='*';
            $find_biz3='*';
            $find_area='궁동';            

            //$query01 = " SELECT * FROM 01_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동='".$find_area."' AND 업종_대분류='".$find_biz1."' AND 업종_중분류='".$find_biz2."' AND 업종_소분류='".$find_biz3."' ";
            // SELECT * FROM 01_매출분석 WHERE 기준년월='202003' AND 법정동 LIKE '%궁동%' AND 업종_대분류 LIKE '%교육%' AND 업종_중분류 LIKE '%*%' AND 업종_소분류 LIKE '%*%'            
            $query01 = " SELECT * FROM 01_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동 LIKE '%".$find_area."%' AND 업종_대분류 LIKE '%".$find_biz1."%' AND 업종_중분류 LIKE '%".$find_biz2."%' AND 업종_소분류 LIKE '%".$find_biz3."%' ";

            $data01 = array();

            $result01 = mysqli_query($connect, $query01);
            while($row = mysqli_fetch_array($result01))
            {
                $data01["기준년월"] = $row["기준년월"];
                $data01["법정동"] = $row["법정동"];
                $data01["업종_대분류"] = $row["업종_대분류"];
                $data01["업종_중분류"] = $row["업종_중분류"];
                $data01["업종_소분류"] = $row["업종_소분류"];
                $data01["출력지역_매출금액"] = $row["출력지역_매출금액"];
                $data01["출력지역_매출금액_1개월전"] = $row["출력지역_매출금액_1개월전"];
                $data01["출력지역_매출금액_2개월전"] = $row["출력지역_매출금액_2개월전"];
                $data01["출력지역_매출금액_3개월전"] = $row["출력지역_매출금액_3개월전"];
                $data01["출력지역_매출금액_4개월전"] = $row["출력지역_매출금액_4개월전"];
                $data01["출력지역_매출금액_5개월전"] = $row["출력지역_매출금액_5개월전"];
                $data01["출력지역_매출건수"] = $row["출력지역_매출건수"];
                $data01["출력지역_매출건수_1개월전"] = $row["출력지역_매출건수_1개월전"];
                $data01["출력지역_매출건수_2개월전"] = $row["출력지역_매출건수_2개월전"];
                $data01["출력지역_매출건수_3개월전"] = $row["출력지역_매출건수_3개월전"];
                $data01["출력지역_매출건수_4개월전"] = $row["출력지역_매출건수_4개월전"];
                $data01["출력지역_매출건수_5개월전"] = $row["출력지역_매출건수_5개월전"];

                //$data[] = $data01;
                $data[] = $data01;
            }

            // echo json_encode($data);
           //  echo json_encode($data, JSON_UNESCAPED_UNICODE);
            // echo json_encode($data01, JSON_UNESCAPED_UNICODE);
            // $json_data=json_encode($data01, JSON_UNESCAPED_UNICODE);
            // $file_name = "data01_" . date("Y-m-d") . ".json";
            // if (file_put_contents($file_name, $json_data))
            // {
            //     echo $file_name . ' File created successfully';
            //     echo $query01;
            // }
            // else
            // {
            //     echo 'There is some error';
            // }            

            //$query02 = " SELECT * FROM 02_매출분석 WHERE 기준년월 = '".$find_ymd."' AND 법정동='".$find_area."' AND 업종_대분류='".$find_biz1."' AND 업종_중분류='".$find_biz2."' AND 업종_소분류='".$find_biz3."' ";
            $query02 = " SELECT * FROM 02_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동 LIKE '%".$find_area."%' AND 업종_대분류 LIKE '%".$find_biz1."%' AND 업종_중분류 LIKE '%".$find_biz2."%' AND 업종_소분류 LIKE '%".$find_biz3."%' ";            

            $data02 = array();

            $result02 = mysqli_query($connect, $query02);
            while($row = mysqli_fetch_array($result02))
            {
                $data02["기준년월"] = $row["기준년월"];
                $data02["법정동"] = $row["법정동"];
                $data02["업종_대분류"] = $row["업종_대분류"];
                $data02["업종_중분류"] = $row["업종_중분류"];
                $data02["업종_소분류"] = $row["업종_소분류"];
                $data02["출력지역_매출금액"] = $row["출력지역_매출금액"];
                $data02["출력지역_매출금액_1개월전"] = $row["출력지역_매출금액_1개월전"];
                $data02["출력지역_매출금액_2개월전"] = $row["출력지역_매출금액_2개월전"];
                $data02["출력지역_매출금액_3개월전"] = $row["출력지역_매출금액_3개월전"];
                $data02["출력지역_매출금액_4개월전"] = $row["출력지역_매출금액_4개월전"];
                $data02["출력지역_매출금액_5개월전"] = $row["출력지역_매출금액_5개월전"];

                //$data[] = $data02;
                $data[] = $data02;
            }

            // echo json_encode($data);
            // echo json_encode($data, JSON_UNESCAPED_UNICODE);
            // echo json_encode($data02, JSON_UNESCAPED_UNICODE);
            // $json_data=json_encode($data02, JSON_UNESCAPED_UNICODE);
            // $file_name = "data02_" . date("Y-m-d") . ".json";
            // if (file_put_contents($file_name, $json_data))
            // {
            //     echo $file_name . ' File created successfully';
            // }
            // else
            // {
            //     echo 'There is some error';
            // }

            //$query03 = " SELECT * FROM 03_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동='".$find_area."' AND 업종_대분류='".$find_biz1."' AND 업종_중분류='".$find_biz2."' AND 업종_소분류='".$find_biz3."' ";
            $query03 = " SELECT * FROM 03_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동 LIKE '%".$find_area."%' AND 업종_대분류 LIKE '%".$find_biz1."%' AND 업종_중분류 LIKE '%".$find_biz2."%' AND 업종_소분류 LIKE '%".$find_biz3."%' ";            

            $data03 = array();

            $result03 = mysqli_query($connect, $query03);
            while($row = mysqli_fetch_array($result03))
            {
                $data03["기준년월"] = $row["기준년월"];
                $data03["법정동"] = $row["법정동"];
                $data03["업종_대분류"] = $row["업종_대분류"];
                $data03["업종_중분류"] = $row["업종_중분류"];
                $data03["업종_소분류"] = $row["업종_소분류"];
                $data03["매출금액"] = $row["매출금액"];
                $data03["매출건수"] = $row["매출건수"];
                $data03["출력지역_매출금액랭킹"] = $row["출력지역_매출금액랭킹"];
                $data03["지역1위_매출금액"] = $row["지역1위_매출금액"];
                $data03["매출금액_지역1위명"] = $row["매출금액_지역1위명"];
                $data03["지역2위_매출금액"] = $row["지역2위_매출금액"];
                $data03["매출금액_지역2위명"] = $row["매출금액_지역2위명"];
                $data03["지역3위_매출금액"] = $row["지역3위_매출금액"];
                $data03["매출금액_지역3위명"] = $row["매출금액_지역3위명"];
                $data03["지역4위_매출금액"] = $row["지역4위_매출금액"];
                $data03["매출금액_지역4위명"] = $row["매출금액_지역4위명"];
                $data03["지역5위_매출금액"] = $row["지역5위_매출금액"];
                $data03["매출금액_지역5위명"] = $row["매출금액_지역5위명"];

                $data[] = $data03;
            }
            
            // echo json_encode($data);
            // echo json_encode($data, JSON_UNESCAPED_UNICODE);
            // echo json_encode($data03, JSON_UNESCAPED_UNICODE);
            // $json_data=json_encode($data03, JSON_UNESCAPED_UNICODE);
            // $file_name = "data03_" . date("Y-m-d") . ".json";
            // if (file_put_contents($file_name, $json_data))
            // {
            //     echo $file_name . ' File created successfully';
            // }
            // else
            // {
            //     echo 'There is some error';
            // }        

            //$query04 = " SELECT * FROM 04_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동='".$find_area."' AND 업종_대분류='".$find_biz1."' AND 업종_중분류='".$find_biz2."' AND 업종_소분류='".$find_biz3."' ";
            $query04 = " SELECT * FROM 04_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동 LIKE '%".$find_area."%' AND 업종_대분류 LIKE '%".$find_biz1."%' AND 업종_중분류 LIKE '%".$find_biz2."%' AND 업종_소분류 LIKE '%".$find_biz3."%' ";

            $data04 = array();

            $result04 = mysqli_query($connect, $query04);
            while($row = mysqli_fetch_array($result04))
            {
                $data04["기준년월"] = $row["기준년월"];
                $data04["법정동"] = $row["법정동"];
                $data04["업종_대분류"] = $row["업종_대분류"];
                $data04["업종_중분류"] = $row["업종_중분류"];
                $data04["업종_소분류"] = $row["업종_소분류"];
                $data04["매출금액"] = $row["매출금액"];
                $data04["매출건수"] = $row["매출건수"];
                $data04["출력지역_매출건수랭킹"] = $row["출력지역_매출건수랭킹"];
                $data04["지역1위_매출건수"] = $row["지역1위_매출건수"];
                $data04["매출건수_지역1위명"] = $row["매출건수_지역1위명"];
                $data04["지역2위_매출건수"] = $row["지역2위_매출건수"];
                $data04["매출건수_지역2위명"] = $row["매출건수_지역2위명"];
                $data04["지역3위_매출건수"] = $row["지역3위_매출건수"];
                $data04["매출건수_지역3위명"] = $row["매출건수_지역3위명"];
                $data04["지역4위_매출건수"] = $row["지역4위_매출건수"];
                $data04["매출건수_지역4위명"] = $row["매출건수_지역4위명"];
                $data04["지역5위_매출건수"] = $row["지역5위_매출건수"];
                $data04["매출건수_지역5위명"] = $row["매출건수_지역5위명"];

                $data[] = $data04;
            }
            
            // echo json_encode($data);
            // echo json_encode($data, JSON_UNESCAPED_UNICODE);
            // echo json_encode($data04, JSON_UNESCAPED_UNICODE);
            // $json_data=json_encode($data04, JSON_UNESCAPED_UNICODE);
            // $file_name = "data04_" . date("Y-m-d") . ".json";
            // if (file_put_contents($file_name, $json_data))
            // {
            //     echo $file_name . ' File created successfully';
            // }
            // else
            // {
            //     echo 'There is some error';
            // }        



           // $query05 = " SELECT * FROM 05_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동='".$find_area."' AND 업종_대분류='".$find_biz1."' AND 업종_중분류='".$find_biz2."' AND 업종_소분류='".$find_biz3."' ";
            $query05 = " SELECT * FROM 05_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동 LIKE '%".$find_area."%' AND 업종_대분류 LIKE '%".$find_biz1."%' AND 업종_중분류 LIKE '%".$find_biz2."%' AND 업종_소분류 LIKE '%".$find_biz3."%' ";

            $data05 = array();

            $result05 = mysqli_query($connect, $query05);
            while($row = mysqli_fetch_array($result05))
            {
                $data05["기준년월"] = $row["기준년월"];
                $data05["법정동"] = $row["법정동"];
                $data05["업종_대분류"] = $row["업종_대분류"];
                $data05["업종_중분류"] = $row["업종_중분류"];
                $data05["업종_소분류"] = $row["업종_소분류"];
                $data05["매출금액"] = $row["매출금액"];
                $data05["매출건수"] = $row["매출건수"];
                $data05["출력업종_매출금액랭킹"] = $row["출력업종_매출금액랭킹"];
                $data05["업종1위_매출금액"] = $row["업종1위_매출금액"];
                $data05["매출금액_업종1위명"] = $row["매출금액_업종1위명"];
                $data05["업종2위_매출금액"] = $row["업종2위_매출금액"];
                $data05["매출금액_업종2위명"] = $row["매출금액_업종2위명"];
                $data05["업종3위_매출금액"] = $row["업종3위_매출금액"];
                $data05["매출금액_업종3위명"] = $row["매출금액_업종3위명"];
                $data05["업종4위_매출금액"] = $row["업종4위_매출금액"];
                $data05["매출금액_업종4위명"] = $row["매출금액_업종4위명"];
                $data05["업종5위_매출금액"] = $row["업종5위_매출금액"];
                $data05["매출금액_업종5위명"] = $row["매출금액_업종5위명"];

                $data[] = $data05;
            }
            
            // echo json_encode($data);
            // echo json_encode($data, JSON_UNESCAPED_UNICODE);
            // echo json_encode($data05, JSON_UNESCAPED_UNICODE);
            // $json_data=json_encode($data05, JSON_UNESCAPED_UNICODE);
            // $file_name = "data05_" . date("Y-m-d") . ".json";
            // if (file_put_contents($file_name, $json_data))
            // {
            //     echo $file_name . ' File created successfully';
            // }
            // else
            // {
            //     echo 'There is some error';
            // }        



            //$query06 = " SELECT * FROM 06_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동='".$find_area."' AND 업종_대분류='".$find_biz1."' AND 업종_중분류='".$find_biz2."' AND 업종_소분류='".$find_biz3."' ";
            $query06 = " SELECT * FROM 06_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동 LIKE '%".$find_area."%' AND 업종_대분류 LIKE '%".$find_biz1."%' AND 업종_중분류 LIKE '%".$find_biz2."%' AND 업종_소분류 LIKE '%".$find_biz3."%' ";

            $data06 = array();

            $result06 = mysqli_query($connect, $query06);
            while($row = mysqli_fetch_array($result06))
            {
                $data06["기준년월"] = $row["기준년월"];
                $data06["법정동"] = $row["법정동"];
                $data06["업종_대분류"] = $row["업종_대분류"];
                $data06["업종_중분류"] = $row["업종_중분류"];
                $data06["업종_소분류"] = $row["업종_소분류"];
                $data06["매출금액"] = $row["매출금액"];
                $data06["매출건수"] = $row["매출건수"];
                $data06["출력업종_매출건수랭킹"] = $row["출력업종_매출건수랭킹"];
                $data06["업종1위_매출건수"] = $row["업종1위_매출건수"];
                $data06["매출건수_업종1위명"] = $row["매출건수_업종1위명"];
                $data06["업종2위_매출건수"] = $row["업종2위_매출건수"];
                $data06["매출건수_업종2위명"] = $row["매출건수_업종2위명"];
                $data06["업종3위_매출건수"] = $row["업종3위_매출건수"];
                $data06["매출건수_업종3위명"] = $row["매출건수_업종3위명"];
                $data06["업종4위_매출건수"] = $row["업종4위_매출건수"];
                $data06["매출건수_업종4위명"] = $row["매출건수_업종4위명"];
                $data06["업종5위_매출건수"] = $row["업종5위_매출건수"];
                $data06["매출건수_업종5위명"] = $row["매출건수_업종5위명"];

                $data[] = $data06;
            }
            
            // echo json_encode($data);
            // echo json_encode($data, JSON_UNESCAPED_UNICODE);
            // echo json_encode($data06, JSON_UNESCAPED_UNICODE);
            // $json_data=json_encode($data06, JSON_UNESCAPED_UNICODE);
            // $file_name = "data06_" . date("Y-m-d") . ".json";
            // if (file_put_contents($file_name, $json_data))
            // {
            //     echo $file_name . ' File created successfully';
            // }
            // else
            // {
            //     echo 'There is some error';
            // }



            //$query07 = " SELECT * FROM 07_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동='".$find_area."' AND 업종_대분류='".$find_biz1."' AND 업종_중분류='".$find_biz2."' AND 업종_소분류='".$find_biz3."' ";
            $query07 = " SELECT * FROM 07_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동 LIKE '%".$find_area."%' AND 업종_대분류 LIKE '%".$find_biz1."%' AND 업종_중분류 LIKE '%".$find_biz2."%' AND 업종_소분류 LIKE '%".$find_biz3."%' ";

            $data07 = array();

            $result07 = mysqli_query($connect, $query07);
            while($row = mysqli_fetch_array($result07))
            {
                $data07["기준년월"] = $row["기준년월"];
                $data07["법정동"] = $row["법정동"];
                $data07["업종_대분류"] = $row["업종_대분류"];
                $data07["업종_중분류"] = $row["업종_중분류"];
                $data07["업종_소분류"] = $row["업종_소분류"];
                $data07["성별통합_매출금액"] = $row["성별통합_매출금액"];
                $data07["남성_매출금액"] = $row["남성_매출금액"];
                $data07["여성_매출금액"] = $row["여성_매출금액"];

                $data[] = $data07;
            }
            
            // echo json_encode($data);
            // echo json_encode($data, JSON_UNESCAPED_UNICODE);
            // echo json_encode($data07, JSON_UNESCAPED_UNICODE);
            // $json_data=json_encode($data07, JSON_UNESCAPED_UNICODE);
            // $file_name = "data07_" . date("Y-m-d") . ".json";
            // if (file_put_contents($file_name, $json_data))
            // {
            //     echo $file_name . ' File created successfully';
            // }
            // else
            // {
            //     echo 'There is some error';
            // }        



            //$query08 = " SELECT * FROM 08_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동='".$find_area."' AND 업종_대분류='".$find_biz1."' AND 업종_중분류='".$find_biz2."' AND 업종_소분류='".$find_biz3."' ";
            $query08 = " SELECT * FROM 08_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동 LIKE '%".$find_area."%' AND 업종_대분류 LIKE '%".$find_biz1."%' AND 업종_중분류 LIKE '%".$find_biz2."%' AND 업종_소분류 LIKE '%".$find_biz3."%' ";

            $data08 = array();

            $result08 = mysqli_query($connect, $query08);
            while($row = mysqli_fetch_array($result08))
            {
                $data08["기준년월"] = $row["기준년월"];
                $data08["법정동"] = $row["법정동"];
                $data08["업종_대분류"] = $row["업종_대분류"];
                $data08["업종_중분류"] = $row["업종_중분류"];
                $data08["업종_소분류"] = $row["업종_소분류"];
                $data08["성별통합_매출건수"] = $row["성별통합_매출건수"];
                $data08["남성_매출건수"] = $row["남성_매출건수"];
                $data08["여성_매출건수"] = $row["여성_매출건수"];

                $data[] = $data08;
            }
            
            // echo json_encode($data);
            // echo json_encode($data, JSON_UNESCAPED_UNICODE);
            // echo json_encode($data08, JSON_UNESCAPED_UNICODE);
            // $json_data=json_encode($data08, JSON_UNESCAPED_UNICODE);
            // $file_name = "data08_" . date("Y-m-d") . ".json";
            // if (file_put_contents($file_name, $json_data))
            // {
            //     echo $file_name . ' File created successfully';
            // }
            // else
            // {
            //     echo 'There is some error';
            // }


            //$query09 = " SELECT * FROM 09_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동='".$find_area."' AND 업종_대분류='".$find_biz1."' AND 업종_중분류='".$find_biz2."' AND 업종_소분류='".$find_biz3."' ";
            $query09 = " SELECT * FROM 09_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동 LIKE '%".$find_area."%' AND 업종_대분류 LIKE '%".$find_biz1."%' AND 업종_중분류 LIKE '%".$find_biz2."%' AND 업종_소분류 LIKE '%".$find_biz3."%' ";

            $data09 = array();

            $result09 = mysqli_query($connect, $query09);
            while($row = mysqli_fetch_array($result09))
            {
                $data09["기준년월"] = $row["기준년월"];
                $data09["법정동"] = $row["법정동"];
                $data09["업종_대분류"] = $row["업종_대분류"];
                $data09["업종_중분류"] = $row["업종_중분류"];
                $data09["업종_소분류"] = $row["업종_소분류"];
                $data09["연령통합_매출금액"] = $row["연령통합_매출금액"];
                $data09["K20대_매출금액"] = $row["20대_매출금액"];
                $data09["K30대_매출금액"] = $row["30대_매출금액"];
                $data09["K40대_매출금액"] = $row["40대_매출금액"];
                $data09["K50대_매출금액"] = $row["50대_매출금액"];
                $data09["K60대이상_매출금액"] = $row["60대이상_매출금액"];

                $data[] = $data09;
            }
            
            // echo json_encode($data);
            // echo json_encode($data, JSON_UNESCAPED_UNICODE);
            // echo json_encode($data09, JSON_UNESCAPED_UNICODE);
            // $json_data=json_encode($data09, JSON_UNESCAPED_UNICODE);
            // $file_name = "data09_" . date("Y-m-d") . ".json";
            // if (file_put_contents($file_name, $json_data))
            // {
            //     echo $file_name . ' File created successfully';
            // }
            // else
            // {
            //     echo 'There is some error';
            // }        



           // $query10 = " SELECT * FROM 10_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동='".$find_area."' AND 업종_대분류='".$find_biz1."' AND 업종_중분류='".$find_biz2."' AND 업종_소분류='".$find_biz3."' ";
            $query10 = " SELECT * FROM 10_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동 LIKE '%".$find_area."%' AND 업종_대분류 LIKE '%".$find_biz1."%' AND 업종_중분류 LIKE '%".$find_biz2."%' AND 업종_소분류 LIKE '%".$find_biz3."%' ";

            $data10 = array();

            $result10 = mysqli_query($connect, $query10);
            while($row = mysqli_fetch_array($result10))
            {
                $data10["기준년월"] = $row["기준년월"];
                $data10["법정동"] = $row["법정동"];
                $data10["업종_대분류"] = $row["업종_대분류"];
                $data10["업종_중분류"] = $row["업종_중분류"];
                $data10["업종_소분류"] = $row["업종_소분류"];
                $data10["연령통합_매출건수"] = $row["연령통합_매출건수"];
                $data10["K20대_매출건수"] = $row["20대_매출건수"];
                $data10["K30대_매출건수"] = $row["30대_매출건수"];
                $data10["K40대_매출건수"] = $row["40대_매출건수"];
                $data10["K50대_매출건수"] = $row["50대_매출건수"];
                $data10["K60대이상_매출건수"] = $row["60대이상_매출건수"];

                $data[] = $data10;
            }
            
            // echo json_encode($data);
            // echo json_encode($data, JSON_UNESCAPED_UNICODE);
            // echo json_encode($data10, JSON_UNESCAPED_UNICODE);
            // $json_data=json_encode($data10, JSON_UNESCAPED_UNICODE);
            // $file_name = "data10_" . date("Y-m-d") . ".json";
            // if (file_put_contents($file_name, $json_data))
            // {
            //     echo $file_name . ' File created successfully';
            // }
            // else
            // {
            //     echo 'There is some error';
            // }        

            

            //$query11 = " SELECT * FROM 11_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동='".$find_area."' AND 업종_대분류='".$find_biz1."' AND 업종_중분류='".$find_biz2."' AND 업종_소분류='".$find_biz3."' ";
            $query11 = " SELECT * FROM 11_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동 LIKE '%".$find_area."%' AND 업종_대분류 LIKE '%".$find_biz1."%' AND 업종_중분류 LIKE '%".$find_biz2."%' AND 업종_소분류 LIKE '%".$find_biz3."%' ";

            $data11 = array();

            $result11 = mysqli_query($connect, $query11);
            while($row = mysqli_fetch_array($result11))
            {
                $data11["기준년월"] = $row["기준년월"];
                $data11["법정동"] = $row["법정동"];
                $data11["업종_대분류"] = $row["업종_대분류"];
                $data11["업종_중분류"] = $row["업종_중분류"];
                $data11["업종_소분류"] = $row["업종_소분류"];
                $data11["휴평일통합_매출금액"] = $row["휴평일통합_매출금액"];
                $data11["평일_매출금액"] = $row["평일_매출금액"];
                $data11["휴일_매출금액"] = $row["휴일_매출금액"];

                $data[] = $data11;
            }
            
            // echo json_encode($data);
            // echo json_encode($data, JSON_UNESCAPED_UNICODE);
            // echo json_encode($data11, JSON_UNESCAPED_UNICODE);
            // $json_data=json_encode($data11, JSON_UNESCAPED_UNICODE);
            // $file_name = "data11_" . date("Y-m-d") . ".json";
            // if (file_put_contents($file_name, $json_data))
            // {
            //     echo $file_name . ' File created successfully';
            // }
            // else
            // {
            //     echo 'There is some error';
            // }        

            

            //$query12 = " SELECT * FROM 12_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동='".$find_area."' AND 업종_대분류='".$find_biz1."' AND 업종_중분류='".$find_biz2."' AND 업종_소분류='".$find_biz3."' ";
            $query12 = " SELECT * FROM 12_매출분석 WHERE 기준년월='".$find_ymd."' AND 법정동 LIKE '%".$find_area."%' AND 업종_대분류 LIKE '%".$find_biz1."%' AND 업종_중분류 LIKE '%".$find_biz2."%' AND 업종_소분류 LIKE '%".$find_biz3."%' ";

            $data12 = array();

            $result12 = mysqli_query($connect, $query12);
            while($row = mysqli_fetch_array($result12))
            {
                $data12["기준년월"] = $row["기준년월"];
                $data12["법정동"] = $row["법정동"];
                $data12["업종_대분류"] = $row["업종_대분류"];
                $data12["업종_중분류"] = $row["업종_중분류"];
                $data12["업종_소분류"] = $row["업종_소분류"];
                $data12["휴평일통합_매출건수"] = $row["휴평일통합_매출건수"];
                $data12["평일_매출건수"] = $row["평일_매출건수"];
                $data12["휴일_매출건수"] = $row["휴일_매출건수"];

                $data[] = $data12;
            }
            
            // echo json_encode($data);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            // echo json_encode($data12, JSON_UNESCAPED_UNICODE);
            // $json_data=json_encode($data12, JSON_UNESCAPED_UNICODE);
            // $file_name = "data12_" . date("Y-m-d") . ".json";
            // if (file_put_contents($file_name, $json_data))
            // {
            //     echo $file_name . ' File created successfully';
            // }
            // else
            // {
            //     echo 'There is some error';
            // }        
         

        }
        // if(isset($_POST["select_biz1"]) && isset($_POST["select_biz2"]) && isset($_POST["select_biz3"]))
        // {
        //     $find_biz1 = $_POST["select_biz1"];
        //     $find_biz2 = $_POST["select_biz2"];
        //     $find_biz3 = $_POST["select_biz3"];
        // }
        // if(isset($_POST["select_year"]) && $_POST["select_month1"] && isset($_POST["select_area"]))
        // {
        //     $find_year = $_POST["select_year"];
        //     $find_month1 = $_POST["select_month1"];
        //     $find_area = $_POST["select_area"];
        //     $find_ymd = $find_year . $find_month1;
        // }
        // $query01 = " SELECT * FROM 01_매출분석 WHERE 기준년월 = '".$_POS["select_year"]."' ";
    }
}
?>
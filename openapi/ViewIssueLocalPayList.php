<?php
header("Content-Type:application/json");
// 유성구 지역화폐발급 현황 조회 API
if (isset($_GET['pageno']))
{
	$pageno = $_GET['pageno'];
}
else
{
	$pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno -1) * $no_of_records_per_page;
/*
ISSU_YEAR			발급년	4	1	2021	발급년
ISSU_MONTH			발급월	2	1	01	발급월
SIDO_CODE			광역시도코드	5	0	30	광역시도코드
SIDO_NAME			광역시도명	50	0	대전광역시	광역시도명
SIGUNGU_CODE		시군구코드	5	0	30200	시군구코드
SIGUNGU_NAME		시군구명	50	0	유성구	시군구명
DONG_CODE			법정동코드	20	0	3020011200	법정동코드
DONG_NAME			법정동명	120	0	구암동	법정동명
AGE_GROUP			연령대	200	0	20대	연령대
SEX					성별	12	0	남성	성별
USED_NUMBER_INDEX	지수이용금액	200	0	106.63	지수이용금액
USED_AMT_INDEX		지수이용건수	200	0	57.68	지수이용건수

*/

if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_city']) && $_GET['find_city'] != "") && (isset($_GET['find_sigu']) && $_GET['find_sigu'] != "") && (isset($_GET['find_sex']) && $_GET['find_sex'] != "") && (isset($_GET['find_age']) && $_GET['find_age'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_city = $_GET['find_city'];
	$find_sigu = $_GET['find_sigu'];
	$find_area = $_GET['find_area'];
	$find_sex = $_GET['find_sex'];
	$find_age = $_GET['find_age'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `연령대` LIKE '%{$find_age}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `연령대` LIKE '%{$find_age}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
				"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `연령대` LIKE '%{$find_age}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `연령대` LIKE '%{$find_age}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `연령대` LIKE '%{$find_age}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `연령대` LIKE '%{$find_age}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `연령대` LIKE '%{$find_age}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));
		
		$row3 = mysqli_num_rows($result2);

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `연령대` LIKE '%{$find_age}%' AND `성별` LIKE '%{$find_sex}%'  ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}	
} else if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_age']) && $_GET['find_age'] != "") && (isset($_GET['find_city']) && $_GET['find_city'] != "") && (isset($_GET['find_sigu']) && $_GET['find_sigu'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_city = $_GET['find_city'];
	$find_sigu = $_GET['find_sigu'];
	$find_age= $_GET['find_age'];
	$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `연령대` LIKE '%{$find_age}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);

		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `연령대` LIKE '%{$find_age}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `연령대` LIKE '%{$find_age}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `연령대` LIKE '%{$find_age}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;

				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `연령대` LIKE '%{$find_age}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `연령대` LIKE '%{$find_age}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `연령대` LIKE '%{$find_age}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `연령대` LIKE '%{$find_age}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}
} else if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_sex']) && $_GET['find_sex'] != "") && (isset($_GET['find_city']) && $_GET['find_city'] != "") && (isset($_GET['find_sigu']) && $_GET['find_sigu'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_city = $_GET['find_city'];
	$find_sigu = $_GET['find_sigu'];
	//$find_age= $_GET['find_age'];
	$find_area = $_GET['find_area'];
	$find_sex = $_GET['find_sex'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);

		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = " SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");


		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `법정동명` LIKE '%{$find_area}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}
} else if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_sex']) && $_GET['find_sex'] != "") && (isset($_GET['find_sigu']) && $_GET['find_sigu'] != "") && (isset($_GET['serviceKey']))) {

	include('db.php');
	//$find_city = $_GET['find_city'];
	$find_sigu = $_GET['find_sigu'];
	//$find_age= $_GET['find_age'];
	$find_area = $_GET['find_area'];
	$find_sex = $_GET['find_sex'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);

		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = " SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");


		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `시군구명` LIKE '%{$find_sigu}%' AND `법정동명` LIKE '%{$find_area}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}
} else if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_sex']) && $_GET['find_sex'] != "") && (isset($_GET['serviceKey']))) {

	include('db.php');
	//$find_city = $_GET['find_city'];
	//$find_sigu = $_GET['find_sigu'];
	//$find_age= $_GET['find_age'];
	$find_area = $_GET['find_area'];
	$find_sex = $_GET['find_sex'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);

		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = " SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `성별` LIKE '%{$find_sex}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");


		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}		
} else if ((isset($_GET['find_sex']) && $_GET['find_sex'] != "") && (isset($_GET['find_city']) && $_GET['find_city'] != "") && (isset($_GET['find_sigu']) && $_GET['find_sigu'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_city = $_GET['find_city'];
	$find_sigu = $_GET['find_sigu'];
	//$find_age= $_GET['find_age'];
	//$find_area = $_GET['find_area'];
	$find_sex = $_GET['find_sex'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);

		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}'AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = " SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%'  ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");


		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}
} else if ((isset($_GET['find_sex']) && $_GET['find_sex'] != "") && (isset($_GET['find_city']) && $_GET['find_city'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_city = $_GET['find_city'];
	//$find_sigu = $_GET['find_sigu'];
	//$find_age= $_GET['find_age'];
	//$find_area = $_GET['find_area'];
	$find_sex = $_GET['find_sex'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);

		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}'AND `광역시도명` LIKE '%{$find_city}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `광역시도명` LIKE '%{$find_city}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = " SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `광역시도명` LIKE '%{$find_city}%' AND `성별` LIKE '%{$find_sex}%'  ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");


		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `광역시도명` LIKE '%{$find_city}%' AND `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}		
} else if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_city']) && $_GET['find_city'] != "") && (isset($_GET['find_sigu']) && $_GET['find_sigu'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_city = $_GET['find_city'];
	$find_sigu = $_GET['find_sigu'];
	$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);

		$row3 =  mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;

				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}
} else if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_city']) && $_GET['find_city'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_city = $_GET['find_city'];
	//$find_biz = $_GET['find_biz'];
	$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%'  ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");	
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}
} else if ((isset($_GET['find_sex']) && $_GET['find_sex'] != "") && (isset($_GET['find_age']) && $_GET['find_age'] != "") && (isset($_GET['find_city']) && $_GET['find_city'] != "") && (isset($_GET['serviceKey']))) {

	include('db.php');

	$find_city = $_GET['find_city'];
	$find_age = $_GET['find_age'];
	$find_sex = $_GET['find_sex'];
	//$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `성별` like '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%'  ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `성별` like '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `광역시도명` LIKE '%{$find_city}%' AND `성별` LIKE '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
		$query='';	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `광역시도명` LIKE '%{$find_city}%' AND `성별` LIKE '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `성별` like '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
		$query='';	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `성별` like '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `광역시도명` LIKE '%{$find_city}%' AND `성별` LIKE '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `광역시도명` LIKE '%{$find_city}%' AND `성별` LIKE '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}
} else if ((isset($_GET['find_sex']) && $_GET['find_sex'] != "") && (isset($_GET['find_age']) && $_GET['find_age'] != "") && (isset($_GET['find_sigu']) && $_GET['find_sigu'] != "") && (isset($_GET['serviceKey']))) {

	include('db.php');
	$find_sigu = $_GET['find_sigu'];
	$find_age = $_GET['find_age'];
	$find_sex = $_GET['find_sex'];
	//$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` like '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%'  ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` like '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` like '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` like '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` like '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' AND `성별` like '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `시군구명` LIKE '%{$find_sigu}%' AND `성별` LIKE '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}
} else if ((isset($_GET['find_sex']) && $_GET['find_sex'] != "") && (isset($_GET['find_age']) && $_GET['find_age'] != "") && (isset($_GET['serviceKey']))) {

	include('db.php');
	//$find_sigu = $_GET['find_sigu'];
	$find_age = $_GET['find_age'];
	$find_sex = $_GET['find_sex'];
	//$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `성별` LIKE '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%'  ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `성별` LIKE '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `성별` like '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `성별` like '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `성별` like '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `성별` like '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `성별` like '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `성별` like '%{$find_sex}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}			
} else if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_sigu']) && $_GET['find_sigu'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_sigu = $_GET['find_sigu'];
	//$find_biz = $_GET['find_biz'];
	$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명`LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명`LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명`LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명`LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명`LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명`LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `법정동명`LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `법정동명`LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}
} else if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_age']) && $_GET['find_age'] != "") && (isset($_GET['find_sigu']) && $_GET['find_sigu'] != "") && (isset($_GET['serviceKey']))) {

	include('db.php');
	
	$find_age = $_GET['find_age'];
	//$find_biz = $_GET['find_biz'];
	$find_area = $_GET['find_area'];
	$find_sigu = $_GET['find_sigu'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		// "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `시군구명` LIKE '%유성%' AND `법정동명` LIKE '%구암%' AND `연령대` LIKE '%20%' "
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터`WHERE `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		//$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `시군구명` LIKE '%유성%' AND `법정동명` LIKE '%구암%' AND `연령대` LIKE '%20%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		//$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `시군구명` LIKE '%'$find_sigu'%' AND `법정동명` LIKE '%'$find_area'%' AND `연령대` LIKE '%'$find_age'%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}	
} else if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_age']) && $_GET['find_age'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_age = $_GET['find_age'];
	//$find_biz = $_GET['find_biz'];
	$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}				
} else if ((isset($_GET['find_city']) && $_GET['find_city'] !="") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_city = $_GET['find_city'];
	$find_biz = $_GET['find_biz'];
	//$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE WHERE `발급년`='{$find_year}' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `광역시도명` LIKE '%{$find_city}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}	
} else if ((isset($_GET['find_sigu']) && $_GET['find_sigu'] !="") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_sigu = $_GET['find_sigu'];
	//$find_biz = $_GET['find_biz'];
	//$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);		
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}	
} else if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	//$find_sigu = $_GET['find_sigu'];
	//$find_biz = $_GET['find_biz'];
	$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));


		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;

			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}
} else if ((isset($_GET['find_sex']) && $_GET['find_sex'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	//$find_sigu = $_GET['find_sigu'];
	$find_sex = $_GET['find_sex'];
	//$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `성별` LIKE '%{$find_sex}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `성별` LIKE '%{$find_sex}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `성별` LIKE '%{$find_sex}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `성별` LIKE '%{$find_sex}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `성별` LIKE '%{$find_sex}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}
} else if ((isset($_GET['find_age']) && $_GET['find_age'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	//$find_sigu = $_GET['find_sigu'];
	$find_age = $_GET['find_age'];
	//$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터`  WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터`  WHERE `발급월`='{$find_month}' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터`  WHERE `발급월`='{$find_month}' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터`  WHERE `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		$query = "SELECT * FROM `유성구_지역화폐발급데이터`  WHERE `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}	
			
} else if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_city']) && $_GET['find_city'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_area = $_GET['find_area'];
	$find_city = $_GET['find_city'];
	//$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%'  ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;

			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}	
} else if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_sigu']) && $_GET['find_sigu'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_area = $_GET['find_area'];
	$find_sigu = $_GET['find_sigu'];
	//$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}

} else if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_age']) && $_GET['find_age'] !="") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_area = $_GET['find_area'];
	$find_age = $_GET['find_age'];
	//$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `연령대` LIKE '%{$find_age}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}

} else if ((isset($_GET['find_city']) && $_GET['find_city'] != "") && (isset($_GET['find_sigu']) && $_GET['find_sigu'] !="") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_city = $_GET['find_city'];
	$find_sigu = $_GET['find_sigu'];
	//$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시구군명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시구군명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `광역시도명` LIKE '%{$find_city}%' AND `시구군명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `광역시도명` LIKE '%{$find_city}%' AND `시구군명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시구군명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시구군명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `광역시도명` LIKE '%{$find_city}%' AND `시구군명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `광역시도명` LIKE '%{$find_city}%' AND `시구군명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}

} else if ((isset($_GET['find_city']) && $_GET['find_city'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_city = $_GET['find_city'];
	//$find_sigu = $_GET['find_sigu'];
	//$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%'  ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["resultdata"][] = $pageNo;
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `광역시도명` LIKE '%{$find_city}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}	
} else if ((isset($_GET['find_sigu']) && $_GET['find_sigu'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	//$find_city = $_GET['find_city'];
	$find_sigu = $_GET['find_sigu'];
	//$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%'  ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `시군구명` LIKE '%{$find_sigu}%' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}			
} else {
	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "") && (isset($_GET['serviceKey']))) {

		include('db.php');
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];
		$serviceKey = $_GET['serviceKey'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' AND `발급월`='{$find_month}' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}						
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['serviceKey']))) {

		include('db.php');
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];
		$serviceKey = $_GET['serviceKey'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급년`='{$find_year}' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "") && (isset($_GET['serviceKey']))) {

		include('db.php');
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];
		$serviceKey = $_GET['serviceKey'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' ";
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		mysqli_free_result($result2);
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
	
		$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급월`='{$find_month}' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}				
	} else {	
		include('db.php');
		//$find_city = $_GET['find_city'];
		//$find_sigu = $_GET['find_sigu'];
		//$find_area = $_GET['find_area'];
		//$find_biz = $_GET['find_biz'];
		//$query = '';
		//$query = "SELECT COUNT(*) FROM `유성구_유성구_지역화폐발급데이터` LIMIT 10 ";
		//$result2 = mysqli_query($con, $query);
		//$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>10);
		//mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		$query = "SELECT * FROM `유성구_지역화폐발급데이터` LIMIT 10 ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
				"ISSU_YEAR" => $row['발급년'],
				"ISSU_MONTH"   => $row['발급월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"AGE_GROUP" => $row['연령대'],
				"SEX" => $row['성별'],
				"USED_NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}
}


function response($data){
	//$response['id'] = $data[0];
	//$response['기준년월'] = $data[1];
	//$response['광역시_상권'] = $data[2];
	//$response['시군구_상권'] = $data[3];
	//$response['법정동_상권'] = $data[4];
	//$response['국적'] = $data[5];
	//$response['이용건수'] = $data[6];
	//$response['이용금액'] = $data[7];
	//array_push($data,$totalCount);
	
	$json_response = json_encode($data,  JSON_UNESCAPED_UNICODE);
	//$object = simplexml_load_string($data);
	//$suggest = $object->CompleteSuggestion[0]->suggestion["data"];
	echo $json_response;
	//echo $suggest;
}
?>
<?php
header("Content-Type:application/json");
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

//유성구 지역화폐 이용 현황 API
/*
YS_YEAR				이용연도	4	1	2020	이용연도
YS_MONTH			이용월	2	1	05	이용월
SIDO_CODE			광역시도코드	5	1	30	광역시도코드
SIDO_NAME			광역시도명	50	1	대전광역시	광역시도명
SIGUNGU_CODE		시군구코드	5	1	30110	시군구코드
SIGUNGU_NAME		시군구명	50	1	동구	시군구명
DONG_CODE			법정동코드	12	1	3011010200	법정동코드
DONG_NAME			법정동명	20	1	인동	법정동명
INDST_L_CD			표준산업대분류코드	5	1	I	표준산업대분류코드
INDST_L_NAME		표준산업대분류명	200	1	숙박 및 음식점업(55~56)	표준산업대분류명
USED_ NUMBER_INDEX	지수이용금액	200	1	100.0	지수이용금액
USED_AMT_INDEX		지수이용건수	200	1	100.0	지수이용건수

*/

if ((isset($_GET['find_biz']) && $_GET['find_biz'] != "") && (isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_city']) && $_GET['find_city'] != "") && (isset($_GET['find_sigu']) && $_GET['find_sigu'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_city = $_GET['find_city'];
	$find_sigu = $_GET['find_sigu'];
	$find_area = $_GET['find_area'];
	$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
				"id"      => $row["id"],
				"YS_YEAR" => $row['이용연도'],
				"YS_MONTH"   => $row['이용월'],
				"SIDO_CODE" => $row['광역시도코드'],
				"SIDO_NAME" => $row['광역시도명'],
				"SIGUNGU_CODE" => $row['시군구코드'],
				"SIGUNGU_NAME" => $row['시군구명'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"INDST_L_CD" => $row['표준산업대분류코드'],
				"INDST_L_NAME" => $row['표준산업대분류명'],
				"USED_ NUMBER_INDEX" => $row['지수이용금액'],
				"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $totalPages;
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
					"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["body"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $totalPages;
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
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

	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터`  WHERE `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
					"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["body"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $totalPages;
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE  `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
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

		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE  `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
					"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			$data["header"][] = $numOfRows;
			//$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}	
} else if ((isset($_GET['find_biz']) && $_GET['find_biz'] != "") && (isset($_GET['find_city']) && $_GET['find_city'] != "") && (isset($_GET['find_sigu']) && $_GET['find_sigu'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_city = $_GET['find_city'];
	$find_sigu = $_GET['find_sigu'];
	//$find_area = $_GET['find_area'];
	$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터`  WHERE `이용연도`='{$find_year}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터`  WHERE `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `표준사업대분류명` LIKE '%{$find_biz}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
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

		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `표준사업대분류명` LIKE '%{$find_biz}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE WHERE `이용연도`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
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

		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%'  ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	}
} else if ((isset($_GET['find_biz']) && $_GET['find_biz'] != "") && (isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_city']) && $_GET['find_city'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_city = $_GET['find_city'];
	$find_biz = $_GET['find_biz'];
	$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%'  ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터`  WHERE `이용연도`='{$find_year}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
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

		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	}
} else if ((isset($_GET['find_biz']) && $_GET['find_biz'] != "") && (isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_sigu']) && $_GET['find_sigu'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_sigu = $_GET['find_sigu'];
	$find_biz = $_GET['find_biz'];
	$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];
	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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

		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	}			
} else if ((isset($_GET['find_biz']) && $_GET['find_biz'] != "") && (isset($_GET['find_city']) && $_GET['find_city'] != "") && (isset($_GET['serviceKey']))) {
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `광역시도명` LIKE '%{$find_city}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `광역시도명` LIKE '%{$find_city}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `광역시도명` LIKE '%{$find_city}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `표준산업대분류명` LIKE '%{$find_biz}%' AND `광역시도명` LIKE '%{$find_city}%' ";
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

		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `표준산업대분류명` LIKE '%{$find_biz}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	}	
} else if ((isset($_GET['find_biz']) && $_GET['find_biz'] != "") && (isset($_GET['find_sigu']) && $_GET['find_sigu'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_sigu = $_GET['find_sigu'];
	$find_biz = $_GET['find_biz'];
	//$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];
	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `표준산업대분류명` LIKE '%{$find_biz}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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

		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `표준산업대분류명` LIKE '%{$find_biz}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	}	
} else if ((isset($_GET['find_biz']) && $_GET['find_biz'] != "") && (isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	//$find_sigu = $_GET['find_sigu'];
	$find_biz = $_GET['find_biz'];
	$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];
	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' ";
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

		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `표준산업대분류명` LIKE '%{$find_biz}%' AND `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	}
} else if ((isset($_GET['find_biz']) && $_GET['find_biz'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	//$find_sigu = $_GET['find_sigu'];
	$find_biz = $_GET['find_biz'];
	//$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];
	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터`  WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터`  WHERE `이용연도`='{$find_year}' AND `표준산업대분류명` LIKE '%{$find_biz}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터`  WHERE `이용연도`='{$find_year}' AND `표준산업대분류명` LIKE '%{$find_biz}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터`  WHERE `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터`  WHERE `이용월`='{$find_month}' AND `표준산업대분류명` LIKE '%{$find_biz}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터`  WHERE `표준산업대분류명` LIKE '%{$find_biz}%' ";
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

		$query = "SELECT * FROM `유성구_지역화폐이용데이터`  WHERE `표준산업대분류명` LIKE '%{$find_biz}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND  `법정동명` LIKE '%{$find_area}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND  `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND  `법정동명` LIKE '%{$find_area}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE WHERE `이용연도`='{$find_year}' AND  `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND  `법정동명` LIKE '%{$find_area}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND  `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `법정동명` LIKE '%{$find_area}%' ";
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

		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `법정동명` LIKE '%{$find_area}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%'  ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터`WHERE `이용연도`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
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

		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터`WHERE `이용월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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

		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	}	
} else if ((isset($_GET['find_city']) && $_GET['find_city'] != "") && (isset($_GET['find_sigu']) && $_GET['find_sigu'] != "") && (isset($_GET['serviceKey']))) {
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
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

		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `광역시도명` LIKE '%{$find_city}%' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}'  AND  `광역시도명` LIKE '%{$find_city}%'  ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}'  AND  `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND  `광역시도명` LIKE '%{$find_city}%' ";
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

		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND  `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}'  AND  `광역시도명` LIKE '%{$find_city}%' ";
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

		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}'  AND  `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `광역시도명` LIKE '%{$find_city}%' ";
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

		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `광역시도명` LIKE '%{$find_city}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `시군구명` LIKE '%{$find_sigu}%' ";
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
		
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' AND `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `시군구명` LIKE '%{$find_sigu}%' ";
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

		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `시군구명` LIKE '%{$find_sigu}%' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	}			
} else {
	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "") && (isset($_GET['serviceKey']))) {

		include('db.php');
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];
		$serviceKey = $_GET['serviceKey'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' AND `이용월`='{$find_month}' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['serviceKey']))) {

		include('db.php');
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];
		$serviceKey = $_GET['serviceKey'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용연도`='{$find_year}' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "") && (isset($_GET['serviceKey']))) {

		include('db.php');
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];
		$serviceKey = $_GET['serviceKey'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' ";
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
	
		$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `이용월`='{$find_month}' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
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
		include('db.php');
		//$find_city = $_GET['find_city'];
		//$find_sigu = $_GET['find_sigu'];
		//$find_area = $_GET['find_area'];
		//$find_biz = $_GET['find_biz'];
		//$query = '';
		//$query = "SELECT COUNT(*) FROM `유성구_유성구_지역화폐이용데이터` LIMIT 10 ";
		//$result2 = mysqli_query($con, $query);
		//$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>10);
		//mysqli_free_result($result2);
		
		$data = array();
		$i=0;
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$totalCount= array("totalCount"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		$query = "SELECT * FROM `유성구_지역화폐이용데이터` LIMIT 10 ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['이용연도'],
					"YS_MONTH"   => $row['이용월'],
					"SIDO_CODE" => $row['광역시도코드'],
					"SIDO_NAME" => $row['광역시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"USED_ NUMBER_INDEX" => $row['지수이용금액'],
					"USED_AMT_INDEX" => $row['지수이용건수']
				);
				//response($data);
				//array_push($data,$sub_data);
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $totalPages;
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
	echo $json_response;
}
?>
<?php
header("Content-Type:application/json");
// 유성구 소상공인 사업체 정보 조회 API
/*
YS_YEAR				기준연도	50	1	2020	기준연도
YS_MONTH			기준월	4	1	3	기준월
DONG_CODE			법정동코드	12	1	3020010100	법정동코드
DONG_NAME			법정동명	120	1	원내동	법정동명
INDST_L_CD			표준산업대분류코드	5	1	C	표준산업대분류코드
INDST_L_NAME		표준산업대분류명	100	1	제조업(10~34)	표준산업대분류명
INDST_M_CD			표준산업중분류코드	12	1	C10	표준산업중분류코드
INDST_M_NAME		표준산업중분류명	100	1	식료품 제조업	표준산업중분류명
INDST_DETAILED_CD	표준산업세세분류코드	12	1	C10711	표준산업세세분류코드
INDST_DETAILED_NAME	표준산업세세분류명	100	1	떡류 제조업	표준산업세세분류명
TOTAL_ENTRP_NUMBER	전체사업수	100	1	3	전체사업수
NEW_ENTRP_NUMBER	신규업체수	100	1	0	신규업체수
DPRTUR_ENTRP_NUMBER	이탈업체수	100	1	0	이탈업체수
*/
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

if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_biz']) && $_GET['find_biz'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_biz = $_GET['find_biz'];
	$find_area = $_GET['find_area'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] !="") && (isset($_GET['find_month']) && $_GET['find_month'] !="")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];
		//$find_area = $_GET['find_area'];
		//$find_biz = $_GET['find_biz'];


		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_소상공인_사업체` WHERE `기준연도`= '{$find_year}' AND `기준월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
		$data = array();
		$i=0;

		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$row3 = mysqli_num_rows($result2);

		$totalCount = array("totalCount"=>$row2[0]);
		//$totalCount = array("totalCount"=>$row3);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));		
		//$totalPages = array("totalPages"=>ceil($row3 / $no_of_records_per_page));		
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
		
		mysqli_free_result($result2);
	
		$query = "SELECT * FROM `유성구_소상공인_사업체` WHERE `기준연도`= '{$find_year}' AND `기준월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
	
		$result = mysqli_query($con, $query);
	
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
				"id"      => $row["id"],
				"YS_YEAR" => $row['기준연도'],
				"YS_MONTH"   => $row['기준월'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"INDST_L_CD" => $row['표준산업대분류코드'],
				"INDST_L_NAME" => $row['표준산업대분류명'],
				"INDST_M_CD" => $row['표준산업중분류코드'],
				"INDST_M_NAME" => $row['표준산업중분류명'],
				"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
				"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
				"TOTAL_ENTRP_NUMBER" => $row['전체업체수'],
				"NEW_ENTRP_NUMBER" => $row['신규업체수'],
				"DPRTUR_ENTRP_NUMBER" => $row['이탈업체수']
				);
				//response($data);
				//array_push($data,$sub_data);
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $totalPages;
			//$data["header"][]= $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	} else if (isset($_GET['find_year']) && $_GET['find_year'] !="") {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];
		$find_area = $_GET['find_area'];
		//$find_biz = $_GET['find_biz'];

		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_소상공인_사업체` WHERE `기준연도`= '{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
		$data = array();
		$i=0;

		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));

		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
		
		mysqli_free_result($result2);
	
		$query = "SELECT * FROM `유성구_소상공인_사업체` WHERE `기준연도`= '{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
	
		$result = mysqli_query($con, $query);
	
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"   => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"TOTAL_ENTRP_NUMBER" => $row['전체업체수'],
					"NEW_ENTRP_NUMBER" => $row['신규업체수'],
					"DPRTUR_ENTRP_NUMBER" => $row['이탈업체수']
				);
				//response($data);
				//array_push($data,$sub_data);
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $totalPages;
			//$data["header"][]= $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	} else {
		//$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];
		$find_area = $_GET['find_area'];
		//$find_biz = $_GET['find_biz'];
		//$serviceKey = $_GET['serviceKey'];
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_소상공인_사업체` WHERE `법정동명` LIKE '%{$find_area}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
		$data = array();
		$i=0;

		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
		
		mysqli_free_result($result2);
	
		$query = "SELECT * FROM `유성구_소상공인_사업체` WHERE `법정동명` LIKE '%{$find_area}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
	
		$result = mysqli_query($con, $query);
	
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"   => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"TOTAL_ENTRP_NUMBER" => $row['전체업체수'],
					"NEW_ENTRP_NUMBER" => $row['신규업체수'],
					"DPRTUR_ENTRP_NUMBER" => $row['이탈업체수']
				);
				//response($data);
				//array_push($data,$sub_data);
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $totalPages;
			//$data["header"][]= $numOfRows;
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
	$find_area = $_GET['find_area'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] !="") && (isset($_GET['find_month']) && $_GET['find_month'] !="")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];
		$serviceKey = $_GET['serviceKey'];
		//$find_area = $_GET['find_area'];
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_소상공인_사업체` WHERE `기준연도`= '{$find_year}' AND `기준월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' ";
		$data = array();
		$i=0;

		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		mysqli_free_result($result2);
	
		$query = "SELECT * FROM `유성구_소상공인_사업체` WHERE `기준연도`= '{$find_year}' AND `기준월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' ";
	
		$result = mysqli_query($con, $query);
	
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"   => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"TOTAL_ENTRP_NUMBER" => $row['전체업체수'],
					"NEW_ENTRP_NUMBER" => $row['신규업체수'],
					"DPRTUR_ENTRP_NUMBER" => $row['이탈업체수']
				);
				//response($data);
				//array_push($data,$sub_data);
				$data["body"][] = $sub_data;
				
			}
			
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $totalPages;
			//$data["header"][]= $numOfRows;
			$data["header"][] = $resultMsg;
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	} else if (isset($_GET['find_year']) && $_GET['find_year'] !="") {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];
		//$find_area = $_GET['find_area'];
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_소상공인_사업체` WHERE `기준연도`= $find_year AND `법정동명` LIKE '%'$find_area'%' ";
		$data = array();
		$i=0;

		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
		mysqli_free_result($result2);
	
		$query = "SELECT * FROM `유성구_소상공인_사업체` WHERE `기준연도`= $find_year AND `법정동명` LIKE '%'$find_area'%' ";
	
		$result = mysqli_query($con, $query);
	
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"   => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"TOTAL_ENTRP_NUMBER" => $row['전체업체수'],
					"NEW_ENTRP_NUMBER" => $row['신규업체수'],
					"DPRTUR_ENTRP_NUMBER" => $row['이탈업체수']
				);
				//response($data);
				//array_push($data,$sub_data);
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $totalPages;
			//$data["header"][]= $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	} else {
		//$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];
		$find_area = $_GET['find_area'];
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_소상공인_사업체` WHERE `법정동명` LIKE '%'$find_area'%' ";
		$data = array();
		$i=0;

		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		mysqli_free_result($result2);
	
		$query = "SELECT * FROM `유성구_소상공인_사업체` WHERE `법정동명` LIKE '%'$find_area'%' ";
	
		$result = mysqli_query($con, $query);
	
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"   => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"TOTAL_ENTRP_NUMBER" => $row['전체업체수'],
					"NEW_ENTRP_NUMBER" => $row['신규업체수'],
					"DPRTUR_ENTRP_NUMBER" => $row['이탈업체수']
				);
				//response($data);
				//array_push($data,$sub_data);
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $totalPages;
			//$data["header"][]= $numOfRows;
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
	$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] !="") && (isset($_GET['find_month']) && $_GET['find_month'] !="")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];
		//$find_biz = $_GET['find_biz'];
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_소상공인_사업체` WHERE `기준연도`= '{$find_year}' AND `기준월`='{$find_month}' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
		$data = array();
		$i=0;

		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);			
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
		mysqli_free_result($result2);
	
		$query = "SELECT * FROM `유성구_소상공인_사업체` WHERE `기준연도`= '{$find_year}' AND `기준월`='{$find_month}' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
	
		$result = mysqli_query($con, $query);
	
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"   => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"TOTAL_ENTRP_NUMBER" => $row['전체업체수'],
					"NEW_ENTRP_NUMBER" => $row['신규업체수'],
					"DPRTUR_ENTRP_NUMBER" => $row['이탈업체수']
				);
				//response($data);
				//array_push($data,$sub_data);
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $totalPages;
			//$data["header"][]= $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}		

	} else if (isset($_GET['find_year']) && $_GET['find_year'] !="") {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];
		//$find_biz = $_GET['find_biz'];
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_소상공인_사업체` WHERE `기준연도`= '{$find_year}' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
		$data = array();
		$i=0;

		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);			
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
		
		mysqli_free_result($result2);
	
		$query = "SELECT * FROM `유성구_소상공인_사업체` WHERE `기준연도`= '{$find_year}' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
	
		$result = mysqli_query($con, $query);
	
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"   => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"TOTAL_ENTRP_NUMBER" => $row['전체업체수'],
					"NEW_ENTRP_NUMBER" => $row['신규업체수'],
					"DPRTUR_ENTRP_NUMBER" => $row['이탈업체수']
				);
				//response($data);
				//array_push($data,$sub_data);
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $totalPages;
			//$data["header"][]= $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	} else {
		//$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];
		//$find_biz = $_GET['find_biz'];
		//$query = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_소상공인_사업체` WHERE (`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%') ";
		$data = array();
		$i=0;
						
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$result2 = mysqli_query($con, $query2);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
		mysqli_free_result($result2);
	
		$query = "SELECT * FROM `유성구_소상공인_사업체` WHERE (`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%') ";
	
		$result = mysqli_query($con, $query);
	
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"   => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"TOTAL_ENTRP_NUMBER" => $row['전체업체수'],
					"NEW_ENTRP_NUMBER" => $row['신규업체수'],
					"DPRTUR_ENTRP_NUMBER" => $row['이탈업체수']
				);
				//response($data);
				//array_push($data,$sub_data);
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $totalPages;
			//$data["header"][]= $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}

} else  {

	if ((isset($_GET['find_year']) && $_GET['find_year'] !="") && (isset($_GET['find_month']) && $_GET['find_month'] !="") && (isset($_GET['serviceKey']))) {
	
		include('db.php');
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];
		$serviceKey = $_GET['serviceKey'];
		//$find_biz = $_GET['find_biz'];
		$query = '';
		$query = " SELECT COUNT(*) FROM `유성구_소상공인_사업체` WHERE `기준연도`= '{$find_year}' AND `기준월`='{$find_month}' ";
		//$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];
		//$find_biz = $_GET['find_biz'];
		//$query = '';
		//$query = "SELECT COUNT(*) FROM `유성구_소상공인_사업체` WHERE `표준산업세세분류명` LIKE '%'$find_biz'%' ";
		$data = array();
		$i=0;
				
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);	
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
				
		mysqli_free_result($result2);

		$query = " SELECT * FROM `유성구_소상공인_사업체` WHERE `기준연도`= '{$find_year}' AND `기준월`='{$find_month}' ";

		$result = mysqli_query($con, $query);

		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"   => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"TOTAL_ENTRP_NUMBER" => $row['전체업체수'],
					"NEW_ENTRP_NUMBER" => $row['신규업체수'],
					"DPRTUR_ENTRP_NUMBER" => $row['이탈업체수']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["pageNo"][] = $pageNo;
				//$data["numOfRows"][]= $numOfRows;
				$data["body"][] = $sub_data;
				
			}
			//array_push($data,$sub_data);
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $totalPages;
			//$data["header"][]= $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	} else if ((isset($_GET['find_year']) && $_GET['find_year'] !="") && (isset($_GET['serviceKey']))) {
		include('db.php');
		$find_year = $_GET['find_year'];
		$find_service = $_GET['serviceKey'];
		//$find_month = $_GET['find_month'];
		//$find_biz = $_GET['find_biz'];
		$query = '';
		$query = " SELECT COUNT(*) FROM `유성구_소상공인_사업체` WHERE `기준연도`= '{$find_year}' ";
		//$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];
		//$find_biz = $_GET['find_biz'];
		//$query = '';
		//$query = "SELECT COUNT(*) FROM `유성구_소상공인_사업체` WHERE `표준산업세세분류명` LIKE '%'$find_biz'%' ";
		$data = array();
		$i=0;

		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);			
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$totalPages = array("totalPages"=>ceil($row2[0] / $no_of_records_per_page));
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		mysqli_free_result($result2);

		$query = " SELECT * FROM `유성구_소상공인_사업체` WHERE `기준연도`= '{$find_year}' ";

		$result = mysqli_query($con, $query);

		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"   => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"TOTAL_ENTRP_NUMBER" => $row['전체업체수'],
					"NEW_ENTRP_NUMBER" => $row['신규업체수'],
					"DPRTUR_ENTRP_NUMBER" => $row['이탈업체수']
				);
				//response($data);
				//array_push($data,$sub_data);
				$data["body"][] = $sub_data;
				
			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $totalPages;
			//$data["header"][]= $numOfRows;
			$data["header"][] = $resultMsg;

			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	} else {
		include('db.php');
			
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$totalCount = array("totalCount"=>10);
		$totalPages = array("totalPages"=>1);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		$query = "SELECT * FROM `유성구_소상공인_사업체` LIMIT 10 ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"   => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"TOTAL_ENTRP_NUMBER" => $row['전체업체수'],
					"NEW_ENTRP_NUMBER" => $row['신규업체수'],
					"DPRTUR_ENTRP_NUMBER" => $row['이탈업체수']
				);
				//response($data);
				//array_push($data,$sub_data);
				$data["body"][] = $sub_data;
				
			}
			//array_push($data,$totalCount);
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $totalPages;
			//$data["header"][]= $numOfRows;
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
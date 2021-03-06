<?php
// 유성구 신규이탈사업체데이터 정보 조회 API
header("Content-Type:application/json");
/* 
BIZ_NUMBER				상가업소번호	50	1	20697557	상가업소번호
BIZ_NAME				상호명	250	1	꼬맥	상호명
BRANCH_NAME				지점명	120	1	대전점	지점명
INDST_L_CD				표준산업대분류코드	5	1	I	표준산업대분류코드
INDST_L_NAME			표준산업대분류명	120	1	숙박 및 음식점업(55~56)	표준산업대분류명
INDST_M_CD				표준산업중분류코드	5	1	I56	표준산업중분류코드
INDST_M_NAME			표준산업중분류명	120	1	음식점 및 주점업	표준산업중분류명
INDST_DETAILED_CD		표준산업세세분류코드	12	1	I56219	표준산업세세분류코드
INDST_DETAILED_NAME		표준산업세세분류명	250	1	기타 주점업	표준산업세세분류명
SI_DO_CODE				시도코드	5	1	30	시도코드
SI_DO_NAME				시도명	50	1	대전광역시	시도명
SIGUNGU_CODE			시군구코드	5	1	30200	시군구코드
SIGUNGU_NAME			시군구명	5	1	유성구	시군구명
ADMIN_DONG				행정동코드	12	1	3020054000	행정동코드
ADMIN_DONG_NAME			행정동명	50	1	온천2동	행정동명
DONG_CODE				법정동코드	12	1	3020012200	법정동코드
DONG_NAME				법정동명	50	1	궁동	법정동명
LOTNO_CODE				지번코드	25	1	3020012200204100012	지번코드
SITE_DIVISION_CODE		대지구분코드	5	1	1	대지구분코드
SITE_DIVISION_NAME		대지구분명	50	1	대지	대지구분명
LOT_MAIN_NUMBER			지번본번지	5	1	410	지번본번지
LOT_SUB_NUMBER			지번부번지	5	1	12.0	지번부번지
LOT_ADRESS_NUMBER		지번주소	250	1	대전광역시 유성구 궁동 410-12	지번주소
ROAD_NM_CD				도로명코드	12	1	302004301133	도로명코드
ROAD_NM					도로명	250	1	대전광역시 유성구 대학로151번길	도로명
BUILDING_MAIN_NUMBER	건물본번지	5	0	27	건물본번지
BUILDING_SUB_NUMBER		건물부번지	5	0		건물부번지
BUILDING_MNG_NUMBER		건물관리번호	25	0	3020012200104100012009070	건물관리번호
BUILDING_NAME			건물명	250	0		건물명
ROAD_NM_ADDRESS			도로명주소	250	1	대전광역시 유성구 대학로151번길 27	도로명주소
OLD_ZIP_CODE			구우편번호	12	1	305335.0	구우편번호
NEW_ZIP_CODE			신우편번호	50	1	34137.0	신우편번호
DONG_INFORMATION		동정보	50	0		동정보
FLOOR_INFORMATION		층정보	50	0	4	층정보
HOUSEHOLD_INFORMATION	호정보	50	0		호정보
LONGITUDE				경도	25	0	127.350034755023	경도
LATITUDE				위도	25	0		위도
YS_YEAR					기준연도	4	1	2020	기준연도
YS_MONTH				기준월	2	1	3	기준월
NEW_DPRTR_STATUS		신규이탈여부	12	1	이탈	신규이탈여부
 
find_biz_number	상가업소번호	50	0	20697557	상가업소번호
Find_name	상호명	250	0	꼬맥	상호명

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

if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_biz']) && $_GET['find_biz'] != "") && (isset($_GET['find_sangho']) && $_GET['find_sangho'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_area = $_GET['find_area'];
	$find_biz = $_GET['find_biz'];
	$find_sangho = $_GET['find_sangho'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {

		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `기준월` = '{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$totalCount = array("totalCount"=>$row2[0]);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `기준월` = '{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}

	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
		
		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준월` = '{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준월` = '{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
				//$data["resultdata"][] = $sub_data;
				//$data["body"][] = $sub_data;
				$data["body"][] = $sub_data;

			}
			//$data["resultdata"][] = $totalCount;
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else {
		$find_area = $_GET['find_area'];
		$find_biz= $_GET['find_biz'];
		$serviceKey = $_GET['serviceKey'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}		
	}

} else if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_biz']) && $_GET['find_biz'] != "") && (isset($_GET['find_biz_number']) && $_GET['find_biz_number'] != "") && (isset($_GET['find_sangho']) && $_GET['find_sangho'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_area = $_GET['find_area'];
	$find_biz = $_GET['find_biz'];
	$find_biz_number = $_GET['find_biz_number'];
	$find_sangho = $_GET['find_sangho'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {

		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `기준월` = '{$find_month}'  AND `상가업소번호` LIKE '%{$find_biz_number}%' AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$totalCount = array("totalCount"=>$row2[0]);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `기준월` = '{$find_month}' AND `상가업소번호` LIKE '%{$find_biz_number}%'  AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}

	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `상가업소번호` LIKE '%{$find_biz_number}%' AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
		
		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `상가업소번호` LIKE '%{$find_biz_number}%' AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준월` = '{$find_month}' AND `상가업소번호` LIKE '%{$find_biz_number}%'  AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준월` = '{$find_month}' AND `상가업소번호` LIKE '%{$find_biz_number}%'  AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
				//$data["resultdata"][] = $sub_data;
				//$data["body"][] = $sub_data;
				$data["body"][] = $sub_data;

			}
			//$data["resultdata"][] = $totalCount;
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else {
		//$find_area = $_GET['find_area'];
		//$find_biz= $_GET['find_biz'];

		//$serviceKey = $_GET['serviceKey'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `상가업소번호` LIKE '%{$find_biz_number}%'  AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `상가업소번호` LIKE '%{$find_biz_number}%'  AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}		
	}
} else if ((isset($_GET['find_biz']) && $_GET['find_biz'] != "") && (isset($_GET['find_biz_number']) && $_GET['find_biz_number'] != "") && (isset($_GET['find_sangho']) && $_GET['find_sangho'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	//$find_area = $_GET['find_area'];
	$find_biz = $_GET['find_biz'];
	$find_biz_number = $_GET['find_biz_number'];
	$find_sangho = $_GET['find_sangho'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {

		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`='{$find_year}' AND `기준월`='{$find_month}'  AND `상가업소번호` LIKE '%{$find_biz_number}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$totalCount = array("totalCount"=>$row2[0]);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`='{$find_year}' AND `기준월`='{$find_month}' AND `상가업소번호` LIKE '%{$find_biz_number}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}

	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`='{$find_year}' AND `상가업소번호` LIKE '%{$find_biz_number}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
		
		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`='{$find_year}' AND `상가업소번호` LIKE '%{$find_biz_number}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준월`='{$find_month}' AND `상가업소번호` LIKE '%{$find_biz_number}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준월`='{$find_month}' AND `상가업소번호` LIKE '%{$find_biz_number}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
				//$data["resultdata"][] = $sub_data;
				//$data["body"][] = $sub_data;
				$data["body"][] = $sub_data;

			}
			//$data["resultdata"][] = $totalCount;
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else {
		//$find_area = $_GET['find_area'];
		//$find_biz= $_GET['find_biz'];

		//$serviceKey = $_GET['serviceKey'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `상가업소번호` LIKE '%{$find_biz_number}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `상가업소번호` LIKE '%{$find_biz_number}%' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}		
	}
} else if ((isset($_GET['find_biz']) && $_GET['find_biz'] != "") && (isset($_GET['find_biz_number']) && $_GET['find_biz_number'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	//$find_area = $_GET['find_area'];
	$find_biz = $_GET['find_biz'];
	$find_biz_number = $_GET['find_biz_number'];
	$find_sangho = $_GET['find_sangho'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {

		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`='{$find_year}' AND `기준월`='{$find_month}'  AND `상가업소번호` LIKE '%{$find_biz_number}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$totalCount = array("totalCount"=>$row2[0]);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`='{$find_year}' AND `기준월`='{$find_month}' AND `상가업소번호` LIKE '%{$find_biz_number}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}

	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`='{$find_year}' AND `상가업소번호` LIKE '%{$find_biz_number}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
		
		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`='{$find_year}' AND `상가업소번호` LIKE '%{$find_biz_number}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준월`='{$find_month}' AND `상가업소번호` LIKE '%{$find_biz_number}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준월`='{$find_month}' AND `상가업소번호` LIKE '%{$find_biz_number}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
				//$data["resultdata"][] = $sub_data;
				//$data["body"][] = $sub_data;
				$data["body"][] = $sub_data;

			}
			//$data["resultdata"][] = $totalCount;
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else {
		//$find_area = $_GET['find_area'];
		//$find_biz= $_GET['find_biz'];

		//$serviceKey = $_GET['serviceKey'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `상가업소번호` LIKE '%{$find_biz_number}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `상가업소번호` LIKE '%{$find_biz_number}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}		
	}	
} else if ((isset($_GET['find_biz_number']) && $_GET['find_biz_number'] != "") && (isset($_GET['find_sangho']) && $_GET['find_sangho'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	//$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$find_biz_number = $_GET['find_biz_number'];
	$find_sangho = $_GET['find_sangho'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {

		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`='{$find_year}' AND `기준월`='{$find_month}'  AND `상가업소번호` LIKE '%{$find_biz_number}%' AND `상호명` LIKE '%{$find_sangho}%' ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$totalCount = array("totalCount"=>$row2[0]);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`='{$find_year}' AND `기준월`='{$find_month}' AND `상가업소번호` LIKE '%{$find_biz_number}%' AND `상호명` LIKE '%{$find_sangho}%'  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}

	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`='{$find_year}' AND `상가업소번호` LIKE '%{$find_biz_number}%' AND `상호명` LIKE '%{$find_sangho}%' ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
		
		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`='{$find_year}' AND `상가업소번호` LIKE '%{$find_biz_number}%' AND `상호명` LIKE '%{$find_sangho}%' ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준월`='{$find_month}' AND `상가업소번호` LIKE '%{$find_biz_number}%' AND `상호명` LIKE '%{$find_sangho}%' ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준월`='{$find_month}' AND `상가업소번호` LIKE '%{$find_biz_number}%' AND `상호명` LIKE '%{$find_sangho}%' ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
				//$data["resultdata"][] = $sub_data;
				//$data["body"][] = $sub_data;
				$data["body"][] = $sub_data;

			}
			//$data["resultdata"][] = $totalCount;
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else {
		//$find_area = $_GET['find_area'];
		//$find_biz= $_GET['find_biz'];

		//$serviceKey = $_GET['serviceKey'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `상가업소번호` LIKE '%{$find_biz_number}%' AND `상호명` LIKE '%{$find_sangho}%' ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `상가업소번호` LIKE '%{$find_biz_number}%' AND `상호명` LIKE '%{$find_sangho}%' ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}		
	}	
} else if ((isset($_GET['find_biz']) && $_GET['find_biz'] != "") && (isset($_GET['find_sangho']) && $_GET['find_sangho'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	//$find_area = $_GET['find_area'];
	$find_biz = $_GET['find_biz'];
	$find_sangho = $_GET['find_sangho'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {

		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `기준월` = '{$find_month}' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$totalCount = array("totalCount"=>$row2[0]);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `기준월` = '{$find_month}' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}

	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
		
		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`='{$find_year}' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준월`='{$find_month}' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준월`='{$find_month}' AND `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
				//$data["resultdata"][] = $sub_data;
				//$data["body"][] = $sub_data;
				$data["body"][] = $sub_data;

			}
			//$data["resultdata"][] = $totalCount;
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else {
		$find_area = $_GET['find_area'];
		$find_biz= $_GET['find_biz'];
		$serviceKey = $_GET['serviceKey'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `상호명` LIKE '%{$find_sangho}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR(`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}		
	}
} else if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_sangho']) && $_GET['find_sangho'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$find_sangho = $_GET['find_sangho'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {

		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `기준월` = '{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$totalCount = array("totalCount"=>$row2[0]);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `기준월` = '{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%' ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}

	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%'  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
		
		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%'  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준월` = '{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%'  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE ``기준월` = '{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%'  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
				//$data["resultdata"][] = $sub_data;
				//$data["body"][] = $sub_data;
				$data["body"][] = $sub_data;

			}
			//$data["resultdata"][] = $totalCount;
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else {
		$find_area = $_GET['find_area'];
		$find_biz= $_GET['find_biz'];
		$serviceKey = $_GET['serviceKey'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%'  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND `상호명` LIKE '%{$find_sangho}%'  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}		
	}

} else if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['find_biz']) && $_GET['find_biz'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_area = $_GET['find_area'];
	$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {

		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `기준월` = '{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$totalCount = array("totalCount"=>$row2[0]);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `기준월` = '{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}

	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
		
		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `법정동명` LIKE '%{$find_area}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준월` = '{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준월` = '{$find_month}' AND `법정동명` LIKE '%{$find_area}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
				//$data["resultdata"][] = $sub_data;
				//$data["body"][] = $sub_data;
				$data["body"][] = $sub_data;

			}
			//$data["resultdata"][] = $totalCount;
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			
			mysqli_free_result($result);
			response($data);	
			mysqli_close($con);
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else {
		$find_area = $_GET['find_area'];
		$find_biz= $_GET['find_biz'];
		$serviceKey = $_GET['serviceKey'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `법정동명` LIKE '%{$find_area}%' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%'))  ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}		
	}

} else if ((isset($_GET['find_biz']) && $_GET['find_biz'] != "") && (isset($_GET['serviceKey']))) {
		include('db.php');
		//$find_area = $_GET['find_area'];
		$find_biz = $_GET['find_biz'];
		$serviceKey = $_GET['serviceKey'];
	
		if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {
	
			$find_year = $_GET['find_year'];
			$find_month = $_GET['find_month'];
	
			$query2 = '';
			$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `기준월` = '{$find_month}' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
			$result2 = mysqli_query($con, $query2);
			$row2 = mysqli_fetch_array($result2);
			$totalCount = array("totalCount"=>$row2[0]);
			$pageNo = array("pageNo"=>1);
			$numOfRows=array("numOfRows"=>10);			
			$resultCode = array("resultCode"=>"00");
			$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
			mysqli_free_result($result2);
	
			$query='';
			$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `기준월` = '{$find_month}' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
	
			$data = array();
			$i = 0;
			$result = mysqli_query($con, $query);
			if(mysqli_num_rows($result)>0) {
				while($row = mysqli_fetch_array($result))
				{
					$sub_data =  array(
						"id" => $row["id"],
						"BIZ_NUMBER" => $row["상가업소번호"],
						"BIZ_NAME" => $row["상호명"],
						"BRANCH_NAME" => $row['지점명'],
						"INDST_L_CD" => $row['표준산업대분류코드'],
						"INDST_L_NAME" => $row['표준산업대분류명'],
						"INDST_M_CD" => $row['표준산업중분류코드'],
						"INDST_M_NAME" => $row['표준산업중분류명'],
						"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
						"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
						"SI_DO_CODE" => $row['시도코드'],
						"SI_DO_NAME" => $row['시도명'],
						"SIGUNGU_CODE" => $row['시군구코드'],
						"SIGUNGU_NAME" => $row['시군구명'],
						"ADMIN_DONG" => $row['행정동코드'],
						"ADMIN_DONG_NAME" => $row['행정동명'],
						"DONG_CODE" => $row['법정동코드'],
						"DONG_NAME" => $row['법정동명'],
						"LOTNO_CODE" => $row['지번코드'],
						"SITE_DIVISION_CODE" => $row['대지구분코드'],
						"SITE_DIVISION_NAME" => $row['대지구분명'],
						"LOT_MAIN_NUMBER" => $row['지번본번지'],
						"LOT_SUB_NUMBER" => $row['지번부번지'],
						"LOT_ADRESS_NUMBER" => $row['지번주소'],
						"ROAD_NM_CD" => $row['도로명코드'],
						"ROAD_NM" => $row['도로명'],
						"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
						"BUILDING_SUB_NUMBER" => $row['건물부번지'],
						"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
						"BUILDING_NAME" => $row['건물명'],
						"ROAD_NM_ADDRESS" => $row['도로명주소'],
						"OLD_ZIP_CODE" => $row['구우편번호'],
						"NEW_ZIP_CODE" => $row['신우편번호'],
						"DONG_INFORMATION" => $row['동정보'],
						"FLOOR_INFORMATION" => $row['층정보'],
						"HOUSEHOLD_INFORMATION" => $row['호정보'],
						"LONGITUDE" => $row['경도'],
						"LATITUDE" => $row['위도'],
						"YS_YEAR" => $row['기준연도'],
						"YS_MONTH" => $row['기준월'],
						"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
					);
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
			} else {			
				response(NULL, NULL, 200,"No Record Found");			
			}
	
		} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
			$find_year = $_GET['find_year'];
			//$find_month = $_GET['find_month'];
	
			$query2 = '';
			$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
			$result2 = mysqli_query($con, $query2);
			$row2 = mysqli_fetch_array($result2);
			$totalCount = array("totalCount"=>$row2[0]);
			$pageNo = array("pageNo"=>1);
			$numOfRows=array("numOfRows"=>10);
			$resultCode = array("resultCode"=>"00");
			$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");						
	
			mysqli_free_result($result2);
	
			$query='';
			$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
	
			$data = array();
			$i = 0;
			$result = mysqli_query($con, $query);
			if(mysqli_num_rows($result)>0) {
				while($row = mysqli_fetch_array($result))
				{
					$sub_data =  array(
						"id" => $row["id"],
						"BIZ_NUMBER" => $row["상가업소번호"],
						"BIZ_NAME" => $row["상호명"],
						"BRANCH_NAME" => $row['지점명'],
						"INDST_L_CD" => $row['표준산업대분류코드'],
						"INDST_L_NAME" => $row['표준산업대분류명'],
						"INDST_M_CD" => $row['표준산업중분류코드'],
						"INDST_M_NAME" => $row['표준산업중분류명'],
						"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
						"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
						"SI_DO_CODE" => $row['시도코드'],
						"SI_DO_NAME" => $row['시도명'],
						"SIGUNGU_CODE" => $row['시군구코드'],
						"SIGUNGU_NAME" => $row['시군구명'],
						"ADMIN_DONG" => $row['행정동코드'],
						"ADMIN_DONG_NAME" => $row['행정동명'],
						"DONG_CODE" => $row['법정동코드'],
						"DONG_NAME" => $row['법정동명'],
						"LOTNO_CODE" => $row['지번코드'],
						"SITE_DIVISION_CODE" => $row['대지구분코드'],
						"SITE_DIVISION_NAME" => $row['대지구분명'],
						"LOT_MAIN_NUMBER" => $row['지번본번지'],
						"LOT_SUB_NUMBER" => $row['지번부번지'],
						"LOT_ADRESS_NUMBER" => $row['지번주소'],
						"ROAD_NM_CD" => $row['도로명코드'],
						"ROAD_NM" => $row['도로명'],
						"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
						"BUILDING_SUB_NUMBER" => $row['건물부번지'],
						"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
						"BUILDING_NAME" => $row['건물명'],
						"ROAD_NM_ADDRESS" => $row['도로명주소'],
						"OLD_ZIP_CODE" => $row['구우편번호'],
						"NEW_ZIP_CODE" => $row['신우편번호'],
						"DONG_INFORMATION" => $row['동정보'],
						"FLOOR_INFORMATION" => $row['층정보'],
						"HOUSEHOLD_INFORMATION" => $row['호정보'],
						"LONGITUDE" => $row['경도'],
						"LATITUDE" => $row['위도'],
						"YS_YEAR" => $row['기준연도'],
						"YS_MONTH" => $row['기준월'],
						"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
					);
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
			} else {			
				response(NULL, NULL, 200,"No Record Found");			
			}
		} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
			//$find_year = $_GET['find_year'];
			$find_month = $_GET['find_month'];
	
			$query2 = '';
			$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준월` = '{$find_month}' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
			$result2 = mysqli_query($con, $query2);
			$row2 = mysqli_fetch_array($result2);
			$totalCount = array("totalCount"=>$row2[0]);
			$pageNo = array("pageNo"=>1);
			$numOfRows=array("numOfRows"=>10);

			mysqli_free_result($result2);
	
			$query='';
			$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준월` = '{$find_month}' AND ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
	
			$data = array();
			$i = 0;
			$result = mysqli_query($con, $query);
			if(mysqli_num_rows($result)>0) {
				while($row = mysqli_fetch_array($result))
				{
					$sub_data =  array(
						"id" => $row["id"],
						"BIZ_NUMBER" => $row["상가업소번호"],
						"BIZ_NAME" => $row["상호명"],
						"BRANCH_NAME" => $row['지점명'],
						"INDST_L_CD" => $row['표준산업대분류코드'],
						"INDST_L_NAME" => $row['표준산업대분류명'],
						"INDST_M_CD" => $row['표준산업중분류코드'],
						"INDST_M_NAME" => $row['표준산업중분류명'],
						"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
						"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
						"SI_DO_CODE" => $row['시도코드'],
						"SI_DO_NAME" => $row['시도명'],
						"SIGUNGU_CODE" => $row['시군구코드'],
						"SIGUNGU_NAME" => $row['시군구명'],
						"ADMIN_DONG" => $row['행정동코드'],
						"ADMIN_DONG_NAME" => $row['행정동명'],
						"DONG_CODE" => $row['법정동코드'],
						"DONG_NAME" => $row['법정동명'],
						"LOTNO_CODE" => $row['지번코드'],
						"SITE_DIVISION_CODE" => $row['대지구분코드'],
						"SITE_DIVISION_NAME" => $row['대지구분명'],
						"LOT_MAIN_NUMBER" => $row['지번본번지'],
						"LOT_SUB_NUMBER" => $row['지번부번지'],
						"LOT_ADRESS_NUMBER" => $row['지번주소'],
						"ROAD_NM_CD" => $row['도로명코드'],
						"ROAD_NM" => $row['도로명'],
						"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
						"BUILDING_SUB_NUMBER" => $row['건물부번지'],
						"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
						"BUILDING_NAME" => $row['건물명'],
						"ROAD_NM_ADDRESS" => $row['도로명주소'],
						"OLD_ZIP_CODE" => $row['구우편번호'],
						"NEW_ZIP_CODE" => $row['신우편번호'],
						"DONG_INFORMATION" => $row['동정보'],
						"FLOOR_INFORMATION" => $row['층정보'],
						"HOUSEHOLD_INFORMATION" => $row['호정보'],
						"LONGITUDE" => $row['경도'],
						"LATITUDE" => $row['위도'],
						"YS_YEAR" => $row['기준연도'],
						"YS_MONTH" => $row['기준월'],
						"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
					);
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
			} else {			
				response(NULL, NULL, 200,"No Record Found");			
			}
		} else {
			$find_area = $_GET['find_area'];
			$find_biz= $_GET['find_biz'];
			$serviceKey = $_GET['serviceKey'];
	
			$query2 = '';
			$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
			$result2 = mysqli_query($con, $query2);
			$row2 = mysqli_fetch_array($result2);
			$totalCount = array("totalCount"=>$row2[0]);
			$pageNo = array("pageNo"=>1);
			$numOfRows=array("numOfRows"=>10);
			$resultCode = array("resultCode"=>"00");
			$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");			
	
			mysqli_free_result($result2);
	
			$query='';
			$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE ((`표준산업대분류명` LIKE '%{$find_biz}%') OR (`표준산업중분류명` LIKE '%{$find_biz}%') OR (`표준산업세세분류명` LIKE '%{$find_biz}%')) ";
	
			$data = array();
			$i = 0;
			$result = mysqli_query($con, $query);
			if(mysqli_num_rows($result)>0) {
				while($row = mysqli_fetch_array($result))
				{
					$sub_data =  array(
						"id" => $row["id"],
						"BIZ_NUMBER" => $row["상가업소번호"],
						"BIZ_NAME" => $row["상호명"],
						"BRANCH_NAME" => $row['지점명'],
						"INDST_L_CD" => $row['표준산업대분류코드'],
						"INDST_L_NAME" => $row['표준산업대분류명'],
						"INDST_M_CD" => $row['표준산업중분류코드'],
						"INDST_M_NAME" => $row['표준산업중분류명'],
						"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
						"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
						"SI_DO_CODE" => $row['시도코드'],
						"SI_DO_NAME" => $row['시도명'],
						"SIGUNGU_CODE" => $row['시군구코드'],
						"SIGUNGU_NAME" => $row['시군구명'],
						"ADMIN_DONG" => $row['행정동코드'],
						"ADMIN_DONG_NAME" => $row['행정동명'],
						"DONG_CODE" => $row['법정동코드'],
						"DONG_NAME" => $row['법정동명'],
						"LOTNO_CODE" => $row['지번코드'],
						"SITE_DIVISION_CODE" => $row['대지구분코드'],
						"SITE_DIVISION_NAME" => $row['대지구분명'],
						"LOT_MAIN_NUMBER" => $row['지번본번지'],
						"LOT_SUB_NUMBER" => $row['지번부번지'],
						"LOT_ADRESS_NUMBER" => $row['지번주소'],
						"ROAD_NM_CD" => $row['도로명코드'],
						"ROAD_NM" => $row['도로명'],
						"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
						"BUILDING_SUB_NUMBER" => $row['건물부번지'],
						"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
						"BUILDING_NAME" => $row['건물명'],
						"ROAD_NM_ADDRESS" => $row['도로명주소'],
						"OLD_ZIP_CODE" => $row['구우편번호'],
						"NEW_ZIP_CODE" => $row['신우편번호'],
						"DONG_INFORMATION" => $row['동정보'],
						"FLOOR_INFORMATION" => $row['층정보'],
						"HOUSEHOLD_INFORMATION" => $row['호정보'],
						"LONGITUDE" => $row['경도'],
						"LATITUDE" => $row['위도'],
						"YS_YEAR" => $row['기준연도'],
						"YS_MONTH" => $row['기준월'],
						"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
					);
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
			} else {			
				response(NULL, NULL, 200,"No Record Found");			
			}		
		}

} else if ((isset($_GET['find_area']) && $_GET['find_area'] != "") && (isset($_GET['serviceKey']))) {
	include('db.php');
	$find_area = $_GET['find_area'];
	//$find_biz = $_GET['find_biz'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "")) {

		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `기준월` = '{$find_month}' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);		
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `기준월` = '{$find_month}' AND `법정동명` LIKE '%{$find_area}%' ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}

	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "")) {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);		
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `법정동명` LIKE '%{$find_area}%' ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "")) {
		//$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준월` = '{$find_month}' AND `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");			

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준월` = '{$find_month}' AND `법정동명` LIKE '%{$find_area}%' ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
	} else {
		$find_area = $_GET['find_area'];
		//$find_biz= $_GET['find_biz'];
		$serviceKey = $_GET['serviceKey'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `법정동명` LIKE '%{$find_area}%' ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `법정동명` LIKE '%{$find_area}%' ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}		
	}
 
} else {
	if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "") && (isset($_GET['serviceKey']))) {
		include('db.php');
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];
		$serviceKey = $_GET['serviceKey'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `기준월` = '{$find_month}' ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
				

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' AND `기준월` = '{$find_month}' ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}

	} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "") ) {
		include('db.php');
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= '{$find_year}' ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}

	} else if ((isset($_GET['find_month']) && $_GET['find_month'] != "") ) {
		include('db.php');
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];

		$query2 = '';
		$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준월` = '{$find_month}' ";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		

		mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` WHERE `기준월` = '{$find_month}' ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;

			}
			//$data["header"][] = $pageNo;
			$data["header"][] = $resultCode;
			$data["header"][] = $totalCount;
			//$data["header"][] = $numOfRows;
			$data["header"][] = $resultMsg;
			response($data);	
			mysqli_close($con);
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}

	} else {
		include('db.php');
		//$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];

		$query2 = '';
		//$query2 = "SELECT COUNT(*) FROM `유성구_신규이탈사업체데이터` WHERE `기준연도`= $find_year AND `기준월` = $find_month ";
		//$result2 = mysqli_query($con, $query2);
		//$row2 = mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>10);
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);	
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");			

		//mysqli_free_result($result2);

		$query='';
		$query = "SELECT * FROM `유성구_신규이탈사업체데이터` LIMIT 10 ";

		$data = array();
		$i = 0;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$sub_data =  array(
					"id" => $row["id"],
					"BIZ_NUMBER" => $row["상가업소번호"],
					"BIZ_NAME" => $row["상호명"],
					"BRANCH_NAME" => $row['지점명'],
					"INDST_L_CD" => $row['표준산업대분류코드'],
					"INDST_L_NAME" => $row['표준산업대분류명'],
					"INDST_M_CD" => $row['표준산업중분류코드'],
					"INDST_M_NAME" => $row['표준산업중분류명'],
					"INDST_DETAILED_CD" => $row['표준산업세세분류코드'],
					"INDST_DETAILED_NAME" => $row['표준산업세세분류명'],
					"SI_DO_CODE" => $row['시도코드'],
					"SI_DO_NAME" => $row['시도명'],
					"SIGUNGU_CODE" => $row['시군구코드'],
					"SIGUNGU_NAME" => $row['시군구명'],
					"ADMIN_DONG" => $row['행정동코드'],
					"ADMIN_DONG_NAME" => $row['행정동명'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"LOTNO_CODE" => $row['지번코드'],
					"SITE_DIVISION_CODE" => $row['대지구분코드'],
					"SITE_DIVISION_NAME" => $row['대지구분명'],
					"LOT_MAIN_NUMBER" => $row['지번본번지'],
					"LOT_SUB_NUMBER" => $row['지번부번지'],
					"LOT_ADRESS_NUMBER" => $row['지번주소'],
					"ROAD_NM_CD" => $row['도로명코드'],
					"ROAD_NM" => $row['도로명'],
					"BUILDING_MAIN_NUMBER" => $row['건물본번지'],
					"BUILDING_SUB_NUMBER" => $row['건물부번지'],
					"BUILDING_MNG_NUMBER" => $row['건물관리번호'],
					"BUILDING_NAME" => $row['건물명'],
					"ROAD_NM_ADDRESS" => $row['도로명주소'],
					"OLD_ZIP_CODE" => $row['구우편번호'],
					"NEW_ZIP_CODE" => $row['신우편번호'],
					"DONG_INFORMATION" => $row['동정보'],
					"FLOOR_INFORMATION" => $row['층정보'],
					"HOUSEHOLD_INFORMATION" => $row['호정보'],
					"LONGITUDE" => $row['경도'],
					"LATITUDE" => $row['위도'],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH" => $row['기준월'],
					"NEW_DPRTR_STATUS" => $row['신규이탈여부']										
				);
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
		} else {			
			response(NULL, NULL, 200,"No Record Found");			
		}
		
	}

}


	//echo "<br/><br/>";
	//echo "<pre>";
	//echo var_dump($data);
	//echo "</pre>";
	

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
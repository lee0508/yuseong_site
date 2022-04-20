<?php
header("Content-Type:application/json");
if ((isset($_GET['find_year']) && $_GET['find_year'] !="") && (isset($_GET['find_month']) && $_GET['find_month'] != "") && (isset($_GET['find_area']) && $_GET['find_area'] != "")) {	
	include('db.php');
	//$order_id = explode(",",$_GET['num']);
	$find_year = $_GET['find_year'];
	$find_month = $_GET['find_month'];
	$find_area = $_GET['find_area'];
	$query = '';
	$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급연도`= $find_year AND `발급월`=$find_month AND `법정동명`=$find_area ";

	$data = array();
	$i=0;
		
	$result2 = mysqli_query($con, $query);
	$row2= mysqli_fetch_array($result2);
	$totalCount = array("totalCount"=>$row2[0]);
	
	mysqli_free_result($result2);

	//$query = "SELECT `발급연도`,`발급월`,`법정동명`,`성별`,`연령대`,`회원수`,SUM(`이용금액`) AS 이용금액,SUM(`이용건수`) AS 이용건수 FROM `유성구_지역화폐발급데이터` WHERE `발급연도`= $find_year AND `발급월`=$find_month AND `법정동명`=$find_area GROUP BY `법정동명`,`성별`,`연령대` ";
	
	$query = "SELECT `발급연도`,`발급월`,`법정동명`,`성별`,`연령대`,`회원수`,SUM(`이용금액`) AS 이용금액,SUM(`이용건수`) AS 이용건수 FROM `유성구_지역화폐발급데이터` WHERE `발급연도`= $find_year AND `발급월`=$find_month AND `법정동명`=$find_area GROUP BY `성별`,`연령대` ";

	$result = mysqli_query($con, $query);

	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result))
		{
			$sub_data = array(
			"발급연도" => $row['발급연도'],
			"발급월"   => $row['발급월'],
			"법정동명" => $row['법정동명'],
			"성별" => $row['성별'],
			"연령대" => $row['연령대'],
			"회원수" => $row['회원수'],
			"이용금액" => $row['이용금액'],
			"이용건수" => $row['이용건수']
			);
			//response($data);
			//array_push($data,$sub_data);
			$data["resultdata"][] = $sub_data;
			
		}
		$data["resultdata"][] = $totalCount;
		mysqli_free_result($result);
		response($data);	
		mysqli_close($con);
	}else{
		response(NULL, NULL, 200,"No Record Found");
	}
		
} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "") ) {
	
	include('db.php');
	$query = '';
	$find_year = $_GET['find_year'];
	$find_month = $_GET['find_month'];
	$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급연도`= $find_year AND `발급월`= $find_month ";
	$data = array();
	$i=0;
		
	$result2 = mysqli_query($con, $query);
	$row2= mysqli_fetch_array($result2);
	$totalCount = array("totalCount"=>$row2[0]);
	
	mysqli_free_result($result2);

	//$query = "SELECT `발급연도`,`발급월`,`법정동명`,`성별`,`연령대`,`회원수`,SUM(`이용금액`) AS 이용금액,SUM(`이용건수`) AS 이용건수 FROM `유성구_지역화폐발급데이터` GROUP BY `법정동명`,`연령대` HAVING `발급연도`=$find_year AND `발급월`=$find_month ";
	$query = "SELECT `발급연도`,`발급월`,`법정동명`,`성별`,`연령대`,`회원수`,SUM(`이용금액`) AS 이용금액,SUM(`이용건수`) AS 이용건수 FROM `유성구_지역화폐발급데이터` WHERE `발급연도`= $find_year AND `발급월`=$find_month GROUP BY `법정동명`,`성별`,`연령대` ";
	$result = mysqli_query($con, $query);

	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result))
		{
			$sub_data = array(
			"발급연도" => $row['발급연도'],
			"발급월"   => $row['발급월'],
			"법정동명" => $row['법정동명'],
			"성별" => $row['성별'],
			"연령대" => $row['연령대'],
			"회원수" => $row['회원수'],
			"이용금액" => $row['이용금액'],
			"이용건수" => $row['이용건수']
			);
			//response($data);
			//array_push($data,$sub_data);
			$data["resultdata"][] = $sub_data;
			
		}
		$data["resultdata"][] = $totalCount;
		mysqli_free_result($result);
		response($data);	
		mysqli_close($con);
	}else{
		response(NULL, NULL, 200,"No Record Found");
	}

} else if (isset($_GET['find_year']) && $_GET['find_year'] != "" ) {
    
	include('db.php');
	$query = '';
	$find_year = $_GET['find_year'];
	$query = "SELECT COUNT(*) FROM `유성구_지역화폐발급데이터` WHERE `발급연도`= $find_year ";
	$data = array();
	$i=0;
		
	$result2 = mysqli_query($con, $query);
	$row2= mysqli_fetch_array($result2);
	$totalCount = array("totalCount"=>$row2[0]);
	
	mysqli_free_result($result2);

	//$query = "SELECT * FROM `유성구_지역화폐발급데이터` WHERE `발급연도`= $find_year ";
	$query = "SELECT `발급연도`,`발급월`,`법정동명`,`성별`,`연령대`,`회원수`,SUM(`이용금액`) AS 이용금액,SUM(`이용건수`) AS 이용건수 FROM `유성구_지역화폐발급데이터` WHERE `발급연도`= $find_year GROUP BY `발급월`,`법정동명`,`성별`,`연령대` ";
	$result = mysqli_query($con, $query);

	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result))
		{
			$sub_data = array(
			"발급연도" => $row['발급연도'],
			"발급월"   => $row['발급월'],
			"법정동명" => $row['법정동명'],
			"성별" 	   => $row['성별'],
			"연령대"   => $row['연령대'],
			"회원수"   => $row['회원수'],
			"이용금액" => $row['이용금액'],
			"이용건수" => $row['이용건수']
			);
			//response($data);
			//array_push($data,$sub_data);
			$data["resultdata"][] = $sub_data;
			
		}
		$data["resultdata"][] = $totalCount;
		mysqli_free_result($result);
		response($data);	
		mysqli_close($con);
	}else{
		response(NULL, NULL, 200,"No Record Found");
	}

} else if ((isset($_GET['find_year']) && $_GET['find_year'] != "") && (isset($_GET['find_month']) && $_GET['find_month'] != "") && (isset($_GET['find_biz']) && $_GET['find_biz'] != "") ) {	
}else{
	response(NULL, NULL, 400,"Invalid Request");
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
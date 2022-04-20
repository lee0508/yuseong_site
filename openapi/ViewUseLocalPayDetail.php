<?php
header("Content-Type:application/json");
if ((isset($_GET['find_year']) && $_GET['find_year'] !="") && (isset($_GET['find_month']) && $_GET['find_month'] != "") && (isset($_GET['find_area']) && $_GET['find_area'] != "")) {	
	include('db.php');
	//$order_id = explode(",",$_GET['num']);
	$find_year = $_GET['find_year'];
	$find_month = $_GET['find_month'];
	$find_area = $_GET['find_area'];
	$query = '';
	$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `기준연도`= $find_year AND `기준월`=$find_month AND `법정동명`=$find_area ";

	$data = array();
	$i=0;
		
	$result2 = mysqli_query($con, $query);
	$row2= mysqli_fetch_array($result2);
	$totalCount = array("totalCount"=>$row2[0]);
	
	mysqli_free_result($result2);

	$query = "SELECT `기준연도`,`기준월`,`법정동코드`,`법정동명`,`표준산업대분류코드`,`표준산업대분류명`,`표준산업중분류코드`,`표준산업중분류명`,SUM(`이용금액`) AS 이용금액,SUM(`이용건수`) AS 이용건수 FROM `유성구_지역화폐이용데이터` WHERE `기준연도`= $find_year AND `기준월`=$find_month AND `법정동명`=$find_area GROUP BY `표준산업대분류명`  ";

	$result = mysqli_query($con, $query);

	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result))
		{
			$sub_data = array(
			"기준연도" => $row['기준연도'],
			"기준월"   => $row['기준월'],
			"법정동코드" => $row['법정동코드'],
			"법정동명" => $row['법정동명'],
			"표준산업대분류코드" => $row['표준산업대분류코드'],
			"표준산업대분류명" => $row['표준산업대분류명'],
			"표준산업중분류코드" => $row['표준산업중분류코드'],
			"표준산업중분류명" => $row['표준산업중분류명'],
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
	$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `기준연도`= $find_year AND `기준월`=$find_month ";
	$data = array();
	$i=0;
		
	$result2 = mysqli_query($con, $query);
	$row2= mysqli_fetch_array($result2);
	$totalCount = array("totalCount"=>$row2[0]);
	
	mysqli_free_result($result2);

	$query = "SELECT `기준연도`,`기준월`,`법정동코드`,`법정동명`,`표준산업대분류코드`,`표준산업대분류명`,`표준산업중분류코드`,`표준산업중분류명`,SUM(`이용금액`) AS 이용금액,SUM(`이용건수`) AS 이용건수 FROM `유성구_지역화폐이용데이터` GROUP BY `법정동명`,`표준산업대분류명` HAVING `기준연도`=$find_year AND `기준월`=$find_month ";
	$result = mysqli_query($con, $query);

	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result))
		{
			$sub_data = array(
			"기준연도" => $row['기준연도'],
			"기준월"   => $row['기준월'],
			"법정동코드" => $row['법정동코드'],
			"법정동명" => $row['법정동명'],
			"표준산업대분류코드" => $row['표준산업대분류코드'],
			"표준산업대분류명" => $row['표준산업대분류명'],
			"표준산업중분류코드" => $row['표준산업중분류코드'],
			"표준산업중분류명" => $row['표준산업중분류명'],
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
	$query = "SELECT COUNT(*) FROM `유성구_지역화폐이용데이터` WHERE `기준연도`= $find_year ";
	$data = array();
	$i=0;
		
	$result2 = mysqli_query($con, $query);
	$row2= mysqli_fetch_array($result2);
	$totalCount = array("totalCount"=>$row2[0]);
	
	mysqli_free_result($result2);

	$query = "SELECT * FROM `유성구_지역화폐이용데이터` WHERE `기준연도`= $find_year ";
	$result = mysqli_query($con, $query);

	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result))
		{
			$sub_data = array(
			"id"      => $row["id"],
			"기준연도" => $row['기준연도'],
			"기준월"   => $row['기준월'],
			"법정동코드" => $row['법정동코드'],
			"법정동명" => $row['법정동명'],
			"표준산업대분류코드" => $row['표준산업대분류코드'],
			"표준산업대분류명" => $row['표준산업대분류명'],
			"표준산업중분류코드" => $row['표준산업중분류코드'],
			"표준산업중분류명" => $row['표준산업중분류명'],
			"표준산업세세분류코드" => $row['표준산업세세분류코드'],
			"표준산업세세분류명" => $row['표준산업세세분류명'],
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
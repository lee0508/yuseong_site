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
//유성구 일평균 유동인구 현황
/* 
YS_YEAR		기준연도
YS_MONTH	기준월
DONG_CODE	법정동코드
DONG_NAME	법정동명
TIME_ZONE	시간대
FL_PO_AMT	평균유동인구
*/
if(isset($_GET['find_area']) && isset($_GET['find_time']) && isset($_GET['find_year']) && isset($_GET['find_month']) && isset($_GET['serviceKey']))
{
	include('db.php');
	$find_area = $_GET['find_area'];
	$find_time = $_GET['find_time'];
	$serviceKey = $_GET['serviceKey'];
	$find_year = $_GET['find_year'];
	$find_month = $_GET['find_month'];

	$query = '';

	$query = " SELECT COUNT(*) FROM `유성구_일평균_유동인구데이터` WHERE `기준연도`='{$find_year}' AND `기준월`='{$find_month}' AND `시간대` LIKE '%{$find_time}%' AND `법정동명` LIKE '%{$find_area}%' ";

	$data = array();
	$i=0;

	$pageNo = array("pageNo"=>1);
	$numOfRows=array("numOfRows"=>10);
	$result2 = mysqli_query($con, $query);
	$row2= mysqli_fetch_array($result2);

	$totalCount = array("totalCount"=>$row2[0]);
	$resultCode = array("resultCode"=>"00");
	$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
	mysqli_free_result($result2);

	$query='';

	$query = " SELECT * FROM `유성구_일평균_유동인구데이터` WHERE `기준연도`='{$find_year}' AND `기준월`='{$find_month}' AND ( `시간대` LIKE '%{$find_time}%' AND `법정동명` LIKE '%{$find_area}%') ";

	$result = mysqli_query($con, $query);

	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result))
		{
			$sub_data = array(
				"id"      => $row["id"],
				"YS_YEAR" => $row['기준연도'],
				"YS_MONTH"  => $row['기준월'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"TIME_ZONE" => $row['시간대'],
				"FL_PO_AMT" => $row['평균유동인구']
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
		//var_dump('----------->>>> '.$find_time);	
		mysqli_close($con);
	}else{
		response(NULL, NULL, 200,"No Record Found");
	}
} else if(isset($_GET['find_area']) && isset($_GET['find_time']) && isset($_GET['find_year']) && isset($_GET['serviceKey']))
{
	include('db.php');
	$find_area = $_GET['find_area'];
	$find_time = $_GET['find_time'];
	$serviceKey = $_GET['serviceKey'];
	$find_year = $_GET['find_year'];
	//$find_month = $_GET['find_month'];

	$query = '';

	$query = " SELECT COUNT(*) FROM `유성구_일평균_유동인구데이터` WHERE `기준연도`='{$find_year}' AND `시간대` LIKE '%{$find_time}%' AND `법정동명` LIKE '%{$find_area}%' ";

	$data = array();
	$i=0;

	$pageNo = array("pageNo"=>1);
	$numOfRows=array("numOfRows"=>10);
	$result2 = mysqli_query($con, $query);
	$row2= mysqli_fetch_array($result2);

	$totalCount = array("totalCount"=>$row2[0]);
	$resultCode = array("resultCode"=>"00");
	$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
	mysqli_free_result($result2);

	$query='';

	$query = " SELECT * FROM `유성구_일평균_유동인구데이터` WHERE `기준연도`='{$find_year}' AND ( `시간대` LIKE '%{$find_time}%' AND `법정동명` LIKE '%{$find_area}%') ";

	$result = mysqli_query($con, $query);

	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result))
		{
			$sub_data = array(
				"id"      => $row["id"],
				"YS_YEAR" => $row['기준연도'],
				"YS_MONTH"  => $row['기준월'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"TIME_ZONE" => $row['시간대'],
				"FL_PO_AMT" => $row['평균유동인구']
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
		//var_dump('----------->>>> '.$find_time);	
		mysqli_close($con);
	}else{
		response(NULL, NULL, 200,"No Record Found");
	}
} else 	if(isset($_GET['find_area']) && isset($_GET['find_time']) && isset($_GET['find_month']) && isset($_GET['serviceKey']))
{
	include('db.php');
	$find_area = $_GET['find_area'];
	$find_time = $_GET['find_time'];
	$serviceKey = $_GET['serviceKey'];
	//$find_year = $_GET['find_year'];
	$find_month = $_GET['find_month'];

	$query = '';

	$query = " SELECT COUNT(*) FROM `유성구_일평균_유동인구데이터` WHERE `기준월`='{$find_month}' AND `시간대` LIKE '%{$find_time}%' AND `법정동명` LIKE '%{$find_area}%' ";

	$data = array();
	$i=0;

	$pageNo = array("pageNo"=>1);
	$numOfRows=array("numOfRows"=>10);
	$result2 = mysqli_query($con, $query);
	$row2= mysqli_fetch_array($result2);

	$totalCount = array("totalCount"=>$row2[0]);
	$resultCode = array("resultCode"=>"00");
	$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
	mysqli_free_result($result2);

	$query='';

	$query = " SELECT * FROM `유성구_일평균_유동인구데이터` WHERE `기준월`='{$find_month}' AND  `시간대` LIKE '%{$find_time}%' AND `법정동명` LIKE '%{$find_area}%' ";

	$result = mysqli_query($con, $query);

	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result))
		{
			$sub_data = array(
				"id"      => $row["id"],
				"YS_YEAR" => $row['기준연도'],
				"YS_MONTH"  => $row['기준월'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"TIME_ZONE" => $row['시간대'],
				"FL_PO_AMT" => $row['평균유동인구']
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
		//var_dump('----------->>>> '.$find_time);	
		mysqli_close($con);
	}else{
		response(NULL, NULL, 200,"No Record Found");
	}	
} else if(isset($_GET['find_area']) && isset($_GET['find_time']) && isset($_GET['serviceKey']))
{
	include('db.php');
	$find_area = $_GET['find_area'];
	$find_time = $_GET['find_time'];
	$serviceKey = $_GET['serviceKey'];
	//$find_year = $_GET['find_year'];
	//$find_month = $_GET['find_month'];

	$query = '';

	$query = " SELECT COUNT(*) FROM `유성구_일평균_유동인구데이터` WHERE `시간대` LIKE '%{$find_time}%' AND `법정동명` LIKE '%{$find_area}%' ";

	$data = array();
	$i=0;

	$pageNo = array("pageNo"=>1);
	$numOfRows=array("numOfRows"=>10);
	$result2 = mysqli_query($con, $query);
	$row2= mysqli_fetch_array($result2);

	$totalCount = array("totalCount"=>$row2[0]);
	$resultCode = array("resultCode"=>"00");
	$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
	
	mysqli_free_result($result2);

	$query='';

	$query = " SELECT * FROM `유성구_일평균_유동인구데이터` WHERE  `시간대` LIKE '%{$find_time}%' AND `법정동명` LIKE '%{$find_area}%' ";

	$result = mysqli_query($con, $query);

	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result))
		{
			$sub_data = array(
				"id"      => $row["id"],
				"YS_YEAR" => $row['기준연도'],
				"YS_MONTH"  => $row['기준월'],
				"DONG_CODE" => $row['법정동코드'],
				"DONG_NAME" => $row['법정동명'],
				"TIME_ZONE" => $row['시간대'],
				"FL_PO_AMT" => $row['평균유동인구']
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
		//var_dump('----------->>>> '.$find_time);	
		mysqli_close($con);
	}else{
		response(NULL, NULL, 200,"No Record Found");
	}
} else if (isset($_GET['find_area']) && isset($_GET['serviceKey'])) {
	include('db.php');
	$find_area = $_GET['find_area'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] !="") && (isset($_GET['find_month']) && $_GET['find_month'] !="")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];
		//$find_area = $_GET['find_area'];
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_일평균_유동인구데이터` WHERE `기준연도`= '{$find_year}' AND `기준월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' ";
		$data = array();
		$i=0;

		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
		
		mysqli_free_result($result2);
	
		$query = "SELECT * FROM `유성구_일평균_유동인구데이터` WHERE `기준연도`= '{$find_year}' AND `기준월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' ";
	
		$result = mysqli_query($con, $query);
	
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"  => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"TIME_ZONE" => $row['시간대'],
					"FL_PO_AMT" => $row['평균유동인구']
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
	} else if (isset($_GET['find_year']) && $_GET['find_year'] !="") {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];
		//$find_area = $_GET['find_area'];
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_일평균_유동인구데이터` WHERE `기준연도`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' ";
		$data = array();
		$i=0;

		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
		
		mysqli_free_result($result2);
	
		$query = "SELECT * FROM `유성구_일평균_유동인구데이터` WHERE `기준연도`='{$find_year}' AND `법정동명` LIKE '%{$find_area}%' ";
	
		$result = mysqli_query($con, $query);
	
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"  => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"TIME_ZONE" => $row['시간대'],
					"FL_PO_AMT" => $row['평균유동인구']
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
	} else if (isset($_GET['find_month']) && $_GET['find_month'] !="") {
		$find_month = $_GET['find_month'];
		//$find_month = $_GET['find_month'];
		//$find_area = $_GET['find_area'];
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_일평균_유동인구데이터` WHERE `기준월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' ";
		$data = array();
		$i=0;

		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
		
		mysqli_free_result($result2);
	
		$query = "SELECT * FROM `유성구_일평균_유동인구데이터` WHERE `기준월`='{$find_month}' AND `법정동명` LIKE '%{$find_area}%' ";
	
		$result = mysqli_query($con, $query);
	
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"  => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"TIME_ZONE" => $row['시간대'],
					"FL_PO_AMT" => $row['평균유동인구']
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
		//$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];
		
		//response(NULL, NULL, 400,"Invalid Request");
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_일평균_유동인구데이터` WHERE `법정동명` LIKE '%{$find_area}%' ";
		$data = array();
		$i=0;

		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
		mysqli_free_result($result2);
	
		$query = "SELECT * FROM `유성구_일평균_유동인구데이터` WHERE `법정동명` LIKE '%{$find_area}%' ";
	
		$result = mysqli_query($con, $query);
	
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"  => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"TIME_ZONE" => $row['시간대'],
					"FL_PO_AMT" => $row['평균유동인구']
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
} else if((isset($_GET['find_time']) && isset($_GET['serviceKey']))) {

	include('db.php');
	//$find_area = $_GET['find_area'];
	$find_time = $_GET['find_time'];
	$serviceKey = $_GET['serviceKey'];

	if ((isset($_GET['find_year']) && $_GET['find_year'] !="") && (isset($_GET['find_month']) && $_GET['find_month'] !="")) {
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];
		//$find_area = $_GET['find_area'];
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_일평균_유동인구데이터` WHERE `기준연도`='{$find_year}' AND `기준월`='{$find_month}' AND `시간대` LIKE '{$find_time}' ";
		$data = array();
		$i=0;

		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
		
		mysqli_free_result($result2);

		$query='';
	
		$query = "SELECT * FROM `유성구_일평균_유동인구데이터` WHERE `기준연도`='{$find_year}' AND `기준월`='{$find_month}' AND `시간대` LIKE '%{$find_time}%' ";
	
		$result = mysqli_query($con, $query);
	
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"  => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"TIME_ZONE" => $row['시간대'],
					"FL_PO_AMT" => $row['평균유동인구']
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
	} else if (isset($_GET['find_year']) && $_GET['find_year'] !="") {
		$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];
		//$find_area = $_GET['find_area'];
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_일평균_유동인구데이터` WHERE `기준연도`= '{$find_year}' AND `시간대` LIKE '%{$find_time}%' ";
		$data = array();
		$i=0;

		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
		
		mysqli_free_result($result2);

		$query='';
	
		$query = "SELECT * FROM `유성구_일평균_유동인구데이터` WHERE `기준연도`= '{$find_year}' AND `시간대` LIKE '%{$find_time}%' ";
	
		$result = mysqli_query($con, $query);
	
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"  => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"TIME_ZONE" => $row['시간대'],
					"FL_PO_AMT" => $row['평균유동인구']
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
	} else if (isset($_GET['find_month']) && $_GET['find_month'] !="") {
		$find_month = $_GET['find_month'];
		//$find_month = $_GET['find_month'];
		//$find_area = $_GET['find_area'];
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_일평균_유동인구데이터` WHERE `기준월`='{$find_month}' AND `시간대` LIKE '%{$find_time}%' ";
		$data = array();
		$i=0;

		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
		
		mysqli_free_result($result2);
	
		$query = "SELECT * FROM `유성구_일평균_유동인구데이터` WHERE `기준월`='{$find_month}' AND `시간대` LIKE '{$find_time}' ";
	
		$result = mysqli_query($con, $query);
	
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"  => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"TIME_ZONE" => $row['시간대'],
					"FL_PO_AMT" => $row['평균유동인구']
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
		//$find_year = $_GET['find_year'];
		//$find_month = $_GET['find_month'];
		
		//response(NULL, NULL, 400,"Invalid Request");
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_일평균_유동인구데이터` WHERE `시간대` LIKE '%{$find_time}%' ";
		$data = array();
		$i=0;

		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$result2 = mysqli_query($con, $query);
		$row2= mysqli_fetch_array($result2);
		$totalCount = array("totalCount"=>$row2[0]);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
		mysqli_free_result($result2);
	
		$query = "SELECT * FROM `유성구_일평균_유동인구데이터` WHERE `시간대` LIKE '%{$find_time}%' ";
	
		$result = mysqli_query($con, $query);
	
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"  => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"TIME_ZONE" => $row['시간대'],
					"FL_PO_AMT" => $row['평균유동인구']
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
		
} else  {
	//

	if (isset($_GET['find_year']) && isset($_GET['find_month']) && isset($_GET['serviceKey'])) {
	
		include('db.php');
		$find_year = $_GET['find_year'];
		$find_month = $_GET['find_month'];
		$serviceKey = $_GET['serviceKey'];
		//$find_biz = $_GET['find_biz'];
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_일평균_유동인구데이터` WHERE `기준연도`='{$find_year}' AND `기준월`='{$find_month}' ";
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
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
		
		mysqli_free_result($result2);

		$query = "SELECT * FROM `유성구_일평균_유동인구데이터` WHERE `기준연도`='{$find_year}' AND `기준월`='{$find_month}' ";

		$result = mysqli_query($con, $query);

		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"  => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"TIME_ZONE" => $row['시간대'],
					"FL_PO_AMT" => $row['평균유동인구']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["pageNo"][] = $pageNo;
				//$data["numOfRows"][]= $numOfRows;
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;				
				
			}
			//array_push($data,$sub_data);
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
	} else if (isset($_GET['find_year']) && isset($_GET['serviceKey'])) {

		include('db.php');
		
		$find_year = $_GET['find_year'];
		$serviceKey = $_GET['serviceKey'];
		//$find_month = $_GET['find_month'];
		//$find_biz = $_GET['find_biz'];
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_일평균_유동인구데이터` WHERE `기준연도`='{$find_year}' ";
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
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");
		
		mysqli_free_result($result2);

		$query='';

		$query = "SELECT * FROM `유성구_일평균_유동인구데이터` WHERE `기준연도`='{$find_year}' ";

		$result = mysqli_query($con, $query);

		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"  => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"TIME_ZONE" => $row['시간대'],
					"FL_PO_AMT" => $row['평균유동인구']
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
	} else if (isset($_GET['find_month']) && isset($_GET['serviceKey'])) {
		include('db.php');
		$find_month = $_GET['find_month'];
		$serviceKey = $_GET['serviceKey'];
		//$find_month = $_GET['find_month'];
		//$find_biz = $_GET['find_biz'];
		$query = '';
		$query = "SELECT COUNT(*) FROM `유성구_일평균_유동인구데이터` WHERE `기준월`='{$find_month}' ";
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
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");		
		
		mysqli_free_result($result2);

		$query = "SELECT * FROM `유성구_일평균_유동인구데이터` WHERE `기준월`='{$find_month}' ";

		$result = mysqli_query($con, $query);

		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"  => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"TIME_ZONE" => $row['시간대'],
					"FL_PO_AMT" => $row['평균유동인구']
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
			
		$pageNo = array("pageNo"=>1);
		$numOfRows=array("numOfRows"=>10);
		$totalCount = array("totalCount"=>10);
		$resultCode = array("resultCode"=>"00");
		$resultMsg = array("resultMsg"=>"NORMAL_SERVICE");

		$query = "SELECT * FROM `유성구_일평균_유동인구데이터` LIMIT 10 ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array(
					"id"      => $row["id"],
					"YS_YEAR" => $row['기준연도'],
					"YS_MONTH"  => $row['기준월'],
					"DONG_CODE" => $row['법정동코드'],
					"DONG_NAME" => $row['법정동명'],
					"TIME_ZONE" => $row['시간대'],
					"FL_PO_AMT" => $row['평균유동인구']
				);
				//response($data);
				//array_push($data,$sub_data);
				//$data["resultdata"][] = $sub_data;
				$data["body"][] = $sub_data;
				
			}
			//array_push($data,$totalCount);
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
	echo $json_response;
}
?>
<?php
header("Content-Type:application/json");
if (isset($_GET['order_id']) && $_GET['order_id']!="") {
	include('db.php');
	$order_id = explode(",",$_GET['order_id']);
	$data = array();
	$i=0;
	if (count($order_id) > 1) 
	{
		
		$result = mysqli_query(
		$con,
		"SELECT * FROM `유성구_외국인소비데이터` WHERE fr_id BETWEEN $order_id[0] AND $order_id[1]");
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array();
				$sub_data[] = $row["fr_id"];
				$sub_data[] = $row['기준년월'];
				$sub_data[] = $row['광역시_상권'];
				$sub_data[] = $row['시군구_상권'];
				$sub_data[] = $row['법정동_상권'];
				$sub_data[] = $row['국적'];
				$sub_data[] = $row['이용건수'];
				$sub_data[] = $row['이용금액'];
				//response($data);
				$data[] = $sub_data;
				
			}
			response($data);	
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
		
	}else{
		$result = mysqli_query(
		$con,
		"SELECT * FROM `유성구_외국인소비데이터` WHERE fr_id=$order_id[0]");
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result))
			{
				$sub_data = array();
				$sub_data[] = $row['fr_id'];
				$sub_data[] = $row['기준년월'];
				$sub_data[] = $row['광역시_상권'];
				$sub_data[] = $row['시군구_상권'];
				$sub_data[] = $row['법정동_상권'];
				$sub_data[] = $row['국적'];
				$sub_data[] = $row['이용건수'];
				$sub_data[] = $row['이용금액'];
				//response($data);
				$data[] = $sub_data;
				
			}
			response($data);
			mysqli_close($con);
		}else{
			response(NULL, NULL, 200,"No Record Found");
		}
	}
	
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
	
	$json_response = json_encode($data,  JSON_UNESCAPED_UNICODE);
	echo $json_response;
}
?>
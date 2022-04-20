<?php
header("Content-Type:application/json");
if (isset($_GET['order_id']) && $_GET['order_id']!="") {
	include('db.php');
	$order_id = $_GET['order_id'];
        $res_query = "SELECT * FROM `유성구_외국인소비데이터` WHERE fr_id='".$order_id."'";
	$result = mysqli_query($con, $res_query);
	//$data1 = array();
	if(mysqli_num_rows($result)>0){
	// $row = mysqli_fetch_array($result);
	while($row = mysqli_fetch_array($result))
	{
		$data1[] = array(
			"기준년월"=>$row["기준년월"],
			"광역시_상권"=>$row["광역시_상권"],
			"시군구_상권"=>$row["시군구_상권"],
			"법정동_상권"=>$row["법정동_상권"],
			"국적"=>$row["국적"],
			"업종대분류"=>$row["업종대분류"],
			"업종중분류"=>$row["업종중분류"],
			"업종소분류"=>$row["업종소분류"],
			"휴일평일구분"=>$row["휴일평일구분"],
			"시간대"=>$row["시간대"],
			"이용건수"=>$row["이용건수"],
			"이용건수_위챗"=>$row["이용건수_위챗"],
			"이용건수_비위챗"=>$row["이용건수_비위챗"],
			"이용금액"=>$row["이용금액"],
			"이용금액_위챗"=>$row["이용금액_위챗"],
			"이용금액_비위챗"=>$row["이용금액_비위챗"]
		);
	}
	$response_code = $row['response_code'];
	$response_desc = $row['response_desc'];
	response($order_id, $data1, $response_code,$response_desc);
	mysqli_close($con);
	}else{
		response(NULL, NULL, 200,"No Record Found");
		}
}else{
	response(NULL, NULL, 400,"Invalid Request");
	}
//print_r($data1);

function response($order_id,$data1,$response_code,$response_desc){
	$response['fr_id'] = $order_id;
	$response['data1'] = $data1;
	$response['response_code'] = $response_code;
	$response['response_desc'] = $response_desc;
	
	$json_response = json_encode($response,  JSON_UNESCAPED_UNICODE);
	echo $json_response;
}
?>

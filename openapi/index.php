<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com
*/
?>
<html>
<head>
<title>Demo Create and Consume Simple REST API in PHP - AllPHPTricks.com</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div style="width:700px; margin:0 auto;">

<h3>Demo Create and Consume Simple REST API in PHP</h3>   
<form method="POST">
<label>Enter Order ID:</label><br />
<input type="text" name="order_id" placeholder="Enter Order ID" required/>
<br /><br />
<button type="submit" name="submit">Submit</button>
</form>    

<?php
if (isset($_POST['order_id']) && $_POST['order_id']!="") {
	$order_id = $_POST['order_id'];
	//$url = "http://localhost/rest/api/".$order_id;
	//$url = "http://localhost/openapi/api/".$order_id;
	$url = "http://192.168.0.201/market/openapi/api/".$order_id;
	
	$client = curl_init($url);
	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($client);
	
	$result = json_decode($response);
        echo "<pre>";
	print_r($result);
        echo "</pre>";
        echo "<br /><br />";

}
    ?>

<br />
<strong>유성구 RESTful API Example:</strong><br />
<br /><br />
<a href=""><strong>유성구 Open API</strong></a> <br /><br />
CODING BY BIGDIPPER.KR: <a href="http://www.bigdipper.kr/"><strong>BIGDIPPER.kr</strong></a>
</div>
<script>
  var result = "<?php echo $result; ?>";
  console.log("result :  "+result);
</script>
</body>
</html>

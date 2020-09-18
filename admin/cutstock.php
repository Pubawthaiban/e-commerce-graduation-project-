<?php session_start(); require_once('../connect.php');?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
		<?
						$sql = mysql_query("update  db_order set status = 'con' where order_id = '$_GET[id]'");
						if($sql){
							echo "<script>alert('ยืนยันเรียบร้อยแล้ว');history.back(0);</script>";	
						}
		?>
<body>
</body>
</html>
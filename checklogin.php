<?php session_start();
	require_once('header.php');
	if($_POST['action']==="login"){
		$sql = mysql_query("select * from member where username = '$_POST[ID]' and password = '$_POST[pass]'");
		$fac = mysql_fetch_array($sql);
		if($fac){
			$_SESSION['userid'] = $fac['mem_name'];
			$_SESSION['id'] = $fac['member_id'];
			echo '<script type="text/javascript">
						window.location="index.php";
					</script>';
		}else{
			echo 
			"<script>alert('กรุณาตรวจสอบ User และ Password ใหม่อีกครั้ง');window.location='index.php';</script>";		}
	}
		
?>
<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<title>Untitled Document</title>
<style type="text/css">
th {font-family: consolas;}
body{background-color:#1A1A1A; margin-top: 100px;margin-bottom:0px}
</style>

</head>

			<body>
            <?php require_once('../connect.php');?>
					<div class="container">
                    		<div class="well span5 offset3">
								<form action="index.php" method="post">
  										<table align="center">
                                       <h2 align="center">Admin</h2>
                                        <tr>
                                        	<th align="right">AdminID :</th>
                                            <td><input type="text" placeholder="AdminID" name="adminid" required>
                                        </td>
                                        </tr>
                                        <tr>
                                        	<th align="right">Password :</th>
                                            <td><input type="password" placeholder="Password" name="pass" required></td>
                                        </tr>
                                        <tr>
                   <th colspan="2"><input type="submit" value="เข้าสู่ระบบ" class="btn"><input type="hidden" name="login" value="login"></th>
                                         </tr>
                                        </table>
								</form>
                                <?php if($_POST['login'] == "login"){
										$sql = mysql_query("select * from admin where admin_user = '$_POST[adminid]' and admin_pass = '$_POST[pass]'");
										$fac = mysql_fetch_array($sql);
													if($fac){
															$_SESSION['adminid'] = $fac['admin_name'];
														echo '<script type="text/javascript">
																	window.location="wellcom.php";
																</script>';
													}else{
														echo'<div class="alert alert-error">
																  			กรุณาตรวจสอบดูอีกครั้ง
																</div>';
													}
												}
								
							?>
                                    
                            </div>
			</div>
							<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
                            <script src="js/bootstrap.min.js"></script>
</body>
</html>
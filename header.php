<!doctype html>
	<html>
			<head lang="th">
								<meta charset="utf-8">
								<link href="css/bootstrap.min.css" rel="stylesheet">
			<title><?php echo $header; ?></title>
</head>
<style>
	body {
		padding-top: 70px;
	}
	div.navbar-inner li:hover{
color:#555;background-color:#e5e5e5
}
</style>
			<body>
            <?php require_once('connect.php'); require('chektime.php');?>
						<div class="navbar navbar navbar-fixed-top">
  							<div class="navbar-inner" style="height:60px;padding-top:5px;padding-bottom:0px">
    								<a class="brand" href="#" style="position:relative;width:170px;padding-left:19px;padding-top:0px"><div><img src="img/logo.png" style="width:190px;height:60px;position:absolute;"></div></a>
    							<ul class="nav" style="padding-top:9px">
      								<li><a href="index.php">หน้าหลัก</a></li>
      								<li><a href="payment.php">แจ้งโอนเงิน</a></li>
    							</ul>
                                <?php if(empty($_SESSION['userid'])){?>
                                <ul class="nav pull-right" style="padding-top:9px">
                                	<li><a href="register.php">สมัครสมาชิก</a></li>
                                	<li><a href="#myModal" data-toggle="modal" >เข้าสู่ระบบ</a></li>
                                </ul>
                                <?php }else{ ?>
                                <ul class="nav pull-right" style="padding-top:9px">
                                	<li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>ยินดีต้อนรับคุณ : </strong></i>&nbsp; <?php echo $_SESSION['userid'];?>
                <b class="caret"></b>
                						<ul class="dropdown-menu">
                					<li>
                                      <a href="myaccount.php">บัญชีของฉัน</a>
                                    </li>
                                    <li>
                                    <a href="logout.php">ออกจากระบบ</a>
                                    </li>
                                    </ul>
                                <?php } ?>
  							</div>
						</div>
<!-----Model------>
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header" align="center">
    					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    				<h3 id="myModalLabel">สมาชิกเข้าสู่ระบบ </h3>
  				</div>
  				<div class="modal-body" style="height:200px"><div style="position:absolute" id="div1"><img src="img/logo.png"></div>
                        		<div id="div2" style="position:absolute;left:290px;top:60px">
                                		<form action="checklogin.php" method="post">
                                        	<table  align="right" border="0">
                                            	<tr>
                                                	<th><input type="text" name="ID" placeholder="USER-ID" required></th>
                                                </tr>
                                                <tr>
                                                    <th><input type="password" name="pass" placeholder="PASSWORD" required></th>
                                                 </tr>
                                             </table>
                        		</div>
  				</div>
  				<div class="modal-footer">
                <center>
    					<input type="submit" value="เข้าสู่ระบบ" class="btn btn-primary">
                        <input type="hidden" value="login" name="action">
                </center>
  				</div>
				</div>
										</form>
<!----Model login------->




								<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
								<script src="js/bootstrap.min.js"></script>
		</body>
</html>
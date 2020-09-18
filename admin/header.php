<!doctype html>
<html>
<head  lang="th">
<meta charset="utf-8">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<title><?php echo $header; ?></title>
</head>
<style type="text/css">
	body{background-color: #1A1A1A; margin-top: 100px}
</style>
<body>
 <?php require_once('../connect.php');require_once('../chektime.php');?>
		<div class="container">
        	<div class="navbar navbar-inverse">
                  <div class="navbar-inner">
                    <a class="brand" href="">ยินดีตอนรับ :<?php echo $_SESSION['adminid'];?> </a>
                    <ul class="nav">
                      <li><a href="wellcom.php">Home</a></li>
                      <li><a href="Stock.php">จัดการสต๊อกสินค้า</a></li>
                      <li><a href="order.php">Order สินค้า</a></li>
                      <li><a href="pay.php">รายการแจ้งโอนเงิน</a></li>
                      <li><ul class="nav">
                                	<li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>รายงาน</strong></i>
                <b class="caret"></b>
                						<ul class="dropdown-menu">
                					<li>
                                      <a href="report.php">สรุปยอดขายประจำวัน</a>
                                    </li>
                                    <li>
                                    <a href="reportM.php">สรุปยอดขายตามช่วงเวลาที่กำหนด</a>
                                    </li>
                                    <li>
                                    <a href="reportmonth.php">สรุปยอดขายประจำเดือน</a>
                                    </li>
                                    </ul>
                                    </ul>
                                    </li>	
                    </ul>
                    <ul class="nav pull-right">
                    	<li><a href="logout.php"><i class="icon-off icon-white"></i></a></li>
                    </ul>
                  </div>
</div>
        </div>
								<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
								<script src="../js/bootstrap.min.js"></script>
</body>
</html>

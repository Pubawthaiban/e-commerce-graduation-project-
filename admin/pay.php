<?php session_start(); require_once('header.php');?>
			<style>
			table th{
					background:-webkit-gradient(linear,left top,left bottom,from(#f9f9f9),to(#ececec));
					background:-moz-linear-gradient(top,#f9f9f9, #ececec);
				}
				table td{
					text-align:center;
					border-bottom:solid 1px #dfdfdf;	
				}
			</style>
			<div class="container">
                <div class="row-fluid">
                    <div class="well" style="margin-left:10px;margin-right:10px;">
                    <div align="center"><h3>รายการแจ้งโอนเงิน</h3></div>
                    <center>
                    <form action="pay.php" method="post">
                        <div class="input-prepend input-append">
                        <span class="add-on"><i class="icon-search"></i></span>
                            <input type="text" name="search" value="<?=$_POST['search'];?>"/>
                            <input class="btn" type="submit" value="ค้าหา">
                        </div>
                    </form>
                    </center>
                    	<table align="center" cellpadding="10" cellspacing="6" style="border:solid 1px #dfdfdf" width="600pxs">
                    		<tr>
                            	<th>เลขที่ใบสั่งชื้อ</th>
                    			<th>วันที่แจ้งโอน</th>
                                <th>เวลา</th>
                                <th>จำนวนเงิน</th>
                                <th>สลีปแจ้งโอน</th>
                                <th>จัดการ</th>
                            </tr>
                            <?php
								$sql = mysql_query("select * from paymemt where order_id like '%$_POST[search]%'");
								$num = mysql_num_rows($sql);
								if($num == 0){
							echo "<tr><th colspan='6'><font color='#FF0000'>ไม่มีข้อมูล</font></th></tr>";
								}
								while($lis = mysql_fetch_array($sql)){
							?>
                           	<tr>
                            	<td><?=$lis['order_id'];?></td>	
                            	<td><?=$lis['date'];?></td>
                                <td><?=$lis['time'];?></td>
                                <td><?=$lis['money'];?></td>
                                <td><a  target ="_blank" href="../img/pay/<?=$lis['img'];?>">รูปสลิป</a></td>
                                <? $sql1 = mysql_query("select * from db_order where order_id = '$lis[order_id]'");
									 $lis1 = mysql_fetch_array($sql1);
									 if($lis1['status'] == "con" or $lis1['status'] == "fa"){?>
                                <td><a href="#" class="btn btn-success disabled">ยืนยัน</a></td>
                                		<? }else{ ?>
                                <td><a href="cutstock.php?id=<?=$lis['order_id'];?>" class="btn btn-success">ยืนยัน</a></td>      
                                        <? } ?>
                          	</tr>
                            <? } ?>                   
                    	</table>
                    </div>
                 </div>
            </div>

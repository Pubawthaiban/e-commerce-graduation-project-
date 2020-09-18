<?php session_start(); require_once('header.php');?>
		<div class="container">
                <div class="row-fluid">
                    <div class="well" style="margin-left:10px;margin-right:10px;">
                    	<div align="center">
                        <form action="reportmonth.php" method="post">
                        <div class="input-prepend input-append">
                                <span class="add-on"><i class="icon-search"></i></span>
                        <select name="month" class="span5">
          				<? $Y = array("เลือกเดือน","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
						for($i=0;$i<=12;$i++){
                        ?>
          
                    <option value="<?=$i?>"><?=$Y[$i];?></option>
                        <? }?>
                        </select>
                <span class="add-on">-</i></span>
                        <select name="year" class="span5">
                        	<option value="">เลือกปี</option>
                        	<?
								$year = date("Y");
							for($i=$year;$i>=$year-3;$i--){?>
                            <option value="<?=$i?>"><?=$i;?></option>
                            <? } ?>
                        </select>
                        <input class="btn" type="submit" value="ค้าหา">
                        </div>
                        </form>
                        <? if($_POST['month'] == "" and $_POST['year'] == ""){
						echo '<div class="alert alert-error">
											กรอกข้อมูล !!!!!
 											</div>';exit();
					} ?>
                        <div align="center"><h4>รายงานสรุปยอดขายประจำเดือน</h4></div>
                        <div align="center">สรุปยอดขายประจำเดือน <?=$Y[$_POST['month']]?> ปี <?=$_POST['year']?></div>
               <table border="1" cellpadding="9" cellspacing="9">
                                    <tr>
                                        <th>รหัสสินค้า</th>
                                        <th>ชื่อสินค้า</th>
                                        <th>จำนวนสินค้า</th>
                                        <th>ราคาสินค้า</th>
                                        <th>จำนวนเงิน</th>
                                    </tr>
                                <?php
								$con = "con";
                    $sql1 = mysql_query("select *,sum(detailnum) as num from db_order,db_orderdetail,product where db_order.status = '$con' and db_order.order_id = db_orderdetail.order_id and product.product_id = db_orderdetail.product_id and month(order_date) = '$_POST[month]' and year(order_date) = '$_POST[year]' group by product_name")or die(mysql_error());
					$num = mysql_num_rows($sql1);
						if($num == 0){
							echo  "<tr><th colspan='5'><div class='alert alert-error'>ไม่พบข้อมูล !</div></th></tr>";exit();
						}
                                                while($lis1 = mysql_fetch_array($sql1)){
														if($lis1['discount'] == 0){
																$price = $lis1['num'] * $lis1['product_price'];
															}else{
																$sumpro = ($lis1['product_price']/100)*$lis1['discount'];
																$sum  = $lis1['product_price'] - $sumpro;
																$price = $lis1['num'] * $sum; 
															}
																$sumtotal = $sumtotal + $price;
                                ?>
                                    <tr>
                                        <td align="center"><?=$lis1['product_id'];?></td>
                                        <td align="center"><?=$lis1['product_name'];?></td>
                                        <td align="center"><?=$lis1['num'];?></td>
                                        <? if($lis1['discount'] == 0){ ?>
                                        <td align="center"><?=number_format($lis1['product_price'],2);?></td>
                                        <? }else{ ?>
                                                <td align="center"><?=number_format($sum,2);?></td>
                                        <? } ?>
                                        <td align="center"><?=number_format($price,2);?></td>
                                    </tr>
                                    <? $sum1 = $sum1 + $price ?>
                                <? } ?>
                                <tr>
                        	<th colspan="4" align="right">ยอดรวมทั้งหมด :</th>
                        	<th><?=number_format($sum1,2);?></th>
                        </tr>
  					</table>  
                    <div align="center" style="margin-top:9px"><a href="report_month.php?month=<?=$_POST['month'];?>&year=<?=$_POST['year'];?>" class="btn"><i class="icon-print"></i></a></div>
                        </div>
                    </div>
                 </div>
         </div>
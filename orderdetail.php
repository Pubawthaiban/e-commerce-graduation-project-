<?php
 require_once('connect.php');?>
 
 <!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<? $sql = mysql_query("select * from db_order,member where db_order.member_id = member.member_id and order_id = '$_GET[order]'")or die("Eroor");
							$lis = mysql_fetch_array($sql)
							?>
                            <div align="center"><h2>รายการสั่งชื้อ</h2></div>
                        	<table style="margin-top:8px;margin-bottom:9px" align="center">
                            	<tr>
                                	<th align="right">เลขที่ order :</th>
                        			<td><?=$lis['order_id'];?></td>
                        		</tr>
                                <tr>
                                	<th  align="right">ชื่อ :</th>
                        			<td><?=$lis['mem_name'];?></td>
                        		</tr>
                                <tr>
                                	<th  align="right">ที่อยู่ :</th>
                                    <td><?=$lis['mem_add'];?></td>
                        		</tr>
                                <tr>
                                	<th  align="right">เบอรืโทร :</th>
                                    <td><?=$lis['mem_tel'];?></td>
                                </tr>
                                <tr>
                                	<th  align="right">e-mail :</th>
                                    <td><?=$lis['mem_email'];?></td>
                                </tr>
                        	</table>
                            <hr>
                            <table align="center" border="1" style="border-collapse:collapse" cellpadding="6" cellspacing="6">
                            	<tr bgcolor="#999999">
                                	<th>รหัสสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>ราคาสินค้า</th>
                                    <th>จำนวน</th>
                                    <th>ราคารวม</th>
                                 </tr>
 								<?php $sql1 = mysql_query("select * from db_orderdetail,product 
		where db_orderdetail.product_id = product.product_id and order_id = '$_GET[order]'");
										while($lis1 = mysql_fetch_array($sql1)) {
											if($lis1['discount'] == 0){
												$total = $lis1['detailnum'] * $lis1['product_price'];
											}else{
												$sumpro = ($lis1['product_price']/100)*$lis1['discount'];
												$total = $lis1['product_price'] - $sumpro;
											}
												$sumtotal = $sumtotal + $total;
								?>
                                <tr>
                                	<td><?=$lis1['product_id'];?></td>
                                    <td><?=$lis1['product_name'];?></td>
                                    <? if($lis1['discount'] == 0){ ?>
                                    <td><?=$lis1['product_price'];?></td>
                                    <? }else{ ?>
                                    <td><?=$total;?></td>
                                    <? } ?>
                                    <td><?=$lis1['detailnum'];?></td>
                                    <td><?=number_format($total,2);?></td>
                                 </tr>  
                                    <? } ?> 
                                 <tr>
                              		<th colspan="3"></th>   
                                    <th>ค่าจัดส่ง :</th>   
                                    <th><?=$lis['delivery'];?></th>
                                 </tr>
                                 <tr>
                                 	<th  colspan="3"></th>
                                    <th>รวม :</th>
                                 	<th><?=number_format($lis['order_total'],2);?></th>
                                </tr>
                            </table>
                            <div align="center"><a href="reportorder.php?id=<?=$lis['order_id'];?>">พิมพ์</a></div>
                            <body>
</body>
</html>
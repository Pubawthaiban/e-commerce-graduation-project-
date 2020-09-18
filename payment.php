<? session_start(); require_once('header.php'); ?>
<style type="text/css">
div.olo{
		background:-webkit-gradient(linear,left top,left bottom,from(#f9f9f9),to(#ececec));
		border:solid 1px #dfdfdf;border-radius:3px;margin-bottom:3px;height:40px;
}
</style>
						<div class="container-fluid" style="margin-left:150px; margin-right:150px;">
                            	<div class="row-fluid">
   									<div class="well span2" style="padding:3px;margin-left:0px;background-color:#FFF">
                      <div class="olo" style="height:25px;text-align:center;padding-top:6px"><b>ประเภทสินค้า</b></div>
     					<ul class="nav nav-list">
        <? $sql =  mysql_query("select * from product_type")or die(mysql_error());
			 while($lis = mysql_fetch_array($sql)){?>
        <li><a href="index.php?type=<?=$lis['type_id'];?>" style="border:solid 1px #CCCCCC;margin-top:3px;border-radius:4px"><?=$lis['type_name'];?></a></li>
        <? } ?>
      </ul>
      
       <div class="olo" style="margin-top:9px;height:25px;text-align:center;padding-top:6px;margin-bottom:0px">สินค้าขายดี</div>
                                  	<? $top = mysql_query("select *,sum(detailnum) as num from db_order,db_orderdetail,product where db_order.order_id = db_orderdetail.order_id and product.product_id = db_orderdetail.product_id group by product_name order by num desc")or die(mysql_error());?>
                                    <table  width="142px" style="border:#dfdfdf 1px solid" id="top">
										<? while($lis2 = mysql_fetch_array($top)){?>
                                         <tr>
                                         	<th><a href="detailProduct.php?link=<?=$lis2['product_id'];?>"><img src="img/<?=$lis2['image'];?>"></a></th>
                                         </tr>
                                         <? } ?>
                                         </table>
    								</div>
                                    <!------------------------------------>
                                
                        <div class="hero-unit span10" style="margin-left:9px;" align="center">
                        				<h3>แจ้งโอนเงิน</h3>
                        	<form action="payment.php" method="post" enctype="multipart/form-data">
                        		<fieldset>
                                	<legend>กรอกข้อมูลการแจ้งโอนเงิน</legend>
                                    	<table>
                                        	<tr>
                                            	<td align="right">Order ID :</td>
                                                <td><input type="text" name="order" class="span8" /></td>
                                            </tr>
                                            <tr>
                                            	<td  align="right">วันที่ชำระเงิน :</td>
                                                <td><input type="date" name="date" class="span8" />
                                            </tr>
                                            <tr>
                                            	<td  align="right">เวลา :</td>
                                                <td><input type="time" name="time" class="span4"/>
                                            </tr>
                                            <tr>
                                            	<td align="right">สลิปการโอนเงิน :</td>
                                                <td><input type="file" name="slip" /></td>
                                            </tr>
                                            <tr>
                                            	<th colspan="2"><input type="submit" value="ยืนยัน" class="btn"/>
                                                						<input type="hidden" value="sub" name="mid" /></th>
                                            </tr>
                                        </table>
                                </fieldset>
                        	</form>
                            <?php
								if($_POST['mid'] === "sub"){
									if($_POST['order'] == ""){
										echo "<script>alert('กรุณากรอกข้อมูล');</script>";exit();
									}
									$sql = mysql_query("select * from db_order where order_id = '$_POST[order]'");
									$num =mysql_fetch_array($sql);
									if($num < 1){
									echo  "<div class='alert alert-error' style='width:300px'>เลขที่ Order ที่ระบบไม่มีในฐานข้อมูล</div>";exit();
									}
									if($num['status'] == "fa"){
										echo "<script>alert('order นี้ได้ถูกยกเลิกแล้ว');</script>";exit();	
									}
									if($num['status'] == "lo"){
										echo "<script>alert('order นี้แจ้งโอนมาแล้ว');</script>";exit();	
									}
									if($_POST['money'] < $num['order_total']){
										echo "<script>alert('จำนวนเงินที่แจ้งโอน น้อยกว่าจำนวนเงินที่ต้องจ่าย');</script>";exit();	
									}
										if($_FILES['slip']['name'] == null){
										echo "<script>alert('กรุณาแนบสลิปการโอนด่วย');</script>";exit();
									}else{
																	$name = $_FILES['slip']['name'];
																   	$name1 = explode('.',$name);
																  	$slip = $_POST['order'].'.'.$name1[1];
										}
								
									$sql1 = mysql_query("insert into paymemt(order_id,date,time,img,money)
									values('$_POST[order]','$_POST[date]','$_POST[time]','$slip','$_POST[money]')")or die(mysql_error());
									mysql_query("update db_order set status = 'lo' where order_id = '$_POST[order]'")or die(mysql_error());;
										if($sql1){
											move_uploaded_file($_FILES['slip']['tmp_name'],"img/pay/".$slip);
											echo "<script>alert('ยืนยันการโอนแล้ว');</script>";exit();	
										}else{
											echo "<script>alert('Nooooooooooooooooooo');</script>";exit();	
										}
								}
							?>
                        </div>
                        
                   	</div>
                    </div>
                   
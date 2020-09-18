<?PHP session_start(); require_once('header.php');?>
<style type="text/css">
div.olo{
		background:-webkit-gradient(linear,left top,left bottom,from(#f9f9f9),to(#ececec));
		border:solid 1px #dfdfdf;border-radius:3px;margin-bottom:3px;height:40px;
}
table td{
	word-wrap:break-word;	
}
table#top a:hover{
	display:block;
	border:dotted #0F9 1px;
}
</style>
							<div class="container-fluid" style="margin-left:150px; margin-right:150px;">
                            	<div class="row-fluid">
                                <!----------------------------------->
                    <div class="navbar" style="margin-bottom:3px">
                      <div class="navbar-inner">
                        <ul class="nav pull-right">
                          <form class="navbar-search form-search" action="index.php" method="post">
                          <div class="input-append">
           <input type="text" class="search-query" name="search" value="<?=$_GET['search']?>"><button type="submit" class="btn">ค้นหา</button>
                          </div>
                          </form>
                        </ul>
                      </div>
                    </div>
                    <!---------------------------------->
   									<div class="well span2" style="padding:3px;margin-left:0px;background-color:#FFF">
                      <div>
                      <div class="olo" style="height:25px;text-align:center;padding-top:6px"><b>ประเภทสินค้า</b></div>
     					<ul class="nav nav-list">
        <? $sql =  mysql_query("select * from product_type")or die(mysql_error());
			 while($lis = mysql_fetch_array($sql)){?>
        <li><a href="index.php?type=<?=$lis['type_id'];?>" style="border:solid 1px #CCCCCC;margin-top:3px;border-radius:4px"><?=$lis['type_name'];?></a></li>
									<? } ?>
                                  </ul></div>
                                  <!---------------------------------------------->
              <div class="olo" style="margin-top:9px;height:25px;text-align:center;padding-top:6px;margin-bottom:0px">สินค้าขายดี</div>
                                  	<? $top = mysql_query("select *,sum(detailnum) as num from db_order,db_orderdetail,product where db_order.order_id = db_orderdetail.order_id and product.product_id = db_orderdetail.product_id group by product_name order by num desc limit 0,5")or die(mysql_error());?>
										<table  width="142px" style="border:#dfdfdf 1px solid" id="top">
										<? while($lis2 = mysql_fetch_array($top)){?>
                                         <tr>
                                         	<th><a href="detailProduct.php?link=<?=$lis2['product_id'];?>"><img src="img/<?=$lis2['image'];?>"></a></th>
                                         </tr>
                                         <? } ?>
                                         </table>
                                    </div>
                                    <!------------------------------------------------------------------------------>
    								<div class="hero-unit span8" style="margin-left:9px;width:680px;padding-bottom:9px">
                                    	<?php $sql = mysql_query("select * from product where product_id = '$_GET[link]'");
												   $sho = mysql_fetch_array($sql);?>
                                             <div class="olo" align="center"><?=$sho['product_name'];?></div>
                                                         <div align="center">
                                                        	<table>
                                                            	<tr>
                                                  <th rowspan="3"><img src="img/<?=$sho['image'];?>" style="height:250px;width:200px;"></th>
                                                                   	<td valign="top"><table style="margin-left:20px;margin-top:50px">
                                                                    		<tr>
                                                                            <? if($sho['discount'] == 0){ ?>
                                                                            	<th align="right">ราคาสินค้า :</th>
                                                                                <td><?=number_format($sho['product_price'],2);?> บาท</td>
                                                                             </tr>
                                                                             <tr>
                                                                             	<th align="right">สินค้าลดราคา :</th>
                                                                                <td>0 %</td>
                                                                             </tr>
                                                                             <tr>
                                                                             	<th align="right">ราคาที่ต้องจ่าย :</th>
                                                                                <td><?=number_format($sho['product_price'],2);?> บาท</td>
                                                                             </tr>
                                                                            <? }else{ $sum = ($sho['product_price']/100) * $sho['discount'];
																							$price = $sho['product_price'] - $sum;?>
                                                                            	<th align="right">ราคาสินค้า :</th>
                                                                                <td><del><?=number_format($sho['product_price'],2);?></del> บาท</td>
                                                                                </tr>
                                                                             <tr>
                                                                             	<th align="right">สินค้าลดราคา :</th>
                                                                                <td><?=$sho['discount'];?> %</td>
                                                                             </tr>
                                                                             <tr>
                                                                             	<th align="right">ราคาที่ต้องจ่าย :</th>
                                                                                <td><?=number_format($price,2);?> บาท</td>
                                                                             </tr>
                                                                            <? } ?>
                                                                            </tr>
                                                                            <tr>
                                                                            	<th align="right">สต๊อกเหลือ :</th>
                                                                            <? if($sho['status'] == "lout" or $sho['status'] == "only"){?>
                                                                                <td><?=$sho['amount'];?>&nbsp;ชิ้น</td>
                                                                           <? }else{ ?>
																			   <td><font color="#FF0000">สินค้าไม่พร้อมจำหน่าย</font></td>
																			<? } ?>
                                                                            </tr>
                                                                            <tr>
                                                                            <? if($sho['status'] == "lout" or $sho['status'] = "only"){?>
                                                       <th colspan="2"><a href="cart.php?cartProduct=<?=$sho['product_id'];?>" class="btn">หยิบสินค้า</a></th>
                                                        <? }else{ ?>
                                                        <th colspan="2"><a href="#" class="btn" disabled>หยิบสินค้า</a></th>
                                                        <? } ?>
                                                                            </tr>
                                                                    		</table>
                                                                    </td>
                                                                </tr>
                                                                    </table>
                                                                    <table style="margin-top:30px">
                                                                    <tr>
                                                                    	<th>รายละเอียดสินค้า</th>
                                                                    </tr>
                                                                    <tr>
                                                                    	<th><?=$sho['product_detail'];?></th>
                                                                    </tr>
                                                                    </table>
                                                         </div>
    								</div>
                                    
                                    <!------------------------------>
                                 <div class="well span2" style="margin-left:9px;padding-left:2px;padding-top:3px;padding-right:2px;width:160px;background-color:#FFF">
                                    	<div style="border:solid px #000000; height:100px;margin-bottom:29px">
                                	<div class="olo" style="height:25px;text-align:center"><b>ช่วยเหลือ</b></div>
                                    	<ul class="nav nav-list">
                             <li><a href="help.php?register=1" style="border:solid 1px #CCCCCC;margin-top:3px;border-radius:4px">วิธีสมัครสมาชิก</a></li>
                         <li><a href="help.php?cart=2" style="border:solid 1px #CCCCCC;margin-top:3px;border-radius:4px">วิธีการสั่งชื้อสินค้า</a></li>
                         <li><a href="help.php?pay=3" style="border:solid 1px #CCCCCC;margin-top:3px;border-radius:4px">วิธีการชำระเงิน</a></li>   
                                    	</ul>
                                </div>
                                <!--------------------------------->
                                <? if(!empty($_SESSION['Product'])){?>
                               		<div class="olo" style="height:25px;text-align:center;padding-top:9px;margin-bottom:0px">ตะกร้าสินค้า</div>
                                   <table border="1" width="152px" style="margin-left:1px">
                                   <?
								$Total = 0;
								$SumTotal = 0;
									for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
									{
										if($_SESSION["Product"][$i] != "")
									{
							$ob = mysql_query("SELECT * FROM product WHERE product_id = '".$_SESSION["Product"][$i]."'")or die(mysql_error());
											$obj = mysql_fetch_array($ob);
											$amount = $_SESSION['Productnum'][$i];
											if($obj['discount'] == 0){
												$price = $obj['product_price'];
											$Total = $_SESSION['Productnum'][$i] * $price;
											}else{
												$sum = ($obj['product_price']/100)*$obj['discount'];
												$price = $obj['product_price'] - $sum;
											$Total = $amount * $price;
											}
											$SumTotal = $SumTotal + $Total;
								?>
                                   <tr>
                                   <td><img src="img/<?=$obj['image']?>"></td>
                                   <td><?=$obj['product_name'];?><br><?=$price;?>x<?=$amount?></td>
          	<td><a href="deletecart.php?del=<?=$i;?>"><i class="icon-trash" title="ลบสินค้าออก" style="width:18px;height:18px"></i></a></td>
                                   </tr>
                                   <?
								   		 } 
									}
                                    ?>
                                   <tr>
                                   <td colspan="3" align="center">ยอดรวม :
                                   <?=number_format($SumTotal,2);?> บาท
                                   </td>
                                    <?php if(!empty($_SESSION['id'])){ ?>
                                   <tr>
                               		<td colspan="3" align="center"><a href="show.php" class="btn">ชำระเงิน</a></td>
                                   </tr>
								   <? } ?>
                                    </table>
                                    </div>
  									</div>
                                    <? } ?>
  							</div>

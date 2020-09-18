<?php session_start();?><?php require_once('header.php');?>
<style type="text/css">
div.olo{
		background:-webkit-gradient(linear,left top,left bottom,from(#f9f9f9),to(#ececec));
		border:solid 1px #dfdfdf;border-radius:3px;margin-bottom:3px;height:40px;
}
table td{
	word-wrap:break-word;	
}
.ribbon{position:absolute;top:16px;right:-13px;}
.sale{position:absolute;top:20px;right:-3px;font:tahoma 16px;color:#FFF}
div#t:hover{
	display:block;
	border:solid #09C 1px;
}
table#top a:hover{
	display:block;
	border:dotted #0F9 1px;
}
</style>
							<div class="container-fluid" style="margin-left:150px; margin-right:150px;">
                            	<div class="row-fluid">
                    <!----------------------------------->
                    <div class="navbar" style="margin-bottom:3px;">
                      <div class="navbar-inner">
                      	<ul class="nav">
                      		<li><a style="width:630px;"><marquee direction="left">ยินดีต้อนรับสู่ร้านขายสินค้าออนไลน์</marquee></a></li>
                        </ul>
                        <ul class="nav pull-right">
                          <form class="navbar-search form-search">
                          <div class="input-append">
           <input type="text" class="search-query" name="search" value="<?=$_GET['search']?>"><button type="submit" class="btn">ค้นหา				</button>
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
    								<div class="hero-unit span8" style="margin-left:9px;width:680px;">
                                    <? $sqll =  mysql_query("select * from product_type where type_id = '$_GET[type]'")or die(mysql_error());
										 $lisl = mysql_fetch_array($sqll);?>
<div class="olo" style="padding-top:6px;padding-left:13px"><? if(empty($_GET['type']) and empty($_GET['search'])){echo "สินค้าทั้งหมด";}else if(isset($_GET['search'])){echo "ค้าหา ".$_GET['search'];}else{echo $lisl['type_name'];}?></div>
                        <?php $sql = mysql_query("select * from product where type_id like '%$_GET[type]%' and product_name like '%$_GET[search]%'");
								$num = mysql_num_rows($sql);
								if($num == 0){
									echo"<div align='center'>ไม่พบข้อมูล</div>";
								}
											  			while($sho = mysql_fetch_array($sql)){
															?>
                                                            <a href="detailProduct.php?link=<?=$sho['product_id'];?>">
  	<div class="well span3" style="padding-top:3px;padding-left:3px;padding-right:3px;padding-bottom:3px;margin-left:5px;margin-right:5px;position:relative;" id="t">
                                                            <img src="img/<?=$sho['image'];?>" style="width:150px; height:200px;">
                                                            </a>
                                                            <? if($sho['discount'] == 0){ ?>
                                       <div align="center" style="font-family:tahoma;font-size:16px;"><?=$sho['product_name'];?></span><br>
                                                            				<?=number_format($sho['product_price'],2);?>
                                                            </div>
                                                            <? }else{ 
															$sumpro = ($sho['product_price']/100)*$sho['discount'];
															$SumTotalpro = $sho['product_price'] - $sumpro;
															?>
                                                       <img src="img/test.png" class="ribbon">
                                                       <span class="sale"><?=$sho['discount'];?>%</span>
                                   <div align="center" style="font-family:tahoma;font-size:16px"><span><?=$sho['product_name'];?></span><br>
                                                            				<del><?=number_format($sho['product_price'],2);?></del>
                                                                      <font color="#FF0000"><?=number_format($SumTotalpro,2);?></font>
                                                            </div>
                                                            <? } ?>
                                                            </div>
                                                            <? }?>        
    								</div>
                                    <!-------------------------------------->
                                   
                                    
                                    <!------------------------------>
                                    
          <div class="well span2" style="margin-left:9px;padding-left:2px;padding-top:3px;padding-right:2px;width:160px;height:auto;background-color:#FFF">						<div>		
				 				<div style="border:solid px #000000; height:100px;margin-bottom:29px">
                                	<div class="olo" style="height:25px;text-align:center"><b>ช่วยเหลือ</b></div>
                                    	<ul class="nav nav-list">
                             <li><a href="help.php?register=1" style="border:solid 1px #CCCCCC;margin-top:3px;border-radius:4px">วิธีสมัครสมาชิก</a></li>
                         <li><a href="help.php?cart=2" style="border:solid 1px #CCCCCC;margin-top:3px;border-radius:4px">วิธีการสั่งชื้อสินค้า</a></li>
                         <li><a href="help.php?pay=3" style="border:solid 1px #CCCCCC;margin-top:3px;border-radius:4px">วิธีการชำระเงิน</a></li>
                                    	</ul>
                                </div>
                                
                                <!----------------------------------->
				 					<? if(!empty($_SESSION['Product'])){?>
                               		<div class="olo" style="height:25px;text-align:center;padding-top:6px;margin-bottom:0px"><b>ตะกร้าสินค้า</b></div>
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
											$Total = $amount * $price;
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
                                    <? } ?>
                                    </div>
  									</div>
  							</div>

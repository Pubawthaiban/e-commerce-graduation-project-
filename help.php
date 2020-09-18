<?PHP session_start(); require_once('header.php');?>
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
                          <form class="navbar-search form-search" action="index.php" method="get">
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
                                 <? if(isset($_GET['register'])){?>
    								<div class="hero-unit span8" style="margin-left:9px;width:680px;padding-bottom:9px">
                                    	<div class="olo" align="center">วิธีการสมัครสมาชิก</div>
                                        <div align="center">
                                        	<p> 1.คลิกที่ "สมัครสมาชิก" มุมบนขวามือตามรูป</p>
                                    			<img src="img/help/p1.png" width="500" height="380">
                                             <p style="margin-top:19px"> 2.กรอกข้อมูลของสมาชิกแล้ว กด "ยืนยัน" ตามรูป</p>
                                             	<img src="img/help/p2.png" width="500" height="380">
                                   				
                                    	</div>
                                    </div>
                                    <? }else if(isset($_GET['cart'])){ ?>
                                    <div class="hero-unit span8" style="margin-left:9px;width:680px;padding-bottom:9px">
                                    	<div class="olo" align="center">วิธีการสั่งชื้อสินค้า</div>
                                        <div align="center">
                                        	<p>1.เลือก สินค้าที่ต้องการแล้ว คลิ้ก "หยิบสินค้า" สินค้าจะถูกเพิ่มเข้าในตะกร้าสินค้า ในกรอบด้านขวามือ 		 เมื่อเลือกสินค้าได้ครบตามต้องการแล้ว คลิ้ก “ชำระเงิน” เพื่อดำเนินการต่อ</p>
                                            <img src="img/help/r1.png" width="500" height="380">
                                        	<p>2.เมื่อ คลิ้ก "ชำระเงิน" แล้วจะเข้าสู่หน้า “ชำระเงิน” ตรวจสอบชนิดและจำนวนของสินค้าอีกครั้ง หากถูกต้องแล้ว คลิ้กที่ “ยืนยันการสั่งชื้อ” เพื่อเข้าสู่ขั้นตอนการเลือกวิธีรับส่งสินค้า</p>
                                            <img src="img/help/r2.png" width="500" height="380">
                                            <p>3.เลือกวิธีการจัดส่งสินค้าตามที่ต้องการ</p>
                                            <img src="img/help/p3.png" width="500" height="380">
                                            <p>4.ตรวจสอบความถูกต้องของสินค้า แล้วกด "ยืนยันการสั่งชื้อ"</p>
                                            <img src="img/help/r3.png" width="500" height="380">
                                        </div>
                                    </div>
                                    
                                    <? }else if(isset($_GET['pay'])){ ?>
                                    <div class="hero-unit span8" style="margin-left:9px;width:680px;padding-bottom:9px">
                                    	<div class="olo" align="center">วิธีการชำระเงิน</div>
                                        <div align="center">
                                        <table>
                                        <tr>
                                        <td><img src="img/help/ktb.png" width="180" height="110"></td>
                                        <td>เลขที่บัญชี : xxx-x-xxxxx-x<br />	ชื่อบัญชี : ร้านสไมล์คอมพิวเตอร์</td>
                                        </tr>
                                        </table>
                                    	<p>1.เมื่อ คลิ้ก "ยืนยันการสั่งชื้อ" แล้วจดหมายเลขบัญชีนำไปโอนเงินที่ธนาคารหรือตู้ ATM หลังจากโอน เงินแล้ว ยืนยันการโอนผ่านทางหน้าเว็บ</p>
                                    	<img src="img/help/r4.png" width="500" height="380">
                                        <p>3.นำรหัส order นั้นมากรอกข้อมูลตามที่กำหนด แล้วแนบภาพสลิปการโอน หลังจากเช็คความถูกต้องแล้วกด "ยืนยัน" </p>
                                        <p>4.หลักจากแจ้งโอนมาแล้วทางร้านจะทำการตรวจสอบความถูกต้อง ให้ลูกค้าไปเช็คดูสถานะการโอน ทางร้านจะทำการจัดส่งสินค้าให้ภายใน 2-3 วัน</p>
                                    	</div>
                                    </div>
                                    <? } ?>
                                    <!-------------------------------------->
                                   
                                    
                                    <!------------------------------>
                                    
          <div class="well span2" style="margin-left:9px;padding-left:2px;padding-top:3px;padding-right:2px;width:160px;height:auto;background-color:#FFF" >											                                 
				 
				 				<div style="border:solid px #000000; height:100px;margin-bottom:29px">
                                	<div class="olo" style="height:25px;text-align:center"><b>ช่วยเหลือ</b></div>
                                    	<ul class="nav nav-list">
                           <li><a href="help.php?register=1" style="border:solid 1px #CCCCCC;margin-top:3px;border-radius:4px">วิธีสมัครสมาชิก</a></li>
                         <li><a href="help.php?cart=2" style="border:solid 1px #CCCCCC;margin-top:3px;border-radius:4px">วิธีการสั่งชื้อสินค้า</a></li>
                         <li><a href="help.php?pay=3" style="border:solid 1px #CCCCCC;margin-top:3px;border-radius:4px">วิธีการชำระเงิน</a></li>
                                    	</ul>
                                </div>
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
                                    <? } ?>
                                    </div>
  									</div>
                                    
                                    
  							</div>
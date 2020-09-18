<style type="text/css">
th{
	background:-webkit-gradient(linear,left top,left bottom,from(#f9f9f9),to(#ececec));
	background:-moz-linear-gradient(top,#f9f9f9, #ececec);
}
div.proimg{
	width:90px;height:120px;border:solid 1px #dfdfdf;
}
.ribbon{position:absolute;top:69px;right:43px;}
.sale{position:absolute;top:86px;right:62px;font:tahoma 16px;color:#FFF}
</style>
<div class="well" align="center">
			<?php
				if($_GET['del'] != ""){
					$se = mysql_query("select * from product where product_id = '$_GET[del]'");
					$delimg = mysql_fetch_array($se);
					unlink("../img/".$delimg['image']);
					$del = mysql_query("delete from product where product_id = '$_GET[del]'");
					if($del){
						echo  '<div class="alert alert-success">ลบเรียบร้อยแล้ว !</div>';				
					}else{
					echo  '<div class="alert alert-error">เกิดข้อผิดพลาด !</div>';	
				}
			};
			?>
            	<form action="Stock.php" method="post">
                	<div class="input-prepend input-append">
                    <span class="add-on"><i class="icon-search"></i></span>
                    	<input type="text" name="search" value="<?=$_POST['search'];?>"/>
                        <input class="btn" type="button" value="สินค้าที่หมด" onclick="window.location='?search=out'">
                        <input class="btn" type="button" value="สินค้าไกล้หมด" onclick="window.location='?search=lout'">
                        <input class="btn" type="submit" value="ค้าหา">
                   	</div>
                </form>
	<table style="width:610px;margin:5px;border:solid 1px #dfdfdf;margin-left:10px;margin-right:10px" cellpadding="10">
		<tr style="border:solid 1px #dfdfdf;">
            <th>รูปภาพ</th>
            <th>ชื่อสินค้า</th>
            <th>ราคา</th>
            <th>คงเหลือ</th>
            <th>สถานะ</th>
            <th>จัดการ</th>
		</tr>
        <?php $sql = mysql_query("select * from product where product_name like '%$_POST[search]%' and status like '$_GET[search]%' ");
					$num = mysql_num_rows($sql);
					if($num == 0){?>
			    <tr><th colspan="6"><font color="#FF0000">ไม่มีข้อมูลสินค้า</font></th></tr>
            <? }else{ 
					while($lis = mysql_fetch_array($sql)){
		?>
        <tr style="border-bottom:solid 1px #dfdfdf;border-top:solid 1px #666;">
        	<td>
            <center><div class="proimg" style="position:relative;"><img src="../img/<?=$lis['image'];?>" style="height:100%">
            	<? if($lis['discount'] != 0){ 
				$sumpro = ($lis['product_price']/100)*$lis['discount'];
				$SumTotalpro = $lis['product_price'] - $sumpro;
				?>
                <img src="../img/test1.png" class="ribbon">
                <span class="sale"><?=$lis['discount'];?>%</span>
                <? } ?>
                </div></center>
        	</td>
        	<td align="center"><?=$lis['product_name'];?></td>
            <? if($lis['discount'] == 0){ ?>
            <td align="center"><?=$lis['product_price'];?></td>
            <? }else {?>
            <td align="center"><del><?=$lis['product_price'];?></del><br><?=$SumTotalpro;?></td>
            <? } ?>
            
            <td align="center"><?=$lis['amount'];?>&nbsp;ชิ้น
            <? if($_GET['ad'] != "" and $lis['product_id'] == $_GET['ad']){?>
            	<br /><form action="Stock.php?" method="post">
                				<input type="text" name="num" class="span4" />
                                <input type="hidden" name="key" value="<?=$lis['product_id'];?>" />
                                <input type="hidden" name="add" value="add" />
                		</form>
            <? }?>
            </td>
            
            <?php if($lis['status']=='only'){?>
            <td align="center"><font color="#009900">มีสินค้า</font></td>
			<?php }elseif($lis['status']=='lout') { ?>
            <td align="center"><font color="#FF9933">สินค้าไกล้หมด</font></td>
            <?php }elseif($lis['status']=='out'){?>
            <td align="center"><font color="#FF0000">สินค้าหมด</font></td>
            <?php } ?>
            <td align="center" bgcolor="#f9f9f9"><a href="Stock.php?ad=<?=$lis['product_id'];?>" class="btn"title="เพิ่มจำนวนสินค้า"><i class="icon-plus"></i></a><br><a href="Stock.php?edit=product&pro=<?=$lis['product_id'];?>" class="btn"title="แก้ไขข้อมูล"><i class="icon-edit"></i></a><br><a href="Stock.php?del=<?=$lis['product_id'];?>" class="btn" onclick="return confirm('คุณต้องการลบข้อมูลใช่หรือไม่...?')" title="ลบข้อมูล"><i class="icon-trash"></i></a>
            </td>
        </tr>
        <?php } } ?>
    </table>
</div>
						<? if($_POST['add'] === "add" ){
							if($_POST['num'] == ""){
								echo "<script>window.location='Stock.php';</script>";
							}
							if(!is_numeric($_POST['num']) or $_POST['num'] == 0){
								echo "<script>alert('จำนวนสินค้าต้องเป็นตัวเลขเท่านั้น และต้องมากกว่า 0 !');history.back(0)</script>";	exit();				
							}
							
							$add = mysql_query("update product set amount = amount + '$_POST[num]' where product_id = '$_POST[key]'");
							
							if($add){
									echo "<script>alert('เพิ่มจำนวนสินค้าเรียบร้อย');window.location='Stock.php';</script>";
							}
						}
						?>
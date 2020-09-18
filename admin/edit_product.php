<?php session_start(); require_once('Stock.php');?>
<?php if(!empty($_GET['pro'])){
			$sql = mysql_query("select * from product where product_id='$_GET[pro]'");
			$lis = mysql_fetch_array($sql);
}?>
<div class="well"  align="center">
	<form action="Stock.php?edit=product&pro=<?=$lis['product_id'];?>" method="post" enctype="multipart/form-data">
    	<fieldset>
                <legend>แก้ไขข้อมูลสินค้า</legend>
                	<table border="0">
    					<tr>
                        	<th align="right">รหัสสินค้า :</th>
    						<td>&nbsp;<input type="text" class="span5" name="proid" class="span8" placeholder="<?=$lis['product_id'];?>" disabled></td>
                        </tr>
                        <tr>
                        	<th></th>
                            <td><? echo $echo;?></td>
                        </tr>
                        <tr>
                        	<th  align="right">ชื่อสินค้า :</th>
                            <td>&nbsp;<input type="text" name="proname" value="<?=$lis['product_name'];?>"></td>
                        </tr>
                        <tr>
                        	<th></th>
                            <td><? echo $echot;?></td>
                        </tr>
                        <tr>
                        	<th  align="right">ประเภทสินค้า :</th>
                            <td>&nbsp;<select name="typeid">
                            				  <option value="#">-------เลือกประเภทสินค้า-------</option>
                                              <?php $sql = mysql_query("select * from product_type");
											  			 while($selct = mysql_fetch_array($sql)){
															 	if($selct['type_id']==$lis['type_id']){ ?>
															 <option value="<?=$selct["type_id"]?>"selected><?=$selct["type_name"]?></option>
														<? }else {?>
                                                        	<option value="<?=$selct["type_id"]?>"><?=$selct["type_name"]?></option>
                                                        <?php }}?>
                                              </select>
                                              </td>
    					</tr>
                        <tr>
                        	<th></th>
                            <td><? echo $echop;?></td>
                        </tr>
                        <tr>
                        	<th align="right">ราคาสินค้า :</th>
                            <td>&nbsp;<input type="text" name="price" class="span6" value="<?=$lis['product_price'];?>"></td>
                        </tr>
                        <tr>
                        	<th></th>
                            <td><? echo $echopd;?></td>
                        </tr>
                        <tr>
                        	<th align="right">ส่วนลด :</th>
                            <td>&nbsp;<input type="text" name="discount" class="span3" value="<?=$lis['discount'];?>"/>&nbsp;%</td>
                        </tr>
                        <tr>
                        	<th></th>
                            <td><? echo $echoa;?></td>
                        </tr>
                        <tr>
                        	<th align="right">จำนวนสินค้า :</th>
                            <td>&nbsp;<input type="text" name="amount" class="span6"  value="<?=$lis['amount'];?>" disabled>
                        </td>
                        <tr>
                        	<th></th>
                            <td><? echo $echoT;?></td>
                        </tr>
                        <tr>
                        	<th align="right" valign="top">คำอธิบายสินค้า :</th>
                            <td>&nbsp;<textarea name="detail" rows="6" ><?=$lis['product_detail'];?></textarea></td>
                        </tr>
                        <tr>
                        	<th></th>
                            <td><? echo $echoM;?></td>
                        </tr>
                        <tr>
                        	<th align="right" valign="top">รูปสินค้า :</th>
                            <td> &nbsp;<img src="../img/<?=$lis['image'];?> " style="width:90px;height:120px;" /><br />
                            		&nbsp;<input type="file" name="image">
                            </td>
                        </tr>
                        <tr>
        	<th colspan="2"><input type="submit" value="แก้ไขข้อมูล" class="btn btn-success">
                            <input type="hidden" name="editpro" value="edit">
        					<input type="reset" value="ยกเลิก" class="btn btn-danger">			                        
                        </th>
                        </tr>
    				</table>
    	</fieldset>
    </form>
    	
        <?php
		if($_POST["editpro"] == "edit"){
			$update = mysql_query("update product set product_name = '$_POST[proname]',type_id = '$_POST[typeid]',product_price = '$_POST[price]',
										amount = '$_POST[amount]',product_detail = '$_POST[detail]' where product_id = '$_GET[pro]'");
										
				if($_FILES['image']['name'] != null){
					$delimg = mysql_query("select * from product where product_id = '$_GET[pro]'");
					$lisdel = mysql_fetch_array($delimg);
					unlink("../img/".$lisdel['image']);
					///////////////////////////////////
					$img = $_FILES['image']['name'];
					$img1 = explode('.',$img);
					$Nimg = $lisdel['product_id'].'.'.$img1[1];
					move_uploaded_file($_FILES['image']['tmp_name'],"../img/".$Nimg);
				}
				if($_POST['discount'] >= 0){
					$dis = mysql_query("update product set discount = '$_POST[discount]' where product_id = '$_GET[pro]'");
				}
				echo"<script>alert('บันทึกข้อมูลแล้ว');window.location='Stock.php';</script>";exit;
	}
		?>
</div>
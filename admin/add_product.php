<?php session_start(); require_once('Stock.php');
	$sql = mysql_query("select * from product");
	$num = mysql_num_rows($sql);
	$date = date("Y");
	if($num == 0){
		$Pname = "$date"."1";
	}else{
		$sql = mysql_query("select * from product order by product_id desc");
		$r = mysql_fetch_array($sql);
		$r1 = substr($r['product_id'],4);
		$r2 =$r1+1;
		$Pname = "$date".$r2;
	};//รหัสสินค้า;
	if($_POST['addpro']==="add"){
		if($_POST['proname'] == ""){
			$echo = '<font color="#F70307">กรุณาใส่ชื่อสินค้า !</font>';
			}
			if($_POST['typeid'] == "#"){
				$echot = '<font color="#F70307">กรุณาเลือกประเภทสินค้า !</font>';	
				}
					if(!is_numeric($_POST['price'])){
						$echop =  '<font color="#F70307">กรุณาใสราคาสินค้าให้ถูกต้อง !</font>';					
						}
					if(!is_numeric($_POST['amount'])){
						$echoa =  '<font color="#F70307">กรุณาใสจำนวนสินค้าให้ถูกต้อง !</font>';					
						}
						if($_POST['detail'] == null ){
							$echoT = '<font color="#F70307">กรุณากรอกข้อมูลให้ครบท้วน !</font>';		
						}			
							if($_FILES['image']['name'] == null){
								$echoM = '<font color="#F70307">กรุณาเลือกรูปภาพ !</font>';
								}else{
									$img = $_FILES['image']['name'];
									$img1 = explode('.',$img);
									$Nimg = $Pname.'.'.$img1[1];
								//เปลี่ยนชื่อรูปภาพ	
					$sql1 = mysql_query("insert into product(product_id,product_name,type_id,product_price,amount,product_detail,image,status)  	                    values('$Pname','$_POST[proname]','$_POST[typeid]','$_POST[price]','$_POST[amount]','$_POST[detail]','$Nimg','only')");	
								if($sql1){
									move_uploaded_file($_FILES['image']['tmp_name'],"../img/".$Nimg);
									echo"<script type='text/javascript'>alert('บันทึกข้อมูลแล้ว');window.location='Stock.php';</script>";
								}else{
								echo"<script type='text/javascript'>alert('เกิดข้อผิดพลาด');window.location='Stock.php?add=product';</script>";	
								}
						}
			}
	
	
?>
<div class="well"  align="center">
	<form action="Stock.php?add=product" method="post" enctype="multipart/form-data">
    	<fieldset>
                <legend>เพิ่มสินค้า</legend>
                	<table border="0">
    					<tr>
                        	<th align="right">รหัสสินค้า :</th>
    						<td>&nbsp;<input type="text" class="span5" name="proid" class="span8" placeholder="<?=$Pname;?>" disabled></td>
                        </tr>
                        <tr>
                        	<th></th>
                            <td><? echo $echo;?></td>
                        </tr>
                        <tr>
                        	<th  align="right">ชื่อสินค้า :</th>
                            <td>&nbsp;<input type="text" name="proname"></td>
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
											  			 while($selct = mysql_fetch_array($sql)){ ?>
															 <option value="<?=$selct["type_id"]?>"><?=$selct["type_name"]?></option>
														<? } ?>
                                              </select>
                                              </td>
    					</tr>
                        <tr>
                        	<th></th>
                            <td><? echo $echop;?></td>
                        </tr>
                        <tr>
                        	<th align="right">ราคาสินค้า :</th>
                            <td>&nbsp;<input type="text" name="price" class="span6"></td>
                        </tr>
                        <tr>
                        	<th></th>
                            <td><? echo $echoa;?></td>
                        </tr>
                        <tr>
                        	<th align="right">จำนวนสินค้า :</th>
                            <td>&nbsp;<input type="text" name="amount" class="span6">
                        </td>
                        <tr>
                        	<th></th>
                            <td><? echo $echoT;?></td>
                        </tr>
                        <tr>
                        	<th align="right" valign="top">คำอธิบายสินค้า :</th>
                            <td>&nbsp;<textarea name="detail" rows="6" ></textarea></td>
                        </tr>
                        <tr>
                        	<th></th>
                            <td><? echo $echoM;?></td>
                        </tr>
                        <tr>
                        	<th align="right">รูปสินค้า :</th>
                            <td>&nbsp;<input type="file" name="image"></td>
                        </tr>
                        <tr>
        					<th colspan="2"><input type="submit" value="บันทึกข้อมูล" class="btn btn-success" name="add">
                            <input type="hidden" name="addpro" value="add">
        					<input type="reset" value="ยกเลิก" class="btn btn-danger">			                        
                        </th>
                        </tr>
    				</table>
    	</fieldset>
    </form>
</div>
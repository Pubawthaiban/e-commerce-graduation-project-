<?php session_start(); require_once('Stock.php');  
		$sql = mysql_query("select * from product_type");
		$num = mysql_num_rows($sql);
			if($num == 0){
				$Tname = "3431";
			}else{$w = mysql_query("select * from product_type order by type_id desc");
					$m = mysql_fetch_array($w);
					$m1 = substr($m['type_id'], 3);
					$m2 = $m1 + 1;
					$Tname = "343".$m2;
			}	if(!empty($_POST['addtype'])){
					if($_POST['typename'] != null){
						$sql = mysql_query("insert into product_type values('$Tname','$_POST[typename]')");
						if($sql){
						  $echo = '<div class="alert alert-success">
										บันทึกข้อมูลเรียบร้อยแล้ว
										</div>';
									}
						}else{
						 	$echo =  '<div class="alert alert-error">
											กรอกข้อมูลให้ครบ !!!!!
 											</div>';
						}
						}
						if($_GET['typedel'] != ""){
							$typedel = mysql_query("select * from product where type_id='$_GET[typedel]'");
							$num = mysql_num_rows($typedel);
							if($num != 0){ ?>
									<div id="dialog" title="เตือน !" >
                                    ไม่สามารถ ลบได้ เนื่องจากมีสินค้า <br />
                                   <? while($lis = mysql_fetch_array($typedel)){ ?>
 										 <?=$lis['product_name'];?><br />
                                         <? } ?>
									</div>';
								<? 
							}else{
								$del = mysql_query("delete from product_type where type_id = '$_GET[typedel]'");
								if($del){
									echo "<script>alert('ลบข้อมูลเรียบร้อย');</script>";	
								}else{
									echo "<script>alert('เกิดข้อผิดพลาด!');</script>";	
								}
							}
						}
						if($_POST['type']){
							$ed = mysql_query("update product_type set type_name = '$_POST[typename]' where type_id = '$_POST[type]'");
						}
						if($ed){
							$echo = '<div class="alert alert-success">
										แก้ไขข้อมูลเรียบร้อยแล้ว
										</div>';
						}
						
?>
			<style>
			table#c th{
					background:-webkit-gradient(linear,left top,left bottom,from(#f9f9f9),to(#ececec));
					background:-moz-linear-gradient(top,#f9f9f9, #ececec);
				}
				table#c td{
					text-align:center;	
				}
			</style>
            
            <div class=" well" align="center">
            <form action="Stock.php?add=type" method="post">
            <fieldset>
                <legend>เพิ่มประเภทสินค้า</legend>
                <table border="0" align="center">
                    <tr>
                        <th style="font-size: 16px;">ชื่อประเภทสินค้า :</th>
                        <td>&nbsp;<input type="text" name="typename" placeholder="กรอกข้อมูลให้ถูกต้อง"<? if(isset($_GET['edit1'])){
										$sql = mysql_query("select * from product_type where type_id = '$_GET[edit1]'");
										$lis = mysql_fetch_array($sql);?>
                        														value="<?=$lis['type_name'];?>" <? } ?>
                        
                        ></td>
                    </tr>
                    <tr>
                        <th colspan="2" align="right">
                        <? if(empty($_GET['edit1'])){?>
                        <input type="submit" value="บันทึก" class="btn btn-success">
                        <input type="hidden" name="addtype" value="add">
         				<input type="reset" value="ยกเลิก" class="btn btn-info" />
                        <? }else{ ?>
                        <input type="submit" value="แก้ไขข้อมูล" class="btn btn-success">
                        <input type="hidden" name="type" value="<?=$lis['type_id'];?>">
         				<a href="Stock.php?add=type" class="btn btn-info">ยกเลิก</a>
                        <? } ?>
                         </th>
                    </tr>

                    <tr>
                    <th colspan="2"><?php echo $echo;?></th>
                    </tr>
                </table>
            </fieldset>
            </form>
            
            <table  width="80%" style="border:solid 1px #dfdfdf" id="c" cellpadding="6" cellspacing="6">
            	<tr bordercolor="#ccffcc">
                <th>ชื่อประเภทสินค้า</th>
                <th>จำนวนสินค้า</th>
                <th>จัดการ</th>
                </tr>
                <?php $sql = mysql_query("select * from product_type");  
						   while( $fac = mysql_fetch_array($sql)){
				?>
                <tr style="border-bottom:solid 1px #dfdfdf">
                <td><? echo $fac['type_name'];?></td>
                <td><?php $sqll = mysql_query("select count(type_id) as num from product where type_id='$fac[type_id]'");
							$sqlv = mysql_fetch_array($sqll);
							echo $sqlv['num'];
						?>
                </td>
                <td>
                
                <a href="Stock.php?edit1=<?=$fac['type_id'];?>" class="btn"> <i class="icon-edit" title="แก้ไขข้อมูล"></i></a>
                <a href="Stock.php?typedel=<?=$fac['type_id'];?>" class="btn" onclick="return confirm('คุณต้องการลบข้อมูลใช่หรือไม่...?')">
                												<i class="icon-trash" title="ลบข้อมูล"></i></a>
                                                                </td>
                </tr>
                <? } ?>
            </table>
            </div>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
            <script>
  $(function() {
    $( "#dialog" ).dialog();
  });
  </script>
</head>
<?php session_start(); require_once('header.php'); ?>
<div class="container">
		<div class="row-fluid">
        <div class="well" style="margin-left:10px;margin-right:10px;" align="center">
        <? $sql = mysql_query("select * from member where member_id = '$_GET[id]'");
			 $lis = mysql_fetch_array($sql);?>
        <form action="edit_mem.php?editid=<?=$lis['member_id'];?>" method="post">
                            <fieldset>
                            		<legend>แก้ไข User-ID ที่ใช้ในการเข้าสู่ระบบ</legend>
                                    	<table border="0">
                                        	<tr>
                                            	<th align="right">User-Id :</th>
                                                <td>&nbsp;<input type="text" name="userid" value="<?=$lis['username']?>" disabled></td>
                                            </tr>
                                            <tr>
                                            	<th align="right">Password :</th>
                                                <td>&nbsp;<input type="text" name="pass" value="<?=$lis['password']?>" required></td>
                                            </tr>
                                            <tr>
                                            	<th>ยืนยัน Password :</th>
                                                <td> &nbsp;<input type="text" name="tpass" value="<?=$lis['password']?>" required></td>
                                             </tr>
                                         </table>
                            </fieldset>
                            <fieldset>
                            		<legend>แก้ไขรายละเอียดของสมาชิก</legend>
                                    	<table border="0">
                                        	<tr>
                                            	<th align="right">ชื่อ :</th>
                                                <td>&nbsp;<input type="text" name="fname" value="<?=$lis['mem_name']?>"></td>
                                         	</tr>
                                            <tr>
                                            	<th align="right">นามสกุล :</th>
                                                <td>&nbsp;<input type="text" name="sname" value="<?=$lis['mem_las']?>"></td>
                                            </tr>
                                            <tr>
                                            	<th align="right" valign="top">ที่อยู่ :</th>
                                                <td align="right"><textarea cols="5" rows="6" name="add"><?=$lis['mem_add']?></textarea></td>
                                            </tr>
                                            <tr>
                                            	<th>เบอร์โทร :</th>
                                                <td>&nbsp;<input type="text" name="tel" maxlength="10" value="<?=$lis['mem_tel']?>"></td>
                                            </tr>
                                            <tr>
                                            	<th align="right">E-mail :</th>
                                                <td>&nbsp;<input type="text" name="email" value="<?=$lis['mem_email']?>"></td>
                                             </tr>
                                        </table>
                            </fieldset>
                            	<br>
                                <input type="hidden" name="action" value="editmember">
                            	<input type="submit" value="แก้ไข" class="btn btn-success">&nbsp;<input type="reset" value="ยกเลิก" class="btn btn-danger" onClick="history.back(0);">
                     	</form>
        
        		</div>
        </div>
</div>		 

					<? if($_POST['action'] === "editmember"){
					$edit = mysql_query("update member set password = '$_POST[pass]',mem_name = '$_POST[fname]',mem_las = '$_POST[sname]',mem_add = '$_POST[add]',mem_tel = '$_POST[tel]',mem_email = '$_POST[email]' where member_id = '$_GET[editid]'")or die(mysql_error());
					
					if($edit){
						echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');history.back(0);</script>";
					}else{
						echo "<script>alert('Error');</script>";
					}
				}
					?>
				
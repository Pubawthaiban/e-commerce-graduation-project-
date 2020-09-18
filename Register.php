<?php $header = สมัครสมาชิก ?>
<?php include_once('header.php'); ?>
			<div class="container">
            		<div class="well" align="center">
                    <center><h3>สมัครสมาชิก</h3></center>
                    <?php
								if(!empty($_POST['action'])){
									if($_POST['pass']==$_POST['tpass']){
									}else{
										echo '<div class="alert alert-error">
												Password ไม่เหมือนกัน
 												</div>';
									}
									if($_POST['action'] === 'addmember'){
										$sql = mysql_query("select * from member where username = '$_POST[userid]'");
										$num = mysql_fetch_array($sql);
										if($num > 0){
											echo '<div class="alert alert-error">
													<button type="button" class="close" data-dismiss="alert">×</button>
														User ID นี้มีผู้อื่นใช่แล้ว....
 													</div>';
										}
												if($_POST['pass']==$_POST['tpass'] and $num == 0){
												$sqll = mysql_query("insert into member values ('','$_POST[userid]','$_POST[pass]','$_POST[fname]'
												,'$_POST[sname]','$_POST[add]','$_POST[tel]','$_POST[email]')")or die("ERORRRRRR");
												}
												if($sqll){
														echo '<div class="alert alert-success">
																<button type="button" class="close" data-dismiss="alert">×</button>
																บันทึกข้อมูลเรียบร้อยแล้ว
																</div>';
										}else{
												echo '<div class="alert alert-error">
													<button type="button" class="close" data-dismiss="alert">×</button>
														เกิดข้อผิดพลาด.....
 													</div>';
										}
												}
										}
									
								
								
					?>
                   		<form action="register.php" method="post">
                            <fieldset>
                            		<legend>User-ID ที่ใช้ในการเข้าสู่ระบบ</legend>
                                    	<table border="0">
                                        	<tr>
                                            	<th align="right">User-Id :</th>
                                                <td>&nbsp;<input type="text" name="userid" required></td>
                                            </tr>
                                            <tr>
                                            	<th align="right">Password :</th>
                                                <td>&nbsp;<input type="password" name="pass" required></td>
                                            </tr>
                                            <tr>
                                            	<th>ยืนยัน Password :</th>
                                                <td> &nbsp;<input type="password" name="tpass" required></td>
                                             </tr>
                                         </table>
                            </fieldset>
                            <fieldset>
                            		<legend>รายละเอียดของสมาชิก</legend>
                                    	<table border="0">
                                        	<tr>
                                            	<th align="right">ชื่อ :</th>
                                                <td>&nbsp;<input type="text" name="fname"></td>
                                         	</tr>
                                            <tr>
                                            	<th align="right">นามสกุล :</th>
                                                <td>&nbsp;<input type="text" name="sname"></td>
                                            </tr>
                                            <tr>
                                            	<th align="right" valign="top">ที่อยู่ :</th>
                                                <td align="right"><textarea cols="5" rows="6" name="add"></textarea></td>
                                            </tr>
                                            <tr>
                                            	<th>เบอร์โทร :</th>
                                                <td>&nbsp;<input type="text" name="tel" maxlength="10"></td>
                                            </tr>
                                            <tr>
                                            	<th align="right">E-mail :</th>
                                                <td>&nbsp;<input type="text" name="email"></td>
                                             </tr>
                                        </table>
                            </fieldset>
                            	<br>
                                <input type="hidden" name="action" value="addmember">
                            	<input type="submit" value="ยืนยัน" class="btn btn-success">&nbsp;<input type="reset" value="ยกเลิก" class="btn btn-danger">
                     	</form>
					</div>
            </div>
         
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body> 
                             <div align="center">
                                <form action="myaccount.php" method="post">
                                                            <fieldset>
                                                                    <legend>เปลี่ยนรหัสผ่าน</legend>
                                                                        <table>
                                                                            <tr>
                                                                                <th align="right">รหัสเดิม :</th>
                                                                                <td><input type="password" name="pass"></td>
                                                                            </tr>
                                                                            <tr>
                                                                            	<th align="right">รหัสผ่านใหม่ :</th>
                                                                                <td><input type="password" name="pass1"></td>
                                                                            </tr>
                                                                            <tr>
                                                                            	<th align="right">ยืนยันรหัสผ่านใหม่ :</th>
                                                                                <td><input type="password" name="pass2"></td>
                                                                            </tr>
                                                                            <tr>
                              	<th colspan="2"><input type="submit" value="ยืนยัน"><input type="hidden" name="editpass" value="pass"></th>
                                                                            </tr>
                                                                        </table>
                                                                    
                                                           </fieldset>
                                </form>
                                </div>
                                
                               <? if($_POST['editpass'] === "pass"){
							$sql = mysql_query("select * from member where password = '$_POST[pass]' and member_id = '$_SESSION[id]'");
							$fac = mysql_fetch_array($sql);
									if(!$fac){
										echo "<script>alert('รหัสผ่าเดิมไม่ถูกต้อง !');</script>";exit();
									}
									if($_POST['pass1'] != $_POST['pass2']){
										echo "<script>alert('รหัสผ่านใหม่ไม่ตรงกัน !');</script>";exit();
									}
									$edit = mysql_query("update member set password = '$_POST[pass1]' where member_id = '$_SESSION[id]'");
									if($edit){
										echo "<script>alert('เปลี่ยนแปลงข้อมูลเรียบร้อยแล้ว !');</script>";exit();
									}
							   }
							   ?>
							   </body>
</html>
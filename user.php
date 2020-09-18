
<?php $sql = mysql_query("select * from member where member_id = '$_SESSION[id]'");
								   $lis = mysql_fetch_array($sql);?>
  <div id="table1" align="center">
  <fieldset>
    <table border="0" align="center" cellpadding="3" cellspacing="3">
      <tr><th align="right">ชื่อ :</th><td><?=$lis['mem_name'];?></td><th align="right">นามสกุล :</th><td><?=$lis['mem_las'];?></td></tr>
      <tr><th align="right">ที่อยู่ :</th><td><?=$lis['mem_add'];?></td></tr>
      <tr><th align="right">เบอร์โทร :</th><td><?=$lis['mem_tel'];?></td><th align="right">e-mail :</th><td><?=$lis['mem_email'];?></td></tr>
      <tr><th colspan="4"><input type="button" value="แก้ไขข้อมูล" class="btn" id="edit"></th></tr>
    </table>
       </fieldset>
    </div>
    <!---------------------------------------->
    <div id="table2">
    <form action="myaccount.php" method="post">
     <table border="0" align="center" cellpadding="3" cellspacing="3" >
      <tr><th align="right">ชื่อ :</th><td><input type="text" name="name" value="<?=$lis['mem_name'];?>"></td>
      		<th align="right">นามสกุล :</th><td><input type="text" name="las" value="<?=$lis['mem_las'];?>"></td></tr>
      <tr><th align="right">ที่อยู่ :</th><td><textarea name="add"><?=$lis['mem_add'];?></textarea></td></tr>
      <tr><th align="right">เบอร์โทร :</th><td><input type="text" name="tel" value="<?=$lis['mem_tel'];?>"</td>
      		<th align="right">e-mail :</th><td><input type="text" name="email" value="<?=$lis['mem_email'];?>"></td></tr>
      <tr><th colspan="4"><input type="submit" value="แก้ไขข้อมูล" class="btn">
      								<input type="hidden" value="edit" name="edit">
      								<input type="button" value="ยกเลิก" id="can" class="btn"></th></tr>
    </table>
    </form>
    </div>
    			 <?	if($_POST['edit'] == "edit"){
			$update = mysql_query("update member set mem_name = '$_POST[name]',mem_las = '$_POST[las]',mem_add = '$_POST[add]',
											mem_tel = '$_POST[tel]',mem_email = '$_POST[email]' where member_id = '$_SESSION[id]'");
	}
	if($update){
		echo "<script>window:location='myaccount.php';</script>";
	}
	
	?>
    <script type="text/javascript">
		$(document).ready(function() {
            $("#table2").hide();
			$("#edit").click(function(){
				$("#table1").hide("fast");
				$("#table2").show("fast");
			});
			$("#can").click(function(){
				$("#table1").show("fast");
				$("#table2").hide("fast");
			});
        });
	</script>
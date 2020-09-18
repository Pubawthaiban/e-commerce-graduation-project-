<?php session_start(); $header = "จัดการ Order"; require_once('header.php');?>
<style type="text/css">
th{
	background:-webkit-gradient(linear,left top,left bottom,from(#f9f9f9),to(#ececec));
}
td{
  border-bottom:solid 1px #dfdfdf;	
  border-top:solid 1px #dfdfdf;
  text-align:center
}
</style>
		<div class="container">
        	<div class="row-fluid">
            	<div class="well" style="margin-left:10px;margin-right:10px;">
                <div align="center">
                    <form action="order.php" method="post">
                        <div class="input-prepend input-append">
                        <span class="add-on"><i class="icon-search"></i></span>
                            <input type="text" name="search" value="<?=$_POST['search'];?>"/>
                            <input type="button" value="ยกเลิก" onclick="window.location='?status=fa'" class="btn"/>
                            <input type="button" value="ยังไม่แจ้งโอน" onclick="window.location='?status=wait'" class="btn"/>
                            <input type="button" value="ยืนยันแล้ว" onclick="window.location='?status=con'" class="btn"/>
                            <input class="btn" type="submit" value="ค้าหา">
                        </div>
                    </form>
                    </div>
                	<table align="center" cellpadding="10" cellspacing="10" style="border:solid 1px #dfdfdf" width="600px">
        				<tr>
                        	<th>เลขที่ใบสั่งชื้อ</th>
                            <th>เจ้าของ order</th>
                            <th>ยอดรวม</th>
                            <th>วันที่สั่งชื้อ</th>
                            <th>สถานะ</th>
                        </tr>
                        <?php
			$sql = mysql_query("select * from db_order,member where db_order.member_id = member.member_id and status like '%$_GET[status]%'
									and order_id like '%$_POST[search]%' order by order_id desc")or die(mysql_error());
									$num = mysql_num_rows($sql);
						if($num == 0){
							echo "<tr><th colspan='6'><font color='#FF0000'>ไม่มีข้อมูล</font></th></tr>";
						}else{
							while($lis = mysql_fetch_array($sql)){
						?>
                        <tr>
                        	<td><a href="#" onClick="js_popup('orderdetal.php?order=<?=$lis['order_id'];?>',783,600); return false;"><?=$lis['order_id'];?></a></td>
                        	<td><?=$lis['mem_name'];?></td>
                            <td><?=number_format($lis['order_total'],2);?></td>
                        	<td><?=$lis['order_date'];?></td>
                            <? if($lis['status']=='wait'){?>
                        	<td align="center"><font color="#FF9900">รอแจ้งโอน</font></td>
                            <? }else if($lis['status']=='lo'){?>
                            <td align="center"><font color="#FFFF33">แจ้งโอนมาแล้ว</font></td>
                            <? }else if($lis['status']=='con'){ ?>
                            <td align="center"><font color="#00FF00">ยืนยันการโอนเรียบร้อย</font></td>
                            <? }else if($lis['status']=='fa'){ ?>
                            <td align="center"><font color="#FF0000">ยกเลิก</font></td>
                            <? } ?>
                         </tr>
                        <? } 
						}?>
        			</table>
        		</div>
        	</div>
        </div>
        <script language="javascript">
function js_popup(theURL,width,height) { //v2.0
	leftpos = (screen.availWidth - width) / 2;
    	toppos = (screen.availHeight - height) / 2;
  	window.open(theURL, "viewdetails","width=" + width + ",height=" + height + ",left=" + leftpos + ",top=" + toppos);
}
</script>
        
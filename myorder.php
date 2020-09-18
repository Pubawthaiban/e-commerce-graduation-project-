	<style type="text/css">
    table#order th{
	background:-webkit-gradient(linear,left top,left bottom,from(#f9f9f9),to(#ececec));
	background:-moz-linear-gradient(top,#f9f9f9, #ececec);
}
	table#order td{
		border-top:#dfdfdf 1px solid;
	}
     </style>
     <script language="javascript">
function js_popup(theURL,width,height) { //v2.0
	leftpos = (screen.availWidth - width) / 2;
    	toppos = (screen.availHeight - height) / 2;
  	window.open(theURL, "viewdetails","width=" + width + ",height=" + height + ",left=" + leftpos + ",top=" + toppos);
}
</script>
            <table align="center" cellpadding="9" cellspacing="9" id="order" style="border:#dfdfdf 1px solid;">
            	<tr>
                	<th>เลขที่ใบสั่งชื้อ</th>
                    <th>วันที่สั่งสินค้า</th>
            		<th>ราคารวม</th>
                    <th>สถานะ</th>
                    <th>จัดการ</th>
                </tr>
                    <?php $sql = mysql_query("select * from db_order where member_id = '$_SESSION[id]'");  
							$num = mysql_num_rows($sql);
							if($num == 0){
								echo"<tr><th colspan='5'><div align='center'>ไม่มีข้อมูลการสั่งชื้อ</div></th></tr>";
							}
								while($lis = mysql_fetch_array($sql)){?>
                 <tr>
                 <td align="center"><a href="#" onClick="js_popup('orderdetail.php?order=<?=$lis['order_id'];?>',900,600); return false;"><?=$lis['order_id'];?></a></td>
                    <td><?=$lis['order_date'];?></td> 
                    <td><?=number_format($lis['order_total'],2);?></td> 
                    <? if($lis['status'] == 'wait'){?>
                    <td><font color="#FF0000">ยังไม่แจ้งโอนเงิน</font></td>      
                    <? }else if($lis['status'] == 'lo'){?>
                    <td><font color="#FF0000">รอการตรวจสอบ</font></td>
                    <? }else if($lis['status'] == 'con'){?>
                    <td><font color="#FF0000">ยืนยันการโอนแล้ว</font></td>
                    <? }else if($lis['status'] == 'fa'){ ?>
                    <td><font color="#FF0000">ยกเลิกรายการ</font></td>
                    <? } ?>
             		<? if($lis['status'] == "fa" or $lis['status'] == "con"){?>
                    <td><a href="#"class="btn disabled">ยกเลิก</a></td>
                    <? }else{ ?>
                    <td><a href="myaccount.php?mem=<?=$lis['order_id'];?>"class="btn">ยกเลิก</a></td>
                    <? } ?>
                 </tr>  
                                <? } ?>
            </table>
            <?
				if($_GET['mem'] != ""){
					$sqlll = mysql_query("select * from db_order,db_orderdetail 
							where db_order.order_id = db_orderdetail.order_id and db_order.order_id = '$_GET[mem]'")or die(mysql_error());
							while($lis1 = mysql_fetch_array($sqlll)){
								mysql_query("update product set amount = amount + '$lis1[detailnum]' where product_id = '$lis1[product_id]'")or die(mysql_error());
							}
						$sqll = mysql_query("update db_order set status = 'fa' where order_id = '$_GET[mem]'");	
					if($sqll){
						echo "<script>alert('ยกเลิกแล้ว');window.location='myaccount.php';</script>";	
					}
				}
			?>
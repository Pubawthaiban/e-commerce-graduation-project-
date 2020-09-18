			<? $sql = mysql_query("select * from product");
				$sql1 = mysql_query("select * from product where amount <= 5");
				$sql2 = mysql_query("select * from db_order where status = 'lo'");
				$sql3 = mysql_query("select * from db_order where status = 'wait'");
				$sql4 = mysql_query("select * from db_order where status = 'fa'");
				$sql6 = mysql_query("select * from db_order where status = 'con'");
				$sql5 = mysql_query("select * from product where amount = 0");
				$num6 = mysql_num_rows($sql6);
				$num5 = mysql_num_rows($sql5);
				$num4 = mysql_num_rows($sql4);
				$num3 = mysql_num_rows($sql3);
				$num2 = mysql_num_rows($sql2);
				$num1 = mysql_num_rows($sql1);
				$num = mysql_num_rows($sql);
			?>
            <center>
            <table cellpadding="9" cellspacing="9">
            <tr>
			<td>สินค้าทั้งหมด :<span class="badge badge-info"><?=$num?> อย่าง</span></td>
            <td>สินค้าไกล้หมด :<span class="badge badge-warning"><?=$num1?> อย่าง</span></td>
            <td>สินค้าหมดไปแล้ว :<span class="badge badge-important"><?=$num5?> อย่าง</span></td>
            </tr>
            <tr>
            <td colspan="3">รายการ Order ที่แจ้งโอนเข้ามา :<span class="badge badge-success"><?=$num2?> Order</span></td>
            </tr>
            <tr>
            <td colspan="3">รายการ Order ที่ยังไม่แจ้งโอนเข้ามา :<span class="badge badge-success"><?=$num3?> Order</span></td>
             </tr>
             <tr>
            <td colspan="3"> รายการ Order ที่ยกเลิกไปแล้ว :<span class="badge badge-success"><?=$num4?> Order</span></td>
            </tr>
            <tr>
            <td colspan="3"> รายการ Order ที่ยืนยันแล้ว :<span class="badge badge-success"><?=$num6?> Order</span></td>
            </tr>
            </table>
             </center>

				<? $sql1 = mysql_query("select * from db_order");
					$date = date("Y-m-d");
				     while($lis1 = mysql_fetch_array($sql1)){
					
					if($date >= $lis1['dateEx']){
						$sql = mysql_query("select * from db_order,db_orderdetail 
														where db_order.order_id = db_orderdetail.order_id and dateEx <= '$date' and status = 'wait'");
														while($lis = mysql_fetch_array($sql)){
								mysql_query("update product set amount = amount + '$lis[detailnum]' where product_id = '$lis[product_id]'");
								}
							mysql_query("update db_order set status = 'fa' where dateEx <= '$date'")or die(mysql_error());
					}
					 }
					 $sql2 = mysql_query("select * from product");
					 $lis2 = mysql_fetch_array($sql2);
					 if($lis2['amount'] <= 5){
						 mysql_query("update product set status = 'lout' where amount <= 5");
					 }
					 if($lis2['amount'] <= 0){
						 mysql_query("update product set status = 'out' where amount <= 0");
					 }
					  if($lis2['amount'] > 5){
						 mysql_query("update product set status = 'only' where amount > 5");
					 }
			?>
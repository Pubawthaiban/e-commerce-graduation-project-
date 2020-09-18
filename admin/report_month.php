<? 
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<? $Y = array("เลือกเดือน","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");?>
									<h3 align="center">รายงานสรุปยอดขายประจำเดือน</h3>
                                    <hr>
                        <div align="center">สรุปยอดขายประจำเดือน <?=$Y[$_GET['month']]?> ปี <?=$_GET['year']?></div>
<table border="1" cellpadding="9" cellspacing="9" align="center">
                                    <tr>
                                        <th>รหัสสินค้า</th>
                                        <th>ชื่อสินค้า</th>
                                        <th>จำนวนสินค้า</th>
                                        <th>ราคาสินค้า</th>
                                        <th>จำนวนเงิน</th>
                                    </tr>
                                <?php
								require('../connect.php');
								$con = "con";
                    $sql1 = mysql_query("select *,sum(detailnum) as num from db_order,db_orderdetail,product where db_order.status = '$con' and db_order.order_id = db_orderdetail.order_id and product.product_id = db_orderdetail.product_id and month(order_date) = '$_GET[month]' and year(order_date) = '$_GET[year]' group by product_name")or die(mysql_error());
                                                while($lis1 = mysql_fetch_array($sql1)){
														if($lis1['discount'] == 0){
																$price = $lis1['num'] * $lis1['product_price'];
															}else{
																$sumpro = ($lis1['product_price']/100)*$lis1['discount'];
																$sum  = $lis1['product_price'] - $sumpro;
																$price = $lis1['num'] * $sum; 
															}
																$sumtotal = $sumtotal + $price;
                                ?>
                                    <tr>
                                        <td align="center"><?=$lis1['product_id'];?></td>
                                        <td align="center"><?=$lis1['product_name'];?></td>
                                        <td align="center"><?=$lis1['num'];?></td>
                                        <? if($lis1['discount'] == 0){ ?>
                                        <td align="center"><?=number_format($lis1['product_price'],2);?></td>
                                        <? }else{ ?>
                                                <td align="center"><?=number_format($sum,2);?></td>
                                        <? } ?>
                                        <td align="center"><?=number_format($price,2);?></td>
                                         <? $sum1 = $sum1 + $price ?>
                                    </tr>
                                <? } ?>
                                <tr>
                        	<th colspan="4" align="right">ยอดรวมทั้งหมด :</th>
                        	<th><?=number_format($sum1,2);?></th>
                        </tr>
                                </table>
</body>
</html>
<? 
		$html = ob_get_contents();        //เก็บค่า html ไว้ใน $html 
		ob_end_clean();
		require('MPDF57/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ
		$mpdf = new mPDF('UTF-8');
		$mpdf->SetAutoFont();
		$mpdf->WriteHTML($html);
		$mpdf->Output();
?>
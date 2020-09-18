<?php session_start(); require_once('header.php'); ?>
			
            	<div class="container">
					<div class="row">
                    	<div class="well" align="center">
                    	<div style="width:680px;background-color:#666;padding:6px;text-align:left"><font color="#FFFFFF">เลือกวิธีการรับสินค้า</font></div>
                        	<div style="border:solid 1px;width:68%;height:auto";>
                          <form action="cart_con.php" method="post">
                        	<table style="width:60%">
                            <tr>
                                	<th><input type="radio" name="add" value="FREE" id="i" style="margin:0px">&nbsp;มารับสินค้าที่ร้าน</th>
                                  <? if($_GET['edit'] == ""){ ?>
                                <th><input type="radio" name="add" value="100" id="ii" style="margin:0px">&nbsp;จัดส่งตามที่อยู่</th>	
                                <? }else{ ?>	
                                <th><input type="radio" name="add" value="100" id="ii" style="margin:0px" checked>&nbsp;จัดส่งตามที่อยู่</th>
                                <? } ?>			
                            </tr>
                    			</table>
                                <div id="t"><h3>เลือกวิธการรับสินค้า</h3></div>
                                <div id="ta" style="margin-top:10px">
                                	<span><font face="Tahoma" color="#FF0000"><h3>ค่าจัดส่ง 100 บาท</h3></font></span>
                                    <? $sql = mysql_query("select * from  member where member_id = $_SESSION[id]");
										$lis = mysql_fetch_array($sql);
									?>
                                	<table>
                                    	<tr>
                                			<td align="right">ชื่อ :</td>
                                            <td><?=$lis['mem_name'];?></td>
                                		</tr>
                                        <tr>
                                        	<td align="right">ที่อยู่ :</td>
                                           <? if($_GET['edit'] == ""){ ?>
                                            <td><textarea readonly> <?=$lis['mem_add'];?> </textarea></td>
                                            <? }else{ ?>
                                            <td><textarea name="editadd"><?=$lis['mem_add'];?> </textarea></td>
                                            <? } ?>
                                        </tr>
                                        <tr>
                                        <? if($_GET['edit'] == ""){ ?>
                <th colspan="2"><a href="cart_address.php?edit=edit" data-toggle="modal" class="btn">แก้ไขข้อมูล</a></th>
                						<? }else{ ?>
                            <th colspan="2"><input type="submit" value="ยืนยันการจัดส่ง" class="btn"/>
                            						<input type="hidden" value="edit" name="edit">
                            <a href="cart_address.php?edit" class="btn">ยกเลิก</a></th>
                              				<? } ?>
                                        </tr>
                                	</table>
            <? if($_GET['edit'] == ""){ ?><input type="submit" value="ยืนยันการจัดส่ง" /><? } ?>
                                </div>
                                
                                <!-------------------------------------------------------------------------------->
                                
                                <div id="m">
                                <span><font color="#FF0000"><h3>ค่าจัดส่ง Free</h3></font></span>
                                </div>
                                <div style="width:600px;height:300px;border: inset #000 1px" id="map">
                               		<? require_once('google.php');?>
                                </div>
                                <div id="o">
                                <input type="submit" value="ยืนยันการจัดส่ง" />
                                </div>
                             </div>
                             </form>
                             <input type="button" value="ย้อนกลับ" onclick="window.location='show.php'" class="btn"/>
                    	</div>
                    </div>
                </div>
                <!--------->

                <!---------->
                <script language="javascript">
					$(document).ready(function() {
						$("#ta").hide();
						$("#m").hide();
						$("#o").hide();
						<? if($_GET['edit'] != "" ){ ?>
						$("#ta").show("slow");
						$("#t").hide("slow");
						<? } ?>
						$("#map").hide("fast");
						$("#i").click(function (){
							$("#t").hide("slow");
							$("#ta").hide("slow");
							$("#m").show("slow");
							$("#map").show("slow");
							$("#o").show("slow");
						});
						$("#ii").click(function (){
							$("#t").hide("slow");
							$("#ta").show("slow");
							$("#m").hide("slow");
							$("#map").hide("slow");
							$("#o").hide("slow");
						});
					});
				</script>
              
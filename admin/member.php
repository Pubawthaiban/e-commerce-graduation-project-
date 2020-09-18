			<? $sql = mysql_query("select * from member");
							$num = mysql_num_rows($sql);
                            ?>
                            <style>
								table th{
										background:-webkit-gradient(linear,left top,left bottom,from(#f9f9f9),to(#ececec));
										background:-moz-linear-gradient(top,#f9f9f9, #ececec);
									}
									table td{
										text-align:center;
										border-bottom:solid 1px #dfdfdf;	
									}
								</style>
            <div>สมาชิกทั้งหมด <span class="badge badge-success"><?=$num?></span> คน</div>
            		<table align="center" cellpadding="10" cellspacing="10" style="margin-top:9px;border:solid 1px #dfdfdf;">
                    	<tr>
                        	<th>USER-ID</th>
                        	<th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>เบอร์โทร</th>
                            <th>e-mail</th>
                            <th>จัดการ</th>
                        </tr>
                        <?php
									 while($lis = mysql_fetch_array($sql)){
						?>
                        <tr>
                        	<td><?=$lis['username'];?></td>
                            <td><?=$lis['mem_name'];?></td>
                            <td><?=$lis['mem_las'];?></td>
                            <td><?=$lis['mem_tel'];?></td>
                            <td><?=$lis['mem_email'];?></td>
     <td bgcolor="#FFFFFF"><a href="edit_mem.php?id=<?=$lis['member_id'];?>" class="btn"><i class="icon-wrench"></i></a>&nbsp;<a href="wellcom.php?delid=<?=$lis['member_id'];?>" class="btn" onclick="return confirm('คุณต้องการลบข้อมูลใช่หรือไม่...?')"><i class="icon-trash"></i></a></td>
                        </tr>
                        <? } ?>
                    </table>
                    
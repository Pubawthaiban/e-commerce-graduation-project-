<?php session_start(); require_once('header.php'); ?>
<div class="container">
		<div class="row-fluid">
        		<div class="well" style="margin-left:10px;margin-right:10px;">
                <div class="tabbable tabs-left">
                	<ul class="nav nav-tabs" id="myTab">
                      <li class="active"><a href="#home"><i class="icon-check"></i></a></li>
                      <li><a href="#profile">สมาชิก</a></li>
                    </ul>
                     
                    <div class="tab-content">
                      <div class="tab-pane active" id="home"><? require_once('checkpro.php')?></div>
                      <div class="tab-pane" id="profile"><? require_once('member.php')?></div>
                    </div>
                    </div>
                </div>
        </div>
</div>		 
							<?
								if($_GET['delid'] != ""){
							require_once('../connect.php');
							$del = mysql_query("delete from member where member_id = '$_GET[delid]'");
							if($del){
							 	echo "<script>alert('ลบข้อมูลแล้ว');history.back(0);</script>";	
							}
						}
                            ?>

					<script>
                    $('#myTab a').click(function (e) {
                      e.preventDefault();
                      $(this).tab('show');
                    });
                    </script>

<? session_start(); require_once('header.php');?>
		<div class="container">
			<div class="row">
            	<div class="well">
                	<div style="border:solid 1px #000000;text-align:center;background-color:#666;padding:6px"><font color="#FFFFFF">My account</font></div>
                    <? if(empty($_GET['order'])){ ?>
                    <ul class="nav nav-tabs" id="myTab">
                      <li class="active"><a href="#home" data-toggle="tab">ข้อมูลส่วนตัว</a></li>
                      <li><a href="#profile" data-toggle="tab">รายการที่สั่งชื้อ</a></li>
                      <li><a href="#editpass" data-toggle="tab">เปลี่ยนรหัสผ่าน</a></li>
                    </ul>
                     
                    <div class="tab-content">
                      <div class="tab-pane active" id="home">
                      	<? require_once('user.php');?>
                      </div>
                      <div class="tab-pane" id="profile"><? require_once('myorder.php');?></div>
                      <div class="tab-pane" id="editpass"><? require_once('editpass.php');?></div>
                    </div>
                  </div>
                  <? }else{ 
						require_once('orderdetail.php');	
                   } ?>
               </div>
           </div>
           
           
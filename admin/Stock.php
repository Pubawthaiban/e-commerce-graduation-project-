<?php session_start(); $header = "จัดการสต๊อก"; require_once("header.php"); ?>
<div class="container">
	<div class="row-fluid">
		<div class="well span3" style="margin-left: 10px; padding:0px; background-color:#1b1b1b; border-color: #575757">
			<ul class="nav nav-list">
              <li class="active"><a href="Stock.php">Menu</a></li>
              <li><a href="Stock.php?add=type"><i class="icon-folder-open icon-white"></i>&nbsp;เพิ่มประเภทสินค้า</a></li>
              <li><a href="Stock.php?add=product"><i class="icon-shopping-cart icon-white"></i>&nbsp;เพิ่มสินค้า</a></li>
            </ul>
		</div>
			<div class="well span9" style="margin-left:auto; background-color: #1b1b1b;border-color: #575757; padding:0px;">
            		<?php if(empty($_GET) or $_GET['del'] or $_GET['ad'] or $_GET['search']){
                    	 require_once('set_product.php');
					}
            		 if($_GET['add'] == type or $_GET['typedel'] or $_GET['edit1']){	 
						 require_once('add_type.php');
					}
					if($_GET['add'] == product){
						 require_once('add_product.php');
					}
					if($_GET['edit'] == product){
						 require_once('edit_product.php');
					}
					?>
			</div>
	</div>
</div>
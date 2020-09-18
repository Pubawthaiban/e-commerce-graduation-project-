<?php session_start(); ?>
<?php include_once('header.php');?>

	<?php

	if(!isset($_SESSION["intLine"])){
		$_SESSION["intLine"] = 0;
		$_SESSION["Product"][0] = $_GET["cartProduct"];
		$_SESSION["Productnum"][0] = 1;

				echo '
					<script type="text/javascript">
						window.location="index.php";
					</script>';
	}else{

		$key = array_search($_GET["cartProduct"], $_SESSION["Product"]);
		if((string)$key != ""){
			$_SESSION["Productnum"][$key] = $_SESSION["Productnum"][$key] + 1;

		}else{

			$_SESSION["intLine"] = $_SESSION["intLine"] + 1;
			$intNewLine = $_SESSION["intLine"];
			$_SESSION["Product"][$intNewLine] = $_GET["cartProduct"];
			$_SESSION["Productnum"][$intNewLine] = 1;
		}
		echo '
					<script type="text/javascript">
						window.location="index.php";
					</script>';
	}

	?>

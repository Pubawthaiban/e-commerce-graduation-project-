<? session_start();
			if(isset($_GET['del'])){
				$Line = $_GET["del"];
				unset($_SESSION["Product"][$Line]);
				unset($_SESSION["Productnum"][$Line]);
		echo "<script>window:location ='index.php';</script>";
			}else if(isset($_GET['dell'])){
				$Line = $_GET["dell"];
				unset($_SESSION["Product"][$Line]);
				unset($_SESSION["Productnum"][$Line]);
				echo "<script>window:location ='show.php';</script>";
			}
?>
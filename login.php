<! DOCTYPE html>
<html>
	<head>
		<title>login | sarah lober</title>
		<link rel="stylesheet" type="text/css" href="styles/login_styles.css" />
		<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
		<link href="https://fonts.googleapis.com/css?family=Lora:400,400i|Sacramento|Source+Sans+Pro:400,700" rel="stylesheet">
	</head>
	<body>
		<div class="wrapper">
			<header>
				<ul id="menu">
					<li><a href="login.php" id="sig">sl</a></li>
					<li class="page"><a href="index.html">home</a></li>
					<li class="page"><a href="blog.php">blog</a></li>
					<li class="page"><a href="about.html">about</a></li>
					<li class="page"><a href="https://goo.gl/photos/4UUa1wCdcfyc5hXU7" target="_blank">gallery</a></li>
					<li class="page"><a href="map.html">map</a></li>
					<div class="icons"><li><a href="" target="_blank"><img class="sm" src="styles/media/sm/fb.png" /></a></li>
					<li><a href="" target="_blank"><img class="sm" src="styles/media/sm/insta.png" /></a></li>
					<li><a href="" target="_blank"><img class="sm" src="styles/media/sm/in.png" /></a></li>
					<li><a href="" target="_blank"><img class="sm" src="styles/media/sm/tweet.png" /></a></li>
					<li><a href="https://goo.gl/photos/XUnzzUS6oeBKBJCw6" target="_blank"><img class="sm" src="styles/media/sm/pic.png" /></a></li></div>
				</ul>
			</header>
			<?php 

			require("config.php");

			$loginform = "<div class=\"login\" id=\"one\">
				<form>
				<p>Magic password: <input type=\"password\" name=\"password\">
				</form></p>
				<p>If you don't have a password, head over <span><a href=\"subscribe.php\">here</a></span> to subscribe and stay updated with my blog!</p>
			</div>";

			$wrongpass = "<div class=\"login\">
			<p>Wrong password. Don't try to hack my blog.</p></div>";	

			$newblogpost = "<div class=\"postform\">
			<h3>Oh, hey girl!<br>Create a New Post:</h3>
			<form method=\"post\">
				<p><span class= \"lefties\">date: </span><input type=\"date\" name=\"date\" id=\"date\" class=\"bod_font\"> title: <input type=\"text\" name=\"title\" id=\"title\" class=\"bod_font\"> </p> 
				<p><span class= \"lefties\">body: (make sure to enter in new p when needed!) </span><br> <span class= \"lefties\"><textarea rows=\"16\" cols=\"80\" name=\"body\" id=\"body\" class=\"bod_font\"></textarea> </span></p> 
				<h3>Images:</h3> 
				<p>supporting images should be 2048 × 1459. should be stored in styles/media...</p>
				<div id= \"lefties\" class=\"lefties\">
					<p>main: <input type=\"text\" name=\"main\" class=\"bod_font\"> 
					<p>image 1: <input type=\"text\" name=\"img1\" class=\"bod_font\"> 
					<p>image 2: <input type=\"text\" name=\"img2\" class=\"bod_font\"> 
					<p>image 3: <input type=\"text\" name=\"img3\" class=\"bod_font\">  	
				</div>	
				<div class=\"righties\">
					<p>caption: <input type=\"text\" name=\"captionmain\" class=\"cap\" class=\"bod_font\"> </p> 
					<p>caption: <input type=\"text\" name=\"caption1\" class=\"cap\" class=\"bod_font\"> </p> 
					<p>caption: <input type=\"text\" name=\"caption2\" class=\"cap\" class=\"bod_font\"> </p> 
					<p>caption: <input type=\"text\" name=\"caption3\" class=\"cap\" class=\"bod_font\"> </p> 
				</div>
				<div id=\"center\"><input type=\"submit\" id=\"submit\" value=\"Submit\"></div>
			</form>
			</div>";

			if (!isset($_GET["password"])) {
				echo "$loginform";
			}

			else if ($_GET["password"] == "hello") {
				echo "$newblogpost";
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					$date = $_POST["date"];
					$title = $_POST["title"];
					$body = $_POST["body"];
					$main = $_POST["main"];
					$maincap = $_POST["captionmain"];
					$img1 = $_POST["img1"];
					$caption1 = $_POST["caption1"];
					$img2 = $_POST["img2"];
					$caption2 = $_POST["caption2"];
					$img3 = $_POST["img3"];
					$caption3 = $_POST["caption3"];

					try {
						$db = new PDO("mysql:dbname=".$GLOBALS["database"].";host=".$GLOBALS["hostname"],
							$GLOBALS["username"],$GLOBALS["password"]);
						$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

						$query = "INSERT INTO `posts`(`date`, `title`, `body`) 
						VALUES (:date,:title,:body);";
						$statement = $db->prepare($query);
						$success0 = $statement->execute(array('date'=>$date,'title'=>$title,'body'=>$body));

						$query = "INSERT INTO `images`(`filename`, `caption`, `main`, `post_title`) 
							VALUES (:main,:maincap,1,:title);";
						$statement = $db->prepare($query);
						$success1 = $statement->execute(array('main'=>$main,'maincap'=>$maincap,'title'=>$title));

						$query = "INSERT INTO `images`(`filename`, `caption`, `main`, `post_title`) 
							VALUES (:img1,:cap1,0,:title);";
						$statement = $db->prepare($query);
						$success2 = $statement->execute(array('img1'=>$img1,'cap1'=>$caption1,'title'=>$title));

						$query = "INSERT INTO `images`(`filename`, `caption`, `main`, `post_title`) 
							VALUES (:img2,:cap2,0,:title);";
						$statement = $db->prepare($query);
						$success2 = $statement->execute(array('img2'=>$img2,'cap2'=>$caption2,'title'=>$title));

						$query = "INSERT INTO `images`(`filename`, `caption`, `main`, `post_title`) 
							VALUES (:img3,:cap3,0,:title);";
						$statement = $db->prepare($query);
						$success2 = $statement->execute(array('img3'=>$img3,'cap3'=>$caption3,'title'=>$title));

					}
					catch (PDOException $ex) {
						print_r($ex);
						echo "Something went wrong!";
					}
					if ($success0 && $success1 && $success2 && $success3 && $success4) {
						echo "Your post has been submitted";
					}
				}
			}

			else {
				echo "$wrongpass";
			}

			?>

		</div>
	</body>
</html>
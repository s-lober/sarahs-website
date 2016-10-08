<?php 
	require("config.php");

	$postid = $_GET["postid"];

	try {
		$db = new PDO("mysql:dbname=".$GLOBALS["database"].";host=".$GLOBALS["hostname"],
		$GLOBALS["username"],$GLOBALS["password"]);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//$query = "SELECT * FROM posts AS p WHERE p.id = $postid;";
		$query = "SELECT * FROM `posts` AS p WHERE p.id = $postid;";

		$post = $db->query($query);

		$post1 = $post->fetch(PDO::FETCH_ASSOC);

		$title = $post1["title"];
		$date = $post1["date"];
		$body = $post1["body"];
		
		$query = "SELECT `filename`, `caption` FROM `images` AS i WHERE `post_title` = '$title';";

		$image = $db->query($query);

		$all_images = Array();
		for ($i = 0; $i < $image->rowCount(); $i++) {
			$all_images[$i] = $image->fetch(PDO::FETCH_ASSOC);
		}
		
		$mainimg = $all_images[0]["filename"];
		$maincaption = $all_images[0]["caption"];
		$img_1 = $all_images[1]["filename"];
		$caption_1 = $all_images[1]["caption"];
		$img_2 = $all_images[2]["filename"];
		$caption_2 = $all_images[2]["caption"];
		$img_3 = $all_images[3]["filename"];
		$caption_3 = $all_images[3]["caption"];


	}
	catch (PDOException $ex) {
		echo "Something went wrong, try again later. <br/>";
		print_r($ex);
	}
?>

<! DOCTYPE html>
<html>
	<head>
		<title> <?= $title ?> | sarah lober</title>
		<link rel="stylesheet" type="text/css" href="styles/post_styles.css"/>
		<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
		<link href="https://fonts.googleapis.com/css?family=Lora:400,400i|Sacramento|Source+Sans+Pro:400,700" rel="stylesheet">
	</head>
	<body>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-81277709-1', 'auto');
  ga('send', 'pageview');

</script>
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
			<div class="post">
				<div class="image">
					<img src="<?= $mainimg ?>"/>
					<p><span><?= $maincaption ?></span></p>
				</div>
				<p id="date"><?= $date ?></p>
				<h2><?= $title ?></h2>
				<div class="body"><?= $body ?></div>
			</div>	

			<div id="box_1" class="box">
				<img id="img_1" src="<?= $img_1 ?>" />
				<span class="caption">
					<h4><?= $caption_1 ?></h4>
				</span>	
			</div>	
			<div id="box_2" class="box">
				<img id="img_2" src="<?= $img_2 ?>" />
				<span class="caption">
					<h4><?= $caption_2 ?></h4>
				</span>	
			</div>
			<div id="box_3" class="box">
				<img id="img_3" src="<?= $img_3 ?>" />
				<span class="caption">
					<h4><?= $caption_3 ?></h4>
				</span>	
			</div>	
			
			<br><a href="blog.php"><p id="explore">explore more posts</p></a>
			<footer>
			</footer>
		</div>
	</body>
</html>
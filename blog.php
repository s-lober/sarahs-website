<?php 
	require("config.php");

	try {
		$db = new PDO("mysql:dbname=".$GLOBALS["database"].";host=".$GLOBALS["hostname"],
		$GLOBALS["username"],$GLOBALS["password"]);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//$query = "SELECT * FROM posts AS p WHERE p.id = $postid;";
		$query = "SELECT `title`, `date`, `id` FROM `posts` WHERE 1;";

		$posts = $db->query($query);

		$all_posts = Array();
		for ($ii = 0; $ii < $posts->rowCount(); $ii++) {
			$all_posts[$ii] = $posts->fetch(PDO::FETCH_ASSOC);
		}

		$latest_title = $all_posts[count($all_posts) - 1]["title"];
		$latest_date = $all_posts[count($all_posts) - 1]["date"];
		$latest_id = $all_posts[count($all_posts) - 1]["id"];

		$query = "SELECT `filename` FROM `images` WHERE `main`;";

		$images = $db->query($query);

		$all_main_images = Array();
		for ($ii = 0; $ii < $images->rowCount(); $ii++) {
			$all_main_images[$ii] = $images->fetch(PDO::FETCH_ASSOC);
		}

		$latest_image = $all_main_images[count($all_main_images) - 1]["filename"];

	}
	catch (PDOException $ex) {
		echo "Something went wrong";
		print_r($ex);
	}
?>


<! DOCTYPE html>
<html>
	<head>
		<title>blog | sarah lober</title>
		<link rel="stylesheet" type="text/css" href="styles/blog_styles.css" />
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
            <p id="logo">TRAVELS</p>	
			<div class="new_post">
				<a href="post.php?postid=<?=$latest_id?>"> <img src="<?= $latest_image ?>" class="filter">
				<div id="latest_post">
					<p class="page">latest post</p>
					<h2 class="title"><?= $latest_title ?></h2>
					<p class="date"><?= $latest_date ?></p>
					<div class="read">read on</div>
				</div></a>
			</div>
            
            <div id="old_stuff">

		<?php 

			for ($ii = count($all_posts) - 2; $ii >= 0; $ii--) {

				$id = $all_posts[$ii]["id"];
				$date = $all_posts[$ii]["date"];
				$title = $all_posts[$ii]["title"];
				$image = $all_main_images[$ii]["filename"];

                echo "<div class=\"old_post\">
					   <a href=\"post.php?postid=$id\"> <img src=\"$image\" class=\"filter\">
					   <h2 class=\"title\">$title</h2>
					   <p class=\"date\">$date</p>
					   <div class=\"read\">read on</div></a>
				    </div>";
				
			}
		
		?>
            </div>
            
		</div>
	</body>
</html>
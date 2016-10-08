<! DOCTYPE html>
<html>
	<head>
		<title>subscribe | sarah lober</title>
		<link rel="stylesheet" type="text/css" href="styles/subscribe_styles.css" />
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
                <?php
                
                if ($_SERVER["REQUEST_METHOD"] == "GET" ) {
                    echo "<div class=\"before\">
                <h2>subscribe!</h2>
                <p>i'll only send you an email when i add a new post (promise)</p>
                <form method=\"post\">
                    <p><input type=\"text\" name=\"email\" class=\"email\">
                        <input type=\"submit\" id=\"submit\" value=\"\"></p>
                </form></div>";
                
                }   
                
                else if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        
                        require("config.php");
                        
                        $email = $_POST["email"];
                        
                        try {
                             $db = new PDO("mysql:dbname=".$GLOBALS["database"].";host=".$GLOBALS["hostname"],
							$GLOBALS["username"],$GLOBALS["password"]);
						    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            $query = "INSERT INTO `emails`(`email`) VALUES (:email);";
						    $statement = $db->prepare($query);
						    $success0 = $statement->execute(array('email'=>$email));
                            
                        }
                        
                        catch (PDOException $ex) {
						  print_r($ex);
                          echo "Something went wrong!";
					   }
                    ?>
                    <?php
					   
                        if ($success0) {
						    echo "<div class=\"after\">
                                <h2>thanks!</h2>
                                <p><a href=\"index.html\">click here to return home</a></p>
                            </div>";
					   }
                        
                        else {
                            print "sorry";
                       }
            
                    }
                ?>
    </body>
</html>
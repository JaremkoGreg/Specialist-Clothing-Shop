<?php
require_once('./operations.php');


?>


<?php

require_once "pdo.php";

session_start();


if (isset($_SESSION['user'])){
	$sql = "SELECT * FROM users WHERE user_id = :user";

    //echo("<pre>\n".$sql."\n</pre>\n");
    $stmt = $pdo->prepare($sql);
	$stmt->execute(['user' => $_SESSION['user']]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	$username = $user["name"];
}
else{
	header('Location: login.php ');

}
?>
<?php
require_once "pdo.php";

if ( isset($_POST['name']) && isset($_POST['home_away']) 
	&& isset($_POST['colour']) && isset($_POST['year']) && isset($_FILES['image'])) {
    $sql = "INSERT INTO products (name, home_away, colour, year, image_url) 
              VALUES (:name, :home_away, :colour, :year, image_url)";
    //echo("<pre>\n".$sql."\n</pre>\n");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':home_away' => $_POST['home_away'],
        ':colour' => $_POST['colour'],		
        ':year' => $_POST['year'],
		':image_url' => $_FILES['image']));
}

if ( isset($_POST['delete']) && isset($_POST['product_id']) ) {
    $sql = "DELETE FROM products WHERE product_id = :zip";
    echo "<pre>\n$sql\n</pre>\n";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['product_id']));
}

$stmt = $pdo->query("SELECT name, home_away, colour, year, image_url, product_id FROM products");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>Members Area</title>
	<style>
		body {
			padding: 0;
			margin: 0;
			background: rgb(177, 0, 0);
		}

		abbr {
			text-decoration: none;
		}

		em {
			text-decoration: solid;
		}

		h1 {
			color: white;
			text-shadow: #000 0px 0px 1px, #000 0px 0px 1px, #000 0px 0px 1px,
				#000 0px 0px 1px, #000 0px 0px 1px, #000 0px 0px 1px;
			background: rgb(177, 0, 0);
			font-size: 70px;
			text-align: center;
			margin: 0;
			padding: 0;
			font-family: 'Times New Roman';
		}

		h2 {
			color: white;
			background: black;
			font-family: 'Times New Roman';
			font-size: 25px;
			text-align: center;
			margin: 0;
			padding: 0;
			font-family: 'Times New Roman';
		}

		h3 {
			color: white;
			text-shadow: #000 0px 0px 1px, #000 0px 0px 1px, #000 0px 0px 1px,
				#000 0px 0px 1px, #000 0px 0px 1px, #000 0px 0px 1px;
			background: rgb(177, 0, 0);
			font-size: 35px;
			text-align: center;
			margin: 0;
			padding: 0;
			font-family: 'Times New Roman';
		}

		nav {
			width: 100%;
			height: 50px;
			background-color: black;
		}

		ul {
			margin: 0;
			padding: 0;
		}

		ul li {
			list-style: none;
			display: inline-block;
			float: left;
			line-height: 50px;
		}

		ul li a {
			display: block;
			text-decoration: none;
			font-size: 30px;
			font-family: 'Times New Roman';
			color: white;
			padding: 0 70px;
		}

		ul li a:hover {
			background-color: rgb(58, 58, 58);
		}

		.skip-link {
			position: absolute;
			top: -40px;
			left: 0;
			background: black;
			color: white;
			padding: 8px;
		}

		.skip-link:focus {
			top: 0;
		}

		p {
			padding: 2px;
			margin: 10px;
			color: white;
			font-size: 20px;
			font-family: 'Times New Roman';
		}

		blockquote {
			block-size: 350px;
			border: solid;
			border-color: black;
			padding: 0;
			margin: 0;
			color: white;
			font-size: 25px;
			text-shadow: #000 0px 0px 1px, #000 0px 0px 1px, #000 0px 0px 1px,
				#000 0px 0px 1px, #000 0px 0px 1px, #000 0px 0px 1px;
			font-family: 'Times New Roman';
			background-image: url("oldtrafford.jpg");
		}

		audio {
			position: absolute;
			top: 500px;
			left: 0;
		}

		footer {
			color: white;
			border-style: solid;
			border-color: black;
			border-width: 3px 0px 0px 0px;
			font-family: 'Times New Roman';
			font-size: 20px;
			text-align: left;
			background-color: black;

		}
		img{
			width: 200px;
		}
        button{
			width:100%;
			background-color: black;
			color:white;
			font-size: 50px;
		}
		input{
			font-size: 20px;
            width:100%;
			background-color:white;
            color:black;
		}
		p{
			text-align: center;
			font-size: 20px;
			color: black;
		}
	</style>
<body>
    <header>
		<h1>
			<abbr title="Red Devils Retro Shirts">RDRS</abbr>
		</h1>
    </header>
	<a href="#maincontent" class="skip-link">skip to main content</a>
    <nav>
		<ul>
            <li><a href="index.html">About us</a></li>
			<li><a href="products.php">Products</a></li>
			<li><a href="members.php">Members</a></li>
			<li><a href="video.html">Product Video</a></li>
			<li><a href="contactus.html">Contact us</a></li>
		</ul>
	</nav>
    <h1>New Product Form</h1>
    <form action="display.php" method="post" enctype="multipart/form-data">
            <?php //Parameters (Placeholder, Name, Value, Type) ?>
            <?php inputFields("Shirt Name","name","","text"); ?>
            <?php inputFields("Home or Away","home_away","","text"); ?>
            <?php inputFields("Colour","colour","","text"); ?>
            <?php inputFields("Year","year","","int"); ?>
            <?php inputFields("","file","","file"); ?>
        <button type="submit" name="submit">Add Product</button>
    </form>

</body>
</html>
		
	</main>
	<footer>
		Website created by Greg Jaremko
	</footer>
</body>
</html>

<?php
include('./connect.php');
if(isset($_POST['submit'])){
    //Accessing all the form data and storing it in variables
    $name=$_POST['name'];
    $home_away=$_POST['home_away'];
    $colour=$_POST['colour'];
    $year=$_POST['year'];
    $image=$_FILES['file'];

    $imagefilename=$image['name'];

    $imagefileerror=$image['error'];

    $imagefiletemp=$image['tmp_name'];
    $filename_seperate=explode('.',$imagefilename);
    $extension=strtolower($filename_seperate[1]);

    $extensionsallowed=array('jpeg','jpg','png');
    if(in_array($extension,$extensionsallowed)){
        $upload_image='images/'.$imagefilename;
        move_uploaded_file($imagefiletemp,$upload_image);
        $sql="INSERT INTO `products`(`name`, `home_away`, `colour`, `year`, `image_url`) VALUES ('$name','$home_away','$colour','$year','$upload_image')";
        $result=mysqli_query($con,$sql);
        if($result){
            echo "Product Added Successfuly!";
        }
        else{
            die(mysqli_error($con));
        }
        
    }



}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>View Products</title>
</head>
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
			width:200px;
		}
        table, th, td {
  font-size: 35px;
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
	<h2>
		Members
	</h2>
    <h3>
        All Products
    </h3>
	<main id="maincontent">
    <div class="container mt-5">
    <table class="table table-bordered w-50">
        <thead>
            <tr>
                <th scope="col">Shirt Name</th>
                <th scope="col">Home or Away</th>
                <th scope="col">Colour</th>
                <th scope="col">Year</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql="Select * from `products`";
            $result=mysqli_query($con,$sql);
            while($row=mysqli_fetch_assoc($result)){
            $id=$row['id'];
            $name=$row['name'];
            $home_away=$row['home_away'];
            $colour=$row['colour'];
            $year=$row['year'];
            $image=$row['image_url'];
            echo '<tr>
                <td>'.$id.'</td>
                <td>'.$name.'</td>
                <td>'.$home_away.'</td>
                <td>'.$colour.'</td>
                <td>'.$year.'</td>
                <td><img src ='.$image.' /></td>
            </tr>';
            }
            ?>
        </tbody>


</body>
</html>
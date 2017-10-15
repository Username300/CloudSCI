<!DOCTYPE html>
<?php
error_reporting(-1);
include('config.php');
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="infcss.css">
	
	<!-- Font-Awesome -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<title> <?php echo "$project_title - panel"; ?> </title>
  </head>
  <body>	
<div class="body">
	<div class="nav-side-menu">
    <div class="brand"> 
		<img src="sci_logo.png" alt="SCI" class="sci-logo">
		<h4><?php echo $project_title; ?></h4>
	</div>
	<div class="clearfix"></div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                <li>
                  <a href="#"><i class="fa fa-dashboard fa-lg"></i> Dashboard</a>
                </li>

                <li  data-toggle="collapse" data-target="#products" class="collapsed">
                  <a href="#"><i class="fa fa-flag fa-lg"></i> UI Elements <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="products">
                    <li><a href="#">CSS3 Animation</a></li>
                    <li><a href="#">General</a></li>
                    <li><a href="#">Buttons</a></li>
                    <li><a href="#">Tabs & Accordions</a></li>
                    <li><a href="#">Typography</a></li>
                    <li><a href="#">Slider</a></li>
                    <li><a href="#">Panels</a></li>
                    <li><a href="#">Widgets</a></li>
                    <li><a href="#">Bootstrap Model</a></li>
                </ul>


                <li data-toggle="collapse" data-target="#service" class="collapsed">
                  <a href="#"><i class="fa fa-globe fa-lg"></i> Services <span class="arrow"></span></a>
                </li>  
                <ul class="sub-menu collapse" id="service">
                  <li>New Service 1</li>
                  <li>New Service 2</li>
                  <li>New Service 3</li>
                </ul>


                <li data-toggle="collapse" data-target="#new" class="collapsed">
                  <a href="#"><i class="fa fa-comments fa-lg"></i> New <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="new">
                  <li>New New 1</li>
                  <li>New New 2</li>
                  <li>New New 3</li>
                </ul>


                 <li>
                  <a href="#">
                  <i class="fa fa-user fa-lg"></i> Profile
                  </a>
                  </li>

                 <li>
                  <a href="#"><i class="fa fa-cloud fa-lg"></i> My Files</a>
                </li>
            </ul>
     </div>
</div>

	<section class="main">
		<div class="container">
			<br>
			<h1>Lorem Ipsum</h1>
			<br>
			<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ultricies posuere arcu, vel bibendum eros congue id. Pellentesque vulputate lacus felis, in pellentesque velit mollis id. Donec eget tristique nunc, faucibus tristique metus. Aliquam eget erat mauris. Vivamus felis nisi, tempor sit amet purus sit amet, euismod facilisis diam. Duis cursus eros a luctus cursus. Integer vel elit suscipit, mattis quam in, varius elit. Proin aliquam sit amet ipsum vitae ornare. </p>

			<p> Morbi non nunc eu est volutpat pulvinar. Vestibulum eleifend nulla vel semper vulputate. Donec et nisi eu lorem convallis bibendum non in tellus. Proin ipsum nisl, consequat eget molestie sit amet, tristique porttitor neque. Pellentesque suscipit eros dui, nec pulvinar arcu sodales non. Suspendisse sodales dignissim nulla et aliquam. Duis eget mollis velit. </p>

			<p> Cras quis lacus et nisl tincidunt maximus eget ac libero. Aliquam id lacus dui. Nulla efficitur tortor id leo pulvinar, nec aliquet enim mattis. Curabitur ultrices, lorem eget consequat blandit, libero mauris ultricies lorem, nec sodales sapien lectus sit amet ligula. Morbi pretium nunc non nibh bibendum placerat. Suspendisse potenti. Suspendisse finibus blandit nunc at porttitor. Etiam mauris dui, condimentum ut risus in, convallis dignissim purus. Nullam et quam ac tortor mattis accumsan. Integer suscipit nisl ut sapien bibendum ultricies. Pellentesque lacinia, leo non egestas convallis, nisi neque placerat nulla, eget commodo augue ante non purus. Nunc consectetur sodales arcu, a dapibus justo consequat non. Aliquam elementum tortor in suscipit condimentum. Aenean venenatis at justo non blandit. Proin eleifend tempor euismod. </p>

			<p> Sed sollicitudin erat non urna dignissim imperdiet. Cras dignissim elit quis dui vestibulum, sed luctus est suscipit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac ante egestas, malesuada odio eu, mattis nibh. Donec iaculis velit lobortis ligula consequat commodo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin vitae iaculis nisl, a ultrices metus. </p>

			<p> Donec volutpat arcu id mollis vehicula. Suspendisse euismod mattis nulla, vel lobortis urna dignissim vel. Sed id maximus orci. Nam pharetra ligula justo, vel scelerisque nunc tincidunt eget. Ut malesuada dui a semper mattis. Cras a risus venenatis, tempor lectus at, aliquet elit. Praesent ut hendrerit mi. </p>
		</div>
	</section>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
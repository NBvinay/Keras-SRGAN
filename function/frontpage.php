<?php

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $targ_w = $targ_h = $_POST['h'];
    $jpeg_quality = 99;

    $src = 'demo_files/pool.jpg';
    $img_r = imagecreatefromjpeg($src);
    $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

    imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
    $targ_w,$targ_h,$_POST['w'],$_POST['h']);

    // header('Content-type: image/jpeg');
    imagejpeg($dst_r,'F:\wamp\www\superres\function\Keras-SRGAN\data_lr\input_image.jpg');
    // header("Content-Disposition: Attachment; filename=$dst_r");
    header("Location: http://127.0.0.1:8000/RunSuperRes");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Super Resolution</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,700,800" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">

<style>
  html {
  font-family: sans-serif;
}
  body {
    font-family: "Work Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  }
  hr.bcolor{
    border: 1px solid black;
  }
  
</style>

<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.Jcrop.js"></script>
  <link rel="stylesheet" href="demo_files/main.css" type="text/css" />
  <link rel="stylesheet" href="demo_files/demos.css" type="text/css" />
  <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
</head>

<body style="background-color:white;">

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-black w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>

    <a href="../index.html" class="w3-bar-item w3-button w3-padding-large"><span class="glyphicon glyphicon-menu-left"></span></a>
     <a href="#upload" style="text-decoration: none" class="w3-bar-item w3-button w3-padding-large w3-hide-small">UPLOAD</a>
    <a href="http://localhost/superres/function/frontpage.php#crop" 
    	style="text-decoration: none" 
    	class="w3-bar-item w3-button w3-padding-large w3-hide-small">
		CROP
	</a>
    <a href="#result" style="text-decoration: none" class="w3-bar-item w3-button w3-padding-large w3-hide-small">RESULT</a>
    <a href="merge.pdf" style="text-decoration: none" class="w3-bar-item w3-button w3-padding-large w3-hide-small">DOCUMENTATION</a>
  </div>
</div>

<div class="w3-content" style="max-width:1000px;margin-top:0px;">


  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px;" id="band">
    <div style="border-radius: 5px;">
    <div class="w3-container"><h2 style="font-size: 2rem;">Procedure</h2>
    <br>
    <p style="font-size: 1.3rem;  font-weight: 400; line-height: 1.5;">1. Select the image and upload. <br/>2. Crop the portion u need to enhance.<br/>3. The cropping window must be atleast 96x96 dimension.<br/>4. At most size of window is 384x384.</p></div></div>

<br/><hr class='bcolor'><br/>
<!--upload section-->
<div align="center" class="w3-white" id="upload">
  <form name="form" method="post" action="upload.php" enctype="multipart/form-data" >
    <h2>Upload and Crop Section</h2>
      <input type="file" name="my_file" /><br />
      <input type="submit" name="submit" value="Upload" />
    </form>
</div>

<!--crop section -->
<div class="w3-white" id="crop">
<div class="container">
<div class="row">
<div class="span12">
<div class="jc-demo-box">


    <!-- This is the image we're attaching Jcrop to -->

    <img src="./demo_files/pool.jpg" id="cropbox" />

    <!-- This is the form that our event handler fills -->
    <form action="" method="post" onsubmit="return checkCoords();">
      <input type="hidden" id="x" name="x" />
      <input type="hidden" id="y" name="y" />
      <input type="hidden" id="w" name="w" />
      <input type="hidden" id="h" name="h" />
      <input type="submit" value="Crop Image" class="btn btn-large btn-inverse" />
    </form>   


  </div>
  </div>
  </div>
  </div>
    
  </div>

<hr class='bcolor'>
  <!-- The result Section -->
  <div class="w3-black" id="result">
    <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
      <h2 class="w3-wide w3-center">RESULT PAGE</h2>

    </div>
  </div>

</div>
</div>



<script>
// Automatic Slideshow - change image every 4 seconds
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 4000);    
}

// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}

// When the user clicks anywhere outside of the modal, close it
var modal = document.getElementById('ticketModal');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


</script>

</body>
</html>


<script type="text/javascript">

  $(function(){

    $('#cropbox').Jcrop({
      aspectRatio: 1,
      onSelect: updateCoords,
      minSize: [ 96,96 ],
      maxSize: [ 383,383 ]
    });

  });



  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
    console.log(c.x,c.y,c.w,c.h);
  };

  function checkCoords()
  {
    $('#w') = 34;
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
  };




</script>
<style type="text/css">.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.btn {
  border: 2px solid gray;
  color: gray;
  background-color: white;
  padding: 8px 20px;
  border-radius: 8px;
  font-size: 20px;
  font-weight: bold;
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
}</style> 

<style type="text/css">
  #target {
    background-color: #ccc;
    width: 500px;
    height: 330px;
    font-size: 24px;
    display: block;
  }
</style>

<?php
	if (($_FILES['my_file']['name']!="")){
	// Where the file is going to be stored
	 $target_dir = "demo_files/";
	 $file = $_FILES['my_file']['name'];
	 $path = pathinfo($file);
	 $filename = "pool";
	 $ext = "jpg";
	 $temp_name = $_FILES['my_file']['tmp_name'];
	 $path_filename_ext = $target_dir.$filename.".".$ext;
	 
	// Check if file already exists
	if (file_exists($path_filename_ext)) {
	 echo "Sorry, file already exists.";
	 move_uploaded_file($temp_name,$path_filename_ext);
	 header("Location: http://localhost/superres/function/frontpage.php#crop");
	 }else{
	 move_uploaded_file($temp_name,$path_filename_ext);
	 header("Location: http://localhost/superres/function/frontpage.php#crop");
	 echo "Congratulations! File Uploaded Successfully.";
	 }
	}

?>
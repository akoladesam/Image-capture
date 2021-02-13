<?php
    
    $img = $_POST['image'];
    $folderPath = "image/";
  
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';
  
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);
    $baseurl = (__DIR__).'/'.$file;
   

    $link = mysqli_connect("", "", "", "");
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
      }
      $sql = "insert into imagedb(image_name,url) values('$fileName','$baseurl')";

    if(mysqli_query($link, $sql)){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    	
    }
     
    // Close connection
    mysqli_close($link);
    ?>
<?php
// For Multiple files:
// if ($_FILES['logo']['tmp_name'][0] == "") {
//   // No files were selected for upload, your (re)action goes here
// }
Class UploadFile
{
  /*
    singleUpload()
    takes path and file as arguments
    returns a string message
  */
  function singleUpload($_path, $_file)
  {
    //Check if a file has been Selected
    if($_file['name'] == "") return "No File Was Selected For Upload";

    $message = "";
    $target_file = $_path . basename($_file["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    //Check if directory exists create one if not
    if (!file_exists($_path)) mkdir($_path, 0777, true);
    
    // Check if image file is a actual image or fake image
    if(getimagesize($_file["tmp_name"]) == false) return "File is not an image.";

    // Check if file already exists
    if (file_exists($target_file)) return "Sorry, file already exists.";

    // Check file size
    if ($_file["size"] > 500000) return "Sorry, your file is too large.";

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

    if (move_uploaded_file($_file["tmp_name"], $target_file)) return "The file ". htmlspecialchars( basename( $_file["name"])). " has been uploaded.";
    else return " , there was an error uploading your file.";
  }

  /*
    multiUpload()
    takes path and files as arguments
    returns an array of strings
  */
  function multiUpload($_path, $_files)
  {
    //Gather the error messages
    $message = array();

    //Check if a file or files has been Selected
    if($_files['name'][0] == "") 
    {
      array_push($message ,"No File Was Selected For Upload");
      return $message;
    }

    // Count # of uploaded files in array
    $len = count($_files['name']);

    // Loop through each file
    for( $i=0; $i < $len; $i++ )
    {
      $target_file = $_path . basename($_files["name"][$i]);
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      //Check if directory exists create one if not
      if (!file_exists($_path)) mkdir($_path, 0777, true);
      
      // Check if image file is a actual image or fake image
      if(getimagesize($_files["tmp_name"][$i]) == false) 
      {
        array_push($message, "File is not an image.");
        continue;
      }

      // Check if file already exists
      if (file_exists($target_file)) 
      {
        array_push($message, "Sorry, file already exists.");
        continue;
      }

      // Check file size
      if ($_files["size"][$i] > 500000) 
      {
        array_push($message, "Sorry, your file is too large.");
        continue;
      }

      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
      {
        array_push($message, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        continue;
      }

      if (move_uploaded_file($_files["tmp_name"][$i], $target_file))
      {
        array_push($message, "The file ". htmlspecialchars( basename( $_files["name"][$i])). " has been uploaded.");
        continue;
      } 
      else
      {
        array_push($message, "there was an error uploading your file.");
        continue;
      }

    }
    return $message;
  }
}
$uploadFile = new UploadFile();
?>
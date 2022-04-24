<?php require_once("../includes/templates.php"); ?>
<?php include("../includes/UploadFile.php"); ?>

<?php render("header"); ?>
    <?php
      $uploadErr = "";
      $multiUploadErr = array();

      if(isset($_POST["submit"]))
      {
        $uploadErr = $uploadFile->singleUpload("../uploads/", $_FILES["myFile"]);
        $multiUploadErr = $uploadFile->multiUpload("../uploads/", $_FILES["myFiles"]);
      }
    ?>
      
    <form action="#" method="post" enctype="multipart/form-data">

      <!-- Single File Upload Start -->
      <h5>Single File Upload</h5>

      <div class="input-group">
        <input type="file" name="myFile" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
        <button type="submit" name="submit" class="btn btn-outline-primary" id="inputGroupFileAddon04">Upload</button>
      </div>

      <?php echo "<div>" . $uploadErr . "</div>" ?>
      <!-- Single File Upload End -->

      <br/><br/>
      
      <!-- Multi File Upload Start -->
      <h5>Multi File Upload</h5>

      <form action="#" method="post" enctype="multipart/form-data">
      <div class="input-group">
        <input type="file" name="myFiles[]" multiple class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
        <button type="submit" name="submit" class="btn btn-outline-primary" id="inputGroupFileAddon04">Upload</button>
      </div>

      <?php if($multiUploadErr !== null)foreach($multiUploadErr as $err) echo "<div>" . $err . "</div>"; ?>
      <!-- Multi File Upload End -->
    </form>
    
<?php render("footer"); ?>
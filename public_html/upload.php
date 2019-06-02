<?php
include "opendb.php";
include "rollgen.php";
include "dbstuff.php";

writehead("UPLOAD FILE",$conn,"upload",0);


$content = "Uploaded ".basename($_FILES["fileToUpload"]["name"]);
	
	divmaker(20,20,70,39,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);

$content = "Converting";
	
	divmaker(20,40,70,39,"white","blue","1","font-size: 200%;
text-align: center;" 
,$content);



$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit"])) 
{
   
        $uploadOk = 1;
    }  

move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

sessupdate($conn,"uploadfile","'".$target_file."'");
	
?>
<script type="text/javascript">

window.location.href = "convxml2.php";

</script>

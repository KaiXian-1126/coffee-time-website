<script src="../javascript/FormValidation.js"></script>
<script src="../javascript/webpage.js"></script>
<?php
require_once('db_config.php');
if(isset($_POST['adID'])){
    //set file store location
    $targetFile = "../img/advertisement/".basename($_FILES['advertisement']['name']);
    //get file extension and store in lowercase
    $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if( $fileExtension == "jpg" ||  $fileExtension || "png" ||  $fileExtension == "jpeg"
    ||  $fileExtension != "gif" ) {
        if(!file_exists($targetFile)){
            move_uploaded_file($_FILES['advertisement']['tmp_name'], $targetFile);
            $sqlinsert = "INSERT INTO `advertisement_list` (`AdID`, `AdImage`) 
                            VALUES (".$_POST['adID'].", '".$_FILES['advertisement']['name']."')";
            $result = mysqli_query($db_conn, $sqlinsert);
            if($result > 0){
                echo "<script>alert('New advertisement successfully added.')</script>";
            }else{
                echo "<script>alert('Failed to add new advertisement.')</script>";
            }
            echo "<script>goto('view_item.php');</script>";
        }else{
            echo "<script>alert('File name existed: Please rename your file.')</script>";
            echo "<script>goto('view_item.php');</script>";
        }
    }else{
        echo "<script>alert('File uploaded is not an image. Only JPG, PNG, and GIF file format accepted.')</script>";
        echo "<script>goto('view_item.php');</script>";
    }
}
if(isset($_POST['itemname'])){
    $id = $_POST['id'];
    $itemname = $_POST['itemname'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $imagename = $_FILES['image']['name'];
    //set file store location
    $targetFile = "../img/coffee/".basename($_FILES['image']['name']);
    //get file extension and store in lowercase
    $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
  
    if( $fileExtension == "jpg" ||  $fileExtension || "png" ||  $fileExtension == "jpeg"
    ||  $fileExtension != "gif" ) {
        if(!file_exists($targetFile)){
            move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
            $sqlinsert = "INSERT INTO `coffeelist` (`ItemID`, `ItemName`, `Brand`, `ItemImage`, `ItemPrice`) 
            VALUES (".$id.", '".$itemname."', '".$brand."', '".$imagename."', ".$price.")";
            $result = mysqli_query($db_conn, $sqlinsert);
            if($result > 0){
                echo "<script>alert('New item successfully added.')</script>";
            }else{
                echo "<script>alert('Failed to add new item.')</script>";
            }
            echo "<script>goto('add_item.php');</script>";
        }else{
            echo "<script>alert('File name existed: Please rename your file.')</script>";
            echo "<script>goto('add_item.php');</script>";
        }
    }else{
        echo "<script>alert('File uploaded is not an image. Only JPG, PNG, and GIF file format accepted.')</script>";
        echo "<script>goto('add_item.php');</script>";
    }
}else{
    $chkid = "SELECT MAX(ItemID) from `coffeelist`";
    $resultid = mysqli_query($db_conn, $chkid);
    $resultrow_id = mysqli_fetch_assoc($resultid);
    $itemid = $resultrow_id['MAX(ItemID)'];
?>
<html>
    <head>
        <title>Add New Item</title>
        <link rel="stylesheet" type="text/css" href="../css/add_item.css">
    </head>
    <body>
    <a class="back" href="view_item.php">Back to View Page</a>
    <div class="form">
        <form method="post" enctype="multipart/form-data" action="add_item.php">
            <h1>Item Form</h1>
            <input type="hidden" name="id" value="<?php echo $itemid +1; ?>">
            <input placeholder="Item Name" class="input" type="text" name="itemname">

            <input placeholder="Brand" class="input" type="text" name="brand">

            <input placeholder="Price" class="input" type="text" name="price">

            <p class="field">Choose an image</p>
            
            <input type="file" name="image">

            <input class="submit" type="submit" value="Submit Form" onclick="return ItemFormValidation();">
        </form>
    </div>
    </body>
</html>
<?php } ?>
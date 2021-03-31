<script src="../javascript/FormValidation.js"></script>
<script src="../javascript/webpage.js"></script>
<?php
require_once('db_config.php');
if(isset($_POST['id'])){
    //for coffee update
    if($_FILES['image']['name'] != ""){ //for image update
        $sqlimage = "SELECT `ItemImage` FROM `coffeelist` WHERE `ItemID` = ".$_POST['id'];
        $result_img = mysqli_query($db_conn, $sqlimage);
        $resultrow_img = mysqli_fetch_assoc($result_img);
        $targetDir = "../img/coffee/";
        $image_location = $targetDir.$resultrow_img['ItemImage'];
        $newImage = $targetDir.basename($_FILES['image']['name']);
        $fileExtension = strtolower(pathinfo($newImage, PATHINFO_EXTENSION));
        if( $fileExtension == "jpg" ||  $fileExtension || "png" ||  $fileExtension == "jpeg"
        ||  $fileExtension != "gif" ) {
            if(!file_exists($newImage)){
                if(file_exists($image_location)){
                    //delete the image
                    unlink($image_location);
                    move_uploaded_file($_FILES['image']['tmp_name'], $newImage);
                    //for sql update
                    $sqlupdate = "UPDATE `coffeelist`
                                SET  `ItemName` = '".$_POST['itemname']."', `Brand` = '".$_POST['brand']."', `ItemImage` = '".$_FILES['image']['name']."', `ItemPrice` = ".$_POST['price']."
                                WHERE `ItemID` = ".$_POST['id'];
                    $result = mysqli_query($db_conn, $sqlupdate);
                    if($result > 0){
                        echo "<script>alert('Update successfully.')</script>";
                    }else{
                        echo "<script>alert('Failed to update item.')</script>";
                    }
                    echo "<script>goto('view_item.php');</script>";
                }else{
                     //unsuccessful to delete
                    echo "<script>alert('Failed to delete existing image.')</script>";
                }
            }else{
                echo "<script>alert('File name existed: Please rename your image file.')</script>";
                echo "<script>goto('view_item.php');</script>";    
            }
        }else{
            echo "<script>alert('File uploaded is not an image. Only JPG, PNG, and GIF file format accepted.')</script>";
            echo "<script>goto('view_item.php');</script>";
        }
    }else{ //for update without image
        $sqlupdate = "UPDATE `coffeelist`
                        SET  `ItemName` = '".$_POST['itemname']."', `Brand` = '".$_POST['brand']."', `ItemPrice` = ".$_POST['price']."
                        WHERE `ItemID` = ".$_POST['id'];
        $result = mysqli_query($db_conn, $sqlupdate);
        if($result > 0){
            echo "<script>alert('Update successfully.')</script>";
        }else{
            echo "<script>alert('Failed to update item.')</script>";
        }
        echo "<script>goto('view_item.php');</script>";
    }
}else if(isset($_POST['adID'])){
    //get previous image to delete
    $sqlimage = "SELECT `AdImage` FROM `advertisement_list` WHERE `AdID` = ".$_POST['adID'];
    $result_img = mysqli_query($db_conn, $sqlimage);
    $resultrow_img = mysqli_fetch_assoc($result_img);
    $targetDir = "../img/advertisement/";
    $image_location = $targetDir.$resultrow_img['AdImage'];
    $newImage = $targetDir.basename($_FILES['advertisement']['name']);
    $fileExtension = strtolower(pathinfo($newImage, PATHINFO_EXTENSION));
    if( $fileExtension == "jpg" ||  $fileExtension || "png" ||  $fileExtension == "jpeg"
    ||  $fileExtension != "gif" ) {
        if(!file_exists($newImage)){
            if(file_exists($image_location)){
                //delete the image
                unlink($image_location);
                move_uploaded_file($_FILES['advertisement']['tmp_name'], $newImage);
                //for advertisement update
                $sqlupdate = "UPDATE `advertisement_list` SET `AdImage` = '".$_FILES['advertisement']['name']."'
                                WHERE  `AdID` = ".$_POST['adID'];
                $result = mysqli_query($db_conn, $sqlupdate);
                if($result > 0){
                    echo "<script>alert('Advertisement successfully updated.')</script>";
                }else{
                    echo "<script>alert('Failed to update advertisement.')</script>";
                }
                echo "<script>goto('view_item.php');</script>";
            }else{
                //unsuccessful to delete
                echo "<script>alert('Failed to delete existing advertisement.')</script>";
            }
        }else{
            echo "<script>alert('File name existed: Please rename your advertisement file.')</script>";
            echo "<script>goto('view_item.php');</script>";
        }
    }else{
        echo "<script>alert('File uploaded is not an image. Only JPG, PNG, and GIF file format accepted.')</script>";
        echo "<script>goto('view_item.php');</script>";
    }
}
else if (isset($_GET['adID'])){ ?>
    <html>
        <head>
            <title>Update Advertisement</title>
            <link rel="stylesheet" type="text/css" href="../css/update_item.css">
        </head>
        <body>
            <a class="back" href="view_item.php">Back to View Page</a>
            <div class="form">
                <h2>Advertisement</h2>
                <p class="guide">Please choose a new file</p>
                <form method="POST" enctype="multipart/form-data" action="update_item.php">
                    <input type="hidden" value="<?php echo $_GET['adID']; ?>" name="adID">
                    <input class="file" type="file" name="advertisement">
                    <input class="submit" type="submit" onclick="return AdvertisementFormValidation();">
                </form>
            </div>
        </body>
    </html>
<?php
}
else if(isset($_GET['itemid'])){
$sql="SELECT * FROM `coffeelist` WHERE `ItemID` = ".$_GET['itemid'];
$result = mysqli_query($db_conn, $sql);
$resultrow = mysqli_fetch_assoc($result);
?>
<html>
<head>
    <title>Update Coffee Information</title>
    <link rel="stylesheet" type="text/css" href="../css/update_item.css">
</head>
<body>
<a class="back" href="view_item.php">Back to View Page</a>
    <div class="form">
        <h2>Coffee Information</h2>
        <form method="POST" enctype="multipart/form-data" action="update_item.php">
            <input type="hidden" name="id" value="<?php echo $_GET['itemid']; ?>">
            <p class="field">Coffee Name</p>
            <input class="input" type="text" name="itemname" value="<?php echo $resultrow['ItemName']; ?>">
            <p class="field">Brand</p>
            <input class="input" type="text" name="brand" value="<?php echo $resultrow['Brand']; ?>">
            <p class="field">Price</p>
            <input class="input" type="text" name="price" value="<?php echo $resultrow['ItemPrice']; ?>">
            <p class="field">Image</p>
            <input class="file" type="file" name="image">
            <div class="action">
                <input class="submit" type="submit" onclick="return UpdateFormValidation();">
            </div>
        </form>
    </div>
</body>

</html>
<?php } ?>
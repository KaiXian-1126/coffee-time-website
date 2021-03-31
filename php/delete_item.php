<script src="../javascript/webpage.js"></script>
<?php
require_once('db_config.php');
if(isset($_GET['itemid'])){
    //delete image file
    $sql = "SELECT `ItemImage` FROM `coffeelist` WHERE `ItemID` = ".$_GET['itemid'];
    $result_image = mysqli_query($db_conn, $sql);
    $resultrow_image = mysqli_fetch_assoc($result_image);
    $imageName = $resultrow_image['ItemImage'];
    $imageLocation = "../img/coffee/".$imageName;
    if(file_exists($imageLocation)){
        //delete image file
        unlink($imageLocation);
        $sqldelete="DELETE FROM `coffeelist` WHERE `ItemID` = ".$_GET['itemid'];
        $result = mysqli_query($db_conn, $sqldelete);
        if($result > 0){
            echo "<script>alert('Item deleted.')</script>";
        }else{
            echo "<script>alert('Failed to delete item.')</script>";
        }
        echo "<script>goto('view_item.php')</script>";
    }else{
        echo "<script>alert('Image file unable to delete.')</script>";
    }
}else if(isset($_GET['adID'])){
    //delete image file
    $sql = "SELECT `AdImage` FROM `advertisement_list` WHERE `AdID` = ".$_GET['adID'];
    $result_image = mysqli_query($db_conn, $sql);
    $resultrow_image = mysqli_fetch_assoc($result_image);
    $imageName = $resultrow_image['AdImage'];
    $imageLocation = "../img/advertisement/".$imageName;
    if(file_exists($imageLocation)){
        //delete image file
        unlink($imageLocation);
        $sqldelete="DELETE FROM `advertisement_list` WHERE `AdID` = ".$_GET['adID'];
        $result = mysqli_query($db_conn, $sqldelete);
        if($result > 0){
            echo "<script>alert('Advertisement deleted.')</script>";
        }else{
            echo "<script>alert('Failed to delete advertisement.')</script>";
        }
        echo "<script>goto('view_item.php')</script>";
    }else{
        echo "<script>alert('Advertisement image file unable to delete.')</script>";
    }
}


?>

<script src="../javascript/FormValidation.js"></script>
<script src="../javascript/webpage.js"></script>
<script src="../javascript/searching.js"></script>
<?php 
require_once('db_config.php');
$sql = "SELECT * FROM `coffeelist`";
$result = mysqli_query($db_conn, $sql);
$counter = 1;

$sqlAd = "SELECT * FROM `advertisement_list`";
$resultAd = mysqli_query($db_conn, $sqlAd);
$chkmax = "SELECT MAX(AdID) FROM `advertisement_list`";
$result_max = mysqli_query($db_conn, $chkmax);
$resultrow_max = mysqli_fetch_assoc($result_max);
$adNextID = $resultrow_max['MAX(AdID)'] + 1;
?>
<html>
    <head>
        <title>Item List</title>
        <link rel="stylesheet" type="text/css" href="../css/table.css">
        <link rel="stylesheet" type="text/css" href="../css/view_item.css">
    </head>
    <body>
        <a class="back" href="../index.php">Back to Main Page</a>
        <!-- Advertisement list-->
        <h1>Advertisement List</h1>
        <table>
            <tr>
                <th>No</th>
                <th>Advertisement</th>
                <th colspan="2">Action</th>
            </tr>
            <?php $addCounter = 0;  
                while($counter <= 3){ 
               $resultrowAd = mysqli_fetch_assoc($resultAd);
                ?>
            <tr>
                <td><?php echo $counter; ?></td>
                <?php if($resultrowAd['AdImage'] == ""){ ?>
                <form action="add_item.php" method="POST" enctype="multipart/form-data" onsubmit="return AdvertisementFormValidation(<?php echo $addCounter; ?>);">
                        <input type="hidden" name="adID" value="<?php echo $adNextID; ?>">
                    <td>
                        <input class="file" type="file" name="advertisement">
                    </td>
                    <td colspan="2">
                        <input class="action" type="submit" value="Add">
                    </td>
                </form>
                <?php $addCounter++; }else{ ?>
                <td>
                    <img class="ad-img" src="<?php echo '../img/advertisement/'.$resultrowAd['AdImage']; ?>" alt="Empty Advertisement">
                </td>
                <td>
                    <a class="action" href="update_item.php?adID=<?php echo $resultrowAd['AdID']; ?>" >Update</a>
                </td>
                <td>
                    <a class="action" href="delete_item.php?adID=<?php echo $resultrowAd['AdID']; ?>" >Delete</a>
                </td>
                <?php } ?>
            </tr>
            <?php $counter++; }
                $counter = 1;
            ?>
        </table>
        <!-- coffee list-->
        <h1>Coffee List</h1>
        <!-- develop search function -->
        <div class="search-bar">
            <input type="text" name="search-item" placeholder="Search" onkeyup="searchItem();">
        </div>
        <table class="coffee-list">
        <tr>
            <th>No</th>
            <th>Coffee Name</th>
            <th>Coffee Brand</th>
            <th>Image</th>
            <th>Price</th>
            <th colspan="2">Action</th>
        </tr>
        <?php while($resultrow = mysqli_fetch_assoc($result)){ ?>
        <tr class="item-info">
            <td><?php echo $counter; ?></td>
            <td class="item-name"><?php echo $resultrow['ItemName']; ?></td>
            <td><?php echo $resultrow['Brand']; ?></td>
            <td><img class="coffee-img" src="<?php echo '../img/coffee/'.$resultrow['ItemImage']; ?>"></td>
            <td><?php echo "RM ".$resultrow['ItemPrice']; ?></td>
            <td><a class="action" href="update_item.php?itemid=<?php echo $resultrow['ItemID']; ?>">Update</a></td>
            <td><a class="action" href="delete_item.php?itemid=<?php echo $resultrow['ItemID']; ?>">Delete</a></td>
        </tr>
        <?php $counter++; } ?>    
        </table>
        <a class="add-link" href="add_item.php">Add New Item</a>
        

    </body>
</html>
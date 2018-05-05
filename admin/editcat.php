<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        echo "<script>window.location = 'catlist.php';</script>";
       //header("Location:catlist.php");
    } else {
       $id = $_GET['catid'];
    }
?>

<div class="grid_10">	
<div class="box round first grid">
<h2>Update Category</h2>
<div class="block copyblock"> 

<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $name = mysqli_real_escape_string($db->link, $name);

        if ($name == "") {
            echo "<span style = 'color:red;font-size:18px;'>Field must not be empty !!!</span>";
        } else {
            $query = "UPDATE tbl_category
            SET
            name = '$name'
            WHERE id = '$id'";
           $update_row = $db->update($query);
           if ($update_row) {
               echo "<span style = 'color:green;font-size:18px;'>Category Updated Successfully !!!</span>";
           } else {
                echo "<span style = 'color:red;font-size:18px;'>Category Not Updated !!!</span>";
           }
        }
    }

?>

    <?php 
        $query = "SELECT * FROM  tbl_category WHERE id = '$id' order by id DESC";
        $category = $db->select($query);
        if ($category) {
        while ($result = $category->fetch_assoc()) {
    ?>


 <form action="" method="post">
    <table class="form">					
        <tr>
            <td>
                <input type="text" name = "name" value="<?php echo $result['name'];?>" class="medium" />
            </td>
        </tr>
		<tr> 
            <td>
                <input type="submit" name="submit" Value="Save" />
            </td>
        </tr>
    </table>
    </form>

    <?php } } ?>
</div>
</div>
</div>
<?php include 'inc/footer.php';?>

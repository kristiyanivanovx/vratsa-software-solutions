<?php

/**
 * @var object $connection
 */
include '../../includes/header.php';

$read_query = "SELECT p.product_id, p.product_name, p.product_image, p.product_price, pc.product_category_name, p.product_calories, p.date_deleted
               FROM recipes.`products` AS p 
               JOIN recipes.product_categories AS pc on p.product_category_id = pc.product_category_id 
               WHERE p.date_deleted IS NULL";

$result = mysqli_query($connection, $read_query);

if (mysqli_num_rows($result) > 0) {?>
    <h1>Product List | <span><a href="create.php" class="btn btn-info">Add New Product</a></span> |
        <a href="recycle_bin.php" class="btn btn-outline-dark">Recycle Bin</a></h1>
    <table style="margin-left: 50px" class="table table-striped">
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Image</td>
            <td>Price</td>
            <td>Calories</td>
            <td>Product Category Name</td>
            <td>Update</td>
            <td>Soft Delete</td>
            <td>Download Image</td>
        </tr>
		<?php
		$num = 1;
		while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $num++ ?></td>
                <td><?= $row['product_name'] ?></td>
                <td>
                    <?php if (isset($row['product_image'])) { ?>
                        <img src="<?= $row['product_image'] ?>" alt="" width="100">
                    <?php } ?>
                </td>
                <td><?= $row['product_price'] ?></td>
                <td><?= $row['product_calories'] ?></td>
                <td><?= $row['product_category_name'] ?></td>
                <td><a href="update.php?id=<?= $row['product_id'] ?>" class="btn btn-warning">Update</a></td>
                <td><a href="soft_delete.php?id=<?= $row['product_id'] ?>" class="btn btn-danger">Soft&nbsp;Delete</a></td>
                <td>
					<?php if (isset($row['product_image']) && ($row['product_image'] != "") )  {?>
                        <a href="download.php?id=<?= $row['product_id'] ?>" class="btn btn-success">Download&nbsp;Image</a>
					<?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } else {
    echo"<h1>Product List | <span><a href=\"create.php\" class=\"btn btn-info\">Add New Product</a></span> |";
    echo"<a href=\"recycle_bin.php\" class=\"btn btn-outline-dark\">Recycle Bin</a></h1>";
	echo "No Data";

    //die('Query failed!' . mysqli_error($connection));
}

// one or the other

//} else if ((mysqli_num_rows($result) === 0)) {
//    echo "no data"
//}

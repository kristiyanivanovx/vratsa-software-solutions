<?php

/**
 * @var object $connection
 */
include('partials/database_connection.php');
include('partials/header.php');

// paging stuff
$results_per_page = 4;
if (isset($_GET['page'])) { $page = $_GET['page']; }
else { $page = 1; }

// filtering stuff
$filter = '';
$filters_link_for_pagination = '';
if (!empty($_GET['message_name'])) {
    $msg_name = $_GET['message_name'];
	$filter .= " AND b.name like '%$msg_name%'";
}
if (!empty($_GET['message_age'])) {
	$msg_age = $_GET['message_age'];
	$filter .= " AND b.age like '%$msg_age%'";
}

$get_total_records_query = "SELECT COUNT(*) as count FROM zaici.bunnies AS b WHERE (date_deleted IS NULl $filter)";
$result_query = mysqli_query($connection, $get_total_records_query);

$total_rows = mysqli_fetch_array($result_query);
$total_rows = $total_rows[0];

$offset = ($page - 1) * $results_per_page;

// descending ascending ordering emails and names
$order = '';
$order_param = 'name';
if (!empty($_GET['order_option_names'])) {
	$order = $_GET['order_option_names'];
	$order_param = 'name';
}
if (!empty($_GET['order_option_ages'])) {
	$order = $_GET['order_option_ages'];
	$order_param = 'age';
}

$pagination_string_ordering = '';
if ($total_rows > $results_per_page) {
	$pagination_string_ordering = " ORDER BY $order_param $order LIMIT $results_per_page OFFSET $offset";
}

$max_pages = ceil($total_rows / $results_per_page );

?>

<div class="container fluid padding">
    <h1>CRUD</h1>
    <h2>All entries</h2>
    <a href="create.php" class="btn btn-success">Create</a>
    <a href="recycle.php" class="btn btn-secondary">Recycle Bin</a>
    <br><br>

    <?php
    // get the entity, it's products and it's categories
    $read_query = "SELECT b.bunny_id, b.name, b.age, bc.name as bc_name, b.date_created 
                   FROM zaici.`bunnies` as b 
                   LEFT JOIN zaici.bunny_categories as bc on bc.category_id = b.category_id
                   WHERE b.`date_deleted` IS NULL $pagination_string_ordering $filter";
    $result = mysqli_query($connection, $read_query);

    if (mysqli_num_rows($result) > 0) { ?>
        <table class='table table-bordered'>
            <thead>
            <tr>
            <th>Id</th>
            <div class="form-group col-lg-4">
                <form action="index.php" method="get" accept-charset="utf-8">
                    <div class="input-group-prepend">
                        <input class="form-control" type="text" name="message_name" id="message_name" placeholder="Search by name">
                        <input class="btn btn-outline-dark" type="submit" value="Apply">
                    </div>
                    <div class="input-group-prepend">
                        <input class="form-control" type="text" name="message_age" id="message_age" placeholder="Search by age">
                        <input class="btn btn-outline-dark" type="submit" value="Apply">
                    </div>
                    <div class="input-group-prepend">
                        <select class="form-control" name="order_option_names">
                            <option value="asc">Ascending order - names</option>
                            <option value="desc">Descending order - names</option>
                            <input class="btn btn-outline-dark" type="submit" value="Apply">
                        </select>
                    </div>
                    <div class="input-group-prepend">
                        <select class="form-control" name="order_option_ages">
                            <option value="asc">Ascending order - age</option>
                            <option value="desc">Descending order - age</option>
                            <input class="btn btn-outline-dark" type="submit" value="Apply">
                        </select>
                    </div>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Category Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </form>
            </div>
        </tr>
        </thead>
        <tbody>
        <?php
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
                echo "<td>{$row['bunny_id']}</td>";
                echo "<td>{$row['name']}</td>";
			    echo "<td>{$row['age']}</td>";
			    echo "<td>{$row['bc_name']}</td>";
                echo "<td>{$row['date_created']}</td>";
                echo "<td>
                    <a href='update.php?message_id={$row['bunny_id']}' class='btn btn-sm btn-info'>Update</a>
                    <a href='soft_delete.php?message_id={$row['bunny_id']}' class='btn btn-sm btn-warning'>Soft&nbsp;Delete</a>
                </td>";
            echo "</tr>";
        }
		?>
        </tbody>
        </table>
        <p>
        <?php
            // paging
		    $disabled_or_not_for_previous = ($page == 1) ? 'disabled' : '';
		    if ($page > 1) { ?>
                <a class="btn btn-sm btm-primary <?= $disabled_or_not_for_previous; ?>"
                   href="index.php?page=<?= $page - 1; ?>"><-Previous</a>
			<?php } else { ?>
                <a class="btn btn-sm btm-primary <?= $disabled_or_not_for_previous; ?>"
                   href="index.php?page=1"><- Previous</a>
            <?php }

            for ($i = 1; $i <= $max_pages; $i++) {
                echo "<a class=\"btn btn-sm btn-outline-dark\" href='index.php?page=$i'>$i</a>";
            }

		    $disabled_or_not_for_next = ($page >= $max_pages) ? 'disabled' : '';
		    if ($page < $max_pages) { ?>
                <a class="btn btn-sm btm-primary <?= $disabled_or_not_for_next; ?>"
                   href="index.php?page=<?php echo $page + 1; ?>">Next -></a>
            <?php } else { ?>
                <a class="btn btn-sm btm-primary <?= $disabled_or_not_for_next; ?>"
                   href="index.php?page=<?php echo $page; ?>">Next -></a>
            <?php }
		    // paging end
		?>
    </p>
	<?php } else {
        echo "Няма намерени резултати.";
    } ?>
</div>

<?php

include ('partials/footer.php');

?>

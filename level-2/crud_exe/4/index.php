<?php
/**
 * @var object $connection
 */
include('partials/database_connection.php');
include('partials/header.php');
?>

<div class="container fluid padding">
    <h1>All Towns</h1>

    <a href="create.php" class="btn btn-success">Create</a>
    <br><br>
<?php
    $read_query = "SELECT * FROM academy.towns ORDER BY `TownID` DESC";
    $result = mysqli_query($connection, $read_query);

    if (mysqli_num_rows($result) > 0)
    {
        echo "<table class='table table-bordered'>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>TownID</th>";
                echo "<th>Name</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while($row = mysqli_fetch_assoc($result)){
			echo "<tr>";
                echo "<td>{$row['TownID']}</td>";
                echo "<td>{$row['Name']}</td>";

                echo "<td>
                    <a href='update.php?id={$row['TownID']}' class='btn btn-sm btn-primary'>Update</a>
                    <a href='delete.php?id={$row['TownID']}' class='btn btn-sm btn-danger'>Delete</a>
                </td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else{
        echo "Няма намерени резултати.";
    }

echo "</div>";

include ('partials/footer.php');

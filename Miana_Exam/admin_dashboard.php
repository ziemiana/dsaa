<?php 
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
}
include('database/connection.php');

$search_query = '';
if (isset($_GET['search'])) {
    $search_query = $conn->real_escape_string($_GET['search']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN DASHBOARD</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container">
        <h2>Welcome Admin</h2>
        <?php echo $_SESSION['username'];?><br>
        <a href="logout.php" class="logout">LOGOUT</a><br><br>

        <!-- Search Form -->
        <form action="" method="get">
            <input type="text" name="search" placeholder="Search by username" value="<?php echo $search_query;?>">
            <input type="submit" value="Search">
        </form><br>

        <!-- Table to Display User Records -->
        <table>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php
            if (!empty($search_query)) {
                $sql = "SELECT * FROM users WHERE role='client' AND username LIKE '%$search_query%'";
            } else {
                $sql = "SELECT * FROM users WHERE role = 'client'";
            }
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $count = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>$count</td>";
                    echo "<td>".$row['username']."</td>";
                    echo "<td>".$row['firstname']."</td>";
                    echo "<td>".$row['lastname']."</td>";
                    echo "<td>".$row['role']."</td>";
                    echo "<td>";
                    echo "<a href='edit_client.php?ID=".$row['ID']."' style='color:#4b0082;'>Edit</a> | ";
                    echo "<a href='delete_client.php?ID=".$row['ID']."' onclick='return confirm(\"Are you sure you want to delete this client?\");' style='color:#b22222;'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                    $count++;
                }
            } else {
                echo "<tr><td colspan='6'>NO RECORDS FOUND!</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

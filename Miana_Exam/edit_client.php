<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['role']!='admin'){
    header("Location: index.php");
    exit();
}
//include connection string
include ('database/connection.php');

//client ID is provided in the URL
if(isset($_GET['ID'])){
    $client_ID= $_GET['ID'];
    //fetch current client data
    $sql = "SELECT * FROM users WHERE ID =  '$client_ID'";
    $result = $conn->query($sql);
    //check the client is exists
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $role = $row['role'];
    }
}
else{
    header("Location: admin_dashboard.php");
}

    //update function
    if(isset($_POST['update'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $role = $_POST['role'];

        //update the user data in the database using sql
        $update_sql = "UPDATE users SET
        firstname = '$firstname', 
        lastname = '$lastname', 
        role = '$role' 
        WHERE ID = '$client_ID'";

        if($conn->query($update_sql) === TRUE){
            header("Location: admin_dashboard.php?updatesuccess");
        }
        else{
            echo "Error Updating Client Data" . $conn->error;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT PAGE</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <h2>Edit Client Information</h2>
    <form action="" method="post">
        Firstname
        <input type="text" name="firstname" id="" required value="<?php echo $firstname; ?>"> <br><br>
        Lastname
        <input type="text" name="lastname" id="" required value="<?php echo $lastname; ?>"> <br><br>
        Role
        <select name="role" id="">
            <option value="client" <?php if($role == 'client') echo 'selected'?>>Client</option>
            <option value="admin" <?php if($role == 'admin') echo 'selected'?>>Admin</option>
        </select><br><br>
        <input type="submit" value="Update Record" name="update">
        <br><br>
    </form>
    <a href="admin_dashboard.php">Back to Admin Dashboard</a>
</body>
</html>
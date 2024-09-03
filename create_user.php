<?php
include 'connection.php'; // Include the connection script

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO contacts (name, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $email); // Bind parameters

    try {
        $stmt->execute();
        echo "User created successfully";
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) { // Error code for duplicate entry
            $error_message = "Username already exists. Please choose a different one.";
        } else {
            $error_message = "Error: " . $stmt->error;
        }
    }

    $stmt->close(); // Close statement
}
$conn->close(); // Close connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Create User</h1>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Create</button>
	    </form>
        <?php
        if ($error_message) {
            echo "<p style='color:red;'>$error_message</p>";
        }
?>
	<a href="index.html">Back to CRUD Options</a>
    </div>
</body>
</html>

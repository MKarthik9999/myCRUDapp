<?php
include 'connection.php'; // Include the connection script

$sql = "SELECT id, name FROM contacts";
$result = $conn->query($sql);

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $email = $_POST['email'];

    // Prepare SQL statement
    $stmt = $conn->prepare("UPDATE contacts SET email = ? WHERE id = ?");
    $stmt->bind_param("si", $email, $id); // Bind parameters

    // Execute and check for success
    try {
        $stmt->execute();
        echo "User updated successfully";
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
    <title>Update User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Update User</h1>
        <form method="POST" action="">
            <select name="id" required>
                <option value="">Select User</option>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                    }
                }
                ?>
            </select>
            <input type="email" name="email" placeholder="New Email" required>
            <button type="submit">Update</button>
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


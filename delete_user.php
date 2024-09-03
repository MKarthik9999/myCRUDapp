<?php
include 'connection.php'; // Include the connection script

$sql = "SELECT id, name FROM contacts";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Prepare SQL statement
    $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->bind_param("i", $id); // Bind parameter

    // Execute and check for success
    if ($stmt->execute()) {
        echo "User deleted successfully";
    } else {
        echo "Error: " . $stmt->error;
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
    <title>Delete User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Delete User</h1>
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
            <button type="submit">Delete</button>
        </form>
        <a href="index.html">Back to CRUD Options</a>
    </div>
</body>
</html>

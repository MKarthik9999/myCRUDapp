<?php
include 'connection.php'; // Include the connection script

$sql = "SELECT id, name, email FROM contacts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Name: " . $row["name"] . " - Email: " . $row["email"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close(); // Close connection
echo '<a href="index.html">Back to CRUD Options</a>';
?>


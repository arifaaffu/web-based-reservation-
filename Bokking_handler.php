<?php
// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    // Prepare SQL statement to insert data into the bookings table
    $sql = "INSERT INTO bookings (name, email, date, time) VALUES ('$name', '$email', '$date', '$time')";

    if ($conn->query($sql) === TRUE) {
        echo "Thank you for booking a table. We'll contact you shortly to confirm.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch booked list
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Booked List</h2>";
    echo "<table><tr><th>Name</th><th>Email</th><th>Date</th><th>Time</th></tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["date"]."</td><td>".$row["time"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "No bookings yet.";
}

// Close database connection
$conn->close();
?>

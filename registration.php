<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "rentmycar";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching data from the form
$title = isset($_POST['title']) ? $_POST['title'] : '';
$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
$lname = isset($_POST['lname']) ? $_POST['lname'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$confirm_password = isset($_POST['confirm-password']) ? $_POST['confirm-password'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$postcode = isset($_POST['postcode']) ? $_POST['postcode'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

// Proceed with database insertion
$sql = "INSERT INTO users (title, first_name, last_name, username, password, confirm_password, address, postcode, city, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

// Bind parameters to the statement
$stmt->bind_param("ssssssssss", $title, $fname, $lname, $username, $password, $confirm_password, $address, $postcode, $city, $email);

// Execute the statement
if ($stmt->execute()) {
    // Retrieve the last inserted ID
    $last_id = $conn->insert_id;
    echo "User registered successfully. Last inserted ID is: " . $last_id;

    // Display the registration details in a table
    ?>
    <table style="border: 2px solid blue; width: 90%;">
        <tr>
            <th> Title </th>
            <th> First Name </th>
            <th> Last Name </th>
            <th> Username </th>
            <th> Password </th>
            <th> Confirm Password </th>
            <th> Address </th>
            <th> Postcode </th>
            <th> City </th>
            <th> Email </th>
        </tr>
        <tr>
            <td><?php echo $title; ?></td>
            <td><?php echo $fname; ?></td>
            <td><?php echo $lname; ?></td>
            <td><?php echo $username; ?></td>
            <td><?php echo $password; ?></td>
            <td><?php echo $confirm_password; ?></td>
            <td><?php echo $address; ?></td>
            <td><?php echo $postcode; ?></td>
            <td><?php echo $city; ?></td>
            <td><?php echo $email; ?></td>
        </tr>
    </table>
    <?php
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>

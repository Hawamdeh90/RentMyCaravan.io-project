
<!DOCTYPE html>
<html lang="en">
<head>
 <link rel="stylesheet" href="style.CSS"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentMyCaravan.io</title>
    <link rel="icon" type="favicon" href="favicon.jpg">
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "rentmycar";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else{
     // Set parameters and execute
     $vehicle_make = $_POST['vehicle_make'];
     $vehicle_model = $_POST['vehicle_model'];
     $vehicle_bodytype = $_POST['vehicle_bodytype'];
     $fuel_type = $_POST['fuel_type'];
     $mileage = $_POST['mileage'];
     $location = $_POST['location'];
     $year = $_POST['year'];
     $num_doors = $_POST['num_doors'];
     $image_url = $_POST['image_url']; 

     // Debugging
        var_dump($vehicle_make, $vehicle_model, $vehicle_bodytype, $fuel_type, $mileage, $location, $year, $num_doors, $image_url);

        // Prepare and bind the insert statement
        $stmt = $conn->prepare("INSERT INTO vehicle_details (vehicle_make, vehicle_model, vehicle_bodytype, fuel_type, mileage, location, year, num_doors, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssisiss", $vehicle_make, $vehicle_model, $vehicle_bodytype, $fuel_type, $mileage, $location, $year, $num_doors, $image_url);

   

   // $stmt->execute();

        if ($stmt->execute()) {
        echo '<script>alert("New records inserted successfully");</script>';
        echo '<script>setTimeout(function() { window.location.href = "newCaravan.html"; }, 3000);</script>';
     } else {
         echo "Error: " . $stmt->error;
    }


    

    $stmt->close();
    $conn->close();
    }
}

?>

</body>
</html>
<?php



// #set your server name, in this case i user localhost instead
$servername = "";

// #enter your database information
$dbname = "YOUR DATABASE NAME";
$username = "YOUR DATABASE USERNAME";
$password = "YOUR DATABASE PASSWORD";


// #you can change this api key as you wish, but make sure to enter the same api key in your python or etc
$api_key_value = "9F7j3bA5TAmPt";

// #setup variable to store input
$api_key= $latitude = $longitude = $dhtA = $dhtB = $adxlA = $adxlB = $iduser = $status = "";

// #create connection to table and column in mysql
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $latitude = test_input($_POST["latitude"]);
        $longitude = test_input($_POST["longitude"]);
        $dhtA = test_input($_POST["dhtA"]);
        $dhtB = test_input($_POST["dhtB"]);
        $adxlA = test_input($_POST["adxlA"]);
        $adxlB = test_input($_POST["adxlB"]);
        $iduser = test_input($_POST["iduser"]);
        $status = test_input($_POST["status"]);
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
//         #insert data into database use your variable, make sure you enter same variable name in your python /etc
        $sql = "INSERT INTO data (latitude, longitude, dhtA, dhtB, adxlA,adxlB,iduser,status)
        VALUES ('" . $latitude . "', '" . $longitude . "', '" . $dhtA . "', '" . $dhtB . "', '" . $adxlA . "', '" . $adxlB . "', '" . $iduser. "', '" . $status. "')";
//         #show message when connection succesfully created
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        //         #show message when connection failed to create
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

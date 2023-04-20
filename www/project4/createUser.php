<?php
session_start();

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the input
    if (empty($username) || empty($password)) {
        echo "Username and password are required";
    } else {
        // Set the API URL and parameters
        $apiUrl = "http://localhost/User.php";
        $apiParams = array("username" => $username, "password" => $password);

        // Initialize a cURL session
        $curl = curl_init();

        // Set the cURL options
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($apiParams));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request and get the response
        $response = curl_exec($curl);

        // Close the cURL session
        curl_close($curl);

        // Decode the response as an associative array
        $result = json_decode($response, true);

        // Check if there is an error in the result
        if (isset($result['error'])) {
            echo $result['error'];
        } else {
            // Print the user id and the API key
            echo "User created successfully. Id: " . $result['id'] . ", API key: " . $result['api_key'];
        }
    }
}

?>
<html lang="en">
<head>
    <title>Create User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<?php include 'navbar.php';?>
<body class="container">
    <h1>Create your user account:</h1>
    <form action="User.php" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <input type="submit" name="submit" value="Create User" class="btn btn-primary">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>

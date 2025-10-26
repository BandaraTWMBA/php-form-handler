<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Submission Result</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Form Submission Result</h1>
    
    <?php
    // --- 1. Check for GET Request ---
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['name'])) {
        // Data has been submitted via GET
        $name = htmlspecialchars($_GET['name']); // Sanitize the input
        echo "<p class='success'>Data received via **GET** method!</p>";
        echo "<p>Hello, **$name**! Your data was passed in the URL.</p>";
        
    } 
    
    // --- 2. Check for POST Request ---
    elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
        // Data has been submitted via POST
        $name = htmlspecialchars($_POST['name']); // Sanitize the input
        echo "<p class='success'>Data received via **POST** method!</p>";
        echo "<p>Hello, **$name**! Your data was passed in the request body.</p>";
        
    } 
    
    // --- 3. Handle No Submission/Direct Access ---
    else {
        // No valid data submitted or page accessed directly without a form submission
        echo "<p class='error'>No valid form data received.</p>";
        echo "<p>Please return to the form and submit your information.</p>";
    }
    ?>

    <p><a href="index.html">Go back to the form</a></p>

</body>
</html>
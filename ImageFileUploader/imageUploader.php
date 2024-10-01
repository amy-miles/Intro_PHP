<?php
// Storage folder
$hostImageFolder = "uploads/";


$successMessage = "";
$fileNameDisplay = "";
$imageHolder = "";
$messageClass = "";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if the file was uploaded without errors
    if (isset($_FILES["inFile"]) && $_FILES["inFile"]["error"] == 0) {

        // Get the file name and path
        $fileName = basename($_FILES["inFile"]["name"]);
        $hostImagePath = $hostImageFolder . $fileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["inFile"]["tmp_name"], $hostImagePath)) {
            // Store success message and image
            $successMessage = "Success! The image has been uploaded.";
            $fileNameDisplay = "File name: $fileName";
            $imageHolder = "<img src='$hostImagePath' style='max-width: 200px;' />";
            $messageClass = "success";
        } else {
            // Store error message if the file couldn't be moved
            $successMessage = "Error! The file could not be uploaded.";
            $messageClass = "error"; // Use "error" class for red color
        }
    } else {
        // Store error message if there was an issue with the upload
        $successMessage = "Error! No file uploaded or file upload error.";
        $messageClass = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: black;
            margin: 0;
        }

        #success {
            width: 90%;
            max-width: 400px;
            margin: 20px auto;
            background-color: #FFCCFF;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            font-family: 'Calibri', sans-serif;
            color: dimgray;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>

    <div id="success">
        <p id="success_message" class="<?php echo $messageClass; ?>"><?php echo $successMessage; ?></p> 
        <p id="file_name"><?php echo $fileNameDisplay; ?></p>
        <p id="image_holder"><?php echo $imageHolder; ?></p>
    </div>

</body>

</html>
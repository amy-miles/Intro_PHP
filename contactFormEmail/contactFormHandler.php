<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Handler</title>
    <style>
                body {
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Calibri', sans-serif;
            color: white;
        }

        .container {
            width: 90%;
            max-width: 400px;
            margin: auto;
            background-color: #FFCCFF;
            padding: 20px;
            border-radius: 15px;
            font-family: 'Calibri', sans-serif;
            color: dimgray;
            text-align: center;
            border: 1px solid darkgrey;           
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #6b6b6b;
        }

        p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>

<body>
    <?php
    $to = "amy@amymiles.info";
    $subject = "New inquiry via your website contact form!";
    $date = date("m/d/Y");

    $name = htmlspecialchars(trim($_POST["name"]), ENT_QUOTES, 'UTF-8');
    $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $reason = htmlspecialchars(trim($_POST["reason"]), ENT_QUOTES, 'UTF-8');
    $comments = strip_tags(trim($_POST["comments"]));

    if (empty($name) || empty($email) || empty($reason)) {
        echo "Please fill out all required fields.";
        exit;
    }

    if ($email === false) {
        echo "Invalid email format.";
        exit;
    }

    //message
    $message = "Hi Amy,\n\n";
    $message .= "You've received a new inquiry through your website!\n\n";
    $message .= "Here are the details:\n";
    $message .= "Name: $name\n";
    $message .= "Email: $email\n";
    $message .= "Reason for Contact: $reason\n";
    $message .= "Comments: $comments\n\n";
    $message .= "This inquiry was submitted on $date.";


    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "Your message has been sent successfully!<br>";
    } else {
        echo "There was an error sending your message. Please try again.";
    }


    $subjectCustomer = "Thank you for your inquiry, $name!";
    $messageCustomer = "
<html>
<head>
    <style>
        body {
             background-color: black; /* Matches the form's body background */
            color: dimgray;
            font-family: 'Calibri', sans-serif;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #FFCCFF; /* Matches the form's pink background */
            padding: 20px;
            border-radius: 15px; /* Rounded corners for the box */
            text-align: left; /* Left-align the content for readability */
            border: 1px solid darkgrey; /* Border to match form input styles */
        }
        h2 {
            color: #6b6b6b;
            text-align: center;
        }
        p {
            font-size: 16px;
            margin: 10px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
            text-align: center;
        }
    </style>
</head>


<body>
    <div class='container'>
        <h2>Thank You, $name!</h2>
        <p>We have received your inquiry and will get back to you as soon as possible.</p>
        <p><strong>Reason for Contact:</strong> $reason</p>
        <p><strong>Your Message:</strong></p>
        <p>$comments</p>
        <p class='footer'>This message was submitted on $date.<br>Thank you for reaching out to us!</p>
    </div>
</body>
</html>
";

    // Headers for HTML email
    $headersCustomer = "MIME-Version: 1.0" . "\r\n";
    $headersCustomer .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headersCustomer .= "From: amy@amymiles.info" . "\r\n";
    $headersCustomer .= "Reply-To: amy@amymiles.info" . "\r\n";

    // Send the HTML email to the customer
    if (mail($email, $subjectCustomer, $messageCustomer, $headersCustomer)) {
        echo "A confirmation email has been sent to $email.";
    } else {
        echo "There was an error sending the confirmation email to the customer.";
    }
    ?>


</body>

</html>
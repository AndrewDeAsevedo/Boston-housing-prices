<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize variables
$name = $email = $message = '';
$errors = [];
$success = false;

// Form submission handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate name
    if (empty($_POST['name'])) {
        $errors[] = 'Name is required';
    } else {
        $name = htmlspecialchars(trim($_POST['name']));
    }

    // Validate email
    if (empty($_POST['email'])) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    } else {
        $email = htmlspecialchars(trim($_POST['email']));
    }

    // Validate message
    if (empty($_POST['message'])) {
        $errors[] = 'Message is required';
    } else {
        $message = htmlspecialchars(trim($_POST['message']));
    }

    // If no errors, process the form
    if (empty($errors)) {
        // In a real-world scenario, you would:
        // 1. Connect to a database
        // 2. Insert the message
        // 3. Send an email notification
        // For this example, we'll just set success to true
        $success = true;

        // Optional: Reset form fields
        $name = $email = $message = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Contact - Boston Housing Prices</title>
    <style>
        .contact-form {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .contact-form input, 
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .contact-form .error {
            color: red;
            margin-bottom: 10px;
        }
        .contact-form .success {
            color: green;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <h1>Boston Housing Prices</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="dataset.php">Dataset</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="resources.php">Resources</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1>Contact Us</h1>
        
        <div class="contact-form">
            <?php 
            // Display errors
            if (!empty($errors)) {
                echo '<div class="error">';
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
                echo '</div>';
            }

            // Display success message
            if ($success) {
                echo '<div class="success">';
                echo '<p>Thank you for your message! We will get back to you soon.</p>';
                echo '</div>';
            }
            ?>

            <form method="post" action="contact.php">
                <input type="text" name="name" placeholder="Your Name" value="<?php echo htmlspecialchars($name); ?>" required>
                
                <input type="email" name="email" placeholder="Your Email" value="<?php echo htmlspecialchars($email); ?>" required>
                
                <textarea name="message" placeholder="Your Message" rows="5" required><?php echo htmlspecialchars($message); ?></textarea>
                
                <input type="submit" value="Send Message" class="cta-button">
            </form>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Boston Housing Prices</p>
        <nav>
            <ul>
                <li><a href="privacy.php">Privacy Policy</a></li>
                <li><a href="terms.php">Terms of Use</a></li>
            </ul>
        </nav>
    </footer>
</body>
</html>

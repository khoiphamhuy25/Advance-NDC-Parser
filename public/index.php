<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Advance NDC Parser</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Advance NDC Parser</h1>
    <form id="ndc-form" action="" method="post">
        <label for="ndc-message">Paste NDC Message here</label>
        <textarea id="ndc-message" name="ndc_message"></textarea>
        <button type="submit" name="submit">Parse</button>
    </form>

    <?php
    include('..\src\handler.php');
    if (isset($_POST['submit'])) {
        $handler = new Handler();
        $message = $_POST['ndc_message'];
        echo '<div class="parsed-message">';
        echo '<h2>Parsed Message</h2>';
        echo '<ul>';
        $handler->processMessage($message);
        echo '</ul> </div>';
    }
    ?>
    <script src="app.js"></script>
</body>

</html>
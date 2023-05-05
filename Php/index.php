<!DOCTYPE html>
<html>
    <head>
        <title>Advance NDC Parser</title>
    </head>
    <body>
        <form method="post">
            <label for="input-text">Input Message:</label>
            <input type="text" id="input-text" name="input-text">
            <button type="submit" name="submit">Parse</button>
        </form> <?php if (isset($_POST["submit"])) {
              include "parser.php";
              $input_text = $_POST["input-text"];
              parse($input_text);
    } ?>
    </body>
</html>
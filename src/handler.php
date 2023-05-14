<?php
    include "..\src\parser.php";

    class Handler {

        //The main message processing function.
        public function processMessage($message) {
            $parser = new Parser($message);
            $fields = $parser->getFields();
            if ($fields[0] == "11") {
                $parser->transactionRequest();
            } else {
                echo "Unavailable!<br>";
            }
        }
    }
?>

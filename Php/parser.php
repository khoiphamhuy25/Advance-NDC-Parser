<?php
include "Parser//transactionRequest.php";

function addElement($fields)
{
    if (isset($fields[12]) && substr($fields[12], 0, 1) === "2") {
        $newFields = [];
        for ($i = 0; $i < count($fields); $i++) {
            if ($i == 12) {
                array_push($newFields, "");
            }
            array_push($newFields, $fields[$i]);
        }
        return $newFields;
    } else {
        return $fields;
    }
}

function addFS($message)
{
    $char = chr(28);
    $count = substr_count($message, $char);
    if ($count < 28) {
        $missing_chars = 28 - $count;
        $message .= str_repeat($char, $missing_chars);
        return $message;
    } elseif ($count == 28) {
        return $message;
    } else {
        return "";
    }
}

function parse($message)
{
    $message = addFS($message);
    $fields = explode("", $message);
    $fields = addElement($fields);
    // print_r(addElement($fields));
    // for ($i = 0; $i < count($fields); $i++) {
    //     echo $fields[$i] . " " . $i ."<br>";
    // }
    if ($fields[0] == "11") {
        transactionRequest($fields);
    } elseif ($fields[0] == "12") {
        echo "12";
    } elseif ($fields[0] == "22") {
        echo "22";
    } else {
        echo "........";
    }
}
?>

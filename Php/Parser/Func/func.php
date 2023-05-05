<?php
function abcFields($string)
{
    if (isset($string)) {
        $len = strlen($string);
        if ($len == 3) {
            echo "Field a is " . substr($string, 0, 1) . " - Header. <br>";
            echo "Field b is " .
                substr($string, 1, 1) .
                " - Unsolicited Message. <br>";
            echo "Field c is " .
                substr($string, 2, 1) .
                " - Transaction Request Message. <br>";
        } elseif ($len == 2) {
            echo "Field b is " .
                substr($string, 0, 1) .
                " - Unsolicited Message. <br>";
            echo "Field c is " .
                substr($string, 1, 1) .
                " - Transaction Request Message. <br>";
        } else {
            echo "Error! <br>";
        }
    } else {
        echo "Message doesn't have field a, b and c. <br>";
    }
}

function dField($string)
{
    $len = strlen($string);
    if ($len == 3) {
        if ($string == "000") {
            echo "Field d is 000 - Default LUNO number. <br>";
        } else {
            echo "Field d is " . $string . " - Not a default LUNO number. <br>";
        }
    } elseif ($len == 9) {
        $luno = substr($string, 0, 3);
        echo "Field d is " . $luno . " - LUNO number. <br>";
        if ($len == 15) {
            $machine_num = substr($string, 3, 6);
            echo "Machine number: " . $machine_num . " <br>";
        }
    } else {
        echo "Error! Invalid input for field d. <br>";
    }
}

function eFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field e. <br>";
    } else {
        echo "Field e is " . $string . " - Time Variant Number. <br>";
    }
}

function fgFields($string)
{
    if (strlen($string) == 0) {
        echo "Message doesn't have field f and g. <br>";
    } elseif (strlen($string) == 1) {
        echo "Error! <br>";
    } else {
        $f = substr($string, 0, 1);
        $g = substr($string, 1, 1);
        if ($f == "0") {
            echo "Field f is " . $f . " - Will not print data for this transaction at the top of the receipt. <br>";
        } elseif ($f == "1") {
            echo "Field f is " . $f . " - Will print data for this transaction at the top of the receipt. <br>";
        }
        echo "Field g is " . $g . " - Message Co-Ordination Number. <br>";
    }
}

function hFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field h. <br>";
    } else {
        if (strlen($string) <= 39) {
            echo "Field h is " .
                $string .
                " - Track 2 Data. Contains up to 39 characters of Track 2 data from the start sentinel to the end sentinel inclusive. Characters are in the range 30-3F hex. <br>";
        } else {
            echo "Invalid value for field h. <br>";
        }
    }
}

function iFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field i. <br>";
    } else {
        echo "Field i is: " . $string . "<br>";
    }
}

function jFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field j. <br>";
    } else {
        echo "Field j is: " . $string . "<br>";
    }
}

function kFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field k. <br>";
    } else {
        $field_length = strlen($string);
        if ($field_length != 8 && $field_length != 12) {
            echo "Invalid length for field k. <br>";
        } else {
            $amount = ltrim($string, "0");
            if ($amount == "") {
                $amount = "0";
            }
            echo "Field j is: " . $string . " - Amount entered: $amount <br>";
        }
    }
}

function lFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field l. <br>";
    } else {
        echo "Field l is: " . $string . "<br>";
    }
}

function mFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field m. <br>";
    } else {
        echo "Field m is: " . $string . "<br>";
    }
}

function nFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field n. <br>";
    } else {
        echo "Field n is: " . $string . "<br>";
    }
}

function opFields($message)
{
    if ($message == "") {
        echo "Message doesn't have field o and p. <br>";
    } elseif (strlen($message) == 1) {
        echo "Field o is: " . $message . "<br>";
    } else {
        $field_o = substr($message, 0, 1);
        $field_p = substr($message, 1);
        if ($field_o == "1") {
            echo "Field o is Track 1 Identifier. <br>";
            echo "Field p is Track 1 Data: " . $field_p . "<br>";
        } else {
            echo "Field o is not Track 1 Identifier. <br>";
            echo "Field p is not Track 1 Data: " . $field_p . "<br>";
        }
    }
}

function seperate($r) {
    $len = strlen($r);
    if($len == 36) {
        $ltnd = substr($r, 5, 20);
        $ltcad = substr($r, 25, 5);
        $ltcd = substr($r, 30, 5);
        $ltCd = substr($r, 35, 1);
        if($ltnd == "00000000000000000000") {
            echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, last function command received and processed was not a dispense 
            command.<br>";
        } else {
            echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, defining the notes 
            dispensed on the last transaction<br>";
        }
        echo "4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
        migration purposes only and always contains zeros.<br>";
        echo "5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 001 (more than four hopper types). The Last Transaction
        Coinage Amount Dispensed is provided in fields cf1 to cf<n+1>. <br>";
        echo "6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
        if($ltCd == '0') {
            echo $ltCd . " last transaction was not a cash deposit.<br>";
        } elseif($ltCd == '1') {
            echo $ltCd . " vault direction.<br>";
        } elseif($ltCd == '2') {
            echo $ltCd . " refund direction.<br>";
        }
    } elseif($len == 44) {
        $ltnd = substr($r, 5, 20);
        $ltcad = substr($r, 25, 5);
        $ltcd = substr($r, 30, 5);
        $ltCd = substr($r, 35, 9);
        if($ltnd == "00000000000000000000") {
            echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, last function command received and processed was not a dispense 
            command.<br>";
        } else {
            echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, defining the notes 
            dispensed on the last transaction<br>";
        }
        echo "4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
        migration purposes only and always contains zeros.<br>";
        echo "5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 001 (more than four hopper types). The Last Transaction
        Coinage Amount Dispensed is provided in fields cf1 to cf<n+1>. <br>";
        echo "6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
        if(substr($ltCd, 0, 1) == '0') {
            echo $ltCd . " last transaction was not a cash deposit.<br>";
        } elseif(substr($ltCd, 0, 1) == '1') {
            echo $ltCd . " vault direction.<br>";
        } elseif(substr($ltCd, 0, 1) == '2') {
            echo $ltCd . " refund direction.<br>";
        }
        echo "* Number of recycle cassettes reported: " . substr($ltCd, 1, 2) . "<br>";
        echo "* NDC Cassette Type: " . substr($ltCd, 3, 3) . "<br>";
        echo "* Number of Notes: " . substr($ltCd, 6, 3) . "<br>";
        
    } elseif($len == 56) {
        $ltnd = substr($r, 5, 20);
        $ltcad = substr($r, 25, 5);
        $ltcd = substr($r, 30, 5);
        $ltCd = substr($r, 35, 21);
        if($ltnd == "00000000000000000000") {
            echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, last function command received and processed was not a dispense 
            command.<br>";
        } else {
            echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, defining the notes 
            dispensed on the last transaction<br>";
        }
        echo "4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
        migration purposes only and always contains zeros.<br>";
        echo "5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 001 (more than four hopper types). The Last Transaction
        Coinage Amount Dispensed is provided in fields cf1 to cf<n+1>. <br>";
        echo "6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
        if(substr($ltCd, 0, 1) == '0') {
            echo $ltCd . " last transaction was not a cash deposit.<br>";
        } elseif(substr($ltCd, 0, 1) == '1') {
            echo $ltCd . " vault direction.<br>";
        } elseif(substr($ltCd, 0, 1) == '2') {
            echo $ltCd . " refund direction.<br>";
        }
        echo "* Number of Notes Refunded during last transaction: " . substr($ltCd, 1, 5) . "<br>";
        echo "* Number of Notes Rejected during last transaction: " . substr($ltCd, 6, 5) . "<br>";
        echo "* Number of Notes Encashed during last transaction: " . substr($ltCd, 11, 5) . "<br>";
        echo "* Number of Notes to Escrow during last transaction: " . substr($ltCd, 16, 5) . "<br>";
    } elseif($len == 51) {
        if(substr($r, 25, 5) == "00000") {
            $ltnd = substr($r, 5, 20);
            $ltcad = substr($r, 25, 5);
            $ltcd = substr($r, 30, 20);
            $ltCd = substr($r, 50, 1);
            if($ltnd == "00000000000000000000") {
                echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, last function command received and processed was not a dispense 
                command.<br>";
            } else {
                echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, defining the notes 
                dispensed on the last transaction<br>";
            }
            echo "4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
            migration purposes only and always contains zeros.<br>";
            echo "5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 000 (four hopper types). <br>";
            echo "6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
            if(substr($ltCd, 0, 1) == '0') {
                echo $ltCd . " last transaction was not a cash deposit.<br>";
            } elseif(substr($ltCd, 0, 1) == '1') {
                echo $ltCd . " vault direction.<br>";
            } elseif(substr($ltCd, 0, 1) == '2') {
                echo $ltCd . " refund direction.<br>";
            }
        } else {
            $ltnd = substr($r, 5, 35);
            $ltcad = substr($r, 40, 5);
            $ltcd = substr($r, 45, 5);
            $ltCd = substr($r, 50, 1);
            if($ltnd == "00000000000000000000000000000000000") {
                echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, last function command received and processed was not a dispense 
                command.<br>";
            } else {
                echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, defining the notes 
                dispensed on the last transaction<br>";
            }
            echo "4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
            migration purposes only and always contains zeros.<br>";
            echo "5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 001 (more than four hopper types). The Last Transaction
            Coinage Amount Dispensed is provided in fields cf1 to cf<n+1>. <br>";
            echo "6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
            if($ltCd == '0') {
                echo $ltCd . " last transaction was not a cash deposit.<br>";
            } elseif($ltCd == '1') {
                echo $ltCd . " vault direction.<br>";
            } elseif($ltCd == '2') {
                echo $ltCd . " refund direction.<br>";
            }
        }
    } elseif($len == 59) {
        if(substr($r, 25, 5) == "00000") {
            $ltnd = substr($r, 5, 20);
            $ltcad = substr($r, 25, 5);
            $ltcd = substr($r, 30, 20);
            $ltCd = substr($r, 50, 9);
            if($ltnd == "00000000000000000000") {
                echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, last function command received and processed was not a dispense 
                command.<br>";
            } else {
                echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, defining the notes 
                dispensed on the last transaction<br>";
            }
            echo "4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
            migration purposes only and always contains zeros.<br>";
            echo "5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 000 (four hopper types). <br>";
            echo "6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
            if(substr($ltCd, 0, 1) == '0') {
                echo $ltCd . " last transaction was not a cash deposit.<br>";
            } elseif(substr($ltCd, 0, 1) == '1') {
                echo $ltCd . " vault direction.<br>";
            } elseif(substr($ltCd, 0, 1) == '2') {
                echo $ltCd . " refund direction.<br>";
            }
            echo "* Number of recycle cassettes reported: " . substr($ltCd, 1, 2) . "<br>";
            echo "* NDC Cassette Type: " . substr($ltCd, 3, 3) . "<br>";
            echo "* Number of Notes: " . substr($ltCd, 6, 3) . "<br>";
        } else {
            $ltnd = substr($r, 5, 35);
            $ltcad = substr($r, 40, 5);
            $ltcd = substr($r, 45, 5);
            $ltCd = substr($r, 50, 9);
            if($ltnd == "00000000000000000000000000000000000") {
                echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, last function command received and processed was not a dispense 
                command.<br>";
            } else {
                echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, defining the notes 
                dispensed on the last transaction<br>";
            }
            echo "4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
            migration purposes only and always contains zeros.<br>";
            echo "5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 001 (more than four hopper types). The Last Transaction
            Coinage Amount Dispensed is provided in fields cf1 to cf<n+1>. <br>";
            if(substr($ltCd, 0, 1) == '0') {
                echo $ltCd . " last transaction was not a cash deposit.<br>";
            } elseif(substr($ltCd, 0, 1) == '1') {
                echo $ltCd . " vault direction.<br>";
            } elseif(substr($ltCd, 0, 1) == '2') {
                echo $ltCd . " refund direction.<br>";
            }
            echo "* Number of recycle cassettes reported: " . substr($ltCd, 1, 2) . "<br>";
            echo "* NDC Cassette Type: " . substr($ltCd, 3, 3) . "<br>";
            echo "* Number of Notes: " . substr($ltCd, 6, 3) . "<br>";
        }
    } elseif($len == 71) {
        if(substr($r, 25, 5) == "00000") {
            $ltnd = substr($r, 5, 20);
            $ltcad = substr($r, 25, 5);
            $ltcd = substr($r, 30, 20);
            $ltCd = substr($r, 50, 21);
            if($ltnd == "00000000000000000000") {
                echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, last function command received and processed was not a dispense 
                command.<br>";
            } else {
                echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, defining the notes 
                dispensed on the last transaction<br>";
            }
            echo "4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
            migration purposes only and always contains zeros.<br>";
            echo "5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 000 (four hopper types). <br>";
            echo "6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
            if(substr($ltCd, 0, 1) == '0') {
                echo $ltCd . " last transaction was not a cash deposit.<br>";
            } elseif(substr($ltCd, 0, 1) == '1') {
                echo $ltCd . " vault direction.<br>";
            } elseif(substr($ltCd, 0, 1) == '2') {
                echo $ltCd . " refund direction.<br>";
            }
            echo "* Number of Notes Refunded during last transaction: " . substr($ltCd, 1, 5) . "<br>";
            echo "* Number of Notes Rejected during last transaction: " . substr($ltCd, 6, 5) . "<br>";
            echo "* Number of Notes Encashed during last transaction: " . substr($ltCd, 11, 5) . "<br>";
            echo "* Number of Notes to Escrow during last transaction: " . substr($ltCd, 16, 5) . "<br>";
        } else {
            $ltnd = substr($r, 5, 35);
            $ltcad = substr($r, 40, 5);
            $ltcd = substr($r, 45, 5);
            $ltCd = substr($r, 50, 21);
            if($ltnd == "00000000000000000000000000000000000") {
                echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, last function command received and processed was not a dispense 
                command.<br>";
            } else {
                echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, defining the notes 
                dispensed on the last transaction<br>";
            }
            echo "4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
            migration purposes only and always contains zeros.<br>";
            echo "5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 001 (more than four hopper types). The Last Transaction
            Coinage Amount Dispensed is provided in fields cf1 to cf<n+1>. <br>";
            echo "6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
            if(substr($ltCd, 0, 1) == '0') {
                echo $ltCd . " last transaction was not a cash deposit.<br>";
            } elseif(substr($ltCd, 0, 1) == '1') {
                echo $ltCd . " vault direction.<br>";
            } elseif(substr($ltCd, 0, 1) == '2') {
                echo $ltCd . " refund direction.<br>";
            }
            echo "* Number of Notes Refunded during last transaction: " . substr($ltCd, 1, 5) . "<br>";
            echo "* Number of Notes Rejected during last transaction: " . substr($ltCd, 6, 5) . "<br>";
            echo "* Number of Notes Encashed during last transaction: " . substr($ltCd, 11, 5) . "<br>";
            echo "* Number of Notes to Escrow during last transaction: " . substr($ltCd, 16, 5) . "<br>";
        }
    } elseif($len == 66) {
        $ltnd = substr($r, 5, 35);
        $ltcad = substr($r, 40, 5);
        $ltcd = substr($r, 45, 20);
        $ltCd = substr($r, 65, 1);
        if($ltnd == "00000000000000000000000000000000000") {
            echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, last function command received and processed was not a dispense 
            command.<br>";
        } else {
            echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, defining the notes 
            dispensed on the last transaction<br>";
        }
        echo "4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
        migration purposes only and always contains zeros.<br>";
        echo "5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 000 (four hopper types). <br>";
        echo "6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
        if(substr($ltCd, 0, 1) == '0') {
            echo $ltCd . " last transaction was not a cash deposit.<br>";
        } elseif(substr($ltCd, 0, 1) == '1') {
            echo $ltCd . " vault direction.<br>";
        } elseif(substr($ltCd, 0, 1) == '2') {
            echo $ltCd . " refund direction.<br>";
        }
    } elseif($len == 74) {
        $ltnd = substr($r, 5, 35);
        $ltcad = substr($r, 40, 5);
        $ltcd = substr($r, 45, 20);
        $ltCd = substr($r, 65, 9);
        if($ltnd == "00000000000000000000000000000000000") {
            echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, last function command received and processed was not a dispense 
            command.<br>";
        } else {
            echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, defining the notes 
            dispensed on the last transaction<br>";
        }
        echo "4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
        migration purposes only and always contains zeros.<br>";
        echo "5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 000 (four hopper types). <br>";
        echo "6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
        if(substr($ltCd, 0, 1) == '0') {
            echo $ltCd . " last transaction was not a cash deposit.<br>";
        } elseif(substr($ltCd, 0, 1) == '1') {
            echo $ltCd . " vault direction.<br>";
        } elseif(substr($ltCd, 0, 1) == '2') {
            echo $ltCd . " refund direction.<br>";
        }
        echo "* Number of recycle cassettes reported: " . substr($ltCd, 1, 2) . "<br>";
        echo "* NDC Cassette Type: " . substr($ltCd, 3, 3) . "<br>";
        echo "* Number of Notes: " . substr($ltCd, 6, 3) . "<br>";
    } elseif($len == 86) {
        $ltnd = substr($r, 5, 35);
        $ltcad = substr($r, 40, 5);
        $ltcd = substr($r, 45, 20);
        $ltCd = substr($r, 65, 21);
        if($ltnd == "00000000000000000000000000000000000") {
            echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, last function command received and processed was not a dispense 
            command.<br>";
        } else {
            echo "3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, defining the notes 
            dispensed on the last transaction<br>";
        }
        echo "4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
        migration purposes only and always contains zeros.<br>";
        echo "5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 000 (four hopper types). <br>";
        echo "6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
        if(substr($ltCd, 0, 1) == '0') {
            echo $ltCd . " last transaction was not a cash deposit.<br>";
        } elseif(substr($ltCd, 0, 1) == '1') {
            echo $ltCd . " vault direction.<br>";
        } elseif(substr($ltCd, 0, 1) == '2') {
            echo $ltCd . " refund direction.<br>";
        }
        echo "* Number of Notes Refunded during last transaction: " . substr($ltCd, 1, 5) . "<br>";
        echo "* Number of Notes Rejected during last transaction: " . substr($ltCd, 6, 5) . "<br>";
        echo "* Number of Notes Encashed during last transaction: " . substr($ltCd, 11, 5) . "<br>";
        echo "* Number of Notes to Escrow during last transaction: " . substr($ltCd, 16, 5) . "<br>";
    } else {
        echo "Invalid!<br>";
    }
}

function qrFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field q and r. <br>";
    } else {
        $q = substr($string, 0, 1);
        $r = substr($string, 1);
        if ($q == "") {
            echo "Message doesn't have field q. <br>";
        } elseif ($q == "2") {
            echo "Field q is: " .
                $q .
                " - Identifies the data that follows in the 
            next field as Transaction Status data <br>";
        } else {
            echo "Invalid q fields! <br>";
        }
        $len = strlen($r);
        if ($len == 0) {
            echo "Message doesn't have field r. <br>";
        } else {
            echo "Fields r means: <br>";
            $ltsn = substr($r, 0, 4);
            $lti = substr($r, 4, 1);
            echo "1. Last Transaction Serial Number: " . $ltsn . " - Number of the last transaction partially processed by the terminal. <br>";
            echo "2. Last Status Issued: " . $lti;
            if($lti == "0") {
                echo " - None sent.<br>";
            } elseif($lti == "1") {
                echo " - Good termination sent.<br>";
            } elseif($lti == "2") {
                echo " - Error status sent. <br>";
            } elseif($lti == "3") {
                echo " - Transaction reply rejected.<br>";
            } else {
                echo " - Not defined! <br>";
            }
            seperate($r);
        }
    }
}

function avFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field av1, av2. <br>";
    } elseif (strlen($string) == 1) {
        echo "Field av1 is: " .
            $string .
            " - No CSP has been requested, only av1 field present. <br>";
    } else {
        echo "Field av1 is: " . substr($string, 0, 1) . "<br>";
        echo "Field av2 is: " . substr($string, 1) . " - Contains an encrypted 16 character PIN<br>";
    }
}

function awFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field aw1, aw2. <br>";
    } elseif (strlen($string) == 1) {
        echo "Field aw1 is: " .
            $string .
            " - No CSP has been requested, only av1 field present. <br>";
    } else {
        echo "Field aw1 is: " . substr($string, 0, 1) . "<br>";
        echo "Field aw2 is: " . substr($string, 1) . " - Contains an encrypted 16 character PIN<br>";
    }
}

function axFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field ax1, ax2. <br>";
    } elseif (strlen($string) == 1) {
        echo "Field ax1 is: " .
            $string .
            " - No description, only ax1 field present. <br>";
    } else {
        echo "Field ax1 is: " . substr($string, 0, 1) . "<br>";
        echo "Field ax2 is: " . substr($string, 1) . " - Available for use by Exits.<br>";
    }
}

function ayFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field ay1, ay2. <br>";
    } elseif (strlen($string) == 1) {
        echo "Field ay1 is: " .
            $string .
            " - No description, only ay1 field present. <br>";
    } else {
        echo "Field ay1 is: " . substr($string, 0, 1) . "<br>";
        echo "Field ay2 is: " . substr($string, 1) . " - Available for use by Exits.<br>";
    }
}

function azFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field az1, az2. <br>";
    } elseif (strlen($string) == 1) {
        echo "Field az1 is: " .
            $string .
            " - No description, only az1 field present. <br>";
    } else {
        echo "Field ay1 is: " . substr($string, 0, 1) . "<br>";
        echo "Field ay2 is: " . substr($string, 1) . " - Available for use by Exits.<br>";
    }
}

function baFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field ba1, ba2. <br>";
    } elseif (strlen($string) == 1) {
        echo "Field ba1 is: " .
            $string .
            " - No description, only ba1 field present. <br>";
    } else {
        echo "Field ba1 is: " . substr($string, 0, 1) . "<br>";
        echo "Field ba2 is: " . substr($string, 1) . " - Available for use by Exits.<br>";
    }
}

function bbFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field bb1, bb2. <br>";
    } elseif (strlen($string) == 1) {
        echo "Field bb1 is: " .
            $string .
            " - No description, only ba1 field present. <br>";
    } else {
        echo "Field bb1 is: " . substr($string, 0, 1) . "<br>";
        echo "Field bb2 is: " . substr($string, 1) . " - Available for use by Exits.<br>";
    }
}

function bcFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field bc1, bc2. <br>";
    } elseif (strlen($string) == 1) {
        echo "Field bc1 is: " .
            $string .
            " - No description, only bc1 field present. <br>";
    } else {
        echo "Field bc1 is: " . substr($string, 0, 1) . "<br>";
        echo "Field bc2 is: " . substr($string, 1) . " - Available for use by Exits.<br>";
    }
}

function bdFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field bd1, bd2. <br>";
    } elseif (strlen($string) == 1) {
        echo "Field bd1 is: " .
            $string .
            " - No description, only bd1 field present. <br>";
    } else {
        echo "Field bd1 is: " . substr($string, 0, 1) . "<br>";
        echo "Field bd2 is: " . substr($string, 1) . " - Contains data inserted by CAM2/EMV Exits.<br>";
    }
}

function caFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field ca1, ca2, ca3. <br>";
    } elseif (strlen($string) == 1) {
        echo "Field ca1 is: " .
            $string .
            " - No description, only ca1 field present. <br>";
    } else {
        echo "Field ca1 is: " . substr($string, 0, 1) . "<br>";
        echo "Field ca2 is: " . substr($string, 1, 2) . " - Representing a note type.<br>";
        echo "Field ca3 is: " . substr($string, 3) . " - Number of notes in escrow for the note type defined in ca2, ";
        if(strlen(substr($string, 3)) == 2) {
            echo "option 45 is not set to report more than 90 notes. <br>";
        } elseif (strlen(substr($string, 3)) == 3) {
            echo "option 45 is set to report more than 90 notes. <br>";
        }
    }
}

function cbFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field cb1, cb2, cb3. <br>";
    } elseif (strlen($string) == 1) {
        echo "Field cb1 is: " .
            $string .
            " - No description, only cb1 field present. <br>";
    } else {
        echo "Field cb1 is: " . substr($string, 0, 1) . "<br>";
        echo "Field cb2 is: " . substr($string, 1, 1);
        if(substr($string, 1, 1) == "0") {
            echo " - A minimum number of MICR characters have been detected.<br>";
            echo "Message doesn't have field cb3.<br>";
        } elseif(substr($string, 1, 1) == "1") {
            echo " - The MICR on an otherwise good cheque has not been detected after retries.<br>";
            echo "Field cb3 is: " . substr($string, 2) . " - Contains the MICR read from the cheque.<br>";
        }
    }
}

function ceFields($string)
{
    $len = strlen($string);
    if ($len == 0) {
        echo "Message doesn't have field ce1, ce2, ce3, ce4. <br>";
    } elseif ($len == 1){
        echo "Field ce1 is: " .
        $string .
        " - No description, only ce1 field present. <br>";
    } else {
        echo "Field ce1 is: " . substr($string, 0, 1) . "<br>";
        if(substr($string, 1, 4) == "") {
            echo "Message doesn't have field ce2.<br>";
        } elseif(substr($string, 1, 4) == "0000") {
            echo "Field ce2 is: " . substr($string, 1, 4) ." - The barcode format is not known.<br>";
        } else {
            echo "Field ce2 is: " . substr($string, 1, 4) ." - Representation of the Barcode Format identifie.<br>";
        }
        if(substr($string, 5, 2) == "") {
            echo "Message doesn't have field ce3.<br>";
        } else {
            echo "Field ce3 is: " . substr($string, 5, 2) ." - Reserved.<br>";
        }
        if(substr($string, 7) == "") {
            echo "Message doesn't have field ce4.<br>";
        } else {
            echo "Field ce4 is: " . substr($string, 7) ." - The scanned barcode data.<br>";
        }
    }
}

function cfFields($string)
{
    $len = strlen($string);
    if ($len == 0) {
        echo "Message doesn't have fields cf. <br>";
    } elseif ($len == 1) {
        echo "Field cf1 is: " .
        $string .
        " - No description, only cf1 field present. <br>";
    } else {
        echo "Field cf1 is: " .
        $string .
        " - More than four coin hopper types are being reported. <br>";
        $rest = substr($string, 1);
        $ln = strlen($rest);
        for ($i = 0; $i < $ln; $i += 2) {
            $pair = substr($rest, $i, 2);
            echo "Field cf" . ($i/2) . " is: " . $pair . ". - Number of coins dispensed from hopper type" .($i/2) . "<br>";
        }
    }
}

function ciwFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field ci1, ci2, w. <br>";
    } elseif (strlen($string) == 1) {
        echo "Field ci1 is: " .
        $string .
        " - No description, only ci1 field present. <br>";
    } else {
        echo "Field ci1 is: " . substr($string, 0, 1) . " - Shows that voice guidance data is being reported.<br>";
        echo "Field ci2 is: " . substr($string, 1, 2) . " - Voice guidance language identifier.<br>";
        if(strlen($string) >= 3) {
            echo "Message doesn't have field w. <br>";
        } else {
            echo "Field w is: " . substr($string, 3) . " -  Optional data fields.<br>";
        }
    }
}

function xFields($string)
{
    if ($string == "") {
        echo "Message doesn't have field x. <br>";
    } else {
        echo "Field x is: " . $string . " - Message Authentication Code Data.<br>";
    }
}
?>
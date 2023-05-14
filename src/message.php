<?php
    //This function will add FS characters to the message for easier segmentation of the message
    function addFS($message) {
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

    function abcFields($string)
    {
        if (isset($string)) {
            $len = strlen($string);
            if ($len == 3) {
                echo "<li>Field a is " . substr($string, 0, 1) . " - Header. </li>";
                echo "<li>Field b is " .
                    substr($string, 1, 1) .
                    " - Unsolicited Message. </li>";
                echo "<li>Field c is " .
                    substr($string, 2, 1) .
                    " - Transaction Request Message. </li>";
            } elseif ($len == 2) {
                echo "<li>Field b is " .
                    substr($string, 0, 1) .
                    " - Unsolicited Message. </li>";
                echo "<li>Field c is " .
                    substr($string, 1, 1) .
                    " - Transaction Request Message. </li>";
            } else {
                echo "<li>Error! </li>";
            }
        } else {
            echo "<li>Message doesn't have field a, b and c. </li>";
        }
    }

    function dField($string)
    {
        $len = strlen($string);
        if ($len == 3) {
            if ($string == '000') {
                echo "<li>Field d is 000 - Default LUNO number. </li>";
            } else {
                echo "<li>Field d is " . $string . " - Not a default LUNO number. </li>";
            }
        } elseif ($len == 9) {
            $luno = substr($string, 0, 3);
            echo "<li>Field d is " . $luno . " - LUNO number. </li>";
            if ($len == 15) {
                $machine_num = substr($string, 3, 6);
                echo "<li>Machine number: " . $machine_num . " </li>";
            }
        } else {
            echo "<li>Error! Invalid input for field d. </li>";
        }
    }

    function eFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field e. </li>";
        } else {
            echo "<li>Field e is " . $string . " - Time Variant Number. </li>";
        }
    }

    function fgFields($string)
    {
        if (strlen($string) == 0) {
            echo "<li>Message doesn't have field f and g. </li>";
        } elseif (strlen($string) == 1) {
            echo "<li>Error! </li>";
        } else {
            $f = substr($string, 0, 1);
            $g = substr($string, 1, 1);
            if ($f == "0") {
                echo "<li>Field f is " . $f . " - Will not print data for this transaction at the top of the receipt. </li>";
            } elseif ($f == "1") {
                echo "<li>Field f is " . $f . " - Will print data for this transaction at the top of the receipt. </li>";
            }
            echo "<li>Field g is " . $g . " - Message Co-Ordination Number. </li>";
        }
    }

    function hFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field h. </li>";
        } else {
            if (strlen($string) <= 39) {
                echo "<li>Field h is " .
                    $string .
                    " - Track 2 Data. Contains up to 39 characters of Track 2 data from the start sentinel to the end sentinel inclusive. Characters are in the range 30-3F hex. </li>";
            } else {
                echo "<li>Invalid value for field h. </li>";
            }
        }
    }

    function iFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field i. </li>";
        } else {
            echo "<li>Field i is: " . $string . ". </li>";
        }
    }

    function jFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field j. </li>";
        } else {
            echo "<li>Field j is: " . $string . ". </li>";
        }
    }

    function kFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field k. </li>";
        } else {
            $field_length = strlen($string);
            if ($field_length != 8 && $field_length != 12) {
                echo "<li>Invalid length for field k. </li>";
            } else {
                $amount = ltrim($string, "0");
                if ($amount == "") {
                    $amount = "0";
                }
                echo "<li>Field j is: " . $string . " - Amount entered: " . $amount . ".</li>";
            }
        }
    }

    function lFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field l. </li>";
        } else {
            echo "<li>Field l is: " . $string . ". </li>";
        }
    }

    function mFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field m. </li>";
        } else {
            echo "<li>Field m is: " . $string . "</li>";
        }
    }

    function nFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field n. </li>";
        } else {
            echo "<li>Field n is: " . $string . ". </li>";
        }
    }

    function opFields($message)
    {
        if ($message == "") {
            echo "<li>Message doesn't have field o and p. </li>";
        } elseif (strlen($message) == 1) {
            echo "<li>Field o is: " . $message . ". </li>";
        } else {
            $field_o = substr($message, 0, 1);
            $field_p = substr($message, 1);
            if ($field_o == "1") {
                echo "<li>Field o is Track 1 Identifier. </li>";
                echo "<li>Field p is Track 1 Data: " . $field_p . ". </li>";
            } else {
                echo "<li>Field o is not Track 1 Identifier. </li>";
                echo "<li>Field p is not Track 1 Data: " . $field_p . "</li>";
            }
        }
    }


    //This function handles the subfields of the r field
    function seperate($r) {
        $len = strlen($r);
        if($len == 36) {
            $ltnd = substr($r, 5, 20);
            $ltcad = substr($r, 25, 5);
            $ltcd = substr($r, 30, 5);
            $ltCd = substr($r, 35, 1);
            if($ltnd == "00000000000000000000") {
                echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, last function command received and processed was not a dispense 
                command. </li>";
            } else {
                echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, defining the notes 
                dispensed on the last transaction. </li>";
            }
            echo "<li>4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
            migration purposes only and always contains zeros. </li>";
            echo "<li>5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 001 (more than four hopper types). The Last Transaction
            Coinage Amount Dispensed is provided in fields cf1 to cf<n+1>. </li>";
            echo "<li>6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
            if($ltCd == '0') {
                echo $ltCd . " last transaction was not a cash deposit.</li>";
            } elseif($ltCd == '1') {
                echo $ltCd . " vault direction.</li>";
            } elseif($ltCd == '2') {
                echo $ltCd . " refund direction.</li>";
            }
        } elseif($len == 44) {
            $ltnd = substr($r, 5, 20);
            $ltcad = substr($r, 25, 5);
            $ltcd = substr($r, 30, 5);
            $ltCd = substr($r, 35, 9);
            if($ltnd == "00000000000000000000") {
                echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, last function command received and processed was not a dispense 
                command.</li>";
            } else {
                echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, defining the notes 
                dispensed on the last transaction. </li>";
            }
            echo "<li>4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
            migration purposes only and always contains zeros.</li>";
            echo "<li>5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 001 (more than four hopper types). The Last Transaction
            Coinage Amount Dispensed is provided in fields cf1 to cf<n+1>. </li>";
            echo "<li>6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
            if(substr($ltCd, 0, 1) == '0') {
                echo $ltCd . " last transaction was not a cash deposit.</li>";
            } elseif(substr($ltCd, 0, 1) == '1') {
                echo $ltCd . " vault direction.</li>";
            } elseif(substr($ltCd, 0, 1) == '2') {
                echo $ltCd . " refund direction.</li>";
            }
            echo "* Number of recycle cassettes reported: " . substr($ltCd, 1, 2) . "</li>";
            echo "* NDC Cassette Type: " . substr($ltCd, 3, 3) . "</li>";
            echo "* Number of Notes: " . substr($ltCd, 6, 3) . "</li>";
            
        } elseif($len == 56) {
            $ltnd = substr($r, 5, 20);
            $ltcad = substr($r, 25, 5);
            $ltcd = substr($r, 30, 5);
            $ltCd = substr($r, 35, 21);
            if($ltnd == "00000000000000000000") {
                echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, last function command received and processed was not a dispense 
                command.</li>";
            } else {
                echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, defining the notes 
                dispensed on the last transaction.</li>";
            }
            echo "<li>4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
            migration purposes only and always contains zeros.</li>";
            echo "<li>5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 001 (more than four hopper types). The Last Transaction
            Coinage Amount Dispensed is provided in fields cf1 to cf<n+1>. </li>";
            echo "<li>6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
            if(substr($ltCd, 0, 1) == '0') {
                echo $ltCd . " last transaction was not a cash deposit.</li>";
            } elseif(substr($ltCd, 0, 1) == '1') {
                echo $ltCd . " vault direction.</li>";
            } elseif(substr($ltCd, 0, 1) == '2') {
                echo $ltCd . " refund direction.</li>";
            }
            echo "* Number of Notes Refunded during last transaction: " . substr($ltCd, 1, 5) . ".</li>";
            echo "* Number of Notes Rejected during last transaction: " . substr($ltCd, 6, 5) . ".</li>";
            echo "* Number of Notes Encashed during last transaction: " . substr($ltCd, 11, 5) . ".</li>";
            echo "* Number of Notes to Escrow during last transaction: " . substr($ltCd, 16, 5) . ".</li>";
        } elseif($len == 51) {
            if(substr($r, 25, 5) == "00000") {
                $ltnd = substr($r, 5, 20);
                $ltcad = substr($r, 25, 5);
                $ltcd = substr($r, 30, 20);
                $ltCd = substr($r, 50, 1);
                if($ltnd == "00000000000000000000") {
                    echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, last function command received and processed was not a dispense 
                    command.</li>";
                } else {
                    echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, defining the notes 
                    dispensed on the last transaction.</li>";
                }
                echo "<li>4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
                migration purposes only and always contains zeros.</li>";
                echo "<li>5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 000 (four hopper types). </li>";
                echo "<li>6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
                if(substr($ltCd, 0, 1) == '0') {
                    echo $ltCd . " last transaction was not a cash deposit.</li>";
                } elseif(substr($ltCd, 0, 1) == '1') {
                    echo $ltCd . " vault direction.</li>";
                } elseif(substr($ltCd, 0, 1) == '2') {
                    echo $ltCd . " refund direction.</li>";
                }
            } else {
                $ltnd = substr($r, 5, 35);
                $ltcad = substr($r, 40, 5);
                $ltcd = substr($r, 45, 5);
                $ltCd = substr($r, 50, 1);
                if($ltnd == "00000000000000000000000000000000000") {
                    echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, last function command received and processed was not a dispense 
                    command.</li>";
                } else {
                    echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, defining the notes 
                    dispensed on the last transaction.</li>";
                }
                echo "<li>4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
                migration purposes only and always contains zeros.</li>";
                echo "<li>5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 001 (more than four hopper types). The Last Transaction
                Coinage Amount Dispensed is provided in fields cf1 to cf<n+1>. </li>";
                echo "<li>6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
                if($ltCd == '0') {
                    echo $ltCd . " last transaction was not a cash deposit.</li>";
                } elseif($ltCd == '1') {
                    echo $ltCd . " vault direction.</li>";
                } elseif($ltCd == '2') {
                    echo $ltCd . " refund direction.</li>";
                }
            }
        } elseif($len == 59) {
            if(substr($r, 25, 5) == "00000") {
                $ltnd = substr($r, 5, 20);
                $ltcad = substr($r, 25, 5);
                $ltcd = substr($r, 30, 20);
                $ltCd = substr($r, 50, 9);
                if($ltnd == "00000000000000000000") {
                    echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, last function command received and processed was not a dispense 
                    command.</li>";
                } else {
                    echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, defining the notes 
                    dispensed on the last transaction.</li>";
                }
                echo "<li>4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
                migration purposes only and always contains zeros.</li>";
                echo "<li>5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 000 (four hopper types). </li>";
                echo "<li>6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
                if(substr($ltCd, 0, 1) == '0') {
                    echo $ltCd . " last transaction was not a cash deposit.</li>";
                } elseif(substr($ltCd, 0, 1) == '1') {
                    echo $ltCd . " vault direction.</li>";
                } elseif(substr($ltCd, 0, 1) == '2') {
                    echo $ltCd . " refund direction.</li>";
                }
                echo "<li>* Number of recycle cassettes reported: " . substr($ltCd, 1, 2) . ".</li>";
                echo "<li>* NDC Cassette Type: " . substr($ltCd, 3, 3) . ".</li>";
                echo "<li>* Number of Notes: " . substr($ltCd, 6, 3) . ".</li>";
            } else {
                $ltnd = substr($r, 5, 35);
                $ltcad = substr($r, 40, 5);
                $ltcd = substr($r, 45, 5);
                $ltCd = substr($r, 50, 9);
                if($ltnd == "00000000000000000000000000000000000") {
                    echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, last function command received and processed was not a dispense 
                    command.</li>";
                } else {
                    echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, defining the notes 
                    dispensed on the last transaction.</li>";
                }
                echo "<li>4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
                migration purposes only and always contains zeros.</li>";
                echo "<li>5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 001 (more than four hopper types). The Last Transaction
                Coinage Amount Dispensed is provided in fields cf1 to cf<n+1>. </li>";
                if(substr($ltCd, 0, 1) == '0') {
                    echo $ltCd . " last transaction was not a cash deposit.</li>";
                } elseif(substr($ltCd, 0, 1) == '1') {
                    echo $ltCd . " vault direction.</li>";
                } elseif(substr($ltCd, 0, 1) == '2') {
                    echo $ltCd . " refund direction.</li>";
                }
                echo "<li>* Number of recycle cassettes reported: " . substr($ltCd, 1, 2) . ".</li>";
                echo "<li>* NDC Cassette Type: " . substr($ltCd, 3, 3) . ".</li>";
                echo "<li>* Number of Notes: " . substr($ltCd, 6, 3) . ".</li>";
            }
        } elseif($len == 71) {
            if(substr($r, 25, 5) == "00000") {
                $ltnd = substr($r, 5, 20);
                $ltcad = substr($r, 25, 5);
                $ltcd = substr($r, 30, 20);
                $ltCd = substr($r, 50, 21);
                if($ltnd == "00000000000000000000") {
                    echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, last function command received and processed was not a dispense 
                    command.</li>";
                } else {
                    echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 000, defining the notes 
                    dispensed on the last transaction.</li>";
                }
                echo "<li>4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
                migration purposes only and always contains zeros.</li>";
                echo "<li>5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 000 (four hopper types). </li>";
                echo "<li>6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
                if(substr($ltCd, 0, 1) == '0') {
                    echo $ltCd . " last transaction was not a cash deposit.</li>";
                } elseif(substr($ltCd, 0, 1) == '1') {
                    echo $ltCd . " vault direction.</li>";
                } elseif(substr($ltCd, 0, 1) == '2') {
                    echo $ltCd . " refund direction.</li>";
                }
                echo "<li>* Number of Notes Refunded during last transaction: " . substr($ltCd, 1, 5) . ".</li>";
                echo "<li>* Number of Notes Rejected during last transaction: " . substr($ltCd, 6, 5) . ".</li>";
                echo "<li>* Number of Notes Encashed during last transaction: " . substr($ltCd, 11, 5) . ".</li>";
                echo "<li>* Number of Notes to Escrow during last transaction: " . substr($ltCd, 16, 5) . ".</li>";
            } else {
                $ltnd = substr($r, 5, 35);
                $ltcad = substr($r, 40, 5);
                $ltcd = substr($r, 45, 5);
                $ltCd = substr($r, 50, 21);
                if($ltnd == "00000000000000000000000000000000000") {
                    echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, last function command received and processed was not a dispense 
                    command.</li>";
                } else {
                    echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, defining the notes 
                    dispensed on the last transaction.</li>";
                }
                echo "<li>4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
                migration purposes only and always contains zeros.</li>";
                echo "<li>5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 001 (more than four hopper types). The Last Transaction
                Coinage Amount Dispensed is provided in fields cf1 to cf<n+1>. </li>";
                echo "<li>6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
                if(substr($ltCd, 0, 1) == '0') {
                    echo $ltCd . " last transaction was not a cash deposit.</li>";
                } elseif(substr($ltCd, 0, 1) == '1') {
                    echo $ltCd . " vault direction.</li>";
                } elseif(substr($ltCd, 0, 1) == '2') {
                    echo $ltCd . " refund direction.</li>";
                }
                echo "<li>* Number of Notes Refunded during last transaction: " . substr($ltCd, 1, 5) . ".</li>";
                echo "<li>* Number of Notes Rejected during last transaction: " . substr($ltCd, 6, 5) . ".</li>";
                echo "<li>* Number of Notes Encashed during last transaction: " . substr($ltCd, 11, 5) . ".</li>";
                echo "<li>* Number of Notes to Escrow during last transaction: " . substr($ltCd, 16, 5) . ".</li>";
            }
        } elseif($len == 66) {
            $ltnd = substr($r, 5, 35);
            $ltcad = substr($r, 40, 5);
            $ltcd = substr($r, 45, 20);
            $ltCd = substr($r, 65, 1);
            if($ltnd == "00000000000000000000000000000000000") {
                echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, last function command received and processed was not a dispense 
                command.</li>";
            } else {
                echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, defining the notes 
                dispensed on the last transaction.</li>";
            }
            echo "<li>4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
            migration purposes only and always contains zeros.</li>";
            echo "<li>5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 000 (four hopper types). </li>";
            echo "<li>6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
            if(substr($ltCd, 0, 1) == '0') {
                echo $ltCd . " last transaction was not a cash deposit.</li>";
            } elseif(substr($ltCd, 0, 1) == '1') {
                echo $ltCd . " vault direction.</li>";
            } elseif(substr($ltCd, 0, 1) == '2') {
                echo $ltCd . " refund direction.</li>";
            }
        } elseif($len == 74) {
            $ltnd = substr($r, 5, 35);
            $ltcad = substr($r, 40, 5);
            $ltcd = substr($r, 45, 20);
            $ltCd = substr($r, 65, 9);
            if($ltnd == "00000000000000000000000000000000000") {
                echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, last function command received and processed was not a dispense 
                command.</li>";
            } else {
                echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, defining the notes 
                dispensed on the last transaction.</li>";
            }
            echo "<li>4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
            migration purposes only and always contains zeros.</li>";
            echo "<li>5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 000 (four hopper types). </li>";
            echo "<li>6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
            if(substr($ltCd, 0, 1) == '0') {
                echo $ltCd . " last transaction was not a cash deposit.</li>";
            } elseif(substr($ltCd, 0, 1) == '1') {
                echo $ltCd . " vault direction.</li>";
            } elseif(substr($ltCd, 0, 1) == '2') {
                echo $ltCd . " refund direction.</li>";
            }
            echo "<li>* Number of recycle cassettes reported: " . substr($ltCd, 1, 2) . ".</li>";
            echo "<li>* NDC Cassette Type: " . substr($ltCd, 3, 3) . ".</li>";
            echo "<li>* Number of Notes: " . substr($ltCd, 6, 3) . ".</li>";
        } elseif($len == 86) {
            $ltnd = substr($r, 5, 35);
            $ltcad = substr($r, 40, 5);
            $ltcd = substr($r, 45, 20);
            $ltCd = substr($r, 65, 21);
            if($ltnd == "00000000000000000000000000000000000") {
                echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, last function command received and processed was not a dispense 
                command.</li>";
            } else {
                echo "<li>3. Last Transaction Notes Dispensed: " . $ltnd . " Option 76 is set to 001, defining the notes 
                dispensed on the last transaction.</li>";
            }
            echo "<li>4. Last Transaction Coinage Amount Dispensed: " . $ltcad . " is included for 
            migration purposes only and always contains zeros.</li>";
            echo "<li>5. Last Transaction Coins Dispensed: " . $ltcd . " Option 79 is set to 000 (four hopper types). </li>";
            echo "<li>6. The  Last Cash Deposit Transaction Direction is present, Last Transaction Cash Deposit Data is: ";
            if(substr($ltCd, 0, 1) == '0') {
                echo $ltCd . " last transaction was not a cash deposit.</li>";
            } elseif(substr($ltCd, 0, 1) == '1') {
                echo $ltCd . " vault direction.</li>";
            } elseif(substr($ltCd, 0, 1) == '2') {
                echo $ltCd . " refund direction.</li>";
            }
            echo "<li>* Number of Notes Refunded during last transaction: " . substr($ltCd, 1, 5) . ".</li>";
            echo "<li>* Number of Notes Rejected during last transaction: " . substr($ltCd, 6, 5) . ".</li>";
            echo "<li>* Number of Notes Encashed during last transaction: " . substr($ltCd, 11, 5) . ".</li>";
            echo "<li>* Number of Notes to Escrow during last transaction: " . substr($ltCd, 16, 5) . ".</li>";
        } else {
            echo "<li>Invalid!</li>";
        }
    }

    function qrFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field q and r. </li>";
        } else {
            $q = substr($string, 0, 1);
            $r = substr($string, 1);
            if ($q == '') {
                echo "<li>Message doesn't have field q. </li>";
            } elseif ($q == '2') {
                echo "<li>Field q is: " .
                    $q .
                    " - Identifies the data that follows in the 
                next field as Transaction Status data </li>";
            } else {
                echo "<li>Invalid q fields! </li>";
            }
            $len = strlen($r);
            if ($len == 0) {
                echo "<li>Message doesn't have field r. </li>";
            } else {
                echo "<li>Fields r means: </li>";
                $ltsn = substr($r, 0, 4);
                $lti = substr($r, 4, 1);
                echo "<li>1. Last Transaction Serial Number: " . $ltsn . " - Number of the last transaction partially processed by the terminal. </li>";
                echo "<li>2. Last Status Issued: " . $lti;
                if($lti == "0") {
                    echo " - None sent.</li>";
                } elseif($lti == "1") {
                    echo " - Good termination sent.</li>";
                } elseif($lti == "2") {
                    echo " - Error status sent. </li>";
                } elseif($lti == "3") {
                    echo " - Transaction reply rejected.</li>";
                } else {
                    echo " - Not defined! </li>";
                }
                seperate($r);
            }
        }
    }

    function avFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field av1, av2. </li>";
        } elseif (strlen($string) == 1) {
            echo "<li>Field av1 is: " .
                $string .
                " - No CSP has been requested, only av1 field present. <li>";
        } else {
            echo "<li>Field av1 is: " . substr($string, 0, 1) . "</li>";
            echo "<li>Field av2 is: " . substr($string, 1) . " - Contains an encrypted 16 character PIN.</li>";
        }
    }

    function awFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field aw1, aw2. </li>";
        } elseif (strlen($string) == 1) {
            echo "<li>Field aw1 is: " .
                $string .
                " - No CSP has been requested, only av1 field present. </li>";
        } else {
            echo "<li>Field aw1 is: " . substr($string, 0, 1) . ".</li>";
            echo "<li>Field aw2 is: " . substr($string, 1) . " - Contains an encrypted 16 character PIN.</li>";
        }
    }

    function axFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field ax1, ax2. </li>";
        } elseif (strlen($string) == 1) {
            echo "<li>Field ax1 is: " .
                $string .
                " - No description, only ax1 field present. </li>";
        } else {
            echo "<li>Field ax1 is: " . substr($string, 0, 1) . ".</li>";
            echo "<li>Field ax2 is: " . substr($string, 1) . " - Available for use by Exits.</li>";
        }
    }

    function ayFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field ay1, ay2. </li>";
        } elseif (strlen($string) == 1) {
            echo "<li>Field ay1 is: " .
                $string .
                " - No description, only ay1 field present. </li>";
        } else {
            echo "<li>Field ay1 is: " . substr($string, 0, 1) . ".</li>";
            echo "<li>Field ay2 is: " . substr($string, 1) . " - Available for use by Exits.</li>";
        }
    }

    function azFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field az1, az2. </li>";
        } elseif (strlen($string) == 1) {
            echo "<li>Field az1 is: " .
                $string .
                " - No description, only az1 field present. </li>";
        } else {
            echo "<li>Field ay1 is: " . substr($string, 0, 1) . ".</li>";
            echo "<li>Field ay2 is: " . substr($string, 1) . " - Available for use by Exits.</li>";
        }
    }

    function baFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field ba1, ba2. </li>";
        } elseif (strlen($string) == 1) {
            echo "<li>Field ba1 is: " .
                $string .
                " - No description, only ba1 field present. </li>";
        } else {
            echo "<li>Field ba1 is: " . substr($string, 0, 1) . ".</li>";
            echo "<li>Field ba2 is: " . substr($string, 1) . " - Available for use by Exits.</li>";
        }
    }

    function bbFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field bb1, bb2. </li>";
        } elseif (strlen($string) == 1) {
            echo "<li>Field bb1 is: " .
                $string .
                " - No description, only ba1 field present. </li>";
        } else {
            echo "<li>Field bb1 is: " . substr($string, 0, 1) . ".</li>";
            echo "<li>Field bb2 is: " . substr($string, 1) . " - Available for use by Exits.</li>";
        }
    }

    function bcFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field bc1, bc2. </li>";
        } elseif (strlen($string) == 1) {
            echo "<li>Field bc1 is: " .
                $string .
                " - No description, only bc1 field present. </li>";
        } else {
            echo "<li>Field bc1 is: " . substr($string, 0, 1) . ".</li>";
            echo "<li>Field bc2 is: " . substr($string, 1) . " - Available for use by Exits.</li>";
        }
    }

    function bdFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field bd1, bd2. </li>";
        } elseif (strlen($string) == 1) {
            echo "<li>Field bd1 is: " .
                $string .
                " - No description, only bd1 field present. </li>";
        } else {
            echo "<li>Field bd1 is: " . substr($string, 0, 1) . ".</li>";
            echo "<li>Field bd2 is: " . substr($string, 1) . " - Contains data inserted by CAM2/EMV Exits.</li>";
        }
    }

    function caFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field ca1, ca2, ca3. </li>";
        } elseif (strlen($string) == 1) {
            echo "<li>Field ca1 is: " .
                $string .
                " - No description, only ca1 field present. </li>";
        } else {
            echo "<li>Field ca1 is: " . substr($string, 0, 1) . ".</li>";
            echo "<li>Field ca2 is: " . substr($string, 1, 2) . " - Representing a note type.</li>";
            echo "<li>Field ca3 is: " . substr($string, 3) . " - Number of notes in escrow for the note type defined in ca2, ";
            if(strlen(substr($string, 3)) == 2) {
                echo "option 45 is not set to report more than 90 notes. </li>";
            } elseif (strlen(substr($string, 3)) == 3) {
                echo "option 45 is set to report more than 90 notes. </li>";
            }
        }
    }

    function cbFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field cb1, cb2, cb3. </li>";
        } elseif (strlen($string) == 1) {
            echo "<li>Field cb1 is: " .
                $string .
                " - No description, only cb1 field present. </li>";
        } else {
            echo "<li>Field cb1 is: " . substr($string, 0, 1) . ",</li>";
            echo "<li>Field cb2 is: " . substr($string, 1, 1);
            if(substr($string, 1, 1) == "0") {
                echo " - A minimum number of MICR characters have been detected.</li>";
                echo "<li>Message doesn't have field cb3.</li>";
            } elseif(substr($string, 1, 1) == "1") {
                echo " - The MICR on an otherwise good cheque has not been detected after retries.</li>";
                echo "<li>Field cb3 is: " . substr($string, 2) . " - Contains the MICR read from the cheque.</li>";
            }
        }
    }

    function ceFields($string)
    {
        $len = strlen($string);
        if ($len == 0) {
            echo "<li>Message doesn't have field ce1, ce2, ce3, ce4. </li>";
        } elseif ($len == 1){
            echo "<li>Field ce1 is: " .
            $string .
            " - No description, only ce1 field present. </li>";
        } else {
            echo "<li>Field ce1 is: " . substr($string, 0, 1) . ".</li>";
            if(substr($string, 1, 4) == "") {
                echo "<li>Message doesn't have field ce2.</li>";
            } elseif(substr($string, 1, 4) == "0000") {
                echo "<li>Field ce2 is: " . substr($string, 1, 4) ." - The barcode format is not known.</li>";
            } else {
                echo "<li>Field ce2 is: " . substr($string, 1, 4) ." - Representation of the Barcode Format identifie.</li>";
            }
            if(substr($string, 5, 2) == "") {
                echo "<li>Message doesn't have field ce3.</li>";
            } else {
                echo "<li>Field ce3 is: " . substr($string, 5, 2) ." - Reserved.</li>";
            }
            if(substr($string, 7) == "") {
                echo "<li>Message doesn't have field ce4.</li>";
            } else {
                echo "<li>Field ce4 is: " . substr($string, 7) ." - The scanned barcode data.</li>";
            }
        }
    }

    function cfFields($string)
    {
        $len = strlen($string);
        if ($len == 0) {
            echo "<li>Message doesn't have fields cf. </li>";
        } elseif ($len == 1) {
            echo "<li>Field cf1 is: " .
            $string .
            " - No description, only cf1 field present. </li>";
        } else {
            echo "<li>Field cf1 is: " .
            $string .
            " - More than four coin hopper types are being reported. </li>";
            $rest = substr($string, 1);
            $ln = strlen($rest);
            for ($i = 0; $i < $ln; $i += 2) {
                $pair = substr($rest, $i, 2);
                echo "<li>Field cf" . ($i/2) . " is: " . $pair . ". - Number of coins dispensed from hopper type" .($i/2) . "</li>";
            }
        }
    }

    function ciwFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field ci1, ci2, w. </li>";
        } elseif (strlen($string) == 1) {
            echo "<li>Field ci1 is: " .
            $string .
            " - No description, only ci1 field present. </li>";
        } else {
            echo "<li>Field ci1 is: " . substr($string, 0, 1) . " - Shows that voice guidance data is being reported.</li>";
            echo "<li>Field ci2 is: " . substr($string, 1, 2) . " - Voice guidance language identifier.</li>";
            if(strlen($string) >= 3) {
                echo "<li>Message doesn't have field w. </li>";
            } else {
                echo "<li>Field w is: " . substr($string, 3) . " -  Optional data fields.</li>";
            }
        }
    }

    function xFields($string)
    {
        if ($string == "") {
            echo "<li>Message doesn't have field x. </li>";
        } else {
            echo "<li>Field x is: " . $string . " - Message Authentication Code Data.</li>";
        }
    }
?>
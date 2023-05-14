<?php
    include "..\src\message.php";

    class Parser {
        private $fields;

        //Constructor
        public function __construct($message) {
            $message = addFS($message);
            //Seperate the fields
            $this->fields = explode("", $message);
        }

        //Getter
        public function getFields() {
            return $this->fields;
        }

        //Setter
        public function setFields($fields) {
            $this->fields = $fields;
        }

        //This function will add empty fields h and i if they are not present in the original message
        protected function addElement() {
            if (isset($this->fields[12]) && substr($this->fields[12], 0, 1) === "2") {
                $newFields = [];
                for ($i = 0; $i < count($this->fields); $i++) {
                    if ($i == 12) {
                        array_push($newFields, "");
                    }
                    array_push($newFields, $this->fields[$i]);
                }
                $this->setFields($newFields);
                return $this;
            } else {
                $this->setFields($this->fields);
                return $this;
            }
        }

        //This function will parse every field in the message
        public function transactionRequest(){
            //Normalize the fields list
            $this->addElement();
            abcFields($this->fields[0]);
            dField($this->fields[1]);
            eFields($this->fields[3]);
            fgFields($this->fields[4]);
            hFields($this->fields[5]);
            iFields($this->fields[6]);
            jFields($this->fields[7]);
            kFields($this->fields[8]);
            lFields($this->fields[9]);
            mFields($this->fields[10]);
            nFields($this->fields[11]);
            opFields($this->fields[12]);
            qrFields($this->fields[13]);
            avFields($this->fields[14]);
            awFields($this->fields[15]);
            axFields($this->fields[16]);
            ayFields($this->fields[17]);
            azFields($this->fields[18]);
            baFields($this->fields[19]);
            bbFields($this->fields[20]);
            bcFields($this->fields[21]);
            bdFields($this->fields[22]);
            caFields($this->fields[23]);
            cbFields($this->fields[24]);
            ceFields($this->fields[25]);
            cfFields($this->fields[26]);
            ciwFields($this->fields[27]);
            xFields($this->fields[28]);
        }
    }
?>
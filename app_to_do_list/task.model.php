<?php

    class Task {
        private $id;
        private $id_status;
        private $task;
        private $registration_date;
    
        public function __get($attribute) {
            return $this->$attribute;
        }

        public function __set($attribute, $value) {
            return $this->$attribute = $value;
        }
    }

?>
<?php

    class TaskService {    
        private $connection;
        private $task;

        public function __construct(Connection $connection, Task $task){
            $this->connection = $connection;
            $this->task = $task;
        }
        public function insert() {
            
        }

        public function get() {

        }

        public function update() {

        }

        public function delete() {

        }
    }

?>
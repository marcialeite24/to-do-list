<?php

    class TaskService {    
        private $connection;
        private $task;

        public function __construct(Connection $connection, Task $task){
            $this->connection = $connection->connect();
            $this->task = $task;
        }
        public function insert() {
            $query = 'insert into tb_tasks(task)values(:task)';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('task', $this->task->__get('task'));
            $stmt->execute();
        }

        public function get() {
            $query = '
                select 
                    t.id, s.status, t.task 
                from 
                    tb_tasks as t
                    left join tb_status as s on (t.id_status = s.id)
            ';
            $stmt = $this->connection->prepare($query);            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function update() {
            $query = 'update tb_tasks set task = :task where id = :id';
            //$query = 'update tb_tasks set task = ? where id = ?';
            $stmt = $this->connection->prepare($query);   
            $stmt->bindValue(':task', $this->task->__get('task'));
            //$stmt->bindValue(1, $this->task->__get('task'));
            $stmt->bindValue(':id', $this->task->__get('id'));
            //$stmt->bindValue(2, $this->task->__get('id'));  
            return $stmt->execute();
        }

        public function remove() {
            $query = 'delete from tb_tasks where id = :id';
            $stmt = $this->connection->prepare($query);  
            $stmt->bindValue(':id', $this->task->__get('id'));
            $stmt->execute();
        }

        public function markAsDone() {
            $query = 'update tb_tasks set id_status = ? where id = ?';
            $stmt = $this->connection->prepare($query);   
            $stmt->bindValue(1, $this->task->__get('id_status'));
            $stmt->bindValue(2, $this->task->__get('id'));  
            return $stmt->execute();
        }

        public function getPendingTasks() {
            $query = '
                select 
                    t.id, s.status, t.task 
                from 
                    tb_tasks as t
                    left join tb_status as s on (t.id_status = s.id)
                where 
                    t.id_status = :id_status
            ';
            $stmt = $this->connection->prepare($query);    
            $stmt->bindValue('id_status', $this->task->__get('id_status'));       
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }

?>
<?php

class TasksModel extends Db{
    public function __construct(){
        parent::__construct();
    }

    public function getList($pag,
                            $order = "")
    {
        return $this->db->query("SELECT * FROM `tasks` {$order} LIMIT {$pag['start_record']}, {$pag['record_on_page']}")->fetchAll();
    }

    public function getCountTask()
    {
        return $this->db->query("SELECT COUNT(*) as count FROM `tasks` ")->fetch()['count'];
    }

    public function add($user_name,
                            $email,
                            $text)
    {
        $task = $this->db->prepare("INSERT INTO `tasks`(`user_name`, `text`, `email`) 
                                                    VALUES (".  $this->db->quote($user_name).",".
                                                                $this->db->quote($text).",".
                                                                $this->db->quote($email).")");
        $task->execute();

    }

    public function change( $id,
                            $user_name,
                            $email,
                            $text,
                            $complete,
                            $flag_edit)
    {
        $task = $this->db->prepare("UPDATE `tasks` 
                                                    SET `user_name` = ".$this->db->quote($user_name).", `text` = ".$this->db->quote($text).",
                                                        `email` = ".$this->db->quote($email).",`complete` = ".$complete." , `edited_text` = ".$this->db->quote($flag_edit)."
                                                    WHERE `id` = ".$this->db->quote($id));
        $task->execute();
    }

    public function getTaskById($id){
        return $this->db->query("SELECT * FROM `tasks` WHERE id=".$this->db->quote($id))->fetch();
    }
}
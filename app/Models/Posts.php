<?php

namespace App\Models;

class Posts extends Model
{

public function posts()
{
    $this->db->query('SELECT * FROM posts ORDER BY id DESC ' );
    $rows = $this->db->resultSet();
    if($this->db->rowCount() > 0){
        return $rows;
    }else{
        return false;
    }
}
    public function store($data){
        $this->db->query('INSERT INTO posts (title, body,createdDate,user_id) 
        VALUES (:title, :body, :createdDate,:user_id)');
        //Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':createdDate', $data['createdDate']);
        $this->db->bind(':user_id', $data['user_id']);
        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function update($id,$data){
        $this->db->query('UPDATE posts SET title=:title, body=:body WHERE id=:id');
        //Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':id', $id);
        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function findById($id){
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }
    public function delete($id){
        $this->db->query('DELETE FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        //Check row
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}
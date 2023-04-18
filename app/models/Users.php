<?php

class Users {
    use Model;
    protected $table = 'users';

    protected $allowedColumns = [
        'email',
        'password'
    ];
    public function get() {
        return $this->select();
    }
    public function validate($data){
        $this->errors = [];

        if(empty($data['phone'])){
            $this->errors['phone'] = "Yêu cầu nhập số điện thoại!";
        }

        if(empty($data['password'])){
            $this->errors['password'] = "Yêu cầu nhập mật khẩu!";
        }

        if(empty($data['email'])){
            $this->errors['email'] = "Yêu cầu nhập email!";
        }

        if(empty($data['address'])){
            $this->errors['address'] = "Yêu cầu nhập địa chỉ!";
        }

        if(empty($this->errors)){
            return true;
        }
        
        return false;
    }
    public function data_table() { //get table employee info
        $sql = "SELECT * FROM users";
		$result = $this->query($sql);
		return $result; 

    }
    public function get_employee(){
		global $db;
		$stmt = $db->query("SELECT * FROM users");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function add_employee($id, $name, $email, $phone, $address, $gender,$type){
        global $db;
        $stmt = $db->prepare("INSERT INTO users (id, name, email, phone, address, gender,type) VALUES (?, ?,?,?,?,?,?)");
        $stmt->execute(array($id, $name, $email, $phone, $address, $gender,$type));
        return $db->lastInsertId();
    }
    public function edit_employee($id, $name, $email, $phone, $address, $gender,$type){
		global $db;
		$stmt = $db->prepare("UPDATE Products SET name = ?, description = ?, price =? WHERE id = ? ");
		$stmt->execute(array($id, $name, $email, $phone, $address, $gender,$type));
		return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function delete_employee($id){
        global $db;
        $stmt = $db->prepare("DELETE FROM users WHERE id = ? ");
        $stmt->execute(array($id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
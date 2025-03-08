<?php 

namespace App\Models;

use CodeIgniter\Model;

class M_Auth extends Model{
    protected $table='tb_admin';

    public function __construct(){
       $this->db = db_connect();
       $this->builder=$this->db->table($this->table);
    }

    public function login($username, $password){
        $data = $this->builder->where("username", $username)->get()->getRowArray();

        if($data !== null){
        	if($data['password'] == $password){
	        	session()->set([
	        		'id' => $data['id'],
	        		'username' => $data['username'],
	        	]);

	        	return true;
        	}else{
        		session()->setFlashdata('warning', 'Password salah');
        		return false;
        	}
        }else{
        	session()->setFlashdata('warning', 'Password salah');
        	return false;
        }
    }
}
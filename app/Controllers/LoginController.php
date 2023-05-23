<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

//was extending MainController tua dies später ändru
class LoginController extends MainController
{
	public function register(){
        return view('Login/register');
    }

	public function login(){
        return view('Login/login');
    }

	public function process_login(){
		$user_name = $this->request->getVar('user_name');
		$pass = $this->request->getVar('pass');
		$data = array();
		$data['hashed_pass'] = password_hash($pass, PASSWORD_DEFAULT);
		$db = db_connect();
		$query = $db->query("SELECT id, user_name, pass
							FROM users
							WHERE user_name='$user_name'");
		$num_rows = $query->getNumRows();
		$row = $query->getRow();
		if($num_rows ===1){
			$pass_db = $row->pass;
			$id_db = $row->id;
			if(password_verify($pass,$pass_db) ===true){
				$session = session();
				//$todays_date = Time::now('Europe/Zurich');
				$todays_date = date('Y-m-d');
				$newdata = [
					's_user_name'  => $user_name,
					's_id'     => $id_db,
					'selected_date' => $todays_date,
					'logged_in' => true,
				];
				$session->set($newdata);			
				return $this->main();
			}
			$session = session();
			$session->login_unsuccessful = true;
			return $this->login();
		}
		$session = session();
		$session->login_unsuccessful = true;
		return $this->login();
	}

	public function submit_register(){
		$pass = $this->request->getVar('pass');
		$pass_confirm = $this->request->getVar('pass_confirm');
		$data_pass = array();		
		$data_pass['hashed_pass'] = password_hash($pass, PASSWORD_DEFAULT);
        $data = [
            'user_name' =>$this->request->getVar('user_name'),
			'pass' =>$data_pass['hashed_pass'],
            'pass_confirm' =>$this->request->getVar('pass_confirm'),
            'first_name' =>$this->request->getVar('first_name'),
			'last_name' =>$this->request->getVar('last_name'),
			'company' =>$this->request->getVar('company'),
        ];
		$rules = [
			'user_name' => 'required|is_unique[users.user_name]',
			'pass' => 'required|min_length[7]|max_length[73]',
			'pass_confirm' => 'required',
		];
		if ($this->validate($rules)  && $pass_confirm === $pass) {
			$user = new UserModel();
			$user->insert($data);
			return $this->login();
        }else{
			$session = session();
			$session->register_unsuccessful = true;
			return $this->register();
		}
    }
	
}
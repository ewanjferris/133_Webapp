<?php

namespace App\Controllers;
use App\Models\PostModel;
use CodeIgniter\I18n\Time;

class MainController extends BaseController
{
    public function main(){
        $session = session();
		if($session->logged_in === true){
            $session->set('date_from_main', $session->selected_date);
            return $this->get_posts();
		}else{
			return view('Login/login');
		}
    }

    public function destroy_session(){
        $session = session();
        //$array_items = ['s_user_name', 's_id', 'logged_in', 'selected_date'];
        //$session->remove($array_items);
        $session->destroy();
        return view('Login/login');
    }

    public function get_posts(){
        $session = session();
        $new_selected_date = $this->request->getVar('selected_date');
        if($new_selected_date != $session->selected_date){
            $session->selected_date= $new_selected_date;
        }
        if ($session->selected_date === NULL){
            //returns the correct current date instead of the default
            $session->selected_date = $session->date_from_main;
        }
        $db = db_connect();
        $query   = $db->query("SELECT id,selected_date,time_from, time_to, content 
                                FROM posts 
                                WHERE fk_user_id ='$session->s_id'
                                AND selected_date='$session->selected_date'");
        $results = $query->getResultArray();
        $data['posts'] = $results;
        return view('Main/main', $data);
    }

    public function create_post(){
        $session = session();
        //$session->selected_date = $this->request->getVar('selected_date');
        $data = [
            'content' =>$this->request->getVar('content'),
            'fk_user_id' => $session->s_id,
            'selected_date' => $session->selected_date,
            'time_from' =>$this->request->getVar('time_from'),
            'time_to' =>$this->request->getVar('time_to'),
        ];
        $post = new PostModel();
		$post->insert($data);
        $session->create_successful = true;
		return $this->main();
    }

    public function delete_post(){
        $db = db_connect();
        $post_id = $this->request->getVar('del_btn');
        $query   = $db->query("DELETE FROM posts 
                                WHERE id ='$post_id'");
        $session = session();                                
        $session->delete_successful = true;
        return $this->main();
    }

    public function edit_post(){
        $db = db_connect();
        $new_time_from = $this->request->getVar('edit_time_from');
        $new_time_to = $this->request->getVar('edit_time_to');
        $new_content = $this->request->getVar('edit_content');
        $post_id = $this->request->getVar('save_edit_btn');
        $query = $db->query("UPDATE posts
                            SET  time_from = '$new_time_from',
                            time_to = '$new_time_to',
                            content = '$new_content' 
                            WHERE id ='$post_id' ");
        $session = session();
        $session->edit_successful = true;
        return $this->main();
    }
        
}
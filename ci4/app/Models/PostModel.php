<?php namespace App\Models;

use CodeIgniter\Model;

    class PostModel extends Model
    {
        protected $table ='posts';
        protected $primaryKey = 'id';
        protected $allowedFields = [
            'id',
            'fk_user_id',
            'selected_date',
			'time_from',
			'time_to',
			'content'
        ];

    }
?>
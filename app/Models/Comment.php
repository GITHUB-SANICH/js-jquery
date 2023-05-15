<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
	 protected $table = "comments_article";

	//метод вывода комментария
	public function user(){
		return $this->belongsTo('App\Models\User');
	} 

	public function avtor_komm(){
		return $this->belongsTo('App\Models\User', 'avtor_comment_id');
	}

		//метод вывода комментария
		public function article(){
			return $this->belongsTo('App\Models\Article');
		}
}

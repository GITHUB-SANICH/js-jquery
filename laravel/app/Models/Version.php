<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    use HasFactory;

	 protected $fillable = [
		 'title',
		 'release_data',
	 ];

	 protected $dates = [
		'release_data'
	 ]; 

	 protected $casts = [
		'release_data' => 'date:Y-m-d'
	 ]; 

	 protected $hidden = [
		'created_at',
		'updated__at'
	 ]; 

}

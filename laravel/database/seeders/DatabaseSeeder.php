<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();

			Post::factory(10)->create();
			AdminUser::factory(1)->create([				//число тестовых записей
				"name" 		=> "Admin",						//фиксируемое значение поля
				"email"		=> "Laravel@laravel.com",	//фиксируемое значение почты
				"password"	=> bcrypt("12345"),			//фиксируемое значение пароля
			]);
    }
}

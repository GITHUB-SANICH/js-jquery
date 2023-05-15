<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Symfony\Contracts\Service\Attribute\Required;
use App\Mail\ForgotPassword;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
	//выывод формы авторизации
	public function showLoginForm()
	{
		return view("auth_.login");
	}

	//вывод формы регистрации
	public function showRegisterForm()
	{
		return view("auth_.register");
	}

	//вывод формы замены пароля
	public function showForgotForm()
	{
		return view("auth_.forgot");
	}
	
	//регистрация
	public function register(Request $request)
	{
		$data = $request->validate([
			"name" => ["required", "string"],
			"email" => ["required", "email", "string", "unique:users,email"],
			"password" => ["required", "confirmed"]
		]);

		$user = User::create([
			"name" => $data['name'],
			"email" => $data['email'],
			"password" => bcrypt($data['password']),
		]);

		if ($user) {
			auth("web")->login($user);
			return redirect(route("home"));
		}
	}

	//замена пароля
	public function forgot(Request $request)
	{
		$data = $request->validate([
			"email" => ["required", "email", "string", "exist:users"],
		]);

		$user = User::where(["email" => $data['email']])->first();

		$password = uniqid();
		$user->password = bcrypt($password);
		$user->save();
		Mail::to($user)->send(new ForgotPassword($password));
		//добавление задачи в очередь 3-мя способами
			//1. dispatch(new ForgonUserEmailJob($user, $password));
			//2. $this->dispatch(new ForgonUserEmailJob($user, $password));
			//3. ForgonUserEmailJob::dispatch($user, $password);	
		return redirect(route("home"));
	}
	
	//логирование
	public function login(Request $request)
	{
		$data = $request->validate([
			"email" => ["required", "email", "string"],
			"password" => ["required"],
		]);

		if (auth("web")->attempt($data)) {
			return redirect(route("home"));
		}

		return redirect(route("login"))->withErrors([
			"email" => 'Пользователь не найден, либо данные введены с ошибками'
		]);
	}

	//разлогирование
	public function logout()
	{
		auth("web")->logout();
		return redirect(route("home"));
	}
}

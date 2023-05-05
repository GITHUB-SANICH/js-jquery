<?php
class User extends Controller
{
	public function reg()
	{
		//массив, который будет передаваться в шаблон после обработки данных в моделе...изначально он пуст
		$data = [];
		//проверка передачи данных из формы методом POST
		//проверка при наличии любого из полей формы
		if (isset($_POST['name'])) {
			//создание объекта на основе модели через родительский клас контроллера
			$user = $this->model('UserModel');
			//передача данных формы в модель
			$user->setData($_POST['name'], $_POST['email'], $_POST['pass'], $_POST['re_pass']);
			//проверка полученных данных на валидность - переменная $isValide содерджит в себе результат проверки данных из формы
			$isValid = $user->validForm($_POST['email']);
			if ($isValid == "Все данные введены корректно!")
				//запись данных пользхователя в БД, хеширование, редирект в КБ
				$user->addUser();
			else
				$data['message'] = $isValid;
		}
		//вывод шаблона с передачей в него массива с данными
		$this->view('user/reg', $data);
	}

	//передаем в кабинет пользователя данные зарегистрированного пользователя
	public function dashboard()
	{
		//проверка пользователя на авторизованность
		if (!isset($_COOKIE['login'])) {
			header('Location: /user/auth');
		}

		$data = [];
		$user = $this->model('UserModel');
		//если пользователь нажал на кнопку выхода из учетной записи - выполняется метод обнуления и удаления куки. 
		if (isset($_POST['exit_btn'])) {
			$user->logOut();
			exit();
		}

		//принятие картинки из формы
		if (isset($_FILES['userImg'])) {
			$file = [
				'fileName' => $_FILES['userImg']['name'],
				'fileSize' => $_FILES['userImg']['size'],
				'fileTmp'  => $_FILES['userImg']['tmp_name']
			];

			//метод добавления файла на сервер и БД
			$data['message'] = $user->setImg($file);
		}
		$data['user'] = $user->getUser();
		$this->view('user/dashboard', $data);
	}

	//метод, принимающий значения из формы авторизации
	public function auth()
	{
		//если не создать масси, то он создается при налиии POST данных. Тогда возможна ситуация, когда передается не объявленный массив, если условие не сработало. И выдастся ошибка.
		$data = [];
		//при наличии передаваемого поля 'email' - обращатсья к методу проверки и авторизации
		if (isset($_POST['email'])) {
			$user = $this->model('UserModel');
			$data['message'] = $user->auth($_POST['email'], $_POST['pass']);
		}
		$this->view('user/auth', $data);
	}
}

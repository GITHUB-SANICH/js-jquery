<?php
require 'DB.php';

class UserModel
{
	//БЛОК С ПОДКЛЮЧЕНИЕМ К БД
	//поле с подключением к бд
	private $_db = '';

	//поля, вмещаемые в себя значения формы
	private $name;
	private $email;
	private $pass;
	private $re_pass;

	//при создании объекта модели создается подключение к БД
	public function __construct()
	{
		$this->_db = DB::getInstence();
	}

	//БЛОК РАБОТЫ С ФОРМОЙ РЕГИСТРАЦИИ
	//метод, прнимающий значения формы при вызове
	public function setData($name, $email, $pass, $re_pass)
	{
		$this->name = trim($name);
		$this->email = trim($email);
		$this->pass = trim($pass);
		$this->re_pass = trim($re_pass);
	}

	//методы по проверки полей на корректность ввода
	public function validForm()
	{
		//поиск в БД почты по email
		$result = $this->_db->query("SELECT * FROM `users` WHERE `email` = '$this->email'");
		//помещаем результат запроса в переменную
		$proverka = $result->fetch(PDO::FETCH_ASSOC);

		if (strlen($this->name) < 3) {
			return "Слово должно иметь более трех букв";
		} else if (strlen($this->email) < 3) {
			return "Вводимый email слишком короткий";
			//is_numeric - функция проверки 
		} else if ($proverka['email'] == $this->email) {
			return 'Пользователь с таким логином уже зарегистрирован';
		} else if (strlen($this->pass) < 3) {
			return "Пароль пароль по больше";
		} else if ($this->pass != $this->re_pass) {
			return "Пароли не совпадают";
		} else {
			return "Все данные введены корректно!";
		}
	}

	//метод добавления пользователя в БД
	public function addUser()
	{
		$sql = "INSERT INTO  users(name, email, pass, image) VALUE (:name, :email, :pass, :image)";
		//через подключение к БД обратиться к методу подготовки запоса к выполнению
		$query = $this->_db->prepare($sql);
		//хеширование пароля
		$pass = password_hash($this->pass, PASSWORD_DEFAULT);
		//передача данных в БД
		$query->execute(['name' => $this->name, 'email' => $this->email, 'pass' => $pass, 'image' => 'kot_user.jpg']);
		//автороизация
		$this->setAuth($this->email);
		return 'Все данные введены корректно!';
	}

	//метод выхода из учетной записи
	public function logOut()
	{
		//удаление куки
		setcookie('login', $this->email, time() - 3600, '/');
		unset($_COOKIE['login']);
		//редирект пользователя на страницу авторизации
		header('Location: /user/auth');
	}



	//БЛОК РАБОТЫ С АВТОРИЗАЦИЕЙ
	//метод, авторизирующий пользователя
	public function auth($email, $pass)
	{
		//поиск в БД почты по email
		$result = $this->_db->query("SELECT * FROM `users` WHERE `email` = '$email'");
		//помещаем результат запроса в переменную
		$proverka = $result->fetch(PDO::FETCH_ASSOC);

		if ($proverka['email'] == '') {
			return 'Данный пользователь не зарегистрирован на сайте';
		} else if (password_verify($pass, $proverka['pass'])) {	//меод проверки ав
			//авторизация
			$this->setAuth($email);
		} else {
			return 'Пароли не совпадают';
		}
	}


	//БЛОК РАБОТЫ С РЕГИСТРАЦИЕЙ И АВТОРИЗАЦИЕЙ
	//вывод данных пользователя
	public function getUser()
	{
		$email = $_COOKIE['login'];
		$result = $this->_db->query("SELECT * FROM `users` WHERE `email` = '$email'");
		return $result->fetch(PDO::FETCH_ASSOC);
	}

	//метод объявления куки и переадресации пользователя (авторизация).
	public function setAuth($email)
	{
		//объявление куки
		setcookie('login', $email, time() + 3600, '/');
		//редирект пользователя на кабинет пользователя
		header('Location: /user/dashboard');
	}


	//БЛОК С ЗАГРУЗКОЙ КАРТИНОК
	public function setImg($file)
	{
		//проверки
		if ($file['fileSize'] >= 512000) {
			return 'Загружаемый файл не должен привышать размера в 500кб';
		} elseif (strlen($file['fileName']) > 25) {
			return 'Название файла не должно привышать 25 символов';
		} elseif (!isset($_COOKIE['login'])) {
			return 'Изображение добавляется только авторизованными пользователями';
		} else {
			//загружка файла на сервер
			//разделение имени файла на масиив по точке
			$arrayName = explode('.', $file['fileName']);
			//новое имя файла
			$file['fileName'] = $arrayName[count($arrayName) - 2] . '_' . time() . '.' . $arrayName[count($arrayName) - 1];
			$uploadDir = 'public/img/imgUsers/'; //Директория на сервере, для загружаемых файлов
			//загружка файла из временного хранилища в постоянное
			move_uploaded_file($file['fileTmp'], $uploadDir . $file['fileName']);
			//если файл найден в деритории
			if (file_exists($uploadDir . $file['fileName'])) {
				//добавление имени изображения в БД
				$email = $_COOKIE['login'];
				$sql = "UPDATE `users` SET `image` = :fileName WHERE `email` = :email";
				//через подключение к БД обратиться к методу подготовки запоса к выполнению
				$query = $this->_db->prepare($sql);
				//передача данных в БД
				$query->execute(['fileName' => $file['fileName'], 'email' => $email]);
			} else {
				return 'Файл не загружен';
			}
		}

		//добавление файла на сервер
		//move_uploaded_file(временное место, место на сервере).
	}
}

<?php
class Home extends Controller{	//контроллер, выводящий главную страницу на сайт
	public function index(){ //при переходе на страницу функция принимает доп.параметр
		$data = [];
		if ($_COOKIE['login'] != '') {
			$gLink = $this->model('LinkModel');
			$gLink->setUserId($_COOKIE['login']);
			//передача данных формы в модель
			$data['links'] = $gLink->getLinks();
		}

		//вывод шаблона с передачей в него данных вывода товаров с сортровкой.
		$this->view('home/index', $data); //обращение к функции вызова страницы для вызова на экран. Первый аргумент - адрес файла. Второй - массив с доп.параметрами. 
	} 

	public function reg(){
		//массив, который будет передаваться в шаблон после обработки данных в моделе...изначально он пуст
		$data = [];
		//проверка передачи данных из формы методом POST
		//проверка при наличии любого из полей формы
		if(isset($_POST['name'])) {
			//создание объекта на основе модели через родительский клас контроллера
			$user = $this->model('UserModel');
			//передача данных формы в модель
			$user->setData($_POST['name'], $_POST['email'], $_POST['pass'], $_POST['re_pass']);
			//проверка полученных данных на валидность - переменная $isValide содерджит в себе результат проверки данных из формы
			$isValid = $user->validForm();
			if($isValid == "Все данные введены корректно!")
			//запись данных пользхователя в БД, хеширование, редирект в КБ
				$user->addUser();
			else
				$data['message'] = $isValid;
		}
		//вывод шаблона с передачей в него массива с данными
		$this->view('home/index', $data);
	}

	//вызов метода по проверки ссылок и  добавлению их в базу
	public function link(){
		$data = [];
		if(isset($_POST['longLink']) || isset($_POST['shortLink'])) {
			//создание объекта на основе модели через родительский клас контроллера
			$link = $this->model('LinkModel');
			//передача данных формы в модель
			$link->setData($_POST['longLink'], $_POST['shortLink']);
			$link->setUserId($_COOKIE['login']);
			//проверка полученных данных на валидность - переменная $isValide содерджит в себе результат проверки данных из формы
			$isValid = $link->validForm();
			if($isValid == "Ссылка и сокращение корректны")
			//добавление ссылки и сокращения в базу
			//$data['message'] = ($_COOKIE['login'] != '') ? $link->addLink() : '';
				$link->addLink();
			else
				$data['message'] = $isValid;
		}

		//вывод шаблона с передачей в него массива с данными
		$this->view('home/index', $data);
	}

	//меотд удаления ссылки
	public function dropShort(){
		$data = [];
		if(isset($_POST['deleteLink'])) {
			//создание объекта на основе модели через родительский клас контроллера
			$link = $this->model('LinkModel');
			//передача данных формы в модель
			$data['message'] = ($_COOKIE['login'] != '') ?  $link->dropLink($_POST['deleteLink']) : '';
		}

		//вывод шаблона с передачей в него массива с данными
		$this->view('home/index', $data);
	}
}

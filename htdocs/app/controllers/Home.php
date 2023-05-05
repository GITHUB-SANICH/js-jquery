<?php
class Home extends Controller{	//контроллер, выводящий главную страницу на сайт
	public function index(){ 		//при переходе на страницу функция принимает доп.параметр
		$data = [];
		//регистрация пользователя
		if(isset($_POST['name'])) {
			//создание объекта на основе модели через родительский клас контроллера
			$user = $this->model('UserModel');
			//передача данных формы в модель
			$user->setData($_POST['name'], $_POST['email'], $_POST['pass'], $_POST['re_pass']);
			//проверка полученных данных на валидность - переменная $isValide содерджит в себе результат проверки данных из формы
			$isValid = $user->validForm();
			if($isValid == "Все данные введены корректно!")
				$user->addUser();
			else
				$data['message'] = $isValid;
		}

		//добавление ссылок
		if(isset($_POST['longLink']) || isset($_POST['shortLink'])) {
			$link = $this->model('LinkModel');
			$link->setData($_POST['longLink'], $_POST['shortLink']);
			$link->setUserId($_COOKIE['login']);
			$isValid = $link->validForm();
			if($isValid == "Ссылка и сокращение корректны")
				$data['message'] = ($_COOKIE['login'] != '') ? $link->addLink() : '';
			else
				$data['message'] = ($_COOKIE['login'] != '') ? $isValid : '';
		}

		//вывод всех сокращенных ссылок пользователя
		if ($_COOKIE['login'] != '') {
			$gLink = $this->model('LinkModel');
			$gLink->setUserId($_COOKIE['login']);
			$data['links'] = $gLink->getLinks();
		}

		//удаления ссылки
		if(isset($_POST['deleteLink'])) {
			$drop = $this->model('LinkModel');
			$data['message'] = ($_COOKIE['login'] != '') ?  $drop->dropLink($_POST['deleteLink']) : '';
		}

		//для аякс
		if ($data['message'] == 'Ссылка удалена') {
			echo 'Ссылка удалена';
		}

		//вывод шаблона с передачей в него данных
		$this->view('home/index', $data); //обращение к функции вызова страницы для вызова на экран. Первый аргумент - адрес файла. Второй - массив с доп.параметрами. 
	} 
}


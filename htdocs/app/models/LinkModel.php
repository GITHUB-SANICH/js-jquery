<?php
//подключение к БД через класс DB
require 'DB.php';

class LinkModel
{
	//переменная, хранящая подключеник к БД. Удобнее обращаться к БД через поле, а не через статический метод. 
	private $_db = null;
	//сокращенеи ссылки
	private $longLink;
	//сокращенеи ссылки
	private $shortLink;
	//сокращенеи ссылки
	private $userId;

	//подключение к БД при создании объекта на основе класса LinkModel через конструктор и приравнивание ее к полю класса
	public function __construct()
	{
		$this->_db = DB::getInstence();
	}

	//метод, прнимающий значения формы при вызове
	public function setData($long, $short)
	{
		$this->longLink = trim($long);
		$this->shortLink = trim($short);
	}

	//запись ID пользователя по логину
	public function setUserId($login)
	{
		$sql = $this->_db->query("SELECT `id` FROM `users` WHERE `email` = '$login'");
		$userId = $sql->fetch(PDO::FETCH_ASSOC);
		$this->userId = $userId['id'];
	}

	//методы по проверки полей на корректность ввода
	public function validForm()
	{
		//поиск в БД id по почте
		$result = $this->_db->query("SELECT `short_link` FROM `links` WHERE `short_link` = '$this->shortLink'");
		//помещаем результат запроса о наличии вводимого сокращения в базе в переменную
		$proverka = $result->fetch(PDO::FETCH_ASSOC);

		//проверка сокращения
		if (strlen($this->shortLink) < 2) {
			return "Сокращение должно иметь более 1-го символа";
		} else if (strlen($this->shortLink) > 10) {
			return "Сокращение и ссылка не должны превышать 10-ти символов";
		} else if ($proverka['short_link'] == $this->shortLink) {
			return 'Это сокращение уже занято';
		}

		//проверка длинной ссылки
		if ($this->longLink != '') {
			// Помещаем заголовки URL в массив 
			$linkHeaders = get_headers(trim($this->longLink));
			// Если ответ сервера 404, то значит URL неверный был передан
			if (!$linkHeaders || strpos($linkHeaders[0], '404')) {
				return "Введенаня ссылка не корректна";
			} else {
				return "Ссылка и сокращение корректны";
			}
		} else {
			return ($this->userId != '') ? 'Введите ссылку' : '';
		}
	}

	//метод добавления ссылки и сокращения в БД
	public function addLink()
	{
		//sql - запрос на добавление ссылки и сокращения от пользователя
		$sql = "INSERT INTO  links(user_id, long_link, short_link) VALUE (:user_id, :long, :short)";
		//через подключение к БД обратиться к методу подготовки запоса к выполнению
		$query = $this->_db->prepare($sql);
		//передача данных в БД
		$query->execute(['user_id' => $this->userId, 'long' => $this->longLink, 'short' => $this->shortLink]);
		return 'Ссылка успешно сокращена';
	}

	//метод, выводящий ссылки
	public function getLinks()
	{
		$result = $this->_db->query("SELECT `long_link`, `short_link` FROM `links` WHERE `user_id` = '$this->userId'");
		//через подключение к БД обратиться к методу подготовки запоса к выполнению
		$links = $result->fetchAll(PDO::FETCH_OBJ);
		return $links;
	}

	//метод редиректа 
	public function redirect($shortLink)
	{
		//sql - запрос на добавление ссылки и сокращения от пользователя
		$sql = $this->_db->query("SELECT `long_link` FROM `links` WHERE `short_link` = '$shortLink'");
		//массви с ссылкой для перехода
		$link = $sql->fetch(PDO::FETCH_ASSOC);
		$url = $link['long_link'];
		return header("Location: $url");
	}

	//удаление ссылки
	public function dropLink($deleteLink)
	{
		$this->_db->prepare("DELETE FROM `links` WHERE `short_link` = :del")->execute(['del' => $deleteLink]);
		$url = $_SERVER['HTTP_HOST'];
		//return header("Location: $url");
		return 'Ссылка удалена';
	}
}

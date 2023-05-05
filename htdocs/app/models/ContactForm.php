<?php
//подключение автозагрузчика
require '../vendor/autoload.php';

// Подключение библиотеки PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContactForm{
	//поля, вмещаемые в себя значения формы
	private $name;
	private $email;
	private $topic;
	private $message;

	//метод, прнимающий значения формы при вызове
	public function setData($name, $email, $topic, $message){
		$this->name = $name;
		$this->email = $email;
		$this->topic = $topic;
		$this->message = $message;
	}
	
	//методы по проверки полей на корректность ввода
	public function validForm(){
		if(strlen($this->name) <= 3){
			return "Слово должно иметь более трех букв";
		}else if (strlen($this->email) < 3) {
			return "Вводимый email слишком короткий";
		}else if ($this->email == 'sani4.mocrousov@yandex.ru') {
			return "Нельзя посылать сообщение самому себе)";
		}else if (strlen($this->topic) < 2) {
			return "Введите тему сообщения";
		}else if (strlen($this->topic) > 10) {
			return "Тема не должна превышать 10-ти символов";
		}else if (strlen($this->message) < 10) {
			return "Сообщение слишком короткое";
		}else{
			return "Все данные введены корректно!";
		}
	}

	//функция отправки сообщения на почту
	public function mail(){
		// Создаем письмо
		$mail = new PHPMailer(true);
		$mail->CharSet = 'UTF-8';									//кодировка
		$mail->isSMTP();												// Отправка через SMTP
		$mail->Host   = 'smtp-relay.sendinblue.com';			// Адрес SMTP сервера
		$mail->SMTPAuth   = true;									// Включить проверку подлинности SMTP
		$mail->Username   = 'sani4.mocrousov@yandex.ru';	// ваше имя пользователя SMTP 
		$mail->Password   = 'Sani4051992!';						// ваш пароль SMTP
		$mail->SMTPSecure = 'ssl';         						// шифрование ssl
		$mail->SMTPKeepAlive = true; 								//	SMTP-соединение не закрывается после каждого отправленного письма, уменьшает накладные расходы SMTP
		$mail->Port   = 587;               						// порт подключения
		$mail->SMTPDebug = 1; 										//сообщение от SMTP серверка о процессе подключения
		$mail->setFrom($this->email, $this->name);					// от кого
		$mail->addAddress('sani4.mocrousov@yandex.ru', 'Получатель'); 	// кому
		$mail->Subject = $this->topic;											//Тема письма
		
		//создание объекта Parsedown
		//$Parsedown = new Parsedown();
		//$message = $Parsedown->text("	# Добрый день!●● 
		/*									*Это сообщение, проверяющее работу библиотеки Parsedown*");*/
		//сообщение
		$mail->msgHTML($this->message);
		// Отправляем
		if ($mail->send()) {
			return 'Письмо отправлено!';
		} else {
			return 'Ошибка: ' . $mail->ErrorInfo;
		}
		
		//ВАЖНО!На локальном сервере возможность отправки сообщения не предусмотрена!
	}
}

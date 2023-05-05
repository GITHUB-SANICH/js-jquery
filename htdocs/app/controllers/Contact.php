<?php
class Contact extends Controller {
public function index() {
		$data = [];
		if(isset($_POST['name'])) {
			$mail = $this->model('ContactForm');
			$mail->setData($_POST['name'], $_POST['email'], $_POST['topic'], $_POST['message']);
			//проверка полученных данных на валидность - переменная $isValide содерджит в себе результат проверки данных из формы
			$isValid = $mail->validForm();
			if($isValid == "Все данные введены корректно!")
				$data['message'] = $mail->mail();
			else
			//если в заполнении формы были ошибки, то заподлнить передаваемый массив сообщением об ошибке. 
				$data['message'] = $isValid;
		}
		//вывод шаблона с передачей в него массива с данными
		$this->view('contact/index', $data);
	}

	public function about() {
		$data = [];
		$this->view('contact/about', $data);
	}

}
<?php
class Error404 extends Controller {
	public function index(){
			//вывод шаблона с передачей в него массива с данными
			$this->view('errors/404'); //путь до выводимого шаблона
		}
	}

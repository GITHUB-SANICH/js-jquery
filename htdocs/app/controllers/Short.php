<?php
class Short extends Controller{
	public function index($shortLink){
		$goToLink = $this->model('LinkModel');
		//вызов редиректа по сокращенной ссылке
		$goToLink->redirect($shortLink);
	}	
}
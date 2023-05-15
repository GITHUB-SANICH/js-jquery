
let formBtn = document.querySelector("#comments-form button"); //кнопка формы
let countComments = 0; // число комментариев по-умолчанию
let idComment = 0; // id комментария

//события
formBtn.onclick = function () {
	let formInner = document.querySelector("#comments-form");
	if (formInner.name.value.length < 4) {
		document.querySelector("#error").innerHTML = "Длина имени не менее 4-х символов";
		return false; //прерывание дальнейшего выполнения функции/условия в случаи ошибки
	} else if (formInner.comment.value.length < 10) {
		document.querySelector("#error").innerHTML = "Длина сообщения не менее 10-ти символов";
		return false;
	}
	//очищение блока с ошибкой в случаи, если все ошибки исправлены.
	document.querySelector("#error").innerHTML = '';
	//установка новых значений в подсчете комментариев
	if (countComments == 0) {
		document.querySelector("#comments").innerHTML = '';
	} 
		idComment++;	//id комментария
		countComments++; //число комментариев
		document.querySelector(".count-comm").innerHTML = countComments;
	//создание коммнетария
	//переменная со строкой комментария
	let newComment = 
		"<div class='comment' id='nummer-"+idComment+"'>" +
			"<span class='delete' onclick='delComm("+idComment+")'>&times;</span>" +
			"<p class='name'>" + formInner.name.value + "</p>" +
			"<p class='mess'>" + formInner.comment.value + "</p>" +
		"</div>";
	
		//&times; - символ крестика для закрытия
		//добавление элемента в указанное место родительского блока
			document.querySelector("#comments").insertAdjacentHTML('afterbegin', newComment);
	
		//очистка формы (поля с комментарием) после добавления комментария
			formInner.comment.value = '';
		};
		
		//функция удаления комментария
			function delComm(id) {
				document.querySelector("#nummer-"+id).remove(); //удаление комментария с Id == nummer-id
				countComments--; 
				document.querySelector(".count-comm").innerHTML = countComments;
				if (countComments == 0) {
					document.querySelector("#comments").innerHTML = 'Пока комментариев нет';
				}
			}

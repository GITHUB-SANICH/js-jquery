<script>
		//AJAX
		function deleteLink(short_link) {
			$.ajax({
				url: '/home/', 
				type: 'POST', 
				cache: false, 
				data: {
					'deleteLink': short_link
				}, 
				dataType: 'html', //способ получения данных
				success: function(data) { //success - это функция, обрабатываемая после получения ответа от обработчика. Где аргументом всегда выступает "data". Data - это любое сообщение, полученное от отработчика через оператор echo.
					if (data.includes('Ссылка удалена')) { //если обработчик прислал сообщение "Ссылка удалена" через оператор echo.
						$('#' + short_link).remove();									
						$('#successMessage_del').show();	//открытие скрытого элемента с id=successMessage_reg
						$('#successMessage_del').text('Ссылка удалена'); //вывод сообщение в блоке с id=successMessage_reg
						$('#errorMessage_del').hide(); //скрытие блока с опоещением о ошибке
					} else { //если обработчик НЕ прислал сообщение "Ссылка удалена" через оператор echo. Т.е. прислал ошибку.
						$('#errorMessage_del').show(); //открытие скрытого элемента с id=errorMessage_del
						$('#errorMessage_del').text('Ссылка не удалена'); //вывод сообщение в блоке с id=errorMessage_del
						$('#successMessage_del').hide();
					}
				}
			});
		}
	</script>
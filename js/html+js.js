//#2.1 - Окружение DOM, BOM, JS
console.log('');
console.log('#2.1 - Окружение DOM, BOM, JS');
/*Введение:
	Общая структура HTML документа:
		document => DOM, BOM, JS.
		DOM	- объектная модель документа HTML (описывает структуру документа объектами HTML), т.е. это HTML теги в виде JS.  
		BOM	- окружение или надстройка над базовым JS для работы с браузером-клиентом. Т.е. все кроме HTML тегов.   
		JS		- базовый JS.

	В ходе текущего урока будем работать с окружением BOM.

	Функции из урока:
		Чаще объект "window" используется для получения ширины и высоты экрана, а так же для отслеживания событий: нажатие маши/коавиатуры, скрол мыши и т.д. 
		1) window.innerWidth		- вызов текущей ширины экрана.
		2) window.innerHeight	- вызов текущей высоты экрана.
		3) window.open('https://itproger.com');	- функция открытия нового окна. 
				Аргументы:	1) URL для нового окна либо заглушку - например "about:blank". 
								2) Заголовок страницы. 
								3) Ширина окна.
								4) Высота окана.
				Пример: 
					window.open('about:blank', 'Zagolovok', 'width=500, height=400');
			Новое окно не откроется без действий пользователя, если в настройках браузера нет согласия на авто редирект (событие).

		4) navigator.userAgent	-	вывод информации о системе/браузере
		5) navigator.platform	-	вывод информации о OC (виндовс/mac)
		6) location.href			-	вывод URL'а текущей страницы. URL у локальных серверов и у хостинга отличаются по формату. 
		7) location.reload()		-	перезагрузка страницы	
		8) location.href = 'https://itproger.com';	- редирект на указанную страницу.

		Объекты окружения BOM:
			1) navigator	- объект для получения данных о пользователе и системе. (этот объект используется очень редко).
			2) location 	- объект для работы с URL адресами. 
*/

//вывод ширины экрана 
	console.log('Вывод ширины экрана: '+window.innerWidth);
//вывод высоты экрана 
	console.log('Вывод высоты экрана: '+window.innerHeight);
//открытие нового окна 
	window.open('about:blank', 'Zagolovok', 'width=500, height=400'); 
//вывод информации о системе/браузере
	console.log('Инфлрмация о браузере: '+navigator.userAgent);
//вывод информации о системе (виндовс/mac)
	console.log('Система пользователя: '+navigator.platform);
//вывод URL текущей страницы
	console.log(location.href);
//перезагрузка страницы
	//location.reload();
//редирект на страницу
	//location.href = 'https://itproger.com';

//#2.2 -  DOM структура. Работа с объектами
console.log('');
console.log('#2.2 -  DOM структура. Работа с объектами');
/*Введение:
	document - главный объект DOM структуры, дающий доступ к любому HTML тегу, атребуту, иммени, стилю. Все обращения происходят с его использованием.
		Команды прямого обращения к тегам:	
			1) document.documentElement - доступ к главному HTML тегу.  
			2) document.head - доступ к хедеру документа.  
			3) document.body - доступ к телу документа.  
				Больше нет тегов к которым можно обратитсья так же напрямую. 
				Для обращения к остальным тегом задействуются дополнительные функции.
	
	1. Функции вывода элементов из урока - вариант 1-й:
		Вывод дочерних документов:
			1) firstChild		- вывод самого первого элемента
			2) firstlastChild	- вывод самого последнего элемента
			3) childNodes		- вывод всех дочерних элементов внутри тега

		Вывод элемента по ID 2-мя способами:
			1) Достаточно просто прописать Id элемента: console.log(tester_id); 
				Этот способ нежелателен, так как в случаи наличия переменной с названием айдишники - произайдет конфликт названий;
			2) getElementById	- аргументом выступает название Id выводимого элемента
				Заметка: в функции слово "Elements" не используется во множественном числе только при выводе елемента по Id. 
				Функция возвратщает только один елемент. Так как подразумевается, что Id 
		
		ВАЖНО! Фнкции в названии которых фигурирует часть названия "Elements" => выводят массивы елементов. Значит с их результатом можно обращаться как с масивом. 
		Вывод элемента по названиям тега, атребута, CSS - селектора:
			1) getElementsByTagName	- вывод элемента по названию HTML тега. Аргументом выступеет название тега. 
				Заметка: в функции слово "Elements" не используется во множественном числе только при выводе елемента по Id. 
				Функция возвратщает по-умолчанию множество елементов родительского блока, но может и один:
					Вывод множества элементов:	let elementInId = nameId.getElementsByTagName('p');	- вывод массива дочерних элементов 
					Вывод одного элемента: let elementInIdOne = nameId.getElementsByTagName('p')[1]; - прописывается порядковый индекс выводимого елемента
				Объектом функции вуступает родительский блок, у которого производится поиск и вывод элементов. 
					Либо объект document, но тогда фнукция работает на всю HTML страницу.
				Количество выводимых елементов функцией:
					Для вывода всех дочерних элементов блока достаточно прописать в качестве аргумента "*" => nameId.getElementsByTagName('*');
					
			2) getElementsByName	- вывод массива элементов по имени атребута. 
			Например "<input type="text" name="nameInput">"
					Вывод множества элементов:	let elAtrebut = document.getElementsByName('nameInput'); //вывод - вывод массива элементов c укаханным именем 
					Вывод одного элемента: let elAtrebutOne = document.getElementsByName('nameInput')[0]; - прописывается порядковый индекс выводимого елемента
			3) tagName - функция отображения тега выбранного на элемента: let elAtrebutOne = document.getElementsByName('nameInput')[0].tagName; => INPUT
			4) getElementsByClassName	- вывод массива элементов с определенным названием класса.

		УНИВЕРСАЛЬНЫЕ функции вывода элементов по селекторам CSS вариант 2-й: 
			1) querySelectorAll - функкция УНИВЕРСАЛЬНОГО вывода элемента из документа через селекторы:
				Примеры:
					console.log('Универсальная функция вывода элементов:');							
						let ultymatePrintClass = document.querySelectorAll('.class');				- вывод элемента по классу
						let ultymatePrintId = document.querySelectorAll('#id');						- вывод элемента по Id
						let ultymatePrintTag = document.querySelectorAll('input');					- вывод элемента по названию тега
						let ultymatePrintDotaEl = document.querySelectorAll('ul.spisok > li');	- все дочерние эл-ты 'li' тега 'ul' c классом 'spisok'
				ВАЖНО! Синтаксис пропси селекторов такой же как в CSS. Функция выводит массив.
			2) querySelector - функция-аналог querySelectorAll, но выводящая один первый элемент. Его чаще используют для элемента по названию Id. 
			3) closest - функция вывода ближайшего родительского элемента. Используется совместно с querySelectorAll();
				Объектом выступает дочерний элемент. Аргеменом выступает искомый родительский элемент в форме CSS селектора. 
				Пример:	
						let ulItems = document.querySelector('#span-id-test');
						console.log(ulItems.closest('li'));					- вывод ближайшего родительского тега
						console.log(ulItems.closest('li')).className;	- вывод названия класса ближайшего родительского тега

			
	2. РАБОТА С КОНТЕНТОМ ВНУТРИ HTML
		Выбранные через DOM элемент может подвергаться любым инзенениям. 
		Функции изменения полученных данных:
			1) innerHTML - функция получения и изменения данных. Изменение элемента происходит при приравнивании элемента новому значению. 
				а) Получение данных: console_log(parentLi.innerHTML);
				б) Изменение данных: parentLi.innerHTML = "Значение в списке, замененное через функцию 'innerHTML'"; 
			2) value	- функция изменения значения поля input. Используется так как функцией поле "innerHTML" изменить значения поля input нельзя.  
			3) className - функция смены названия класса/ов или его вывода. 
				а) obj.className = 'newClassName'; - замена значения класса
				б) console.log(obj.className); - вывод значения класса
		Функции проверки(has), получения(get), установки(set), удаления(remove) атребута:
			1) hasAttribute - проверяет наличие атребута у элемента. Возвратщает tru или false. Аргументом выстапает атребут элемента. 
			2) getAttribute - вывод значения атребута элемента. Аргументом выстапает атребут элемента. 
				ВАЖНО! В случаи, когда значение атребута отсутствует (нет атребута у элемента) => операции с атребутом вызовут ошибку. Например input.value = '+1';
				Поэтому прежде чем проводить операции с элементом - желательно запускать проверку на наличие элемента, атребута. 
			3) setAttribute - добавление нового/замена старого атребута. Аргуменами выступают а) Новый/имеющийся атребут, б) Значение нового/имеющегося атребута. 
			4) removeAttribute - удаление указанного атребута в элементе. Аргументом выступает название удаляемого атребута. 
			5) data - добавление комментария в HTML после элемента. 
				
		ФУНКЦИИ создания элементов на странице:
		https://youtu.be/DuWyc76lYC4?t=2483 - фрилансер по жизне
		Основной объект => document
			1)	createElement();	- функция создания элемента на странице. Аргументом выстапает название HTML тега.
				const newElement = document.createElement('div'); newElement = 'Содержимое тега DIV';
			2) createTextNode(); - функция создания текста. Аргументмо выступает создаваемый текст. Текст выступает самостоятельным элементом. 
				const newText = document.createTextNode('Текст для элемента');
			3) before();			- функция задающая место вывода элемента перед объектом. Объектом выступает выводи элемент перед которым выводится аргумент. 
				textElement.before(newElement); - элемет-аргумент newElement выведется до объекта
			4) after();				- функция задающая место вывода элемента после объекта. Объектом выступает выводи элемент перед которым выводится аргумент. 
				textElement.after(newElement); - элемет-аргумент newElement выведется после объекта
			5) prepent();			- функция задающая первое место вывода элемента внутри объекта. Объектом выступает выводи элемент перед которым выводится аргумент. 
				textElement.prepent(newElement); - элемет-аргумент newElement выведется внутри объекта на первом месте
			6) append();			- функция задающая место вывода элемента внутри объекта. Объектом выступает выводи элемент перед которым выводится аргумент. 
				textElement.append(newElement); - элемет-аргумент newElement выведется внутри объекта на последнем месте
				Аргументом в функциях before/after/prepent/append могут выступать множество элементов через запятую. 
			7) insertAdjacentHTML(); - функция вставки содержимого с HTML тегами в элемнет. Объект - элемент родитель. 
				Первый аргумент - место вставки элемента в объект: beforebegin/afterbegin/beforeend/afterend. Второй аргумент - вставляемое содержимое. 
				textElement.insertAdjacentHTML(
					'beforebegin',
					`<div><p>insertAdjacentHTML(); - функция втавки HTML элемента в объект.</p></div>`);
				ВАЖНО! insertAdjacentHTML(); - это более предпочтительный способ вставки новых элементов в HTML.
			
		ФУНКЦИИ переноса, копирования, удаления элементов на странице:
		https://youtu.be/DuWyc76lYC4?t=2483 - фрилансер по жизне
			1) append();		- функцию задающую место для элемента можно использовать как инструмент перемещения элементов. 				
				const lessonBlock = document.querySelector('.lesson');
				const title = document.querySelector('h3');
					lessonBlock.append(title); - перемещение заголовка в конец содержимого блока с классом ".lesson".
			2) cloneNode();	- функция копирования элемента. Аргументом выступает true или false: глубокое или неглубокое копирование: С содержимым или без. 
				const cloneTextElement = textElement.cloneNode(true);
					lessonBlock.append(cloneTextElement); - копирование элемента в конец содержимого блока с классом ".lesson".
			3) remove();		- функция удаления элемента.  
				const textElement = document.querySelector('.text');
					textElement.remove(); - удаление элемента
			
			Так же можно менять CSS стили как через классы так и через атребут style. Изменение стилий через класс приоритетней. 

	3. ДОПОЛНИИТЕЛЬНЫЕ КОНСТРУКЦИИ:
		1) write - функция вывода вывода текста на экран средствами JavaScript. Апгументом является встраиваемый текст. ОБъектом "document".
			Используется редко, но если, то для обычно для отоображения рекламных блоков на странице в веду сложности очистки рекламы, встроенной таким методом.
		2) style - функция добавления CSS свойств атребута. Объектом выступает элемент с изменяемым CSS. Функцией для style является свойство CSS.
				Свойство CSS, состоящее их нескольких слов - прописывается в верблюжьем регистре: border-bottom-color => borderBottomColor;
				Пример:
					atrebutInput.style.color = 'red';
					atrebutInput.style.border = '2px solid silver';
					atrebutInput.style.borderRadius = '5px';
					atrebutInput.style.padding = '15px 10px';
	*/

//1. ВЫВОД ЭЛЕМЕНТОВ
//console.log('Вывыод тела HTML: '+document.body);
//console.log('Вывод пермого элемента боди: '+document.body.firstChild);
//Вывод самого первого элемента
	console.log(document.body.firstChild);
//Вывод самого последнего элемента
	console.log(document.body.lastChild);
//Вывод всех дочерних елементов внутри тега через цикл   
	//console.log(document.body.childNodes);
for (let i = 0; i < document.body.childNodes.length; i++) {
		if (i == 5) {
			break;
		} else {
			console.log('Вывод элемента №' + (i + 1) + ' ' + document.body.childNodes[i]);	
		}
	}	
	
//вывод элементу по Id
	//1-й способ: console.log(tester_id);
		//let ider = document.getElementById(tester_id);
		//	console.log(ider);
	//2-й способ 
		let nameId = document.getElementById('tester_id');	//переменная с блоком id='tester_id'

//вывод массива дочерних элементов из родительского элемента через цикл
	let elementInId = nameId.getElementsByTagName('p');//переменная со списком элементов "p" блока id='tester_id'
		console.log('Вывод массива дочерних элементов:');
		for (let index = 0; index < elementInId.length; index++) {
			console.log(elementInId[index]);
		}
			
//вывод одного дочернего элементоа внутри элемента
	let elementInIdOne = nameId.getElementsByTagName('p')[1];
		console.log('Вывод одного дочернего элемента:');
		console.log(elementInIdOne);
	
//вызов элемента по названию атребута
	let elAtrebut = document.getElementsByName('nameInput'); //вывод масива с элементов с именами из атребута
		console.log(elAtrebut);
	
//вызов элемента по названию атребута
	let elAtrebutOne = document.getElementsByName('nameInput')[0].tagName; //вывод указанного в индексе элемента с именем из атребута
		console.log(elAtrebutOne);
	
//вывод элементов по определенному классу
	let allClasses = document.getElementsByClassName('som');
		console.log(allClasses.length);
		
//УНИВЕРСАЛЬНЫЙ СПОСОБ ВЫВОДА элемента из HTML документа через селекторы
	console.log('Универсальная функция вывода элементов:');
		let ultymatePrintClass = document.querySelectorAll('.class');
		let ultymatePrintId = document.querySelectorAll('#id');
		let ultymatePrintTag = document.querySelectorAll('input');
		let ultymatePrintDotaEl = document.querySelectorAll('ul.spisok > li');
	console.log(ultymatePrintDotaEl);
	
//функция, находящая ближайший родительский элемент
	let ulItems = document.querySelectorAll('.span-class-test')[1];       
		console.log(ulItems.closest('.li-class-test'));

//2. ВЗАИМОДЕЙСТВИЕ С ВЫВЕДЕННЫМИ ЭЛЕМЕНТАМИ
//Изменение сожержимого элемента или получение
	let parentLi = ulItems.closest('.li-class-test');
	parentLi.innerHTML = "Значение в списке, замененное через функцию 'innerHTML'";
	
//Добавление нового значения инпуту
	let inputUpdate = document.querySelector("input[type='text']");
	inputUpdate.value = 'Измененное значение поля "input" через "value"';  
	
//Работа с атребутами
let atrebutInput = document.querySelectorAll('input')[0];
//перепись значения атребута
	atrebutInput.setAttribute('data-toggle', 'some value');
//провера атрибута на наличие
if (atrebutInput.hasAttribute('type')) {
	//Получение значения атребута
	//alert(atrebutInput.getAttribute('type'))
}
//удаление атребута
	atrebutInput.removeAttribute('data-toggle');
//обновление значения атребута класс
	atrebutInput.className = 'newClassNameForInput';
	
/*конструкция вывода текста на экран средствами JavaScript. Используется редко, но если используется, то для отоображения рекламных блоков на странице в веду сложности очистки рекламы, встроенной таким методом*/
	document.write();
	
//функция добавления CSS свойств атребута через style
	atrebutInput.style.color = 'red';
	atrebutInput.style.border = '2px solid silver';
	atrebutInput.style.borderRadius = '5px';
	atrebutInput.style.padding = '15px 10px';


//#2.3 - События в JavaScript
console.log('');
console.log('#2.3 - События в JavaScript');
/*Введение:
	События - это манипуляции произведенные над HTML элементами после выполнния некоторых условий, прописаных через атребут. Например клик по элементу.
	... есть событьия которые связаны при взаимодействию пользователя через перетаскивания, клики, зажатие клавишь, копрование текста, выолнение скриптов при полной загрузке страницы, наведении на элемент, скролинд и т.д. 
	Ссылка на сущестующий список соытий: https://www.w3schools.com/tags/ref_eventattributes.asp


	1-й СПОСОБ ВЫЗОВА СОБЫТИЙ: ЧЕРЕЗ АТРЕБУТЫ В HTML
		1) 	onclick=""		- запускает обработку JS кода или функции при ОДИНАРНОМ нажатии на элемент. Аргументом выступает JS код или название функции, выполняемой при нажатии. Аргументом вызываемой функции может выступать например селектор используемого элемента. 
		2) 	ondblclick=""	- запускает обработку JS кода или функции при ДВОЙНОМ нажатии на элемент. Аргументом выступает JS код или название функции, выполняемой при нажатии. Аргументом вызываемой функции может выступать например селектор используемого элемента. 
		3) 	ondrag=""		- запуск события при перетаскиваниии элемента. 
		4) 	ondragend=""	- запуск события при отпускании элемента при перетаскивании.
		5) 	onfocus=""		- запуск события, когда активируется поле INPUT. 
		6) 	onblur=""		- запуск событий, когда поле INPUT делается неактивным. 
		7) 	onmouseover=""	- запуск событий, при наведении курсора на элемент
		8) 	onmouseout=""	- запуск событий, при отвдеении курсора от элемента
		9)		onresize=""		- запуск события, при изменения размеров элемента/объекта. ВАЖНО! Применяется только к глобальным объектам таким как windiw/document.
		10) 	onload=""		- запуск события, при полной загрузке страницы. ВАЖНО! Применяется только к глобальным объектам таким как windiw/document.
		11)	onscroll=""		- запуск события, при скроле старницы. ВАЖНО! Применяется только к глобальным объектам таким как windiw/document.
		12)	oninput=""		- запуск события, при вводе в поле. 
					События "oninput" - подходит для фиксации изменений в поле (даже вставки текста), но не вывода его содержимого. 
					Т.е. возможно возвратщает true или false. 
		
		Функции, вызываемые атребутами могут принимать аргументы в виде селекторов.
		Один элемент может иметь множество атребутов.


	2-й СПОСОБ (желательный) ВЫЗОВА СОБЫТИЙ: ЧЕРЕЗ СВЯЗКУ ОБЪЕКТ + СОБЫТИЕ В JS:
	Этот способ правильнее, так как при таком разделении кода JS остается в JS - не перемешщиваясь с HTML.
	Список событий из 1-го способа повторяться не будет, так как они так же применяются и во втором. 
	Вызов события начинается с прописи объекта/переменной + событие: window ... windiw.onclick = function(){...}.
		Примеры: 
		1) windiw.onclick = function(){...}		- клик по окну вызывает функцию
			obj.onclick = function(){...}			- клик по полю input вызывает функцию

		Запись "window.onclick" значает добавление обработчика событий ко всей странице/окну вцелом. 
	
	
	3-й СПОСОБ ВЫЗОВА СОБЫТИЙ: ЧЕРЕЗ EVENT LISTENER - обработчика событий В JS:
	Этот способ является альтрернативой второго - можно выбрать любой из них.	
	Обработчик событий ожидает выполднения определенных событий, после чего запускается сам обработчик. 
	Этот способ подразумевают возможность дальнейшего отключения обработчика в процессе его выполнения.
	Общий принцип написания обработчика событий: объект + обработчик + 1-й арг-т: событие + 2-й арг-т: функция, включающаяся после события.
		Пример:	bloker.addEventListener("mouseover", handlerOver);
			1-й аргумент - ожидаемое событие без префикса (например вместо 'onclick' => 'click' или вместо 'oninput' => 'input'), 
			2-й аргумент - название функции (НЕ ВЫЗОВ, т.е. без скобок), выполняющейся при выполнении события.
			
		Обработчики событий:
		1)	addEventListener - обработчик событий, отслеживающий событие о  выполняющий функцию при ее исполнеии
		2) removeEventListener - функция удаления обработчика событий. Отменяет работы обработчика событий "addEventListener".
				ВАЖНО! Обработчика событий для отмены не будет работать с помещенной во второй аргумент колбек функцией. Т.е. принимаются только названия функций - один аргумент.
				Две идентичные колбек функции JS воспринимает как разные. Поэтому вторым аргументом хоть и можно прописывать колбек функции, но нежелательно.
				Пример: 
				//рабочий вариант
					bloker.removeEventListener("mouseout", handlerOut);
				//нерабочий вариант
	*/
	//CОБЫТИЯ ЧЕРЕЗ АТРЕБУТЫ
	//onclick
	//Пример HTML: <p onclick="clickForAbzac('p.abzacClickerRed')" class="abzacClickerRed">Абзац под красный цвет</p>
		function clickForAbzac(selector) {			
			alert('ВЖУХ - и абзац покраснел');
			if (selector == 'p.abzacClickerRed') {
				document.querySelector("p.abzacClickerRed").style.color = 'red';	
			}
		}
	
	/*ondblclick
	Пример HTML: <a href="#" onclick="clickForLink()">Ссылка для нажатия</a>*/
		function clickForLink() {
			alert('ВЖУХ - и элемент пропал');
			document.querySelector("a.linkClicker").style.display = 'none';
		}

	/*ondragend
	Пример: <a href="#" ondragend="linkDragging()" class="dragging">Ссылка для перетаскивания</a>
	*/
		function linkDragging() {
			document.querySelector("a.dragging");	
			alert('Перетаскивание завершено');
		}
	
	/*	onfocus,
		onmouseover
	Пример: 
		<li>4. onfocus: <input type="text" onfocus="focusEvent('input.inputOnfocus')" onblur="notFocusEvent('input.inputOnfocus')" class="inputOnfocus"></li>
		<li>5. onmouseover: <input type="text" onmouseover="focusEvent('input.inputOnMouseOver')" onmouseout="notFocusEvent('input.inputOnMouseOver')" 
	*/
	function focusEvent(section) {
		if (section == 'input.inputOnfocus'){
			document.querySelector("input.inputOnfocus").style.backgroundColor = "#333";	
			document.querySelector("input.inputOnfocus").style.padding = "10px";	 
			document.querySelector("input.inputOnfocus").style.border = "0px";
		}
		else if (section == 'input.inputOnMouseOver') {
			document.querySelector('input.inputOnMouseOver').style.backgroundColor = "#333";	
			document.querySelector('input.inputOnMouseOver').style.padding = "10px";	 
			document.querySelector('input.inputOnMouseOver').style.border = "0px";
		}
	} 
	
	/*	onfocus,
		onmouseout
	Пример: 
		<li>4. onfocus: <input type="text" onfocus="focusEvent('input.inputOnfocus')" onblur="notFocusEvent('input.inputOnfocus')" class="inputOnfocus"></li>
		<li>5. onmouseover: <input type="text" onmouseover="focusEvent('input.inputOnMouseOver')" onmouseout="notFocusEvent('input.inputOnMouseOver')" 
	*/
	function notFocusEvent(section) { 
			if (section == 'input.inputOnfocus') {
				document.querySelector("input.inputOnfocus").style.backgroundColor = "#fff";	
				document.querySelector("input.inputOnfocus").style.padding = "0px";	
				document.querySelector("input.inputOnfocus").style.border = "1px solid silver";
			} else if (section == 'input.inputOnMouseOver') {
				document.querySelector("input.inputOnMouseOver").style.backgroundColor = "#fff";	
				document.querySelector("input.inputOnMouseOver").style.padding = "0px";	
				document.querySelector("input.inputOnMouseOver").style.border = "1px solid silver";
			}
	}
	
	//------------------------
	//СОБЫТИЯ ЧЕРЕЗ ОБЪЕКТЫ JS
		//onclick - 
			//window.onclick = function () {
			//	console.log('Вывод результата события "window.onclick" - при клике');
			//}
			//document.querySelector("input.inputOnfocus").onclick = function () {
			//	console.log('Вывод результата события "input.onclick" - при клике');
			//}
	
		//onmouseover
			document.querySelector("input.inputOnfocus").onmouseover = function () {
				console.log('Вывод результата события "input.onmouseover" - при наведении');
			}
				
			//window.onclick = function () {
			//	console.log('Вывод результата события "window.onclick" - при клике');
			//}
			//document.querySelector("input.inputOnfocus").onclick = function () {
			//	console.log('Вывод результата события "input.onclick" - при клике');
			//}
			
		//onresize	
			window.onresize = function () {
				console.log('Размер страницы изменился - "onresize"');
			};
			
		//onload	
			window.onload = function () {
				console.log('Страница полностью загрузилась - "onresize"');
			};
			
		//onscroll
			window.onscroll = function () {
				console.log('Страница скролится - "onscroll"');
			};
		
		//oninput
		//Меленькое задание: сделать textarea и повесить на него событие через JS.
			document.querySelector("textarea#textarea_scroll").oninput = function () {
				console.log('Начался ввод в поле "textarea" => "oninput"');
			}
			
	//----------------------------
	//СОБЫТИЯ ЧЕРЕЗ EVENT LISTENER - обработчик осбытий
	let bloker = document.querySelector("div.bloker");
	
		function handlerOver(){
			bloker.innerHTML = "Теперь отведи курсор";
		}
		
		function handlerOut(){
			bloker.innerHTML = "Но если очень хочется - можно.";
		}

			/* Объект+обработчик событий, у которого:
					1-й аргумент - ожидаемое событие без префикса (например вместо 'onclick' => 'click' или вместо 'oninput' => 'input'), 
					2-й аргумент - название функции (НЕ ВЫЗОВ, т.е. без скобок), выполняющейся при выполнении события. 
			*/
			//addEventListener - обработчик событий, отслеживающий событие о  выполняющий функцию при ее исполнеии
				bloker.addEventListener("mouseover", handlerOver);
				bloker.addEventListener("mouseout", handlerOut);

			/*функция удаления обработчика событйи
				removeEventListener - функция удаления обработчика событий	
					1-й аргумент - ожидаемое событие без префикса (например вместо 'onclick' => 'click' или вместо 'oninput' => 'input'), 
					2-й аргумент - название функции (НЕ ВЫЗОВ, т.е. без скобок), выполняющейся при выполнении события. 
					ВАЖНО! Функция не будет работать с помещенной во второй аргумент колбек функции. 
					Две идентичные колбек функции JS воспринимает как разные. 
			*/
				//нерабочий вариант
				//bloker.removeEventListener("mouseout", function () {
				//	bloker.innerHTML = "Доброго дня! Больше не наводи сюда курсор.";
				//});	

				//рабочий вариант функции, удаляющий обработчик событий
					bloker.removeEventListener("mouseout", handlerOut);	
					
//#2.4 - События клавиатуры и мыши
console.log('');
console.log('#2.4 - События клавиатуры и мыши');
/*Введение:
	Рассмотрим в уроке события для работы с клавиатурой и мышью.
	В прошлом уроке разбирался только процесс создания события и рассматривались некоторые собятия для мыши и клавиатуры. 

	ФУНКЦИИ-СОБЫТИЯ ИЗ УРОКА:
		Функции для работы с клавишами:
			1) kay	- выводит название нажатой клавиши, если собятиые имеет аргумент. Объектом выступает HTML элемент. 
					Работает с событиями: "onkeydown", "", "". 
					Использование события "oninput" - выдает "undefined" при порытке вывода клавишь в консоль, но позволяет отследить любую вставку или ввод в поле.
			2) onkeydown	- срабатывает при нажатии на клавишу.
			3) onkeypress	- срабатывает, когда клавиша нажата, но еще не отпущена.
			4) onkeyup		- срабатывает , когда клавиша отпущена. Именно при отпущении клавиши - символ прописывается в поле. 
				Т.е. событие "onkeyup" лучше подходит для работы с введенным текстом. События onkeydown, onkeypress содержат на один символ меньше при выводе. 

		Функции для работы с мышью:
			1)	onmousedown		- срабатывает при лишь нажании на мышку. 
			2) onmouseup		- срабатывает при отпускании мыши. Это испольуется например при нажатии на текст - он краснеет, при отпускании кнопки мыши - зеленеет. 
			3) oncontextmenu	- срабатывает при нажатии ПРАВОЙ кнопки мыши. 
			4) onmouseenter	- срабатывает при наведении на элемент курсора. 
			5) onmouseover		- срабатывает при наведении на элемент курсора. Является аналогом "onmouseenter".
			6)	onmouseleave	- срабатывает, когда мышь уводится от элемента.
			7) onmouseout		- срабатывает, когда мышь уводится от элемента. Является аналогом "onmouseleave".
			8) onmousemove		- срабатывает, когда мышь уводится от элемента. 
			9) offsetX			- функция передает паарметры положения мыши по оси X. Объектом выступает переменная-аргумент (e), передающая место курсора на странице. 
				Координаты подставляются в переменную автоматически, так как ранее поставленное событие определяет аргумент колбек функции.
			10) offsetY		- функция передает паарметры положения мыши по оси Y. Объектом выступает переменная-аргумент (e), передающая место курсора на странице. 
				Координаты подставляются в переменную автоматически, так как ранее поставленное событие определяет аргумент колбек функции.
		
		ВАЖНО! Чтобы событие работало на множество одинаковых элементов в HTML документе => прописывается цикл "foreach"
		boldText.forEach(function (element) {
			console.log(element);
			element.onmousedown = function () {
				element.style.color = "red";
			}
			element.onmouseup = function () {
				element.style.color = "green";
			}
			element.oncontextmenu = function () {
				element.style.color = "orange";
			}
		});
			где, 
				element	- псевданим элемента. Выводится так: console.log(element);
				index		- индекс элемента (не обязательный аргумент). Выводится так: console.log(element[index]);
*/

//работа с событиями клавиатуры
//вывод нажатой клавиши кл
let text = document.querySelector('textarea.full-text');
//поместим в аргумент функции переменную с названием клавиши. Переменная называется "e" или "event"
	//text.oninput = function (event) {
	//	console.log('Вывод клавиши черезе "oninput": '+event.key);
	//}
//поместим в аргумент функции переменную с названием клавиши. Переменная называется "e" или "event"
	//onkeydown
	text.onkeydown = function (event) {
		console.log('Вывод клавиши черезе "onkeydown": '+event.key);
	} 
	//onkeypress
	text.onkeypress = function (event) {
		console.log('Вывод клавиши черезе "onkeypress": '+event.key);
	} 
	//onkeyup
	text.onkeyup = function (event) {
		console.log('Вывод клавиши черезе "onkeyup": '+event.key);
	} 
	

//работа с событиями мыши
let boldText = document.querySelectorAll("p > b.bold-text"); //найти абзац, в котором есть тег 'b' с классом 'bold-text'.
//вариант перебора через стрелочную функцию (они рассмотрятся при разборе различных версия JS - в этом курсе этого разбора нет)
	//boldText.forEach((item, i) => {
//});

//onmousedown
//onmouseup
//oncontextmenu
boldText.forEach(function (element) {
	console.log(element);
	element.onmousedown = function () {
		element.style.color = "red";
	}
	element.onmouseup = function () {
		element.style.color = "green";
	}
	element.oncontextmenu = function () {
		element.style.color = "orange";
	}
});


//onmouseenter
//onmouseleave
//onmousemove
let inputField = document.querySelector('.inputСlass');
let helpField = document.querySelector('.hint');
inputField.onmouseenter = function () {
	helpField.style.display = "block";
}
inputField.onmousemove = function (e) {
	helpField.style.left = e.offsetX + 'px';
	helpField.style.top = e.offsetY + 'px';
}
inputField.onmouseout = function () {
	helpField.style.display = "none";  
}


//#2.5 - События для сенсорного экрана
console.log('');
console.log('#2.5 - События для сенсорного экрана');
/*Введение:
	В ходе урока рассмотрим события, активирующиеся при взаимодействии только с сенсорным экраном. 
	СОБЫТИЯ ИЗ УРОКА СРАБАТЫВАЮЩИЕ НА ТЕЛЕФОНЕ:
		1) touchstart			- срабатывает при нажатии на экран.
		2) touchend				- срабатывает при отпускании пальца с экрана. 
		3) touchmove			- срабатывает при
		4) targetTouches[0]	- считывает коррдинаты пальца по номеру индекса. Т.е. targetTouches[0] - это посути масив из координат, нажатых на экран пальцев. 
			Мыше этот параметр был не нужен, так как курсор на экране есть только один - пальцев же может быть много. Объектом выступает координаты пальца на экране. 

*/
/*Добавим HTML блок и стили к нему:
<div id="shar">Шар</div>
*/

//touchstart
//touchend
//touchmove
let tap = document.getElementById('shar');
window.addEventListener('touchstart', function (e) {
	tap.style.background = '#333';
	tap.style.color = 'white';
});
window.addEventListener('touchend', function (e) {
	tap.style.background = '#eee';
	tap.style.color = 'black';
});
window.addEventListener('touchmove', function (e) {
	tap.style.left = e.targetTouches[0].pageX + 'px';
	tap.style.top = e.targetTouches[0].pageY + 'px';
});
/*где,
	tap	- переменная с элементом
	e		- координаты переданные из страницы
	targetTouches[0] - нажатый палец на экране
	pageX	- отслеживание кооррдинат по X
	pageY	- отслеживание кооррдинат по Y
		Для более плавного следования элемента за курсором в CSS прописывается стиль "transition: all 0.15s linear;"
	*/

//#2.6 -  Асинхронное программирование
console.log('');
console.log('#2.6 -  Асинхронное программирование');
/*Введение:
	Асинхронное программирование - это технология Ajax, позволяющая выполнять код непоследовательно, т.е. без перезагрузки страницы. 
		Пример функции асинхронного программирования: setTimeout();
		JS через Ajax может считать данные из файла, но не может что-либо записать в файл. Так как это клиентский язык, а не серверный.

	Напишем фунционал вывода информации из файла:
		1) Для этого в колбек функции №1 создадим объект класса XMLHttpRequest для получения доутступа к функционалу чтения файлов.
		2) Вызываем метод "open", аргументами которого являются а) тип запроса ('GET'), б) url документа, который считывается. 
		3) Ввести условие, т.е. событие для взаимодействия с файлом после полной его загрузки и чтения: ajax.onload = function (){callback();};
		4) Вывести полученное из callback функции №2 содержимое.
		5) Отправить запрос из введенных данных на сервер через метод send();
		При вызове функции в консоле через вторую колбек функцию должен отобразиться объект, одно из свойст которого вмещает содержимое файла. 
*/
//объявление функции вывода информации из файла
	let load = function(url, callback) {
		let ajax = new XMLHttpRequest();
		ajax.open('GET', url);
		ajax.onload = function () {
			callback(this.responseText);
		};
		ajax.send();
	};

//вызов функции вывода информации из файла
	load('test-ajax-text.txt', function (data) {
		console.log(data);
	});	
	/*где,
			load	- переменная, в которую помещена функция. По-сути перемення это и есть функиця.
			function(url, callback)	- callback функция №1
			ajax	- объект класса "XMLHttpRequest" из структуры BOM
			XMLHttpRequest	- класс, вмещающий в себе функционал асинхронного программирования
				Он позволяет отправлять данные на сервер, получать из через JSON, прочитать даные из другоо файла.
			this	- указание на всю информацию полученную из объекта по url, т.е. это обращение к объекту ajax
			callback();	- функция, срабатывающая при вызове функции, вызываемой при выполнении события).
				Учитывая, что этот аргумент - функция,то мы прописываем в нем аргумент, котоырй по-умолчанию будет использоваться при вызове функции "load".
			this.responseText	- текстовое содержимое читаемого файла. 
				Информация предоставляется в виде объекта ajax, поэтому выводится через обращение к свойстам объета - в данном случаи "responseText".
				callback, который втрой аргумент первой "callback функции" вмещает в себя резальтат callback функции - после события "onload". 
				Т.е. функция после события помещает полученный результат в аргумент "callback" - ниже "function (data)", где data этот результат.
			send();	- метод отправки запроса на сервер.
			load('urlForFile', function (data){...});	- функция вывода информации из файла. 
				Первый аргумент это адрес/название читаемого файла, второй аргумент это collback функция №1. Аргументом которой являются данные, полученые из файла.
			function (data){...}	- callback функция №2, которая срабатывает после выполнения всех запросов и производит действия над полученными через ajax данными. 

			ВАЖНО! При выполнении функции может вызываться ошибка в завосомости от браузера. У Mozilla вызывается ошибока, но информацию воводится.
				Ошибка выводится из-за отсутствия локального или удаленного сервера, так как для пользования ajax нужен сервер. 
			В появившемся в консоле объекте представлена информация о ответе сервера, содержимом файла, адрес до файла и других данных.
				Для ее только текста достаточно прописать в функции события свойство содержимого файла => 
*/

//#2.7 -   Полноценная форма комментариев на JS
console.log('');
console.log('#2.7 -   Полноценная форма комментариев на JS');
/*Введение:
	В ходе урока создадим форму, научимся получать из нее данные, проверять их и случаи успеха проверки - выводить комментарий с возможностью удаления. 
	ЗАПЛНЕНИЕ ФОРМЫ И НАПИСАНИЕ СТИЛИЙ:
		В форму добавим два атребута: а) id="comments-form" - айдишник для формы, б) autocomplete="off" - отключение автлозаполнение формы.
		Поля input и textarea имеют атребуты placeholder, name. А button не имеет атребутов, так как к кнопке обращаются через айдишник формы.
		Ниже формы пропищем секцию "section", выводящую количество комментариемв "(<span class="count-comm">0</span>)" и сами комментарии. 

	Добавленеи стилий для формы:
		У всего документа убраны марджины и падинги по умолчанию, а так же outline: none => линия при навдеении на поля. 
		Ниже поля с сообщением добавим блок с ошибкой. Код в CSS: #error:not(:empty){...}. not(:empty) - означает добавление стилий если поле не пустое.
		transition: background 500ms ease; - анимация с задержкой у свойства "background", для этого служит функция "ease".
		cursor: pointer; - активный курсор при навдении

		Замнетка! События прописываться будут только в JS файле, потому в HTML нет видимых атребутов событий. 
	
	НАПИСАНИЕ JS:
		Пропишем черезу событий, при нажатии на кнопку формы. 
		Для вывода данных с любого поля формы. Достаточно в "querySelector" прописыть ID формы, затем обращаться к названию формы, а потмом к атребуту value. 
			let formInner = document.querySelector("#comments-form");
				alert(formInner.comment.value);	
			где,
				formInner - переменная с формой
				comment - название поля в атребуте name
				value - втребут с содержимым поля. 

		Добавленеи коммнтариев:
			Для добавления комментария метода innerHTML уже недостаточно - он вмещает небольшие значения в блок. 
			В то время как сутруктура блока с комментариями - объемна. 
			
			Пример:	
				document.querySelector("#comments").insertAdjacentHTML('afterbegin', newComment);

		ВАЖНО! Обращение к полям формы может происходить и через обращение к незваниям полея формы (атребут 'name').
		Пример:
			let formInner = document.querySelector("#comments-form");
			formInner.comment.value = '';

		ФУНКЦИИ ИЗ УРОКА С РАБОТОЙ С ФОРМОЙ:
			insertAdjacentHTML('afterbegin', newComment); - функция вмещает в самое начало
*/

//let countComments = 0; // число комментариев по-умолчанию

//события
//formBtn.onclick = function () {
	//let formInner = document.querySelector("#comments-form");
	//if (formInner.name.value.length < 4) {
		//document.querySelector("#error").innerHTML = "Длина имени не менее 4-х символов";
		//return false; //прерывание дальнейшего выполнения функции/условия в случаи ошибки
	//} else if (formInner.comment.value.length < 10) {
	//	document.querySelector("#error").innerHTML = "Длина сообщения не менее 10-ти символов";
	//	return false;
	//}
	//очищение блока с ошибкой в случаи, если все ошибки исправлены.
	//document.querySelector("#error").innerHTML = '';
	//установка новых значений в подсчете комментариев
	//if (countComments == 0) {
	//	document.querySelector("#comments").innerHTML = '';
	//} 
	//	countComments++;
	//	document.querySelector(".count-comm").innerHTML = countComments;
	//создание коммнетария
	//переменная со строкой комментария
	//let newComment = 
	//	"<div class='comments'>" +
	//	"<p class='name'>" + formInner.name.value + "</p>" +
	//	"<p class='name'>" + formInner.comment.value + "</p>" +
	//	"</div>";
	
		//добавление элемента в указанное место родительского блока
			//document.querySelector("#comments").insertAdjacentHTML('afterbegin', newComment);
	
		//очистка формы (поля с комментарием) после добавления комментария
			//formInner.comment.value = '';
//};

/*УДАЛЕНИЕ КОММЕНТАРИЯ
	Для удаления комментария создадим кнопку удаления и переменную с ID комментария, присваемого при его создании.
		//функция удаления комментария
			function delComm(id) {
				document.querySelector("#nummer-"+id).remove(); //удаление комментария с Id == nummer-id
				countComments--; 
				document.querySelector(".count-comm").innerHTML = countComments;
				if (countComments == 0) {
					document.querySelector("#comments").innerHTML = 'Пока комментариев нет';
				}
			}
*/
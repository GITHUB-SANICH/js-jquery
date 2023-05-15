//#1.2 - Подключение и настройка
//console.log('Hello World');


//#1.3 - Переменные, типы данных
//var myFirstVar = 'Shalom'; //объявление переменной
//var mySecondVar = 'Hello'; //объявление переменной
//let num = 45;
//let number = 47;
//const Number = 47;
//myFirstVar = 'Shalom - Shabat'; // переприсваивание уже созданной переменной
	// Важно! Переприсваивание работает только при наличии ранее созданной переменной.
//вывод переменной
//console.log('Переменная: ' + myFirstVar);

//#1.4 - Математические операторы


//window.addEventListener("onscroll", function () {
//	const scrollY = window.scrollY || document.documentElement.scrollTop;
//	if (scrollY > 400) {
//		topUp.classList.remove('topUp_hide');
//	} else {
//		topUp.classList.add('topUp_hide');
//	}
//});
window.addEventListener("scroll", function () {
	let topUp = document.querySelector(".btn-up"); /*btn-up*/
	let heightMax = document.documentElement.scrollHeight;
	let heightNow = window.scrollY;
	let heightProc = (heightNow*100/heightMax);
	if (heightProc > 15) {
		topUp.style.opacity = "1";
		topUp.style.transition = "opacity 600ms ease";
		topUp.classList.remove('btn-up_hide');
	} else if(heightProc < 15){
		topUp.style.opacity = "0";
		topUp.style.transition = "opacity 600ms ease";
	}
});

//const btnUp = {
//	btn: document.getElementById("btn-up"),
//	show() {
//		// удалим у кнопки класс btn-up_hide
//		this.btn.classList.remove('btn-up_hide');
//	},
//	hide() {
//		// добавим к кнопке класс btn-up_hide
//		this.btn.classList.add('btn-up_hide');
//	},
//	addEventListener() {
//		// при прокрутке содержимого страницы
//		window.addEventListener('scroll', () => {
//		  // определяем величину прокрутки
//		  const scrollY = window.scrollY || document.documentElement.scrollTop;
//		  // если страница прокручена больше чем на 400px, то делаем кнопку видимой, иначе скрываем
//		  scrollY > 400 ? this.show() : this.hide();
//		});
		 
//		// при нажатии на кнопку .btn-up
//		document.querySelector('.btn-up').onclick = () => {
//		  // переместим в начало страницы
//		  window.scrollTo({
//			 top: 0,
//			 left: 0,
//			 behavior: 'smooth'
//		  });
//		 }
//	 }
//}


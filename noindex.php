
	<?php
	echo '<hr><hr><br><h2>Тема: Laravel курс с нуля (Основы с laravel)
</h2>' . "<br>";

	echo '<hr><hr><br><h3>Урок - #1 - Введение. Обучение Ларавел
	</h3><hr><hr>' . "<br>";
	/*Введение:
	Ссылка:
	https://www.youtube.com/watch?v=bsil8XwFGjY&list=PLTucyHptHtTl2rSZqD__QNX3K5TJZrjp3&index=2

	1. Установка Bootstrap 5
	В курсе акцент на верстку и дизацн ставиться на будет. Поэтому установим бутстрап. Автор же использует библиотеку "Tailwind".
	1) composer create-project laravel/laravel --prefer-dist laravel-bootstrap
	2) cd laravel-bootstrap
	3) composer require laravel/ui
	4) php artisan ui bootstrap
	5) php artisan ui bootstrap --auth
	6) npm install
	7) // Fonts
			@import url('https://fonts.googleapis.com/css?family=Nunito');
		// Variables
			@import 'variables';
		// Bootstrap
			@import '~bootstrap/scss/bootstrap';
	8) npm run dev

	2. О сути курса 
	В ходе курса будут разобраны работы с MVC, NMP, LaRAVEL-MIX, миграции, СИД, маршрутизация, фабрика, админ-панель, авторизация.

	3. В файле ".env" затроним только настройки MySQL и SMTP сервера.

		*/

		echo '<hr><hr><br><h3>Урок - #2 -  База данных, миграции и модели. Фабрики и сиды в Laravel
	</h3><hr><hr>' . "<br>";
	/*Введение:
	В ходе курса создадим всего несколько таблиц:
	Новости, пользователи, комментарии к новостям, админы.
	Eloquent: Getting Started - ОРМ библиотека (Eloquent), позволяющая не писать нативный запрос к базе. Это подходит к небольшим проектам. Библиотека делает запосы объекто ориентированными.

	//1. Команда по созданию фабрики, миграции, модели:
	php artisan make:model Post --migration --factory
	php artisan make:model AdminUser --migration --factory
	php artisan make:model Comment --migration

	Laravel отслеживает в терминале названия по-типу "AdminUser" (верблюжий регистр) и переводит их в тип "admin_user".

	Миграции - инструмент создания структуры таблицы приложения, так же позволяющий вносить и обновлять в ней данные. 
	Фабрика - инструмент для создания тестовых/фейковых данных таблицы, для которой была создана фабрика.
	Сиид - тестовые данные таблицы.

	ВАЖНО! Создавать миграции нужно в осмысленном порядке. 
	Миграции создаются в последовательном порядке.
	Например таблица Comments связана с таблицей Posts. Если сначала создать миграцию комментариев, а потом миграцию постов, то выведется ошибка. 
	Так как требуется, чтобы комментарии по очередности были после постов.

	//2. Связь фабрики и ситов
	Модель имеет вид:
		class Post extends Model{
			use HasFactory; //эта запись говорит о том, что у модели будет фабрика
			protected $fillable = [ //массив с заполняемыми полями таблицы
				'title',
				'preview',
				'description',
				'thumbnail'
			];
		}

	Трейт "use HasFactory;" - говорит, что у модели есть фабрика (), к которой идет обращение через папку "seeders". )
	Этот трейт создается, когда при создании модели было дополнительно указано создание фабрики. 
	Трейт обращается к классу  "DatabaseSeeder extend Seeder", в котором есть метода "factory".

	$fillable - это массив, который содержит поля из таблицы, которые должны записаться в БД при обращении к фабрике. 
	Для работы фабрики $fillable обязательно должен быть указан в моделе и значениея этого массива должны быть указаны в фабрике
		Пример:
		В моделе:
		protected $fillable = [
			'name',
			'email',
			'password',
		];
		В фабрике:
		Данные таблицы, имметируемые фабрикой:
			return [
				'title' => $this->faker->name(),
				'preview' => $this->faker->text(50),
				'description' => $this->faker->text(), //меотд ограничивает количество символов. По-умолчанию 200.
				'thumbnail' => $this->faker->image("public/storage/posts", 640, 520, null, false), // папка в которой хранится изображение и размер по-умолчанию. Папка должна иметься в дериктории. 640, 520 - ширина и высота, null - размер картинки, false - путь до картинки внутри виндовс от диска "С:\". А так в БД будет загружено только название тестовой картинки без ее адреса. 
			];

	ВАЖНО! Метод "$this->faker->image()", который берет изображение с ресурса "placeholder.com" и генерирует их в указанную дерикторию через фабрику - может и не сгенерировать изображение. Для разбора и решения этой проблемы отведен отдельный урок "Проблема в faker image и кастомный faker provider в Laravel".

	//3. Хранение файлов от пользователя
	Файлы, передаваемые через форму помещаюстя в папку "strage".
	Чтобы в папке public имелись файлы полученые из формы - нужжно будет прописать команду artisan "php artisan storage:link", связующую папки "storage/app/public/posts" и "public/storage/posts"

	//4. Миграция комментария
	Таблица комментариев содерждит в себе данные о коменнтаторе и юзере.
		$table->foreignId("user_id")->constrained() - создает индекс через который связываются таблицы с юзером, котоырй связан в свою очередь с нужным постом.
		$table->foreignId("post_id")->constrained() - создает индекс через который связываются таблицы с постом, котоырй связан в свою очередь с нужным юзером.
		Через эти индексы происходит связь между таблицами комментариев и пользователей.
	Еще ... если удалить какой либо пост из таблицы Post, то работа в других, связанных с удаленным постом таблицах сохронится. 
	Чтобы все связанные данные (комменты/юзеры/посты) удалились во всех таблицах в случаи удаления - прописываются дополнительно методы, освобождающие БД от захламления:
	"->cascadeOnDelete()->cascadeOnUpdate();"
		Пример:
			Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("post_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
			});

	//5. Типы связей между таблицами
	Когда фабрики, модели, миграциир прописаны - остается прописать в моделях связи между таблицами по-типу "один к одному" или "один ко многим", указав класс модели таблицы.

	Пример:
		public function comments(){
			$this->hasMany(Comment::class)->oederBy("created_at"); //связь с таблицей "Comment". "created_at" - поле по которому будут сортироваться комменты при выводе.
		}

	Теперь запустим команду включения миграций и сиды:
	php artisan migrate --seed
	
	ВАЖНО! Если перед запуском сидов в файле ".env" не поменять параметр "FILESYSTEM_DISK=public" с "local" на "public", то картинки не будут генерироваться в базу. 
		Так как не верно будет выбран путь генерации для них.   
	ВАЖНО! Курс не является полноценным посубием по изучения фреймворка Laravel, но является вводным курсом. 

	*/

	

	echo '<hr><hr><br><h3>Урок - #2.1 - Проблема в faker image и кастомный faker provider в Laravel
	</h3><hr><hr>' . "<br>";
	/*Введение:
		ВАЖНО! Метод "$this->faker->image()", который берет изображение с ресурса "placeholder.com" и генерирует их в указанную дерикторию через фабрику - может и не сгенерировать изображение. Для разбора и решения этой проблемы отведен отдельный урок "Проблема в faker image и кастомный faker provider в Laravel".


	*/


	echo '<hr><hr><br><h3>Урок - #3 - 
	</h3><hr><hr>' . "<br>";
	/*Введение:
	В этом уроке будут разобраны маршрутизация, правила маршрутизации; мидлвары и как с ними работать.
	
	Middleware - разновидность классов, работающих с запросами фильррую/дополняя его и т.д.
		Например если запрос выходил за рамки допустимого размера - от он отбраковывается мидлваром.


		В дальнейшем к мидлвару возможно понадобиться обращаться и для удобства они обертуты в псевданим в файле "laravel\app\Http\Kernel.php".
			Пример:  'auth' => \App\Http\Middleware\Authenticate::class,
				где, 
					'auth' - псевдоним мидлвара
					\App\Http\Middleware\Authenticate::class - мидлвар 

		Вызов группы мидлваров может происходить при вызове префиксов. Обращаясь к псевдониму "web" или "api" вызывается группа мидлваров. 
			Пример: 
			protected $middlewareGroups = [
         'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
         ],

         'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
         ],
      ];
		Вызов мидлваров префикса api будет вызван в файле Providers\RouteServiceProvider.php если ссылка будет иметь вид например: "localhost.com/api"
		В файле Providers\RouteServiceProvider.php прописаны мидвары группы 'web' ко всем правилам маршрутизации в файле web.php. 

		В этом курсе работы с API не подразумеваетс и можно было бы удалить мидлвары и функции в файле RouteServiceProvider.php, но не будем.

	1. Цикл HTTP запросов в Laravel
		а) Запросы прописываются в файле laravel\routes\web.php => 
		б) Перенаправляется в laravel\public\index.php => 
		в) Затем перенаправляются в мидлвары, хрянящиеся в файле laravel\app\Http\Kernel.php => 
		г) Когда произошло бращенеи к нужным мидлварам, запрос направляется в файл laravel\app\Providers\RouteServiceProvider.php => 
		д) В конечном счете  запрос возвратщается обратно в файл laravel\routes\web.php, где настраивается принятие запроса, обращение к котроллерам и вывод view-шаблонов.

		Консольная команда, отображающая все правила маршрутизации в приложении:
		php artisan route:list

	2. Создание своего Middleware. 
		Мидлвар создается через artisan команду: 
			php artisan make:middleware - создание мидлвара
			php artisan make:middleware GoogleRecaptcha - создание мидлвара с валидацией гуглрекапчи
		Новый мидлвар находится в папке laravel\app\Http\Middleware\GoogleRecaptcha.php

		В новосозданном мидлваре будет проверятся наличие примерного/учебного параметра "r" в запросе, отсутствие которого выводит ошибку 403:
			if (!$request->has("r")) {
				abort(403);
			}

		В файле "app\Http\Kernel.php" нужно прописать псевдоним для нового мидлвара: "'r' => GoogleRecaptcha::class,".
		В случаи отсутствия этого параметры при подключенном мидлваре будет вывордится ошибка 403.
		Если же ссылка будет иметь вид "localhost.com/?r=1" с подключенным мидлваром, то ошибка 403 выводиться не будет.

	3. Подключение мидлвара. 
	Подключение мидлвара происхочет чреез метод "middleware()"
		Пример: 
			Route::get('/', function () {
				return view('welcome');
			})->middleware("r"); - подключенный мидлвар к отправляемому запросу
	Можно подключать несколько мидлваров через массив: ->middleware(["r"]);

	4. Работа с маршрутизацией в фале web.php. Группы маршрутизации по префиксу и роутам.
		Создадим контроллер: php artisan make:controller IndexController
		Пропишем в нем только возврат главного шаблона сайта, а роут будет ссылаться на этот контроллер. 
			Пример:
				Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('home');
			
			Желательно каждому правилу маршрутизации задавать имя как выше в примере (->name('home');), так как во время ветски это упростит прописание ссылок в шмблонах. 
			Например вместо прописания полного правила маршрутизации достаточно будет прописать "\route('home);" 'это будет коротким аналогом вышенаписанного правила маршрутизации.
			Помимо минимализации кода это позволяет при смене ссылки в маршрутизации менять ее только в ней, а не во всех шаблонахв, в которых эта ссылка быда указана - так как в шаблонах указывается только всевдоним на нужное правило (route).
		
		Кроме того роуты-правила маршрутизации можно объединять в группы. 
			Пример:
				//группа маршрутизации, в которой применяется мидлвар "r"
				Route::middleware("r")->group(function(){
				//Правила маршрутизации, к которой применяются правила мидлвара "r"
					Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('home');
					Route::post('/contact_form', [App\Http\Controllers\ContactController::class, 'index'])->name('contact_form');
				});

		Еще есть возможность объединять правила маршрутизации в группы по префиксу. Чтобы не повторяеть его во всех URI роутов. Вместо news/{{id}} указывается {{id}}.
			Пример:	
				//группа роутов в каждом из которых имеется префикс "news"
				Route::prefix("news")->group(function(){
					//Правила маршрутизации, к которой применяются правила мидлвара "r"
						Route::get('/', [App\Http\Controllers\Newsontroller::class, 'index'])->name('news');
						Route::post('/{id}', [App\Http\Controllers\NewsController::class, 'index'])->name('news_id');
				});
		
		так же можно првефиксы и мидлвары засовывать в одну группу. 
			Пример: 
				Route::middleware("r")->prefix("news")->group(function(){}

	*/


	echo '<hr><hr><br><h3>Урок - #4 - Blade шаблонизатор
	</h3><hr><hr>' . "<br>";
	/*Введение:
		В этом уроке начнем работать с версткой, обращаюсья к пройденному матералу по роутам. 
		В Laravel используется модель проектрования MVC. 
		Model нахдится в laravel\app\Models; View в laravel\resources\views; Controller в laravel\app\Http\Controllers;
		
		1.  Eloquent библиотека
			Все шаблоны должны иметь формат .blade.php
			Для обращения к PHP внутри шаблона достаточно {{}}. За это отвечает Eloquent библиотека.
			Два примера будут читаться одинаково. Переменная в формате Eloquent компелируется в обычный PHP в папке laravel\storage\framework\views.
				Пример:
				{{"text"}} == <?=$text;?>
				
			Еще фигурные скобки экранируют HTML теги, поэтому код {{<a href="/">text</a>}} будет тег в виде текста.
			HTML теои выводятся фигурными другими скобками {!! <a href="/">text</a> !!}.
			Операторы PHP пишутся через символы @.
				Пример: 
				@if()
				
				@endif

		2. Настройка  шаблонов
			На главной странице выведем три статьи - обратимся сначала к роутам. 
			Но сначала поделим главную страницу на шаблоны. 
			Заголовок останется в welcome.blade.php - вьюхи будут храниться в папке laravel\resources\views\layouts. 

			а) @yield('content'); - это метка в шаблоне, которая выводит секцию. 

			б) Секция внутри которой находится подключаемый код
				@section('content')
				
				@endsection
			
			В прошлом настройкам маршрутизации мы задавали псевдоним - через хелпер в вшаблоне "header" обратимся к нему:
				Пример: <a href="{{route("home")}}"
			//В самом верху шаблона секции которого подключаются к главному шаблону - прописывается тег, подключающий шаблон, который будет получучать секции.
			в) @extends('/laravel/resources/views/layouts/app.blade.php')
			г) Подключение файлов происходит через прописание оператора и адреса шаблона: @include('/laravel/resources/views/partials/header.blade.php')

		3. Запрос вывыода статей
			$posts = Post::orderBy("created_at", "DESC")->limit(3)->get();
			return view('welcome', [
				'posts' => $posts,
			]);
			где,
				Post - класс, отвечающий за работу с таблицей posts
				orderBy("created_at", "DESC") - сортировка по полю
				limit(3) - число выводиымй статей
				get() - формирование запроса.
			Выведя статьи на страницу  видно, что код повторяется на главной странице. На такие случаи уже имеется папка partials/posts/item.blade.php 
			Так будет выглядеть подключение шаблона со статьей:
				@include('/laravel/resources/views/partials/posts/item.blade.php', ["post" => $post])
				Вторым параметром передается массив. 

		4. Создание страници с пагинацией всех статей и карточку статьи
			Создадим для начала контроллер PostController. 
			В контроллере вместо сортировки и лимита вывода статей подкрутим пагинацию через метод "->paginate(3)", где "3" - это число записей на странице. 
			Создадим правило маршрутизации для новых страниц. 

			Создадим файл, в котором будет отображен список статей 
			В шаблоне списка ниже самого списка встраиваем "{{ $post->links() }}" - это метод, предаставляемый методом "paginate", выводящий пагинацию на странице. 
			Laravel по-умолчанию использует шаблон "Tailwind", т.е. его не придется предварительно верстать. 

			Далее добавим метод "show" в контроллер, который будет проверять наличии статьи с предлагаемым id. 
				Пример:
				Эти две запси равносильны.
					1) $posts = Post::findOrFail($id); 
					2) if($posts){abort(404);}
			


*/

echo '<hr><hr><br><h3>Урок - #5 - Аутентификация. Обучение Ларавел
</h3><hr><hr>' . "<br>";
/*Введение:
1. Авторизация в LAaravel и набор настроик по передачи данных пользователю (гарды).  
		Они называются гардами (guard).
		
		ГАРДЫ
		Гарды - это типы авторизации, позволяющие разграничивать использование функционала приложения пользователям.
		По-умолчанию в приложении используется гарда "web".
		Гарды подразумевают под собой свод настроек взаимодействия с типами пользователей. 
		Гарды нужны например для того, чтобы мы могли раздилять сессии по типам пользователей. Например на авторизованных пользователей сайта и админов. 
			Пример реализации гард:
				@auth("web")
					<a href="{{ route("logout") }}" class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Выйти</a>
				@endauth
				Или для авторзованных пользователей относящийся к гарде "web". 
				
		Гарды ааходятся в файле "config\auth.php". На дынный момент имеется только гарда "web". 
		
		Гаады состаят из драйверов и провайдеров.
				Пример: 
					'guards' => [
					'web' => [
						'driver' => 'session',
						'provider' => 'users',
					],

				ДРАЙВЕРЫ
				Драйверы есть двух типов: session и token. Второй используется с API. Сессии находятся в папке "\storage\framework\cache\sessions".
					В файле "app\Providers\AuthServiceProvider.php" расширяется и настраивается авторизация. В нем добавляются новые драйверы. 
					Здесь можно прописывать правила доспупы для разных ролей авторизованных админов. 
				
				ПРОВАЙДЕР
				Провайдер - это правило дающее авторизации понять каким образом пользователи будет получать объекты. Их тоже два: "database", "eloquent".
				Eloquent подразумевает, что за передачу данных пользователю будет отвечать модель - метод вшитый в Lravel. А "database" подразумевает обращение к БД напрямую через метод. 
				model - указывает модель, которая присоедина к гарде
				Пример указания правила получения данных пользоваетелем:
					'users' => [
						'driver' => 'eloquent',
						'model' => App\Models\User::class,
					],
				
				ПРОВАЙДЕР - правило, указывающее каким образом пользователь будет получать данные: 
					Для категорий разных пользователей (гард) назначаются свой провайдеры с отдельной моделью. Для админов одни, для пользователей другие. 
					Если создается новая гарда - к ней создается новый провайдер. 
					Провайдеры находятся в папке "app\Providers\AuthServiceProvider.php".

		2. Создадим контроллер отвечающий за авторизацию 
			php artisan make:controller AuthController
			Создадим правило маршрутизации формы авторизации. 
				Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
				В дальнейшем мы настроим мидлвары, так чтобы запросы от неавторизованных пользователей не проходили, если это не подразумевается программой. 
					По адресу "auth\login.blade.php" уже есть файл - он встроенный, поэтому создадим файл "auth_/login".  

		3. Форма регистрации
			Добавим файл регистрации "resources\views\auth_\login.blade.php"
				В форме регистрации добавляем ссылку на маршрутизацию и метд обработки формы. 
			
				ВАЖНО! В формы laravel нужно добавлять "@csrf" токен. Он нужен для юезопастности. 
					Токен нужен, чтобы через форму методом POST не проходили несанкционированные запросы на сайт - без токена они работать не будут. 
					Перед выполнением запрос проходит через группу мидлваров "web". В ней есть мидлвар VerifyCsrfToken, которые проверяет наличие токена. Там токен и нужен. 
				Подробнее обо всем этов в следующем уроке.  

			Токен добавлен. 
			Полям формы добавим имена: email, password, password_confermation.
				Почему последнее поле имеет такое имя, объясним ниже ... 
				Метод, принимающий запрос от формы регистрации пишется так:
				
				В этом уроке будет разобран случий передачи объект запроса в контролер, но можно передавать данные из формы через "requesForme". 

					public function registerForm(Request $request)
					{
						$request->validate([
							"name" => ["required", "string"],
							"email" => ["required", "email", "string", "unique:users,email"],
							"password" => ["required", "confirmed"],
						]);
						ВАЖНО! В этой записи между запятой и 'email' не должно быть пробелов "unique:users,email". 
						...
					}
					В нем:
						Request $request 	- объект, содержащий заныне запроса (из формы)
						validate				- меотд валидации полученных данных. 
							Удобнее проверять данные не поочередно вызывая этот метод для каждый позиции из формы, а однажды, прописав аргумент метода в виде массива.
						"email" 				- проверяемое поле
						["required", "email", "string", "unique:users, email"] - правила проверки поляна: 
							required 				- обязательное запорлнение,
							email						- правило форматы почты,
							string					- данные в поле должно быть в виде строки
							confirmed				- поле, требующее перепроверки
							unique:users, email:
								unique - уникальность поля (не допускается повторения содержимого поля)
								users	 - таблица, в которой поле не должно повторять значение
								email	 -	поле, содержимое которого не должно повторяться в таблице. (Можно не указывать. По-умолчанию считается название проверяемого поля).

						Потому поле "password_confermation" и имеет такое название по синтаксису приставка "_confermation" требует повторения содержимого поля "password".

					Если метод "validate" не возвратщает true, то ниже код метода "registerForm" не выполняется. Поэтому метод "validate" прописывается в самом верху метода. 
						Метод при ошибке делает редирект на страницу, с которой отправлялся получаемый запрос с выводом сообщения об ошибках.
						Так же метод "validate" может возвратщать значения введенные пользователем, чтобы при каждой ошибке поля не сбрасывали значения.
						Для этого результат метода помещается в переменную. 
				
				Нижже каждого поля прописывается дерективу @error(''), аргументом которой является имя проверяемого поля. Деректива отобразит ошибку, если она имеется. 
				@error('email')
					<p class="test-red-500">{{ $message }}</p>
				@enderror
					Добавляться так же можут не тлько содержимое абзаца, но и класс поля:
						Пример:
							<input	name="email" type="text" class="w-full h-12 border border-gray-800 @error('email') border-red-500 @enderror rounded px-3" placeholder="Email" />
			
				Ошибка при выводе пишется на английском. Вывод ошибок можно русифицировать. "laravel\lang\en\validation.php"
		
		
		4. Если содержимое формы валидно, то ниже в контроллере выполняется занесение данных в БД через модель "User". 
			$user = User::create([
				"name" => $data['name'],
				"email" => $data['email'],
				"password" => bcrypt($data['password']),
			]);

			if ($user) {
				auth("web")->login($user);

				return redirect(route("home"));
			}

			где, 
				$user - true/false в зависимости от успешной регистрации пользователя
				"name" - поля, которое наполняется данными в БД
				$data['name'] - данные, заносимые в БД
				bcrypt($data['password']) - хелпер/метод, хеширующий пароль
				auth("web") - передача гарды перед логированием (по-умолчанию "web", если не прописывать аргумент)
				login($user) - логирование/авторизация пользователя
				return redirect(route("home")); - возвратщение реджиректа на страницу

		5. Замена кнопки "войти" на "выйти" при авторизации в heder
			Зайдем в шапку и добавим директивы: 
			@auth(), реагирующую на авторизованного пользователя и 
			@guest(), реагирующую на неавторизованного пользователя
			
			Кнопка выйти обращается к контроллеру за разлогированием пользователя и редиректом на главнубю страницу. 
			Пример: 
				public function logout()
				{
					auth("web")->logout();
					return redirect(route("home"));
				}

		6. Логирование
			Форма и маршрутизация авторизации меняется на монер регистрации:
				Route::get('/login_process', [App\Http\Controllers\AuthController::class, 'login'])->name('login_process');
				public function login(Request $request){
					$data = $request->validate([
						"email" => ["required", "email", "string"],
						"password" => ["required"],
					]);

					if (auth("web")->attempt($data)) {
						return redirect(route("home"));
					}

					return redirect(route("login"))->withErrors([
						"email" => 'Пользователь не найден, либо данные введены с ошибками'
					]);
				}
				где, 
				attempt - метод принимающий данные авторзации и пытающийся авторизовать пользователя. Пароль через этот метод сам захешируется. 
				withErrors('email') - метод, возвратщающий ошибки в поле @error('email')

		7. Добавление мидлвара
			Восстановление пароля добавим в след уроках. Остается добавить мидлвар. 
			Пример удобства использования мидлваров:
				//мидлвар для авторзованных
				Route::middleware("auth")->group(function () {
					Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
				});

				//мидлвар для неавторизованных
				Route::middleware("guest")->group(function () {
					Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
					Route::get('/login_process', [App\Http\Controllers\AuthController::class, 'login'])->name('login_process');

					Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
					Route::post('/register_process', [App\Http\Controllers\AuthController::class, 'register'])->name('register_process');
				});

				Мидлвар "auth" разрешает использование маршрутизацией в своей группе только для авторизованных пользователей. Т.е. нельзя выйти из профиля не авторзовавшись. 
				Мидлвар "guest" разрешает пользоваться маршрутизацией в своей группе только для неавторизованнм пользователям. Т.е. нельзя зарегистрироваться авторизованному пользователю.

				Всю эту логику с ограничением пользования авторизацией можно было бы прописать и в контроллере через хелпер auth(), 
					но это будет только загромаждать множество контроллеров повторяющися кодом.  

*/

echo '<hr><hr><br><h3>Урок - #6 - Form requests и email уведомления
</h3><hr><hr>' . "<br>";
/*Введение:
ВАЖНО! Для каждой создаваемой формы желательно создавать класс типа Form requests, чтобы ему делегировалась часть функционала с контроллера, связанный с валидацией, дополнения данных запросов, и.т.

В прошлом уроке данные из формы передавались в виде объекта класса Request.
В текущем уроке данные из формы будут обрабатоваться классом Form requests. Это считается более правильным способом. 
Так же в этом уроке оживим комментарии к постам, создадим страницу с контактной формой и добавим уведомления с почты, добавим восстановление пароля. 

1. SMTP сервер
	В файле ".env" вписываем данные о SMTP сервере. Лучле и удобнее испоьзовать SMTP яндекса.
	ВНИМАНИЕ! SMTP сервер работает только на простых серверах. 

	За обработку формы отправки комментариев (show) отвечает отдельный создаваемый класс (foem Requst) в папке "laravel\app\Http\Requests\CommentForm.php"
	Созданный класс requestForm берет на себя вызов валидации данных формы, чтобы они не копились в контроллере.
	
2. Класс CommentForm и функционал добавления и отображения комментариев
	Создание класса: php artisan make:request CommentForm
	МЕТОДЫ класса FormRequest:
		rules						- берет роль вызова валидации формы с контролелра на себя сетодом "rules". Валидация проходит еще в момент инъекции в метод контроллера. 
		authorize				- проверяет пользователя на авторизацию. Т.е. докускает до формы только авторизованных пользователей.    
		prepareForValidation	- выполняетя перед передачей запроса на проверку валидации. 
			Например для того, чтобы добавить в запрос ID авторизоаванного пользователя, чтобы это не пришлось делать через скрытое поле в форме. 

    public function rules(){
        return [
			"text" => ["required", "string", "min:5"],
			"user_id" => ["required", "exists:users,id"],
        ];
    }

	 protected function prepareForValidation(){
		$this->merge([
			"user_id" => auth("web")->id()
		]);
	 }
	$this->merge([]); - метод добавления к запросу массива из дополнительных значений

	Добавим маршрутизацию добавления комментария к посту: Route::get('/posts/comment/{id}', [App\Http\Controllers\PostController::class, 'comment'])->name('comment');
	Добавим в таблицу @csrf токен - он является проверочным ключом к запросу, поступающим через таблицу. 
		Запрос проходит в мидлвар "laravel\app\Http\Middleware\VerifyCsrfToken.php". В этот мидлвар можно вписать ссылки, которые/API, котоыре можно обрабатывать без наличия @csrf токена. 

	Модель добавления комментария:
	public function comment($id, CommentForm $request){
		$post = Post::findOrFail($id);
		$post->comments()->create($request->validated());
		return redirect(route("post.show", $id));
	}
	где,
		$id, CommentForm $request - id-айдишник статьи, CommentForm - класс, с валидацией и добавления данных к запросу, $request - данные запроса
		findOrFail - проверка БД на наличие статьи с такие id
		$post->comments()->create($request->validate()); - обращение к таблице "comments" через связку и добавление валидных записей в нее в нее. 
		create($request->validate()); - метод записи в БД
		$request->validated() - массив из полей прошедших валидацию
		return redirect(route("post.show", $id)); - выывод страници с добавленным комментарием
		
		В шаблоне выводим данные комментария через форич: 
		@foreach ($post->comments() as $comment)
		@endforeach

	3. Отправка email уведомлений. 
		Создадим класс для для отправки email уведомлений
			php artisan make:mail ContactForm
				После слова make следует название создаваемой папки в дериктории "app" (mail),  а затем название класса в созданной папке (ContactForm).
			По умолчанию в классе имеется два метода, где __construct - класс принимает данные из формы, а content - передача параметров email уведомлений  
				public function __construct(){

				}

		Данные полученные классом передаются в шаблон заполнения данных "laravel\resources\views\emails\contact_form.blade.php". 
			Этот шаблон будет отправляться в виде письма - в нем находятся даныне из формы. 
			public function build(){
				return $this->view('emails.contact_form')->with($this->formData);
			} 

		Создадим класс типа FormeRequest для контактной формы  
			php artisan make:request ContactForm
		
		Если есть таблица, значит нужна и маршрутизация. 
			
		В контроллере вызываем передаем полученные данные в класс ContactFrorm ... данные из запроса в момент попадания в конроллер уже проверелись классом ContactFrormRequest
			public function contactForm(ContactFormRequest $request){
				Mail::to("sani4.mocrousov@yandex.ru")->send(new ContactForm($request->validated()));
				return redirect(route("contacts"));
			}
			где, 
			Mail - фассад, класс зашитый в laravel, отправляющий письмо
			to	- метод (получатель). Можно настроить передачу через обращение к полю таблицы user.email, а можно это сделать только мтеодом to
			send - передача
			new ContactForm($request->validated()) - класс принимащий и отправляющий валидированные данные из формы
			bbuild - метод, кладущий содержимое письма в шаблон
			return redirect(route("contacts")); - редирект на страницу после передачи письма


	4. Восстановление пароля
		Начнем с маршрутизации - восстановление доступно только для не авторизованных.
			Route::get('/forgot', [App\Http\Controllers\AuthController::class, 'showForgotForm'])->name('forgot');
			Route::post('/forgot_process', [App\Http\Controllers\AuthController::class, 'forgot'])->name('forgot_process');
		Добавим имя маршрутизации в форму логина. 
			Находим юзера в таблице, если его почта совпадает с какой либо почтой в БД и берем эту почту. 
			$user = User::where(["email" => $data['email']])->first();
				Перед тем как отправлять прдлагаемый новый пароль - его нужно создать и задействовать:	
						$password = uniqid();										- генерация случайного значения
						$user->password = bcrypt($password);					- хеширование пароля и присвоения нового пароля пользователю
						$user->save();													- сохранения значения в БД
						Mail::to($user)->send(new ForgotPassword($data));	- отправка почты
						return redirect(route("home"));							
		Создадим класс для отправки пароля на почту: 
			php artisan make:mail ForgotPassword

			Метод отправки почты:
				public function build(){
					return $this->view('emails.forgot')->with([
						"password" => $this->password
					]);
				}

		ВНИМАНИЕ! Почта может отправляться некоторое время, поэтому при отправки почты лучше использовать "очереди" Cron скриптом, чтобы отправка письма прошла тогда, когда настала бы очередь отправки.

			*/ 

echo '<hr><hr><br><h3>Урок - #7 - Админ.панель
</h3><hr><hr>' . "<br>";  
/*Введение:
	Это последний урок в и значальном списке плейлиста. 
	Кординально нового ничего не планируется. В уроке будут расширены знания о маршрутизации, будет добавлен новый метод в формы и создана админ-панель (back-office).
	
	ВАЖНО! В модель AdminUser должна наследовать класс "Authenticatable" так же как и модель "User".

	1. Настройка маршрутизации
		Для админ панель создадим отдельный файл с правилами маршрутизации и отдельный гард для авторизации а вдмин панели. 
		а) В папке "laravel\routes", где находится отдельный файл "web" для маршрутизации создадим файл "admin" и оставим его прустым. 
		б) Подключим этот файл к нашему приложению через файл "laravel\app\Http\Kernel.php", создав в нем группы мидлваров "admin" набор мидлваров в группе не будем менять:
			'admin' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class, 
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
         ],	
		
		в) В провайдере => файле laravel\app\Providers\RouteServiceProvider.php добавим название нового файла для маршрутизации. 
			Дополнительно добавим префикс "prefix('admin')". Так как все урлы будут начинаться с "admin". 
			Дополнительно добавим имя "name('admin.')". Так как названия правил маршрутизации для мидлвара будут начинать называться с "admin". 
			В файле RouteServiceProvider.php привяжим дополним файл "admin" возможность использовать класс Route, указали адрес нахождения файла и добавили префикс.
				$this->routes(function () {
					Route::middleware('admin')
						->name('admin.')
						->prefix('admin')
						->namespace($this->namespace)
						->group(base_path('routes/web.admin'));
				});
		
		г) Создадим контроллер для админ панели: 
			Контроллера будет два - один будет отвечать за автризацию. а второй за администрирование статей.
				php artisan make:controller Admin/PostController --resource
					где, 
						Admin - создании новой папке внутри "controller"
						PostController - нвоый контроллер
						--resource - дополнительный атребут добавляющий контроллеру свое правило маршрутизации типа "resource". 
						Т.е. созданный контроллер будет отличаться от других тем, что в нем будет иметься ряд заготовленных методов:
							index, create, store, show, edit, update, destroy. Метода подходят для ряботы с админ понелью. Не которые методы будут иметь свой отдельный тип HTTP запроса. 

			Гарды будут создаются в файле "config\auth.php" - создадим гард для администратора во второлм пункте.

		д) Добавим одно правило маршрутизации в файл "admin" - это метод Route::resource('posts', App\Http\Controllers\Admin\PostController::class); - это ресурс для статей. 
			Данное правило маршрутизации вмещает в себя мнгожество методов класса, который был создан с атребутом  "--resource".
			На самом деле адрес пишется admin\posts, а не "posts", но мы написали для файла admin префикс "admin".
			Чтобы отсделить созданное правило маршрутизации в проекте - пропишем команду: 
				php artisan route:list - команда отображения правил маршрутизации в проекте 
				Для файла "admin" отображается информация не об одном правиле маршрутищации, а множестве, хотя в файле ыла создана одна запись: 
					GET|HEAD        admin/posts ..............posts.index › Admin\PostController@index  
					POST            admin/posts ..............posts.store › Admin\PostController@store  
					GET|HEAD        admin/posts/create .......posts.create › Admin\PostController@create  
					GET|HEAD        admin/posts/{post} .......posts.show › Admin\PostController@show  
					PUT|PATCH       admin/posts/{post} .......posts.update › Admin\PostController@update  
					DELETE          admin/posts/{post} .......posts.destroy › Admin\PostController@destroy
					GET|HEAD        admin/posts/{post}/edit ..posts.edit › Admin\PostController@edit  
				
			То есть одной записью "Route::resource('posts', App\Http\Controllers\Admin\PostController::class);" создается множество правил маршрутизации. 
	
	2. Создание контроллера, шаблонов и настроек для авторизации 
		php artisan make:controller Admin/AuthController
		Во втором уроке мы создавали администратора через сид со своими параметрами входа. 

		Для настройки авторизации зайдем в файл "laravel\config\auth.php"
			В этом файле создаются гарды. Создадим гарду и для админ-панели и заменим в ней провайдер на "admin_users":
				'admin' => [
					'driver' => 'session',
					'provider' => 'admin_users',
				],
			Создадим новый провайдер для гарды в том же файле "laravel\config\auth.php"
				'admin_users' => [
					'driver' => 'database',
					'model' => App\Models\AdminUser::class,
				],
		
		Добавим созданное правило маршрутизации в мидлвар "auth:admin", где auth - мидлвар, а admin - гард:
			Route::middleware('auth:admin')->group(function(){
				Route::resource('posts', App\Http\Controllers\Admin\PostController::class);
			});
		
		Добавим дополнительно правила маршрутизации на авторзацию:
			Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'index'])->name('login');
			Route::post('/login_process', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login_process');
			Route::get('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
				Название маршрутизация "name('login')" и "name('login_process')". НА самом деле имеют приставку "admin", но мы объявили ->prefix('admin.') в провайдере.

		Наполним контролер "Controllers\Admin\AuthController.php" для авторизации админа и добавим префиксы "admin" ко всем создаваемым вьюхам. 
		Создаем вьюхи. 
			\admin\auth\login.blade.php, \admin\posts\index.blade.php, "\layout\admin.blade.php", "\admin\posts\create.blade.php". 

		Заполняем шаблон с выводом статей роутами: 
			<a href="{{ route('admin.posts.edit', $post->id) }}" class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
			<a href="{{ route('admin.posts.create') }}" class="text-indigo-600 hover:text-indigo-900">Добавить</a>
			Но с роутом "destroy" дело обстоит сложнее. 
				Так как метод "Route::resource" имеет запрос DELETE, а не GET или POST. Поэтому поле с кнопкой удаления оборачивается в форму.
					<form action="{{ route('admin.posts.destroy', ) }}" method="">
						@csrf
						@method('DELETE')
						<button type="submit" href="{{ route('admin.posts.destroy', $post->id) }}" class="text-red-600 hover:text-red-900">Удалить</button>		
					</form>
				Форма поддерживает только два типа GET/POST, но метод DELETE можно указать через дерективу "@method('DELETE')". 
		
		3. Наполнение контроллеров, кнопок редактирования, добавления и удаления
			Удаление статьи и редирект на страницу со статьями:
				public function destroy($id){
					Post::destroy($id);
					return redirect(route("admin.posts.index"));
				}
			Добавление статьи
				public function create(){
					return view('admin.posts.create', []);
				}
			Создадим formRequest для таблицы create
			
			Шаблоны на создание и редактирование статьей практически одинаковые, и чтобы не плодить шаблоны - создадим в одном шаблоне гибкий "action", ведущий как на метод создания так и обновления статьи.
				Примр гибкого вывода названия страницы в зависимости от наличия статьи в запросе: 
					<h3 class="text-gray-700 text-3xl font-medium">{{ isset($post) ? 'Редактирование статьи' : 'Добавление статьи' }}</h3>

			$post прилетает из метода create контроллера PostController
			Пример: 
				<form class="space-y-5 mt-5" method="POST" action="{{ isset($post) ? route('admin.posts.update', $post->id) : route('admin.posts.store') }}">
					Если $post принимается формой - значит статья уже существует и ее нужно только обновить, если нет - создаем ее. 
			Так же с методом передачи формы. 
			Пример:
				@if ($post)
					@method('PUT');
				@endif
					По-умолчанию форма имеет метдо POST, но если существующую статью нужно изменить - метод меняется на PUT.
			Так же у всех полей прописываем значение value на случай, если статья редактируется, а не добавляется: 
				value="{{ $post->title ?? '' }}", value="{{ $post->preview ?? '' }}", value="{{ $post->description ?? '' }}".
				
		4. Добавление картинок через форму
			В форму добавляем свойство, позволяющее передавать через форму файлы: enctype="multipart/form-data". 
			Картинка будет отображаться, если статья редактируется:
				@if (isset($post) && $post->thumbnail)
					<div>
						<img class="h-64 w-64" src="/laravel/storage/app/public/posts/{{ $post->thumbnail }}">
					</div>
				@endif

		5. Добавление картинки в контроллере
			В formRequest поле "thumbnail" должно должно проверяться на налчие файла-картинки "thumbnail" => ["image"],

			public function update(PostFormRequest $request, $id)
			{
				$post = Post::findOrFail($id);
				$data = $request->validate();
				if ($request->has('thumbnail')) {
					$thumbnail = str_replace("public/posts", "", $request->file('thumbnail')->store("public/posts"));
					$data['thumbnail'] = $thumbnail;
				}
				$post->update($data);
				return redirect(route('admin.posts.index'));
			}
			где, 
				$post = Post::findOrFail($id); - поск статьи по Id
				$data = $request->validate(); - складывание всех валидных полей в переменную
				if ($request->has('thumbnail')){...} - проверяет запрос на наличие картинки
				$request->file('thumbnail') - сохранение картинки
				->store("public/posts") - передача сохраненной картинки в дерикторию
				str_replace("public/posts", "", $request->file('thumbnail')->store("public/posts")); - срезание пути до картинки, чтобы в переменной сохрянялос только названеи изображения
				$thumbnail = str_replace("public/posts", "", $request->file('thumbnail')->store("public/posts")); - присваивание переменной названия картинки
				$data['thumbnail'] = $thumbnail; - присвоение к массиву с валидными полями названия картинки к полю "thumbnail". 
				$post->update($data); - обновление значения полей в статье

			
			



*/

echo '<hr><hr><br><h3>Урок - #8 - Как использовать очереди (Queues/Jobs) в Laravel
</h3><hr><hr>' . "<br>";
/*Введение:
В теме отправки почты (которую мы не реализовали) были упомянуты очереди, которые освобождают пользователя от ожидания отправки сообщения. 
	Очереди - это функционал laravel, позволяющий невелировать время ожидания каких либо событий пользователем, помещая их выполнение в фоновый режим. 
		Они применяются буть то либо в отправке сообщений, либо в загрузки группы файлов пользователем.
			
	1. Настройка очередей и типы очередей 
		Файл с конфигурацией очередей находится в "config\queue.php".
		В файле есть несколько типов очередей:
		sync, database, beanstalkd, sqs, redis.
			Рассмотрим только два типа:
				sync		- тип очереди выбранный по умолчанию. Задача в очереди начинает выполняться мгновенно, не влияя на скорость выполнения задачи. 
				database	- тип очереди, записывающий задачу в таблицу БД "jobs" - его и будем использовать. 
					Задачи записанные в таблицу начинают выполняться через воркер, т.е. задача записанная в очередь не начинает выполняться мгновенно, а по команде в фоновом режиме. 
	
	2. Создание таблицы, класса для записи очередей
		Для работы с очередями типа "database" - понадобиться создать таблицу "jobs" через миграцию, так  таблицы по умолчанию нет. 
			Команда создания миграции с таблицой:
				php artisan queue:table
			Команда выполнения миграции:
				php artisan migrate
			Команда создания класса, в который записываютяс задачи, кладущиеся в очередь:
				php artisan make:job ForgonUserEmailJob
					job - тип класса, записывающий задачу в очередь 
					ForgonUserEmailJob - название класса
						Появляется класс в папке "laravel\app\Jobs\ForgonUserEmailJob.php"
	
	3. Функционал класса записи очереди
		Функция "__construct" 	- принимает и присваивает данные, необходимые для задачи
		Функция "handle"			- выполняет задачу с значениями, полученными в "__construct"
			Пример записи отправки письма в очередь:
				// private $user;
				// private $password;
				// public function __construct($user, $password){
				//     $this->user = $user;
				//     $this->password = $password;
				// }
				public function handle(){
					//Mail::to($this->user)->send(new ForgotPassword($this->password));
				}
			Пример вызова функционала занесения задачи в очедедь из контроллера 3-мя способами:
				//1. dispatch(new ForgonUserEmailJob($user, $password));
				//2. $this->dispatch(new ForgonUserEmailJob($user, $password));
				//3. ForgonUserEmailJob::dispatch($user, $password);
									
	4. Настройка работы записи в очередь
		По-умолчанию сейчас стоит тип записи в очередь "sync", чтобы поменять его на "database" нужно:
			В файле ".env" поменять значение строки "QUEUE_CONNECTION" с "sync" на "database".
		
		При отправке сообщения пользователем задача попадает в таблицу "jobs" на оидание выполнения. 
			Для выполнения задачи, находящейся в ожидании прописывается воркер - кмоманда, запускающая выполнение задач в очереди. 
			После запуска команды воркер будет ождать поступления задачи до закрытия консоли. 
			Пример:
				php artisan queue:work 

		Для работы воркера на живом(нелакальном) сервере в laravel - используется "Supervison Configuration". Принцип работы тот же, но для хостинга. 

	5. Ошибка при выполнения задачи, находящейся в очереди. 
		Если задача, напимер прописана с ошибкой в классе "ForgonUserEmailJob" - то задача при вызове воркера перезаписывается из таблицы "jobs" в другую таблицу "failed_jobs".
		Таблицы "failed_jobs" в отличии от "jobs" находится в БД по умолчанию вне зависимости от создания таблицы "jobs". В "failed_jobs" прописывается ошибка выполнения задачи.

		Конманда отображения зафейленных задач:
			php artisan queue:failed
				Команда отображеет ID задачи, тип очереди, класс поставивший задачу в очередь, время записи задачи в таблицу "failed_jobs". 
		
		Команда выполнения зафейленных задач:
			php artisan queue:retry all
				all - выполнение проверки всех зафейлиных задач. Здесь можно записать ID конкретной задачи. 
					Команда проверяет задачу и перевод ее из таблицы "failed_jobs" в таблицу "jobs". 
					Далее задача выполняется воркером либо его запуском, если проект не на хостинге и если ошибка исправлена. 

		Коммент под видео:
			Классно коротко-доходчиво. Только не учи джунов экземпляры классов в джобы кидать. Сложные классы могут не восстать из сериализации. 
			Лучше передай данные необходимые для инстанцирования, id например для модели
		*/								

echo '<hr><hr><br><h3>Урок - #9 - Laravel Events/Observers (cобытия)
</h3><hr><hr>' . "<br>";
/*Введение:
	Поговорим о события, обсервирах и их применении. 
	Событие - это класс (event/событие), который при вызове запускает работу множества обработчиков-классов (listener/обработчик), которые выполняют действия при исполнении события. 
		Буть то отправка сообщения боту, e-mail, выгрузка в SRM и т.д.
	После совершения какого либо события в приложении подразумевается множество действий. 
	Например при оплате товара на сайте высылается e-mail сообщение покупателю, менеджеру и т.п. Чтобы не захломлять контроллер множеством кода - используются события. 
	
	1. Создание события, листенера и их настройка
		В отличии от очередей - для работы с событиями не нужно ничего создавать перед созданием самого события - например таблицы "job". 
		Входной точкой для инициализации событий является файл "app\Providers\EventServiceProvider.php". 
			В нем уже имеется одно событие и в нем вызов одного обработчика:
			Пример:
				Registered::class => [
						SendEmailVerificationNotification::class,
				],
			где, 
			Registered - класс события
			SendEmailVerificationNotification - класс-обработчик (листенер/listener), активирующийся при совершении события
			Новое событие с листенером будет выглядеть так:
				CommentCreated::class => [
					NewCommentEmailNotification::class,
				],
			После срабатывания события "CommentCreated" - выполняется листенер "NewCommentEmailNotification". Количество листенеров неограничено. 

		Исользуем события на примере отправки комментария - в виде отправки e-mail сообщения. 
		Создание события происходит через командную строку:
			php artisan make:event CommentCreated
			где,
				make:event 		- создание события
				CommentCreated	- название события
		Класс-событие будет только принимать переменные через конструктор, полученные из контроллера и после передавать их классам-листенерам.
		После создания класс появляется в папке "\app\Events\CommentCreated.php";

		Создание обработчика (listener), выполняющегося при совершении события:
			php artisan make:listener NewCommentEmailNotification
				или так 
			php artisan make:listener NewCommentEmailNotification --event=\App\Events\CommentCreated
			где,
				make:listener 								- создание обработчика события
				NewCommentEmailNotification			- название обработчика
				--event=\App\Events\CommentCreated	- параметр, указывающий  listener'у от какого event-class'а принимать параметры
		Класс-listener будет выполнять действия с переменными, полученными от класса-события. 
		После создания класс появляется в папке "\app\Listeners\NewCommentEmailNotification.php";
			
	2. Работа с созданными событием и листенером
		Так как event только принимает аргументы от контроллера, то в его распоряжении достаточно оставить только конструктор с присваиванием аргумента полю. 
			public $comment;
			public function __construct($comment){
				$this->comment=$comment;
			}

		И так как listener в лишь выполняет действие с полученными аргументами, то ему достаточно оставить лишь метод выполнения (без контроллера). 
			public function handle(CommentCreated $event){
				//код отправки текста комментария куда нибуть $event->commemt->text; ...
			}

	4. Добавление вызова события в контроллере
		$comment = $post->comments()->create($request->validated());
		//вызов события по отправки комментария
		event(new CommentCreated($comment));

		НА ЗАМЕТКУ: 
		Чтобы обработчик - listener приступал к отправки сообщения не сразу, а с задержкой - то ему нужно имплементировать интерфейс "ShouldQueue". 
		Пример:
			class NewCommentEmailNotification implements ShouldQueue {...}

		НА ЗАМЕТКУ: 
		Минусом работы с событием является нечитабельный код. Дело в том, что незнакомому с проектом разработчику не понять просто так, куда класс-event передает полученный аргумент, так как в нем нет информации о листенере, а только есть метод "__construct{}".

	5. Observer, его настройка и связь с моделью
		Observer (обсервер) - это набор событий, привязанный к конкретной моделе, которые вызывают листенер в зависимости от метода, выполненного моделью. 
			Observer создается когда большинство методов модели напрашивается наличие событий. Это нужно для того, чтобы не плодить кучу событий-event'ов.
		
		Команда создания Observer:
			php artisan make:observer CommentObserver --model=\App\Models\Comment
			где, 
				make:observer 					- создание обсервера
				CommentObserve 				- название обсервера
				--model=\App\Models\Comment - модель к которой пикрепляется обсервер
		После создания класс появляется в папке "\app\Observers\CommentObserver.php";
	
		В созданном обсервере прописаны все события, привязанные к методам модели. 

		Как у события - основные настройки обсервера находятся в "app\Providers\EventServiceProvider.php".
		Зависимость между обсервером и моедлью прописывается в методе boot:
			public function boot(){
				Comment::observe(new CommentObserver());
			}

		Теперь с событиями в комментяриях можно работыть через один класс вместо того, чтобы плодить множество event. 
		Если какие то методы не не подразумевают вызова событияй - то их можно убрать из обсервера, связанного с моделью.  
	
		Коммент о имплементации интерфейса для отправки действия в очередь:
			Хотелось бы кое-что пояснить по поводу момента на 9:36, когда мы подключаем к классу интерфейс ShouldQueue.
			Мне было непонятно, почему обработчик должен работать в качестве очереди. В смысле непонятно, как интерфейс может повлиять на это.
			Возможно, для опытных php-программистов будет очевидно, но я не мог понять и меня это нервировало))
			Нашёл ответ на Stack Overflow. Оказывается, Laravel просто проверяет, является ли экземпляр сущностью класса (в то числе всех родительских классов и интерфейсов)
			Что-то вроде
			if ($object instanceof ShouldQueue)
			И, судя по всему, тогда и реализуются методы, относящиеся к очереди.
		Ответ:
			Да я тоже не гений и какие то моменты могу посчитать очевидными и не обьяснить до конца но вы правильно поняли, есть проверка на реализацию у класса интерфейса, все просто

	*/

echo '<hr><hr><br><h3>Урок - # 10 - Создание собственных глобальных helpers в Laravel
</h3><hr><hr>' . "<br>";
/*Введение:
	В Laravel предусмотрена возможность создания собственных глобальных helper'ов, например таких как url(), route(), auth().

	1. Создание хелпера
		Допустим нужно будет создать хелпер {{ helloWorld() }}
		Создается файл, хранящий самодельные хелперы в дериктории "app\helpers.php".
			Код хелпера:
				<?php
				if(!function_exists("helloWorld")){
					function helloWorld(){
						return 'Hello World';
					}
				}
				где,
					!function_exists("helloWorld") - проверка на существование в проекте функции "helloWorld"
				Проверка нужна, чтобы изюежать дублирования функций на случай, если кто нибуть в команде уже создал ее. 
				Если созданный хелпер уже создавался - при его взове выведется ошибка. 

	2. Подключение хелпера
		Созданный хелпер нужно подключить к приложению через файл "composer.json", прописав автозагрузку хелпера в секции "autoload" после "psr-4":
			Пример:	
			"autoload": {
				"psr-4": {
						...,
				},
				"files": [
					"app\helpers.php"
				]
			},
		Затем нужно сгенерировать обновленный файл "autoload", подключаемый к laravel приложению.
		Делается это через команду:
			composer dump-autoload 
			
	3. Вызов хелпера в шаблоне
		{{ helloWorld() }}


*/

echo '<hr><hr><br><h3>Урок - #11 - 6 советов по laravel blade
</h3><hr><hr>' . "<br>";
/*Введение:
	В уроке будут разобраны 6 советов по сокращению кода в blade шаблонах.

	1. Деректива "Forelse"
		Forelse - это сочитание деректив "@if", "@else" и "@foreach". 
		Кода без испотзования "Forelse":
			@if ($posts->count())
					@foreach ($posts as $post)
						<li>{{ $post->name }}</li>
					@endforeach									
				@else
					<p>Статей нет</p>
			@endif

		Кода с испотзованием "Forelse":
			@forelse ($posts as $post)
				<li>{{ $post->name }}</li>
			@empty
				<p>Статей нет</p>
			@endforelse

	2. Директива "Each".
		Директива "Each" может приобразовать код из нескольких строк в одну строку, но с использованием партела. 
		Партел(partials/частичные) - это повторяющаяся частичка/шаблон модуля, помещенная в отделное место во избежании повторения кода. 
		Пример использования партела постов - это файл "resources\views\posts\show.blade.php".
		Партел использовать весьма рекомендуется, так как он позволяет избежать повторения кода, так те же статьи могут вызываться и на главной странице и в шаблоне вывода статей. 
		Код без испоьзования "Each":
						@forelse ($posts as $post)
				<li>{{ $post->name }}</li>
			@empty
				<p>Статей нет</p>
			@endforelse

		Код с использованием "Each":
			@each('partials.post', $posts, 'post', 'partials.empty-post')
			где, 
				partials.post			- вызываемый шаблон с постом (партел).
				$posts					- передаваемый в партел объект с постами
				post						- название елемента в партеле
				partials.empty-post	- партел, выводящийся в случаи отсутствия/пустоты передаваемого массива

		Вид партела с названием статьи:
			<li>{{ $post->name }}</li>
		Вид партела с оповещением о отсутствие статей:
			<p>Статей нет</p>

	3. Директивы "Auth", "Guest".
		Проверка на авторзацию может происходить чрезе вызов хелпера "auth". 
			@if (auth()->checked())
				{{ $user->email }};							  
			@else
				<p>Не авторизован</p>;	
			@endif

		А может через дерективы "@Auth" и "@guest":

			@auth
				{{ user()->email; }}
			@endauth

			@guest
				<p>Не авторизован</p>;	
			@endguest

	4. Директива "User Object"
		Часто разработчики указывают данные авторизованного пользователя в контроллере перед отправкой в шаблон. 
			Такой способ подразувемает обязательную передачу из контроллера даннх авторизованного пользователя "User::find(auth()->id())". 
		В этом нет необходимости если в шаблоне использовать объект "user" совместно с хелпером "auth".
			Пример: 
				@auth
					{{ auth()->user()->email; }}
				@endauth

	5. Директивы "Isset" и "Empty"
		
		Примеры без использовангия деректив:
			@if (isset($posts))
				<p>Записи есть</p>;							  
			@endif

			@if (empty($posts))
				<p>Записей нет</p>;							  
			@endif

		Примеры с использовангием деректив:
			@isset($$posts)
				<p>Записи есть</p>;
			@endisset

			@empty($posts)
				<p>Записей нет</p>;
			@endempty

	6. Директивы - "Production", ".env" на проверку окружения
		Директива "Production" на проверку окружения. Используется например для отображения скриптов-метрик. 
			Окружение задается в файле ".env": APP_ENV=local, где local - окружение
			Директива "production" при окружении "production" 
			Пример:
				@production

				@endproduction

			Директива "env" сработала бы при совпадении строковых значений, указанных в директиве и APP_ENV.
			Пример: 	
				@env('production')
					
				@endenv

*/

echo '<hr><hr><br><h3>Урок - #12 - Роли, Права, Авторизация в Laravel. Необходимые знания для понимания Gates и Policies. Часть 1
</h3><hr><hr>' . "<br>";
/*Введение:
	В уроке будут разобраны базовые знания о разделении прав пользователей; 
	Создана простая ролевая модель; Разобраны понятия "Gates", "Policies" и когда из применять; Будут рассмотрены методы работы с авторизацией.

	1. Порядок создания всего необходимого для авторищации
	В поде ролика потребуется: Роли, права и авторизация в Laravel. 
		а) Будет использована админ-панель из курса Laravel с нуля;
		б) Cоздана миграции таблицы ролей с ролями (админ/менеджер/пользователь). 
		в) Связующая таблица роли и пользователя-администратора.
			Связующие таблицы создаеются путем канкатенации таблицы, которые нужно связать. Название такой таблицы прописывается в алфавитном порядке.
			Например => "admin_user_role", где связываются таблицы "admin_user" и "role" через знак "_". 
		
		Команда создания миграции:
			php artisan make:migration roles -m

		Пример миграции создающей таблицу 'roles' и 'admin_user_role':
				Schema::create('roles', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->timestamps();
	  	});
		
		Schema::create('admin_user_role', function (Blueprint $table) {
			$table->foreignId("role_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
			$table->foreignId("admin_user_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
  		});

		Команда выполнения миграции:
			php artisan migrate
		
		В модели "AdminUser" прописываем отношение к таблици с ролями:
		public function roles(){
			return $this->belongsToMany(Role::class);
		}	

	2. Теория о "Gates"(ворота), "Policies"(политика) и 1-й способ разграничения ролей
		"Gates"(ворота) и "Policies"(политика) - инструменты ограничения прав на функционал ролей пользователей. 
			Gates - более простой вариант ограничения и подходит для понятия основ авторизации. Его используют, когда нужно поставить ограничение на один/два метода.
				Gates имет два состояния - закрыты или открыты по указанным условиям. 
			Policies - используется в бОльших приложениях, когда нужно поставить ограничение на целую модель - группу методов. Но возможен и смешанный подход. 
				В основе действия Policies лежат те же Gates, но правила и услоивия входа объеденены в общий устав. 

		Практика:
			В ходе урока мы не будем прописывать controller, foermeRequest и value, но возьмум их с GitHube. 

	3. Создание Gate и дерективы  его проверки "@can", "@canany" и "@cannot".
		Объявление и регистрация Gate происходит в "app\Providers\AuthServiceProvider.php" в методе "boot".
			Первый гейт:
        Gate::define('delete-post', function(AdminUser $user, Post $post){
				return $user->roles->containsStrict('id', 2);
			}); 
			где, $user->roles->containsStrict('id', 2) - id роли, которой доступна эта способность ("delete-post").
				Первыйм аргументом которого выступает строка с способностью (наприме рудаление статьи).
				Второй аргумент - это коллбек функция.
					Первый аргумент функции это текущий пользователь. 
					Второй и аргумент функции это объект с постом, проверяемый на возможность (право) редактирования (например поста) пользователем.
					Второй аргумент может выступать в виде массива и в нем могут быть другие параметры. 
				
				Gate::before(function(AdminUser $user){
					return $user->roles->containsStrict('id', 2);
	 			});
				Гейт, дающий право на все гейты, если роль пользователя соотвутствует гейту.

			Директива "@can()" ограничевает использование выбранного блока, например удаление поста. 
			Во view "resources\views\admin\admin_users\index.blade.php".     
				Пример: 
					@can('delete-post', $post) 
					<form action="{{ route("admin.admin_users.destroy", $user->id) }}" method="POST">
						@csrf
						@method('DELETE')
						<button type="submit"  class="text-red-600 hover:text-red-900">Удалить</button>
					</form>
					@endcan
				... 
					@can('update-post', $post)
						<a href="{{ route("admin.admin_users.edit", $user->id) }}" class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
					@endcan

			Первым аргументом дерективы "@can" название Gate, а вторым elequen модель $post, полученная из контроллера. 

			Есть еще деректива "@canany", которая в качетсве аргумента способности принимает массив со способностями вместо одного. 
				Пример:	
					@canany(['delete-post', 'update-post'], $post)
						<a href="{{ route("admin.admin_users.edit", $user->id) }}" class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
					@endcanany
			

			Директива "@cannot" - антоним директивы "@can". 


	4. Меод "authorize"		
		authorize - один из методов проверки авторизации и прав пользователя. authorize==@can, но прописывается в контроллере. 
			Пример использования:
				Первым аргументом выступает строка или массив с наименованием "способности", а второым значение или массив знечений проверяемых параметров. 
				$post = Post::findOrFail($id);
				...
				Первый способ:
					$this->authorize('update-post', $post);
				ВТорой способ:
					if (!Gate::allows('update-post', $post)) {
						abort('403');
					}
				Третий способ:
					if (Gate::denies('update-post', $post)) {
						abort('403');
					}
				Четвертый способ:
					$gate = Gate::inspect('update-post', $post);
					$gate->authorize();
				Пятый способ:
					if (!auth('admin')->user()->can('update-post', $post)) {
						abort('403');
					}
				...	
				return view('admin.posts.create', [
					"post" => $post
				]);

*/

echo '<hr><hr><br><h3>Урок - #13 - Роли, Права, Авторизация в Laravel. Знания для понимания Gates и Policies. Часть 2. Политики
</h3><hr><hr>' . "<br>";
/*Введение:
	1. Создание политики
		Политика прописывается так же в "app\Providers\AuthServiceProvider.php"
		Политика в отличии от гейта привязывается не к одной способности (ability), а к группу способностей опереленной модели. 
			Политика работает при использовании способо передачи данных пользователю через 'driver' => 'eloquent'.  
		Команда создания политики:
			php artisan make:policy PostPolicy --model=Post 
			где,
				make:policy 	- создание политики
				PostPolicy	- название политики
				--model=Post 	- название модели к которой будет относиться политика
			Политика появляется в дериктории "app\Policies\PostPolicy.php".

			ВАЖНО! Название политики должно начинаться с названия модели, к которой прикрепляется политика и заканчиваться словом Policy.

		После создания политики - она регистриуется в "app\Providers\AuthServiceProvider.php" в массиве "$policies" через указания сявзи модели и политики.
		Пример: 
			protected $policies = [
				// 'App\Models\Model' => 'App\Policies\ModelPolicy',
				Post::class => PostPolicy::class
			];
		ВАЖНО! В Laravel от 7-й версии есть AutoDiscovery. Это значит, что если политике дать название начиная с названия модели, то Laravel сам увидет эту связи и указывать ее в "AuthServiceProvider.php" не придется. Но это допустимо если соотношение названии модели и политики будет как на примере: Post => PostPolicy. Если такого соответствия нет, то связь модели и политики прилется указывать в "app\Providers\AuthServiceProvider.php".
		
		2. Настойка политики
			В самой политики прописаны все CRUD методы модели, к которой привязана политика. 
				Так как политикой пользоваться будут только админы, то к подключать к политике будем не модель User, а AdminUser - аргументами функкций тоже будут объекты этой модели. 
				Внутри этой модели будет проверяться ползователь с возможными правами
				По-умолчанию же подключается модель User 
					use App\Models\User;
					//@param  \App\Models\AdminUser  $AdminUser
					//@return \Illuminate\Auth\Access\Response|bool
					public function viewAny(AdminUser $AdminUser){}
					где, 
						@param  \App\Models\AdminUser  $user				- ожидаемые параметры принимаемые методом. 
							AdminUser - модель объекта
							$user		 - название объекта
						@return \Illuminate\Auth\Access\Response|bool	- ожидаемый тип данных возвратщаемый меотдом
					При несоответствии получаемых аргументов или типаов возвратщаемых данных - выводится ошибка.

			Нужно напомнить, что когда мы создавали контроллер PostController - мы сделали его ресурсом, т.е. при создании в нем уже имелись все CRUD метода. 

		4. Аuthorizeresource
			Добавим в контроллер-ресурс ( далее "ресурс") "authorizeresource" через метод __construct{}, который cработает на весь ресурс.
				public function __construct(){
					//$this->authorizeResource(Post::class, 'post');
				}, 
			Не обязательно "authorizeResource" прописывать в конструкторе, но тогда придется его прописывать в каждом методе. 
			
			"authorizeresource" - это метод, добавляющий к роутам, связанным с ресурсом мидлвар.
			Добавив "authorizeresource" в контроллер ресурс и прописав команду: "php artisan route:list" - можно увидеть у всех методов ресурса мидлвар "authorize".
			ВАЖНО! При генрации ресурса в laravel, то методы в нем создаются уже с инъекцией переменных "id" => edit($id).
				Чтобы authorizeresource заработал - нужно, чтобы при создании ресурса в команде artisan указывалась модель к которой он прявязан. 
				Либо вручную в ресурсе менять у всех методов правило аргументов/параметров, аргументы на бинды модели. 

			Методы в контроллеры при применении авторайза должны будут выглядеть так:
			* Update the specified resource in storage.
			* @param  PostFormRequest  $request
			* @param  Post $post
			* @return \Illuminate\Http\Response
				public function update(PostFormRequest $request, Post $post){  
				$data = $request->validated();
				if ($request->has('thumbnail')) {
					$thumbnail = str_replace("public/posts", "", $request->file('thumbnail')->store("public/posts"));
					$data['thumbnail'] = $thumbnail;}
					$post->update($data);
				return redirect(route('admin.posts.index'));}

			Чтобы политика заработала нужно в методах, прописанных в политике прописать права:
				public function update(AdminUser $user, Post $post){
					return $user->roles->containsStrict('id', 1);
				}

		5. Применение политики
			С предыдущего урока остаются директивы "@can", в них прописываются методы, которые прописаны и в политике и ресурсе. 
			Пример:
				@can('update', $post)
					<a href="{{ route("admin.admin_users.edit", $user->id) }}" class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
				@endcan

*/

echo '<hr><hr><br><h3>Урок - #14 - Laravel API. Все что необходимо! Json Resource, Resource Collection, Cache, Rate Limit
</h3><hr><hr>' . "<br>";
/*Введение:
	
	ВАЖНО! По-большему счету API отличается от стандартного WEB приложения, тем, что в отвте несет JSON, а не HTML.
		В ход урока сделаем публичный API, предастваляя пользователям данные в открытом или закрытом доступе. 
		Будем хранить историю о версиях апдейтов Laravel с возможностью получения последней версии.
		Т.е. через наш API будут предоставляться данные по версионности laravel.
		
	Задачи на ролик:
		1) Сделать API с разбивкой на версии. 
		2) Разобраться с RESOURCE и RESOURCE-COLLECTIONS. 
		3) Добавить кеширование запросов и observer для контроля кеша. 
		4) Разберемся с RATE LIMIT - ограничение запросов API

	1. Создание модели, миграции, фабрики:
		Команда создания модели, миграции, фабрики:
			php artisan make:model Version --migration --factory
		Команда создания сиида:
			php artisan make:seeder VersionSeeder
		Миграция:
			Schema::create('versions', function (Blueprint $table) {
            $table->id();			
            $table->string('title');
            $table->date('release_data');
            $table->timestamps();
			});
		Сииды:
			Version::factory()->createMany([
				['title' => '8.61', 'release_data' => '2021-09-14'],
				['title' => '8.60', 'release_data' => '2021-09-13'],
				['title' => '8.59', 'release_data' => '2021-09-07'],
				['title' => '8.58', 'release_data' => '2021-09-01'],
				['title' => '8.57', 'release_data' => '2021-08-30'],
				['title' => '8.56', 'release_data' => '2021-06-25'],
			]);
		Команда запуска сиида:
			php artisan db:seed --class=VersionSeeder


	2. Корректировка route, настройка версионности и маршрутизации API
	Для проверки API будем использовать программу Postman.
	Предварительно создадим таблицу через миграцию со списком названий версионности Laravel, которую будем выдавать через API. 
		Сделать API с разбивкой на версии
		В Laravel есть api route : "routes\api.php".
			Пример, который нам не потребуется: 
				Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
					return $request->user();
				});

		В файле регистрации маршрутизации этот роут уже имеется "app\Providers\RouteServiceProvider.php" 
			Пример: 
			Route::prefix('api')
				->middleware('api')
				->namespace($this->namespace)
				->group(base_path('routes/api.php'));

		В неи имеется несоклько отличий:
			а) Есть префикс "prefix('api')". Значит запросы на URL API будут вести на роуты, которые начинаются с api.
			б) Есть мидлвар группа "middleware('api')". Т.е. роуты будут срабатывать только при наличии в запросе API.
				Адрес группы мидвар API (группы классов получающих запрос API): app\Http\Kernel.php
				Пример:
				'api' => [
					// \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
					'throttle:api',
					\Illuminate\Routing\Middleware\SubstituteBindings::class,
				],
					throttle					- отвечает за ограничение запросов
					SubstituteBindings	- отвечает за роут-биндинг. Чтобы в роутах можно было передавать параметры и биндить модели. 
		
		У API будет версионность. Для того в префикс добавим версию. Файлы в папке "route" так же будем разбивать на версии. api_v1.php/api_v2...
			Со временем сервис обрастется клиентами. Реализация API будет улутшаться и значит будет и меняться его версия. 
			И те клиенты, котоыре будут продолжать пользоваться старыми версиями API - получат несовместимость с клиентами с ошибками. 
			Поэтому в том же файле "app\Providers\RouteServiceProvider.php" меняем префикс API и файл с правилами маршрутизации - у каждой версии API будет свой файл. 
					Route::prefix('api/v1')
						->middleware('api')
						->namespace($this->namespace)
						->group(base_path('routes/api_v1.php'));

			Пример вывода всех версий из таблицы "Versions" через API, вызывающую модель: 
				Route::get('/', function(){
					return \App\Models\Version::all();	//вывод всех записей таблицы.
				});
			Командой "http://127.0.0.1:8000/api/v1" - проверяем работоспособность API в Postman. В результате получаем JSON со списком всех версий Laravel из таблицы. 
			
			ВАЖНО! При работе с API на Laravel стоит не забывать о заголовке (Headers) - "Accept" = "application/json".
				Эти же параметры нужно вписывать в Postman при проверке:
					KEY => "Accept"; VALUE => "application/json";
				Это нужно, чтобы Laravel понимал, что от него хотят именно JSON, иначе он будет возвратщать HTML страницу с ошибкой. 
			
	3. Добавление контроллера и ответственности
		На данный момент правила маршрутизации передает JSON напрямую, не обращаясь к контроллеру и без разделения ответственности. Пропишем и то и другое. 
			Контроллер считается мостом между роутом и JSON ответом. 

		ВАЖНО! По-большему счету API отличается от стандартного WEB приложения, тем, что в отвте несет JSON, а не HTML.
		Контроллеры так же будут распределяться на версии API.
		Команда добавления контроллера:
			php artisan make:controller Api/V1/IndexController
		Переделаем роут:
			Route::get('/', [\App\Http\Controllers\Api\V1\IndexController::class, 'index'])->name('home');
		Добавим метод index в контроллер:
			public function index(){
				return Version::all();
			}
		Теперь запрос "http://127.0.0.1:8000/api/v1" выдает так же все записи таблицы через JSON, но с использованием контроллера. 
		
	4. Добавление роута, отображающего последнию версию laravel
		Метод index поменяем на вывод последней версии Laravel, а all на вывод всех версий
		public function index(){
			return Version::orderByDesc('release_data')->first();
		}
		public function all(){
			return Version::all();
		}

	5.1 Json Resource, Resource Collection
	5.1 Json Resource
		Перед отправкой передаваемые данные в JSON может понадобиться дополнитьно обработать.
		Передаваемые поля возможно понадобится скрывать в JSON. 
			Например приводить даты в определенный формат через "мутаторы" или скрывать конкретные поля, через указывание их в переменной модели "hidden" и т.д.
				Мутаотор - В Laravel мутаторы и аксессоры позволяют вам изменять данные перед их сохранением и извлечением из базы данных.
		
		Для всего этого в laravel есть "Json Resource" и "Resource Collection", чтобы не городить все это в контроллере и моделе. 
			"Json Resource" 			- применяется, когда в JSON передается один елемент elequent модели. 
			"Resource Collection"	- применяется, когда в JSON передается коллекция (множество) объектов. 

		Команда создания "Json Resource":
			php artisan make:resource VersionResource  
			Ресурс будет хранится в файле  "app\Http\Resources\VersionResource.php" 
			Вносить изменения в JSON ресурс пока не будем, но посмотрим как изменится ответ метода с использованием ресурса. 

		Изменим ответ метода index в контроллере IndexController:
			public function index(){
				return new VersionResource(Version::orderByDesc('release_data')->first());
			}

		Ответ JSON:
			{
				"data": {
					"id": 1,
					"title": "8.61",
					"release_data": "2021-09-14",
					"updated_at": "2023-02-15T20:14:30.000000Z"
				}
			}

			Видно, что в ответе добавилась обертка "data". Она добавляется по-умолчанию при использовании "Json Resource" и "Resource Collection". 
				Название этой обертки меняется в ресурсе (и в Коллекции тоже) через пропись поля "public static $wrap = 'test';" 
				Если нужно избавиться от обертки:
					а) Если в обертку вставить пустоту: "public static $wrap = ''" - обертка пропадает. 
					б) Либо обратиться к классу "app\Providers\AppServiceProvider.php" и в метод "boot" вставить "JsonResource::withoutWrapping();"
						Пример:
							public function boot()
							{
								JsonResource::withoutWrapping();
							}
		
				Если нужно глобально задать название обертки для всех JSON или глобально убрать обертку у JSON то нужно вписать  "JsonResource::wrap();"
					Пример:
					public function boot()
						{
							JsonResource::wrap('');
						}
			
			Если нужно выводить только определенное поле или поле обработанное из таблице в JSON'е, то в ресурсе прописывается название поля и метод его обработки. 
				Пример:
					public function toArray($request)
					{
						//  return parent::toArray($request);
						return [
							'title' => $this->title,
							'release_data' => $this->release_data->format('d.m.Y'),
							'meta' => $this->when($this->title == '8.61', function(){
								return 'Версия 8.61'; 
							}, function(){
								return 'Версия 8.61 не найдена';
							}),
						];
					}
					где, 
						return []; - в JSON помещается содержимое массива
						'title' => $this->title,	- вывод пля title
							где,
								'title' 			- название поля JSON
								$this->title	- вызов содержимого поля из модели
						'release_data' => $this->release_data->format('d.m.Y'), - вызов поля release_data в формат 'd.m.Y'
						$this->when() - меотд с условием "где", где 
							1-й аргумент - условие ископое поле ($this->title) и предполагаемое значение (8.61), 
							2-й аргумент - колбек функция с выводом в случаи выполнения условия 1-го аргумента
							3-й аргумент - колбек функция с выводом в случаи НЕ выполнения условия 1-го аргумента
						
			
	5.2 Resource Collection
		Команда создания Resource Collection:
			а) php artisan make:resource VersionCollection 
				или
			б) php artisan make:resource Version --collection
			Записи а) и б) равнозначны. Но запись а) освобожадет нас от необходисости записи "public $collects", чтобы показать ссылаемость коллекции на ресурс (VersionResource). 
				Так же как в elequent моделях => если не добавить пометку "Model" - то в ней потом придется указывать таблицу, к которой привязана создаваемая модель.
			--collection - вставка означает, что данный ресурс будет коллекцией как и часть название ресурса "Collection"
			Файл окажется в папке "app\Http\Resources\VersionCollection.php"
		
		Теперь в контроллере поменяем вывод мтеода all, так же как раньше поменяли метод index, но с использованием колекции. Так как выводится множество объектов:
			Пример:
				public function all()
				{
					return new VersionCollection(Version::all());
				}
		Вызов "http://127.0.0.1:8000/api/v1/all" выводит список всех версий, но уже с использовением коллекции 
		ПРИ том, что те условия, прописанные в ресурсе "VersionResource" работают и при выводе через "VersionCollection". 
			Пример:	
				{
				"Collection": [
					{
							"title": "8.61",
							"release_data": "14.09.2021",
							"meta": "Версия 8.61"
					},
					{
							"title": "8.60",
							"release_data": "13.09.2021",
							"meta": "Версия 8.61 не найдена"
					}, ...

		ПРИ вызове всего списка не через метод "all()", а через метод "paginate(1)", то выведенный список будет иметь дополнительные параметры:
			Пример:
				{
					"Collection": [
						{
								"title": "8.61",
								"release_data": "14.09.2021",
								"meta": "Версия 8.61"
						}
					],
					"links": {
						"first": "http://127.0.0.1:8000/api/v1/all?page=1",
						"last": "http://127.0.0.1:8000/api/v1/all?page=6",
						"prev": null,
						"next": "http://127.0.0.1:8000/api/v1/all?page=2"
					},
					"meta": {
						"current_page": 1,
						"from": 1,
						"last_page": 6,
						"links": [
								{
									"url": null,
									"label": "&laquo; Previous",
									"active": false
								},
								{
									"url": "http://127.0.0.1:8000/api/v1/all?page=1",
									"label": "1",
									"active": true
								},
				где, 
					С объектом "Collection" дополнительно выводятся объекты:
						"links"	- ссылки на следующие страницы
						"meta"	- полная информация по каждому элементу пагинации 

				ВАЖНО! Полная информация по элементам пагинации может быть очень удобна для рендеринга всех пагинации при построении приложения с React.js или Vue.js

	6. Оптимизация текущего API.
		6.1 Cash 
			Так как последняя версия Laravel выходт не каждый день, то обращаться за информацией, которая очень редко меняется к базе - не совсем экономно. 
			Поэтому мы закешируем запрос к базе. 
			Кеш настраивается в файле "config\cache.php"
				В файле по-умолчанию хранится файловый кеш, котоырй будет храниться в дериктории starage: 
					'default' => env('CACHE_DRIVER', 'file'),
			Для кеширования запроса пропишем в контроллере используем фассад Cash для изменения кода.
				Пример:
					public function index()
					{
						return new VersionResource(Cache::remember('version', 60*60*24,  function()
						{
							return Version::orderByDesc('release_data')->first();
						}));
					}
					где,
						Cache		- фасад кеш
						remember	- метод записи в кеш	с тремя аргументами:
							1-й аргумент - наименование кеша (version)
							2-й аргумент - время жизни кеша 
							3-й аргумент - колбек функция с кодом, помещаемым в кеш

			Если последняя версия Laravel вышла и была занесена в таблицу, то для обновления кеша используем события => "event".
			Создадим обсервер к моделе Version. 
			Команда создания обсервера:
				php artisan make:observer VersionObserver
			
			В файле "app\Providers\EventServiceProvider.php" зарегистрируем этот обсервыер. 
			Пример:
				Version::observe(VersionObserver::class);
			В файле "app\Observers\VersionObserver.php" добавим метод удаления кеша в случаи создания новой записи в таблицы с версиями. 
			Кеш создатся снова в случаи отстутствия кеша.
				Пример:
					public function created(){
						Cache::forget('version');
						Cache::forget('version_all');
					}

			Так же поменяем код для метода all(). 
			Пример:
			Файл "app\Http\Controllers\Api\V1\IndexController.php":
				public function all()
				{
					return new VersionCollection(Cache::remember('version_all', 60*60*24,  function()
					{
						return Version::paginate(1);
					}));
				}
			Файл "app\Observers\VersionObserver.php":
				public function created(){
					Cache::forget('version');
					Cache::forget('version_all');
				}

		6.2 Rate Limit - ограничение запросов 
			Напомним, что в файле "app\Http\Kernel.php" есть мидлвар "throttle:api", который и отвечает за Rate Limit. 
			Настройка мидвара называются "configureRateLimiting" нахдится в файле "app\Providers\RouteServiceProvider.php".
			Пример:	
				protected function configureRateLimiting()
				{
					RateLimiter::for('api', function (Request $request) {
							return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
					});
				}
				где,
					Limit::perMinute(60) - максимлаьно допустимое количество запросов в минуту == 60
					by($request->user()?->id ?: $request->ip()
					где,
						$request->user()?->id - верзнее условие с запросами относится к текущему пользователю по id
							или
						$request->ip() - к пользователю с текущем ip

*/

echo '<hr><hr><br><h3>Урок - #15 - Laravel Contracts и PHP интерфейсы. Использование в рамках концепции Service Container
</h3><hr><hr>' . "<br>";
/*Введение:
	Интерфейсы PHP - интерфейсы объектов позволяют создавать код, который указывает, какие методы должны реализовывать класс. 
	Контракт - выполняет ту же функцию, что интерфейс. По-сути контракт это интерфейс на языке Laravel. 
		Так как контракт это слово, которое более точно описывает назначение интерфейса (обязывать класс реализовывать определенный функционал - выполнять пункты контракта).
			То в ходе разработки главный разработчик фреймворка решил называть интерфейс в рамках Laravel - контрактом.

*/

echo '<hr><hr><br><h3>Урок - #16 - Тестирование базовых знаний Laravel. Проверь свои навыки в Ларавел!
</h3><hr><hr>' . "<br>";
/*Введение:
	В уроке представлен набор тестов 


*/

echo '<hr><hr><br><h3>Урок - #17 - Фасады (facade) в Laravel. Что это и для чего используются
</h3><hr><hr>' . "<br>";
/*Введение:
	В приложении Laravel фасад – это класс, который обеспечивает доступ к объекту из контейнера. 
	Техника, которая выполняет эту работу, относится к классу Facade.
	Или фассад - это класс, который дает доступ к встроенному функционалу внутри laravel 
*/

<h1>Инструкция по разворачиванию стартового проекта на Wordpress с Gulp</h1>
<p>(HTML-WP-Template v2)</p>

<p>Автор: <b>Станислав Шабалин</b></p>

<p><i>PS: За основу был взят шаблон <a href="http://github.com/agragregra/oh5">OptimizedHTML 5</a></i></p>

<p><b>В пакет входят:</b> 
<div><b>resources</b> - папка для сбора и хранения исходных данных заказчика (ТЗ, макеты, примеры и тд)</div>
<div><b>src/</b> - рабочаяя папка проекта для разработки</div>
<div><b>src/css</b> - исходные подключаемые стили сторонних плагинов</div>
<div><b>src/js</b> - свои кастомные и сторонние скрипты</div>
<div><b>src/fonts</b> - исходные шрифты для подключения в main.css</div>
<div><b>src/sass</b> - исходные собственные стили для препроцессора sass. Компилируются в main.css</div>
<div><b>src/img</b> - исходные изображения (например, логотипы и тп, которые не войдут в media библиотеку WP)</div>
<div><b>src/plugins</b> - библиотеки сторонних разработчиков (подключаются, например, в css/vendors.css и js/_vendors.js файлах)</div>
<div><b>src/worpdress</b> - папка Worpress</div>
<div><b>src/wp-content/</b> - папка контента для Worpress (вынесена из стандартного размещения внутри Worpdress)</div>
<div><b>src/wp-content/themes/mytheme-child/</b> - папка с подключенной дочерней темой (functions.php, style.css)</div>
<div><b>src/wp-content/themes/mytheme-child/css</b> - папка с подключаемыми стилями (main.min.css, vendors.min.css)</div>
<div><b>src/wp-content/themes/mytheme-child/js</b> - папка с подключаемыми скриптами (custom.min.js, vendors.min.js)</div>
<div><b>src/wp-content/themes/mytheme-child/img</b> - папка с подключаемыми изображениями</div>
<div><b>src/wp-content/themes/mytheme-child/fonts</b> - папка с подключаемыми шрифтами</div>
<div><b>src/wp-config.php</b> - файл для подключения БД настроек структуры Wordpress</div>
<div><b>src/index.php</b> - продублированный стартовый файл из папки wordpress с измененными настройками</div>
<div><b>node_modules</b> - набор плагинов для запуска проекта (определяется в файле <i>package.json</i> и устанавливается после команды <i>npm i</i>). См. ниже "Запуск проекта"</div>
<div><b><i>package.json</i></b> - собранный установочный пакет необходимых плагинов</div>
<div><b><i>wp-install.js</i></b> - скрипт для установки последней версии CMS WordPress (rus)</div>
<div><b><i>gulpfile.js</i></b> - скрипты gulp для работы с проектом</li>
</p>

<h2>Запуск проекта</h2>

<pre>git clone https://github.com/Starck43/Start-WP-Template.git</pre>

<ol>
	<li>Клонировать или <a href="https://github.com/Starck43/Start-WP-Template/archive/master.zip">скачать</a> <b>стартовый шаблон</b> с GitHub. Для клонирования должен быть установлен Git.</li>
	<li>Распаковать архив и(или) перейти в папку <b>Start-WP-Template</b></li>
	<li>Запустить консоль cmd или shell (в Total Commander [shift+правая кнопка мыши]) для выполнения последующих команд:</li>
	<li><b>npm i</b> - установить плагины в node_modules для нового проекта (запускать в корне проекта через консоль с предустановленным Node.js и глобальным Gulp</li>
	<li><b>node wp-install</b> - развернуть WordPress</li>
	<li><b>gulp [default(по умол.)|styles|vendors-styles|scripts|vendors-scripts|css-compress|browser-sync|watch|rsync]</b> - запуск Gulp</li>
	<li>Создать БД в phpMyAdmin с названием wordpress и создать нового пользователя со своим именем и паролем (по умол: admin/admin). Разрешить все права на управление базой wordpress</li>
</ol>

<pre>В папке src/wp-content/themes созданы две темы: 
<ul>
<div>Основная с минимальным кодом - Starck</div>
<div>Дочерняя GeneratePress-child</div>
</ul>
<p>! Родительскую тему GeneratePress необходимо предварительно установить, чтобы заработала дочерняя.</p>
<p>! Подключение стилей и скриптов настроено в <b>functions.php</b>. Кастомные файлы располагаются во вложенных в тему соответствующих папках.</p>
</pre>

<h2>Основные таски Gulp для работы с проектом:</h2>

<pre><b>gulp</b> - главный таск для запуска всего пакета целиком. Выполняется через командную консоль</pre>

<ul>
	<li><b title="gulp styles"><em>gulp styles</em></b>: конвертирует все файлы sass в css/main.css</li>
	<li><b title="gulp vendors-styles"><em>gulp vendors-styles</em></b>: подключает сторонние css файлы, включая стили, прописанные через @import в файле css/_vendors.css</li>
	<li><b title="gulp scripts"><em>gulp scripts</em></b>: объединяет собственные скрипты c именем *custom* в файл custom.min.js и сжимает их</li>
	<li><b title="gulp vendors-scripts"><em>gulp vendors-scripts</em></b>: объединяет все сторонние скрипты в папке js, кроме *custom*.js и сжимает их, записывая в файл js/vendors.min.js</li>
	<li><b title="gulp css-compress"><em>gulp css-compress</em></b>: сжатие своих стилей в файл css/main.min.css</li>
	<li><b title="gulp rsync"><em>gulp rsync</em></b>: выгрузка проекта на удаленный сервер хостера</li>
	<li><b title="gulp [default]"><em>gulp</em></b>: запуск группы тасков ['styles', 'scripts', 'vendors-scripts', 'browser-sync', 'watch'] для работы с проектом</li>
</ul>

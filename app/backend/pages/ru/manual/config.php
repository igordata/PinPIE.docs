[title[=Configuration]]
[sidemenu[ru/manual/sidemenu]]
[menu config[=
<ul>
  <li><a href="#config-files">Файлы конфигов</a></li>
  <li><a href="#config-variables">Переменные конфига</a></li>
  <li><a href="#simplest-config">Простейший конфиг</a></li>
  <li><a href="#default-pinpie-settings">Дефолты</a></li>
  <li><a href="#preinclude">preinclude.php</a></li>
  <li><a href="#cache">Кэш</a></li>
  <li><a href="#code-page">Code page</a></li>
  <li><a href="#static">Статики</a></li>
  <li><a href="#log">Log</a></li>
  <li><a href="#page-not-found">Page not found</a></li>
  <li><a href="#pages-folder">Pages folder</a></li>
  <li><a href="#route-to-parent">Route to parent</a></li>
  <li><a href="#site-url">Site URL</a></li>
  <li><a href="#template-function">Template function</a></li>
  <li><a href="#other-variables">Прочие переменные</a></li>
  <li><a href="#config-example">Пример конфига</a></li>
</ul>
]]

<article>
  <header><h1>Конфигурация</h1></header>
  <p>
    Все файлы конфигов лежат в папке <?= scx('/config') ?>.
    При каждом запросе конфиг выбирается автоматически, основываясь на имени сервера.
    Да, вот так просто: <?= scx('basename($_SERVER["SERVER_NAME"]) . ".php"') ?>.
    Таким образом вы можете держать несколько конфигураций в одной папке.
  </p>
  <section>
    <header>
      <h1>
        <a name="config-files" href="#config-files">#</a>
        Файл конфига
      </h1>
    </header>
    <p>
      Чтобы создать файл конфигурации вам нужно создать файл внутри папки <?= scx('/config') ?> с именем
      вашего сервера и расширением ".php". Чтобы начать работать с PinPIE за исключением <?= scx('$random_stuff') ?>
      никаких обязательных настроек не требуется.
    </p>
  </section>
  <section>
    <header>
      <h1>
        <a name="config-variables" href="#config-variables">#</a>
        Переменные конфига
      </h1>
    </header>
    <p>В конфиге вы можете устанавливать следующие переменыне:</p>
    <ul>
      <li><?= scx('$random_stuff') ?> &mdash; строка, используемая как соль. Должна быть заполнена случайными символами.</li>
      <li><?= scx('$pinpie') ?> &mdash; массив для хранения настроек PinPIE.</li>
      <li>
        <?= scx('$conf') ?> &mdash; массив для хранения ваших личных настроек. Вы можете хранить тут любые настройки, какие
        требуется и иметь глобальный доступ к ним через <?= scx('CFG::$conf', 'php') ?>.
      </li>
      <li><?= scx('$databases') ?> &mdash; храните тут ваши найстройки для подключения к базам данных.</li>
      <li><?= scx('$static_servers') ?> &mdash; массив статических серверов (см <a href="/ru/manual/static">статик доку</a>).</li>
    </ul>
    <p>Эти настройки доступны глобально через статик-класс CFG.</p>
  </section>

  <section>
    <header>
      <h1>
        <a name="simplest-config" href="#simplest-config">#</a>
        Простейший конфиг
      </h1>
    </header>
    <?= pcx('/* пусто */') ?>
    <p>Да, он пустой.</p>
    <p>Единственные шаги, которые потребуется сделать:</p>
    <ul>
      <li>положить пустой файл с именем вашего сервера типа "site.com.php" в папку "/config"</li>
      <li>направить все запросы на index.php</li>
    </ul>
    <p>
      И PinPIE сделает всё остальное.
      Однако стоит помнить, что очень важно напихать в <?= scx('$random_stuff') ?> кучу всяких случайных символов.
      Так что хороший простой конфиг должен быть вот таким:
    </p>
    <code class="php">
      <pre>$random_stuff = "[[$random_stuff]]";</pre>
    </code>
  </section>

  <section>
    <header>
      <h1>
        <a name="default-pinpie-settings" href="#default-pinpie-settings">#</a>
        Дефолтные настройки PinPIE
      </h1>
    </header>
    <p>
      Для работы PinPIE нужно не так уж и много разных настроек. Их дефолтные значения находятся в файле
      <?= scx('/pinpie/classes/cfg.php') ?>. Вот они:
    </p>
    <?= pcx('$pinpie = [
  "cache type" => "files",
  "cache rules" => [
    "default" => ["ignore url" => false, "ignore query params" => []],
    200 => ["ignore url" => false, "ignore query params" => []],
    404 => ["ignore url" => true, "ignore query params" => []]
  ],
  "cache hash algo" => "sha1",
  "cache forever time" => PHP_INT_MAX,
  "chunks folder" => ROOT . DS . "chunks",
  "chunks realpath check" => true,
  "codepage" => "utf-8",
  "log" => [
    "path" => "pin.log",
    "show" => false,
  ],
  "static folder" => ROOT,
  "static gzip level" => 5,
  "static gzip types" => ["js", "css"],
  "static minify types" => ["js", "css"],
  "static minify function" => false,
  "static dimensions types" => ["img"],
  "static dimensions function" => false,
  "static draw function" => false,
  "static realpath check" => true,
  "pages folder" => ROOT . DS . "pages",
  "pages realpath check" => true,
  "page not found" => "index.php",
  "route to parent" => 1,
  "site url" => $_SERVER["SERVER_NAME"],
  "snippets folder" => ROOT . DS . "snippets",
  "snippets realpath check" => true,
  "templates folder" => ROOT . DS . "templates",
  "template function" => false,
  "template clear vars after use" => false,
  "templates realpath check" => true,
  "working folder" => ROOT,
  "preinclude" => ROOT . DS . "preinclude.php",
  "postinclude" => ROOT . DS . "postinclude.php",
];', 'php') ?>
  </section>


  <section>
    <header>
      <h1>
        <a name="preinclude" href="#preinclude">#</a>
        Файлы preinclude.php и postinclude.php
      </h1>
    </header>
    <p>
      При каждом запросе PinPIE попытается подключить два файла, если они существуют:
      <?= scx("ROOT/preinclude.php") ?> и <?= scx("ROOT/preinclude.php") ?>,
      где <?= scx("ROOT") ?> это <a href="/ru/manual/constants#root">константа корневого пути</a>.
      Пути к этим файлам можно изменить в <a href="http://pinpie.ru/ru/manual/config">конфиге</a>.
    </p>
    <p>
      Сначала проверяется существование файла <?= scx("ROOT/preinclude.php") ?>.
      Если он есть &mdash; он инклудится. Его отличие от <?= scx("ROOT/index.php") ?> в том,
      что в момент его инклуда уже заданы основные параметры PinPIE: прочитан конфиг,
      определён файл-обработчик запроса <?=scx('PinPIE::$document', 'php')?>, который можно изменить
      по своему усмотрению.
    </p>
    <p>
      Данный файл подходит для размещения кода автозагрузчика классов.
      Впрочем, для этой задачи подходит и <?= scx("ROOT/index.php") ?>.
    </p>
    <p>
      Потом, когда закончена обработка запроса, PinPIE пытается включить файл <?= scx("ROOT/preinclude.php") ?>.
      Этот файл подходит для вывода дебаг информации и отложенных действий,
      например с помощью <a href="http://php.net/manual/en/function.fastcgi-finish-request.php">fastcgi_finish_request()</a>.
    </p>
    <p>
      При обновлении файлов PinPIE на новую версию, эти файлы не пропадут и не будут перезаписаны,
      т.к. они отсутствуют в самом PinPIE. Так что можете уверенно использовать эти файлы
      для своих нужд.
    </p>
  </section>

  <section>
    <header>
      <h1>
        <a name="cache" href="#cache">#</a>
        Кэш
      </h1>
    </header>
    <p>Кэширование контролируется вот этими вот параметрами:</p>
    <ul>
      <li>
        cache type &mdash; провайдер кэша. Может быть "files", "memcached", "apc" или "disabled".
        Можно использовать <a href="/ru/manual/cache#custom-cacher">кастомный класс</a>. Дефолтное значение это "files".
      </li>
      <li>cache hash algo &mdash; алгоритм, используемый при генерации хэшей кэша. По умолчанию используется "sha1".</li>
      <li>
        cache rules &mdash; правила кэширования. Призваны бороться с распуханием кэша в случаях с большим количеством
        уникальных запросов.
      </li>
      <li>cache forever time &mdash; определяет длину вечности (в секундах)</li>
    </ul>
    <p>Крайне рекомендую прочесть об устройстве кэша в <a href="/ru/manual/cache">доках кэша</a>.</p>
  </section>

  <section>
    <header>
      <h1>
        <a name="code-page" href="#code-page">#</a>
        Code page
      </h1>
    </header>
    <p>
      PinPIE хранит текущую кодировку в <?= scx('$pinpie["codepage"]') ?>. Вы можете использовать это значение в ваших
      скриптах. Значение по умолчанию "utf-8".
    </p>
  </section>

  <section>
    <header>
      <h1>
        <a name="static" href="#static">#</a>
        Статика
      </h1>
    </header>
    <h2>Static folder</h2>
    <p>Используется при обработке статик-тегов. Дефолтное значение <?= scx('ROOT') ?>.</p>
    <p>
      В большинстве случаев такие файлы как js, css или картинки в той же папке, что и php-скрипты.
      Но можно хранить статичный контент отдельно.
      Пропишите в конфиге в <?= pcx('$pinpie["static folder"]') ?> путь к своим статик файлам
      и используйте удобные статик теги в своём проекте.
    </p>
    <h2>Gzip</h2>
    <p>
      Gzip прекомпрессия позволяет уменьшить вес статичных файлов.
      Этот набор настроек позволяет вам контролировать автоматическую прекомпрессию статичных файлов:
    </p>
    <ul>
      <li>static gzip level &mdash; уровень сжатия, по умолчанию 5.</li>
      <li>
        static gzip file types &mdash; массив, в котором должны быть те типы статик тегов, которые надо сжимать.
        Дефолтное значение: <?= scx('["js", "css"]') ?>.
      </li>
    </ul>
    <h2>Минификация</h2>
    <p>Минификация также может производиться PinPIE автоматически. Вот настройки этого процесса:</p>
    <ul>
      <li>
        static minify filetypes &mdash; список типов статик тегов, которые надо минифаить.
        По умолчанию это массив <?= scx('["js", "css"]') ?>.
      </li>
      <li>
        static minify files function &mdash; функция, которую надо вызвать для минификации файла.
        В этой функции вы можете вызвать свой минифаер. Равно <?= scx('false') ?> по умолчанию.
      </li>
    </ul>
    <p>Настоятельно рекомендую прочесть побольше про статик теги в <a href="/ru/manual/static">статик доке</a>.</p>
  </section>

  <section>
    <header>
      <h1>
        <a name="log" href="#log">#</a>
        Log
      </h1>
    </header>
    <p>
      PinPIE будет писать в лог "pin.log" некоторые ошибки вроде несуществующего файла тега.
      Можно указать другой путь в <?= scx('$pinpie["log"]["path"]') ?>.
      Также можно включить вывод ошибок прямо на страницу, что по дефолту конечно выключено.
    </p>
  </section>

  <section>
    <header>
      <h1>
        <a name="page-not-found" href="#page-not-found">#</a>
        Page not found
      </h1>
    </header>
    <p>
      Указывает страницу, которая будет обрабатывать запросы к ненайденным страницам.
      По умолчанию это "/pages/index.php", но хорошо бы для этих нужд выделить отдельную страницу вроде "/pages/notfound.php".
      В любом случае, если запрошенная страница не найдена, будет автоматически использован заголовок с кодом 404.
    </p>
  </section>

  <section>
    <header>
      <h1>
        <a name="pages-folder" href="#pages-folder">#</a>
        Pages folder
      </h1>
    </header>
    <p>Место хранения страниц. Дефолтное значение <?= scx('ROOT . "/pages"', 'php') ?>.</p>
  </section>

  <section>
    <header>
      <h1>
        <a name="route-to-parent" href="#route-to-parent">#</a>
        Route to parent
      </h1>
    </header>
    <p>
      Эта переменная отвечает за обработку урлов.
      Подробнее читайте в <a href="/ru/manual/routing">доке по роутингу</a>.
    </p>
  </section>

  <section>
    <header>
      <h1>
        <a name="site-url" href="#site-url">#</a>
        Site url
      </h1>
    </header>
    <p>
      Эта переменная используется при автоматическом создании урлов для статичных файлов в случае, если список
      статик серверов пуст.
      Менять или устанавливать её не требуется, но если хотите - пожалуйста.
    </p>
  </section>

  <section>
    <header>
      <h1>
        <a name="template-function" href="#template-function">#</a>
        Template function
      </h1>
    </header>
    <p>
      Эта та функция, которая будет вызывана при применении темплейта.
      Подробнее читайте в <a href="/ru/manual/templates#custom-template-function">доке по темплейтам</a>.
    </p>
  </section>

  <section>
    <header>
      <h1>
        <a name="other-variables" href="#other-variables">#</a>
        Прочие переменные
      </h1>
    </header>
    <h2>Разные настройки</h2>
    <p>
      Если хотите, вы можете хранить любые свои настройки в массиве <?= scx('$conf') ?>.
      Он будет глобально доступен через <?= scx('CFG::$conf', 'php') ?>.
    </p>
    <h2>Массив баз данных</h2>
    <p>
      Массив <?= scx('$databases') ?> призван хранить в себе настройки доступа к базам данных.
      Вы можете использовать чтобы передавать настройки в ваши классы работы с БД.
    </p>
    <h2>Серверы статичного контента</h2>
    <p>
      Список настроек статичного контента можно найти в переменной <?= scx('$static_servers') ?>.
      Подробнее можно прочесть в <a href="/ru/manual/static#servers-sharding">статик доке</a>.
    </p>
    <h2>Соль</h2>
    <p>
      Для безопасности вы должны установить в переменную <?= scx('$random_stuff') ?> случайную строку, уникальную для
      каждого вашего сайта.
      Эта переменная используется при генерации <a href="/ru/manual/cache#hash">хэша кэша</a> и может быть использована
      где угодно в вашем коде через <?= scx('CFG::$random_stuff') ?>. Главное помните, что она не создавалась для
      использовании в криптографии, так как настоящая соль должна быть разной каждый раз. А ещё некоторые криптографические
      функции не могут использовать такие длинные строки в своих алгоритмах.
    </p>
  </section>

  <section>
    <header>
      <h1>
        <a name="config-examples" href="#config-examples">#</a>
        Пример конфига
      </h1>
    </header>
    <p></p>
    <?= pcx('
  /*
  * Random sting
  * Random string $random_stuff is used in hashes generation.
  * It MUST be different for every your config.
  * Please, seat on your keyboard now and use the result.
  * Don"t forget to do that!
  */
  $random_stuff = "some random string";

  /*
  * Site url
  * Used in static uri generation.
  * Can be used in generation of static servers array.
  * Default: $_SERVER["SERVER_NAME"]
  */
  $pinpie["site url"] = "site.com";

  /*
  * Codepage
  * Define the codepage here and fill free to use in anywhere. See preincludes.php in Examples project.
  */
  $pinpie["codepage"] = "utf-8";

  /*
  * Pages folder
  * Path where all pages files are stored.
  * Default: "ROOT/pages".
  */
  $pinpie["pages folder"] = ROOT . "/pages";

  /*
  * Page not found handler
  * The file in CFG::$pinpie["pages folder"] that will be used when requested page cannot be found.
  */
  $pinpie["page not found"] = "notfound.php";

  /*
  * Route to parent directive
  * When requested URL is parsed, the extention ".php" will be added to path and the corresponding file will be included from CFG::$pinpie["pages folder"].
  * Example: If URL is "/some/requested/path", then CFG::$pinpie["pages folder"]."/some/requested/path.php" will be checked.
  * If no such file exist, then PinPIE will try it as a folder and file CFG::$pinpie["pages folder"]."/some/requested/path/index.php" will be checked.
  * If no such file will be found, then the last part of URL will be cut off, and the process repeats.
  * This directive allow you to control behavior of parser and how many times the cut-and-check process will be repeated.
  * Use some big value to route all requests like "handler/some/very/long/r/e/q/u/e/s/t/" to a "handler.php" file.
  * Default: 1
  * Default 1 means PinPIE will handle "site.com/url" and "site.com/url/" as same page.
  */
  $pinpie["route to parent"] = 99;

  /*
  * Cache rules
  * There are some rules affecting hash generation. You have to read about that, to prevent your cache be bloated and grow too fast.
  */

  /*
  * Cache type
  * This defines what cache class file will be used.
  * There are three cache classes available now:
  * - disabled - a fake cache
  * - filecache - fastest if there is enough RAM caching, using files. The OS will handle all IO itself, caching all in free RAM (yellow bar in htop at Linux). So until you have free RAM, it is the faster way.
  * - memcached - using fast and distributed well-known Memcached caching system. Cache servers have to be defined.
  */
  $pinpie["cache type"] = "memcached";

  /*
  * Cache servers
  * Array of cache servers, used in cache.class.memcache.php file.
  */
  $pinpie["cache servers"] = [
    [
      "host" => "unix:///tmp/memcached.sock",
      "port" => 0
    ],
  ];

  /*
  * Static folder
  * By default when static tags are processed, files will be looked for inside the ROOT folder. You can set here different path, where static content is stored.
  */
  $pinpie["static folder"] = "/app/static";

  /*
  * Function to be used to minify static files
  * By default is FALSE and will not be called.
  * If you want minify your static files like css or js automaticaly, you have to write a function and provide here its name.
  */
  $pinpie["static minify function"] = "autominify";

  /*
  * Minify static filetypes
  * Filetypes (defined by tag) to apply to be minified.
  * Default: ["js", "css"]
  */
  $pinpie["static minify types"] = ["js", "css"];

  /*
  * Level of gzip compression
  * Default: 5.
  */
  $pinpie["static gzip level"] = 5;

  /*
  * Gzip static filetypes
  * Filetypes (defined by tag) to apply gzip compression to.
  * Default: ["js", "css"]
  */
  $pinpie["static gzip types"] = ["js", "css"];

  /*
  * Static servers
  * Array of static serves used to provide static files in more simultaneous threads.
  */
  $static_servers = [
    "s0." . $pinpie["site url"],
    "s1." . $pinpie["site url"],
    "s2." . $pinpie["site url"],
  ];

  /*
  * $databases variable
  * It"s accessible through CFG::$databases, so you can store here database settings and use them anywhere.
  */
  $databases["main"] = [
    "host" => "localhost",
    "dbname" => "database",
    "login" => "login",
    "password" => "password",
    "port" => 3306,
    "socket" => null,
    "codepage" => "utf8"
  ];

  /*
  * Custom settings variable
  * It"s accessible through CFG::$conf. You can store here any config settings you want.
  */
  $conf["any settings"] = "some";

  $pinpie["cache rules"][200]["ignore query params"][] = "XDEBUG_SESSION_START";
', 'php') ?>
  </section>

</article>

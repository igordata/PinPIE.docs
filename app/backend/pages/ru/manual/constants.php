[title[=Constants]]
[sidemenu[ru/manual/sidemenu]]
[menu constants[=
<ul>
  <li><a href="/ru/manual/constants#ds">DS</a></li>
  <li><a href="/ru/manual/constants#root">ROOT</a></li>
  <li><a href="/ru/manual/constants#pindir">PINDIR</a></li>
  <li><a href="/ru/manual/constants#pin_time_start">PIN_TIME_START</a></li>
  <li><a href="/ru/manual/constants#pin_memory_start">PIN_MEMORY_START</a></li>
</ul>
]]
<article>
  <header><h1>Константы</h1></header>
  <p>При старте PinPIE объявляет несколько констант.</p>
  <section>
    <header>
      <h1>
        <a name="ds" href="#ds">#</a>
        DS
      </h1>
    </header>
    <p>
      Это просто краткая версия <?= scx('DIRECTORY_SEPARATOR', 'php') ?>.
      Эта константа задаётся в файле "/pinpie/pinpie.php".
      Вот код:
    </p>
    <?= pcx('define("DS", DIRECTORY_SEPARATOR);', 'php') ?>
  </section>

  <section>
    <header>
      <h1>
        <a name="root" href="#root">#</a>
        ROOT
      </h1>
    </header>
    <p>
      Предполагается, что в этой константе живёт путь к корневой папке всего сайта. От неё строятся дефолтные пути
      вроде "/config". Эта константа задаётся в файле "/pinpie/pinpie.php" и основывается на значении
      <?= scx('$_SERVER["SCRIPT_FILENAME"]', 'php') ?>. Вот код:
    </p>
    <?= pcx('define("ROOT", rtrim(str_replace("&#92;&#92;", "/", dirname($_SERVER["SCRIPT_FILENAME"])), DS));') ?>
  </section>
  <section>
    <header>
      <h1>
        <a name="pindir" href="#pindir">#</a>
        PINDIR
      </h1>
    </header>
    <p>
      В этой константе содержится путь к папке PinPIE, в которой находятся его файлы и всякие другие папки.
      Задаётся в "/pinpie/pinpie.php" и основана на <?= scx('__DIR__', 'php') ?>. Вот код:
    </p>
    <?= pcx('define("PINDIR", rtrim(str_replace("&#92;&#92;", "/", __DIR__), DS));', 'php') ?>
  </section>
  
  <section>
    <header>
      <h1>
        <a name="pin-time-start" href="#pin-time-start">#</a>
        PIN_TIME_START
      </h1>
    </header>
    <p>
      Содержит в себе время старта PinPIE.
      Константа задаётся в "/pinpie/pinpie.php" при его инклуде.
      Код:
    </p>
    <?= pcx('define("PIN_TIME_START", microtime(true));') ?>.
  </section>

  <section>
    <header>
      <h1>
        <a name="pin-memory-start" href="#pin-memory-start">#</a>
        PIN_MEMORY_START
      </h1>
    </header>
    <p>
      Задаётся тут же после PIN_TIME_START.
      Код:
    </p>
    <?= pcx('define("PIN_MEMORY_START", memory_get_peak_usage());') ?>
  </section>
</article>


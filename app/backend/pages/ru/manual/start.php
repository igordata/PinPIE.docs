[title[=Начало работы с PinPIE]]
[sidemenu[ru/manual/sidemenu]]
[menu start[=
<ul>
  <li><a href="#entry-point">Точка входа</a></li>
  <li><a href="#preinclude">preinclude.php</a></li>
</ul>
]]
<article>
  <header>
    <h1>Начни использовать PinPIE</h1>
  </header>
  <section>
    <header>
      <h1>
        <a name="entry-point" href="#entry-point">#</a>
        Точка входа
      </h1>
    </header>
    <p>
      Для запуска PinPIE необходимо инклудить его в главной точке входа вашего проекта,
      а все запросы направить на этот файл.
      Обычно, главная точка входа в код сайта это "/index.php".
      Чтобы PinPIE начал работать, внутри этого файла должна быть такая строчка:
    </p>
    <?= pcx('include "pinpie/pinpie.php";') ?>
    <p>В принципе, это всё, что требуется для того, чтобы начать использовать PinPIE.</p>
    <p>
      Обеспечить направление всех запросов на "/index.php" или другой файл можно в конфиге веб-сервера.
      Примеры конфигов можно найти в разделе документации по
      <a href="/ru/manual/server-configuration">конфигурации сервера</a>.
    </p>
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
    <p>Данный файл подходит для размещения кода автозагрузчика классов.
      Впрочем, для этой задачи подходит и <?= scx("ROOT/index.php") ?>.</p>
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
</article>
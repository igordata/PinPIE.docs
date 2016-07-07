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
      Читайте о том, зачем они нужны и чем они будут вам полезны
      в доке по <a href="http://pinpie.ru/ru/manual/config">конфигу PinPIE</a>.
    </p>
  </section>
</article>
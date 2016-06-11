[sidemenu[ru/manual/sidemenu]]
<article>
  <header>
    <h1>Методы PinPIE</h1>
  </header>

  <section>
    <header>
      <h1>
        <a name="parsestring" href="#parsestring">#</a>
        PinPIE::parseString($string)
      </h1>
    </header>
    <p>Парсит строку и возвращает результат.</p>
    <h2>Пример</h2>
    <?= pcx('echo PinPIE::parseString(\'Ответ [[5$rand]]\');') ?>
    <p>Вывод:</p>
    <?= pcx('Ответ 42', 'html') ?>
  </section>

  <section>
    <header>
      <h1>
        <a name="ds" href="#ds">#</a>
        PinPIE::report()
      </h1>
    </header>
    <p>
      Выводит дебаг-отчет: время выполнения тегов; из кэша или нет; ошибки; и полный список тегов со всеми их внутренними
      данными. Некоторые отчеты выводятся через var_dump(), так что рекомендую Xdebug &mdash; он сделает всё красивым.
      Но не забудьте выключить Xdebug на продакшене, так как он сильно снижает производительность.
    </p>
  </section>

  <section>
    <header>
      <h1>
        <a name="putvar" href="#putvar">#</a>
        PinPIE::putVar($name, $content)
      </h1>
    </header>
    <p>Позволяет запихать строку в плейсхолдер.</p>
    <h2>Пример</h2>
    <p>PHP-код:</p>
    <?= pcx('PinPIE::putVar("pltest", "some text");') ?>
    <p>Плейсхолдер:</p>
    <?= pcx('[[*pltest]]') ?>
    <p>Вывод:</p>
    <?= pcx('some text', 'html') ?>
  </section>

  <section>
    <header>
      <h1>
        <a name="templateget" href="#templateget">#</a>
        PinPIE::templateGet()
      </h1>
    </header>
    <p>Возвращает текущий <a href="/en/manual/templates#page-templates">темплейт страницы</a> или false.</p>
  </section>

  <section>
    <header>
      <h1>
        <a name="templateset" href="#templateset">#</a>
        PinPIE::templateSet($template)
      </h1>
    </header>
    <p>Устанавливает <a href="/en/manual/templates#page-templates">темплейт страницы</a>. Может быть строкой или false.</p>
  </section>

  <section>
    <header>
      <h1>
        <a name="cacheset" href="#cacheset">#</a>
        PinPIE::cacheSet($hash, $data, $time = false)
      </h1>
    </header>
    <p>
      Сохраняет данные $data в кэш по хэшу $hash на время $time. Если время не указывать - будет храниться вечно.
    </p>
  </section>

  <section>
    <header>
      <h1>
        <a name="cacheget" href="#cacheget">#</a>
        PinPIE::cacheGet($hash)
      </h1>
    </header>
    <p>Извлекает данные из кэша по хэшу.</p>
  </section>

  <section>
    <header>
      <h1>
        <a name="injectcacher" href="#injectcacher">#</a>
        PinPIE::injectCacher($cacher)
      </h1>
    </header>
    <p>Позволяет вам использовать <a href="/en/manual/cache#custom-cacher">собственный кэшер</a>, передав его объект.</p>
  </section>

  <section>
    <header>
      <h1>
        <a name="checkpathisinfolder" href="#checkpathisinfolder">#</a>
        PinPIE::checkPathIsInFolder($path, $folder)
      </h1>
    </header>
    <p>
      Позволяет проверить, действительно ли путь принадлежит папке.
      Использует функцию <a href="http://php.net/manual/ru/function.realpath.php">realpath()</a>,
      так что симлинки будут преобразованые в реальные системные пути.
    </p>
  </section>

</article>
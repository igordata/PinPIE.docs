[title[=Constants]]
[sidemenu[en/manual/sidemenu]]
[menu constants[=
<ul>
  <li><a href="/en/manual/constants#ds">DS</a></li>
  <li><a href="/en/manual/constants#root">ROOT</a></li>
  <li><a href="/en/manual/constants#pindir">PINDIR</a></li>
  <li><a href="/en/manual/constants#pin_time_start">PIN_TIME_START</a></li>
  <li><a href="/en/manual/constants#pin_memory_start">PIN_MEMORY_START</a></li>
</ul>
]]
<article>
  <header><h1>Constants</h1></header>
  <p>When PinPIE starts, it defines some constants.</p>
  <section>
    <header>
      <h1>DS</h1>
    </header>
    <p>
      It's just short version of <?= scx('DIRECTORY_SEPARATOR', 'php') ?>.
      Here is the code:
    </p>
    <?= pcx('define("DS", DIRECTORY_SEPARATOR);', 'php') ?>
  </section>

  <section>
    <header>
      <h1>ROOT</h1>
    </header>
    <p>
      This constant is expected to be root folder for site files and subfolders like "/config".
      It is set in "/pinpie/pinpie.php" and based on <?= scx('$_SERVER["SCRIPT_FILENAME"]', 'php') ?> value.
      Here is the code:
    </p>
    <?= pcx('define("ROOT", rtrim(str_replace("&#92;&#92;", "/", dirname($_SERVER["SCRIPT_FILENAME"])), DS));') ?>
  </section>
  <section>
    <header>
      <h1>PINDIR</h1>
    </header>
    <p>
      This constant is expected to be root folder for PinPIE files and its subfolders.
      It is set in "/pinpie/pinpie.php" and based on <?= scx('__DIR__', 'php') ?> constant.
      Here is the code:
    </p>
    <?= pcx('define("PINDIR", rtrim(str_replace("&#92;&#92;", "/", __DIR__), DS));', 'php') ?>
  </section>
  
  <section>
    <header>
      <h1>PIN_TIME_START</h1>
    </header>
    <p>
      This constant is defined just when "/pinpie/pinpie.php" is included.
      Code:
    </p>
    <?= pcx('define("PIN_TIME_START", microtime(true));') ?>.
  </section>

  <section>
    <header>
      <h1>PIN_MEMORY_START</h1>
    </header>
    <p>
      Defined just after PIN_TIME_START.
      Code:
    </p>
    <?= pcx('define("PIN_MEMORY_START", memory_get_peak_usage());') ?>
  </section>
</article>


[sidemenu[en/manual/sidemenu]]
<article>
  <header>
    <h1>PinPIE methods</h1>
  </header>

  <section>
    <header>
      <h1>PinPIE::parseString($string)</h1>
    </header>
    <p>Parses a string and returns parsed and processed output.</p>
    <h2>Example</h2>
    <?= pcx('echo PinPIE::parseString(\'The answer is [[5$rand]]\');') ?>
    <p>Output:</p>
    <?= pcx('The answer is 42', 'html') ?>
  </section>

  <section>
    <header>
      <h1>PinPIE::report()</h1>
    </header>
    <p>
      Shows debug report: tags execution time, from cache or not, errors, and full tags list with all internal data.
      Some output uses var_dump(), so Xdebug is recommended &mdash; it will make everything beautiful. But remember to disable Xdebug
      extension in production, because it has big impact on performance.
    </p>
  </section>

  <section>
    <header>
      <h1>PinPIE::putVar($name, $content)</h1>
    </header>
    <p>Allows you to put some string to a placeholder.</p>
    <h2>Example</h2>
    <p>PHP-code:</p>
    <?= pcx('PinPIE::putVar("pltest", "some text");') ?>
    <p>Placeholder:</p>
    <?= pcx('[[*pltest]]') ?>
    <p>Output:</p>
    <?= pcx('some text', 'html') ?>
  </section>

  <section>
    <header>
      <h1>PinPIE::templateGet()</h1>
    </header>
    <p>Returns current <a href="/en/manual/templates#page-templates">page template</a> or false.</p>
  </section>

  <section>
    <header>
      <h1>PinPIE::templateSet($template)</h1>
    </header>
    <p>Sets <a href="/en/manual/templates#page-templates">page template</a>. Can be string or false.</p>
  </section>

  <section>
    <header>
      <h1>PinPIE::cacheSet($hash, $data, $time = false)</h1>
    </header>
    <p>Stores data in cache.</p>
  </section>

  <section>
    <header>
      <h1>PinPIE::cacheGet($hash)</h1>
    </header>
    <p>Gets stored cache data by hash.</p>
  </section>

  <section>
    <header>
      <h1>PinPIE::injectCacher($cacher)</h1>
    </header>
    <p>Allows you to use <a href="/en/manual/cache#custom-cacher">custom cacher</a> object.</p>
  </section>

  <section>
    <header>
      <h1>PinPIE::checkPathIsInFolder($path, $folder)</h1>
    </header>
    <p>
      Allows you to check, if path really belongs to a folder.
      Uses <a href="http://php.net/manual/en/function.realpath.php">realpath()</a>
      function, so symlinks will be transformed to a system path.
    </p>
  </section>

</article>
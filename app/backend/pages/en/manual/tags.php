[title[=Tags]]
[sidemenu[en/manual/sidemenu]]
[menu tags[=
<ul>
  <li><a href="#chunk">Chunk</a></li>
  <li><a href="#snippet">Snippet</a></li>
  <li><a href="#snippet-caching">Snippet caching</a></li>
  <li><a href="#constant">Constant</a></li>
  <li><a href="#placeholder">Placeholder</a></li>
  <li><a href="#command">Command</a></li>
  <li><a href="#static-tags">Static tags</a></li>
  <li><a href="#tag-templates">Tag templates</a></li>
</ul>
]]
<article>
  <header><h1>Tags</h1></header>
  <p>PinPIE have tag-based parser. Tag syntax is inspired by ModX tag system. All tags are described below.</p>
  <section>
    <header>
      <h1>
        <a name="chunk" href="#chunk">#</a>
        Chunk
      </h1>
      <p>Syntax: <?= scx('[[chunk]]') ?></p>
    </header>
    <p>
      Chunk is plain text located in file in /chunks <a href="/en/manual/config#chunks-folder">folder</a>.
      This code <?= scx('[[some_chunk]]') ?>
      will make PinPIE locate file "/chunks/some_chunk.php" and load its content as plain text.
      It will be parsed by PinPIE engine to find other tags inside, but no php code will be executed.
    </p>
    <p>
      Chunks could be located inside subfolders to keep it all more organised:
      <?= scx('[[some/chunk]]') ?> or <?= scx('[[some/long/path/chunk]]') ?>.
    </p>
    <p>You can see some examples of tags usage in <a href="/en/examples/tags">tag examples</a>.</p>
  </section>

  <section>
    <header>
      <h1>
        <a name="snippet" href="#snippet">#</a>
        Snippet
      </h1>
      <p>Syntax: <?= scx('[[$snippet]]') ?></p>
    </header>
    <p>
      Snippet is php file, that will be included, executed and parsed for other tags.
      Snippet tag starts with <b>$</b> symbol: <?= scx('[[$some_snippet]]') ?>.
    </p>
    <h2>Params</h2>
    <p>
      Snippet allow to transfer GET-like parameters inside its code.
      Just like in URL you can add variables to a snippet name:
    </p>
    <?= pcx('[[$snippet?foo=bar&cat=dog]]') ?>
    <p>
      Inside snippet they will be available in PHP as variables <span><code>$foo</code></span> and <span><code>$cat</code></span>.
      If variables or values are changed, snippet is forced to be parsed again.
      So you don't have to worry about cache while in development.
    </p>
    <p>You can see some examples of tags usage in <a href="/en/examples/tags">tag examples</a>.</p>
  </section>

  <section>
    <header>
      <h1>
        <a name="snippet-caching" href="#snippet-caching">#</a>
        Snippet caching
      </h1>
      <p></p>
    </header>
    <p>
      By default, snippet is executed every time, but you can use caching.
      Set cache expiration time in seconds, or use exclamation mark to cache forever
      (until snippet file or file of its children is changed).
    </p>
    <h2>Usage examples:</h2>
    <ul>
      <li><?= scx('[[$some_snippet]]') ?> &mdash; caching disabled, snippet will be executed every time</li>
      <li><?= scx('[[<b>3600</b>$some_snippet]]') ?> &mdash; snippet is cached for one hour</li>
      <li>
        <?= scx('[[!$some_snippet]]') ?> &mdash; snippet is cached for
        <span><code>PinPIE::$conf->pinpie['cache forever time']</code></span> seconds,
        which by default is <a href="http://php.net/manual/en/reserved.constants.php#constant.php-int-max" target="_blank">PHP_INT_MAX</a>. You can set your own <a href="/en/manual/cfg#cache_forever_time">cache forever time</a>
        option value in <a href="/en/manual/config">config</a>.
      </li>
    </ul>
    <p>For further info please read <a href="/en/manual/cache">cache</a> readme.</p>
    @TODO add examples of caching situations
  </section>

  <section>
    <header>
      <h1>
        <a name="constant" href="#constant">#</a>
        Constant
      </h1>
      <p>Syntax: <?= scx('[[=constant]]') ?></p>
    </header>
    <p>
      Constant is just a line of text, that will go to output. It have no use without using variable placeholder.
      Because all pages are stored in files, constant is convenient way to put some small text from a page file to the template.
      Please see variable placeholder section below.
    </p>
    <p>Constant tag starts with equals symbol. Here is a constant example: <?= scx('[[=simple constant text]]') ?> </p>
    <p>Constant text can be multiline:</p>
    <?= pcx('[[=some
multiline
text]]') ?>
    <p>You can see some examples of tags usage in <a href="/en/examples/tags">tag examples</a>.</p>
  </section>

  <section>
    <header>
      <h1>
        <a name="placeholder" href="#placeholder">#</a>
        Placeholder
      </h1>
      <p>Syntax: <?= scx('[[*placeholder]]', 'html') ?></p>
    </header>
    <p>
      Every chunk, snippet or constant output can be put to the variable. This variable can be used in the page, in tags,
      or certainly in the template. Placeholder tag starts with asterisk.
      Here is syntax example: <?= scx('[[*placeholder]]', 'html') ?>
    </p>
    <p>
      Placeholder contents could be used in external template engine by applying your custom function. This data is passed
      to function as an array. See external template section.
    </p>
    <p>
      Placeholder contents are cached within its parents cache, so you don't have to worry
      when placeholder contents are set inside cached snippet, but used somewhere outside of that snippet.
      They will be cached and used outside this tags. See cache section.
    </p>
    <p>Placeholder tags are removed from output. But if debug is enabled &mdash; they remain.</p>
    <p>There is reserved placeholder <?= scx('[[*content]]') ?> for page or tag output in template.</p>
    <h2>Examples</h2>
    <h3>Example 1</h3>
    <p>
      To put a page title to a template inside &lt;title&gt; tag, you can put the page title into the placeholder
      using constant <?= scx('[var[=About]]') ?> in your page, and placeholder tag <?= scx(h('<title>[[*var]]</title>')) ?>
      in your template.
    </p>
    <h3>Example 2</h3>
    <p>
      You can use placeholder even before it is set, because placeholders are replaced with variable content after page or tag have been processed.
    </p>

    <p>This example</p>
    <?= pcx(h('<span>[[*var]]</span>
[var[=pinpie]]')) ?>
    <p>or this</p>
    <?= pcx(h('[var[=pinpie]]
<span>[[*var]]</span>')) ?>
    <p>will provide you same HTML code:</p>
    <?= pcx(h('<span>pinpie</span>')) ?>

    <h3>Example 3</h3>
    <p>You can use placeholders with snippets or chunks.</p>
    <?= pcx(h('[var[some_chunk]]
<span>[[*var]]</span>'), 'html') ?>

    <p>having /chunks/some_chunk.php file with code</p>
    <?= pcx("pinpie") ?>
    <p>or</p>
    <?= pcx(h('[var[$some_snippet]]
<span>[[*var]]</span>'), 'html') ?>
    <p>having /snippets/some_snippet.php file with code</p>
    <?= pcx(h('<?php echo "pinpie"; ?>')) ?>
    <p>or just</p>
    <?= pcx('pinpie') ?>
    <p>will provide you the same HTML code:</p>
    <?= pcx(h('<span>pinpie</span>')) ?>
    <p>You can see some examples of tags usage in <a href="/en/examples/tags">tag examples</a>.</p>
  </section>

  <section>
    <header>
      <h1>
        <a name="command" href="#command">#</a>
        Command
      </h1>
      <p>Syntax: <?= scx('[[@template=main]]') ?> or <?= scx('[[#template=main]]', 'html') ?></p>
    </header>
    <p>
      To provide control over some PinPIE engine functions inside page or tag file, use commands.
      Command tag starts with <b>@</b> to suppress command output, or with <b>#</b> to show the return value.
      Currently only one command is supported, and it's better to use it like this: <?= scx('[[@template=wide]]') ?>.
    </p>
  </section>

  <section>
    <header>
      <h1>
        <a name="static-tags" href="#static-tags">#</a>
        Static tags
      </h1>
      <p>Syntax: <?= scx('[[%type=path]]') ?> </p>
    </header>

    <p>
      Static tags are used to provide automatic using of static files features, such as <b>minification</b>, <b>gzipping</b>,
      and <b>server sharding</b> support. Static tag starts with <b>%</b> symbol and static content type,
      which is not the file extension or type.
    </p>
    <p>
      Currently three types of static content are supported:
    <ul>
      <li>js &mdash; for javascript files</li>
      <li>css &mdash; for cascading style sheets</li>
      <li>img &mdash; for any images</li>
    </ul>
    </p>
    <p>
      This tags are replaced with corresponding HTML tags, where URL is leading to some static server
      (if sharding is enabled) from a list,
      and have GET-parameter <?= scx('time') ?> with salted hash of the name and the modification time of a file.
      This provides <b>automatic browser cache refreshing</b>. That means, you don't have to hit
      Ctrl+F5 while developing your site, and all users will get fresh content in time.
    </p>
    <p>
      For more detailed information about static tags, pre-minification and gzip pre-compression,
      please see <a href="/en/manual/static">static readme</a>.
    </p>
    <h2>Example</h2>

    <p>This code</p>
    <?= pcx('[[%js=/javascript/jquery.js]]', 'html') ?>
    <p>by default will create a html tag</p>
    <?= pcx(h('<script type="text/javascript" src="/javascript/jquery.js?time=hash"></script>'), 'html') ?>
    <p>
      Static files could be located outside the site root folder. Set <?= scx('PinPIE::$conf->pinpie["static folder"]') ?>
      to path to your static files folder. Default value is <?= scx('ROOT') ?> (see <a href="/en/manual/constants#root">constants</a>).
    </p>
    <p>
      For more detailed information about static tags, pre-minification and gzip pre-compression,
      please see <a href="/en/manual/static">static readme</a>.
    </p>
  </section>

  <section>
    <header>
      <h1>
        <a name="tag-temlates" href="#tag-temlates">#</a>
        Tag templates
      </h1>
    </header>
    <p>
      Template can be applied to any tag except variable placeholder.
      This is not templates like <a href="http://twig.sensiolabs.org/">twig</a> or <a href="http://mustache.github.io/">mustache</a>.
      It's a kind of simple wrappers for tag output. Template code is always executed, in contrast to tag content, that could be loaded from cache.
    </p>
    <p>
      Please read more in <a href="/en/manual/templates#tag-templates">templates</a> readme.
      You can see some examples of tags templates usage in <a href="/en/examples/templates">templates examples</a>.
    </p>
    <h3>Example</h3>
    <p>To wrap snippet output to a div you need create template named e.g. "wrap" with code:</p>
    <?= pcx(h('<div>[[*content]]</div>')) ?>
    <p>And now you can apply this template to a snippet like this:</p>
    <?= scx('[[$snippet]wrap]') ?>
    <p>Assuming snippet have this code:</p>
    <?= pcx(h('<?php echo rand(1, 100); ?>'), 'php') ?>
    <p>So we will get this output:</p>
    <?= pcx(h('<div>42</div>'), 'html') ?>
  </section>
</article>
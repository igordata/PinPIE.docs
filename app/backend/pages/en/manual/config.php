[title[=Configuration]]
[sidemenu[en/manual/sidemenu]]
[menu config[=
<ul>
  <li><a href="#config-files">Config files</a></li>
  <li><a href="#config-variables">Config variables</a></li>
  <li><a href="#simplest-config">Simplest config</a></li>
  <li><a href="#default-pinpie-settings">Defaults</a></li>
  <li><a href="#cache">Cache</a></li>
  <li><a href="#code-page">Code page</a></li>
  <li><a href="#static">Static</a></li>
  <li><a href="#log">Log</a></li>
  <li><a href="#page-not-found">Page not found</a></li>
  <li><a href="#pages-folder">Pages folder</a></li>
  <li><a href="#route-to-parent">Route to parent</a></li>
  <li><a href="#site-url">Site URL</a></li>
  <li><a href="#template-function">Template function</a></li>
  <li><a href="#other-variables">Other variables</a></li>
  <li><a href="#config-example">Config expample</a></li>
</ul>
]]

<article>
  <header><h1>Configuration</h1></header>
  <p>
    All config files are located in <?= scx('/config') ?> folder.
    For every request config is chosen automatically, based on sever name.
    Yes, just <?= scx('basename($_SERVER["SERVER_NAME"]) . ".php"') ?>.
    So you can store multiple configurations in one folder.
  </p>
  <section>
    <header>
      <h1>Config files</h1>
    </header>
    <p>
      To create configuration file you have to create file inside <?= scx('/config') ?> folder with the name of
      your server and ".php" extension. Except <?= scx('$random_stuff') ?> there is no obligatory settings
      to start working with PinPIE.
    </p>
  </section>
  <section>
    <header>
      <h1>Config variables</h1>
    </header>
    <p>In config file you can set this variables:</p>
    <ul>
      <li><?= scx('$random_stuff') ?> &mdash; string, used as salt. Have to be full of really random symbols.</li>
      <li><?= scx('$pinpie') ?> &mdash; array to store PinPIE settings.</li>
      <li>
        <?= scx('$conf') ?> &mdash; array for your custom settings, you can store here any settings you need,
        and access it by <?= scx('PinPIE::$conf->conf', 'php') ?> anywhere.
      </li>
      <li><?= scx('$databases') ?> &mdash; store here settings to connect to your databases.</li>
      <li><?= scx('$static_servers') ?> &mdash; array of static servers (see <a href="/en/manual/static">static readme</a>).</li>
      <li><?= scx('$debug') ?> &mdash; enables debug output</li>
    </ul>
    <p>They will be accessible globally through static class CFG.</p>
  </section>
  <section>
    <header>
      <h1>Simplest config</h1>
    </header>
    <?= pcx('/* nothing here */') ?>
    <p>Yes, it's empty.</p>
    <p>Only things you have to do are:</p>
    <ul>
      <li>put empty php-file with your server's name like site.com.php to a /config folder</li>
      <li>route all requests to index.php</li>
    </ul>
    <p>
      And PinPIE will do the job just out of the box.
      But remember, it's very important to set <?= scx('$random_stuff') ?> to some random string.
      So, good simple config have to be like this:
    </p>
    <code class="php">
      <pre>$random_stuff = "[[$random_stuff]]";</pre>
    </code>
  </section>

  <section>
    <header>
      <h1>Default PinPIE settings</h1>
    </header>
    <p>There are not so many settings PinPIE need to work. Here are the defaults from <?= scx('/pinpie/classes/cfg.php') ?>:</p>
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
      <h1>Cache</h1>
    </header>
    <p>Caching could be controlled with this parameters:</p>
    <ul>
      <li>cache type &mdash; cache provider, can be "files", "memcached" or "disabled". Custom class can be used. Default value is "files".</li>
      <li>cache hash algo &mdash; algorithm to use for generation of cache hashes. By default is used "sha1".</li>
      <li>cache rules &mdash; used to fight enormous cache growing in cases of big amount of unique requests</li>
      <li>cache forever time &mdash; defines how long an eternity is (in seconds)</li>
    </ul>

    <p>It's highly recommended to read more about caching mechanics in <a href="/en/manual/cache">cache readme</a>.</p>
  </section>

  <section>
    <header>
      <h1>Code page</h1>
    </header>
    <p>
      PinPIE recommend you to store the code page of your project in <?= scx('$pinpie["codepage"]') ?> for you could
      easily access and use it in your scripts. Default value is "utf-8".
    </p>
  </section>
  <section>
    <header>
      <h1>Static</h1>
    </header>
    <h2>Static folder</h2>
    <p>Used to process static tags. Default value is <?= scx('ROOT') ?>. </p>
    <p>
      In most cases static files like js, css or images are located in the same folder as php-scripts do.
      But you can keep separately all static content.
      Set <?= pcx('$pinpie["static folder"]') ?> in config to your static files location and use convenient static tags in your project.
    </p>
    <h2>Gzip</h2>
    <p>
      Gzip pre-compression allow to lower size of some static files.
      This pack of settings allow you to control automatic pre-compression of static files:
    </p>
    <ul>
      <li>static gzip level &mdash; level of compression, by default it is 5.</li>
      <li>
        static gzip file types &mdash; array to store static files tags types of files which have to be compressed.
        By default is array <?= scx('["js", "css"]') ?>.
      </li>
    </ul>
    <h2>Minification</h2>
    <p>Minification can be made automatically by PinPIE. With this settings you can set up the process:</p>
    <ul>
      <li>static minify filetypes &mdash; list of static files tags types to minify files. Default is array <?= scx('["js", "css"]') ?>.</li>
      <li>
        static minify files function &mdash; function to call when file have to be minified.
        In that function you have to call your minifier. Value is <?= scx('false') ?> by default
      </li>
    </ul>
    <p>It's highly recommended to read more about static files tags in <a href="/en/manual/static">static readme</a>.</p>
  </section>
  <section>
    <header>
      <h1>Log</h1>
    </header>
    <p>
      PinPIE will log some errors like nonexistent tag file to "pin.log" file by default.
      You can set the other path in <?= scx('$pinpie["log"]["path"]') ?>.
      Also you can enable output of error log straight to your page, which is disabled by default.
    </p>
  </section>
  <section>
    <header>
      <h1>Page not found</h1>
    </header>
    <p>
      Set the page to handle all 404 not found requests.
      By default it is "/pages/index.php", but it is recommended to use special page and create something like "/pages/notfound.php".
      Anyway, if requested page is not found, header code 404 will be applied automatically.
    </p>
  </section>

  <section>
    <header>
      <h1>Pages folder</h1>
    </header>
    <p>
      Default location to store pages. Default value is <?= scx('ROOT . "/pages"', 'php') ?>.
      Can be changed on the fly in "preinclude.php" and before.
    </p>
  </section>

  <section>
    <header>
      <h1>Route to parent</h1>
    </header>
    <p>
      This variable is used in URL handling mechanics.
      Read more in <a href="/en/manual/routing">routing readme</a>.
    </p>
  </section>

  <section>
    <header>
      <h1>Site URL</h1>
    </header>
    <p>
      This variable is used in automatic URL creation for static files tags in case if list of static servers is empty.
      You don't have to change or set it in config, but if you want - you can.
    </p>
  </section>

  <section>
    <header>
      <h1>Template function</h1>
    </header>
    <p>
      This function will be called when template have to be applied.
      Read more in <a href="/en/manual/templates#custom-template-function">templates readme</a>.
    </p>
  </section>

  <section>
    <header>
      <h1>Other variables</h1>
    </header>
    <h2>Custom configuration</h2>
    <p>
      You can store any other non-PinPIE settings in <?= scx('$conf') ?> array, if you want. It will be available globally
      in <?= scx('PinPIE::$conf->conf', 'php') ?>.
    </p>
    <h2>Databases array</h2>
    <p>
      Array <?= scx('$databases') ?> created specially to store database settings.
      You can use it to provide settings to your database classes.
    </p>
    <h2>Static servers</h2>
    <p>
      List of static content settings can be set in <?= scx('$static_servers') ?> variable.
      Please, read more in <a href="/en/manual/static#servers-sharding">static readme</a>.
    </p>
    <h2>Salt</h2>
    <p>
      For security reason you have to set <?= scx('$random_stuff') ?> variable to random string, unique to every your site.
      This variable is used in <a href="/en/manual/cache#hash">cache hash</a> generation, and can be used anywhere in your
      code via <?= scx('PinPIE::$conf->random_stuff') ?>. Just remember, that it was not created for a cryptographic use, because
      to be a real salt it have to be different every time. Also, some cryptographic functions can't use such long strings
      in their algo.
    </p>

  </section>
  <section>
    <header>
      <h1>Config example</h1>
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
  * The file in PinPIE::$conf->pinpie["pages folder"] that will be used when requested page cannot be found.
  */
  $pinpie["page not found"] = "notfound.php";

  /*
  * Route to parent directive
  * When requested URL is parsed, the extention ".php" will be added to path and the corresponding file will be included from PinPIE::$conf->pinpie["pages folder"].
  * Example: If URL is "/some/requested/path", then PinPIE::$conf->pinpie["pages folder"]."/some/requested/path.php" will be checked.
  * If no such file exist, then PinPIE will try it as a folder and file PinPIE::$conf->pinpie["pages folder"]."/some/requested/path/index.php" will be checked.
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
  * It"s accessible through PinPIE::$conf->databases, so you can store here database settings and use them anywhere.
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
  * It"s accessible through PinPIE::$conf->conf. You can store here any config settings you want.
  */
  $conf["any settings"] = "some";

  $pinpie["cache rules"][200]["ignore query params"][] = "XDEBUG_SESSION_START";
', 'php') ?>
  </section>

</article>

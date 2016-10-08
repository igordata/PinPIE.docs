[title[=Cache]]
[sidemenu[en/manual/sidemenu]]
[menu cache[=
<ul>
  <li><a href="/en/manual/cache#simple">Simple</a></li>
  <li><a href="/en/manual/cache#usage">Usage</a></li>
  <li><a href="/en/manual/cache#separate-caching">Separate caching</a></li>
  <li><a href="/en/manual/cache#hash">Hash</a></li>
  <li><a href="/en/manual/cache#cache-storage">Cache storage</a></li>
  <li><a href="/en/manual/cache#disabled-cacher">Disabled cacher</a></li>
  <li><a href="/en/manual/cache#files-cacher">Files cacher</a></li>
  <li><a href="/en/manual/cache#memcached-cacher">Memcached cacher</a></li>
  <li><a href="/en/manual/cache#custom-cacher">Custom cacher</a></li>
  <li><a href="/en/manual/cache#cache-rules">Cache rules</a></li>
</ul>
]]



<article>
  <header><h1>Cache</h1></header>
  <p>
    PinPIE provide clear and controllable automatic snippet caching.</p>
  <p>
    In the same time, chunks are never cached. Chunks are just pieces of text.
    Chunks are stored in "*.php" files, and are mostly cached by acceleration software like APC, XCache, eAccelerator, etc.
    Since version 5.5.0 Zend opcode cacher is bundled with PHP.
    That's why chunks are not additionally cached. If you want to cache - use snippet.
  </p>
  <p>
    Pages code is executed every time. If you want to cache some heavy code &mdash; use a snippet.
    If you don't need a php-code executed every time &mdash; use a
    <a href="//google.com/search?q=static+site+generator" target="_blank" tltle="Google">static site generator</a>.
  </p>
  <p>
    Each cache entry includes all file paths of used tags and their children.
    It means all that files will be checked for existence and modification time.
    If any of them is changed after cache was created, then snippet will be redrawn, and cache will be refreshed.
  </p>

  <section>
    <header>
      <h1>Simple</h1>
    </header>
    <p>
      Simplicity is the main idea of PinPIE.
      That's why caching in PinPIE is obvious and predictable.
      In the same time it's convenient.
      To understand how does the cache works you need to know this simple things:
    </p>
    <ul>
      <li>If snippet is cached &mdash; it is cached as it was drawn.</li>
      <li>If snippet file is modified &mdash; it will be redrawn.</li>
      <li>If snippet has some children tags &mdash; they will be rendered only once and cached in the output of that snippet.</li>
      <li>If snippet has children (any depth) and one of their files was modified &mdash; snippet will be redrawn.</li>
    </ul>
    <p>
      That means you don't have to get deal with cache every time you change a bit something somewhere.
      <b>PinPIE will detect changes, redraw and recache by it self automatically.</b>
    </p>
    <p>
      If you want to purge the cache &mdash; just delete all files from "/filecache" folder or restart Memcached.
    </p>
  </section>

  <section>
    <header><h1>Usage</h1></header>
    <p>To cache snippet you need to set desired time in seconds in the tag: <?= scx('[[<b>here</b>$snippet]]') ?>.</p>
    <p>Currently there are three options:</p>
    <ul>
      <li><?= scx('[[$some_snippet]]') ?> &mdash; caching disabled, snippet will be executed every time</li>
      <li><?= scx('[[<b>3600</b>$some_snippet]]') ?> &mdash; snippet is cached for one hour</li>
      <li>
        <?= scx('[[!$some_snippet]]') ?> &mdash; cache forever. Snippet is cached for
        <span><code>PinPIE::$conf->pinpie['cache forever time']</code></span> seconds,
        which by default is <a href="http://php.net/manual/en/reserved.constants.php#constant.php-int-max" target="_blank">PHP_INT_MAX</a>. For 32-bit systems it's about 68 years, for 64-bit it's much much longer.
        You can set your own <a href="/en/manual/cfg#cache_forever_time" title="Read more">cache forever time</a>
        option value in <a href="/en/manual/config" title="Read config manual">config</a>.
      </li>
    </ul>
  </section>

  <section>
    <header>
      <h1>Separate caching</h1>
    </header>
    <p>
      All snippets are cached separately one from each other, even same snippets.
      Just look at this examples.
    </p>
    <h2>Examples</h2>
    <h3>Example 1</h3>
    <p>Assuming you have snippet <?= scx('[[$rand]]') ?> with code:</p>
    <?= pcx(h('<?php
echo rand(1, 100);')); ?>
    <p>
      If you will use it many times in a page, you will get different numbers for each use.
      If you will cache this snippet, you will also get different cashed numbers.
      So if you use it several times in the code of the same single page:
    </p>
    <?= pcx('[[5$rand]]
[[5$rand]]
[[5$rand]]'); ?>
    <p>you'll get output, that will change every five seconds:</p>
    <pre><code>[[5$rand]]<br>[[5$rand]]<br>[[5$rand]]</code></pre>

    <p>
      This examples are not just text, but active snippets, so <b>refresh this page now</b> to see changes.
      Actually, with probability 1 / 1000000 it will do "42 42 42"
      (and it happened to me once, forcing me to desperately debug this <i>bug</i>), so be not surprised.
    </p>
    <h3>Example 2</h3>
    <p>This example will make you better understand caching.</p>
    <?= pcx('[[$rand]]
[[5$rand]]
[[!$rand]]') ?>
    <p>
      When you will refresh a page, you will see,
      that first number will change every time, next - every five seconds, and the last one will never change.
    </p>
    <pre><code>[[$rand]]<br>[[5$rand]]<br>[[!$rand]]</code></pre>
  </section>

  <section>
    <header>
      <h1>Hash</h1>
    </header>
    <p> Every cache entry is stored with hash based on snippet and page parameters. That includes:</p>
    <ul>
      <li>snippet name</li>
      <li>snippet file modification date and time</li>
      <li>requested URL</li>
      <li>URL query params (if <a href="/en/manual/cache#cache-rules" title="See below on this page">possible</a>)</li>
      <li>all parent tags names</li>
      <li>server name</li>
      <li>salt <?= scx('PinPIE::$conf->random_stuff') ?></li>
      <li>some other params</li>
    </ul>
    <p>
      If any of this parameters changes, that will produce different hash.
      PinPIE will not find the snippet in the cache and will have to execute it again.
      It means if snippet file was modified, it will be recached.
    </p>

    <p>
      Algorithm used to produce hash can be set in config in
      <?= scx('PinPIE::$conf->pinpie["cache hash algo"]', 'php') ?>. By default it is "sha1".
      List of available algos can be found with <a href="http://php.net/manual/en/function.hash-algos.php">hash_algos()</a>
      function.
    </p>
  </section>

  <section>
    <header>
      <h1>Cache storage</h1>
    </header>
    <p>There are currently three cache storage options:</p>
    <ul>
      <li>disabled &mdash; every snippet is forced to be executed each time</li>
      <li>files &mdash; file-based storage (default)</li>
      <li>memcached &mdash; memcached-based storage</li>
    </ul>
    <p>
      Cache storage can be set in config by <?= scx('PinPIE::$conf->pinpie["cache type"]') ?>.
      This variable defines whitch cache class will be used.
      Default value is "filecache".
    </p>
  </section>

  <section>
    <header>
      <h1>Disabled cacher</h1>
    </header>
    <p>This is the simplest cacher class:</p>
    <?= pcx('namespace PinPIE;

class CacherDisabled implements Cacher {

  public function get($hash) {
    return false;
  }

  public function set($hash, $content, $time) {
    return true;
  }

}', 'php') ?>
    <p>
      This class contains two fake methods, that make PinPIE to think, that any cache writing completes successfully,
      and any reading fails. So any time PinPIE want to get cached data, it receives "false".
      This forces it to execute snippet anyway .
    </p>
  </section>

  <section>
    <header>
      <h1>Files cacher</h1>
    </header>
    <p>
      Files cacher uses this folder to store cache in files named by its hash.</p>
    <?= scx('PinPIE::$conf->pinpie["working folder"] . DS . "filecache" . DS') ?>
    <p>By default it's:</p>
    <?= pcx('ROOT/filecache') ?>
    <p>
      It is the simple, but very fast way to cache snippets. Until your OS have <b>free</b> unused memory, you will have
      very fast caching, even faster than memcached. The disadvantage is that you have to clean
      cache by your own, because PinPIE can't.
    </p>
    <p>
      Every time PinPIE generates new hash for tag, it will create new file. That is not a problem, because for most of the time the size of cache will be stable, and will grow only by newly added or edited snippets. Because hash is based on file modification time, PinPIE can't find previous versions of cache files, and can't
      automatically delete them.</p>
    <p>The advantages of this mode are:</p>
    <ul>
      <li>Very fast.</li>
      <li>Works everywhere. Only requirement is permission to write to "filecache" folder.</li>
    </ul>
    <p>
      This type of cache is fast, because modern OS stores recent files content in free unused memory.
      All file access operations are highly optimized. So file cache performance could be faster even than Memcached
      at unix socket.
    </p>
  </section>

  <section>
    <header>
      <h1>Memcached cacher</h1>
    </header>
    <p>
      Memcached-based caching class uses Memcache object to store cache. Sure it have multiple servers support.
      Server pool is set in config var <?= scx('PinPIE::$conf->pinpie["cache servers"]') ?> as array of host and port pairs.
      Here is the code:
    </p>
    <?= pcx('$pinpie["cache servers"] = [
  ["host" => "localhost", "port" => 11211],
]', 'php') ?>
    <p>You can use this array to store configuration for your own custom cacher as well.</p>
    <p>
      Make sure you have set unique salt for every site in <?= scx('PinPIE::$conf->random_stuff') ?> variable.
      That will prevent possible hash collisions for different snippets.
    </p>
  </section>

  <section>
    <header>
      <h1>Custom cacher</h1>
    </header>
    <p>
      PinPIE allow you to simply inject your own custom cacher class. You have to <b>implement from \PinPIE\Cacher</b>, which is
      stored in "/pinpie/classes/cacher.php" file and automatically included at startup.
    </p>
    <p>Cacher interface consist of two methods:</p>
    <?= pcx('namespace PinPIE;

interface Cacher {
  public function get($hash);

  public function set($hash, $content, $time);
}', 'php') ?>
    <p>To inject cacher call</p>
    <?= pcx('PinPIE::injectCacher($cacher);') ?>
    <p>where <b>$cacher</b> is your object implemented from <b>\PinPIE\Cacher</b> interface.</p>
    <p>
      You don't have to, but it's better to set <?= scx('PinPIE::$conf->pinpie["cache type"]') ?> to "custom" or "disabled" in config, because
      "files" cacher will be loaded by default, even if it will not be used.
    </p>
    <p>
      If cache type is set to "custom", but $cacher is empty, than "disabled" cacher will be used.
      Anyway, PinPIE does not require you to set cacher at startup.
      You can set your cacher any time later, but don't wait too long.
    </p>
    <p>
      Note: PinPIE provides raw binary hash() output, so maybe you'll have use
      <a href="http://php.net/manual/en/function.bin2hex.php" target="_blank">bin2hex()</a> function.
    </p>

  </section>

  <section>
    <header>
      <h1>Cache rules</h1>
    </header>
    <p>
      PinPIE provides you additional control of caching process absolutely free. All 404 pages have different URL, and that could produce too much
      unwanted cache, mostly never used again. Or there could be some GET-params that doesn't affect a page, so you don't
      need to use them in hash generation, because that will also produce additional cache. To prevent all this mess cache rules
      were implemented, allowing you to control that stuff.
    </p>
    <p>
      PinPIE allow you to ignore url or GET-params, and set the cache hash generation rules.
      Caching rules could be set in config file by <?= scx('PinPIE::$conf->pinpie["cache rules"]') ?>. Here are the default rules:
    </p>
    <?= pcx('"cache rules" => [
  "default" => ["ignore url" => false, "ignore query params" => false],
  200 => ["ignore url" => false, "ignore query params" => false],
  404 => ["ignore url" => true, "ignore query params" => true]
],', 'php') ?>
    <p>
      Caching rules are applied according current HTTP response code. For all general pages it is 200.
      For not found pages it will be 404. For all others will the "default" rule will be applied.
    </p>
    <p>For 404 case whole url and query params are ignored to prevent separate caching for all wrong and unknown pages.</p>
    <p>You can set your own rules for any other HTTP-codes.</p>
    <h2>Params</h2>
    <h3>ignore url</h3>
    <p>
      This parameter allow you to ignore whole url in hash generation, that will make all pages with this rule have same
      cached output, if query params are the same.
    </p>
    <p> It could be set to false or true.</p>
    <h3>ignore query params</h3>
    <p>
      Ignore query params allow you to ignore all or some GET-params when cache hash is generated.
      It could be set to false, true, or array of $_GET keys to ignore. Useful, if you have user tracking get-params in links
      from external sites to yours.
    </p>
    <?= pcx('$pinpie["cache rules"][200] = [
  "ignore query params" => ["XDEBUG_SESSION_START", "_openstat", "yclid"],
];') ?>
  </section>
</article>
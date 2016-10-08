[sidemenu[en/manual/sidemenu]]
<article>
  <header>
    <h1>Routing</h1>
  </header>
  <section>
    <p>URL processing is quite simple:</p>
    <ul>
      <li>If requested URL is <span><code>/about</code></span>, then PinPIE will try to include <span><code>/pages/about.php</span></code> file</li>
      <li>If it doesn't exist, path <span><code>/pages/about/index.php</span></code> will be checked</li>
    </ul>
    <p>
      If none of this was found, then <?= scx('PinPIE::$conf->pinpie["page not found"]') ?> will be included,
      and HTTP response code will be set to 404.
    </p>
    <p>
      Default value of <?= scx('PinPIE::$conf->pinpie["page not found"]') ?> is <span><code class="html">index.php</span></code>,
      and <b>it's strongly recommended to create a special page</b> to handle "not found" requests.
      The "not found" page will be shown at requested URL.
    </p>

  </section>
  <section>
    <header><h1>Route to parent</h1></header>
    <p>
      If option <?= scx('PinPIE::$conf->pinpie["route to parent"]') ?> is defined in config and is greater than zero,
      then PinPIE will try to find some file, according to requested path.
    </p>
    <p>
      That means if for URL <span><code>/very/long/url</span></code> there will be not found both <span><code>/pages/very/long/url.php</span></code>
      and <span><code>/pages/very/long/url/index.php</span></code>, then searching path will be shortened
      for one step to check <span><code>/pages/very/long.php</span></code> and <span><code>/pages/very/long/index.php</span></code>.
    </p>
    <p>
      This operation will be repeated for maximum <?= scx('PinPIE::$conf->pinpie["route to parent"]') ?> times,
      and if no existing file will be found &mdash; the requested URL will be considered as "not found".
    </p>
    <p>
      If the first part of request URL "/very" is not found, request will <b>not</b> be routed to <span><code>/pages/index.php</span></code>.
      It will be also considered as "not found".
    </p>
    <p>Possible values:</p>
    <ul>
      <li>0 &mdash; url will not be routed anywhere</li>
      <li>1 &mdash; urls like "site.com/url" and "site.com/url/" will be handled as the same (<a href="/en/manual/config#default-pinpie-settings">default</a>)</li>
      <li>&gt; 1 &mdash; routed up</li>
    </ul>
    <p>
      This mechanics allow you to handle requests like <span><code>/news/42</span></code> or <span><code>/news/42/edit</span></code> in one file
      located at <span><code>/pages/news.php</span></code> or <span><code>/pages/news/index.php</span></code>.
    </p>
    <p>But I prefer to have:</p>
    <ul>
      <li><span><code>/pages/news/index.php</span></code> for news listing at url <span><code>/news/</span></code></li>
      <li>the same <span><code>/pages/news/index.php</span></code> as news entry page at url <span><code>/news/42</span></code> if entry id were provided</li>
      <li><span><code>/pages/news/edit.php</span></code> to edit one at url <span><code>/news/42/edit</span></code></li>
    </ul>
    <p>Your code will remain clean, if you will use <a href="/en/manual/tags#snippet">snippets</a>.</p>
  </section>
</article>
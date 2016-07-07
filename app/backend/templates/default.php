<!DOCTYPE html>
<html>
<head>
  <link rel="apple-touch-icon" sizes="57x57" href="//s0.pinpie.ru/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="//s0.pinpie.ru/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="//s0.pinpie.ru/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="//s0.pinpie.ru/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="//s0.pinpie.ru/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="//s0.pinpie.ru/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="//s0.pinpie.ru/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="//s0.pinpie.ru/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="//s0.pinpie.ru/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="//s0.pinpie.ru/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="//s0.pinpie.ru/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="//s0.pinpie.ru/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="//s0.pinpie.ru/favicon/favicon-16x16.png">
  <link rel="manifest" href="//s0.pinpie.ru/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="//s0.pinpie.ru/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- temporarily link is hidden, author of this icon is https://github.com/paomedia/small-n-flat -->

  <meta name=viewport content="width=device-width, initial-scale=1">
  [head[%css=/css/css.css]]
  [[%css=/libs/highlight/styles/github.css]]
  [bottom[%js=/libs/highlight/highlight.pack.js]]
  [[*head]]
  <title>PinPIE - [[*title]]</title>
</head>
<body>
<div id="content-wrapper">
  <header id="site-header">
    <h1><a href="//pinpie.ru/">PinPIE - when PHP Is Enough</a></h1>
  </header>
  <nav id="menu" role="navigation">[[*sidemenu]]
  </nav>
  <main id="content">
    [[*content]]
  </main>
  <div class="clear"></div>
  <footer></footer>
</div>
[[$stats/yandex]]
[[*bottom]]
<script>
  function hllinks() {
    var links = document.querySelectorAll('#menu a');
    for (var i = links.length; i--;) {
      links[i].classList.remove('active');
      if (links[i].href === window.location.href) {
        links[i].classList.add('active');
      }
    }
  }

  document.addEventListener("DOMContentLoaded", function () {
    hllinks();
    var codeblocks = document.querySelectorAll('code');
    for (var i = codeblocks.length; i--;) {
      hljs.highlightBlock(codeblocks[i]);
    }
  });

  window.addEventListener("hashchange", function () {
    hllinks();
  });
</script>
</body>
</html>

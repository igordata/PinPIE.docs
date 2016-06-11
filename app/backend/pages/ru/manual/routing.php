[sidemenu[ru/manual/sidemenu]]
<article>
  <header>
    <h1>Роутинг</h1>
  </header>

  <section>
    <p>Обработка URL подчиняется простым правилам:</p>
    <ul>
      <li>
        Если был запрошен <span><code>/about</code></span>, то PinPIE попробует заинклудить файл
        <span><code>/pages/about.php</span></code>
      </li>
      <li>Если такого нет, то проверяется путь <span><code>/pages/about/index.php</span></code>.</li>
    </ul>
    <p>
      Если ничего не было найдено, то заинклудится <?= scx('CFG::$pinpie["page not found"]') ?>, и будет автоматически
      установлен 404 код ответа HTTP.
    </p>
    <p>
      По умолчанию значение <?= scx('CFG::$pinpie["page not found"]') ?> это <span><code class="html">index.php</span></code>.
      Но крайне <b>настоятельно рекомендую создат специальную страницу</b> для обработки "не найденых" страниц.
      Она будет отображаться в ответ на эти запросы.
    </p>
  </section>

  <section>
    <header>
      <h1>
        <a name="route-to-parent" href="#route-to-parent">#</a>
        Route to parent
      </h1>
    </header>
    <p>
      Если в конфиге установлено значение <?= scx('CFG::$pinpie["route to parent"]') ?> и оно  больше нуля,
      то PinPIE будет пробовать найти другие файлы, сообразно запрошенному пути.
    </p>
    <p>
      Это значит что если для URL <span><code>/very/long/url</span></code> не будет найдено ни
      <span><code>/pages/very/long/url.php</span></code>, ни <span><code>/pages/very/long/url/index.php</span></code>,
      то тогда от искомого пути будет отрезан один шаг дабы проверить
      <span><code>/pages/very/long.php</span></code> и <span><code>/pages/very/long/index.php</span></code>.
    </p>
    <p>
      Эта операция будет повторяться максимум <?= scx('CFG::$pinpie["route to parent"]') ?> раз, и если не будет найден
      подходящий файл &mdash; запрошенный URL будет считаться не найденным.
    </p>
    <p>
      Если первая оставшаяся часть запроса "/very" не будет найдена, то запрос <b>не будет</b> направляться на
      <span><code>/pages/index.php</span></code>. Он будет расценён как не найденный.
    </p>
    <p>Возможные значения:</p>
    <ul>
      <li>0 &mdash; url не будет никуда перенаправлен. Ссылки типа "site.com/url" и "site.com/url/" расцениваются, как разные адреса.</li>
      <li>1 &mdash; адреса "site.com/url" и "site.com/url/" будут считаться одним адресом (<a href="/ru/manual/config#default-pinpie-settings">значение по умолчанию</a>)</li>
      <li>&gt; 1 &mdash; перенаправляется выше по пути</li>
    </ul>
    <p>
      Эта механика позволяет вам обрабатывать запросы вроде <span><code>/news/42</span></code> или <span><code>/news/42/edit</span></code>
      в одном файле <span><code>/pages/news.php</span></code> или <span><code>/pages/news/index.php</span></code>.
    </p>
    <p>На пример, я предпочитаю делать так:</p>
    <ul>
      <li><span><code>/pages/news/index.php</span></code> для списка новостей по адресу <span><code>/news/</span></code></li>
      <li>тот же <span><code>/pages/news/index.php</span></code> для отдельной новости по адресу <span><code>/news/42</span></code> если номер новости указан</li>
      <li><span><code>/pages/news/edit.php</span></code> чтобы редактировать новость по адресу <span><code>/news/42/edit</span></code></li>
    </ul>
    <p>Ваш код будет оставаться чистым, если вы будете использовать <a href="/ru/manual/tags#snippet">сниппеты</a>.</p>
  </section>
</article>
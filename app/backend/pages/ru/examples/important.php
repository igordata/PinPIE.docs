[sidemenu[ru/examples/sidemenu]]
[title[=Important note]]

<article>
  <header>
    <h1>Важное замечание о примерах</h1>
  </header>
  <section>
    <header>
      <h1>Нужен PinPIE</h1>
    </header>
    <p>
      Все примеры не включают в себя движок PinPIE, т.к. он может меняться и обновляться со временем.
      То есть, каждый пример требует установки движка PinPIE в папку примера (или наоборот).
      Я не включаю движок в примеры, так как они не привязаны к конкретной версии.
    </p>
  </section>
  <section>
    <header>
      <h1>Адрес</h1>
    </header>
    <p>Подразумевается, что для запуска примеров вы выбрали http://site.com для запуска примеров.</p>
    <p>Поддомены для шардинга статик серверов должны быть такими: s1.site.com, s2.site.com, s3.site.com.</p>
    <p>
      Однако, если вы почитаете <a href="/ru/manual/config">доку по конфигу</a>,
      то сможете самостоятельно настроить всё так, как вам больше хочется.
    </p>
  </section>

  <section>
    <header>
      <h1>Конфиги вебсерверов</h1>
    </header>
    <h2>Nginx</h2>
    <h3>Простой</h3>
    <code class="nginx">
    <pre>server {
  server_name     site.com;
  root     /var/www/site.com/;
  access_log      /var/log/nginx/site.com.access.log  main;

  location / {
    fastcgi_pass       unix:/var/run/php-fpm.sock;
    fastcgi_param      SCRIPT_FILENAME  $document_root/index.php;
    fastcgi_read_timeout 30s;
    include        /etc/nginx/fastcgi_params;
  }

  location ~* ^.+\.(jpg|jpeg|gif|ico|txt|png)$ {
      access_log  off;
  }
}</pre>
    </code>
    <h3>С шардингом статик серверов</h3>
    <code>
      <pre>server {
  server_name     site.com;
  root     /var/www/site.com/;
  access_log      /var/log/nginx/site.com.access.log  main;

  location / {
    fastcgi_pass       unix:/var/run/php-fpm.sock;
    fastcgi_param      SCRIPT_FILENAME  $document_root/index.php;
    fastcgi_read_timeout 30s;
    include        /etc/nginx/fastcgi_params;
  }

  location ~* ^.+\.(jpg|jpeg|gif|ico|txt|png)$ {
      access_log  off;
  }
}

server {
  server_name s1.site.com s2.site.com s3.site.com;
  root /var/www/site.com/;
}</pre>
    </code>
    <h3></h3>
  </section>
</article>
[title[=Настройка сервера]]
[sidemenu[ru/manual/sidemenu]]
[menu server configuration[=
<ul>
  <li><a href="#nginx">Nginx</a></li>
</ul>
]]
<article>
  <header>
    <h1>Настройка веб-сервера для работы PinPIE</h1>
  </header>

  <section>
    <header>
      <h1>
        <a name="nginx" href="#nginx">#</a>
        Nginx
      </h1>
    </header>
    <h2>Простой</h2>
    <pre><code class="nginx">server {
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
}</code></pre>

    <h2>С шардингом статик серверов</h2>
      <pre><code class="nginx">server {
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
}</code></pre>

    <h3></h3>
  </section>
</article>
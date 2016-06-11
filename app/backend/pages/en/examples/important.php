[sidemenu[en/examples/sidemenu]]
[title[=Important note]]

<article>
  <header>
    <h1>Important note about examples</h1>
  </header>
  <section>
    <header>
      <h1>PinPIE engine required</h1>
    </header>
    <p>
      All examples doesn't include the PinPIE engine.
      That means, every example require it's own PinPIE engine copy.
      I do not include PinPIE because examples are not bind to specific version of it.
      Just copy PinPIE files into example folder, and you'r ready to go.
    </p>
  </section>
  <section>
    <header>
      <h1>URLs</h1>
    </header>
    <p>All examples consider you have a site http://site.com, and you use it to run examples.</p>
    <p>For static server sharding subdomains are: s1.site.com, s2.site.com, s3.site.com.</p>
  </section>

  <section>
    <header>
      <h1>Configs</h1>
    </header>
    <h2>Nginx</h2>
    <h3>Simple</h3>
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
    <h3>With server sharding</h3>
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
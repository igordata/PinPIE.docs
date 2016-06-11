<article>
  <header>
    <h1>Начни использовать PinPIE</h1>
  </header>

  <section>
    <header>
      <a name="dfdf">#</a>
      <h1></h1>
    </header>
  </section>
  
    <section>
    <header>
      <h1>Точка входа</h1>
    </header>
    <p>PinPIE require to be included in main entry point of your project, and all requests have to be rerouted to that file. Generally, the main entry point for site code is `ROOT/index.php`. This file require to have `include 'pinpie/pinpie.php';` line to start PinPIE working.</p>
    <p>This, in fact, are the only things you have to do to start using PinPIE.</p>

    <h2>About preinclude.php and postinclude.php</h2>
    <p>
      For every request there are to files, that will be included if they exist. Before processing a page file `ROOT/preinclude.php` will be included. And `ROOT/postinclude.php` will be included after page is processed and assembled. If you will upgrade PinPIE with new version, this files will not be overwritten, because this
      files doesn't exist in PinPIE project. So feel free to modify them corresponding your needs.</p>
  </section>
</article>
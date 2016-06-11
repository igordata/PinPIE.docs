[title[=Templates]]
[sidemenu[en/manual/sidemenu]]
[menu templates[=
<ul>
  <li><a href="/en/manual/templates#page-templates">Page templates</a></li>
  <li><a href="/en/manual/templates#tag-templates">Tag templates</a></li>
  <li><a href="/en/manual/templates#static-tags-templates">Static tags templates</a></li>
  <li><a href="/en/manual/templates#custom-template-function">Custom function</a></li>
</ul>
]]
<article>
  <header><h1>Templates</h1></header>
  <p>PinPIE allow to use some kind of templates for pages and tags.</p>
  <section>
    <header>
      <h1>Description</h1>
    </header>
    <p>
      PinPIE allow to use same templates for pages and tags.
      Templates are allocated in <span><code>/templates</code></span> folders.
      Templates have to be "*.php" files. Template can have a php code inside. It will be executed every time.
      If you use heavy PHP code in your template and want to cache it &mdash; put it
      into the cacheble <a href="/en/manual/tags#snippet-caching">snippet</a> and use this snippet in your template.
    </p>
    <p>
      PinPIE templates provides very primitive options and are not a replacement for template engines nor PHP itself.
      They are just wrappers for output.
    </p>
    <p>
      Template can be applied to the page output and to the tag output.
      There is no big difference between page and tag templates.
      To see the output you have to place <?= scx('[[*content]]') ?> somewhere in your template.
    </p>
  </section>
  <section>
    <header><h1>Page templates</h1></header>
    <p>
      Default template have to be placed in "/templates/default.php" file.
      This template is used by default, so there is no need to set the template on every page.
      If template file is not found, default template will not be used and page will receive raw output.
    </p>

    <p>Template usage is simple. You can use template <a href="/en/manual/tags#command">command</a> tag:</p>
    <?= pcx('[[@template=name]]') ?>
    <p>
      where name is filename of your template without <span><code>.php</code></span> extension.
      And you can put files into the folders:</p>
    <?= pcx('[[@template=folder/filename]]') ?>
    <p>In PHP code you can set a desired template too:</p>
    <?= pcx("PinPIE::setTemplate('main');
/* or */
PinPIE::setTemplate('folder/folder/template');") ?>
    <p>Inside template code have to be a <a href="/en/manual/tags#placeholder">placeholder</a>:</p>
    <?= pcx('[[*content]]') ?>
    <p>It will be replaced with page output.</p>
    <p>To use raw plain text output without using PHP you can create a template file with only one tag <?= scx('[[*content]]') ?> inside and select this template.</p>
    <p>
      From the PHP code there is more convenient way to force really raw output &mdash; set current template to
      <span><code>false</code></span>.
      Any of this lines of code will turn off template usage and force raw output of page text:
    </p>
    <?= pcx('PinPIE::setTemplate(false);
PinPIE::setTemplate(); // because by default it is false
PinPIE::$template = false; // usually I use this way', 'php') ?>

    <h2>Examples</h2>
    <h3>Example 1</h3>
    <p>Create default template with file name `default.php` in /templates folder and this code inside the file:</p>

    <?= pcx(h('<html>
  <head>
    <title>This is sample default template</title>
  </head>
  <body>
    [[*content]]
  </body>
</html>'), 'html') ?>
    <p>
      This template will be used by default if no template selected in page.
      Any page output will be placed between &lt;body&gt; and &lt;/body&gt; tags.
    </p>
    <h3>Example 2</h3>
    <p>Create a template with a different file name e.g. "wide.php" in /templates folder and this code inside the file:</p>
    <?= pcx(h('<html>
  <head>
    <title>This is another template</title>
  </head>
  <body>
    [[*content]]
  </body>
</html>'), 'html') ?>

    <p>Create a page with code:</p>
    <?= pcx('[[@template=wide]]') ?>
    <p>This code will make PinPIE use "/templates/wide.php" as template for this page.</p>

    <h3>Example 3</h3>
    <p>
      This example demonstrates usage of placeholders in templates. Lets make possible to set custom title
      right on the page. Create a page with code:
    </p>
    <?= pcx('[title[=Custom title]]
This is page with custom title.') ?>
    <p>
      This will send text "Custom title" to a placeholder named "title".
      And a template have to have a placeholder <?= scx('[[*title]]') ?>.
      Template code:
    </p>
    <?= pcx(h('<html>
  <head>
    <title>[[*title]]</title>
  </head>
  <body>
    [[*content]]
  </body>
</html>'), 'html') ?>

    <p>PinPIE will replace <?= scx('[[*title]]') ?> tag in template with a content of the placeholder.</p>
  </section>

  <section>
    <header><h1>Tag templates</h1></header>
    <p>
      Syntax:<br>
      <?= scx('[[chunk]<b>template</b>]', 'html') ?><br>
      <?= scx('[[$snippet]<b>template</b>]', 'html') ?><br>
      <?= scx('[[=const]<b>template</b>]', 'html') ?><br>
      <?= scx('[[%static=file]<b>template</b>]', 'html') ?>
    </p>
    <p>
      PinPIE allow to apply template to a tag output as well (except placeholder tags).
      The template for tag require the same <?= scx('[[*content]]') ?> placeholder somewhere inside to draw the tag output.
      The tag template have to be located in the /templates <a href="/en/manual/config#templates-folder">folder</a>,
      just like page templates.
    </p>
    <p>To apply a template to the chunk or snippet output you need just put its name before second closing bracket:</p>
    <?= pcx('[[$snippet]<b>template</b>]', 'html') ?>

    <h3>Example</h3>
    <p>To wrap snippet output with a div you need to create a template named e.g. "wrap.php" with code:</p>
    <?= pcx(h('<div>[[*content]]</div>')) ?>
    <p>And now you can apply this template to a snippet like this:</p>
    <?= pcx('[[$snippet]wrap]') ?>
    <p>With code inside snippet e.g.:</p>
    <?= pcx(h('<?php echo rand(1, 100); ?>'), 'php') ?>
    <p>You will get this output:</p>
    <?= pcx(h('<div>42</div>'), 'html') ?>
  </section>

  <section>
    <header>
      <h1>Static tags templates</h1>
    </header>
    <p>
      In static tags like <?= scx('[[%static=file]<b>template</b>]', 'html') ?> template can use additional placeholders.
      Read more in <a href="/en/manual/static#templates">static readme</a>.
    </p>
  </section>

  <section>
    <header><h1>Custom template function</h1></header>
    <p>
      PinPIE allow to call a user function when template have to be applied.
      The name of the function to call can be set in <a href="/en/manual/config#template-function">config</a>.
      Function have to take two arguments: tag parameters array and the parsed template.
    </p>
  </section>
</article>

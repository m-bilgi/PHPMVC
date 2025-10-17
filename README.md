# PHPMVC
Stored procedure based php mvc project.

- Routes
  - GET, POST
  - Parameterized & optional Parameterized route
    ```bash
    Example: /user/1
    $router->get('/user/{id}', 'HomeController@showId');

    Example: "show/articles/" -or- "show/articles/1" -or- "show/articles/2"
    $router->get('/show/{category}/{pageNo?}', 'HomeController@optionalParameter');
    ```
- Layout
  ```bash
  return View::renderWithLayout('home/index.php', 'layouts/main.php', $data);
  ```
- View
  - Section
    ```bash
    <?php section('title', 'Home Page'); ?>
    -- or --
    <?php section('sidebar'); ?>
        <ul>
          <li>Link 1</li>
          <li>Link 2</li>
        </ul>
    <?php endsection(); ?>

    If section("sidebar") is not defined, show the default:
    <?php section('sidebar', function() { ?>
        <ul>
            <li>Link 1</li>
        </ul>
    <?php }); ?>
    ```
  - Yield(s)
    ```bash
    Default usage:
    <?= yieldContent('content'); ?>

    If section("title") is empty, show default:
    <?= yieldContent('title', 'PHP MVC'); ?>

    If section("sidebar") is not defined, show the default:
    <?php
    yieldContentOr('sidebar', function () {
      echo '<p>Default sidebar.</p>';
    });
    ```
  - Include
    ```bash
    <?= includeFile('partials/footer.php'); ?>
    -- or --
    <?= includeFile('partials/header.php', ['title'=>'Home Page']); ?>
    ```
  - Include partial
    ```bash
    Core\View::includePartial([
      'view' => 'partials/include-partial.php',
      'controller' => 'HomeController',
      'method' => 'partialData'
    ]);
    ```
- Caching (file-based)
  ```bash
  use Core\Cache;
  
  $cache = new Cache();
  
  $key = 'test_users';
  
  if ($cache->has($key)) {
      $data = $cache->get($key);
  } else {
      $data = [
          ['id' => 1, 'name' => 'Alice'],
          ['id' => 2, 'name' => 'Bob'],
      ];
      $cache->set($key, $data, 10); // 10 second
  }
  ```
- Config & ENV
  ```bash
  Core: /core/config.php
  echo config('key');
  echo config('non_existing_key', 'default_value');

  ENV: /.env
  echo $_ENV['APP_DEV_MODE'];
  ```
- Security
  - CSRF Token
  - Signature key (sha256)
- Tailwind CSS

# Required
- Node.js (for npm commands): https://nodejs.org/
- Composer: https://getcomposer.org/
- PHP (8 or higher): https://php.net/
- MySql or MariaDB: https://mysql.com/ or https://mariadb.org/
- Apache (Recommended): https://httpd.apache.org/
- Tailwindcss CLI: https://tailwindcss.com/

# Install Composer: open terminal and run
- composer dump-autoload
- php -S localhost:8000 -t public
- Open http://localhost:8000/ in the browser.

# Install Tailwindcss: open terminal and run
- npm install tailwindcss @tailwindcss/cli
- npm run dev
  
  If you want to build minify, you can use "npm run build".

# Structure Map
```bash
├── app
│   ├── Controllers
│   │   ├── HomeController.php
│   │   ├── CategoryController.php
│   ├── Models
│   │   ├── BaseModel.php
│   │   ├── Category.php
│   ├── Repositories
│   │   ├── CategoryRepository.php
│   │   ├── QueryOptions.php
│   ├── Services
│   │   ├── CategoryService.php
│   ├── Views
│   │   ├── category
│   │   │   ├── partials
│   │   │   │   ├── sidebar.php
│   │   │   ├── edit.php
│   │   │   ├── index.php
│   │   │   ├── insert.php
│   │   │   ├── show.php
│   │   ├── home
│   │   │   ├── index.php
│   │   ├── layouts
│   │   │   ├── main.php
│   │   ├── partials
│   │   │   ├── footer.php
│   │   │   ├── header.php
├── core
│   ├── Cache.php
│   ├── config.php
│   ├── Database.php
│   ├── env.php
│   ├── helpers.php
│   ├── Logger.php
│   ├── Request.php
│   ├── Router.php
│   ├── ServiceResponse.php
│   ├── View.php
├── private (Do not publish the folder.)
│   ├── css
│   │   ├── tailwind.css
│   ├── database
│   │   ├── sql
│   │   │   ├── procedures
│   │   │   │   ├── sp_insert_category.sql
│   │   │   │   ├── sp_select_category.sql
│   │   │   │   ├── sp_update_category.sql
│   │   │   ├── tables
│   │   │   │   ├── category.sql
├── public
│   ├── assets
│   │   ├── css
│   │   │   ├── style.css
│   │   ├── js
│   │   │   ├── script.js
│   ├── index.php
├── storage
│   ├── cache
│   │   ├── index.html
│   ├── logs
│   │   ├── app.log
├── .env
├── composer.json
├── package.json
├── README.md
├── routes.php
├── tailwind.config.js
```

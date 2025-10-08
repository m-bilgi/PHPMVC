# PHPMVC
Stored procedure based php mvc project.

- Routes
  - Parameterized route
- Layout
- View (section, yield(s), include)
  ```bash
  SECTION
  <?php section('title'); ?>
      Home Page
  <?php endsection(); ?>

  YIELD
  <?= yieldContent('title', 'PHP MVC'); ?>
  <?= yieldContent('content'); ?>
  <?php yieldContentOr('sidebar', function () { ?>
      <p>Default sidebar.</p>
  <?php }); ?>

  INCLUDE
  <?= includeFile('partials/footer.php'); ?>
  ```
- tailwindcss
- Caching (file-based)
  ```bash
  use Core\Cache;
  
  $cache = new Cache();
  
  $key = 'test_users';
  
  if ($cache->has($key)) {
      $data = $cache->get($key);
      echo "<pre>Cache data:\n";
      print_r($data);
  } else {
      $data = [
          ['id' => 1, 'name' => 'Alice'],
          ['id' => 2, 'name' => 'Bob'],
      ];
  
      $cache->set($key, $data, 10); // 10 second
      echo "<pre>Real data:\n";
      print_r($data);
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

# Required
- Node.js (for npm commands): https://nodejs.org/
- Composer: https://getcomposer.org/
- PHP (8 or higher): https://www.php.net/
- MySql or MariaDB: https://www.mysql.com/ or https://mariadb.org/
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
│   ├── Models
│   │   ├── BaseModel.php
│   │   ├── ModuleCategory.php
│   ├── Repositories
│   │   ├── ModuleCategoryRepository.php
│   │   ├── QueryOptions.php
│   ├── Views
│   │   ├── home
│   │   │   ├── index.php
│   │   ├── layouts
│   │   │   ├── main.php
│   │   ├── partials
│   │   │   ├── footer.php
│   │   │   ├── header.php
├── core
│   ├── config.php
│   ├── Database.php
│   ├── env.php
│   ├── helpers.php
│   ├── Logger.php
│   ├── Request.php
│   ├── Router.php
│   ├── ServiceResponse.php
│   ├── View.php
├── private (Do not publish the database folder.)
│   ├── cache
│   ├── css
│   │   ├── tailwind.css
│   ├── database
│   │   ├── sql
│   │   │   ├── procedures
│   │   │   │   ├── sp_select_module_category.sql
│   │   │   ├── tables
│   │   │   │   ├── module_category.sql
├── public
│   ├── assets
│   │   ├── css
│   │   │   ├── style.css
│   │   ├── js
│   │   │   ├── script.js
│   ├── index.php
├── storage
│   ├── logs
│   │   ├── app.log
├── .env
├── composer.json
├── package.json
├── routes.php
```

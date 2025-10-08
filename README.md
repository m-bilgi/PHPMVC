# PHPMVC
My PHP Project

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
- Config & ENV
  ```bash
  Core: core/config.php
  echo config('key');
  echo config('non_existing_key', 'default_value');

  ENV:
  echo $_ENV['APP_DEV_MODE'];
  ```

# Required
- Composer: https://getcomposer.org/
- Tailwindcss CLI: https://tailwindcss.com/docs/installation/tailwind-cli

# Isntall Composer: open terminal and run
- composer dump-autoload
- php -S localhost:8000 -t public
- Open http://localhost:8000/ in the browser.

# Isntall Tailwindcss: open terminal and run
- npm install tailwindcss @tailwindcss/cli
- npx @tailwindcss/cli -i ./src/input.css -o ./src/output.css --watch

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
├── public
│   ├── assets
│   │   ├── css
│   │   │   ├── style.css
│   │   ├── js
│   │   │   ├── script.js
│   ├── index.php
├── .env
├── composer.json
├── routes.php
```

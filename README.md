# PHPMVC
My PHP Project

- Routes
  - Parameterized route
- Layout
- View section
  ```bash
  <?php section('title'); ?>
      Home Page
  <?php endsection(); ?>
  ```
- View yield
  ```bash
  <?= yieldContent('title', 'PHP MVC'); ?>
  <?= yieldContent('content'); ?>
  ```
- View include
  ```bash
  <?= includeFile('partials/footer.php'); ?>
  ```

# Required
- Composer: https://getcomposer.org/

# Open terminal and run
- composer dump-autoload
- php -S localhost:8000 -t public

Open http://localhost:8000/ in the browser.

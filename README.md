# PHPMVC
My PHP Project

- Routes
  - Parameterized route
- Layout
- View (section, yield, include)
  ```bash
  SECTION
  <?php section('title'); ?>
      Home Page
  <?php endsection(); ?>

  YIELD
  <?= yieldContent('title', 'PHP MVC'); ?>
  <?= yieldContent('content'); ?>

  INCLUDE
  <?= includeFile('partials/footer.php'); ?>
  ```

# Required
- Composer: https://getcomposer.org/

# Open terminal and run
- composer dump-autoload
- php -S localhost:8000 -t public

Open http://localhost:8000/ in the browser.

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <link rel="stylesheet" href="<?php echo url('/css/search.css'); ?>">
</head>

<body>

    <div class="search-container">
        <h2>URL Shortner</h2>



        <form action="<?php echo url('/'); ?>" class="search-form" method="post">
            <input type="text" name="link" id="link" class="search-input" placeholder="Enter URL & Press Enter">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <?php
            if (Session::has('errors')) {
            ?>

                <span class="error"><?php echo $errors->first('link'); ?></span>
            <?php
            }
            if (Session::has('invalidURL')) {
            ?>

                <span class="error"><?php echo Session::get('invalidURL'); ?></span>
            <?php
            }

            if (Session::has('link')) {
            ?>
                <h3 class="success-url"> Your Short URL Is <a href="<?php echo url(Session::get('link')); ?>"><?php echo url(Session::get('link')); ?></a></h3>
            <?php
            }
            ?>
        </form>
    </div>

</body>

</html>

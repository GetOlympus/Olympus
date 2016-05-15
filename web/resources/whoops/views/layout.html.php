<?php
/**
* Layout template file for Whoops's pretty error output.
*/
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $tpl->escape($page_title) ?></title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600">
    <style><?php echo $stylesheet ?></style>
  </head>
  <body>

    <div class="Whoops container">
      <div class="stack-container">
        <div class="left-panel cf <?php echo (!$has_frames ? 'empty' : '') ?>">
          <div class="frames-description">
            Stack frames (<?php echo count($frames) ?>):
          </div>

          <div class="frames-container">
            <?php $tpl->render($frame_list) ?>
          </div>
        </div>
        <div class="details-container cf">
          <header>
            <?php $tpl->render($header) ?>
          </header>
          <?php $tpl->render($frame_code) ?>
          <?php $tpl->render($env_details) ?>
        </div>
      </div>
    </div>

    <script><?php echo $zepto ?></script>
    <script><?php echo $clipboard ?></script>
    <script><?php echo $javascript ?></script>
  </body>
</html>

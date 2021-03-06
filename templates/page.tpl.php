<?php
/**
 * @file
 * Returns the HTML for a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728148
 */
?>

<div id="page">
    <div id='top-banner'><?php print render($page['top_banner']) ?></div>

  <header class="header" id="upper-header" role="banner">
    <div class='upper-header-container'>
    <?php print render($page['upper_header']); ?>
    </div>
  </header>
 
  <header class="header" id="header" role="banner">

    <?php if ($secondary_menu): ?>
      <nav class="header__secondary-menu" id="secondary-menu" role="navigation">
        <?php print theme('links__system_secondary_menu', array(
          'links' => $secondary_menu,
          'attributes' => array(
            'class' => array('links', 'inline', 'clearfix'),
          ),
          'heading' => array(
            'text' => $secondary_menu_heading,
            'level' => 'h2',
            'class' => array('element-invisible'),
          ),
        )); ?>
      </nav>
    <?php endif; ?>
 
    <?php if ($logo): ?>
      <div class='header-logo'><a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="header__logo" id="logo">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" class="header__logo-image" /></a>
      </div>  
    <?php endif; ?>

    <?php if ($header_date): ?>
      <div id='header-date'><span><?php print $header_date; ?></span></div>
    <?php endif; ?>

    <?php print render($page['header']); ?>

  </header>
  <div id="navigation">
    <div id='nav-wrapper'>
      <?php print render($page['navigation']); ?>
    </div>
  </div>
  <div id="main">
    <div id="content" class="column" role="main">
      <?php print render($page['highlighted']); ?>
      <?php print $breadcrumb; ?>
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <div id="page-title">
          <h1 class="page__title title" >
              <span><?php print $title; ?></span>
           </h1>
        </div>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </div>

    <?php
      // Render the sidebars to see if there's anything in them.
      $sidebar_first  = render($page['sidebar_first']);
      $sidebar_second = render($page['sidebar_second']);
    ?>

    <?php if ($sidebar_first || $sidebar_second): ?>
      <!-- <aside class="sidebars">-->
        <?php //print $sidebar_first; ?>
        <?php print $sidebar_second; ?>
      <!--</aside>-->
    <?php endif; ?>

  </div>

  <?php print render($page['footer']); ?>

</div>

<?php print render($page['bottom']); ?>
<?php
/**
 * @file
 * Returns the HTML for a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728148
 */
?>

<header class="header" id="upper-header" role="banner">
  <div class='upper-header-container'>
  <?php print render($page['upper_header']); ?>
  </div>
</header>

<div id="page" class='mine'>
  
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
    <?php print $breadcrumb; ?>
    <?php print $messages; ?>
		<?php print render($page['highlighted']); ?>
		<a id="main-content"></a>
		<?php print render($tabs); ?>
		<?php print render($page['help']); ?>
		<?php if ($action_links): ?>
			<ul class="action-links"><?php print render($action_links); ?></ul>
		<?php endif; ?>
 		<div id="yp-search-header">
			<div class='container'>
				<h1 class="yp-title">FIND YOUR VENDORS</h1>
				<h2 class="yp-subtitle">Search here for all your wedding needs</h2>
				<div class='yp-form-holder'>
				<?php print drupal_render(drupal_get_form('yp_search_form')); ?>
				</div>
			</div>
			<div class="attribution">
					<a href='http://yp.com' target='_blank'><img src="/sites/all/themes/custom/bg_zen/images/yp-powered-by.png"></a>
			</div>
		</div>
    <div id="content" class="column" role="main">
     <?php print render($page['content']); ?>
		<?php
			print views_embed_view('hp_whats_buzzing', 'block_2');
		?>
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

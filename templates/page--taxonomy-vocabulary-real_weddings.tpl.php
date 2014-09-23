<?php
//dd($term, "Term");
$nids = taxonomy_select_nodes($term->tid, FALSE, FALSE, array('t.weight' => 'ASC'));
$first_nid_set = array_slice($nids, 0, 9);
//$more_nid_set = array_slice($nids, 9);
$nodes = $more_nodes = array();
foreach ($first_nid_set as $nid) {
  $nodes[] = node_load($nid);
}
//print image_style_url('rw-main', $nodes[2]->field_images['und'][0]['uri'])
//$ad_nodes = _simpleads_load_ads(3063, 1);
//$ad =  "<div class='ad'>" . _simpleads_render_ajax_template($ad_nodes, 3063, 1) . "</div>";
$block = block_load('views', '972e4de772333d450101eaae60fd2278');
$rw_search = drupal_render(_block_get_renderable_array(_block_render_blocks(array($block)))); 
?>
<header class="header" id="upper-header" role="banner">
  <div class='upper-header-container'>
  <?php print render($page['upper_header']); ?>
  </div>
</header>
<div id="page" class='real-wedding'>
  
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

    <div id="content" class="column-1" role="main">
      <?php print render($page['highlighted']); ?>
      <?php print $breadcrumb; ?>
      <a id="main-content"></a>
      <!--
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <div id="page-title"><h1 class="page__title title" ><span>Real Wedding: <?php print $title; ?></span></h1></div>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      -->
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php if (count($nodes) > 0):?>
        <div class="top-row">
          <div class="details">
            <div class='container'>
              <h1><?php print $nodes[0]->title ?></h1>
              <div class='rw-info'>
                <?php print bg_rw_trim($nodes[0]->body['und'][0]['safe_value'], 1000) ?>
              </div>
              <div id='rw-search'>
                <h2 class='browse'>Browse More Real Weddings</h2>
                <?php print $rw_search ?>
              </div>
            </div>
          </div>
          <div class="manual-ad" data-term="3063" data-num='10'>
          </div>  
        </div>
        <!-- end top row -->
        <div id='rw-images'>
          <div id='masonry-container' class='real-wedding-list'>
            <div class='views-row'>
              <figure class="rw-image with-caption">
                <img data-nid='<?php print $nodes[1]->nid ?>' src="<?php print image_style_url('600x800', $nodes[1]->field_images['und'][0]['uri']) ?>">
                <figcaption class="img-title" data-nid='<?php print $nodes[1]->nid ?>'>
                  <div class='img-body'>
                    <?php print bg_rw_trim($nodes[1]->body['und'][0]['safe_value']) ?>
                  </div>    
                </figcaption>
              </figure>
            </div>
            <div class='views-row w2'>
              <figure class="rw-image with-caption">
                <img data-nid='<?php print $nodes[0]->nid ?>' src="<?php print image_style_url('600x800', $nodes[0]->field_images['und'][0]['uri']);?>">
                <figcaption class="img-title" data-nid='<?php print $nodes[0]->nid ?>'>
                  <div class='img-body'>
                    <?php print bg_rw_trim($nodes[0]->body['und'][0]['safe_value'], 1000) ?>
                  </div>    
                </figcaption>
              </figure>
            </div>
            <div class='views-row'>
              <figure class="rw-image with-caption">
                <img data-nid='<?php print $nodes[2]->nid ?>' src="<?php print image_style_url('600x800', $nodes[2]->field_images['und'][0]['uri'])?>">
                <figcaption class="img-title" data-nid='<?php print $nodes[2]->nid ?>'>
                  <div class='img-body'>
                    <?php print bg_rw_trim($nodes[2]->body['und'][0]['safe_value']) ?>
                  </div>
                </figcaption>
              </figure>
            </div>
            <div class='views-row'>
              <figure class="rw-image with-caption">
                <img data-nid='<?php print $nodes[3]->nid ?>' src="<?php print image_style_url('600x800', $nodes[3]->field_images['und'][0]['uri'])?>">
                <figcaption class="img-title" data-nid='<?php print $nodes[3]->nid ?>'>
                    <div class='img-body'>
                      <?php print bg_rw_trim($nodes[3]->body['und'][0]['safe_value']) ?>
                    </div>    
                </figcaption>
              </figure>
            </div>
            <div class='views-row'>
              <figure class="rw-image with-caption">
                <img data-nid='<?php print $nodes[4]->nid ?>' src="<?php print image_style_url('600x800', $nodes[4]->field_images['und'][0]['uri'])?>">
                <figcaption class="img-title" data-nid='<?php print $nodes[4]->nid ?>'>
                    <div class='img-body'>
                      <?php print bg_rw_trim($nodes[4]->body['und'][0]['safe_value']) ?>
                    </div>
                </figcaption>
              </figure>
            </div>
            <div class='views-row'>
              <figure class="rw-image with-caption">
                <img data-nid='<?php print $nodes[5]->nid ?>' src="<?php print image_style_url('600x800', $nodes[5]->field_images['und'][0]['uri'])?>">
                <figcaption class="img-title" data-nid='<?php print $nodes[5]->nid ?>'>
                  <div class='img-body'>
                    <?php print bg_rw_trim($nodes[5]->body['und'][0]['safe_value']) ?>
                  </div>
                </figcaption>
              </figure>
            </div>
            <div class='views-row'>
              <figure class="rw-image with-caption">
                <img data-nid='<?php print $nodes[6]->nid ?>' src="<?php print image_style_url('600x800', $nodes[6]->field_images['und'][0]['uri'])?>">
                <figcaption class="img-title" data-nid='<?php print $nodes[6]->nid ?>'>
                  <div class='img-body'>
                    <?php print bg_rw_trim($nodes[6]->body['und'][0]['safe_value']) ?>
                  </div>
                </figcaption>
              </figure>
            </div>
            <div class='views-row'>
              <figure class="rw-image with-caption">
                <img data-nid='<?php print $nodes[7]->nid ?>' src="<?php print image_style_url('600x800', $nodes[7]->field_images['und'][0]['uri'])?>">
                <figcaption class="img-title" data-nid='<?php print $nodes[7]->nid ?>'>
                  <div class='img-body'>
                    <?php print bg_rw_trim($nodes[7]->body['und'][0]['safe_value']) ?>
                  </div>
                </figcaption>
              </figure>
            </div>
            <div class='views-row'>
              <figure class="rw-image with-caption">
                <img data-nid='<?php print $nodes[8]->nid ?>' src="<?php print image_style_url('600x800', $nodes[8]->field_images['und'][0]['uri'])?>">
                <figcaption class="img-title" data-nid='<?php print $nodes[8]->nid ?>'>
                  <div class='img-body'>
                    <?php print bg_rw_trim($nodes[8]->body['und'][0]['safe_value']) ?>
                  </div>
                </figcaption>
              </figure>
            </div>
          </div>  
        </div>    
      <?php endif; ?>
        <div id="load-more" class='show' data-start='10' data-tid='<?php print $term->tid; ?>'>
          <span>See More Photos</span>
        </div>
    </div>


  </div>

  <?php print render($page['footer']); ?>

</div>

<?php print render($page['bottom']); ?>

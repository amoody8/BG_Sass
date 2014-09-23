<?php
/**
 * @file
 * Returns the HTML for a node.
**/

//Get the previous POTD
$prev_link = bg_totd_get_nav($node->nid, 'prev');
$next_link = bg_totd_get_nav($node->nid, 'next');
?>
<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php if ($title_prefix || $title_suffix || $display_submitted || $unpublished || !$page && $title): ?>
    <header>
      <?php print render($title_prefix); ?>
      <?php if (!$page && $title): ?>
        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
			<!--
      <?php if ($display_submitted): ?>
        <p class="submitted">
          <?php print $user_picture; ?>
          <?php print $submitted; ?>
        </p>
      <?php endif; ?>
			-->
      <?php if ($unpublished): ?>
        <mark class="unpublished"><?php print t('Unpublished'); ?></mark>
      <?php endif; ?>
    </header>
  <?php endif; ?>

  <?php
    // We hide the comments and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
	?>
	<div class='body'>
		<div class='body-text'>
			<div class='totd-image'>
				<img src='<?php print image_style_url('600x', $node->field_images['und'][0]['uri']) ?>' />
			</div>
			<?php print render($node->body['und'][0]['value']); ?>
			<div id='nav'>
				<?php if ($prev_link):?><a title='Older Tips' id='prev' href='<?php print $prev_link; ?>'></a><?php endif;?>
				<?php if ($next_link):?><a title='Newer Tips' id='next' href='<?php print $next_link; ?>'></a><?php endif;?>
			</div>
		</div>
		<div class='info'></div>
	</div>
  <?php print render($content['links']); ?>
  <?php print render($content['comments']); ?>

</article>

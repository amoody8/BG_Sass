<?php
/**
 * @file
 * Returns the HTML for a node.
**/
//Get the previous POTD
$prev_link = bg_potd_get_nav($node->nid, 'prev');
$next_link = bg_potd_get_nav($node->nid, 'next');
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
			<?php print render($node->body['und'][0]['value']); ?>
			<div id='nav'>
				<?php if ($prev_link):?><a title='Older Photos' id='prev' href='<?php print $prev_link; ?>'></a><?php endif;?>
				<?php if ($next_link):?><a title='Newer Photos' id='next' href='<?php print $next_link; ?>'></a><?php endif;?>
			</div>
		</div>
		<div class='info'>
			<?php if (!empty($node->field_photo_credit['und'])):?>
				<div class='photo-credit'><span>Photo Credit: </span><?php print $node->field_photo_credit['und'][0]['value']; ?></div>
			<?php endif;?>
			<?php if (!empty($node->field_why_we_love_it['und'])):?>
				<div class='why-title'><span>Why We Love It</span></div>
				<div class='why'><?php print $node->field_why_we_love_it['und'][0]['value']; ?></div>
			<?php endif;?>
		</div>
	</div>
  <?php print render($content['links']); ?>
  <?php print render($content['comments']); ?>

</article>

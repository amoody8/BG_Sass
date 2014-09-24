<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728164
 */
?>
<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
	<?php if ($page && !empty($node->field_subtitle['und'][0]['value'])):?>
		<h2 class='subtitle'><?php print $node->field_subtitle['und'][0]['value']; ?></h2>
  <?php endif; ?>
	<?php if ($page && $share_links) {
		print $share_links;  
	 }
	?>

  <?php if ($title_prefix || $title_suffix || $display_submitted || $unpublished || !$page && $title): ?>
    <header>
      <?php print render($title_prefix); ?>
      <?php if (!$page && $title): ?>
        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php if (!empty($node->field_author['und'][0]['value'])): ?>
        <span class="submitted">By: 
          <?php print $node->field_author['und'][0]['value'] ?>
					| 
        </span>
      <?php endif; ?>
				<span class='article-created'><?php print date('m/d/Y', $node->created) ?></span>
      <?php if ($unpublished): ?>
        <mark class="unpublished"><?php print t('Unpublished'); ?></mark>
      <?php endif; ?>
    </header>
  <?php endif; ?>
	
  <?php
    // We hide the comments and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    print render($content);
  ?>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>
</article>

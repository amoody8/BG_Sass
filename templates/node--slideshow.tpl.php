<?php
	if ($page) {
		//dd($node, "Node");
		$url = drupal_lookup_path('alias',"node/".$node->nid);
		$by = (isset($node->field_author['und'][0]['value'])) ? $node->field_author['und'][0]['value'] : 'none';
	
		$slideshow_tid = $node->field_slideshow['und'][0]['tid'];
		$slideshow_term = $node->field_slideshow['und'][0]['taxonomy_term']->name;
		$total_sql = "SELECT count(n.nid) as total from node n INNER JOIN taxonomy_index i ON n.nid=i.nid WHERE n.type='slide' AND i.tid = :tid ORDER by i.weight DESC";
		$total = db_query($total_sql, array(':tid'=>$slideshow_tid))->fetchObject()->total;
		if (isset($_GET['s'])) {
			$slides_sql = "SELECT n.nid from node n INNER JOIN taxonomy_index i ON n.nid=i.nid WHERE n.type='slide' AND i.tid = :tid ORDER by i.weight DESC";
		} else {
			$slides_sql = "SELECT n.nid from node n INNER JOIN taxonomy_index i ON n.nid=i.nid WHERE n.type='slide' AND i.tid = :tid ORDER by i.weight DESC LIMIT 20";
		}
		$slides_result = db_query($slides_sql, array(':tid'=>$slideshow_tid));
		$slides = array();
		while ($record = $slides_result->fetchObject()) {
			$temp = array();
			$imageObj = node_load($record->nid);
			$temp['nid'] = $imageObj->nid;
			$temp['src'] = file_create_url($imageObj->field_images['und'][0]['uri']);
			$temp['photo_credit'] = (isset($imageObj->field_photo_credit['und'][0]['value'])) ?: '';
			$temp['title'] = $imageObj->title;
			$temp['body'] = $imageObj->body['und'][0]['value'];
			$slides[] = $temp;
			unset($imageObj);
			unset($temp);
		}
	}
?>
<?php if ($page): ?>

<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="content clear-block">
		<div class='slideshow'>
			<div class='slideshow-body'>
				<?php print $node->body['und'][0]['value']; ?>
			</div>
			<?php if ($share_links) {
				//print $share_links;  
			 }
			 ?>
			<div class='author'>
				<span>By: <?php print $by; ?></span>
				<?php
				if (user_access('administer nodes')) {
					print "<div class='admin-edit'><a href='/taxonomy/term/" . $slideshow_tid . "/order' target='_blank'>Order Images</a>&nbsp;&nbsp;&nbsp;<a id='edit-image' href='' target='_blank'>Edit Image</a></div>";
				}?>	
			</div>
			<?php
				if (count($slides) > 0) { 
					print "<div id='slides-frame' data-total-slides='" . $total . "' data-tid='" . $slideshow_tid . "'data-nid='" . $node->nid . "'>\n";
						print "<ul id='slides'>\n";
						foreach ($slides as $index => $slide) {
							print "<li class='slide-container' num='" . $index. "' data-nid='" . $slide['nid'] . "' >\n";
								if (!array_key_exists('ad', $slide)) {
								print "<div class='slide'>\n";
									print "<div class='p-container'>";
										print "<div class='pin-it'><a class='p-button' href='javascript:void();'></a></div>";
										print "<img class='slide-image' src='" . trim($slide['src']) . "' alt='" . $slide['title'] . "' />";
									print "</div>";
								print "</div>\n";
								print "<div class='caption'>\n";
									print "<div class='slide-pagination'><span>" . ($index + 1) . "/" . $total . "</span> </div>\n";
									print "<h2 class='node-title'>" .  $slide['title'] . "</h2>\n";
									print $slide['body'];
									if (isset($slide['photo_credit']) && $slide['photo_credit'] != '') {
										print "<p class='credit'>" . $slide['photo_credit'] . "</p>\n";
									}	
								print "</div>\n";
								}else {
									print "<div class='ad-container'><div class='ad-notice'>Advertisement</div>";
									print $slide['ad'];
									print "</div>";
								}
							print "</li>\n";
						}
						print "</ul>\n";
					print "</div>\n";
					print "<div id='slide-data'>\n";
						print "<div id='nav'>\n";
							print "<a class='bx-prev' href=''></a>\n";								
							print "<a class='bx-next' href=''></a>\n";
						print "</div>\n";
						print "<div class='side-caption'></div>\n";
					print "</div>\n";
				}  
			?>
		</div>
	</div>
  <?php
    // We hide the comments and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
  ?>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</article>
<?php else: ?>
<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php if ($title_prefix || $title_suffix || $display_submitted || $unpublished || !$page && $title): ?>
    <header>
      <?php print render($title_prefix); ?>
      <?php if (!$page && $title): ?>
        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php if ($display_submitted): ?>
        <p class="submitted">
          <?php print $user_picture; ?>
          <?php print $submitted; ?>
        </p>
      <?php endif; ?>

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
<?php endif; ?>

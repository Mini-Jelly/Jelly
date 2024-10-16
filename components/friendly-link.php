<?php
$friendlyLinks = [];
$text = $this->options->friendlyLinks;
$links_arr = array_map('trim', explode("\r\n", $text));
foreach ($links_arr as $item) {
  list($title, $url) = array_map('trim', explode("||", $item));
  $friendlyLinks[] = compact('title', 'url');
}
?>

<ul>
  友情链接：
  <?php foreach ($friendlyLinks as $slide) { ?>
    <li>
      <a href="<?php echo $slide['url']; ?>" title="<?php echo $slide['title']; ?>"
        target="_blank"><?php echo $slide['title']; ?></a>
    </li>
  <?php } ?>
</ul>
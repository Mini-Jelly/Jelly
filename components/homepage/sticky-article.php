<?php
$sticky_text = $this->options->stickyCid;
if ($sticky_text) {
  $sticky_arr = array_map('trim', explode("||", $sticky_text));
  foreach ($sticky_arr as $item) {
    $object = new stdClass();
    $this->widget('Widget_Archive@' . $item, 'pageSize=1&type=post', 'cid=' . $item)->to
    ($object);
    $title = '[置顶]' . $object->title;
    displayArticle($object, $title);
    ?>
    <?php
  }
}
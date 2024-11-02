<?php function renderArticle($object, $title, $permalink, $category) {?>
  <article class="article-entry">
    <div class="article-cover">
      <a href="<?= $permalink ?>" title="<?= $title ?>"></a>
      <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        data-src="<?= getThumbnail($object) ?>" alt="<?= $title ?>">
    </div>
    <div class="article-info">
      <header class="article-info-header">
        <h2>
          <a href="<?=$permalink ?>"><?= $title ?></a>
        </h2>
      </header>
      <div class="article-info-content">
        <p>
          <?php $object->excerpt(160, '...'); ?>
        </p>
      </div>
      <footer class="article-info-footer">
        <span>
          <?php
          if (trim($category) !== "") {
            echo $category . " · ";
          }
          $object->date('Y-m-d');
          ?>
        </span>
      </footer>
    </div>
    <a href="<?= $permalink ?>" class="entry-link" title="<?= $title ?>"></a>
  </article>
  <?php
}

if ($this->currentPage == 1 && $this->options->stickyCid) {
  $sticky_arr = array_map('trim', explode("||", $this->options->stickyCid));
  foreach ($sticky_arr as $item) {
    $object = new stdClass();
    $this->widget('Widget_Archive@' . $item, 'pageSize=1&type=post', 'cid=' . $item)->to($object);
    $title = '[置顶]' . $object->title;
    renderArticle($object, $title, $object->permalink, $object->category);
  }
}

while ($this->next()):
  renderArticle($this, $this->title, $this->permalink, $this->category);
endwhile;
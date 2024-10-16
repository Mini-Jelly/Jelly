<ul class="article-meta">
  <li itemprop="author" itemscope itemtype="http://schema.org/Person">
    <a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author">
      <?php $this->author(); ?>
    </a>
  </li>
  <li> ·</li>
  <li>
    <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished">
      <?php $this->date(); ?>
    </time>
  </li>
  <?php
  if (basename(debug_backtrace()[1]['file']) === "post.php") {
    $str = trim($this->category);
    if ($str !== "") { ?>
      <li>·</li>
      <li>
        <?php $this->category(','); ?>
      </li>
    <?php }
  } ?>
</ul>
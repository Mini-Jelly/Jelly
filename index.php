<?php
/**
 * Jelly Beat 241102
 * @package Jelly
 * @author Mini-Jelly
 * @version Beat 241102
 * @link https://jntm6.eu.org
 */
if (!defined('__TYPECHO_ROOT_DIR__'))
  exit;
$this->need('header.php'); ?>
<div id="body">
  <div class="container">
    <div class="row"><!--grid-->
      <main id="main" class="col-12 col-lg-10 offset-lg-1">
        <?php if ($this->currentPage === 1) {
          if ($this->options->swiper) {
            $this->need('./components/homepage/swiper.php');
          }
          if ($this->options->banner) {
            $this->need('./components/homepage/banner.php');
          }
          if ($this->options->tagCloud === 'on') {
            $this->need('./components/homepage/tag-cloud.php');
          }
        } ?>
        <h3>🔥最新文章</h3>
        <?php $this->need('./components/content-preview.php'); ?>
      </main>
    </div>
  </div>
  <?php if ($this->currentPage === 1 && $this->options->infiniteScroll === 'on') { ?>
    <div id="load-more-box" class="load-more-box">
      <button id="load-more-btn">加载更多</button>
    </div>
  <?php } elseif ($this->options->infiniteScroll === 'off')
    $this->need('./components/paginator.php');
  ?>
</div>
<?php $this->need('footer.php'); ?>
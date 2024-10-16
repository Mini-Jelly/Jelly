<?php if (!defined('__TYPECHO_ROOT_DIR__'))
  exit;
$this->need('header.php');
?>
  <div id="body">
    <div class="container">
      <div class="row">
        <main class="col-12 col-lg-10 offset-lg-1" id="main">
          <h1 class="archive-title">
            <?php $this->archiveTitle(
              array(
                'category' => ('分类 %s 下的文章'),
                'search' => ('关键字“ %s ”的文章'),
                'tag' => ('标签 %s 下的文章'),
                'author' => ('%s 发布的文章')
              ),
              '',
              ''
            ); ?>
          </h1>
          <?php if ($this->have()): ?>
            <?php $this->need('./components/content-preview.php'); ?>
          <?php else: ?>
            <h1>
              抱歉，你搜索的内容未找到，请尝试使用其他关键词搜索。
            </h1>
          <?php endif; ?>
        </main>
      </div>
    </div>
    <?php
    $this->need('./components/paginator.php');
    ?>
  </div>
<?php $this->need('footer.php'); ?>
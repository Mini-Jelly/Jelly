<?php if (!defined('__TYPECHO_ROOT_DIR__'))
  exit;
$this->need('header.php');
$this->need('./utility/resource.php');
?>
  <div id="body">
    <div class="container">
      <div class="row">
        <main class="col-12" id="main">
          <article class="post">
            <h1 class="post-title">
              <?php $this->title() ?>
            </h1>
            <?php $this->need('./components/article/article-meta.php'); ?>
            <div class="post-content">
              <?php $this->need('./components/article/article-content.php'); ?>
              <?php $this->need('./components/article/article-copyright.php'); ?>
            </div>
            <?php $this->need('./components/qrcode.php'); ?>
          </article>
          <?php $this->need('./components/article/article-comment.php'); ?>
        </main>
        <?php $this->need('./components/sidebar.php'); ?>
      </div>
    </div>
  </div>
<?php $this->need('footer.php'); ?>
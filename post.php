<?php if (!defined('__TYPECHO_ROOT_DIR__'))
  exit;
$this->need('header.php');
$this->need('./utility/resource.php');
?>
  <div id="body">
    <div class="container">
      <div class="row">
        <main class="col-12" id="main">
          <div class="post line-numbers">
            <h1 class="post-title">
              <?php $this->title() ?>
            </h1>
            <?php $this->need('./components/article/article-meta.php'); ?>
            <?php $this->need('./components/article/article-last-modified-time.php'); ?>
            <div class="post-content">
              <?php $this->need('./components/article/article-content.php'); ?>
              <?php $this->related(5)->to($relatedPosts);
              if ($relatedPosts->have()): ?>
                <h2>猜你喜欢😋</h2>
                <ul>
                  <?php while ($relatedPosts->next()): ?>
                    <li>
                      <a href="<?php $relatedPosts->permalink(); ?>"
                         title="<?php $relatedPosts->title(); ?>">
                        <?php $relatedPosts->title(); ?>
                      </a>
                    </li>
                  <?php endwhile; ?>
                </ul>
              <?php endif; ?>
              <?php $this->need('./components/article/article-copyright.php'); ?>
              <?php if (count($this->tags) !== 0) {
                $this->need('./components/article/article-tags.php');
              } ?>
            </div>
            <?php $this->need('./components/qrcode.php'); ?>
          </div>
          <?php $this->need('./components/article/article-comment.php'); ?>
        </main>
      </div>
    </div>
  </div>
<?php $this->need('footer.php'); ?>
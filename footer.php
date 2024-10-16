<footer class="footer">
  <ul>
    <li>
      <a href="<?php $this->options->siteUrl(); ?>">首页</a>
    </li>
    <?php \Widget\Contents\Page\Rows::alloc()->to($pages); ?>
    <?php while ($pages->next()): ?>
      <li>
        <a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
      </li>
    <?php endwhile; ?>
  </ul>
  <div>
    <p>
      Copyright ©
      <?php echo date('Y'); ?>
      <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
      Power by
      <a href="https://www.typecho.org" target="_blank">Typecho</a>
    </p>
    <p>
      <?php $usageInfo = getPageUsage();
      echo '页面生成时间:' . $usageInfo['page_generation_time']
        . ' 消耗内存:' . $usageInfo['memory_consumed']; ?>
    </p>
  </div>
  <?php if ($this->options->friendlyLinks) {
    $this->need('./components/friendly-link.php');
  } ?>
</footer>
<?php if ($this->options->customFooter) {
  echo $this->options->customFooter;
} ?>
<?php $this->footer(); ?>
</body>
<?php $this->need('./components/side-toolbar.php'); ?>

</html>
<?php if (!defined('__TYPECHO_ROOT_DIR__'))
  exit; ?>
<div class="col-12" id="secondary">
  <section class="col-4">
    <h3>🔥最新文章</h3>
    <ul class="sidebar-list">
      <?php $this->widget('Widget_Contents_Post_Recent')
        ->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
    </ul>
  </section>
  <section class="col-4">
    <h3>💭最近回复</h3>
    <ul class="sidebar-list">
      <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
      <?php while ($comments->next()): ?>
        <li><a href="<?php $comments->permalink(); ?>"><?php $comments->author(false); ?></a>:
          <?php $comments->excerpt(35, '...'); ?>
        </li>
      <?php endwhile; ?>
    </ul>
  </section>
  <section class="col-4">
    <h3>📅归档</h3>
    <ul class="sidebar-list">
      <?php $this->widget('Widget_Contents_Post_Date', 'type=year&format=Y')
        ->parse('<li><a href="{permalink}">{date}年</a></li>'); ?>
    </ul>
  </section>
</div>
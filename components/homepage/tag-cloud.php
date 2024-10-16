<?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=mid&ignoreZeroCount=1&desc=0&limit=45')->to($tags); ?>
<?php if ($tags->have()){ ?>
<div class="tag-cloud">
  <h3>🥳热门标签</h3>
  <div class="tag-cloud-list">
    <?php while ($tags->next()): ?>
      <a href="<?php $tags->permalink(); ?>" rel="tag"
         class="size-<?php $tags->split(5, 10, 20, 30); ?>"
         title="<?php $tags->count(); ?> 个相关"><?php $tags->name(); ?></a>
    <?php endwhile; ?>
    <?php } else {
      echo('没有任何标签');
    } ?>
  </div>
</div>
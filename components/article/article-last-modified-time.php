<div class="article-last-modified-time">
  <p>
    <?php
    $modified = $this->modified;
    $daysSinceLastUpdate = getDaysSinceLastUpdate($modified);
    echo "本文最后更新于 " . date('Y-m-d', $modified) . "，超过 $daysSinceLastUpdate 天未更新"; ?>
  </p>
</div>
<?php
$pattern = '/<img.*?src=\"(.*?)\"[^>]*>/i';
$replacement = '<a href="$1" data-fancybox="gallery" class="gallery-link" /><img class="lazyload" data-src="$1" alt="' . $this->title . '" title="点击放大图片"></a>';
$content = preg_replace($pattern, $replacement, $this->content);
echo $content;

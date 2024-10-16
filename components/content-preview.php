<?php while ($this->next()):
  $title = $this->title;
  displayArticle($this, $title);
endwhile;
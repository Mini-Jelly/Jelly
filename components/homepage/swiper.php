<?php $this->need('./utility/resource.php');
$swiper = [];
$swiper_text = $this->options->swiper;
$swiper_arr = array_map('trim', explode("\r\n", $swiper_text));
foreach ($swiper_arr as $item) {
  list($img, $url, $title) = array_map('trim', explode("||", $item));
  $swiper[] = compact('img', 'url', 'title');
}
?>
<div class="swiper">
  <div class="swiper-wrapper">
    <?php
    foreach ($swiper as $slide) {
      ?>
      <div class="swiper-slide">
        <a href="<?php echo $slide['url']; ?>">
          <img loading="lazy" alt="Loading..."
               src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAABCAQAAACx6dw/AAAAC0lEQVR42mNkAAMAAA4AAjOwv9wAAAAASUVORK5CYII="
               srcset="<?php echo $slide['img']; ?>">
        </a>
      </div>
    <?php } ?>
  </div>
  <div class="swiper-pagination"></div>
</div>
<script>const swiper = new Swiper('.swiper', {
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
      type: 'bullets',
    },
    loop: true,
    autoplay: {
      delay: 2000,
      pauseOnMouseEnter: true,
      disableOnInteraction: false,
    },
    effect: 'fade',
  })
</script>
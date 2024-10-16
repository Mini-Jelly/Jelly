<?php
function themeFields($layout)
{
  $image = new Typecho_Widget_Helper_Form_Element_Text('image', null, null, '自定义文章封面',
    '请填入图片的 URL 地址以设定本文的封面，如不填则显示默认封面。');
  $image->input->setAttribute('class', 'w-100');
  $layout->addItem($image);
}

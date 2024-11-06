<?php
function themeConfig($form)
{
  ?>
  <link rel="stylesheet" href="<?php Helper::options()->themeUrl('dist/css/style.min.css') ?>">
  <script src="<?php Helper::options()->themeUrl('dist/js/theme_config.min.js') ?>"></script>
  <script>
    document.documentElement.setAttribute('color', '<?php $themeColor = Typecho_Widget::widget('Widget_Options')->themeColor;
      echo($themeColor) ?>');
  </script>
  <div class="jelly">
    <div class="jelly-aside">
      <div class="logo">Jelly</div>
      <ul class="jelly-aside-list">
        <li class="config-item active" data-target="Global">全局设置</li>
        <li class="config-item" data-target="Home">首页设置</li>
        <li class="config-item" data-target="Article">文章设置</li>
        <li class="config-item" data-target="Other">其他设置</li>
      </ul>
    </div>
  <?php
  //主题颜色
  $themeColor = new Typecho_Widget_Helper_Form_Element_Select(
    'themeColor',
    array(
      'blue' => '蓝色(默认)',
      'red' => '红色',
      'pink' => '粉红色',
      'grape' => '葡萄色',
      'violet' => '紫罗兰色',
      'indigo' => '靛蓝色',
      'cyan' => '蓝绿色',
      'teal' => '鸭绿色',
      'green' => '绿色',
      'lime' => '酸橙绿色',
      'yellow' => '黄色',
      'orange' => '橘色',
    ),
    'blue',
    '主题颜色',
    '介绍：用于修改主题颜色'
  );
  $themeColor->setAttribute('class', 'jelly-option Global');
  $form->addInput($themeColor);

  //LOGO
  $logoUrl = new Typecho_Widget_Helper_Form_Element_Text(
    'logoUrl',
    NULL,
    NULL,
    '站点 LOGO 地址',
    '介绍：在这里填入一个图片地址<br />
         其他：不填则使用系统默认图片，或者使用图片替换原图也可以'
  );
  $logoUrl->setAttribute('class', 'jelly-option Global');
  $form->addInput($logoUrl);

  //在新窗口打开
  $openInNewWindow = new Typecho_Widget_Helper_Form_Element_Select(
    'openInNewWindow',
    array(
      'off' => '关闭 - 页内跳转',
      'on' => '打开 - 新窗口打开链接',
    ),
    'off',
    '全局新窗口打开',
    '介绍：选择新窗口是页内跳转的方式或者新窗口打开的方式</br>'
  );
  $openInNewWindow->setAttribute('class', 'jelly-option Global');
  $form->addInput($openInNewWindow);

  //使用cdn加速静态资源
  $cdnAcceleration = new Typecho_Widget_Helper_Form_Element_Select(
    'cdnAcceleration',
    array(
      'off' => '关闭（默认 - 本地）',
      'staticfile' => 'StaticfileCDN（七牛云）',
      'bootcdn' => 'BootCDN（又拍云）',
    ),
    'off',
    '是否使用cdn加速静态公共资源',
    '介绍：选择公共js和css资源是否使用CDN加速方案</br>
          说明：如果你的云主机比较卡或者网页加载速度慢可以尝试开启,关闭则默认使用本地方案</br>
          公共库Ping值检测：<a href="https://ping.chinaz.com/">站长工具</a>'
  );
  $cdnAcceleration->setAttribute('class', 'jelly-option Global');
  $form->addInput($cdnAcceleration);

  //横幅
  $banner = new Typecho_Widget_Helper_Form_Element_Text(
    'banner',
    NULL,
    'usr/themes/Jelly/assets/img/banner/banner.png',
    '主页 横幅 地址',
    '介绍：在这里填入一个图片地址用于在主页显示一个横幅，或者使用图片替换原图即可<br />
         其他：横幅可以视作广告牌，建议大小：947 x 400 px<br />
         例如：usr/themes/Jelly/assets/img/banner/banner.png'
  );
  $banner->setAttribute('class', 'jelly-option Home');
  $form->addInput($banner);

  //文章置顶功能
  $stickyCid = new Typecho_Widget_Helper_Form_Element_Text(
    'stickyCid',
    NULL,
    NULL,
    '置顶文章',
    '介绍：在这里填入一个文章的cid,在加载文章时会优先加载置顶文章<br />
         格式：数字 || 数字 || 数字 <br />
         例如：1 || 2 || 3'
  );
  $stickyCid->setAttribute('class', 'jelly-option Home');
  $form->addInput($stickyCid);

  //标签云
  $tagCloud = new Typecho_Widget_Helper_Form_Element_Select(
    'tagCloud',
    array(
      'off' => '关闭（默认）',
      'on' => '开启'
    ),
    'on',
    '标签云',
    '介绍：用于在首页显示标签云'
  );
  $tagCloud->setAttribute('class', 'jelly-option Home');
  $form->addInput($tagCloud);

  //轮播图
  $swiper = new Typecho_Widget_Helper_Form_Element_Textarea(
    'swiper',
    NULL,
    'usr/themes/Jelly/assets/img/swiper/swiper1.png||https://jjj8.top||勾勾勾8点拓
    usr/themes/Jelly/assets/img/swiper/swiper2.png||https://jjj8.top||广告招租位,
    usr/themes/Jelly/assets/img/swiper/swiper3.png||https://jjj8.top||请使用VPN访问网站',
    '轮播图',
    '介绍：用于在首页展示轮播图 <br />
         格式：图片链接 || 跳转链接 || 跳转文字 <br />
         图片建议大小：947 x 250 px <br />
         例如：<br />
         https://baidu.com/img.png || https://baidu.com || 百度一下 <br />
         https://v.qq.com/img.png || https://v.qq.com || 腾讯视频'
  );
  $swiper->setAttribute('class', 'jelly-option Home');
  $form->addInput($swiper);

  //无限滚动
  $infiniteScroll = new Typecho_Widget_Helper_Form_Element_Select(
    'infiniteScroll',
    array(
      'off' => '关闭',
      'on' => '打开（默认）',
    ),
    'on',
    '无限滚动',
    '介绍：首页加载的文章使用的加载方式</br>
         说明：打开则是无限滚动，关闭则使用分页器</br>
         如果打开了无限滚动，建议把全局新窗口也打开'
  );
  $infiniteScroll->setAttribute('class', 'jelly-option Home');
  $form->addInput($infiniteScroll);

  //友情链接
  $friendlyLinks = new Typecho_Widget_Helper_Form_Element_Textarea(
    'friendlyLinks',
    NULL,
    NULL,
    '友情链接',
    '介绍：在这里填入一个友情链接，会在文章首页的底部展示<br />
         格式：文字 || 链接<br />
         例如：百度 || https://www.baidu.com'
  );
  $friendlyLinks->setAttribute('class', 'jelly-option Home');
  $form->addInput($friendlyLinks);

  //QQ群二维码地址
  $QQkey = new Typecho_Widget_Helper_Form_Element_Text(
    'QQkey',
    NULL,
    'https://qm.qq.com/q/zqF0ZfOFIO',
    'QQ群二维码链接',
    '介绍：填入加QQ群的二维码扫出来的链接<br />
         获取：QQ群聊二维码→识别二维码的链接→复制链接→填这👍<br />
         说明：使用图片展示会失真，用链接转换成二维码减少失真'
  );
  $QQkey->setAttribute('class', 'jelly-option Article');
  $form->addInput($QQkey);

  //赞赏链接
  $PayLink = new Typecho_Widget_Helper_Form_Element_Text(
    'PayLink',
    NULL,
    'wxp://f2f0E5679e5_hY9akGin2JBkIQHe8IEHhDBPm9TywDaJ_ckyslWxJtbpPYDzDltv82Ge',
    '赞赏链接',
    '介绍：填入微信收款二维码或者支付宝收款码扫出来的链接<br />
         获取：微信或支付宝的收款链接 → 识别链接之后复制 → 填这👍<br />
         说明：使用图片展示会失真，用链接转换成二维码减少失真'
  );
  $PayLink->setAttribute('class', 'jelly-option Article');
  $form->addInput($PayLink);

  //自定义头部代码
  $customHeader = new Typecho_Widget_Helper_Form_Element_Textarea(
    'customHeader',
    NULL,
    NULL,
    '自定义头部代码',
    '介绍：用于填写头部代码，例如谷歌analyze和百度统计'
  );
  $customHeader->setAttribute('class', 'jelly-option Other');
  $form->addInput($customHeader);

  //自定义底部代码
  $customFooter = new Typecho_Widget_Helper_Form_Element_Textarea(
    'customFooter',
    NULL,
    NULL,
    '自定义底部代码',
    '介绍：用于填写底部代码，例如某些插件'
  );
  $customFooter->setAttribute('class', 'jelly-option Other');
  $form->addInput($customFooter);
}
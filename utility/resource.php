<?php
//调用文件名
$caller = basename(debug_backtrace()[1]['file']);
if ($caller === 'page.php') {
  $caller = 'post.php';
}
//选择的cdn的名称
$cdnName = $this->options->cdnAcceleration;
//定义主题目录链接
$themeUrl = $this->options->themeUrl;
// 定义所有可用的资源路径配置
$resourcesConfig = [
  'off' => [
    'header.php' => [
      '<script src="' . $themeUrl . '/assets/js/lazysizes.min.js"></script>'
    ],
    'swiper.php' => [
      '<link rel="stylesheet" href="' . $themeUrl . '/assets/css/swiper-bundle.min.css">',
      '<script src="' . $themeUrl . '/assets/js/swiper-bundle.min.js"></script>'
    ],
    'post.php' => [
      '<script src="' . $themeUrl . '/assets/js/jquery.min.js"></script>',
      '<script src="' . $themeUrl . '/assets/js/jquery.fancybox.min.js"></script>',
      '<script src="' . $themeUrl . '/assets/js/qrcode.min.js"></script>'
    ]
  ],
  'staticfile' => [
    'header.php' => ['<script src="https://cdn.staticfile.net/lazysizes/5.3.2/lazysizes.min.js"></script>'],
    'swiper.php' => [
      '<link rel="stylesheet" href="https://cdn.staticfile.net/Swiper/11.0.5/swiper-bundle.min.css">',
      '<script src="https://cdn.staticfile.net/Swiper/11.0.5/swiper-bundle.min.js"></script>'
    ],
    'post.php' => [
      '<script src="https://cdn.staticfile.net/jquery/3.7.1/jquery.min.js"></script>',
      '<script src="https://cdn.staticfile.net/fancybox/3.5.7/jquery.fancybox.min.js"></script>',
      '<script src="https://cdn.staticfile.net/qrcodejs/1.0.0/qrcode.min.js"></script>'
    ]
  ],
  'bootcdn' => [
    'header.php' => ['<script src="https://cdn.bootcdn.net/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>'],
    'swiper.php' => [
      '<link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css">',
      '<script src="https://cdn.bootcdn.net/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>'
    ],
    'post.php' => [
      '<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.7.1/jquery.min.js"></script>',
      '<script src="https://cdn.bootcdn.net/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>',
      '<script src="https://cdn.bootcdn.net/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>'
    ]
  ],
  // 添加新的CDN配置时，只需在这里扩展
];

// 获取当前CDN配置下的资源
$resources = $resourcesConfig[$cdnName] ?? [];

// 输出资源
if (!empty($resources[$caller])) {
  foreach ($resources[$caller] as $resource) {
    echo $resource;
  }
}

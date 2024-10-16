<?php if (!defined('__TYPECHO_ROOT_DIR__'))
  exit; ?>
<!DOCTYPE HTML>
<html lang="zh-cn">

<head>
  <script>
    window.Jelly = {
      THEME_URL: `<?php Helper::options()->themeUrl() ?>`,
      API_URL: `<?php echo $this->options->rewrite == 0 ? Helper::options()->rootUrl . '/index.php/jelly/api' : Helper::options()->rootUrl . '/jelly/api' ?>`,
      // IS_MOBILE: /windows phone|iphone|android/gi.test(window.navigator.userAgent),
      PAGE_SIZE: `<?php $this->parameter->pageSize() ?>`,
      TOTAL_POST: `<?php echo \Widget\Stat::alloc()->myPublishedPostsNum ?>`,
      INFINITE_SCROLL: `<?php echo $this->options->infiniteScroll ?>`
    }
  </script>
  <meta charset="<?php $this->options->charset(); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:url" content="<?php $this->permalink(); ?>">
  <meta property="og:site_name" content="<?php $this->options->title(); ?>">
  <meta property="og:description" content="<?php $this->options->description(); ?>">
  <meta name="keywords" content="<?php echo $this->options->keywords(); ?>">
  <meta name="description" content="<?php $this->options->description(); ?>">
  <meta property="og:title" content="<?php $this->archiveTitle([
    'category' => ('分类 %s 下的文章'),
    'search' => ('包含关键字 %s 的文章'),
    'tag' => ('标签 %s 下的文章'),
    'author' => ('%s 发布的文章')
  ], '', ' - '); ?><?php $this->options->title(); ?>">
  <?php if ($this->is('post') || $this->is('page')): ?>
    <meta property="og:type" content="article">
  <?php else: ?>
    <meta property="og:type" content="website">
  <?php endif; ?>
  <title>
    <?php $this->archiveTitle([
      'category' => ('分类 %s 下的文章'),
      'search' => ('包含关键字 %s 的文章'),
      'tag' => ('标签 %s 下的文章'),
      'author' => ('%s 发布的文章')
    ], '', ' - '); ?>
    <?php $this->options->title(); ?>
  </title>
  <?php if ($this->options->customHeader) {
    echo $this->options->customHeader;
  }
  if ($this->options->openInNewWindow === 'on') { ?>
    <base target="_blank" />
  <?php } ?>
  <link rel="shortcut icon" href="<?php $this->options->themeUrl('assets/img/favicon/favicon.svg'); ?>"
    type="image/x-icon">
  <?php $this->need('./utility/resource.php'); ?>
  <link rel="stylesheet" href="<?php $this->options->themeUrl('dist/css/style.min.css'); ?>">
  <script>
    const html = document.documentElement;
    if (localStorage.getItem("darkMode") === "true") {
      html.setAttribute('theme', 'dark');
    }
    html.setAttribute('color', '<?php $themeColor = $this->options->themeColor;
    echo ($themeColor) ?>');
  </script>
  <script src="<?php $this->options->themeUrl('dist/js/script.min.js'); ?>"></script>
</head>

<body>
  <?php $this->need('./components/nav.php'); ?>
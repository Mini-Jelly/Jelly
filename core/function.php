<?php
/**
 * 返回页面生成时间和页面消耗的内存
 * @return array 包含页面生成时间和页面消耗的内存的关联数组
 */
function getPageUsage(): array
{
  global $timeStart, $timeEnd;
  //使用空格分割
  $microTime = explode(' ', microtime());
  $timeEnd = $microTime[1] + $microTime[0];
  //小数点后面6位小数，单位ms
  $spendTime = number_format($timeEnd - $timeStart, 6) * 1000;
  // 记录结束时的内存使用量
  $memoryEnd = memory_get_usage();
  // 计算消耗的内存量(以MB为单位)(1048576 = 1024 * 1024)
  $memoryConsumed = number_format(($memoryEnd - $GLOBALS['memoryStart']) / 1048576, 3);
  return [
    'page_generation_time' => $spendTime . 'ms',
    'memory_consumed' => $memoryConsumed . 'Mb'
  ];
}

/**
 * 计算距离上次更新的天数
 *
 * @param int $modified 最后更新时间的时间戳
 * @return int 返回距离上次更新的天数
 */
function getDaysSinceLastUpdate(int $modified): int
{
  $lastUpdateDate = date('Y-m-d', $modified);
  $currentDate = date('Y-m-d');
  return round((strtotime($currentDate) - strtotime($lastUpdateDate)) / 86400);
}

//获取Gravatar头像 QQ邮箱取用qq头像
function getGravatar($email, $s = 96, $d = 'mp', $r = 'g', $img = false, $atts = array())
{
  preg_match_all('/((\d)*)@qq.com/', $email, $vai);
  if (empty($vai['1']['0'])) {
    $url = 'https://gravatar.loli.net/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
      $url = '<img src="' . $url . '"';
      foreach ($atts as $key => $val)
        $url .= ' ' . $key . '="' . $val . '"';
      $url .= ' />';
    }
  } else {
    $url = 'https://q2.qlogo.cn/headimg_dl?dst_uin=' . $vai['1']['0'] . '&spec=100';
  }
  return $url;
}

/**
 * 获取文章封面
 *
 * @param $obj
 * @return mixed|string
 */
function getThumbnail($obj)
{
  // 如果文章对象中已经包含了图片链接，则直接返回该链接
  if ($obj->fields->image) return $obj->fields->image;

  // 定义匹配图片标签的正则表达式
  $pattern = '/<img.*?src="(.*?)"[^>]*>/i';

  // 如果文章内容中存在图片标签，则使用正则表达式匹配获取图片链接
  if (preg_match($pattern, $obj->content, $matches))
    return $matches[1];

  // 如果文章内容中不存在图片标签，则随机选择一个主题图片链接返回
  $themeUrl = Helper::options()->themeUrl;
  return $themeUrl . '/assets/img/thumbnails/' . rand(1, 11) . '.webp';
}

function usageStart(): bool
{
  //时间
  global $timeStart;
  //使用空格分割
  $microTime = explode(' ', microtime());
  $timeStart = $microTime[1] + $microTime[0];
  //内存
  $GLOBALS['memoryStart'] = memory_get_usage();
  return true;
}

/* 获取文章摘要 */
function getExcerpt($item)
{
  $abstract = null;
  if ($item->password) {
    $abstract = "该文章需要密码才能查看";
  } else {
    $string = strip_tags($item->excerpt);//剥离字符串中的 HTML、XML 以及 PHP 的标签
    $abstract = mb_substr($string, 0, 100, 'utf8');
    //strpos查找一个字符串在另一个字符串中第一次出现的位置
    if (strpos($abstract, '{hide') !== false) {
      $abstract = preg_replace('/{hide[^}]*}([\s\S]*?){\/hide}/', '隐藏内容，请前往内页查看详情', $abstract);
    }
  }
  if ($abstract === '' || $abstract === null) $abstract = "暂无简介";
  return $abstract;
}

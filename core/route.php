<?php
function themeInit($self)
{
  if ($self->request->getPathInfo() == "/jelly/api") {
    switch ($self->request->API) {
      case 'articles':
        _getArticlesInfo($self);
        break;
      case 'comments':
        _getComments($self);
        break;
      default :
        _error($self);
        break;
    }
  }
}

function _error($self)
{
  $self->response->setStatus(404);
  $self->response->throwJson(array("r" => "Server message: Request error"));
  return null;
}

function _getArticlesInfo($self)
{
  $self->response->setStatus(200);
  //处理报文内容
  $page = $self->request->page;
  $pageSize = $self->request->pageSize;

  /* sql注入校验 */
  if (!preg_match('/^\d+$/', $page)) {
    return $self->response->throwJson(array("r" => "Server message: Illegal request"));
  }
  if (!preg_match('/^\d+$/', $pageSize)) {
    return $self->response->throwJson(array("r" => "Server message: Illegal request"));
  }

  /* 如果传入0，强制赋值1 */
  if ($page <= 0) $page = 1;
  $result = [];
  $self->widget('Widget_Contents_ArticlesInfoByCreatedTime', 'page=' . $page . '&pageSize=' . $pageSize)
    ->to($item);
  while ($item->next()) {
    $result[] = array(
      "title" => $item->title,
      "category" => $item->category,//详细信息categories
      "permalink" => $item->permalink,
      "image" => getThumbnail($item),
      "time" => date('Y-m-d', $item->created),
      "excerpt" => getExcerpt($item),
      //"commentsNum" => number_format($item->commentsNum),
    );
  }
  $self->response->throwJson(array("r" => $result));
  return null;
}

function _getComments($self)
{

}

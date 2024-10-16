<?php
class Widget_Contents_ArticlesInfoByCreatedTime extends Widget_Abstract_Contents
{
  public function execute()
  {
    $this->parameter->setDefault(array('page' => 1, 'pageSize' => 10));
    $offset = $this->parameter->pageSize * ($this->parameter->page - 1);
    $select = $this->select();
    $select->cleanAttribute('fields');//清除任何已设置的字段属性，以确保查询不会受到外部参数的影响
    $this->db->fetchAll(
      $select
        ->from('table.contents')
        ->where('table.contents.type = ?', 'post')
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.created < ?', time())
        ->limit($this->parameter->pageSize)
        ->offset($offset)
        ->order('table.contents.created', Typecho_Db::SORT_DESC),
      array($this, 'push')
    );
  }
}

class Widget_Contents_StickyArticleInfoByCid extends Widget_Abstract_Contents

{
  public function execute()
  {
    $select = $this->select();
    $select->cleanAttribute('fields');//清除任何已设置的字段属性，以确保查询不会受到外部参数的影响
    $this->db->fetchAll(
      $select
        ->from('table.contents')
        ->where('table.contents.type = ?', 'post')
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.cid = ?', $this->parameter->cid)
        ->limit(1),
      array($this, 'push')
    );
  }
}

class Widget_Contents_Hot extends Widget_Abstract_Contents
{
  public function execute()
  {
    $this->parameter->setDefault(array('pageSize' => 10));
    $select = $this->select();
    $select->cleanAttribute('fields');//清除任何已设置的字段属性，以确保查询不会受到外部参数的影响
    $this->db->fetchAll(
      $select->from('table.contents')
        ->where("table.contents.password IS NULL OR table.contents.password = ''")
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.created <= ?', time())
        ->where('table.contents.type = ?', 'post')
        ->limit($this->parameter->pageSize)
        ->order('table.contents.views', Typecho_Db::SORT_DESC),
      array($this, 'push')
    );
  }
}

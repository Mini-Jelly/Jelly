<?php if (!defined('__TYPECHO_ROOT_DIR__'))
  exit; ?>
<div class="comment">
  <?php $this->comments()->to($comments); ?>
  <?php if ($comments->have()): ?>
    <h3>
      <?php $this->commentsNum(('暂无评论'), ('仅有一条评论'), ('已有 %d 条评论')); ?>
    </h3>
    <?php $comments->listComments(); ?>
    <?php $comments->pageNav('上一页', '下一页'); ?>
  <?php endif; ?>
  <?php if ($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
      <div class="cancel-comment-reply">
        <?php $comments->cancelReply(); ?>
      </div>
      <h3 id="response">
        发表评论
      </h3>
      <form class="comment-form" id="comment-form" method="post"
            action="<?php $this->commentUrl() ?>">
        <?php if ($this->user->hasLogin()): ?>
          <p>
            ID :
            <a href="<?php $this->options->profileUrl(); ?>">
              <?php $this->user->screenName(); ?>
            </a>
            ·
            <a href="<?php $this->options->logoutUrl(); ?>"
               title="Logout">退出 &raquo;
            </a>
          </p>
        <?php else: ?>
          <div class="input-group">
            <div class="input-group-wrap">
              <label for="author">昵称：</label>
              <input type="text" name="author" id="author"
                     placeholder="昵称（必填）"
                     value="<?php $this->remember('author'); ?>"
                     required/>
            </div>
            <div class="input-group-wrap second-child">
              <label for="mail">邮箱：</label>
              <input type="email" name="mail" id="mail"
                     placeholder="邮箱（必填）"
                     value="<?php $this->remember('mail'); ?>"
                     <?php if ($this->options->commentsRequireMail): ?>required<?php endif; ?> />
            </div>
            <div class="input-group-wrap">
              <label for="url">网址：</label>
              <input type="url" name="url" id="url"
                     placeholder="网址"
                     value="<?php $this->remember('url'); ?>"
                <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
            </div>

          </div>
        <?php endif; ?>
        <textarea rows="8" cols="50" name="text" id="textarea" class="textarea"
                  placeholder="输入评论内容..."
                  required><?php $this->remember('text'); ?></textarea>
        <button type="submit" class="submit">
          发表评论
        </button>
      </form>
    </div>
  <?php else: ?>
    <h3>
      评论已关闭
    </h3>
  <?php endif; ?>
</div>
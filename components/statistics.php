<?php
echo "已发布的文章数目:" . \Widget\Stat::alloc()->publishedPostsNum;//已发布的文章数目
echo "待审核的文章数目:" . \Widget\Stat::alloc()->waitingPostsNum;//待审核的文章数目
echo "草稿文章数目:" . \Widget\Stat::alloc()->draftPostsNum;//草稿文章数目
echo "当前用户已发布的文章数目:" . \Widget\Stat::alloc()->myPublishedPostsNum;//当前用户已发布的文章数目
echo "当前用户待审核文章数目:" . \Widget\Stat::alloc()->myWaitingPostsNum;//当前用户待审核文章数目
echo "当前用户草稿文章数目:" . \Widget\Stat::alloc()->myDraftPostsNum;//当前用户草稿文章数目
echo "当前用户已发布的文章数目:" . \Widget\Stat::alloc()->currentPublishedPostsNum;//当前用户已发布的文章数目
echo "当前用户待审核文章数目:" . \Widget\Stat::alloc()->currentWaitingPostsNum;//当前用户待审核文章数目
echo "当前用户草稿文章数目:" . \Widget\Stat::alloc()->currentDraftPostsNum;//当前用户草稿文章数目
echo "已发布页面数目:" . \Widget\Stat::alloc()->publishedPagesNum;//已发布页面数目
echo "草稿页面数目:" . \Widget\Stat::alloc()->draftPagesNum;//草稿页面数目
echo "当前显示的评论数目:" . \Widget\Stat::alloc()->publishedCommentsNum;//当前显示的评论数目
echo "当前待审核的评论数目:" . \Widget\Stat::alloc()->waitingCommentsNum;//当前待审核的评论数目
echo "当前垃圾评论数目:" . \Widget\Stat::alloc()->spamCommentsNum;//当前垃圾评论数目
echo "当前用户显示的评论数目:" . \Widget\Stat::alloc()->myPublishedCommentsNum;//当前用户显示的评论数目
echo "当前用户待审核的评论数目:" . \Widget\Stat::alloc()->myWaitingCommentsNum;//当前用户待审核的评论数目
echo "当前用户垃圾评论数目:" . \Widget\Stat::alloc()->mySpamCommentsNum;//当前用户垃圾评论数目
echo "当前文章的评论数目:" . \Widget\Stat::alloc()->currentCommentsNum;//当前文章的评论数目
echo "当前文章显示的评论数目:" . \Widget\Stat::alloc()->currentPublishedCommentsNum;//当前文章显示的评论数目
echo "当前文章待审核的评论数目:" . \Widget\Stat::alloc()->currentWaitingCommentsNum;//当前文章待审核的评论数目
echo "当前文章垃圾评论数目:" . \Widget\Stat::alloc()->currentSpamCommentsNum;//当前文章垃圾评论数目
echo "分类数目:" . \Widget\Stat::alloc()->categoriesNum;//分类数目
echo "标签数目:" . \Widget\Stat::alloc()->tagsNum;//标签数目
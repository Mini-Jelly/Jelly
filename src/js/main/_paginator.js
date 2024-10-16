document.addEventListener("DOMContentLoaded", () => {

  const main = document.getElementById("main");

  // 创建 AbortController 实例
  // let controller = new AbortController();
  // let signal = controller.signal;

  //删除Article的内容
  const deleteArticleContent = () => {
    const articles = main.querySelectorAll("article");
    if (articles.length !== 0) {
      articles.forEach(article => {
        article.remove();
      });
    }
  }

  const calcOffsetHeight = () => {
    const firstArticle = document.querySelector('article');// 获取第一个 article 标签
    if (firstArticle) {
      return firstArticle.offsetTop;
    }
  }

  if (Jelly.INFINITE_SCROLL === 'off') {
    // let currentPage = 1;//初始化当前访问页面
    //使用事件委托机制，将点击事件绑定到分页器上
    document.getElementById('paginator').addEventListener('click', function (event) {
      // 确保点击的是页码元素
      if (event.target && event.target.matches('li a')) {
        // 获取点击的页码
        let pageNum = event.target.textContent;
        // if (event.target && event.target.matches('li a') && !event.target.parentElement.classList.contains('prev') && !event.target.parentElement.classList.contains('next')) {
        //
        // }
        // 移除具有active类的li元素的active类
        this.querySelector('li.active').classList.remove('active');
        // 为点击的li元素添加active类
        event.target.parentElement.classList.add('active');

        fetchArticlesInfo(pageNum).then(data => {
            deleteArticleContent();
            insertData(data, main);
            scrollTo(calcOffsetHeight());
          }
        );
      }
    });
  }
});

//计算页码
const calcPageNum = () => {
  return Math.ceil(Jelly.TOTAL_POST / Jelly.PAGE_SIZE);
}

//插入分页器
const insertPaginator = () => {
  let fragment = document.createDocumentFragment();// 创建一个 DocumentFragment
  // 循环创建并添加多个 li 元素到 DocumentFragment 中
  let pageNum = calcPageNum();
  let ulElement = document.createElement('ul');
  ulElement.className = "paginator";
  ulElement.id = "paginator";
  for (let i = 1; i <= pageNum; i++) {
    let li = document.createElement('li');
    if (i === 1) {
      li.className = "active";
    }
    let a = document.createElement("a");
    a.innerText = i.toString();
    li.appendChild(a);
    ulElement.appendChild(li);
  }
  fragment.appendChild(ulElement); // 将 ulElement 添加到 fragment 中
  const bodyElement = document.getElementById("body");
  bodyElement.appendChild(fragment);// 将 DocumentFragment 一次性插入到目标父元素中
}
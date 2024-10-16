//获取内容模板
const getTemplate = _ => {
  return `<article class="article-entry"><div class="article-cover"><a href="${_.permalink}" title="${_.title}"></a><img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="${_.image}" alt="${_.title}"></div><div class="article-info"><header class="article-info-header"><h2><a href="${_.permalink}" title="${_.title}">${_.title}</a></h2></header><div class="article-info-content"><p>${_.excerpt}</p></div><footer class="article-info-footer"><span>${_.category}·${_.time}</span></footer></div><a href="${_.permalink}" class="entry-link" title="${_.title}"></a></article>`;
}
//插入数据
const insertData = (obj, e) => {
  let fragment = document.createDocumentFragment();// 创建一个 DocumentFragment
  // 循环创建并添加多个 article 元素到 DocumentFragment 中
  for (let i = 0; i < obj.length; i++) {
    let article = getTemplate(obj[i]);
    let div = document.createElement('div');// 将 article 字符串转换为 DOM 元素
    div.innerHTML = article.trim(); // 去除字符串两端的空白字符
    let articleElement = div.firstChild;
    fragment.appendChild(articleElement);
  }
  e.appendChild(fragment);// 将 DocumentFragment 一次性插入到目标父元素中
}
//初始化内容
const initArticleContent = () => {
  const mainElement = document.getElementById("main");
  fetchArticlesInfo(1).then(data => insertData(data, mainElement));
}

let controller = null;

//发送请求获取文章的信息
const fetchArticlesInfo = page => {

  // 如果之前有未完成的请求，先取消掉
  if (controller) {
    controller.abort();
  }

  // 创建一个新的 AbortController
  controller = new AbortController();
  const signal = controller.signal;

  return fetch(Jelly.API_URL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
      'Accept': 'application/json, text/javascript, */*; q=0.01'
    },
    signal: signal, // 将 signal 传递给 fetch 请求
    body: 'API=articles&page=' + page + '&pageSize=' + Jelly.PAGE_SIZE,
  })
    .then(response => {
      if (!response.ok) {
        console.error("Client message: Request failed");
      } else {
        return response.json();
      }
    })
    .then((data) => {
      if (data.r.length !== 0) {
        return data.r;
      } else {
        console.log("Client message: No available data");
        return -1; // 用于错误处理
      }
    })
    .catch(error => {
      switch (error.name) {
        case 'AbortError':
          console.log("Client message: Request canceled");
          return -1;
        default :
          console.error('Client Error:', error);
          break
      }
    });
}

//滚动指定距离
const scrollBy = (scrollDistance, delay = 300) => {
  setTimeout(() => {
    window.scrollBy({
      top: scrollDistance,
      behavior: 'smooth',
    });
  }, delay);
}

//滚动到指定位置
const scrollTo = (scrollDistance, delay = 300) => {
  setTimeout(() => {
    window.scrollTo({
      top: scrollDistance,
      behavior: 'smooth',
    });
  }, delay);
}
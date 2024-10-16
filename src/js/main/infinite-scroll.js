document.addEventListener("DOMContentLoaded", () => {
  const currentPage = {
    value: 2,
  };

  const nav = document.getElementById("nav");
  const main = document.getElementById("main");
  const loadMoreButton = document.getElementById("load-more-btn");
  const loadMoreBox = document.getElementById("load-more-box");

  //计算高度偏移
  const calcHeightOffset = () => {
    const boxTop = loadMoreBox.getBoundingClientRect().top; //获取位置高度
    const boxMarginTop = parseInt(window.getComputedStyle(loadMoreBox).marginTop); //内部高度
    return boxTop - boxMarginTop - nav.offsetHeight;
  };

  let loadMoreDate;
  if (Jelly.INFINITE_SCROLL === "on" && loadMoreButton) {
    loadMoreButton.addEventListener("click", (loadMoreDate = () => {
        let scrollDistance = calcHeightOffset(); //一定是放在数据获取之前
        fetchArticlesInfo(currentPage.value).then((data) => {
          if (data !== -1) {
            insertData(data, main);
            loadMoreButton.disabled = false;
            currentPage.value++;
            scrollBy(scrollDistance); // 数据加载完成后执行滚动操作
            if (data.length < Jelly.PAGE_SIZE) {
              loadMoreButton.textContent = "到底啦";
              loadMoreButton.disabled = true;
              loadMoreButton.removeEventListener("click", loadMoreDate);
            }
          }
        });
      })
    );
  }
});
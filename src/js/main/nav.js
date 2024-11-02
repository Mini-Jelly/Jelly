// import { getById } from "./global";
// 页面DOM加载事件
document.addEventListener("DOMContentLoaded", function () {
  const nav = getById("nav");
  const mnav = getById("mnav");

  //获取触发按钮,触发按钮动画并根据css效果打开菜单
  getById("mnav-menu-trigger-button").addEventListener("click", function () {
    // 锁定按钮,防止频繁点击
    lockElement(this, Math.max(window.innerHeight, 480) / 2 + 80);

    // 如果当前处于 open 状态
    if (mnav.hasAttribute("open")) {
      // 移除 open 状态
      mnav.removeAttribute("open");
      runNavCloseAnimation();
    } else {
      mnav.setAttribute("open", "");
      runNavOpenAnimation();
    }
    addNavFlyoutDelay();
  });

  //鼠标进入时添加特效
  const addMouseEffect = (event) => {
    const element = event.currentTarget;
    if (getWindowWidth() > 833) {
      const X = event.offsetX;
      const Y = event.offsetY;
      element.style.backgroundImage = `radial-gradient(100px at ${X}px ${Y}px, rgba(255,255,255,0.2), rgba(255,255,255,0))`;
    }
  };

  //鼠标移出时清除特效
  const removeMouseEffect = (event) => {
    const element = event.currentTarget;
    if (getWindowWidth() > 833) {
      element.style.backgroundImage = "none";
    }
  };

  //添加监听，触发鼠标移动效果(win10的菜单动画效果)
  const nav_form_open_btn = getById("nav-form-open-button");
  const logo = document.querySelector(".nav-logo");
  nav_form_open_btn.addEventListener("mousemove", addMouseEffect);
  nav_form_open_btn.addEventListener("mouseleave", removeMouseEffect);
  logo.addEventListener("mousemove", addMouseEffect);
  logo.addEventListener("mouseleave", removeMouseEffect);
  document.querySelectorAll(".nav-list li a").forEach((a) => {
    a.addEventListener("mousemove", addMouseEffect);
    a.addEventListener("mouseleave", removeMouseEffect);
  });

  //关闭搜索
  nav_form_open_btn.addEventListener("click", toggleSearchBox);
  getById("nav-form-close-button").addEventListener("click", toggleSearchBox);

  // 在此添加要在页面加载时自动执行的函数
  addNum();
  addNavFlyoutDelay();

  //给li标签添加数字标号的style
  function addNum() {
    // 获取列表项
    const mChildren = mnav.querySelectorAll("li");
    const children = nav.querySelectorAll("li");
    // 为每个列表项设置样式
    const setListItemStyles = (items) => {
      items.forEach((child, index) => {
        child.style.setProperty("--list-item-number", index);
      });
    };
    setListItemStyles(mChildren);
    setListItemStyles(children);
    // 检查两个列表的长度是否相等
    if (mChildren.length === children.length) {
      document.documentElement.style.setProperty("--list-item-total", children.length);
    } else {
      console.log("非法的分类！");
    }
  }

  //根据屏幕高度计算导航栏飞出延迟时间
  function addNavFlyoutDelay() {
    // 获取屏幕高度
    const screenHeight = Math.max(window.innerHeight, 480);
    // 将屏幕高度计算成速度映射到CSS中
    document.documentElement.style.setProperty("--flyout-rate", `${screenHeight / 2}ms`);
  }

  //搜索状态控制
  function toggleSearchBox() {
    if (nav.hasAttribute("search")) {
      nav.removeAttribute("search");
    } else {
      nav.setAttribute("search", "");
      const inputBox = getById("nav-form-input");
      setTimeout(() => {
        inputBox.focus();
      }, 100);
      //影响原因:.nav-content .nav-form {transition-duration:.2s;...}
      //存在问题:小于等于16时inputBox.focus()执行失效
      //解决办法:未解决,临时让数值大于16
      //发生时间:2024-02-28_14-15-49
    }
  }

  //获取窗口宽度
  function getWindowWidth() {
    return Math.max(window.innerWidth || 0, document.documentElement.clientWidth || 0, document.body.clientWidth || 0);
  }

  //锁定一个元素
  function lockElement(element, time) {
    element.disabled = true;
    setTimeout(function unlockElement() {
      element.disabled = false;
    }, time);
  }

  //执行按钮的打开动画
  function runNavOpenAnimation() {
    getById("mnav-anim-menu-trigger-bread-top-open").beginElement();
    getById("mnav-anim-menu-trigger-bread-bottom-open").beginElement();
  }

  //执行按钮的关闭动画
  function runNavCloseAnimation() {
    getById("mnav-anim-menu-trigger-bread-top-close").beginElement();
    getById("mnav-anim-menu-trigger-bread-bottom-close").beginElement();
  }
});

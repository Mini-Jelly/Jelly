document.addEventListener("DOMContentLoaded", function () {
  const html = document.documentElement;
  const darkModeBtn = document.getElementById("DarkModeBtn");
  const scrollToTopBtn =document.getElementById("scrollToTopBtn");
  darkModeBtn.addEventListener("click", ()=>{
    this.disabled = true;

    setTimeout(() => {
      this.disabled = false;
    }, 200);

    const isDarkMode = html.hasAttribute('theme');

    if (isDarkMode) {
      // 切换到默认模式
      localStorage.removeItem("darkMode");
      html.removeAttribute('theme');
    } else {
      // 切换到夜间模式
      html.setAttribute('theme', 'dark');
      localStorage.setItem("darkMode", "true");
    }
  });

  scrollToTopBtn.addEventListener("click",()=>{
    scrollTo(0,0);
  })

});

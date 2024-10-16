const gulp = require("gulp");
const concat = require("gulp-concat"); //合并js
const cssmin = require("gulp-cssmin"); //压缩css
const uglify = require("gulp-uglify"); //压缩js
const rename = require("gulp-rename"); //重命名
const sass = require("gulp-sass")(require("sass")); //scss转换到css
const clean = require("gulp-clean"); //删除目录任务
const autoPrefixer = require("gulp-autoprefixer"); //兼容版本
const sourcemaps = require("gulp-sourcemaps"); //定位源代码
const fs = require("fs"); // 用于检查文件系统
// const babel = require("gulp-babel"); //ES6->ES5 用法：.pipe(babel({ presets: ["@babel/env"] }))

function cleanFile() {
  const pathsToClean = ["./dist", "./temp"];

  // 检查每个路径是否存在
  const existingPaths = pathsToClean.filter(path => fs.existsSync(path));

  // 仅清除存在的路径
  return gulp.src(existingPaths, { read: false, allowEmpty: true }) // 允许空目录
    .pipe(clean())
    .on('error', (err) => {
      console.error('Cleaning error:', err.message); // 处理错误
    });
}

// 编译并重命名scss文件
const compileSass = function () {
  return gulp
    .src(["./src/scss/**/*.scss", "!./src/scss/**/_*.scss"])
    .pipe(sass())
    // .pipe(rename({basename: "scss", extname: ".css"}))
    .pipe(gulp.dest("./temp/css"));
};

// 复制lib中的css文件
const copyLibCss = function () {
  return gulp
    .src(["./src/lib/css/*.css"])
    .pipe(rename({basename: "lib", extname: ".css"}))
    .pipe(gulp.dest("./temp/css"));
};

// 合并处理生成最终样式文件
const mergeAndMinifyTempCss = function () {
  return gulp
    .src(["./temp/css/*.css"])
    .pipe(concat("cssTemp.css")) //合并
    .pipe(autoPrefixer())//兼容版本
    .pipe(cssmin())//压缩css
    .pipe(rename({basename: "style", suffix: ".min", extname: ".css"}))
    .pipe(gulp.dest("./dist/css"));
};

//合并生成样式文件和map文件
const mergeTempCssAndGenerateMap = function () {
  return gulp
    .src(["./temp/css/*.css"])
    .pipe(concat("cssTemp.css")) //合并
    .pipe(sourcemaps.init()) //map初始化
    .pipe(rename({basename: "style", suffix: ".min", extname: ".css"}))
    .pipe(sourcemaps.write("./")) //写出map文件
    .pipe(gulp.dest("./dist/css"));
};

// 处理所有文件并生成css
function buildCss(done) {
  // 组合任务并返回
  return gulp.series(compileSass, copyLibCss, mergeAndMinifyTempCss)(done);
}

function buildJs() {
  return (
    gulp
      .src(["src/js/main/*.js", "src/lib/*.js", "!src/js/main/_*.js"]) //找到源文件
      .pipe(concat("jsTemp.js")) //合并
      .pipe(uglify()) //压缩js
      .pipe(rename({basename: "script", suffix: ".min", extname: ".js"}))
      .pipe(gulp.dest("./dist/js")), //设置保存位置;
      gulp
        .src(["./src/js/theme_config/*.js"]) //找到源文件
        .pipe(concat("jsTemp.js")) //合并
        .pipe(uglify()) //压缩js
        .pipe(rename({basename: "theme_config", suffix: ".min", extname: ".js"}))
        .pipe(gulp.dest("./dist/js")) //设置保存位置;
  );
}

//开发模式
function watch() {
  cssDev();
  jsDev();
  gulp.watch("./src/scss/**/*.scss", cssDev);
  gulp.watch("./src/js/**/*.js", jsDev);
}

const cssDev = function (done) {
  // 组合任务并返回
  return gulp.series(compileSass, copyLibCss, mergeTempCssAndGenerateMap)(done);
};


function jsDev() {
  return (
    gulp
      .src(["src/js/main/*.js", "src/js/lib/*.js"])
      .pipe(sourcemaps.init()) //初始化map
      .pipe(concat("script.min.js")) //合并
      //.pipe(rename({basename: "script", suffix: ".min", extname: ".js"}))
      .pipe(sourcemaps.write("./")) //写出map文件
      .pipe(gulp.dest("./dist/js")), //设置保存位置
      gulp
        .src(["./src/js/theme_config/*.js"]) //找到源文件
        .pipe(sourcemaps.init()) //初始化map
        .pipe(concat("theme_config.min.js")) //合并
        //.pipe(rename({basename: "theme_config", suffix: ".min", extname: ".js"}))
        .pipe(sourcemaps.write("./")) //写出map文件
        .pipe(gulp.dest("./dist/js")) //设置保存位置;
  );
}

//导出任务
module.exports.compileSass = compileSass;
module.exports.copyLibCss = copyLibCss;
module.exports.mergeAndMinifyTempCss = mergeAndMinifyTempCss;
module.exports.mergeTempCssAndGenerateMap = mergeTempCssAndGenerateMap;

module.exports.cleanFile = cleanFile;

module.exports.buildCss = buildCss;
module.exports.buildJs = buildJs;

module.exports.cssDev = cssDev;
module.exports.jsDev = jsDev;

module.exports.watch = watch;

//默认任务
//方式1
//gulp.task("default", () => {});
//方式2
// module.exports.default = gulp.parallel(A, B, C);
module.exports.default = gulp.series(cleanFile, gulp.parallel(buildCss, buildJs));
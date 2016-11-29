var gulp = require("gulp");
var less = require("gulp-less");
var LessAutoprefix = require('less-plugin-autoprefix');
var autoprefix = new LessAutoprefix({ browsers: ['last 2 versions'] });
var concat = require('gulp-concat');
var minify = require('gulp-minify');
var browserSync = require("browser-sync").create();

/*
 *compilation less file
 */
gulp.task("less", function(){
    return gulp.src("css/main.less")
        .pipe(less({
            plugins: [autoprefix]
        }))
        .pipe(gulp.dest("css/"));
});

/*
 *contact css and js
 */
gulp.task("pack-js", function(){
    return gulp.src(["./js/jquery.min.js", "./js/bootstrap.min.js", "./js/main.js"])
        .pipe(concat("all.js"))
        //.pipe(minify({
            //ext: {
                //min: ".js"
            //}
        //}))
        .pipe(gulp.dest("./js/"));
});


//gulp.task('pack-css', function () {	
	//return gulp.src(['assets/css/main.css', 'assets/css/custom.css'])
    //.pipe(concat('stylesheet.css'))
    //.pipe(gulp.dest('public/build/css'));
//});

//gulp.task("pack-asset", ["pack-js", "pack-css"]);

/*
 *live reload page 
 */
gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: {
            target: "www.liveabc.local"
        }
    });

    gulp.watch('./*.php').on('change', function () {
        browserSync.reload();
    });
});

gulp.task("watch", function(){
    gulp.watch("css/main.less", ["less"]);
    gulp.watch("./js/*.js", ["pack-js"]);
});



var gulp               = require('gulp'),
    scsslint           = require('gulp-scss-lint'),
    config = {
        src: 'resources/assets',
        sass: 'sass'
    };

gulp.task('lint-sass', function() {
  return gulp.src([
            config.src + '/' + config.sass + '/{,**/}*.scss',
                '!' + config.src + '/' + config.sass + '/Mixins/Mixins.scss',
                '!' + config.src + '/' + config.sass + '/Components/AutoComplete.scss',
                '!' + config.src + '/' + config.sass + '/Vendor/{,**/}*.scss',
            ])
            .pipe(scsslint({
                'config': 'scsslint.yml'
            }));
});

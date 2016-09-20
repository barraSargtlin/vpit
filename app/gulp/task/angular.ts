import {exec} from '../shell';
import {jspm as config} from '../config';

const gulp = require('gulp');
const rimraf = require('rimraf');
const watch = require('gulp-sane-watch');

const build = (): Promise => {
    const {source} = config.application.angular;

    return exec('ngc', ['--project', source], false);
};

gulp.task('angular:build', build);

gulp.task('angular:watch', () => {
    const source = config.application.angular.watch;
    const compileHelperFile = ((filename: string): boolean => /\.(ngfactory\.ts|js)$/.test(filename));

    return watch(source, {debounce: 200, verbose: false}, (filename) => {
        if (!compileHelperFile(filename)) {
            build();
        }
    });
});

// not called automatically as it's no part of the build process
gulp.task('angular:clear', () => {
    const {source} = config.application.angular;

    rimraf.sync(`${source}/app/**/*.js`);
    rimraf.sync(`${source}/app/**/*.ngfactory.ts`);
    rimraf.sync(`${source}/node_modules`);
});

import './vendor';

import {enableProdMode} from '@angular/core';
import {platformBrowserDynamic} from '@angular/platform-browser-dynamic';
import {AppModule} from 'app/app.module';

// import modules generated by symfony (see ProvidePlugin for Translator)
import 'web/bundles/fosjsrouting/js/router';
import 'web/js/fos_js_routes';
import 'web/js/translations/de.js';
import 'web/js/translations/en.js';

if (process.env.NODE_ENV === 'production') {
    enableProdMode();
}

// will be replaced JIT by @ngtools/webpack/src/loader.js for angular AOT in production
platformBrowserDynamic().bootstrapModule(AppModule);

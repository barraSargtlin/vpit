/**
 * injected either via
 * - webpack plugin 'DefinePlugin'
 * - webpack plugin 'ProvidePlugin'
 * - backend template 'base.html.twig'
 */

declare var process: Process;

type Env = 'dev'|'test'|'prod';
type Process = {
    env: {
        ENV: Env;
        NODE_ENV: Env;
    };
}

interface AppInject {
    baseUrl: string;
    requestLocale: string;
    authenticated: boolean;
}
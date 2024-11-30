import glob from 'fast-glob';
import { readFileSync } from 'node:fs';
import { createRequire } from 'node:module';
import { fileURLToPath } from 'node:url';
import { defineConfig } from 'vite';
import symfonyPlugin from 'vite-plugin-symfony';

/**
 * @param {string} path
 */
const createAbsoluteUrl = (path) => fileURLToPath(new URL(path, import.meta.url));

const require = createRequire(import.meta.url);

export default defineConfig(({ mode }) => ({
  plugins: [
    symfonyPlugin({
      stimulus: {
        controllersFilePath: './assets/js/controllers.json',
        hmr: true,
      },
      debug: mode === 'development',
      viteDevServerHostname: 'localhost',
      refresh: true,
    }),
  ],
  build: {
    rollupOptions: {
      input: {
        app: './assets/js/app.js',
        appTheme: './assets/css/app.scss',
      },
    }
  },
  server: mode !== 'production' && {
    host: '0.0.0.0',
    cors: true,
    watch: {
      ignored: [
        `${glob.escapePath(process.cwd())}/vendor/*/**`,
        `${glob.escapePath(process.cwd())}/@(public|var|.yarn)/**`,
      ],
    }
  },
  resolve: {
    alias: {
      $js: createAbsoluteUrl('./assets/js'),
      $types: createAbsoluteUrl('./assets/js/types'),
      $utils: createAbsoluteUrl('./assets/js/utils'),
      $app: createAbsoluteUrl('./assets/js/app'),
      $styles: createAbsoluteUrl('./assets/css'),
    }
  }
}));

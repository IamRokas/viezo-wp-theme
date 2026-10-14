import fs from 'node:fs';
import path from 'node:path';
import { defineConfig } from 'vite';
import basicSsl from '@vitejs/plugin-basic-ssl';
import svgSprites from './scripts/vite-svg-sprites.js';

const root = import.meta.dirname;
const outDir = path.resolve(root, 'build');
const hotFile = path.resolve(outDir, 'hot');
const devPort = 5173;

/**
 * Copy src/images to build/images (PHP templates reference them directly).
 */
function copyImages() {
	return {
		name: 'viezo:copy-images',
		apply: 'build',
		writeBundle() {
			fs.cpSync(path.resolve(root, 'src/images'), path.resolve(outDir, 'images'), {
				recursive: true,
			});
		},
	};
}

/**
 * Dev server integration for WordPress:
 * - writes build/hot so inc/scripts.php loads assets from the dev server,
 * - fully reloads the page when a PHP template changes.
 */
function wordpress() {
	return {
		name: 'viezo:wordpress',
		apply: 'serve',
		configureServer(server) {
			server.httpServer?.once('listening', () => {
				fs.mkdirSync(outDir, { recursive: true });
				fs.writeFileSync(hotFile, `https://localhost:${devPort}`);
			});

			const clean = () => fs.rmSync(hotFile, { force: true });
			process.on('exit', clean);
			process.on('SIGINT', () => process.exit());
			process.on('SIGTERM', () => process.exit());

			server.watcher.add(path.resolve(root, '**/*.php'));
			server.watcher.on('change', (file) => {
				if (file.endsWith('.php')) {
					server.ws.send({ type: 'full-reload' });
				}
			});
		},
	};
}

export default defineConfig({
	base: './',
	publicDir: false,
	resolve: {
		alias: {
			'@images': path.resolve(root, 'src/images'),
			'@fonts': path.resolve(root, 'src/fonts'),
		},
	},
	plugins: [svgSprites(), copyImages(), wordpress(), basicSsl()],
	css: {
		devSourcemap: true,
		preprocessorOptions: {
			scss: {
				silenceDeprecations: ['import', 'global-builtin'],
			},
		},
	},
	server: {
		host: 'localhost',
		port: devPort,
		strictPort: true,
		origin: `https://localhost:${devPort}`,
		cors: { origin: /^https?:\/\/viezo\.local$/ },
	},
	build: {
		outDir,
		emptyOutDir: true,
		assetsDir: '',
		cssCodeSplit: false,
		target: 'es2019',
		// Keep SVGs inlined in CSS as data URIs (matches the old webpack setup).
		assetsInlineLimit: (file) => (file.endsWith('.svg') ? true : undefined),
		rollupOptions: {
			input: path.resolve(root, 'src/index.js'),
			output: {
				format: 'iife',
				entryFileNames: 'index.js',
				assetFileNames: (asset) => {
					const name = asset.names?.[0] ?? '';

					if (name.endsWith('.css')) {
						return 'main.css';
					}

					if (/\.(woff2?|ttf|eot)$/.test(name)) {
						return 'fonts/[name][extname]';
					}

					return 'images/[name][extname]';
				},
			},
		},
	},
});

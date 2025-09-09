// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';


// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//         }),
//     ],
// });

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0', // biar bisa diakses dari ngrok / jaringan lain
        port: 5173,
        strictPort: true,
        https: false, // kalau pakai ngrok https sudah di-handle oleh ngrok, jadi di sini tetap false
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});


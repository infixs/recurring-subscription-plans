import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import { resolve } from 'path'

export default defineConfig({
  plugins: [vue()],
  base: process.env.APP_ENV == 'development'  ? '/' : '/wp-content/plugins/recurring-subscription-plans/assets/vue/dist',
  resolve: {
    alias: {
      "@": resolve(__dirname, "./src")
    },
  },
  build: {
    // output dir for production build
    outDir: resolve(__dirname, '../assets/vue/dist'),
    emptyOutDir: true,

    // emit manifest so PHP can find the hashed files
    manifest: true,

    // esbuild target
    target: 'es2018',

    // our entry
    rollupOptions: {
      input: {
        main: 'src/main.js',
      }
    }
  }
})

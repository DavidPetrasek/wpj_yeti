import { defineConfig, loadEnv } from "vite";
import symfonyPlugin from "vite-plugin-symfony";
import tailwindcss from "@tailwindcss/vite";
import fs from "fs";


const ENV_LOCAL = loadEnv('development', './');

export default defineConfig({
    plugins: [
        symfonyPlugin({
            stimulus: 
            {
                controllersDir: './assets/scripts/controllers', 
                hmr: true
            }
        }),
        tailwindcss(),
    ],
    build: 
    {
        assetsInlineLimit: 0,
        rollupOptions: 
        {
            input: 
            {
                app: "./assets/scripts/app.js"
            },
        }
    },
    server: 
    {
        host: '127.0.0.1', // Pouze IPv4
        https: 
        {
        	key: fs.readFileSync(ENV_LOCAL.VITE_LOCAL_CERT_KEY),
        	cert: fs.readFileSync(ENV_LOCAL.VITE_LOCAL_CERT_CRT),
        },
        cors: true
    }
});
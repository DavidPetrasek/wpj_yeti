import '../../styles/tailwind/index.css';


// Zahrnutí souborů pro zpracování do produkce
import.meta.glob([
    '../../img/**',
    '../../audio/**',
    '../../video/**'
], { eager: true});
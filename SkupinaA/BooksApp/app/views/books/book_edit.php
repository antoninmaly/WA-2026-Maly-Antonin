<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knihovna - Upravit knihu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Inter:wght@300;400;600&display=swap');
        
        body { font-family: 'Inter', sans-serif; }
        .serif { font-family: 'Playfair Display', serif; }
        
        .gold-gradient {
            background: linear-gradient(135deg, #d4af37 0%, #f9e29c 50%, #b8860b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Styl pro inputy ladící s tmavým tématem */
        input, textarea {
            background-color: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            transition: all 0.3s ease;
        }
        input:focus, textarea:focus {
            border-color: #d4af37 !important;
            background-color: rgba(255, 255, 255, 0.07) !important;
            outline: none;
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.1);
        }
        input[readonly] {
            color: #666 !important;
            cursor: not-allowed;
            background-color: rgba(255, 255, 255, 0.01) !important;
        }
    </style>
</head>
<body class="bg-[#0f0f0f] text-gray-200 min-h-screen">

    <header class="bg-black/80 backdrop-blur-md border-b border-white/10 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 py-5 flex flex-col md:flex-row justify-between items-center">
            <h1 class="serif text-3xl font-bold tracking-tight mb-4 md:mb-0 text-white">
                Aplikace <span class="gold-gradient">Knihovna</span>
            </h1>

            <nav>
                <ul class="flex space-x-8 text-[11px] uppercase tracking-[0.2em] font-semibold text-white/70">
                    <li>
                        <a href="<?= BASE_URL ?>/index.php" class="hover:text-[#d4af37] transition-all duration-300 pb-1 border-b border-transparent hover:border-[#d4af37]">Seznam knih (Domů)</a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>/index.php?url=book/create" class="hover:text-[#d4af37] transition-all duration-300 pb-1 border-b border-transparent hover:border-[#d4af37]">Přidat novou knihu</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-12">
        
        <div class="mb-12 border-b border-white/5 pb-6 text-center">
            <h2 class="serif text-4xl text-white italic leading-tight uppercase tracking-tight">Upravit záznam</h2>
            <div class="h-0.5 w-16 bg-[#d4af37] mt-4 mx-auto"></div>
            <p class="text-neutral-500 text-sm tracking-widest uppercase italic mt-4">
                Kniha: <span class="text-white not-italic font-semibold"><?= htmlspecialchars($book['title']) ?></span>
            </p>
        </div>

        <div class="bg-neutral-900/30 border border-white/5 p-8 md:p-12 rounded-sm shadow-2xl">
            <form action="<?= BASE_URL ?>/index.php?url=book/update/<?= htmlspecialchars($book['id']) ?>" method="post" enctype="multipart/form-data" class="space-y-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <div class="flex flex-col space-y-2">
                        <label class="text-[10px] uppercase tracking-[0.2em] text-neutral-500 font-bold">ID v databázi</label>
                        <input type="text" value="<?= htmlspecialchars($book['id']) ?>" readonly class="px-4 py-3 rounded-sm font-mono text-xs">
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label for="title" class="text-[10px] uppercase tracking-[0.2em] text-[#d4af37] font-bold">Název knihy <span class="text-rose-500">*</span></label>
                        <input type="text" id="title" name="title" value="<?= htmlspecialchars($book['title']) ?>" class="px-4 py-3 rounded-sm" required>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label for="author" class="text-[10px] uppercase tracking-[0.2em] text-[#d4af37] font-bold">Autor <span class="text-rose-500">*</span></label>
                        <input type="text" id="author" name="author" value="<?= htmlspecialchars($book['author']) ?>" class="px-4 py-3 rounded-sm" required>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label for="isbn" class="text-[10px] uppercase tracking-[0.2em] text-[#d4af37] font-bold">ISBN <span class="text-rose-500">*</span></label>
                        <input type="text" id="isbn" name="isbn" value="<?= htmlspecialchars($book['isbn']) ?>" class="px-4 py-3 rounded-sm" required>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label for="category" class="text-[10px] uppercase tracking-[0.2em] text-[#d4af37] font-bold">Kategorie</label>
                        <input type="text" id="category" name="category" value="<?= htmlspecialchars($book['category']) ?>" class="px-4 py-3 rounded-sm">
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label for="subcategory" class="text-[10px] uppercase tracking-[0.2em] text-neutral-500 font-bold">Podkategorie</label>
                        <input type="text" id="subcategory" name="subcategory" value="<?= htmlspecialchars($book['subcategory'] ?? '') ?>" class="px-4 py-3 rounded-sm">
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label for="year" class="text-[10px] uppercase tracking-[0.2em] text-[#d4af37] font-bold">Rok vydání <span class="text-rose-500">*</span></label>
                        <input type="number" id="year" name="year" value="<?= htmlspecialchars($book['year']) ?>" class="px-4 py-3 rounded-sm" required>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label for="price" class="text-[10px] uppercase tracking-[0.2em] text-[#d4af37] font-bold">Cena knihy (Kč)</label>
                        <input type="number" id="price" name="price" step="0.5" value="<?= htmlspecialchars($book['price']) ?>" class="px-4 py-3 rounded-sm">
                    </div>
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="link" class="text-[10px] uppercase tracking-[0.2em] text-neutral-500 font-bold">Externí odkaz (URL)</label>
                    <input type="text" id="link" name="link" value="<?= htmlspecialchars($book['link']) ?>" class="px-4 py-3 rounded-sm">
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="description" class="text-[10px] uppercase tracking-[0.2em] text-neutral-500 font-bold">Popis knihy</label>
                    <textarea id="description" name="description" rows="5" class="px-4 py-3 rounded-sm italic"><?= htmlspecialchars($book['description']) ?></textarea>
                </div>

                <div class="flex flex-col space-y-4">
                    <label class="text-[10px] uppercase tracking-[0.2em] text-neutral-500 font-bold text-center block italic">Aktualizovat obrázky (můžete ignorovat)</label>
                    <label for="images" class="border-2 border-dashed border-white/10 hover:border-[#d4af37]/50 hover:bg-white/5 transition-all cursor-pointer rounded-sm p-8 text-center flex flex-col items-center group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-neutral-600 group-hover:text-[#d4af37] transition-colors mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-xs text-white group-hover:text-[#d4af37] transition-colors uppercase tracking-widest font-bold">Nahrát nové fotografie</span>
                        <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden">
                    </label>
                </div>

                <div class="pt-6 border-t border-white/5 flex flex-col items-center space-y-4">
                    <button type="submit" class="bg-gradient-to-r from-[#b8860b] via-[#f9e29c] to-[#d4af37] text-black px-12 py-4 rounded-sm text-xs font-bold uppercase tracking-[0.3em] hover:brightness-110 hover:shadow-[0_0_20px_rgba(212,175,55,0.2)] transition-all">
                        Uložit změny v databázi
                    </button>
                    <a href="<?= BASE_URL ?>/index.php" class="text-[10px] uppercase tracking-widest text-neutral-500 hover:text-white transition-colors">
                        Zrušit úpravy
                    </a>
                </div>

            </form>
        </div>
    </main>

    <footer class="mt-24 py-12 border-t border-white/5 text-center">
        <p class="text-neutral-600 text-[10px] uppercase tracking-[0.5em] font-bold">
            &copy; WA - 2026 - Výukový projekt
        </p>
    </footer>

</body>
</html>
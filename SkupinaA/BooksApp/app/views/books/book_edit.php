<?php 
// Dynamický titulek stránky podle upravované knihy
$pageTitle = "Upravit knihu - " . $book['title']; 
// Načtení sdílené hlavičky
require_once '../app/views/layout/header.php'; 
?>

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
                <input type="text" value="<?= htmlspecialchars($book['id']) ?>" readonly class="px-4 py-3 rounded-sm font-mono text-xs opacity-50">
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

<?php 
// Načtení sdílené patičky
require_once '../app/views/layout/footer.php'; 
?>
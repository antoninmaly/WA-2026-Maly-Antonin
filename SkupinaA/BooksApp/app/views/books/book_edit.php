<?php 
$pageTitle = "Upravit knihu - " . $book['title']; 
require_once '../app/views/layout/header.php'; 
?>

<div class="mb-12 border-b border-blue-500/10 pb-6 text-center">
    <h2 class="text-4xl text-white font-extrabold uppercase tracking-tighter">Upravit záznam</h2>
    <div class="h-1 w-12 bg-blue-600 mt-4 mx-auto"></div>
    <p class="text-blue-500/50 text-xs tracking-widest uppercase font-bold mt-4">
        Kniha: <span class="text-white font-black"><?= htmlspecialchars($book['title']) ?></span>
    </p>
</div>

<div class="bg-[#000814]/60 border border-blue-500/10 p-8 md:p-12 rounded-sm shadow-2xl">
    <form action="<?= BASE_URL ?>/index.php?url=book/update/<?= htmlspecialchars($book['id']) ?>" method="post" enctype="multipart/form-data" class="space-y-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="flex flex-col space-y-2">
                <label class="text-[10px] uppercase tracking-[0.2em] text-blue-900 font-black">ID v databázi</label>
                <input type="text" value="<?= htmlspecialchars($book['id']) ?>" readonly class="px-4 py-3 rounded-sm font-mono text-xs opacity-40">
            </div>

            <div class="flex flex-col space-y-2">
                <label for="title" class="text-[10px] uppercase tracking-[0.2em] text-blue-400 font-black">Název knihy <span class="text-rose-500">*</span></label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($book['title']) ?>" class="px-4 py-3 rounded-sm" required>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="author" class="text-[10px] uppercase tracking-[0.2em] text-blue-400 font-black">Autor <span class="text-rose-500">*</span></label>
                <input type="text" id="author" name="author" value="<?= htmlspecialchars($book['author']) ?>" class="px-4 py-3 rounded-sm" required>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="isbn" class="text-[10px] uppercase tracking-[0.2em] text-blue-400 font-black">ISBN <span class="text-rose-500">*</span></label>
                <input type="text" id="isbn" name="isbn" value="<?= htmlspecialchars($book['isbn']) ?>" class="px-4 py-3 rounded-sm" required>
            </div>

            <div class="flex flex-col space-y-2 text-slate-200">
                <label for="category" class="text-[10px] uppercase tracking-[0.2em] text-blue-400 font-black">
                    Kategorie <span class="text-rose-500">*</span>
                </label>
                
                <select id="category" name="category" 
                    class="px-4 py-3 rounded-sm bg-slate-800 text-white border border-slate-700 focus:ring-2 focus:ring-blue-400 focus:border-transparent outline-none appearance-none cursor-pointer" 
                    required>
                    
                    <option value="" disabled <?= empty($book['category']) ? 'selected' : '' ?> class="bg-slate-800 text-slate-400">
                        -- Vyberte kategorii --
                    </option>
                    
                    <?php foreach ($categories as $cat): ?>
                        <?php $isSelected = ($book['category'] == $cat['id']) ? 'selected' : ''; ?>
                        <option value="<?= htmlspecialchars($cat['id']) ?>" <?= $isSelected ?> class="bg-slate-800 text-white">
                            <?= htmlspecialchars($cat['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="year" class="text-[10px] uppercase tracking-[0.2em] text-blue-400 font-black">Rok vydání <span class="text-rose-500">*</span></label>
                <input type="number" id="year" name="year" value="<?= htmlspecialchars($book['year']) ?>" class="px-4 py-3 rounded-sm" required>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="price" class="text-[10px] uppercase tracking-[0.2em] text-blue-400 font-black">Cena knihy (Kč)</label>
                <input type="number" id="price" name="price" step="0.5" value="<?= htmlspecialchars($book['price']) ?>" class="px-4 py-3 rounded-sm">
            </div>
        </div>

        <div class="pt-8 border-t border-blue-500/10 space-y-6">
            <label class="text-[10px] uppercase tracking-[0.2em] text-blue-900 font-black block">Aktuálně nahrané obrázky</label>
            <div class="flex flex-wrap gap-4">
                <?php 
                $images = json_decode($book['images'] ?? '[]', true);
                if (!empty($images)): 
                    foreach ($images as $img): ?>
                        <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($img) ?>" class="h-20 w-20 object-cover rounded-sm border border-blue-500/10 opacity-50">
                    <?php endforeach; 
                endif; ?>
            </div>
            
            <label for="images" class="border-2 border-dashed border-blue-500/10 hover:border-blue-500/40 hover:bg-blue-600/5 transition-all cursor-pointer rounded-sm p-8 text-center flex flex-col items-center group">
                <span id="file-title" class="text-xs text-white group-hover:text-blue-400 transition-colors uppercase tracking-widest font-black">Klikni pro výběr nových souborů</span>
                <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden">
            </label>
            <p class="text-[9px] text-rose-500 uppercase tracking-tighter italic text-center">Upozornění: Nahrání nových souborů nahradí ty stávající.</p>
        </div>

        <div class="pt-10 border-t border-blue-500/10 flex flex-col items-center space-y-4">
            <button type="submit" class="bg-blue-600 text-white px-12 py-4 rounded-sm text-xs font-black uppercase tracking-[0.3em] hover:bg-blue-500 transition-all shadow-lg">
                Uložit změny v databázi
            </button>
            <a href="<?= BASE_URL ?>/index.php" class="text-[10px] font-bold uppercase tracking-widest text-blue-900 hover:text-white transition-colors">Zrušit úpravy</a>
        </div>

    </form>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>
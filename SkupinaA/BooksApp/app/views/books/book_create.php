<?php 
$pageTitle = "Přidat novou knihu"; 
require_once '../app/views/layout/header.php'; 
?>

<div class="mb-12 border-b border-blue-500/10 pb-6 text-center">
    <h2 class="text-4xl text-white font-extrabold uppercase tracking-tighter">Přidat novou knihu</h2>
    <div class="h-1 w-12 bg-blue-600 mt-4 mx-auto"></div>
    <p class="text-blue-500/50 text-xs tracking-widest uppercase font-bold mt-4">Vyplňte údaje a uložte knihu do databáze</p>
</div>

<div class="bg-[#000814]/60 border border-blue-500/10 p-8 md:p-12 rounded-sm shadow-2xl">
    <form action="<?= BASE_URL ?>/index.php?url=book/store" method="post" enctype="multipart/form-data" class="space-y-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="flex flex-col space-y-2">
                <label for="title" class="text-[10px] uppercase tracking-[0.2em] text-blue-400 font-black">Název knihy <span class="text-rose-500">*</span></label>
                <input type="text" id="title" name="title" class="px-4 py-3 rounded-sm" required>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="author" class="text-[10px] uppercase tracking-[0.2em] text-blue-400 font-black">Autor <span class="text-rose-500">*</span></label>
                <input type="text" id="author" name="author" placeholder="Příjmení Jméno" class="px-4 py-3 rounded-sm" required>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="isbn" class="text-[10px] uppercase tracking-[0.2em] text-blue-400 font-black">ISBN <span class="text-rose-500">*</span></label>
                <input type="text" id="isbn" name="isbn" class="px-4 py-3 rounded-sm" required>
            </div>

            <div class="flex flex-col space-y-2 text-slate-200">
                <label for="category" class="text-[10px] uppercase tracking-[0.2em] text-blue-400 font-black">
                    Kategorie <span class="text-rose-500">*</span>
                </label>
    
                <select id="category" name="category" 
                    class="px-4 py-3 rounded-sm bg-slate-800 text-white border border-slate-700 focus:ring-2 focus:ring-blue-400 focus:border-transparent outline-none appearance-none cursor-pointer" 
                    required>
        
                    <option value="" disabled selected class="bg-slate-800 text-slate-400">-- Vyberte kategorii --</option>
                    
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= htmlspecialchars($cat['id']) ?>" class="bg-slate-800 text-white">
                            <?= htmlspecialchars($cat['name']) ?>
                        </option>
                    <?php endforeach; ?>
        
                </select>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="subcategory" class="text-[10px] uppercase tracking-[0.2em] text-blue-900 font-black">Podkategorie</label>
                <input type="text" id="subcategory" name="subcategory" class="px-4 py-3 rounded-sm">
            </div>

            <div class="flex flex-col space-y-2">
                <label for="year" class="text-[10px] uppercase tracking-[0.2em] text-blue-400 font-black">Rok vydání <span class="text-rose-500">*</span></label>
                <input type="number" id="year" name="year" class="px-4 py-3 rounded-sm" required>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="price" class="text-[10px] uppercase tracking-[0.2em] text-blue-400 font-black">Cena knihy (Kč)</label>
                <input type="number" id="price" name="price" step="0.5" class="px-4 py-3 rounded-sm">
            </div>

            <div class="flex flex-col space-y-2">
                <label for="link" class="text-[10px] uppercase tracking-[0.2em] text-blue-900 font-black">Odkaz (URL)</label>
                <input type="text" id="link" name="link" class="px-4 py-3 rounded-sm">
            </div>
        </div>

        <div class="flex flex-col space-y-2">
            <label for="description" class="text-[10px] uppercase tracking-[0.2em] text-blue-900 font-black">Popis knihy</label>
            <textarea id="description" name="description" rows="5" class="px-4 py-3 rounded-sm">Popis knihy: </textarea>
        </div>

        <div class="flex flex-col space-y-4">
            <label class="text-[10px] uppercase tracking-[0.2em] text-blue-400 font-black text-center block">Obrázky knihy (můžete nahrát více)</label>
            <label for="images" class="border-2 border-dashed border-blue-500/10 hover:border-blue-500/40 hover:bg-blue-600/5 transition-all cursor-pointer rounded-sm p-8 text-center flex flex-col items-center group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-900 group-hover:text-blue-600 transition-colors mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span id="file-title" class="text-xs text-white group-hover:text-blue-400 transition-colors uppercase tracking-widest font-black">Klikni pro výběr souborů</span>
                <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden">
            </label>
        </div>

        <div class="pt-6 border-t border-blue-500/10 flex justify-center">
            <button type="submit" class="bg-blue-600 text-white px-12 py-4 rounded-sm text-xs font-black uppercase tracking-[0.3em] hover:bg-blue-500 transition-all shadow-lg">
                Uložit knihu do DB
            </button>
        </div>
    </form>
</div>

<script>
    const fileInput = document.getElementById('images');
    const fileTitle = document.getElementById('file-title');

    fileInput.addEventListener('change', function(event) {
        const files = event.target.files;
        if (files.length > 0) {
            fileTitle.textContent = files.length === 1 ? 'Soubor připraven' : 'Soubory připraveny (' + files.length + ')';
            fileTitle.className = 'text-xs text-blue-400 uppercase tracking-widest font-black';
        }
    });
</script>

<?php require_once '../app/views/layout/footer.php'; ?>
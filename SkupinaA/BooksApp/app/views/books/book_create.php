<?php 
// Nastavení titulku stránky pro hlavičku
$pageTitle = "Přidat novou knihu"; 
// Načtení sdílené hlavičky (obsahuje <head>, navigaci i Flash zprávy)
require_once '../app/views/layout/header.php'; 
?>

<div class="mb-12 border-b border-white/5 pb-6 text-center">
    <h2 class="serif text-4xl text-white italic leading-tight">Přidat novou knihu</h2>
    <div class="h-0.5 w-16 bg-[#d4af37] mt-4 mx-auto"></div>
    <p class="text-neutral-500 text-sm tracking-widest uppercase italic mt-4">Vyplňte údaje a uložte knihu do databáze</p>
</div>

<div class="bg-neutral-900/30 border border-white/5 p-8 md:p-12 rounded-sm shadow-2xl">
    <form action="<?= BASE_URL ?>/index.php?url=book/store" method="post" enctype="multipart/form-data" class="space-y-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="flex flex-col space-y-2">
                <label for="title" class="text-[10px] uppercase tracking-[0.2em] text-[#d4af37] font-bold">Název knihy <span class="text-rose-500">*</span></label>
                <input type="text" id="title" name="title" class="px-4 py-3 rounded-sm" required>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="author" class="text-[10px] uppercase tracking-[0.2em] text-[#d4af37] font-bold">Autor <span class="text-rose-500">*</span></label>
                <input type="text" id="author" name="author" placeholder="Příjmení Jméno" class="px-4 py-3 rounded-sm" required>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="isbn" class="text-[10px] uppercase tracking-[0.2em] text-[#d4af37] font-bold">ISBN <span class="text-rose-500">*</span></label>
                <input type="text" id="isbn" name="isbn" class="px-4 py-3 rounded-sm" required>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="category" class="text-[10px] uppercase tracking-[0.2em] text-[#d4af37] font-bold">Kategorie <span class="text-rose-500">*</span></label>
                <input type="text" id="category" name="category" class="px-4 py-3 rounded-sm" required>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="subcategory" class="text-[10px] uppercase tracking-[0.2em] text-neutral-500 font-bold">Podkategorie</label>
                <input type="text" id="subcategory" name="subcategory" class="px-4 py-3 rounded-sm">
            </div>

            <div class="flex flex-col space-y-2">
                <label for="year" class="text-[10px] uppercase tracking-[0.2em] text-[#d4af37] font-bold">Rok vydání <span class="text-rose-500">*</span></label>
                <input type="number" id="year" name="year" class="px-4 py-3 rounded-sm" required>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="price" class="text-[10px] uppercase tracking-[0.2em] text-[#d4af37] font-bold">Cena knihy (Kč)</label>
                <input type="number" id="price" name="price" step="0.5" class="px-4 py-3 rounded-sm">
            </div>

            <div class="flex flex-col space-y-2">
                <label for="link" class="text-[10px] uppercase tracking-[0.2em] text-neutral-500 font-bold">Odkaz (URL)</label>
                <input type="text" id="link" name="link" class="px-4 py-3 rounded-sm">
            </div>
        </div>

        <div class="flex flex-col space-y-2">
            <label for="description" class="text-[10px] uppercase tracking-[0.2em] text-neutral-500 font-bold">Popis knihy</label>
            <textarea id="description" name="description" rows="5" class="px-4 py-3 rounded-sm italic">Popis knihy: </textarea>
        </div>

        <div class="flex flex-col space-y-4">
            <label class="text-[10px] uppercase tracking-[0.2em] text-[#d4af37] font-bold text-center block">Obrázky knihy (můžete nahrát více)</label>
            <label for="images" class="border-2 border-dashed border-white/10 hover:border-[#d4af37]/50 hover:bg-white/5 transition-all cursor-pointer rounded-sm p-8 text-center flex flex-col items-center group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-neutral-600 group-hover:text-[#d4af37] transition-colors mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span id="file-title" class="text-xs text-white group-hover:text-[#d4af37] transition-colors uppercase tracking-widest font-bold">
            Klikni pro výběr souborů
            </span>
            <span id="file-info" class="text-[10px] text-neutral-600 uppercase mt-1 tracking-tighter">
            JPG / PNG / WebP
            </span>
        
            <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden">
            </label>
        </div>

        <div class="pt-6 border-t border-white/5 flex justify-center">
            <button type="submit" class="bg-gradient-to-r from-[#b8860b] via-[#f9e29c] to-[#d4af37] text-black px-12 py-4 rounded-sm text-xs font-bold uppercase tracking-[0.3em] hover:brightness-110 hover:shadow-[0_0_20px_rgba(212,175,55,0.2)] transition-all">
                Uložit knihu do DB
            </button>
        </div>

    </form>
</div>

<script>
    // Najdeme naše HTML prvky podle ID
    const fileInput = document.getElementById('images');
    const fileTitle = document.getElementById('file-title');
    const fileInfo = document.getElementById('file-info');

    // Posloucháme událost 'change' (změna hodnoty v inputu)
    fileInput.addEventListener('change', function(event) {
        const files = event.target.files;
        
        if (files.length === 0) {
            // Uživatel výběr zrušil - vracíme původní vzhled
            fileTitle.textContent = 'Klikni pro výběr souborů';
            fileTitle.className = 'text-xs text-white uppercase tracking-widest font-bold';
            fileInfo.textContent = 'JPG / PNG / WebP';
        } else if (files.length === 1) {
            // Vybrán 1 soubor - změníme text na zlatý
            fileTitle.textContent = 'Soubor připraven';
            fileTitle.className = 'text-xs text-[#d4af37] uppercase tracking-widest font-bold';
            fileInfo.textContent = files[0].name;
        } else {
            // Vybráno více souborů - změníme text na zlatý a ukážeme počet
            fileTitle.textContent = 'Soubory připraveny';
            fileTitle.className = 'text-xs text-[#d4af37] uppercase tracking-widest font-bold';
            fileInfo.textContent = 'Vybráno celkem: ' + files.length + ' souborů';
        }
    });
</script>

<?php 
// Načtení sdílené patičky
require_once '../app/views/layout/footer.php'; 
?>
<?php 
// Dynamický titulek stránky
$pageTitle = "Detail knihy - " . $book['title']; 
require_once '../app/views/layout/header.php'; 
?>

<div class="mb-12 border-b border-white/5 pb-6">
    <a href="<?= BASE_URL ?>/index.php" class="text-[10px] uppercase tracking-widest text-[#d4af37] hover:text-white transition-colors">
        &larr; Zpět na seznam knih
    </a>
    <h2 class="serif text-4xl text-white italic mt-4"><?= htmlspecialchars($book['title']) ?></h2>
    <p class="text-neutral-500 text-sm tracking-widest uppercase italic"><?= htmlspecialchars($book['author']) ?></p>
</div>

<div class="flex gap-4">
    <?php 
    // Dekódování JSON řetězce z databáze na pole
    $images = json_decode($book['images'] ?? '[]', true); 
    
    if (!empty($images)): 
        foreach ($images as $img): ?>
            <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($img) ?>" 
                 alt="Obálka knihy" 
                 class="w-48 h-auto border border-white/10">
        <?php endforeach; 
    else: ?>
        <p>Tato kniha nemá žádný obrázek.</p>
    <?php endif; ?>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-12">
    <div class="md:col-span-2 space-y-8">
        <div class="bg-neutral-900/30 border border-white/5 p-8 rounded-sm">
            <h3 class="text-[#d4af37] text-xs font-bold uppercase tracking-[0.2em] mb-4">Popis díla</h3>
            <p class="text-gray-300 leading-relaxed italic">
                <?= nl2br(htmlspecialchars($book['description'])) ?>
            </p>
        </div>

        <?php if (!empty($book['link'])): ?>
            <div class="pt-4">
                <a href="<?= htmlspecialchars($book['link']) ?>" target="_blank" class="inline-block bg-white/5 border border-white/10 px-6 py-3 text-xs uppercase tracking-widest hover:bg-[#d4af37] hover:text-black transition-all">
                    Externí odkaz na knihu &rarr;
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="space-y-6">
        <div class="bg-black/40 border border-white/5 p-6 space-y-4">
            <h3 class="text-white text-xs font-bold uppercase tracking-[0.2em] border-b border-white/10 pb-2">Parametry</h3>
            
            <div class="flex justify-between text-sm">
                <span class="text-neutral-500">ISBN:</span>
                <span class="text-gray-200 font-mono"><?= htmlspecialchars($book['isbn']) ?></span>
            </div>
            
            <div class="flex justify-between text-sm">
                <span class="text-neutral-500">Rok vydání:</span>
                <span class="text-gray-200"><?= htmlspecialchars($book['year']) ?></span>
            </div>

            <div class="flex justify-between text-sm">
                <span class="text-neutral-500">Kategorie:</span>
                <span class="text-gray-200"><?= htmlspecialchars($book['category']) ?></span>
            </div>

            <?php if (!empty($book['subcategory'])): ?>
                <div class="flex justify-between text-sm">
                    <span class="text-neutral-500">Podkategorie:</span>
                    <span class="text-gray-200"><?= htmlspecialchars($book['subcategory']) ?></span>
                </div>
            <?php endif; ?>

            <div class="flex justify-between items-center pt-4 border-t border-white/10">
                <span class="text-neutral-500">Cena:</span>
                <span class="text-[#d4af37] text-xl font-bold"><?= number_format($book['price'], 0, ',', ' ') ?> Kč</span>
            </div>
        </div>

        <div class="flex flex-col space-y-2">
            <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>" class="text-center text-[10px] py-3 border border-[#d4af37]/30 text-[#d4af37] uppercase tracking-widest hover:bg-[#d4af37] hover:text-black transition-all">
                Upravit údaje
            </a>
        </div>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>
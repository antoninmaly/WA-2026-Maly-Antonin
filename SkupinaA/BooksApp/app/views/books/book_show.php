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

<div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
    
    <div class="lg:col-span-4">
        <div class="sticky top-8 space-y-6">
            <?php 
            $images = json_decode($book['images'] ?? '[]', true); 
            
            if (!empty($images)): ?>
                <div class="border border-white/10 p-2 bg-neutral-900/30 shadow-2xl">
                    <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($images[0]) ?>" 
                         alt="Obálka knihy" 
                         class="w-full h-auto rounded-sm">
                </div>
                
                <?php if (count($images) > 1): ?>
                    <div class="grid grid-cols-4 gap-2">
                        <?php foreach (array_slice($images, 1) as $img): ?>
                            <div class="border border-white/5 p-1 bg-neutral-900/50">
                                <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($img) ?>" 
                                     class="w-full h-16 object-cover opacity-60 hover:opacity-100 transition-all cursor-pointer">
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
            <?php else: ?>
                <div class="aspect-[3/4] bg-neutral-900/50 border border-dashed border-white/10 flex items-center justify-center">
                    <span class="text-[10px] uppercase tracking-widest text-neutral-600 font-bold">Bez obálky</span>
                </div>
            <?php endif; ?>

            <?php if (!empty($book['link'])): ?>
                <a href="<?= htmlspecialchars($book['link']) ?>" target="_blank" class="block w-full text-center bg-white/5 border border-white/10 py-4 text-[10px] uppercase tracking-[0.2em] text-neutral-400 hover:text-[#d4af37] hover:border-[#d4af37]/50 transition-all">
                    Externí odkaz na knihu &rarr;
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="lg:col-span-8 space-y-8">
        
        <div class="bg-black/40 border border-white/5 p-8 space-y-6">
            <h3 class="text-white text-xs font-bold uppercase tracking-[0.2em] border-b border-white/10 pb-2">Parametry</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4">
                <div class="flex justify-between text-sm border-b border-white/5 pb-2">
                    <span class="text-neutral-500 uppercase tracking-tighter text-[10px]">ISBN:</span>
                    <span class="text-gray-200 font-mono"><?= htmlspecialchars($book['isbn']) ?></span>
                </div>
                
                <div class="flex justify-between text-sm border-b border-white/5 pb-2">
                    <span class="text-neutral-500 uppercase tracking-tighter text-[10px]">Rok vydání:</span>
                    <span class="text-gray-200"><?= htmlspecialchars($book['year']) ?></span>
                </div>

                <div class="flex justify-between text-sm border-b border-white/5 pb-2">
                    <span class="text-neutral-500 uppercase tracking-tighter text-[10px]">Kategorie:</span>
                    <span class="text-gray-200"><?= htmlspecialchars($book['category']) ?></span>
                </div>

                <?php if (!empty($book['subcategory'])): ?>
                    <div class="flex justify-between text-sm border-b border-white/5 pb-2">
                        <span class="text-neutral-500 uppercase tracking-tighter text-[10px]">Podkategorie:</span>
                        <span class="text-gray-200"><?= htmlspecialchars($book['subcategory']) ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="flex justify-between items-center pt-8">
                <div>
                    <span class="text-neutral-500 text-[10px] uppercase tracking-widest block mb-1">Cena díla</span>
                    <span class="text-[#d4af37] text-4xl font-light"><?= number_format($book['price'], 0, ',', ' ') ?> Kč</span>
                </div>
                
                <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>" class="px-10 py-4 border border-[#d4af37]/30 text-[#d4af37] text-[10px] uppercase tracking-[0.3em] font-bold hover:bg-[#d4af37] hover:text-black transition-all">
                    Upravit údaje
                </a>
            </div>
        </div>

        <div class="bg-neutral-900/30 border border-white/5 p-8 rounded-sm">
            <h3 class="text-[#d4af37] text-xs font-bold uppercase tracking-[0.2em] mb-4">Popis díla</h3>
            <p class="text-gray-300 leading-relaxed italic">
                <?= nl2br(htmlspecialchars($book['description'] ?? 'Popis není k dispozici.')) ?>
            </p>
        </div>

    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>
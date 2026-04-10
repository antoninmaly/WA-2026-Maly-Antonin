<?php 
$pageTitle = "Detail knihy - " . $book['title']; 
require_once '../app/views/layout/header.php'; 
?>

<div class="mb-12 border-b border-blue-500/10 pb-6">
    <a href="<?= BASE_URL ?>/index.php" class="text-[10px] font-bold uppercase tracking-widest text-blue-400 hover:text-white transition-colors">
        &larr; Zpět na seznam knih
    </a>
    <h2 class="text-4xl text-white font-extrabold uppercase tracking-tighter mt-4"><?= htmlspecialchars($book['title']) ?></h2>
    <p class="text-blue-500/50 text-xs tracking-widest uppercase font-bold"><?= htmlspecialchars($book['author']) ?></p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
    
    <div class="lg:col-span-4">
        <div class="sticky top-24 space-y-6">
            <?php 
            $images = json_decode($book['images'] ?? '[]', true); 
            if (!empty($images)): ?>
                <div class="border border-blue-500/10 p-2 bg-[#000814] shadow-2xl">
                    <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($images[0]) ?>" alt="Obálka knihy" class="w-full h-auto rounded-sm">
                </div>
            <?php else: ?>
                <div class="aspect-[3/4] bg-[#000814] border border-dashed border-blue-500/20 flex items-center justify-center">
                    <span class="text-[10px] uppercase tracking-widest text-blue-900 font-black">Bez obálky</span>
                </div>
            <?php endif; ?>

            <?php if (!empty($book['link'])): ?>
                <a href="<?= htmlspecialchars($book['link']) ?>" target="_blank" class="block w-full text-center bg-blue-600/10 border border-blue-500/20 py-4 text-[10px] uppercase tracking-widest text-blue-400 hover:bg-blue-600 hover:text-white transition-all">
                    Externí odkaz na knihu &rarr;
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="lg:col-span-8 space-y-8">
        
        <div class="bg-[#000814] border border-blue-500/10 p-8 space-y-6">
            <h3 class="text-white text-xs font-black uppercase tracking-widest border-b border-blue-500/10 pb-2">Parametry</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4">
                <div class="flex justify-between text-sm border-b border-blue-500/5 pb-2">
                    <span class="text-blue-900 uppercase font-black text-[10px]">ISBN:</span>
                    <span class="text-gray-300 font-mono"><?= htmlspecialchars($book['isbn']) ?></span>
                </div>
                <div class="flex justify-between text-sm border-b border-blue-500/5 pb-2">
                    <span class="text-blue-900 uppercase font-black text-[10px]">Rok vydání:</span>
                    <span class="text-gray-300 font-bold"><?= htmlspecialchars($book['year']) ?></span>
                </div>
                <div class="flex justify-between text-sm border-b border-blue-500/5 pb-2">
                    <span class="text-blue-900 uppercase font-black text-[10px]">Kategorie:</span>
                    <span class="text-gray-300 font-bold"><?= htmlspecialchars($book['category']) ?></span>
                </div>
            </div>

            <div class="flex justify-between items-center pt-8">
                <div>
                    <span class="text-blue-900 text-[10px] font-black uppercase block mb-1">Cena díla</span>
                    <span class="text-white text-4xl font-black tracking-tighter"><?= number_format($book['price'], 0, ',', ' ') ?> <span class="text-blue-600 text-2xl">Kč</span></span>
                </div>
                
                <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>" class="px-10 py-4 bg-blue-600 text-white text-[10px] uppercase font-black tracking-widest hover:bg-blue-500 transition-all shadow-lg">
                    Upravit údaje
                </a>
            </div>
        </div>

        <div class="bg-blue-900/5 border border-blue-500/5 p-8 rounded-sm">
            <h3 class="text-blue-500 text-xs font-black uppercase tracking-widest mb-4">Popis díla</h3>
            <p class="text-gray-400 leading-relaxed font-medium">
                <?= nl2br(htmlspecialchars($book['description'] ?? 'Popis není k dispozici.')) ?>
            </p>
        </div>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>
<?php 
$pageTitle = "Seznam knih"; 
require_once '../app/views/layout/header.php'; 
?>

<div class="flex flex-col md:flex-row md:items-end justify-between mb-12 border-b border-white/5 pb-6">
    <div>
        <h2 class="serif text-4xl text-white italic leading-tight">Dostupné knihy</h2>
        <div class="h-0.5 w-16 bg-[#d4af37] mt-2"></div>
    </div>
    <div class="mt-4 md:mt-0">
        <p class="text-neutral-500 text-sm tracking-widest uppercase italic">Katalog svazků</p>
    </div>
</div>

<?php if (empty($books)): ?>
    <div class="bg-neutral-900/50 border border-neutral-800 p-20 text-center">
        <p class="text-neutral-500 serif italic text-xl">V databázi se zatím nenachází žádné knihy.</p>
    </div>
<?php else: ?>
    <div class="grid grid-cols-1 gap-1">
        <div class="hidden md:grid grid-cols-12 gap-4 px-8 py-4 text-[10px] uppercase tracking-[0.3em] text-neutral-500 font-bold">
            <div class="col-span-1 italic">ID</div>
            <div class="col-span-4">Název & Autor</div>
            <div class="col-span-2 text-center">Rok vydání</div>
            <div class="col-span-2 text-right">Cena</div>
            <div class="col-span-3 text-right uppercase">Akce</div>
        </div>

        <?php foreach ($books as $book): ?>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 px-8 py-8 items-center bg-neutral-900/20 hover:bg-neutral-800/40 border border-white/5 mb-1 transition-all duration-500 group">
                
                <div class="col-span-1 text-neutral-600 font-mono text-xs italic">
                    #<?= htmlspecialchars($book['id']) ?>
                </div>
                
                <div class="col-span-12 md:col-span-4">
                    <h3 class="text-white text-lg font-semibold group-hover:text-[#d4af37] transition-colors duration-300">
                        <?= htmlspecialchars($book['title']) ?>
                    </h3>
                    <p class="text-neutral-500 text-sm uppercase tracking-widest"><?= htmlspecialchars($book['author']) ?></p>
                </div>
                
                <div class="col-span-4 md:col-span-2 text-left md:text-center text-neutral-400 font-light">
                    <?= htmlspecialchars($book['year']) ?>
                </div>
                
                <div class="col-span-8 md:col-span-2 text-left md:text-right">
                    <span class="text-white font-semibold whitespace-nowrap"><?= number_format($book['price'], 0, ',', ' ') ?> Kč</span>
                </div>
                
                <div class="col-span-12 md:col-span-3 flex justify-start md:justify-end items-center space-x-4 mt-4 md:mt-0 pt-4 md:pt-0 border-t border-white/5 md:border-0">
                    <a href="<?= BASE_URL ?>/index.php?url=book/show/<?= $book['id'] ?>" class="text-[10px] px-3 py-1.5 border border-white/10 rounded-sm uppercase tracking-widest text-neutral-400 hover:text-white">Detail</a>
                    <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>" class="text-[10px] px-3 py-1.5 border border-[#d4af37]/20 rounded-sm uppercase tracking-widest text-[#d4af37] hover:text-[#f9e29c]">Upravit</a>
                    <a href="<?= BASE_URL ?>/index.php?url=book/delete/<?= $book['id'] ?>" onclick="return confirm('Opravdu chcete tuto knihu smazat?')" class="text-[10px] px-3 py-1.5 border border-rose-900/30 rounded-sm uppercase tracking-widest text-rose-500/70 hover:text-rose-400">Smazat</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once '../app/views/layout/footer.php'; ?>
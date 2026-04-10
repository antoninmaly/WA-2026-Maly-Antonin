<?php 
$pageTitle = "Seznam knih"; 
require_once '../app/views/layout/header.php'; 
?>

<div class="flex flex-col md:flex-row md:items-end justify-between mb-12 border-b border-blue-500/10 pb-6">
    <div>
        <h2 class="text-4xl text-white font-extrabold uppercase tracking-tighter">Dostupné knihy</h2>
        <div class="h-1 w-12 bg-blue-600 mt-2"></div>
    </div>
    <div class="mt-4 md:mt-0">
        <p class="text-blue-500/50 text-xs tracking-widest uppercase font-bold text-right">Katalog svazků</p>
    </div>
</div>

<?php if (empty($books)): ?>
    <div class="bg-[#000814] border border-blue-500/10 p-20 text-center">
        <p class="text-blue-500 font-bold uppercase tracking-widest">V databázi se zatím nenachází žádné knihy.</p>
    </div>
<?php else: ?>
    <div class="grid grid-cols-1 gap-1">
        <div class="hidden md:grid grid-cols-12 gap-4 px-8 py-4 text-[10px] uppercase tracking-[0.3em] text-blue-900 font-black">
            <div class="col-span-1">ID</div>
            <div class="col-span-4">Název & Autor</div>
            <div class="col-span-2 text-center">Rok vydání</div>
            <div class="col-span-2 text-right">Cena</div>
            <div class="col-span-3 text-right">Akce</div>
        </div>

        <?php foreach ($books as $book): ?>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 px-8 py-8 items-center bg-[#000814]/40 hover:bg-blue-900/10 border border-blue-500/5 mb-1 transition-all duration-300 group">
                
                <div class="col-span-1 text-blue-900 font-mono text-xs font-bold">
                    #<?= htmlspecialchars($book['id']) ?>
                </div>
                
                <div class="col-span-12 md:col-span-4">
                    <h3 class="text-white text-lg font-bold group-hover:text-blue-400 transition-colors truncate">
                        <?= htmlspecialchars($book['title']) ?>
                    </h3>
                    <p class="text-blue-500/40 text-[10px] uppercase font-bold tracking-widest"><?= htmlspecialchars($book['author']) ?></p>
                </div>
                
                <div class="col-span-4 md:col-span-2 text-left md:text-center text-gray-400">
                    <?= htmlspecialchars($book['year']) ?>
                </div>
                
                <div class="col-span-8 md:col-span-2 text-left md:text-right">
                    <span class="text-white font-bold whitespace-nowrap px-2"><?= number_format($book['price'], 0, ',', ' ') ?> Kč</span>
                </div>
                
                <div class="col-span-12 md:col-span-3 flex justify-start md:justify-end items-center space-x-2 mt-4 md:mt-0 pt-4 md:pt-0 border-t border-blue-500/10 md:border-0">
                    <a href="<?= BASE_URL ?>/index.php?url=book/show/<?= $book['id'] ?>" class="text-[9px] px-3 py-2 bg-blue-600/10 border border-blue-500/20 uppercase tracking-widest text-blue-400 hover:bg-blue-600 hover:text-white transition-all">Detail</a>
                    <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>" class="text-[9px] px-3 py-2 border border-blue-500/20 uppercase tracking-widest text-gray-400 hover:text-white transition-all">Upravit</a>
                    <a href="<?= BASE_URL ?>/index.php?url=book/delete/<?= $book['id'] ?>" onclick="return confirm('Opravdu chcete tuto knihu smazat?')" class="text-[9px] px-3 py-2 border border-rose-900/30 uppercase tracking-widest text-rose-500/70 hover:text-rose-400 transition-all">Smazat</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once '../app/views/layout/footer.php'; ?>
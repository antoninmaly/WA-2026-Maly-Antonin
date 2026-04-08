<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knihovna - Seznam knih</title>
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
                        <a href="<?= BASE_URL ?>/index.php" class="text-[#d4af37] border-b border-[#d4af37] pb-1">Seznam knih (Domů)</a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>/index.php?url=book/create" class="hover:text-[#d4af37] transition-all duration-300 pb-1 border-b border-transparent hover:border-[#d4af37]">Přidat novou knihu</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-6 py-12">
        
        <?php if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])): ?>
            <div class="mb-10 space-y-4">
                <?php foreach ($_SESSION['messages'] as $type => $messages): ?>
                    <?php 
                        $borderColor = 'border-white/10';
                        $accentColor = 'text-white';
                        if ($type === 'success') { $accentColor = 'text-green-400'; $borderColor = 'border-green-900/50'; }
                        elseif ($type === 'error') { $accentColor = 'text-red-400'; $borderColor = 'border-red-900/50'; }
                        elseif ($type === 'notice') { $accentColor = 'text-[#d4af37]'; $borderColor = 'border-[#d4af37]/30'; }
                    ?>
                    <?php foreach ($messages as $message): ?>
                        <div class="bg-neutral-900 border <?= $borderColor ?> px-6 py-4 rounded-sm shadow-xl">
                            <span class="<?= $accentColor ?> text-sm font-medium tracking-wide italic">
                                <?= htmlspecialchars($message) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <?php unset($_SESSION['messages']); ?>
            </div>
        <?php endif; ?>

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
                            <span class="md:hidden text-[10px] uppercase tracking-widest block text-neutral-600 mb-1">Rok:</span>
                            <?= htmlspecialchars($book['year']) ?>
                        </div>
                        
                        <div class="col-span-8 md:col-span-2 text-left md:text-right">
                            <span class="md:hidden text-[10px] uppercase tracking-widest block text-neutral-600 mb-1">Cena:</span>
                            <span class="text-white font-semibold whitespace-nowrap"><?= number_format($book['price'], 0, ',', ' ') ?> Kč</span>
                        </div>
                        
                        <div class="col-span-12 md:col-span-3 flex justify-start md:justify-end items-center space-x-4 mt-4 md:mt-0 pt-4 md:pt-0 border-t border-white/5 md:border-0">
                            <a href="<?= BASE_URL ?>/index.php?url=book/show/<?= $book['id'] ?>" 
                               class="text-[10px] px-3 py-1.5 border border-white/10 rounded-sm uppercase tracking-widest text-neutral-400 hover:text-white hover:border-white/30 transition-colors">
                               Detail
                            </a>
                            
                            <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>" 
                               class="text-[10px] px-3 py-1.5 border border-[#d4af37]/20 rounded-sm uppercase tracking-widest text-[#d4af37] hover:text-[#f9e29c] hover:border-[#d4af37] transition-colors">
                               Upravit
                            </a>
                            
                            <a href="<?= BASE_URL ?>/index.php?url=book/delete/<?= $book['id'] ?>" 
                               onclick="return confirm('Opravdu chcete tuto knihu smazat?')"
                               class="text-[10px] px-3 py-1.5 border border-rose-900/30 rounded-sm uppercase tracking-widest text-rose-500/70 hover:text-rose-400 hover:border-rose-500 transition-colors">
                               Smazat
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer class="mt-24 py-12 border-t border-white/5 text-center">
        <p class="text-neutral-600 text-[10px] uppercase tracking-[0.5em] font-bold">
            &copy; WA - 2026 - Výukový projekt
        </p>
    </footer>

</body>
</html>
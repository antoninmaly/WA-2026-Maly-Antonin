<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knihovna - <?= $pageTitle ?? 'Aplikace' ?></title>
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

        /* Styl pro formulářové prvky (použito napříč aplikací) */
        input, textarea {
            background-color: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            transition: all 0.3s ease;
        }
        input:focus, textarea:focus {
            border-color: #d4af37 !important;
            background-color: rgba(255, 255, 255, 0.07) !important;
            outline: none;
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.1);
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
                        <a href="<?= BASE_URL ?>/index.php" class="hover:text-[#d4af37] transition-all duration-300 pb-1 border-b border-transparent">Seznam knih (Domů)</a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>/index.php?url=book/create" class="hover:text-[#d4af37] transition-all duration-300 pb-1 border-b border-transparent">Přidat novou knihu</a>
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
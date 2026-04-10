<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knihovna - <?= $pageTitle ?? 'Aplikace' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap');
        
        body { font-family: 'Inter', sans-serif; }
        
        .blue-gradient {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 50%, #1e40af 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        input, textarea {
            background-color: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(59, 130, 246, 0.1) !important;
            color: white !important;
            transition: all 0.3s ease;
        }
        input:focus, textarea:focus {
            border-color: #3b82f6 !important;
            background-color: rgba(59, 130, 246, 0.07) !important;
            outline: none;
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.2);
        }
    </style>
</head>
<body class="bg-[#000411] text-gray-200 min-h-screen">

    <header class="bg-[#000814]/80 backdrop-blur-md border-b border-blue-500/10 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 py-5 flex flex-col md:flex-row justify-between items-center">
            <h1 class="text-2xl font-extrabold tracking-tight mb-4 md:mb-0 text-white uppercase">
                Aplikace <span class="blue-gradient">Knihovna</span>
            </h1>

            <nav>
                <ul class="flex space-x-8 text-[11px] uppercase tracking-[0.2em] font-bold text-white/70">
                    <li>
                        <a href="<?= BASE_URL ?>/index.php" class="hover:text-blue-400 transition-all duration-300">Seznam knih</a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>/index.php?url=book/create" class="hover:text-blue-400 transition-all duration-300">Přidat novou knihu</a>
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
                        $borderColor = 'border-blue-500/10';
                        $accentColor = 'text-white';
                        if ($type === 'success') { $accentColor = 'text-emerald-400'; $borderColor = 'border-emerald-900/50'; }
                        elseif ($type === 'error') { $accentColor = 'text-rose-400'; $borderColor = 'border-rose-900/50'; }
                        elseif ($type === 'notice') { $accentColor = 'text-blue-400'; $borderColor = 'border-blue-500/30'; }
                    ?>
                    <?php foreach ($messages as $message): ?>
                        <div class="bg-[#000814] border <?= $borderColor ?> px-6 py-4 rounded-sm shadow-xl">
                            <span class="<?= $accentColor ?> text-sm font-bold tracking-wide">
                                <?= htmlspecialchars($message) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <?php unset($_SESSION['messages']); ?>
            </div>
        <?php endif; ?>
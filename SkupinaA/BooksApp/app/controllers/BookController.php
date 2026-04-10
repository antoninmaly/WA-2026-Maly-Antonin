<?php

class BookController {

    // 0. Výchozí metoda pro zobrazení úvodní stránky včetně seznamu knih
    public function index() {
        // Načtení potřebných tříd
        require_once '../app/models/Database.php';
        require_once '../app/models/Book.php';

        // Vytvoření připojení k databázi
        $database = new Database();
        $db = $database->getConnection();

        // Inicializace modelu a získání dat
        $bookModel = new Book($db);
        $books = $bookModel->getAll(); // Proměnná $books nyní obsahuje pole všech knih
        
        // Načte se (vloží) připravený soubor s HTML strukturou
        require_once '../app/views/books/books_list.php';
    }

    // 1. Zobrazení formuláře pro přidání nové knihy
    public function create() {
        // Zde se pouze načte (vloží) připravený soubor s HTML formulářem
        require_once '../app/views/books/book_create.php';
    }

    // 2. Zpracování dat odeslaných z formuláře
    public function store() {
        // Kontrola, zda byl formulář odeslán metodou POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // 1. Získání a očištění textových dat (ochrana proti XSS)
            $title = htmlspecialchars($_POST['title'] ?? '');
            $author = htmlspecialchars($_POST['author'] ?? '');
            $isbn = htmlspecialchars($_POST['isbn'] ?? '');
            $category = htmlspecialchars($_POST['category'] ?? '');
            $subcategory = htmlspecialchars($_POST['subcategory'] ?? '');
            
            // U číselných hodnot se provádí explicitní přetypování
            $year = (int)($_POST['year'] ?? 0);
            $price = (float)($_POST['price'] ?? 0);
            
            $link = htmlspecialchars($_POST['link'] ?? '');
            $description = htmlspecialchars($_POST['description'] ?? '');

            // ... předchozí kód pro získání textových dat z $_POST ...

            $link = htmlspecialchars($_POST['link'] ?? '');
            $description = htmlspecialchars($_POST['description'] ?? '');

            // ZDE JE ZMĚNA: Zavolání metody, která zpracuje soubory v $_FILES
            // Vrátí nám hezké pole s novými názvy (např. ['book_123.jpg', 'book_456.png'])
            $uploadedImages = $this->processImageUploads(); 

            // ... zbytek kódu zůstává beze změny ...

            // 2. Komunikace s databází a modelem
            require_once '../app/models/Database.php';
            require_once '../app/models/Book.php';

            // Vytvoření připojení k DB
            $database = new Database();
            $db = $database->getConnection();

            // Vytvoření objektu knihy a volání metody pro uložení
            $bookModel = new Book($db);
            $isSaved = $bookModel->create(
                $title, $author, $category, $subcategory, 
                $year, $price, $isbn, $description, $link, $uploadedImages
            );

            // 3. Vyhodnocení výsledku a přesměrování
            if ($isSaved) {
                // Vyvolání zelené notifikace pro úspěšnou akci
                $this->addSuccessMessage('Kniha byla úspěšně uložena do databáze.');
                
                // Přesměrování zpět na hlavní stránku s využitím dynamické BASE_URL
                header('Location: ' . BASE_URL . '/index.php');
                exit;
            } else {
                // Vyvolání červené notifikace pro kritické selhání
                $this->addErrorMessage('Nastala chyba. Nepodařilo se uložit knihu do databáze.');
            }
            
        } else {
            // Pokud je stránka navštívena napřímo bez odeslání dat, zobrazí se žlutá informativní zpráva
            $this->addNoticeMessage('Pro přidání knihy je nutné odeslat formulář.');
        }
    }

       // --- Pomocné metody pro systém notifikací ---

    protected function addSuccessMessage($message) {
        // Zelená zpráva o úspěchu
        $_SESSION['messages']['success'][] = $message;
    }

    protected function addNoticeMessage($message) {
        // Žlutá informativní zpráva
        $_SESSION['messages']['notice'][] = $message;
    }

    protected function addErrorMessage($message) {
        // Červená chybová zpráva
        $_SESSION['messages']['error'][] = $message;
    }

    // 3. Smazání existující knihy včetně fyzických souborů
    public function delete($id = null) {
        if (!$id) {
            $this->addErrorMessage('Nebylo zadáno ID knihy ke smazání.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        require_once '../app/models/Database.php';
        require_once '../app/models/Book.php';

        $database = new Database();
        $db = $database->getConnection();
        $bookModel = new Book($db);

        // --- NOVÝ KÓD PRO MAZÁNÍ SOUBORŮ ---
        
        // 1. Nejdříve získáme data knihy, abychom znali názvy souborů
        $book = $bookModel->getById($id);
        
        if ($book) {
            // Převedeme JSON s obrázky na pole
            $images = json_decode($book['images'] ?? '[]', true);
            
            // Definujeme cestu ke složce uploads
            $uploadDir = __DIR__ . '/../../public/uploads/';

            // 2. Smažeme záznam z databáze
            $isDeleted = $bookModel->delete($id);

            if ($isDeleted) {
                // 3. Pokud se smazání z DB povedlo, projdeme pole a smažeme soubory z disku
                foreach ($images as $img) {
                    $filePath = $uploadDir . $img;
                    
                    // Kontrola, zda soubor na disku skutečně existuje, než ho smažeme
                    if (file_exists($filePath)) {
                        unlink($filePath); // Funkce unlink fyzicky smaže soubor
                    }
                }
                $this->addSuccessMessage('Kniha i její obrázky byly trvale smazány.');
            } else {
                $this->addErrorMessage('Nastala chyba. Knihu se nepodařilo smazat z databáze.');
            }
        } else {
            $this->addErrorMessage('Kniha nebyla nalezena.');
        }

        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }

    // 4. Zobrazení formuláře pro úpravu existující knihy
    public function edit($id = null) {
        // Kontrola, zda bylo v URL vůbec předáno nějaké ID
        if (!$id) {
            // Vyvolání červené notifikace pro kritickou chybu
            $this->addErrorMessage('Nebylo zadáno ID knihy k úpravě.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        // Načtení potřebných tříd a spojení s databází
        require_once '../app/models/Database.php';
        require_once '../app/models/Book.php';

        $database = new Database();
        $db = $database->getConnection();

        // Získání dat o konkrétní knize
        $bookModel = new Book($db);
        $book = $bookModel->getById($id); // Proměnná $book nyní obsahuje asociativní pole dat

        // Bezpečnostní kontrola: Zda kniha s daným ID vůbec existuje
        if (!$book) {
            // Pokud knihu někdo mezitím smazal, nebo uživatel zadal do URL neexistující ID
            $this->addErrorMessage('Požadovaná kniha nebyla v databázi nalezena.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        // Pokud je vše v pořádku, načte se připravený soubor s HTML formulářem pro úpravy.
        // Šablona bude mít automaticky přístup k proměnné $book.
        require_once '../app/views/books/book_edit.php';
    }
        
    // 5. Zpracování dat odeslaných z editačního formuláře
    public function update($id = null) {
        // Zabezpečení: Je k dispozici ID a byl odeslán formulář?
        if (!$id) {
            $this->addErrorMessage('Nebylo zadáno ID knihy k aktualizaci.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // 1. Získání a očištění textových dat
            $title = htmlspecialchars($_POST['title'] ?? '');
            $author = htmlspecialchars($_POST['author'] ?? '');
            $isbn = htmlspecialchars($_POST['isbn'] ?? '');
            $category = htmlspecialchars($_POST['category'] ?? '');
            $subcategory = htmlspecialchars($_POST['subcategory'] ?? '');
            
            // Přetypování číselných hodnot
            $year = (int)($_POST['year'] ?? 0);
            $price = (float)($_POST['price'] ?? 0);
            
            $link = htmlspecialchars($_POST['link'] ?? '');
            $description = htmlspecialchars($_POST['description'] ?? '');

            // 2. Příprava databáze a modelu
            require_once '../app/models/Database.php';
            require_once '../app/models/Book.php';

            $database = new Database();
            $db = $database->getConnection();
            $bookModel = new Book($db);

            // 3. ZPRACOVÁNÍ OBRÁZKŮ (Zachování starých + přidání nových)
            
            // Nejprve získáme aktuální data knihy z DB
            $existingBook = $bookModel->getById($id);
            // Původní obrázky jsou uložené jako JSON, převedeme je na pole (pokud neexistují, prázdné pole)
            $currentImages = json_decode($existingBook['images'] ?? '[]', true);

            // Zavolání pomocné metody pro zpracování nových souborů v $_FILES
            $newImages = $this->processImageUploads(); 

            // Sloučení starých a nových obrázků do jednoho pole
            $uploadedImages = array_merge($currentImages, $newImages);

            // 4. Volání updatu nad modelem s kompletním polem obrázků
            $isUpdated = $bookModel->update(
                $id, $title, $author, $category, $subcategory, 
                $year, $price, $isbn, $description, $link, $uploadedImages
            );

            // 5. Vyhodnocení výsledku a přesměrování
            if ($isUpdated) {
                $this->addSuccessMessage('Kniha byla úspěšně upravena.');
                header('Location: ' . BASE_URL . '/index.php');
                exit;
            } else {
                $this->addErrorMessage('Nastala chyba. Změny se nepodařilo uložit.');
            }
            
        } else {
            $this->addNoticeMessage('Pro úpravu knihy je nutné odeslat formulář.');
        }
    }
    
    // 6. Zobrazení detailu jedné konkrétní knihy
    public function show($id = null) {
        // Kontrola, zda bylo v URL předáno ID
        if (!$id) {
            $this->addErrorMessage('Nebylo zadáno ID knihy pro zobrazení detailu.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        // Načtení potřebných tříd a spojení s databází
        require_once '../app/models/Database.php';
        require_once '../app/models/Book.php';

        $database = new Database();
        $db = $database->getConnection();

        // Získání dat o konkrétní knize pomocí existující metody getById
        $bookModel = new Book($db);
        $book = $bookModel->getById($id);

        // Bezpečnostní kontrola: Existuje kniha s tímto ID?
        if (!$book) {
            $this->addErrorMessage('Požadovaná kniha nebyla nalezena.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        // Načtení pohledu pro detail knihy
        require_once '../app/views/books/book_show.php';
    }

    // --- Pomocná metoda pro zpracování nahrávání obrázků ---
    protected function processImageUploads() {
        $uploadedFiles = [];
        
        // Cesta ke složce, kam se budou obrázky fyzicky ukládat (relativně od index.php)
        $uploadDir = __DIR__ . '/../../public/uploads/'; 
        
        // Zkontrolujeme, zda vůbec existuje adresář, pokud ne, vytvoříme ho
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Zkontrolujeme, zda byl odeslán alespoň jeden soubor
        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $fileCount = count($_FILES['images']['name']);

            for ($i = 0; $i < $fileCount; $i++) {
                // Pokud při nahrávání tohoto konkrétního souboru nedošlo k chybě
                if ($_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
                    
                    $tmpName = $_FILES['images']['tmp_name'][$i];
                    $originalName = basename($_FILES['images']['name'][$i]);
                    // Zjištění koncovky (např. jpg, png)
                    $fileExtension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

                    // Můžeme zde přidat i kontrolu povolených formátů (volitelné)
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
                    if (!in_array($fileExtension, $allowedExtensions)) {
                        continue; // Přeskočíme nepodporovaný soubor
                    }

                    // 1. Vygenerování unikátního jména pomocí aktuálního času a náhodného řetězce
                    // např: book_64a2b1c_8f2a.jpg
                    $newName = 'book_' . uniqid() . '_' . substr(md5(mt_rand()), 0, 4) . '.' . $fileExtension;
                    $targetFilePath = $uploadDir . $newName;

                    // 2. Fyzický přesun souboru z dočasné paměti do naší složky uploads
                    if (move_uploaded_file($tmpName, $targetFilePath)) {
                        // 3. Uložení POUZE NÁZVU do pole, které pak pošleme databázi
                        $uploadedFiles[] = $newName; 
                    }
                }
            }
        }
        return $uploadedFiles;
    }

}
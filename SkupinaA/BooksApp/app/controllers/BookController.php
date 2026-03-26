<?php
require_once '../app/models/Book.php';

class BookController {

    public function index() {
        require_once '../app/views/books/books_list.php';
    }

    // Metoda pro zobrazení formuláře
    public function create() {
        require_once '../app/views/books/book_create.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $bookModel = new Book();

            // Vezmeme vše z formuláře (klíče musí odpovídat názvům v SQL nahoře)
            $data = [
                'title'       => $_POST['title'],
                'author'      => $_POST['author'],
                'category'    => $_POST['category'],
                'subcategory' => $_POST['subcategory'],
                'year'        => $_POST['year'],
                'price'       => $_POST['price'],
                'isbn'        => $_POST['isbn'],
                'description' => $_POST['description'],
                'link'        => $_POST['link']
            ];

            if ($bookModel->create($data)) {
                // Po úspěchu přesměrujeme zpět na seznam
                header('Location: index.php?url=book/index');
                exit();
            }
        }
    }
}
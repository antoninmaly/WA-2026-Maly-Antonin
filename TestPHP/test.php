<?php
$name = "";
$message = "";
$age = 0;

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $name = $_POST["my_name"];
    if ($name == "Tonda")
    {
        $message = "Ahoj Tondo!";
        $age = $_POST["my_age"];
    }
    else
    {
        $message = "Neznám tě";
        
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test PHP</title>
</head>
<body>
    <h1>Test formuláře</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis impedit molestias iste totam architecto, beatae earum sit aspernatur, itaque maxime ratione nemo id. At quasi impedit, modi dolores nulla consequuntur.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe debitis officia non fugit perferendis nostrum eaque cumque. Fuga magnam laborum quidem accusantium porro, ullam saepe non obcaecati cupiditate beatae ea.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum odio ratione dignissimos placeat est autem facere officiis, provident laborum dolore molestias nobis iste voluptas temporibus, ipsum tenetur minus ad repellat!</p>
    <form method="post">
        <input type="text" name="my_name" placeholder="Zadejte jméno">
        <button type="submit">Odeslat</button>
        <input type="number" name="my_age" placeholder="Zadejte věk">
        <button type="submit">Odeslat</button>
    </form>

    <p>
        <?php   
            echo "Výstup: "; 
            echo $message; 
        ?>
    </p>
    <p>
        <?php   
            echo "Tvůj věk: ";
            echo $age; 
        ?>
    </p>

</body>
</html>
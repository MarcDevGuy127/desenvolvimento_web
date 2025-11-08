<?php
//4. criando session
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        main {
            flex: 1;
            /* ocupa o espaço restante */
            background-color: #f3eeee;
            display: flex;
            align-items: center;
            /* centraliza verticalmente */
            justify-content: center;
            /* centraliza horizontalmente */
            text-align: center;
        }

        a {
            margin-left: 20px;
            background-color: #ff4b2b;
            color: white;
            text-decoration: none;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        a:hover {
            background-color: #ff6a4d;
        }
    </style>
    <main>
        <h2>Olá, <?php echo htmlspecialchars($_SESSION['email']); ?>!</h2>
        <a href="../php/logout.php">Sair</a>
    </main>
</body>

</html>
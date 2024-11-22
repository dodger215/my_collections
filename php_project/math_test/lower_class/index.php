<?php
session_start();

if (!isset($_SESSION['a'], $_SESSION['b'], $_SESSION['c'])) {
    $_SESSION['a'] = rand(0, 9);
    $_SESSION['b'] = rand(0, 9);
    $_SESSION['c'] = rand(0, 9);
}

$a = $_SESSION['a'];
$b = $_SESSION['b'];
$c = $_SESSION['c'];

function calc($a, $b, $c)
{
    return $a + $b + $c;
}

$answer = calc($a, $b, $c);

$message = '';
if (isset($_POST['check'])) {
    $option = $_POST['choose'];
    if (!empty($option)) {
        if ($option == $answer) {
            $message = "Correct!";
            session_unset();
        } else {
            $message = "Wrong! The correct answer was $answer.";
        }
    } else {
        $message = "Please enter a number.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Junior Level</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            max-width: 400px;
            margin: auto;
            background-color: #f4f4f9;
            text-align: center;
        }
        .question span {
            font-size: 2rem;
            margin: 0 10px;
        }
        .choose {
            width: 100%;
            padding: 10px;
            margin: 20px 0;
            font-size: 1rem;
        }
        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .message {
            margin-top: 20px;
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <form method="post">
        <h1>Question</h1>
        <div class="question">
            <span><?= $a ?></span> +
            <span><?= $b ?></span> +
            <span><?= $c ?></span>
        </div>
        <input type="number" name="choose" class="choose" placeholder="Your answer" />
        <button type="submit" name="check">Check</button>
    </form>
    <div class="message">
        <?= $message ?>
    </div>
</body>
</html>

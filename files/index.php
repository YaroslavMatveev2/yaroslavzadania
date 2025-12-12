<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>PHP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        form { margin-bottom: 30px; }
        input[type="number"], input[type="text"] { width: 100px; margin-right: 10px; }
        button { padding: 5px 10px; }
        .result { margin-top: 10px; font-weight: bold; }
    </style>
</head>
<body>

<h1>PHP zadania</h1>

<!-- 1. Kalkulator -->
<form method="post">
    <h2>Kalkulator</h2>
    <input type="number" name="num1" placeholder="Liczba 1" required>
    <input type="number" name="num2" placeholder="Liczba 2" required>
    <select name="operator">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="*">*</option>
        <option value="/">/</option>
    </select>
    <button type="submit" name="calc">Oblicz</button>
</form>
<div class="result">
<?php
if (isset($_POST['calc'])) {
    $a = $_POST['num1'];
    $b = $_POST['num2'];
    $op = $_POST['operator'];
    $result = match($op) {
        '+' => $a + $b,
        '-' => $a - $b,
        '*' => $a * $b,
        '/' => $b != 0 ? $a / $b : 'Nie można dzielić przez 0',
        default => 'Nieznana operacja',
    };
    echo "Wynik: $result";
}
?>
</div>

<!-- 2. Liczba pierwsza -->
<form method="post">
    <h2>Sprawdź czy liczba jest pierwsza</h2>
    <input type="number" name="prime" placeholder="Liczba" required>
    <button type="submit" name="checkPrime">Sprawdź</button>
</form>
<div class="result">
<?php
if (isset($_POST['checkPrime'])) {
    $n = $_POST['prime'];
    $isPrime = $n > 1;
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) {
            $isPrime = false;
            break;
        }
    }
    echo $isPrime ? "$n jest liczbą pierwszą" : "$n nie jest liczbą pierwszą";
}
?>
</div>

<!-- 3. Instrukcja warunkowa -->
<form method="post">
    <h2>Instrukcja warunkowa</h2>
    <input type="number" name="conditionNum" placeholder="Liczba" required>
    <button type="submit" name="conditionCheck">Sprawdź</button>
</form>
<div class="result">
<?php
if (isset($_POST['conditionCheck'])) {
    $num = $_POST['conditionNum'];
    if ($num > 0) {
        echo "Liczba $num jest dodatnia";
    } elseif ($num < 0) {
        echo "Liczba $num jest ujemna";
    } else {
        echo "Liczba to 0";
    }
}
?>
</div>

<!-- 4. NWD Euklides algorytm -->
<form method="post">
    <h2>NWD dwóch liczb (algorytm Euklidesa)</h2>
    <input type="number" name="nwd1" placeholder="Liczba 1" required>
    <input type="number" name="nwd2" placeholder="Liczba 2" required>
    <button type="submit" name="gcdCalc">Oblicz</button>
</form>
<div class="result">
<?php
if (isset($_POST['gcdCalc'])) {
    $a = $_POST['nwd1'];
    $b = $_POST['nwd2'];
    while ($b != 0) {
        [$a, $b] = [$b, $a % $b];
    }
    echo "NWD = $a";
}
?>
</div>

<!-- 5. NWD 3 liczb + max z array -->
<form method="post">
    <h2>NWD trzech liczb i max z tablicy</h2>
    <input type="text" name="numbers" placeholder="Oddzielone przecinkami" required>
    <button type="submit" name="gcdMaxCalc">Oblicz</button>
</form>
<div class="result">
<?php
if (isset($_POST['gcdMaxCalc'])) {
    $array = array_map('intval', explode(',', $_POST['numbers']));
    if (count($array) >= 3) {
        $gcd = function($x, $y) { while ($y) [$x, $y] = [$y, $x % $y]; return $x; };
        $nwd3 = $gcd($array[0], $gcd($array[1], $array[2]));
        $maxVal = max($array);
        echo "NWD 3 pierwszych liczb = $nwd3, Max w tablicy = $maxVal";
    } else {
        echo "Wprowadź co najmniej 3 liczby";
    }
}
?>
</div>

</body>
</html>

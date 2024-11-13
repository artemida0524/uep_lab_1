<?php

function validate($input) {
    return is_numeric($input) && $input >= 1 && $input <= 100;
}

function compareNumbers($guess, $target) {
    if ($guess > $target) {
        return "Спробуй менше";
    } elseif ($guess < $target) {
        return "Спробуй більше";
    }
    return "Вітаю! Ти вгадав!";
}

function playGame($maxAttempts) {
    $target = rand(1, 100);
    $attempts = 0;

    echo "Я загадав число від 1 до 100. Спробуй вгадати.\n";

    while ($attempts < $maxAttempts) {
        $attempts++;
        echo "Спроба {$attempts}: ";
        $guess = trim(fgets(STDIN));

        if (!validate($guess)) {
            echo "Будь ласка, введіть число від 1 до 100.\n";
            $attempts--;
            continue;
        }

        $result = compareNumbers($guess, $target);
        echo $result . "\n";

        if ($guess == $target) {
            echo "Ти вгадав за {$attempts} спроб!\n";
            return;
        }
    }

    echo "Гра закінчена! Загадане число було: {$target}\n";
}

playGame(7);

?>

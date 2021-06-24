<style>
<!--
body {
    display: grid;
}
div {
    marginm: 10 px;
    display: inline-grid;
}

a {
    border-radius: 25px;
    padding: 25px;
    background-image: linear-gradient(324deg, #0000005e, #ffffffc2);
    border: black 2px groove;
}

div:visited{
    border-radius: 25px;
    padding: 25px;
    background-image: linear-gradient(224deg, #4d4df05e, #c85353e3);
    border: black 2px groove;
}

a:hover {
    border-radius: 25px;
    padding: 25px;
    background-image: linear-gradient(56deg, #0000005e, #ffffffc2);
    border: gray 3px groove;
}

-->
</style>
<?php
    $totalAmount = filter_input(INPUT_GET, 'totalAmount');
    $limit = filter_input(INPUT_GET, 'limit');
    $first = 0;
    while ($first < $totalAmount)  {
        echo '
            <div><a target="_blank" href="dboTest.php?first=' . $first . '"> Get ' . $first . ' to ' . ($first + $limit) . '</a></div>
            </br>
        ';
        $first += $limit;
    }
?>

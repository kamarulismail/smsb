<?php

$counterSaturday = 0;
$counterSunday   = 0;
$counterLimit    = 58;

$counterFailSafe = 0;
$limitFailSafe   = 500;
$breakWhileLoop  = false;

$day   = 1;
$month = 1;
$startingYear = 1970; //STARTING OF Unix Epoch (January 1 1970 00:00:00 GMT)
$year         = $startingYear;

$dateTime = new DateTime(); //USING DATETIME() CAUSE DATE() HAS LIMITATION (YEAR2038 BUG)
while(!$breakWhileLoop){
    $dateTime->setDate($year, $month, $day);
    $year++;

    #echo $dateTime->format('Y-m-d [N][l]'). '<br />';
    $dayOfTheWeek = $dateTime->format('N');
    if($dayOfTheWeek == 6){ //IF SATURDAY
        $counterSaturday++;
    }
    elseif($dayOfTheWeek == 7){ //IF SUNDAY
        $counterSunday++;
    }

    //CHECK IF EITHER COUNTER REACH $counterLimit, BREAK THE WHILE LOOP
    if($counterSaturday == $counterLimit || $counterSunday == $counterLimit){
        $breakWhileLoop = true;
    }

    //ADDED FAILSAFE TO PREVENT L.O.D (Loop of death)
    if($counterFailSafe == $limitFailSafe){
        $breakWhileLoop = true;
    }
    $counterFailSafe++;
}

echo "<p>counterSaturday: {$counterSaturday} | counterSunday: {$counterSunday}</p>";
echo "<p>From: {$startingYear} until {$year}</p>";
?>

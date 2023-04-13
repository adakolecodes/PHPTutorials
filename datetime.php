<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date Time</title>
</head>
<body>
    <?php
        //Set the default timezone to Africa Lagos
        date_default_timezone_set("Africa/Lagos");

        //Get the current date and time in this format: April 4, 2023, 12:27 pm
        $all = date("F j, Y, g:i a");
        $monthFull = date("F"); //September
        $monthShort = date("M"); //Sep
        $monthInNumber = date("m"); //04
        $dayA = date("j"); //4
        $dayB = date("d"); //04
        $dayC = date("D"); //Tue
        $dayD = date("l"); //Tuesday
        $year = date("Y");
        $time12Hour = date("g");
        $time24Hour = date("G");
        $timeMin = date("i");
        $timePeriod = date("a");
        $timeAll = date("g:i a");

        $dateTimeArray = [$all, $monthFull, $monthShort, $monthInNumber, $dayA, $dayB, $dayC, $dayD, $year, $time12Hour, $time24Hour, $timeMin, $timePeriod, $timeAll];
        
        foreach ($dateTimeArray as $dateTime) {
            echo $dateTime . "<br>";
        }

        //Echo Good Morning or Good Afternoon or Good Evening based on the timeHour
        if ($time24Hour >= 0 && $time24Hour < 12) {
            echo "Good Morning";
        } else if ($time24Hour >= 12 && $time24Hour < 16) {
            echo "Good Afternoon";
        } else {
            echo "Good Evening";
        }
    ?>
    <hr>
    <?php
        //Format already existing date and time
        $date = "2021-01-01 12:45:37";
        echo (date("F j, Y, g:i:s a", strtotime($date)));
    ?>
    <hr>
    <?php
        //Get the current date and time in this format: 2023-04-04 12:27:34
        $currentdate =  date("Y-m-d");
        $currenttime = date("H:i:s"); //User h for 12 hours

        echo $currentdate . " " . $currenttime;
    ?>
</body>
</html>
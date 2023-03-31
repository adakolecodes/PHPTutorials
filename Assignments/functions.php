<?php

//Create a function that takes an array of people and loops through them, displaying their individual properties

$people = [
  [
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'john@gmail.com',
  ],
  [
    'first_name' => 'Jane',
    'last_name' => 'Mike',
    'email' => 'jane@gmail.com',
  ],
];


//Create a function that helps me loop through the $people array and print out each person's property.
function getPerson($param) {
    foreach ($param as $person) {
        echo ("First name: {$person['first_name']} <br> Surname: {$person['last_name']} <br> Email: {$person['email']} <br>");
        echo "<br>";
    }
}

getPerson($people);

?>
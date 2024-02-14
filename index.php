<?php
$presentTime = new DateTime('now Europe/Paris');

$am_pm = $presentTime->format('A');
$circle_color1 = ($am_pm == 'AM') ? 'gray' : 'rgb(47, 166, 47)';
$circle_color2 = ($am_pm == 'PM') ? 'gray' : 'rgb(47, 166, 47)';


// Initialise $destinationTime avec la date actuelle par défaut
$destinationTime = clone $presentTime;

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $selectedDate = isset($_POST['selectedDate']) ? $_POST['selectedDate'] : null;

    $selectedTime = isset($_POST['selectedTime']) ? $_POST['selectedTime'] : null;

   
    if ($selectedDate !== null && $selectedTime !== null) {
        $selectedDateTime = $selectedDate . ' ' . $selectedTime;
        $newDateTime = DateTime::createFromFormat('Y-m-d H:i', $selectedDateTime);

        if ($newDateTime !== false) {
            $destinationTime = $newDateTime;
        }
    }
    $am_pmtd = $destinationTime->format('A');
    $circle_color3 = ($am_pmtd == 'AM') ? 'gray' : 'rgb(47, 166, 47)';
    $circle_color4 = ($am_pmtd == 'PM') ? 'gray' : 'rgb(47, 166, 47)';
}
if  ($presentTime >= $destinationTime) {
        $datepassee = $presentTime->diff($destinationTime);
        $enminute =  ($datepassee->y * 518400 + $datepassee->m * 43200 + $datepassee->d * 1440 + $datepassee->h * 60 + $datepassee->i) / 10000;
   
} elseif ($presentTime <= $destinationTime) {
        $datepassee = $destinationTime->diff($presentTime);
        $enminute =  ($datepassee->y * 518400 + $datepassee->m * 43200 + $datepassee->d * 1440 + $datepassee->h * 60 + $datepassee->i) / 10000;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.cdnfonts.com/css/digital-numbers" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/nevermind-slab" rel="stylesheet">
                
</head>
<body>
    <div class="contenair">
        <div class="panel">
            <div class="timenow">
                <div class="block">
                    <p>MONTH</p>
                    <div class="case"><?php echo $presentTime->format('M') ?></div>
                </div>
                <div class="block">
                    <p>DAY</p>
                    <div class="case"><?php echo $presentTime->format('d') ?></div>
                </div>
                <div class="block">
                    <p>YEAR</p>
                    <div class="case"><?php echo $presentTime->format('Y') ?></div>
                </div>
                <div class="block">
                    <p>AM</p>
                    <div class="illuminated" style="background-color: <?php echo $circle_color2; ?>"></div>
                    <P>PM</P>
                    <div class="illuminated" style="background-color: <?php echo $circle_color1; ?>"></div>
                </div>
                <div class="block">
                    <p>HOUR</p>
                    <div class="case"><?php echo $presentTime->format('h') ?></div>
                </div>
                <div class="block">
                    <p>MIN</p>
                    <div class="case"><?php echo $presentTime->format('i') ?></div>
                </div>
            </div>
            <h3> PRESENT TIME</h3>
        </div>
        <div class="panel">
            <div class="timejourney">
                <div class="block">
                    <p>MONTH</p>
                    <div class="case"><?php echo $destinationTime->format('M') ?></div>
                </div>
                <div class="block">
                    <p>DAY</p>
                    <div class="case"><?php echo $destinationTime->format('d') ?></div>
                </div>
                <div class="block">
                    <p>YEAR</p>
                    <div class="case"><?php echo $destinationTime->format('Y') ?></div>
                </div>
                <div class="block">
                    <p>AM</p>
                    <div class="illuminated" style="background-color: <?php echo $circle_color4; ?>"></div>
                    <p>PM</p>
                    <div class="illuminated" style="background-color: <?php echo $circle_color3; ?>"></div>
                    
                </div>
                <div class="block">
                    <p>HOUR</p>
                    <div class="case"><?php echo $destinationTime->format('h') ?></div>
                </div>
                <div class="block">
                    <p>MIN</p>
                    <div class="case"><?php echo $destinationTime->format('i') ?></div>
                </div>
            </div>
            <h3>DESTINATION TIME</h3>
        </div>
        <div class="panelsetting">
            <form method="post" action="">
                    <label for="selectedDate">Sélectionner une date :</label>
                    <input type="date" id="selectedDate" name="selectedDate" value="<?php echo $destinationTime->format('Y-m-d'); ?>">
                    <button type="submit" name="updateDate">Mettre à jour la date</button>
                    <br>
                    <label for="selectedTime">Sélectionner l'heure :</label>
                    <input type="time" id="selectedTime" name="selectedTime" value="<?php echo $destinationTime->format('H:i'); ?>">
                    <button type="submit" name="updateTime">Mettre à jour l'heure</button>
            </form>
        </div>
        <h4>LE BONUS</h4>
        <p>La quantité de carburant nécéssaire : <?php echo $enminute; ?> litres </p>
    </div>
</body>
</html>
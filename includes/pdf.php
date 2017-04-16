<?php
use NumberToWords\NumberToWords;
require_once('../vendor/autoload.php');
require_once('airports.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (
        isset($_POST['startAirPort']) == true &&
        isset($_POST['finishAirPort']) == true &&
        isset($_POST['startTime']) == true && !empty($_POST['startTime']) &&
        isset($_POST['flightTime']) == true && !empty($_POST['flightTime']) &&
        isset($_POST['flightPrice']) == true && !empty($_POST['flightPrice']) && $_POST['flightPrice'] > 0 && $_POST['startAirPort'] != $_POST['finishAirPort']
    ) {

        $keyToStartAirPort = $_POST['startAirPort'];
        $keyToFinishAirPort = $_POST['finishAirPort'];

        $startAirPort = $airports[$keyToStartAirPort];
        $finishAirPort = $airports[$keyToFinishAirPort];

        $startAirPortName = $startAirPort['name'];
        $finishAirPortName = $finishAirPort['name'];

        $startAirPortCode = $startAirPort['code'];
        $finishAirPortCode = $finishAirPort['code'];

        $flightPrice = $_POST['flightPrice'];

        $startTime = $_POST['startTime'];
        $flightTime = $_POST['flightTime'];
        $startAirPortTimeZone = $startAirPort['timezone'];
        $finishAirPortTimeZone = $finishAirPort['timezone'];

        $startAirPortDateObject = new DateTime($startTime);
        $finishAirPortDateObject = (new DateTime($startTime))->modify("+$flightTime hours");


        $tzStart = new DateTimeZone($startAirPortTimeZone);
        $startAirPortDateObject->setTimezone($tzStart);

        $tzFinish = new DateTimeZone($finishAirPortTimeZone);
        $finishAirPortDateObject->setTimezone($tzFinish);


        $startAirPortLocalTime = $startAirPortDateObject->format('d.m.Y H:i:s');
        $finishAirPortLocalTime = $finishAirPortDateObject->format('d.m.Y H:i:s');

// passengers names are generated based on library fzaninotto/faker
        $faker = Faker\Factory::create();
        $randomName = $faker->name;

// price and currency are converted to words with kwn/number-to-words library
        $numberToWords = new NumberToWords();
        $currencyTransformer = $numberToWords->getCurrencyTransformer('pl');
        $priceToWords = $currencyTransformer->toWords($flightPrice * 100, 'PLN');

// Ticket in HTML form

        $htmlTicket ='
      <head>
         <link href=\'../bootstrap/css/bootstrap.css\' rel=\'stylesheet\'>
      </head>
      <body>
        <div class="container col-md-6 col-md-offset-3" style="margin-top: 40px;">
         <table id="ticket" border="1" style="text-align: center">
            <tr>
                <th style="text-align: center" colspan="2">PHP AIRLINE</th>
            </tr>
            <tr>
                <td>FROM</td>
                <td>TO</td>
            </tr>
            <tr>
                <td>' . $startAirPortName . ' (' . $startAirPortCode . ') </td>
                <td>' . $finishAirPortName . ' (' . $finishAirPortCode . ') </td>
            </tr>
            <tr>
                <td>Departure (local time) </td>
                <td>Arrival (local time) </td>
            </tr>
            <tr>
                <td>' . $startAirPortLocalTime . '</td>
                <td>' . $finishAirPortLocalTime . '</td>
            </tr>
            <tr>
                <td colspan="2">Flight time: ' . $flightTime . ' hours</td>
            </tr>
            <tr>
                <td colspan="2">Flight price: ' . $flightPrice . ' zł<br>' . $priceToWords . '</td>
            </tr>
            <tr>
                <td colspan="2">Passenger: ' . $randomName . '</td>
            </tr>
         </table>
        </div>
      </body>';
    } else {
        echo 'Missing or wrong data provided';
    }
}
// Tickete in PDF form
 $mpdf = new mPDF();
 $mpdf->WriteHTML($htmlTicket);
 $mpdf->Output('ticket.pdf', 'D');


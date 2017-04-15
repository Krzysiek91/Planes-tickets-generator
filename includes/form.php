<form action='includes/pdf.php' method='POST'>

    <label>Departure airport:
        <select name='startAirPort' class='form-control'>
            <?php
            foreach ($airports as $key => $port) {
                echo '<option value ="' . $key . '">' . $port['name'] . '</option>';
            }
            ?>
        </select>
    </label>

    <label>Arrival airport:
        <select name='finishAirPort' class='form-control'>
            <?php
            foreach ($airports as $key => $port) {
                echo '<option value ="' . $key . '">' . $port['name'] . '</option>';
            }
            ?>
        </select>
    </label>

    <label>Time of departure:
        <input type='datetime-local' name='startTime' class='form-control'/>
    </label>

    <label>Flight length:
        <input type='number' min='0' step='1' name='flightTime' class='form-control'/>
    </label>

    <label>Flight price:
        <input type='number' min='0' step='0.01' name='flightPrice' class='form-control'/>
    </label>

        <button class="btn">Generate ticket</button>

</form>       





<?php
/**
* Generate a list of string dates between 2 dates and
* save into datebase table stagedagen
*
* @param string $start Start date
* @param string $end End date
* @param string $format Output format (Default: Y-m-d)
*/
function setDatesFromRange($start, $end, $format = 'Y-m-d') {
    global $conn;
    $interval = new DateInterval('P1D');
 
    $realEnd = new DateTime($end);
    $realEnd->add($interval);
 
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
 
    foreach($period as $date) {
        $datum = $date->format($format);
        $dagnummer = $date->format('w');
 
        // Alleen werkdagen tellen mee voor de prognose
        $prognose = 1;
        if($dagnummer == 0 || $dagnummer == 6){
            $prognose = 0;
        }
 
        // Write to database
        $sql = 'INSERT INTO stagedagen (datum, prognose, gewerkt) VALUES(:datum, :prognose, 0)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('datum', $datum);
        $stmt->bindParam('prognose', $prognose);
        $stmt->execute();
    }
}
?>
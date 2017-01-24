<pre>
<?php

include 'connect.php';

function getDatesFromRange($start, $end, $format = 'Y-m-d') {
    global $conn;
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach($period as $date) {
        $dagnummer = $date->format('w');
    
    
    $prognose = 1;
    if($dagnummer==0 || $dagnummer==6){
     $prognose = 0;   
    }

        // Write to database
        $sql = 'INSERT INTO stagedagen (datum, prognose, gewerkt) VALUES (:datum, :prognose, 0)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':datum', $date->format($format));
        $stmt->bindParam(':prognose', $prognose);
        $stmt->execute();
} }

$startdate = '';
$enddate = '';


if(isset($_POST['submit'])) {
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    
    getDatesFromRange($startdate, $enddate);
} 

 ?>
 
<form action="" method="post">
<input type="date" name="startdate">
<input type="date" name="enddate">

<input type="submit" name="submit" value="Verzenden">
</form>
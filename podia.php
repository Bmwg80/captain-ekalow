<?php
$pageTitle = 'Podia';
include 'includes/header.php';

// Haal alle podia op met evenement info
$sql = "SELECT p.*, e.TITEL as EVENEMENT_TITEL, e.ID as EVENEMENT_ID 
        FROM PODIUM p 
        JOIN EVENEMENT e ON p.EVENEMENT_ID = e.ID 
        ORDER BY e.START_DATUM, p.ID";
$result = mysqli_query($conn, $sql);

// Groepeer per evenement
$evenementen = [];
while ($podium = mysqli_fetch_assoc($result)) {
    $eventId = $podium['EVENEMENT_ID'];
    if (!isset($evenementen[$eventId])) {
        $evenementen[$eventId] = [
            'titel' => $podium['EVENEMENT_TITEL'],
            'podia' => []
        ];
    }
    $evenementen[$eventId]['podia'][] = $podium;
}
?>

<h1>Podia</h1>
<p>Bekijk hier alle podia van onze festivals.</p>

<?php foreach ($evenementen as $eventId => $event) { ?>

<h2 style="margin-top: 40px;"><?php echo $event['titel']; ?></h2>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
    <?php foreach ($event['podia'] as $podium) { 
        // Tel optredens op dit podium
        $sql_count = "SELECT COUNT(*) as aantal FROM OPTREDEN WHERE PODIUM_ID = " . $podium['ID'];
        $result_count = mysqli_query($conn, $sql_count);
        $count = mysqli_fetch_assoc($result_count);
    ?>
    <div style="background: #16213e; padding: 25px; border-radius: 10px; border: 1px solid #333;">
        <h3 style="margin-top: 0;"><?php echo $podium['NAAM']; ?></h3>
        <p style="color: #aaa;"><?php echo $podium['OMSCHRIJVING']; ?></p>
        <p style="color: #f7c948; margin-top: 10px;">
            <?php echo $count['aantal']; ?> optreden(s) gepland
        </p>
    </div>
    <?php } ?>
</div>

<?php } ?>

<?php include 'includes/footer.php'; ?>
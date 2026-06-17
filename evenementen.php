<?php
$pageTitle = 'Evenementen';
include 'includes/header.php';

// Haal alle evenementen op
$sql = "SELECT * FROM EVENEMENT ORDER BY START_DATUM";
$result = mysqli_query($conn, $sql);
?>

<h1>Evenementen</h1>
<p>Bekijk hier alle festivals die wij promoten.</p>

<?php
// Loop door alle evenementen
while ($evenement = mysqli_fetch_assoc($result)) {
    // Tel het aantal podia voor dit evenement
    $sql_podia = "SELECT COUNT(*) as aantal FROM PODIUM WHERE EVENEMENT_ID = " . $evenement['ID'];
    $result_podia = mysqli_query($conn, $sql_podia);
    $podia = mysqli_fetch_assoc($result_podia);

    // Tel het aantal optredens voor dit evenement
    $sql_optredens = "SELECT COUNT(*) as aantal FROM OPTREDEN WHERE EVENEMENT_ID = " . $evenement['ID'];
    $result_optredens = mysqli_query($conn, $sql_optredens);
    $optredens = mysqli_fetch_assoc($result_optredens);
?>

<div style="background: #16213e; padding: 25px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #333;">
    <h2 style="margin-top: 0;"><?php echo $evenement['TITEL']; ?></h2>
    <p><?php echo $evenement['OMSCHRIJVING']; ?></p>
    <p>
        <strong>Datum:</strong> 
        <?php echo date('d M Y', strtotime($evenement['START_DATUM'])) . ' - ' . date('d M Y', strtotime($evenement['EIND_DATUM'])); ?>
    </p>
    <p>
        <span style="color: #f7c948;"><?php echo $podia['aantal']; ?> podia</span> | 
        <span style="color: #ff3366;"><?php echo $optredens['aantal']; ?> optredens</span>
    </p>
    <a href="evenement_detail.php?id=<?php echo $evenement['ID']; ?>" style="display: inline-block; padding: 8px 16px; background: #ff3366; color: white; text-decoration: none; border-radius: 5px; margin-top: 10px;">
        Bekijk details
    </a>
</div>

<?php } ?>

<?php include 'includes/footer.php'; ?>
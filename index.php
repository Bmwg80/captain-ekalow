<?php
$pageTitle = 'Home';
include 'includes/header.php';

// Haal featured evenement op
$sql = "SELECT * FROM EVENEMENT ORDER BY START_DATUM LIMIT 1";
$result = mysqli_query($conn, $sql);
$featured = mysqli_fetch_assoc($result);

// Haal aantallen op
$artiesten_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ARTIEST"));
$podia_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM PODIUM"));
$evenementen_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM EVENEMENT"));
$optredens_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM OPTREDEN"));
?>

<h1>Welkom bij Rockstar Events</h1>
<p>Wij zijn een evenementenbureau dat gespecialiseerd is in het promoten van festivals.</p>

<div style="background: #16213e; padding: 30px; border-radius: 10px; margin: 30px 0;">
    <h2 style="margin-top: 0;">Featured: <?php echo $featured['TITEL']; ?></h2>
    <p><?php echo $featured['OMSCHRIJVING']; ?></p>
    <p><strong>Datum:</strong> 
        <?php echo date('d M', strtotime($featured['START_DATUM'])) . ' - ' . date('d M Y', strtotime($featured['EIND_DATUM'])); ?>
    </p>
    <a href="evenementen.php" style="display: inline-block; padding: 10px 20px; background: #ff3366; color: white; text-decoration: none; border-radius: 5px; margin-top: 10px;">
        Bekijk alle evenementen
    </a>
</div>

<h2>Onze cijfers</h2>
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
    <div style="background: #16213e; padding: 20px; border-radius: 10px; text-align: center;">
        <h3 style="color: #f7c948; font-size: 32px; margin: 0;"><?php echo $evenementen_count; ?></h3>
        <p>Evenementen</p>
    </div>
    <div style="background: #16213e; padding: 20px; border-radius: 10px; text-align: center;">
        <h3 style="color: #f7c948; font-size: 32px; margin: 0;"><?php echo $artiesten_count; ?></h3>
        <p>Artiesten</p>
    </div>
    <div style="background: #16213e; padding: 20px; border-radius: 10px; text-align: center;">
        <h3 style="color: #f7c948; font-size: 32px; margin: 0;"><?php echo $podia_count; ?></h3>
        <p>Podia</p>
    </div>
    <div style="background: #16213e; padding: 20px; border-radius: 10px; text-align: center;">
        <h3 style="color: #f7c948; font-size: 32px; margin: 0;"><?php echo $optredens_count; ?></h3>
        <p>Optredens</p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
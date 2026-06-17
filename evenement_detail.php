<?php
$pageTitle = 'Evenement Detail';
include 'includes/header.php';

// Haal het evenement op via ID uit de URL
$id = $_GET['id'] ?? 0;
$id = intval($id); // Beveiliging: zorg dat het een getal is

$sql = "SELECT * FROM EVENEMENT WHERE ID = $id";
$result = mysqli_query($conn, $sql);
$evenement = mysqli_fetch_assoc($result);

// Als het evenement niet bestaat, terugsturen
if (!$evenement) {
    header('Location: evenementen.php');
    exit;
}

// Haal podia op voor dit evenement
$sql_podia = "SELECT * FROM PODIUM WHERE EVENEMENT_ID = $id";
$result_podia = mysqli_query($conn, $sql_podia);

// Haal optredens op voor dit evenement met artiest info
$sql_optredens = "SELECT o.*, a.NAAM as ARTIEST_NAAM, p.NAAM as PODIUM_NAAM 
                  FROM OPTREDEN o
                  JOIN ARTIEST a ON o.ARTIEST_ID = a.ID
                  JOIN PODIUM p ON o.PODIUM_ID = p.ID
                  WHERE o.EVENEMENT_ID = $id
                  ORDER BY o.DATUM, o.TIJD";
$result_optredens = mysqli_query($conn, $sql_optredens);
?>

<h1><?php echo $evenement['TITEL']; ?></h1>
<p><a href="evenementen.php" style="color: #ff3366;">← Terug naar evenementen</a></p>

<div style="background: #16213e; padding: 25px; border-radius: 10px; margin: 20px 0;">
    <p><?php echo $evenement['OMSCHRIJVING']; ?></p>
    <p><strong>Datum:</strong> 
        <?php echo date('d M Y', strtotime($evenement['START_DATUM'])) . ' - ' . date('d M Y', strtotime($evenement['EIND_DATUM'])); ?>
    </p>
</div>

<h2>Podia</h2>
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; margin-bottom: 30px;">
    <?php while ($podium = mysqli_fetch_assoc($result_podia)) { ?>
    <div style="background: #16213e; padding: 20px; border-radius: 10px; border: 1px solid #333;">
        <h3 style="margin-top: 0;"><?php echo $podium['NAAM']; ?></h3>
        <p style="color: #aaa;"><?php echo $podium['OMSCHRIJVING']; ?></p>
    </div>
    <?php } ?>
</div>

<h2>Programma / Line-up</h2>
<table style="width: 100%; border-collapse: collapse; background: #16213e; border-radius: 10px; overflow: hidden;">
    <tr style="background: #ff3366;">
        <th style="padding: 12px; text-align: left;">Tijd</th>
        <th style="padding: 12px; text-align: left;">Artiest</th>
        <th style="padding: 12px; text-align: left;">Podium</th>
        <th style="padding: 12px; text-align: left;">Datum</th>
    </tr>
    <?php while ($optreden = mysqli_fetch_assoc($result_optredens)) { ?>
    <tr style="border-bottom: 1px solid #333;">
        <td style="padding: 12px;"><?php echo date('H:i', strtotime($optreden['TIJD'])); ?></td>
        <td style="padding: 12px;"><strong><?php echo $optreden['ARTIEST_NAAM']; ?></strong></td>
        <td style="padding: 12px;"><?php echo $optreden['PODIUM_NAAM']; ?></td>
        <td style="padding: 12px;"><?php echo date('d M', strtotime($optreden['DATUM'])); ?></td>
    </tr>
    <?php } ?>
</table>

<?php include 'includes/footer.php'; ?>
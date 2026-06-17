<?php
$pageTitle = 'Optredens';
include 'includes/header.php';

// Haal alle optredens op met alle info
$sql = "SELECT o.*, 
        a.NAAM as ARTIEST_NAAM, 
        p.NAAM as PODIUM_NAAM,
        e.TITEL as EVENEMENT_TITEL,
        e.ID as EVENEMENT_ID
        FROM OPTREDEN o
        JOIN ARTIEST a ON o.ARTIEST_ID = a.ID
        JOIN PODIUM p ON o.PODIUM_ID = p.ID
        JOIN EVENEMENT e ON o.EVENEMENT_ID = e.ID
        ORDER BY e.START_DATUM, o.DATUM, o.TIJD";
$result = mysqli_query($conn, $sql);
?>

<h1>Optredens</h1>
<p>Hier zie je het complete timetable van alle festivals.</p>

<table style="width: 100%; border-collapse: collapse; background: #16213e; border-radius: 10px; overflow: hidden; margin-top: 20px;">
    <tr style="background: #ff3366;">
        <th style="padding: 12px; text-align: left;">Evenement</th>
        <th style="padding: 12px; text-align: left;">Datum</th>
        <th style="padding: 12px; text-align: left;">Tijd</th>
        <th style="padding: 12px; text-align: left;">Artiest</th>
        <th style="padding: 12px; text-align: left;">Podium</th>
        <th style="padding: 12px; text-align: left;">Titel</th>
    </tr>
    <?php while ($optreden = mysqli_fetch_assoc($result)) { ?>
    <tr style="border-bottom: 1px solid #333;">
        <td style="padding: 12px;">
            <a href="evenement_detail.php?id=<?php echo $optreden['EVENEMENT_ID']; ?>" style="color: #ff3366; text-decoration: none;">
                <?php echo $optreden['EVENEMENT_TITEL']; ?>
            </a>
        </td>
        <td style="padding: 12px;"><?php echo date('d M Y', strtotime($optreden['DATUM'])); ?></td>
        <td style="padding: 12px;"><?php echo date('H:i', strtotime($optreden['TIJD'])); ?></td>
        <td style="padding: 12px;"><strong><?php echo $optreden['ARTIEST_NAAM']; ?></strong></td>
        <td style="padding: 12px;"><?php echo $optreden['PODIUM_NAAM']; ?></td>
        <td style="padding: 12px;"><?php echo $optreden['TITEL']; ?></td>
    </tr>
    <?php } ?>
</table>

<?php include 'includes/footer.php'; ?>
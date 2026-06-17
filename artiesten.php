<?php
$pageTitle = 'Artiesten';
include 'includes/header.php';

// Haal alle artiesten op
$sql = "SELECT * FROM ARTIEST ORDER BY NAAM";
$result = mysqli_query($conn, $sql);
?>

<h1>Artiesten</h1>
<p>Bekijk hier alle artiesten die bij onze festivals optreden.</p>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
    <?php while ($artiest = mysqli_fetch_assoc($result)) { 
        // Zoek optredens voor deze artiest
        $sql_opt = "SELECT o.*, e.TITEL as EVENEMENT_TITEL, p.NAAM as PODIUM_NAAM 
                    FROM OPTREDEN o
                    JOIN EVENEMENT e ON o.EVENEMENT_ID = e.ID
                    JOIN PODIUM p ON o.PODIUM_ID = p.ID
                    WHERE o.ARTIEST_ID = " . $artiest['ID'];
        $result_opt = mysqli_query($conn, $sql_opt);
        $optreden = mysqli_fetch_assoc($result_opt);
    ?>
    <div style="background: #16213e; padding: 25px; border-radius: 10px; border: 1px solid #333;">
        <h2 style="margin-top: 0;"><?php echo $artiest['NAAM']; ?></h2>
        <p style="color: #aaa;"><?php echo $artiest['OMSCHRIJVING']; ?></p>

        <?php if ($optreden) { ?>
        <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #333;">
            <p><strong style="color: #ff3366;">Optreden:</strong></p>
            <p><?php echo $optreden['EVENEMENT_TITEL']; ?></p>
            <p><?php echo date('d M', strtotime($optreden['DATUM'])) . ' om ' . date('H:i', strtotime($optreden['TIJD'])); ?></p>
            <p>Podium: <?php echo $optreden['PODIUM_NAAM']; ?></p>
        </div>
        <?php } else { ?>
        <p style="color: #888; margin-top: 15px;">Geen optredens gepland</p>
        <?php } ?>
    </div>
    <?php } ?>
</div>

<?php include 'includes/footer.php'; ?>
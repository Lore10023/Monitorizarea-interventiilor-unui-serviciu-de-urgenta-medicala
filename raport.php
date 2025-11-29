<?php
// Includere conexiune BD
include 'connect_bd.php';

// Verificare conexiune BD
if(!isset($bd) || !$bd instanceof PDO){
	die("Eroare: Conexiunea la baza de date este invalida.");
}

// Interogare SQL 
$sql_query = "
    select
    p.nume as nume_pacient,
    p.cnp as cnp_pacient,
    count(i.id) as nr_total_interventii,
    avg(i.timp_reactie) as timp_mediu_reactie
    from pacienti p
    left join
    interventii i on p.cnp = i.cnp
    group by 
    p.cnp, p.nume
    order by 
    p.nume
";

try {
    $rezultat = $bd->query($sql_query);
} catch (PDOException $e) {
    die("<h2 style='color: red;'>Eroare SQL: " . $e->getMessage() . "</h2><a href='home.html'>Inapoi</a>");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Raport interventii pacienti</title>
    <style>
        body { font-family: sans-serif; margin: 15px; }
        table { border-collapse: collapse; margin-top: 10px; width: 60%; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #eee; }
        a { display: block; margin-top: 15px; }
    </style>
</head>
<body>

<h2>Raport interventii pacienti</h2>

<?php 
if ($rezultat && $rezultat->rowCount() > 0): 
?>

    <table>
        <thead>
            <tr>
                <th>Nume pacient</th>
                <th>CNP</th>
                <th>Nr. interventii</th>
                <th>Timp mediu reactie</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while ($rand = $rezultat->fetch(PDO::FETCH_ASSOC)): 
            ?>
            <tr>
                <td><?= htmlspecialchars($rand['nume_pacient']); ?></td>
                <td><?= htmlspecialchars($rand['cnp_pacient']); ?></td>
                <td><?= htmlspecialchars($rand['nr_total_interventii']); ?></td>
                <td><?= number_format($rand['timp_mediu_reactie'], 2); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

<?php else: ?>
    <p>Nu s-au gasit interventii inregistrate.</p>
<?php endif; ?>

<a href='home.html'>&larr; Inapoi la meniu</a>

</body>
</html>

<?php
// Eliberarea resurselor la finalul scriptului
$rezultat = null;
$bd = null;
?>

<?php
// Includere conexiune BD
include 'connect_bd.php';

// Verificare conexiune BD
if (!isset($bd) || !$bd instanceof PDO) {
    die("Eroare: Conexiunea la baza de date este invalida.");
}

// Interogare SQL 
$sql_query = "
    select 
    p.nume as nume_pacient,
    p.cnp as cnp_pacient,
    i.descriere as descriere_interventie,
    i.data as data_interventie,
    m.nume as nume_medic,
    i.timp_reactie as timp_reactie_interventie
    from pacienti p
    join interventii i on p.cnp = i.cnp
    join medici m on i.id_medic = m.id
    order by 
    nume_pacient asc, 
    nume_medic asc,
    timp_reactie desc;
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
    <title>Raport detaliat interventii</title>
    <style>
        body { font-family: sans-serif; margin: 15px; }
        table { border-collapse: collapse; margin-top: 10px; width: 95%; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #eee; }
        a { display: block; margin-top: 15px; }
    </style>
</head>
<body>

<h2>Raport detaliat interventii</h2>

<?php 
if ($rezultat && $rezultat->rowCount() > 0): 
?>

    <table>
        <thead>
            <tr>
                <th>Nume pacient</th>
                <th>CNP</th>
                <th>Descriere</th>
                <th>Data</th>
                <th>Medic</th>
                <th>Timp reactie</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while ($rand = $rezultat->fetch(PDO::FETCH_ASSOC)): 
            ?>
            <tr>
                <td><?= htmlspecialchars($rand['nume_pacient']); ?></td>
                <td><?= htmlspecialchars($rand['cnp_pacient']); ?></td>
                <td><?= htmlspecialchars($rand['descriere_interventie']); ?></td>
                <td><?= htmlspecialchars($rand['data_interventie']); ?></td>
                <td><?= htmlspecialchars($rand['nume_medic']); ?></td>
                <td><?= htmlspecialchars($rand['timp_reactie_interventie']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

<?php else: ?>
    <p>Nu s-au gasit interventii inregistrate pentru a genera raportul detaliat.</p>
<?php endif; ?>

<a href='home.html'>&larr; Inapoi la meniu</a>

</body>
</html>

<?php
// Eliberarea resurselor la finalul scriptului
$rezultat = null;
$bd = null;
?>
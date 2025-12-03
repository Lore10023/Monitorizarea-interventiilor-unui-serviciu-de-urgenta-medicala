<?php

// Includere conexiune BD
include 'connect_bd.php';

// Verificare conexiune BD
if(!isset($bd) || !$bd instanceof PDO){
	die("Eroare: Conexiunea la baza de date este invalida.");
}

$message = '';

//blocul de cod se executa doar dupa ce utilizatorul a apasat butonul de trimitere intr un formular care foloseste metoda post 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Preluarea datelor din formular
    $cnp= $_POST['cnp'];
    $descriere= $_POST['descriere'];
    $data_interventie= $_POST['data_interventie'];
    $id_medic= $_POST['id_medic'];
    $timp_reactie= $_POST['timp_reactie'];

    try{
        $stm=$bd->prepare("CALL Adaugare_interventii(?,?,?,?,?)");

        // Legarea valorilor la parametri 
        $stm->bindValue(1, $cnp, PDO::PARAM_STR);
        $stm->bindValue(2, $descriere, PDO::PARAM_STR);
        $stm->bindValue(3, $data_interventie, PDO::PARAM_STR);
        $stm->bindValue(4, $id_medic, PDO::PARAM_INT);
        $stm->bindValue(5, $timp_reactie, PDO::PARAM_INT);

        $stm->execute();
        $message = "Interventie adaugata cu SUCCES.";
    }catch (PDOEception $e){
        $message = "Eroare la adaugarea interventiei: ".$e->getMessage()."</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Adaugare Interventie</title>
   <style>
    body 
    { 
        font-family: Arial, 
        sans-serif; 
    }
    form 
    { 
        max-width: 400px; 
        margin: 20px auto; 
        padding: 20px; 
    }
    input[type="text"], input[type="number"], input[type="date"] 
    { 
        width: 100%;
        margin-bottom:20px;
    }
    button
    {
        padding:20px;
        font-size:16px;
    }
   </style>
</head>
<body>

    <h2>Adaugare Interventie Noua</h2>

    <?php echo $message;?>

    <form method="POST" action="">
        <label for="cnp">CNP Pacient:</label>
        <input type="text" id="cnp" name="cnp" maxlength="13" required>

        <label for="descriere">Descriere:</label>
        <input type="text" id="descriere" name="descriere" maxlength="60" required>

        <label for="data_interventie">Data Interventiei:</label>
        <input type="date" id="data_interventie" name="data_interventie" value="<?php echo date('Y-m-d'); ?>" required>

        <label for="id_medic">ID Medic:</label>
        <input type="number" id="id_medic" name="id_medic" required>

        <label for="timp_reactie">Timp Reactie (secunde):</label>
        <input type="number" id="timp_reactie" name="timp_reactie" required>

        <button type="submit">Adauga Interventie</button>
    </form>

    <a href='home.html'>&larr; Inapoi la meniu</a>

</body>
</html>
<?php
try {
    $bd = new PDO("mysql:host=localhost; dbname=serviciu_urgente", "root","");
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexiune reusita!";
} catch (PDOException $e) {
    echo "Eroare la conexiune: " . $e->getMessage();
}
?>

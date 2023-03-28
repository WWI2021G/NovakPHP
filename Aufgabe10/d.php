<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Preisgruppenfilter</h1>
    <form action="d.php" method="post">
        <label><input type="radio" name="price_group" value="all" checked>Alle Preise</label><br>
        <label><input type="radio" name="price_group" value="low">Preisgruppe 1 (&lt;= 100)</label><br>
        <label><input type="radio" name="price_group" value="medium">Preisgruppe 2 (101-500)</label><br>
        <label><input type="radio" name="price_group" value="high">Preisgruppe 3 (&gt; 500)</label><br>
        <input type="submit" value="Filter anwenden">
    </form>
<?php
// Verbindung zur Datenbank herstellen
$conn = new mysqli("localhost", "username", "password", "hardware");

// Überprüfen der Verbindung
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Überprüfen, ob ein Preisgruppen-Parameter im Request existiert, ansonsten die Standard-Gruppe wählen
$price_group = $_REQUEST["price_group"] ?? "all";

// SQL-Anfrage, je nach ausgewählter Preisgruppe
if ($price_group == "low") {
    $sql = "SELECT hersteller, typ, preis FROM fp WHERE preis <= 100 ORDER BY preis";
} elseif ($price_group == "medium") {
    $sql = "SELECT hersteller, typ, preis FROM fp WHERE preis > 100 AND preis <= 500 ORDER BY preis";
} elseif ($price_group == "high") {
    $sql = "SELECT hersteller, typ, preis FROM fp WHERE preis > 500 ORDER BY preis";
} else {
    $sql = "SELECT hersteller, typ, preis FROM fp ORDER BY preis";
}

$result = $conn->query($sql);

// Ergebnisse ausgeben
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Hersteller: " . $row["hersteller"] . ", Typ: " . $row["typ"] . ", Preis: " . $row["preis"] . "<br>";
    }
} else {
    echo "0 Ergebnisse";
}

// Verbindung schließen
$conn->close();
?>

</body>
</html>
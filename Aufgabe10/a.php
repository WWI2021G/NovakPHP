<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// Verbindung zur Datenbank herstellen
$conn = new mysqli("localhost", "username", "password", "hardware");

// Überprüfen der Verbindung
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// SQL-Anfrage
$sql = "SELECT * FROM fp";
$result = $conn->query($sql);

// Ergebnisse ausgeben
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . ", Hersteller: " . $row["hersteller"] . ", Typ: " . $row["typ"] . ", Preis: " . $row["preis"] . "<br>";
    }
} else {
    echo "0 Ergebnisse";
}

// Verbindung schließen
$conn->close();
?>

</body>
</html>
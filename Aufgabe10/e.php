<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Festplattenfilter</h1>
    <form action="festplattenfilter.php" method="post">
        <label>Auswahl des Herstellers:</label>
        <select name="hersteller">
            <option value="Alle">Alle</option>
            <option value="Seagate">Seagate</option>
            <option value="Western Digital">Western Digital</option>
            <option value="Toshiba">Toshiba</option>
            <option value="Samsung">Samsung</option>
            <option value="Hitachi">Hitachi</option>
        </select><br><br>
        <input type="submit" value="Filter anwenden">
    </form>
    <?php
    // Verbindung zur Datenbank herstellen
    $conn = new mysqli("localhost", "username", "password", "hardware");

    // Überprüfen der Verbindung
    if ($conn->connect_error) {
        die("Verbindung fehlgeschlagen: " . $conn->connect_error);
    }

    // Überprüfen, ob ein Hersteller-Parameter im Request existiert, ansonsten "Alle" wählen
    $hersteller = $_REQUEST["hersteller"] ?? "Alle";

    // SQL-Anfrage, je nach ausgewähltem Hersteller
    if ($hersteller == "Alle") {
        $sql = "SELECT hersteller, typ, preis FROM fp";
    } else {
        $sql = "SELECT hersteller, typ, preis FROM fp WHERE hersteller = ?";
    }

    $stmt = $conn->prepare($sql);

    if ($hersteller != "Alle") {
        $stmt->bind_param("s", $hersteller);
    }

    $stmt->execute();

    // Ergebnisse ausgeben
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Hersteller: " . $row["hersteller"] . ", Typ: " . $row["typ"] . ", Preis: " . $row["preis"] . "<br>";
        }
    } else {
        echo "0 Ergebnisse";
    }

    // Verbindung schließen
    $stmt->close();
    $conn->close();
    ?>




</body>

</html>
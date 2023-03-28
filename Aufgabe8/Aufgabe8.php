<html>
    <body>
        <?php
        class Fahrzeug{
            public $farbe;
            public $hersteller;

            function __construct($farbe = "blau", $hersteller = "Mercedes")
            {
                $this->farbe = $farbe;
                $this->hersteller = $hersteller;
            }

            function starten(){
                echo "VROOOOOM VROM VROM VROOM!<br>";
            }

            function stoppen(){
                echo ".....<br>";
            }
        }

        class Auto extends Fahrzeug{
            public $kms;
            function __construct($farbe = "blau", $hersteller = "Mercedes", $kms = 0)
            {
                Fahrzeug::__construct($farbe, $hersteller);
                $this->kms = $kms;
                
            }

            function fahren($km){
                $this->kms += $km;
            }
        }

        $a = new Fahrzeug("rot","bmw");
        $a->starten();
        $a->stoppen();
        ?>
    </body>
</html>
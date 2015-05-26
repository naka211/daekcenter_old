<?php

class car {

    public static
    $IX_REGNO = 0,
    $IX_ID = 1,
    $IX_DEALERID = 2,
    $IX_CARREGNO = 3,
    $IX_VINNO = 4,
    $IX_OWNER = 5,
    $IX_IPADDR = 6,
    $IX_TS = 7;
    private static
    $COL_NAMES = array("regno", "id", "dealerid", "carregno", "vinno", "owner", "ipaddr", "ts");
    private static
    $sqlbase = "SELECT * FROM dc_dealer_car AS a
        LEFT OUTER JOIN dc_dealer_car_info AS b ON a.regno=b.carregno AND b.dealerid=";

    //
    public static function fetch($con, $dealerid, $regno) {
        $obj = null;
        if (($row = car::fetchRow($con, $dealerid, $regno))) {
            $car = new car();
            $car->setData($row, $dealerid);
            $obj = $car;
        }
        return $obj;
    }

    private static function fetchRow($con, $dealerid, $regno) {
        $sql = car::$sqlbase . $dealerid . " WHERE a.regno='" . mysqli_real_escape_string($con, $regno) . "' ORDER BY b.ts DESC LIMIT 1";
        $result = dbquery($con, $sql);
        return $result->fetch_assoc();
    }

    //
    private $values;

    private function setData($row, $dealerid) {
        for ($i = 0; $i < count(car::$COL_NAMES); $i++) {
            $this->values[$i] = $row[car::$COL_NAMES[$i]];
        }
        if (strlen($this->values[car::$IX_DEALERID]) < 1) {
            $this->values[car::$IX_DEALERID] = $dealerid;
        }
    }

    public function setNew($dealerid, $regno) {
        $this->values[car::$IX_DEALERID] = $dealerid;
        $this->values[car::$IX_CARREGNO] = $regno;
    }

    public function getValue($ix) {
        return $this->values[$ix];
    }

    public function saveValues($con, $vinno, $owner) {
        $regno = $this->values[car::$IX_REGNO];
        $vinno = mysqli_real_escape_string($con, $vinno);
        if (strlen($vinno) > 0) {
            $vinno = strtoupper($vinno);
        }
        $owner = mysqli_real_escape_string($con, $owner);
        echo "saveValues funtion ";
        if (strlen($regno) < 1) { // create regno
            echo "save new regno ";
            $regno = mysqli_real_escape_string($con, $this->values[car::$IX_CARREGNO]);
            $sql = "INSERT IGNORE INTO dc_dealer_car VALUES '" . $regno . "'";
            $result = dbquery($con, $sql);
        }
        echo "past new regno ";
        if (strcmp($this->values[car::$IX_VINNO], $vinno) != 0 || strcmp($this->values[car::$IX_OWNER], $owner) != 0) { // update if new data
            echo "save new data ";
            $dealerid = mysqli_real_escape_string($con, $this->values[car::$IX_DEALERID]);
            $ipaddr = $_SERVER['REMOTE_ADDR'];
            $sql = "INSERT INTO dc_dealer_car_info (" . car::$COL_NAMES[car::$IX_DEALERID] . ", " . car::$COL_NAMES[car::$IX_CARREGNO] . ", " . car::$COL_NAMES[car::$IX_VINNO] . ", " . car::$COL_NAMES[car::$IX_OWNER] . ", " . car::$COL_NAMES[car::$IX_IPADDR] . ")
            VALUES ('" . $dealerid . "', '" . $regno . "', '" . $vinno . "', '" . $owner . "', '" . $ipaddr . "')";
            $result = dbquery($con, $sql);
            $this->setData(car::fetchRow($con, $dealerid, $regno), $dealerid);
        }
        echo "past new data ";
    }

}

?>

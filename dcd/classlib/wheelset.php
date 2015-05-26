<?php

class wheelset {

    public static
    $IX_ID = 0,
    $IX_DEALERID = 1,
    $IX_REGNO = 2,
    $IX_RIMTYPEID = 3,
    $IX_TIRETYPEID = 4,
    $IX_WIDTH = 5,
    $IX_PROFILE = 6,
    $IX_DIAMETER = 7,
    $IX_SPEEDRATING = 8,
    $IX_REMARK = 9;
    private static
    $COL_NAMES = array("id", "dealerid", "carregno", "rimtypeid", "tiretypeid", "width", "profile", "diameter", "speedrating", "remark");
    private static
    $sqlbase = "SELECT a.*, b.name AS rimtypename, c.name AS tiretypename FROM dc_dealer_wheelset AS a
        LEFT OUTER JOIN dc_dealer_wheelset_rimtype AS b ON a.rimtypeid=b.id
        LEFT OUTER JOIN dc_dealer_wheelset_tiretype AS c ON a.tiretypeid=c.id
        WHERE a.dealerid=";

    //
    public static function fetch($con, $dealerid, $id) {
        $obj = null;
        $sql = wheelset::$sqlbase . $dealerid . " AND a.id=" . mysqli_real_escape_string($con, $id);
        $result = dbquery($con, $sql);
        if (($row = $result->fetch_assoc())) {
            $wheelset = new wheelset();
            $wheelset->setData($row);
            $obj = $wheelset;
        }
        return $obj;
    }

    public static function get($con, $dealerid, $regno) {
        $sql = wheelset::$sqlbase . $dealerid . " AND a.carregno='" . mysqli_real_escape_string($con, $regno) . "' ORDER BY c.sorting";
        $result = dbquery($con, $sql);
        $objs = array();
        while ($row = $result->fetch_assoc()) {
            $wheelset = new wheelset();
            $wheelset->setData($row);
            $objs[] = $wheelset;
        }
        return $objs;
    }

    public static function getRimTypeNames($con) {
        $sql = "SELECT * FROM dc_dealer_wheelset_rimtype ORDER BY sorting";
        $result = dbquery($con, $sql);
        $names = array();
        while ($row = $result->fetch_assoc()) {
            $names[] = array($row['id'], $row['name']);
        }
        return $names;
    }

    public static function getTireTypeNames($con) {
        $sql = "SELECT * FROM dc_dealer_wheelset_tiretype ORDER BY sorting";
        $result = dbquery($con, $sql);
        $names = array();
        while ($row = $result->fetch_assoc()) {
            $names[] = array($row['id'], $row['name']);
        }
        return $names;
    }

    //
    private $values, $rimtypename, $tiretypename;

    private function setData($row) {
        for ($i = 0; $i < count(wheelset::$COL_NAMES); $i++) {
            $this->values[$i] = $row[wheelset::$COL_NAMES[$i]];
        }
        $this->rimtypename = $row['rimtypename'];
        $this->tiretypename = $row['tiretypename'];
    }

    public function setNew($dealerid, $regno) {
        $this->values[wheelset::$IX_DEALERID] = $dealerid;
        $this->values[wheelset::$IX_REGNO] = $regno;
    }

    public function getCar($con) {
        $car = car::fetch($con, $this->values[wheelset::$IX_DEALERID], $this->values[wheelset::$IX_REGNO]);
        if ($car == null) {
            $car = new car();
            $car->setNew($this->values[wheelset::$IX_DEALERID], $this->values[wheelset::$IX_REGNO]);
        }
        return $car;
    }

    public function getValue($ix) {
        return $this->values[$ix];
    }

    public function getRimTypeName() {
        return $this->rimtypename;
    }

    public function getTireTypeName() {
        return $this->tiretypename;
    }

    public function getTireSize() {
        return $this->values[wheelset::$IX_WIDTH] . "/" . $this->values[wheelset::$IX_PROFILE] . "-" . $this->values[wheelset::$IX_DIAMETER];
    }

}

?>

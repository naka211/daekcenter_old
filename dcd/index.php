<?php
include "classlib/wheelset.php";
include "classlib/car.php";
error_reporting(0);
$clientip = $_SERVER['REMOTE_ADDR'];
$viewer = $_POST["v"];
$dealerno = $_POST["dno"];
$regno = $_POST["rno"];
if (strlen($regno) > 0) {
    $regno = strtoupper($regno);
}
$viewermode = false;
// determine viewermode or else load parameters for validation
// if dealerno and regno given POST and viewer true then viewer mode
if ($viewer == "true" && strlen($dealerno) > 0 && strlen($regno) > 0) {
    $viewermode = true;
    echo "<!-- viewermode -->\n";
} else { // user mode with login
    $debugmode = $_GET["bugmode"];
    $dealerno = $_GET["dno"];
    $dealerpw = $_GET["dpw"];
    if (session_start ()) {
        if (strlen($debugmode) > 0) {
            $_SESSION["debug"] = $debugmode;
        } else {
            $debugmode = $_SESSION["debug"];
        }
        if (strlen($dealerno) > 0) {
            $_SESSION["dealerno"] = $dealerno;
        } else {
            $dealerno = $_SESSION["dealerno"];
        }
        if (strlen($dealerpw) > 0) {
            $_SESSION["dealerpw"] = $dealerpw;
        } else {
            $dealerpw = $_SESSION["dealerpw"];
        }
        if (strlen($dealerno) > 0 && strlen($dealerpw) > 0) {
            $superval = $_SESSION["superval"];
        }
    } else {
        echo "<!-- Session error -->\n";
    }
}
// set debug mode
$debug = false;
if ($debugmode == "doit") {
    $debug = true;
    error_reporting(-1);
    $GLOBALS['debug'] = "true";
    echo "<!-- client ip: " . $clientip . " -->\n";
}

// db function
function dbquery($con, $sql) {
    if ($GLOBALS['debug'] == "true") {
        echo "<!-- query: " . $sql . " -->\n";
    }
    if (($result = $con->query($sql))) {
        // no error
    } else if ($GLOBALS['debug'] == "true") {
        echo "<!-- ERROR query: " . $con->error . "-->\n";
    } else {
        echo "<!-- ERROR database query -->\n";
    }
    return $result;
}

// database connection and validation
$validated = false;
$action = "";
$title = "Dækcenter.nu dækhotel";
// connect to database if dealerno given
if (strlen($dealerno) > 0) {
    $con = new mysqli("mysql02.dandomain.dk", "u12g4xr", "WzKf2GTrE", "u12g4xr");
    if ($con->connect_error) {
        if ($debug) {
            echo "<!-- ERROR connect: " . $con->connect_error . "-->\n";
        }
    } else {
        $connected = true;
        mysqli_set_charset($con, "utf8");
        // get dealer info and validation
        $sql = "SELECT * FROM dc_dealer WHERE no='" . mysqli_real_escape_string($con, $dealerno) . "'";
        $result = dbquery($con, $sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $title = $row['name'] . " dækhotel";
            $dealerid = $row['id'];
            // validate user with pw and ip
            if (!$viewermode && $row['pw'] == $dealerpw && ($row['easylogin'] == 1 || $superval == "true")) {
                $sql = "SELECT * FROM dc_dealer_ip WHERE dealerid=" . $dealerid . " AND ipaddr='" . mysqli_real_escape_string($con, $clientip) . "'";
                $result = dbquery($con, $sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if ($row['ipaddr'] == $clientip) {
                        $validated = true;
                        $action = $_POST["action"];
                    } else if ($debug) {
                        echo "<!-- IP validation mismatch -->\n";
                    }
                } else if ($debug) {
                    echo "<!-- IP not validated -->\n";
                }
            }
        } else {
            echo "<!-- Missing customer info " . $result->num_rows . " -->\n";
        }
    }
}
// determine createupdate and pagetype
$pagetype = "";
// overview
// login
// wheelset
// event
// menu (enter regno and in stock list)
if ($viewermode) {
    $pagetype = "overview";
} else if (!$validated) {
    $pagetype = "login";
} else if ($action === "wheelset") {
    $pagetype = "wheelset";
} else if ($action === "savewheelset") {
    $pagetype = "wheelset";
} else if ($action === "event") {
    $pagetype = "event";
} else if ($action === "saveevent") {
    $pagetype = "event";
} else if ($action === "menu") {
    $pagetype = "menu";
} else if (strlen($regno) > 0) { // if validated, no action and given regno
    $pagetype = "overview";
} else {
    $pagetype = "menu";
}
// create data object for wheelset and event
if ($pagetype === "wheelset") {
    $wheelsetid = $_POST['wheelsetid'];
    if (strlen($wheelsetid) > 0) {
        $wheelset = wheelset::fetch($con, $dealerid, $wheelsetid);
    } else {
        $wheelset = new wheelset();
        $wheelset->setNew($dealerid, $regno);
    }
    $car = $wheelset->getCar($con);
    // create radiobutton code for choices
    $rbrimtypes = "";
    $rimnames = wheelset::getRimTypeNames($con);
    for ($i = 0; $i < count($rimnames); $i++) {
        if ($i > 0) {
            $rbrimtypes .= "<br>";
        }
        $rbrimtypes .= "<input type=\"radio\" name=\"wheelsetrimtypeid\" value=\"" . $rimnames[$i][0] . "\"";
        if ($wheelset->getValue(wheelset::$IX_RIMTYPEID) == $rimnames[$i][0]) {
            $rbrimtypes .= " checked";
        }
        $rbrimtypes .= ">" . $rimnames[$i][1];
    }
    $rbtiretypes = "";
    $rimnames = wheelset::getTireTypeNames($con);
    for ($i = 0; $i < count($rimnames); $i++) {
        if ($i > 0) {
            $rbtiretypes .= "<br>";
        }
        $rbtiretypes .= "<input type=\"radio\" name=\"wheelsettiretypeid\" value=\"" . $rimnames[$i][0] . "\"";
        if ($wheelset->getValue(wheelset::$IX_TIRETYPEID) == $rimnames[$i][0]) {
            $rbtiretypes .= " checked";
        }
        $rbtiretypes .= ">" . $rimnames[$i][1];
    }
    // create update db
    if ($action === "savewheelset") {
        $car->saveValues($con, $_POST['carvinno'], $_POST['carowner']);
    }
} else if ($pagetype === "event") {
    $eventid = $_POST['eventid'];
}
// build datacode
$datacode = "";
if ($pagetype === "overview") {
    $wheelsets = wheelset::get($con, $dealerid, $regno);
    if (count($wheelsets) > 0) {
        $datacode = "<table>";
        foreach ($wheelsets as $wheelset) {
            $datacode .= "<tr><td>" . $wheelset->getTireTypeName() . "</td><td>" . $wheelset->getRimTypeName() . "</td><td>" . $wheelset->getTireSize() . "</td><td>" . $wheelset->getValue(wheelset::$IX_SPEEDRATING) . "</td><td>" . $wheelset->getValue(wheelset::$IX_REMARK) . "</td>";
            if (!$viewermode) {
                $datacode .= "<td><form method=\"post\" target=\"_self\">" .
                        "<input type=\"hidden\" name=\"action\" value=\"wheelset\">" .
                        "<input type=\"hidden\" name=\"wheelsetid\" value=\"" . $wheelset->getValue(wheelset::$IX_ID) . "\">" .
                        "<input type=\"submit\" value=\"Ret\">" .
                        "</form></td>";
            }
            $datacode .= "</tr>";
        }
        $datacode .= "</table>";
    } else {
        $datacode = "Ingen hjul registreret på " . $regno;
    }
}
// close db connection if opened
if ($connected) {
    $con->close();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <link href="dcdstyle.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <p><?php echo $title; ?></p>
        <?php
        echo ">>>> æ ø å";
        echo "<table>";
        foreach ($_POST as $key => $value) {
            echo "<tr>";
            echo "<td>";
            echo $key;
            echo "</td>";
            echo "<td>";
            echo $value;
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo ">>>> Æ Ø Å<br>dno " . $dealerno . " - dpw " . $dealerpw . " - VMod: " . $viewermode . " - Val: " . $validated;
        if ($pagetype == "overview") {
        ?>
            <p>Liste over aktive og inaktive hjulsæt</p>
        <?php echo $datacode; ?>
        <?php
            if (!$viewermode) {
        ?>
                <form action="index.php" method="post" target="_self">
                    <input type="hidden" name="rno" value="<?php echo $regno ?>">
                    <input type="hidden" name="action" value="wheelset">
                    <input type="submit" value="Nyt sæt">
                </form>
        <?php
            }
        } else if ($pagetype === "login") {
        ?>
            login<br>
            <form action="ali.html" method="post" target="_self">
                <input type ="submit" value="login">
            </form>
        <?php
        } else if ($pagetype === "menu") {
        ?>
            <form action="index.php" method="post" target="_self">
                <input type="text" name="rno" value="UT23980"><input type="submit">
            </form>
        <?php
        } else if ($pagetype === "wheelset") {
        ?>
            <table>
                <form action="index.php" method="post" target="_self">
                    <tr><td>Reg. nummer</td><td></td><td><input type="hidden" name="regno" value="<?php echo $car->getValue(car::$IX_REGNO) ?>"><b><?php echo $car->getValue(car::$IX_REGNO) ?></b></td></tr>
                    <tr><td>Stelnummer</td><td></td><td><input type="text" size="17" name="carvinno" value="<?php echo $car->getValue(car::$IX_VINNO) ?>"></td></tr>
                    <tr><td>Navn</td><td></td><td><input type="text" size="40" name="carowner" value="<?php echo $car->getValue(car::$IX_OWNER) ?>"></td></tr>
                    <tr><td colspan="2"></td><td><b>Hjulsæt:</b><input type="hidden" name="wheelsetid" value="<?php echo $wheelset->getValue(wheelset::$IX_ID) ?>"></td></tr>
                    <tr><td>Dæktype</td><td style="color:red">*</td><td><?php echo $rbtiretypes ?></td></tr>
                    <tr><td>Størrelse</td><td style="color:red">*</td><td><input type="text" size="3" name="wheelsetwidth" value="<?php echo $wheelset->getValue(wheelset::$IX_WIDTH) ?>">&nbsp;<b>/</b>&nbsp;<input type="text" size="2" name="wheelsetprofile" value="<?php echo $wheelset->getValue(wheelset::$IX_PROFILE) ?>">&nbsp;<b>-</b>&nbsp;<input type="text" size="2" name="wheelsetdiameter" value="<?php echo $wheelset->getValue(wheelset::$IX_DIAMETER) ?>"></td></tr>
                    <tr><td>Fælgtype</td><td style="color:red">*</td><td><?php echo $rbrimtypes ?></td></tr>
                    <tr><td colspan="2">Bemærkning</td><td><input type="text" size="40" name="wheelsetremark" value="<?php echo $wheelset->getValue(wheelset::$IX_REMARK) ?>"></td></tr>
                    <tr><td colspan="2"></td><td><input type="hidden" name="action" value="savewheelset"><input type="submit" value="Gem"></td></tr>
                </form>
            </table>
            <form action="index.php" method="post" target="_self">
                <input type="hidden" name="rno" value="<?php echo $car->getValue(car::$IX_REGNO) ?>"><input type="submit" value="<?php echo ($action === "savewheelset") ? "Tilbage til oversigt" : "Annuller"; ?>">
            </form>
        <?php
        } else if ($pagetype === "event") {
        ?>
            opret / rette event
        <?php
        }
        ?>
    </body>
</html>

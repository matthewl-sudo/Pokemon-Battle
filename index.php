<?php
include('pokedex.php');
session_start();

if (isset($_GET['attack'])) {
    battle();
}

if (isset($_GET['reset'])) {
    runReset();
}
function runReset() {
    session_unset();

}
foreach ($pokemon as $key => $movelist) {
    foreach ($movelist[$_SESSION["cpu"]] as $key => $value) {
        $_SESSION["cpuAttackName"][$key] = $value['attackname'];
        $_SESSION["cpuAttackDmg"][$key] = $value['damageStat'];
    }
}


function battle(){
    $_SESSION["playerDmg"] = $_GET['attack'];

    // Assign cpu's random attack
    $randAtk = rand(0, 3);
    $_SESSION["cpuAttackName"][$randAtk];
    $_SESSION["cpuAttackDmg"][$randAtk];
    //Calc PLayer Health Points
    $hp = $_SESSION["hp"] - $_SESSION["cpuAttackDmg"][$randAtk];;
    $_SESSION["hp"] = $hp;
    //Calc CPU Health Points
    $hpCpu = $_SESSION["hpCpu"] - $_SESSION["playerDmg"];
    $_SESSION["hpCpu"] = $hpCpu;
    $_SESSION['counter']++;
    // Create Battle Log Message
    $i = $_SESSION['counter'];
    $_SESSION["playerLog$i"] = $_SESSION["player"]." deals ".$_SESSION["playerDmg"]." damage.";
    $_SESSION["cpuLog$i"] = $_SESSION["cpu"]." uses ".$_SESSION["cpuAttackName"][$randAtk]." and deals ".$_SESSION["cpuAttackDmg"][$randAtk]." damage.";
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css">
        <script src="https://kit.fontawesome.com/f5a250744a.js"></script>
        <link rel="stylesheet" href="style.css">

    </head>
    <body>
        <?php include('includes/header.php');
        //Select Pokemon
        if (!isset($_SESSION["player"])) {
            switch ($_GET['pokemon']) {
                case 'Charmander':
                    echo '<p>Charmander Selected</p>';
                    $_SESSION["player"] = 'Charmander';
                    break;
                case 'Squirtle':
                    echo '<p>Squirtle Selected</p>';
                    $_SESSION["player"] = 'Squirtle';
                    break;
                case 'Bulbasaur':
                    echo '<p>Bulbasaur Selected</p>';
                    $_SESSION["player"] = 'Bulbasaur';
                    break;
                default:
                    echo '<div class="container">
                        <h3 class="title is-size-3 is-marginless">Choose your Pokemon</h3>
                        <form class="is-half" action="" method="get">
                            <input class="button is-danger is-size-4" type="submit" name="pokemon" value="Charmander">
                            <input class="button is-primary is-size-4" type="submit" name="pokemon" value="Squirtle">
                            <input class="button is-success is-size-4" type="submit" name="pokemon" value="Bulbasaur">
                        </form>
                    </div>';
                    break;
            }
        }
        ?>
        <br>
        <div class="container">
            <a href='index.php?reset=true' class="button is-danger is-size-4">Reset</a>
        </div>
        <?php
        // If pokemon is select then begin battle
        if ($_SESSION["player"]) {
            echo '
        <div class="columns">
            <div class="container">
                <div class="column is-6 is-offset-5 box" id="charBox">
                    <p class="tag has-text-danger is-size-5">Player: '.$_SESSION["player"].'</p>
                    <img src="'.$_SESSION["player"].'.gif" alt="'.$_SESSION["player"].'" class="char is-pulled-right" id="">
                    <span>
                        <progress class="progress is-marginless" value="'. $_SESSION["hp"].'" max="200"></progress>
                        <p class="tag is-light is-rounded is-size-6 is-pulled-right">'. $_SESSION["hp"].'/200</p>
                        <p class="tag is-light is-rounded is-size-6 is-pulled-right">HP</p>
                    </span>
                    <hr>
                    <ul class=" field is-grouped">
                        <div class="dropdown is-hoverable">
                            <div class="dropdown-trigger">
                                <button class="button is-light is-medium" aria-haspopup="true" aria-controls="dropdown-menu4">
                                    <span>Fight⚔️</span>
                                    <span class="icon is-small">
                                        <i class="fas fa-angle-down" aria-hidden="true"></i>
                                    </span>
                                </button>
                            </div>
                            <div class="dropdown-menu" id="dropdown-menu4" role="menu">
                                <div class="dropdown-content">
                                    <form class="dropdown-item" action="" method="get">';
                                        foreach ($pokemon as $key => $movelist) {
                                                foreach ($movelist[$_SESSION["player"]] as $key => $value) {
                                                    $attackName = $value['attackname'];
                                                    $damage = $value['damageStat'];
                                                    $attackType = $value['type'];
                                                    $btn = $value['btncolor'];
                                                    echo '<button type="submit" value="'.$damage.'" class="button is-'.$btn.'" name="attack" ><strong>'.$attackName.'/'.$attackType.'</strong></button>';
                                                }
                                            }
                                    echo '</form>
                                </div>
                            </div>
                        </div>
                        <li>
                            <button class="button is-light is-medium" type="button" name="button">PKMN.🐾</button>
                        </li>
                    </ul>
                    <ul class=" field is-grouped">
                        <li>
                            <button class="button is-light is-medium" type="button" name="button">Item🛡</button>
                        </li>
                        <li>
                            <button class="button is-light is-medium" type="button" name="button">Run!!!🏃‍</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="column is-6 is-offset-3 box">
                    <p class="tag has-text-success is-size-5">CPU:'.$_SESSION["cpu"].'</p>
                    <img src="'.$_SESSION["cpu"].'2.gif" alt="" class="bulba is-pulled-right">
                    <span>
                        <progress class="progress is-marginless" value="'. $_SESSION["hpCpu"].'" max="200"></progress>
                        <p class="tag is-light is-size-6 is-pulled-right">'. $_SESSION["hpCpu"].'/200</p>
                        <p class="tag is-light is-rounded is-size-6 is-pulled-right">HP</p>
                    </span>
                    <hr>

                </div>
            </div>
        </div>';
    }
    include('includes/battleLog.php');
    include('includes/footer.php'); ?>
    </body>
</html>

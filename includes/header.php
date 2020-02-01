<section class="hero is-small is-primary is-bold">
    <div class="hero-body is-paddingless">
        <div class="container has-text-centered">
            <h1 class="title is-size-3 is-marginless">
                Pokemon Battle
            </h1>
            <h2 class="subtitle is-marginless"><?php
            if (!isset($_SESSION["hp"]) || ($_SESSION["hp"] <= 0)) {
                runReset();
                $_SESSION["cpu"] = $cpuSelect[rand(0,2)];
                $_SESSION["hp"] = 200;
                $_SESSION["hpCpu"] = 200;
                $_SESSION['counter'] = 0;
            }elseif ($_SESSION["hpCpu"] <= 0) {
                $msg = '<p class="is-size-5">Congratulations! '.$_SESSION["player"].' is the WINNER!</p>';
                echo $msg;
                runReset();
            }
            else {
                $battlemsg = '<h2 class="title is-size-1 has-text-centered is-marginless">VS</h2>';
                echo $battlemsg;
                // battle();
            }
             ?>
            </h2>
        </div>
    </div>
</section>

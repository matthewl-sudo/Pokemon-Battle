<article class="message battle-log">
    <div class="message-header">
        <p>Battle Log</p>
        <button class="delete" aria-label="delete"></button>
    </div>
    <div class="message-body">
        <?php
            for ($i=$_SESSION['counter']; $i > 0; $i--) {
                echo '<p class="has-text-danger"> Player: '.$_SESSION["playerLog$i"].'</p>';
                echo '<p class="has-text-success"> CPU: '.$_SESSION["cpuLog$i"].'</p>';
            }
        ?>
    </div>
</article>

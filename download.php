<?php

include('header.php');

$game = new Game();

?>

<div class="container">
    <div class="row">
        <div class="content col s12">
            <div class="user-data col s12">
                <label>Download Client</label>
            </div>

            <div class="download-button col s12 m6 center">
                <form method="POST">
                    <input type="submit" class="btn" name="installer-download" value="Download full client version v1002" />
                </form>
            </div>


            <div class="download-button col s12 m6 center">
                <form method="POST">
                    <input type="submit" class="btn" name="zip-download" value="Download ZIP client version v1002" />
                </form>
            </div>

            <?php if(isset($_POST['installer-download'])): ?>
                <?php $game->Download($_SERVER['REMOTE_ADDR'], 'installer'); ?>
            <?php elseif(isset($_POST['zip-download'])): ?>
                <?php $game->Download($_SERVER['REMOTE_ADDR'], 'zip'); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php

include('footer.php');

?>

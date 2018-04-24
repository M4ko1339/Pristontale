<?php

include('header.php');

$news = new News();

?>

<div class="container">
    <div class="row">
        <div class="news col s12">
            <?php foreach($news->Show() as $row): ?>
                <a href="view.php?id=<?php echo $row['id']; ?>">
                    <div class="card col s12">
                        <div class="card-image">
                            <img src="<?php echo $row['news_banner']; ?>">
                        </div>

                        <div class="card-content col s12">
                            <div class="news-title col s12 m6">
                                <?php echo $row['news_title']; ?>
                            </div>

                            <div class="news-date col s12 m6">
                                <?php echo date('j.F, Y', $row['post_date']); ?>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="col s12 m12 l4">
            <div class="card">
                <div class="card-image center">
                    <i class="fas fa-code"></i>
                </div>

                <div class="card-title">
                    Excellent Scripting
                </div>

                <div class="card-content">
                    Pristontale EU is continuously developed by multiple developers committing to our open source repository. We're providing a high quality and secure Pristontale gameplay experience.
                </div>
            </div>
        </div>

        <div class="col s12 m12 l4">
            <div class="card">
                <div class="card-image center">
                    <i class="fab fa-algolia"></i>
                </div>

                <div class="card-title">
                    Original Pristontale
                </div>

                <div class="card-content">
                    Go back in time and experience Pristontale all over again. This hardcore free-to-play MMORPG has  8 different classes with 4 tiers of skills. Grind your way to the top, upgrade your gear and fight in massive clan battles!
                </div>
            </div>
        </div>

        <div class="col s12 m12 l4">
            <div class="card">
                <div class="card-image center">
                    <i class="fas fa-comments"></i>
                </div>

                <div class="card-title">
                    Friendly Community
                </div>

                <div class="card-content">
                    Pristontale EU is always in close contact with its player base and ensures a safe and stable playing environment. Meet new friends and form clans! Only together you can become the best and dominate the leaderboards!
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include('footer.php');

?>

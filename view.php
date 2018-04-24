<?php

if(!isset($_GET['id']))
{
    header('Location: index.php');
    exit;
}

include('header.php');

$news = new News();

?>

<div class="container">
    <div class="row">
        <div class="content col s12">
            <div class="news-box col s12">
                <?php if(isset($_GET['id'])): ?>
                    <?php if($news->Exist($_GET['id'])): ?>
                        <?php foreach($news->View($_GET['id']) as $row): ?>
                            <div class="card-image">
                                <img src="<?php echo $row['news_banner']; ?>">
                            </div>

                            <div class="news-title-view">
                                <?php echo $row['news_title']; ?>
                            </div>

                            <div class="news-date-view">
                                <?php echo date('j.F, Y', $row['post_date']); ?>
                            </div>

                            <div class="news-content">
                                <?php echo $row['news_content']; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php header('Location: index.php'); ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php

include('footer.php');

?>

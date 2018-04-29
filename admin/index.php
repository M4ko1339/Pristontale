<?php

include('header.php');

?>

<div class="container">
    <div class="row">
        <div class="content col s12 m12 l12">
            <div class="options col s12">
                <a href="?action=new" class="btn">Create a new post</a>
            </div>

            <div class="content-box col s12">
                <?php if(isset($_GET['action']) && $_GET['action'] == 'new'): ?>
                    <form method="POST">
                        <label>Title</label>
                        <input type="text" name="title" />

                        <label>Banner</label>
                        <input type="text" name="banner" />

                        <label>Content</label>
                        <textarea class="materialize-textarea" name="content"></textarea>

                        <input type="submit" name="add" class="btn" value="Post" />
                    </form>
                    <?php if(isset($_POST['add'])): ?>
                        <?php if(!empty($_POST['title']) && !empty($_POST['banner']) && !empty($_POST['content'])): ?>
                            <?php if(!$news->Duplicate($_POST['title'])): ?>
                                <?php $news->Add($_POST['title'], $_POST['banner'], $_POST['content']); ?>
                                Successfully posted!
                            <?php else: ?>
                                Duplicate post found!
                            <?php endif; ?>
                        <?php else: ?>
                            Fields cannot be empty!
                        <?php endif; ?>
                    <?php endif; ?>
                <?php elseif(isset($_GET['edit'])): ?>
                    <?php foreach($news->Show((int)$_GET['edit']) as $row): ?>
                        <form method="POST">
                            <label>Title</label>
                            <input type="text" name="title" value="<?php echo $row['news_title']; ?>" />

                            <label>Banner</label>
                            <input type="text" name="banner" value="<?php echo $row['news_banner']; ?>" />

                            <label>Content</label>
                            <textarea class="materialize-textarea" name="content"><?php echo str_replace("<br>", "\n", $row['news_content']); ?></textarea>

                            <input type="submit" name="edit" class="btn" value="Edit Post" />
                        </form>
                        <?php if(isset($_POST['edit'])): ?>
                            <?php if(!empty($_POST['title']) && !empty($_POST['banner']) && !empty($_POST['content'])): ?>
                                <?php $news->Edit($_GET['edit'], $_POST['title'], $_POST['banner'], $_POST['content']); ?>
                                Post has been changed!
                            <?php else: ?>
                                Fields cannot be empty!
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php elseif(isset($_GET['delid'])): ?>
                    <?php
                        $news->Delete((int)$_GET['delid']);
                        header('Location: index.php');
                        exit;
                    ?>
                <?php else: ?>
                    <table>
                        <th>Title</th>
                        <th>Summary</th>
                        <th>Date</th>
                        <th></th>

                        <?php foreach($news->All() as $row): ?>
                            <tr>
                                <td><?php echo $row['news_title']; ?></td>
                                <td><?php echo substr($row['news_content'], 0, 30); ?>..</td>
                                <td><?php echo date('j.F, Y', $row['post_date']); ?></td>
                                <td><a href="?edit=<?php echo $row['id']; ?>"><i class="fas fa-edit"></i></a></td>
                                <td><a href="?delid=<?php echo $row['id']; ?>"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php

include('footer.php');

?>

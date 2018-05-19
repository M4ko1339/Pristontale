<?php

include('header.php');

$rank = new Ranking();

$class = array(
    0 => 'Unknown',
    1 => 'Fighter',
    2 => 'Mechanician',
    3 => 'Archer',
    4 => 'Pikeman',
    5 => 'Atalanta',
    6 => 'Knight',
    7 => 'Magician',
    8 => 'Priestess'
);

$blacklist = array(
    '[GM]Chaos',
);

$standing = 0;

?>

<div class="container">
    <div class="row">
        <div class="option-bar col s12">

        </div>

        <div class="content col s12">
            <div class="content-box-header yellow-text">
                Top 50 Players
            </div>

            <div class="content-box">
                <table class="ranking-table">
                    <th class="yellow-text">Rank</th>
                    <th class="yellow-text">Name</th>
                    <th class="yellow-text">Class</th>
                    <th class="yellow-text">Level</th>
                    <?php foreach($rank->Level() as $row): ?>
                        <?php if(!in_array($row['ChName'], $blacklist)): ?>
                            <?php $standing = $standing + 1; ?>
                            <tr>
                                <td><?php echo $standing; ?></td>
                                <td><?php echo $row['ChName']; ?></td>
                                <td><?php echo $class[$row['ChType']]; ?></td>
                                <td><?php echo $row['ChLv']; ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php

include('footer.php');

?>

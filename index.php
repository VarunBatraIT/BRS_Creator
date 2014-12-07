<?php
define('COST_PER_HOUR', 20);
define('CURRENCY', '$');
require "vendor/autoload.php";
require "lib.php";
use Symfony\Component\Yaml\Parser;

$yaml = new Parser();

$estimations = $yaml->parse(file_get_contents('./estimations.yml'));
$scope = $yaml->parse(file_get_contents('./scope.yml'));
$stories = $yaml->parse(file_get_contents('./stories.yml'));
$technologies = $yaml->parse(file_get_contents('./technologies.yml'));
$doubts = $yaml->parse(file_get_contents('./doubts.yml'));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Scope Document</title>
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Doubts</h3>
            <ul>
                <?php
                foreach ($doubts as $doubt) {
                    ?>
                    <li><?= $doubt ?></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>Technologies</h2>
            <?php
            foreach ($technologies as $where => $technology) {
                ?>
                <h4><?= $where ?></h4>
                <ul>
                <?php
                foreach ($technology as $name => $link) {
                    foreach ($link as $value => $href) {

                        ?>
                        <li><?= $name ?> <a target="_blank" href="<?= $href ?>"><?= $value ?></a></li>
                    <?php
                    }
                }

                ?></ul><?php
            }

            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>Scope of Work</h2>
            <?php
            foreach ($scope as $where => $do_and_dont) {
                ?>
                <h3><?= $where ?></h3>


                <?php

                foreach ($do_and_dont as $do_or_dont => $tasks) {
                    ?>
                <div class="<?= cycle('text-success', 'text-warning') ?>">
                    <h4><?= $do_or_dont ?></h4>

                    <ul>
                        <?php
                        foreach ($tasks as $task) {

                            ?>
                            <li><?= $task ?></li>
                        <?php
                        }
                        ?></ul></div><?php
                }
                ?><?php
            }

            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>User Stories</h2>
            <?php
            foreach ($stories as $who => $abilities) {
                ?>
                <h3><?= $who ?></h3>

                <ul>
                    <?php

                    foreach ($abilities as $when => $ability) {
                        foreach ($ability as $action => $to) {
                            ?>
                            <li><?php printf("As a %s, %s %s %s", $who, $when, $action, $to); ?></li>


                        <?php
                        }
                    }
                    ?>            </ul>
            <?php
            }
            ?>
        </div>
    </div>
    <h2>Estimation and Price</h2>

    <div class="row">

        <div class="col-md-12">
            <table class="stripped table">
                <thead>
                <tr class="warning">
                    <td>Task</td>
                    <td>Estimation (Hours)</td>
                </tr>
                </thead>
                <tbody>
                <?php
                $grand_total_hours = 0;
                foreach ($estimations as $heading => $estimation) {
                    $total_hours = 0;
                    ?>
                    <tr class="info">
                        <td colspan="2" class="text-center"><b><em><?= $heading ?></em></b></td>
                    </tr>

                    <?php
                    foreach ($estimation as $line => $hours) {
                        $total_hours += $hours;
                        ?>
                        <tr>
                            <td><?= $line ?></td>
                            <td><?= $hours ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr class="warning">
                        <td><?= 'Total Hours ' . $total_hours ?></td>
                        <td><?= ($total_hours * COST_PER_HOUR) . CURRENCY ?></td>
                    </tr>

                    <?php
                    $grand_total_hours += $total_hours;
                }
                ?>
                <tr class="danger">
                    <td><?= 'Total Hours ' . $grand_total_hours ?></td>
                    <td><?= ($grand_total_hours * COST_PER_HOUR) . CURRENCY ?></td>
                </tr>

                </tbody>
            </table>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>Terms</h2>
            <ul>
                <li>Delay in Design Approval will lead to delay in progress.</li>
                <li>Payment will be made on weekly basis.</li>
                <li>Client will be responsible for creating Social Applications to make social registration possible.
                </li>
            </ul>
        </div>
    </div>
</div>

</body>
</html>
<?php
defined('C5_EXECUTE') or die("Access Denied.");

$c = Page::getCurrentPage();

$view->inc('elements/header.php'); ?>

    <section id="page-content">
        <?php
        /** @var $a \Concrete\Core\Area\Area*/
        $a = new Area('Main Content');
        $a->enableGridContainer();
        $a->display($c);
        ?>
    </section>

<?php  $view->inc('elements/footer.php'); ?>
<?php
use Concrete\Core\Support\Facade\Application;
use Concrete\Package\VerignSnippets\Controller\SinglePage\Dashboard\VerignSnippets as s;

$c = Page::getCurrentPage();
$editmode = false;
if ($c->isEditMode()) {
    $editmode = true;
}
$user = new User();
$cp = new Permissions(Page::getCurrentPage());
$lang = \Localization::activeLanguage();

$detect = new Mobile_Detect();

$app = Application::getFacadeApplication();
$site = $app->make('site')->getSite();

?>

<div id="page-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                $a = new GlobalArea('Page Bottom '.$lang);
                $a->display($c);
                ?>
            </div>
        </div>
    </div>
</div>

<footer id="page-footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                $a = new GlobalArea('Footer Content '.$lang);
                $a->display($c);
                ?>
            </div>
        </div>
    </div>
</footer>

<footer id="footer-copyright">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-11 offset-xl-1">
                <?php
                $a = new GlobalArea('Footer Copyright '.$lang);
                $a->display($c);
                ?>
            </div>
        </div>
    </div>
</footer>

</div><!--closes page-wrap-->
<?php Loader::element('footer_required'); ?>
</body>
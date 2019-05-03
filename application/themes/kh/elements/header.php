<?php
use Concrete\Package\VerignSnippets\Controller\SinglePage\Dashboard\VerignSnippets as s;
/** @var \Concrete\Core\Page\Page $c */
$c = Page::getCurrentPage();
$editmode = $c->isEditMode();
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$user = new User();
$loggedIn = $user->checkLogin() ? true : false;
$cp = new Permissions(Page::getCurrentPage());
$lang = \Localization::activeLanguage();
$detect = new Mobile_Detect();

/** @var $banner Concrete\Core\Entity\File\Version */
$thumb = $c->getAttribute('thumbnail');
$thumbSrc = "";
if (is_object($thumb)) {
    $thumbSrc = $thumb->getURL();
}

$collectionName = strtolower($c->getCollectionName());
$collectionName = preg_replace('/ /' , '-', $collectionName);
$collectionName = preg_replace('/[äöü]/i' , 'x', $collectionName);

$bodyCls .= $detect->isMobile() ? 'device-mobile ' : $detect->isTablet() ? 'device-tablet ' : 'device-desktop ';
$bodyCls .= $editmode && $cp->canWrite() ? 'editmode ' : '';
$bodyCls .= $loggedIn && $cp->canWrite() ? 'loggedin ' : '';
$bodyCls .= 'lang-'.$lang;
?>

<!DOCTYPE html>
<html lang="<?= $lang ?>" class="no-js">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php Loader::element('header_required', array('pageTitle' => isset($pageTitle) ? $pageTitle : '',
        'pageDescription' => isset($pageDescription) ? $pageDescription : '',
        'pageMetaKeywords' => isset($pageMetaKeywords) ? $pageMetaKeywords : ''));?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="theme-color" content="#c30e2e">

    <?php echo $html->css($view->getStyleSheet('main.less'));?>

    <!--    <link rel="apple-touch-icon" sizes="180x180" href="--><?//= $view->getThemePath() ?><!--/favicon/apple-touch-icon.png">-->
    <!--    <link rel="icon" type="image/png" sizes="32x32" href="--><?//= $view->getThemePath() ?><!--/favicon/favicon-32x32.png">-->
    <!--    <link rel="icon" type="image/png" sizes="16x16" href="--><?//= $view->getThemePath() ?><!--/favicon/favicon-16x16.png">-->
    <!--    <link rel="manifest" href="--><?//= $view->getThemePath() ?><!--/favicon/site.webmanifest">-->
    <!--    <link rel="mask-icon" href="--><?//= $view->getThemePath() ?><!--/favicon/safari-pinned-tab.svg" color="#5bbad5">-->
    <!--    <link rel="shortcut icon" href="--><?//= $view->getThemePath() ?><!--/favicon/favicon.ico">-->
    <!--    <meta name="msapplication-TileColor" content="#ffffff">-->
    <!--    <meta name="msapplication-config" content="--><?//= $view->getThemePath() ?><!--/favicon/browserconfig.xml">-->
    <!--    <meta name="theme-color" content="#ffffff">-->

    <meta property="og:title" content="<?= $c->getCollectionName() ?>" />
    <meta property="og:url" content="<?= $actual_link ?>" />
    <meta property="og:image" content="<?=  ($thumbSrc ? $thumbSrc : '') ?> " />
</head>
<body class="<?= $bodyCls ?>">
<div id="page-wrap"
     class="<?= $c->getPageWrapperClass() ?> page-<?= $collectionName ?>">

    <header id="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header-logo-container">
                        <a href="/" class="header-logo-link">
                            <img src="<?= $view->getThemePath() ?>/img/logo/logo.svg" alt="kh" class="header-logo">
                        </a>
                    </div>
                    <div class="header-navigation">
                        <?php
                        $a = new GlobalArea('Header Menu Navigation '.$lang);
                        $a->display($c);
                        ?>
                    </div>
                    <div class="header-utility">
                        <?php
                        $a = new GlobalArea('Header Utility '.$lang);
                        $a->display($c);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="breadcrumbs">
        <?php
        $a = new GlobalArea('Breadcrumbs '.$lang);
        $a->display($c);
        ?>
    </div>
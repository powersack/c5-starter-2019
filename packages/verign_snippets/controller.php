<?php
namespace Concrete\Package\VerignSnippets;

use \Concrete\Core\Attribute\Key\Category as AttributeKeyCategory;
use \Concrete\Core\Attribute\Type as AttributeType;
use Package;
use BlockType;
use SinglePage;
use Loader;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package {

    protected $pkgHandle = 'verign_snippets';
    protected $appVersionRequired = '5.3.0';
    protected $pkgVersion = '1.0';

    public function getPackageDescription() {
        return t("Create snippets that you can use anywhere");
    }

    public function getPackageName() {
        return t("Verign Snippets");
    }

    public function install() {
        $pkg = parent::install();

        SinglePage::add('/dashboard/verign_snippets', $pkg);


        \Loader::model('attribute/categories/collection');
        $col = AttributeKeyCategory::getByHandle('collection');
        AttributeType::add('verign_snippets', t('Verign Snippets'), $pkg);
        $col->associateAttributeKeyType(AttributeType::getByHandle('verign_snippets'));
    }

}
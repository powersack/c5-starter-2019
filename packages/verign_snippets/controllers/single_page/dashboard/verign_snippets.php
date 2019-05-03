<?php
namespace Concrete\Package\VerignSnippets\Controller\SinglePage\Dashboard;

defined('C5_EXECUTE') or die(_("Access Denied."));

use \Concrete\Core\Attribute\Key\Category as AttributeKeyCategory;
use \Concrete\Core\Attribute\Type as AttributeType;
use \Concrete\Core\Attribute\Controller as AttributeController;
use Concrete\Core\Page\Controller\DashboardSitePageController;
use Concrete\Core\File\Service\File;
use Package;
use Loader;
use Block;
use BlockType;
use BlockTypeList;
use TaskPermission;
use Environment;
use Exception;
use Page;

class VerignSnippets extends DashboardSitePageController{
    public $packageHandle = 'verign_snippets';
    public $languages;

    public function on_start(){
        parent::on_start();
        $this->languages = $this->getAvailableLanguages();
    }

    public function view($post_data = array()){
        $html = Loader::helper('html');
        $db = Loader::db();

        $this->addHeaderItem($html->css('verign_snippets.css', $this->packageHandle));
        $this->addFooterItem($html->javascript('verign_snippets.js', $this->packageHandle));


        if($this->post('submit')){
//            if($this->post('snippet') && $this->post('name')){
//                $snippet = $this->post('snippet');
//                $name = $this->post('name');
//                $lang = 'de';
//                if($this->post('language')){
//                    $lang = $this->post('language');
//                }
//
//                $nameId = $db->GetRow("SELECT * FROM atVerignSnippetsNames WHERE name=?", array($name) );
//                $nameId = $nameId['id'];
//
//                if($nameId){
//                    $snippetId = $db->GetRow("SELECT * FROM atVerignSnippets WHERE snippet_name=? AND lang=?", array($nameId, $lang) );
//                    $snippetId = $snippetId['id'];
//                    if($snippetId){
//                        $db->Execute(
//                            "UPDATE atVerignSnippets SET snippet=? WHERE id=?", array( $snippet, $snippetId)
//                        );
//                    } else {
//                        $db->Execute(
//                            'INSERT INTO atVerignSnippets VALUES(?, ?, ?, ?)', array( NULL, $nameId, $snippet, $lang)
//                        );
//                    }
//                } else {
//                    $db->Execute(
//                        'INSERT INTO atVerignSnippetsNames VALUES(?, ?)', array( NULL, $name)
//                    );
//                    $nameId = $db->GetRow("SELECT * FROM atVerignSnippetsNames WHERE name=?", array($name) );
//                    $nameId = $nameId['id'];
//                    $db->Execute(
//                        'INSERT INTO atVerignSnippets VALUES(?, ?, ?, ?)', array( NULL, $nameId, $snippet, $lang)
//                    );
//                }
//
//            } else {
//                //invalid data
//            }

            if($this->post('snippets') && $this->post('name')){
                $snippets = $this->post('snippets');
                $name = $this->post('name');

                $nameId = $db->GetRow("SELECT * FROM atVerignSnippetsNames WHERE name=?", array($name) );
                $nameId = $nameId['id'];

                //UPDATE
                if($nameId){
                    foreach ($this->languages as $lang => $language){
                        if($snippets[$lang] || $snippets[$lang] === ""){
                            $snippet = $snippets[$lang];

                            $snippetId = $db->GetRow("SELECT * FROM atVerignSnippets WHERE snippet_name=? AND lang=?", array($nameId, $lang) );
                            $snippetId = $snippetId['id'];
                            if($snippetId){
                                $db->Execute(
                                    "UPDATE atVerignSnippets SET snippet=? WHERE id=?", array( $snippet, $snippetId)
                                );
                            } else {
                                $db->Execute(
                                    'INSERT INTO atVerignSnippets VALUES(?, ?, ?, ?)', array( NULL, $nameId, $snippet, $lang)
                                );
                            }
                        }
                    }
                    //CREATE
                } else {
                    $db->Execute(
                        'INSERT INTO atVerignSnippetsNames VALUES(?, ?)', array( NULL, $name)
                    );
                    $nameId = $db->GetRow("SELECT * FROM atVerignSnippetsNames WHERE name=?", array($name) );
                    $nameId = $nameId['id'];

                    foreach ($this->languages as $lang => $language){
                        $snippet = "";
                        if($snippets[$lang]){
                            $snippet = $snippets[$lang];
                        }

                        $db->Execute(
                            'INSERT INTO atVerignSnippets VALUES(?, ?, ?, ?)', array( NULL, $nameId, $snippet, $lang)
                        );
                    }
                }

            } else {
                //invalid data
            }
        }


        $this->set('languages', $this->languages);
        $this->set('snippets', $this->getSnippetList());
    }

    public function action_save(){
        $db = Loader::db();
    }

    private function getAvailableLanguages(){

        $languages = array();
        $locales = $this->site->getLocales();
        foreach ($locales as $locale){
            $name = $locale->getLanguageText();
            $loc =  $locale->getLocale();
            $languages[explode('_', $loc)[0]] =  $name;
        }
        print_r($languages);

//        $availableLanguages = \Localization::getAvailableInterfaceLanguageDescriptions();
//        $languages = array();
//        foreach($availableLanguages as $k => $desc){
//            $languages[explode('_', $k)[0]] =  $desc;
//        }
//        print_r($languages);
        return $languages;
    }

    public function getSnippetList(){
        $db = Loader::db();
        $snippets = array();
        $names = $db->Execute('SELECT * FROM atVerignSnippetsNames');
        $names = $names->FetchAll();

        foreach ($names as $name){
            $id = $name['id'];
            $nameId = $name['name'];
            $snippet = $db->Execute('SELECT * FROM atVerignSnippets WHERE snippet_name=? ORDER BY lang', array($id));
            $snippet = $snippet->FetchAll();
            $snippetSortedByLanguage = array();
            foreach ($snippet as $s){
                $snippetSortedByLanguage[$s['lang']] = $s['snippet'];
            }

            $snippets[$nameId] = $snippetSortedByLanguage;
        }

        return $snippets;
    }

    public static function t($name){
        $db = Loader::db();
        $lang = \Localization::activeLanguage();
        if(!$lang || $lang === ""){
            $lang = 'de';
        }
        $name_id = $db->GetOne(
            "SELECT id FROM atVerignSnippetsNames
            WHERE name=?", array($name)
        );

        $result = $db->GetOne(
            "SELECT snippet FROM atVerignSnippets 
            WHERE snippet_name=? AND lang=?", array($name_id, $lang)
        );
        if(empty($result)){
            return '{{'.$name.'}}';
        }

        return $result;
    }
}
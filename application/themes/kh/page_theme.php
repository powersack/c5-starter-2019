<?php
namespace Application\Theme\kh;

use Concrete\Core\Area\Layout\Preset\Provider\ThemeProviderInterface;
use Concrete\Core\Asset\AssetList;
use Application\Grid\Foundation as Foundation;

class PageTheme extends \Concrete\Core\Page\Theme\Theme implements ThemeProviderInterface {
    protected $pThemeName ='KH';
    protected $pThemeDescription = 'KH Template';
    protected $pThemeGridFrameworkHandle = 'bootstrap3';

    public function registerAssets()
    {
        $this->requireAsset('css', 'font-awesome');
        $this->requireAsset('javascript', 'jquery');
        $this->requireAsset('javascript', 'picturefill');
        $this->requireAsset('javascript-conditional', 'html5-shiv');
        $this->requireAsset('javascript', 'modern');

        $this->requireAsset('javascript', 'fancybox');
        $this->requireAsset('javascript', 'selectric');
//        $this->requireAsset('javascript', 'jqueryui_effects');

        $this->requireAsset('javascript', 'owl');
        $this->requireAsset('javascript', 'owl_scroller');
        $this->requireAsset('javascript', 'lawyer_carousel');
        $this->requireAsset('javascript', 'page_list_ajax_filter');
        $this->requireAsset('javascript', 'theme_main');

    }

    public function getThemeAreaLayoutPresets()
    {
        $presets= array (
            array(
                'handle' => 'full',
                'name' => 'Spalte voll',
                'container' => '<div class="row"></div>',
                'columns' => array(
                    '<div class="col-12"></div>',
                ),
            ),
            array(
                'handle' => 'half',
                'name' => 'Spalte halb',
                'container' => '<div class="row"></div>',
                'columns' => array(
                    '<div class="col-md-6 col-12"></div>',
                    '<div class="col-md-6 col-12"></div>'
                ),
            )
        );
        return $presets;
    }

    public function getThemeAreaClasses()
    {
        return array(
//            'Top' => array(
//                'red-layout'
//            )
        );
    }
    public function getThemeBlockClasses()
    {
        return array(
            '*' => array(
                'pull-left-margin-content',
                'pull-left-margin-double-content',
                'margin-bottom-15',
                'margin-bottom-30',
                'margin-top-15',
                'margin-top-30',
                'hidden-xs',
                'hidden-sm',
                'hidden-md',
                'hidden-lg'
            ),
            'content' => array(
            ),
            'html' => array(
            ),
            'image'=> array (
                'responsive-float-left',
                'responsive-float-right'
            ),
            'image_slider' => array(
            ),
            'core_area_layout' => array(
                'gray-layout'
            )
        );
    }
    public function getThemeEditorClasses() {
        return array(
            array('title' => t('Headline style H1'), 'menuClass' => 'h1', 'spanClass' => 'h1', 'forceBlock' => '1'),
            array('title' => t('Headline style H2'), 'menuClass' => 'h2', 'spanClass' => 'h2', 'forceBlock' => '1'),
            array('title' => t('Headline style H3'), 'menuClass' => 'h3', 'spanClass' => 'h3', 'forceBlock' => '1'),
            array('title' => t('Font-Primary'), 'menuClass' => 'font-primary', 'spanClass' => 'font-primary', 'forceBlock' => '0'),
            array('title' => t('Font-White'), 'menuClass' => ' ', 'spanClass' => 'color-white', 'forceBlock' => '0'),
            array('title' => t('Teaser Line'), 'menuClass' => 'teaser-line', 'spanClass' => 'teaser-line', 'forceBlock' => '0'),
            array('title' => t('Button'), 'menuClass' => '', 'spanClass' => 'button', 'forceBlock' => '0'),
            array('title' => t('Primary Button'), 'menuClass' => '', 'spanClass' => 'button primary', 'forceBlock' => '0'),
        );
    }

    public function getThemeResponsiveImageMap()
    {
        return array(
            'large' => '1024px',
            'medium' => '480px',
            'small' => '0',
        );
    }
}


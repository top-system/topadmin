<?php
namespace TopSystem\TopAdmin\Traits;

trait AssetTrait{

    protected $css = [];
    protected $js = [];

    public function initAsset(){
        $this->css = config('admin.additional_css');
        $this->js = config('admin.additional_js');
    }

    /**
     * @param array $css
     */
    public function addCss($css): void
    {
        $this->css[] = $css;
    }

    /**
     * @param array $js
     */
    public function addJs($js): void
    {
        $this->js[] = $js;
    }

    /**
     * @return array
     */
    public function getCss(): array
    {
        return $this->css;
    }

    /**
     * @return array
     */
    public function getJs(): array
    {
        return $this->js;
    }
}
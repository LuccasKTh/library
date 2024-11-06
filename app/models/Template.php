<?php

class Template {
    private string $app;
    private string $menu;
    private string $views;
    private string $layouts;
    private string $dir;

    public function __construct()
    {
        $this->app = "app.html";
        $this->menu = "navigation.html";
        $this->views = "/public/views/";
        $this->dir = getcwd();
        $this->layouts = "{$this->views}layouts/";
    }

    public static function instance()
    {
        return new self();
    }

    public function getView($view)
    {
        return file_get_contents($this->dir . $this->views . $this->replaceViewName($view));
    }

    public function replaceViewName($file)
    {
        return str_replace('.', '/', $file) . ".html";
    }

    public function searchSection($view, $data)
    {
        $viewContent = $this->getView($view);
        $viewContent = $this->mergeData($viewContent, $data);
        $match = preg_match('/:section\{(.*?):(.*?)\}/', $viewContent, $matches);

        if ($match) {
            $viewContent = str_replace($matches[0], '', $viewContent);
            $content = $this->searchSection($matches[1], $data);
            $content = str_replace(':'.$matches[2], $viewContent, $content);
            return $content;
        }

        return $viewContent;
    }

    public function mergeData($viewContent, $data) 
    {
        $a = $viewContent;
        $c = '';
        $x = '';
        foreach ($data as $rowKey => $row) {
            $c = $a;
            if (preg_match('/:'.$rowKey.'{/', $viewContent)) {
                foreach ($row as $column) {
                    foreach ($column as $valueKey => $value) {
                        if (preg_match('/:'.$rowKey.'{'.$valueKey.'}/', $c, $matches)) {
                            $a = str_replace($matches[0], $value, $c);
                        }
                    }
                    $x .= $a;
                }
            }
        }
        var_dump("<xmp>$x</xmp>");
        return $c;
    }

    public static function view(string $view = '', array $data = [])
    {
        $instance = self::instance();
        $sectionView = $instance->searchSection($view, $data);

        $appContent = $instance->makeApp();
        $appContent = $instance->makeContent($appContent, $sectionView);

        echo $appContent;
    }

    public function makeApp()
    {
        $appContent = file_get_contents($this->dir . $this->views . $this->app);
        $menuContent = file_get_contents($this->dir . $this->layouts . $this->menu);

        return str_replace(':navigation', $menuContent, $appContent);
    }

    public function makeContent($appContent, $content)
    {
        return str_replace(':content', $content, $appContent);
    }
}

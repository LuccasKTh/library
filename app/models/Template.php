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

    public static function view(string $view = '', array $data = [])
    {
        $instance = self::instance();
        $sectionView = $instance->searchSection($view, $data);

        $appContent = $instance->makeApp();
        $appContent = $instance->makeContent($appContent, $sectionView);
        $appContent = $instance->create($appContent);

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
        // $viewContent = $this->create($viewContent);
        $viewContent = $this->action($viewContent);
        $match = preg_match('/:section\{(.*?):(.*?)\}/', $viewContent, $matches);

        if ($match) {
            if (array_filter($data)) {
                $viewContent = str_replace($matches[0], '', $viewContent);
                $content = $this->searchSection($matches[1], $data);
                $content = str_replace(':'.$matches[2], $viewContent, $content);
                $viewContent = $content;
            } else {
                $empty = file_get_contents($this->dir . $this->views . $this->replaceViewName('layouts.empty'));
                $viewContent = $empty;
            }
        }

        if (preg_match_all('/:(.*){(.*)}/', $viewContent, $matches)) {
            foreach ($matches[0] as $match) {
                if (preg_match('/:(.*?)\{id\}/', $viewContent)) {
                    $viewContent = str_replace($match,0, $viewContent);
                } else {
                    $viewContent = str_replace($match,'', $viewContent);
                }
            }
        }

        return $viewContent;
    }

    public function mergeData($viewContent, $data = []) 
    {
        $renderedContent = $viewContent; 

        if (array_filter($data)) {
            foreach ($data as $dataKey => $rows) {
                if (preg_match('/:'.$dataKey.'{/', $viewContent)) {
                    $renderedContent = '';
                    foreach ($rows as $row) {
                        $class = $row;
                        $rowContent = $viewContent;

                        $methods = get_class_methods($class);

                        foreach ($methods as $method) {
                            if (preg_match('/:'.$dataKey.'{'.$method.'}/', $viewContent, $matches)) {
                                $value = $class->$method();
                                $rowContent = str_replace($matches[0], $value, $rowContent);
                            } elseif (preg_match('/:'.$dataKey.'{'.$method.'.(.*?)}/', $viewContent, $matches)) {
                                $value = $class->$method();
                                $method = $matches[1];
                                $value = $value->$method();
                                $rowContent = str_replace($matches[0], $value, $rowContent);
                            }
                        }              

                        $renderedContent .= $rowContent;
                    }
                }
            }
            $viewContent = $renderedContent;
        }
        
        return $viewContent;
    }

    public function action($viewContent)
    {
        $method = Route::uriMethodController();
        $controller = Route::uriModel();

        if (preg_match_all('/:action/', $viewContent)) {
            switch ($method) {
                case 'create':
                    $viewContent = str_replace(':action',"/".$controller, $viewContent);
                    break;

                case 'edit':
                    $viewContent = str_replace(':action',"/$controller/update", $viewContent);
                    break;
            }
        }

        return $viewContent;
    }

    public function create($appContent)
    {
        $model = Route::uriModel();
        $uri = Route::makeCleanUri();
        $method = Route::getMethod();
        
        if ($method === "GET" && $uri == $model) {
            if (preg_match('/:create/', $appContent)) {
                $create = $this->getView('layouts.create');
                $create = str_replace(':link',"/$model/create", $create);
                $appContent = str_replace(':create',$create, $appContent);
            }
        } else {
            $appContent = str_replace(':create', '', $appContent);
        }

        return $appContent;
    }

}

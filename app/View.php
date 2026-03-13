<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\ViewNotFoundException;

class View implements \Stringable
{
    protected string $layoutPath;

    public function __construct(
        protected string $view,
        protected array $params = []
    ) {
        $this->layoutPath = VIEW_PATH . "/layouts/master.php";
    }

    public static function make(string $view, array $params = []): static
    {
        return new static($view, $params);
    }

    public function withLayout(string $layoutPath): static
    {
        $this->layoutPath = $layoutPath;

        return $this;
    }

    public function render(): string
    {
        return $this->renderView($this->layoutPath, [
            'title' => $this->params['title'] ?? 'App name',
            'content' => $this->renderView($this->viewPath(), $this->params),
        ]);
    }

    public function __toString(): string
    {
        return $this->render();
    }

    protected function viewPath(): string
    {
        return VIEW_PATH . "/{$this->view}.php";
    }

    protected function renderView(string $path, array $params = []): string
    {
        if (! file_exists($path)) {
            throw new ViewNotFoundException();
        }

        extract($params);

        ob_start();

        include $path;

        if (empty($params)) {
            return (string) ob_get_clean();
        }

        $search = [];
        $replace = [];

        foreach ($params as $key => $value) {
            $search[] = "{{{$key}}}";
            $replace[] = is_array($value) ? json_encode($value) : $value;
        }

        return str_replace($search, $replace, (string) ob_get_clean());
    }
}

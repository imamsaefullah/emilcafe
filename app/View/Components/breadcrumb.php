<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class breadcrumb extends Component
{
    public array $segments;

    public function __construct()
    {
        $this->segments = $this->generateSegments();
    }

    private function generateSegments(): array
    {
        $segments = Request::segments(); // ['produk', '123', 'edit']
        $breadcrumb = [];
        $url = url('/'); // base url

        foreach ($segments as $index => $segment) {
            $url .= '/' . $segment;
            $breadcrumb[] = [
                'label' => $this->formatLabel($segment),
                'url'   => $index !== array_key_last($segments) ? $url : null,
            ];
        }

        return $breadcrumb;
    }

    private function formatLabel(string $segment): string
    {
        if (is_numeric($segment)) {
            return '#' . $segment;
        }

        return Str::of($segment)
            ->replace('-', ' ')
            ->replace('_', ' ')
            ->title(); // "edit-produk" => "Edit Produk"
    }

    public function render(): View|Closure|string
    {
        return view('components.breadcrumb');
    }
}

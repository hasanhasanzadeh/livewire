<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleShowAll extends Component
{
    use WithPagination;

    public mixed $articles;

    public function mount($articles): void
    {
        $this->articles = $articles;
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.article-show-all');
    }
}

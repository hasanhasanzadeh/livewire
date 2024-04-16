<div>
    @foreach ($this->articles as $article)
        <div>
            {{$article['title']}}
        </div>
    @endforeach
</div>

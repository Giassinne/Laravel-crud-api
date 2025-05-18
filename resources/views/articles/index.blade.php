<h1>Articles</h1>
<a href="{{ route('articles.create') }}">Créer un article</a>

<ul>
    @foreach ($articles as $article)
    <li>
        <strong>{{ $article->title }}</strong><br>
        {{ $article->content }}<br>
        <a href="{{ route('articles.edit', $article->id) }}">Modifier</a>
        <form method="POST" action="{{ route('articles.destroy', $article->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Supprimer</button>
        </form>
    </li>
    @endforeach
</ul>

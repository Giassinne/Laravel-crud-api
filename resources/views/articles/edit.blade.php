<h1>Modifier l’article</h1>

<form method="POST" action="{{ route('articles.update', $article->id) }}">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ $article->title }}">
    <textarea name="content">{{ $article->content }}</textarea>
    <button type="submit">Mettre à jour</button>
</form>

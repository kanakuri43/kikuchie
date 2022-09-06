<h1>編集画面</h1>
<p><a href="{{ route('book.index')}}">一覧画面</a></p>
 
@if ($message = Session::get('success'))
<p>{{ $message }}</p>
@endif
 
<form action="{{ route('book.update',$book->id)}}" method="POST">
    @csrf
    @method('PUT')
    <p>タイトル：<input type="text" name="title" value="{{ $book->title }}"></p>
    <p>著者：<input type="text" name="author" value="{{ $book->author }}"></p>
    <input type="submit" value="編集する">
</form>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE+edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>日報編集</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container">
        <div class="mx-auto" style="width:400px;">

            <h1>日報編集</h1>
            <p><a href="{{ route('journal.index')}}" class="text-decoration-none">一覧画面</a></p>

            @if ($message = Session::get('success'))
            <p>{{ $message }}</p>
            @endif

            <form action="{{ route('journal.update',$report->id)}}" method="POST">
                @csrf
                @method('PUT')
                <p>日付：<input type="date" name="title" value="{{ $journal->work_date }}" class="form-control"></p>
                <p>作成者：<input type="text" name="author" value="{{ $journal->author_id }}" class="form-control"></p>
                <p>内容：<input type="text" name="author" value="{{ $journal->content }}" class="form-control"></p>
                <input type="submit" value="編集する">
            </form>
        </div>
    </div>
</body>
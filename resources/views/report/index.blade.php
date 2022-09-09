<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE+edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>日報一覧</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="mx-auto" style="width:400px;">


            <h1>日報一覧</h1>
            <p><a href="{{ route('report.create') }}" class="text-decoration-none">新規追加</a></p>

            @if ($message = Session::get('success'))
            <p>{{ $message }}</p>
            @endif

            <table class="table">
                <tr>
                    <th>日付</th>
                    <th>詳細</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
                @foreach ($reports as $report)
                <tr>
                    <td><a href="{{ route('report.show',$report->id)}}">{{ $report->work_date }}</a></td>
                    <td><a href="{{ route('report.show',$report->id)}}">詳細</a></td>
                    <td><a href="{{ route('report.edit',$report->id)}}">編集</a></td>
                    <td>
                        <form action="{{ route('report.destroy', $report->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" name="" value="削除">
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>

</html>
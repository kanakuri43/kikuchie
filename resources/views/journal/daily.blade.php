<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE+edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>日報</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="mx-auto" style="width:400px;">


            <h1>{{ $operation_date }} 日報</h1>
            <table width="200">
                <tr>
                    <td>
                        <h3><a href="{{ route('journal.create') }}" class="text-decoration-none" title="新規作成"><i class="bi bi-pencil"></i></a></h3>
                    </td>
                    <td>
                    <h3><a href=" {{ route('journal.monthly', date('Y-m')) }}" class="text-decoration-none" title="ホーム"><i class="bi bi-calendar3"></i></a></h3>
                    </td>
                </tr>
            </table>

            @if ($message = Session::get('success'))
            <p>{{ $message }}</p>
            @endif

            <table class="table">
                <tr>
                    <th>作業</th>
                    <th>時間(h)</th>
                    <th>担当</th>
                </tr>
                @foreach ($journals as $journal)
                <tr>
                    <td width="120"><a href="{{ route('journal.edit',$journal->detail_id)}}">{{ $journal->process_name }}</a></td>
                    <td align="center" width="100">{{ $journal->operation_hours }}</td>
                    <td>{{ $journal->employee_name }}</td>
                    <td></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>

</html>
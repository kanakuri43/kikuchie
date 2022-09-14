<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE+edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>日報詳細</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="mx-auto" style="width:400px;">

            <h1>日報詳細</h1>
            <p><a href="{{ route('journal.index')}}" class="text-decoration-none">一覧画面</a></p>


            <table class="table">
                <tr>
                    <th>id</th>
                    <th>work_date</th>
                    <th>author_id</th>
                    <th>content</th>
                    <!-- <th>created_at</th>
                    <th>updated_at</th> -->
                </tr>
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->work_date }}</td>
                    <td>{{ $report->author_id }}</td>
                    <td>{{ $report->content }}</td>
                    <!-- <td>{{ $report->created_at }}</td>
                    <td>{{ $report->updated_at }}</td> -->
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
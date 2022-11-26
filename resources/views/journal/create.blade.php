<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE+edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>新規作成</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        window.onload = function() {
            var today = new Date();
            today.setDate(today.getDate());
            var yyyy = today.getFullYear();
            var mm = ("0" + (today.getMonth() + 1)).slice(-2);
            var dd = ("0" + today.getDate()).slice(-2);
            document.getElementById("work_date").value = yyyy + '-' + mm + '-' + dd;
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="mx-auto" style="width:400px;">

            <!-- <h1>新規作成</h1> -->
            <!-- <h3><a href=" {{ route('journal.monthly', date('Y-m')) }}" class="text-decoration-none" title="ホーム"><i class="bi bi-calendar3"></i></a></h3> -->

            <form action="{{ route('journal.store')}}" method="POST">
                @csrf
                <p>
                    <input type="hidden" name="state" value="0">
                </p>
                <p>
                    <label for="operation_date">日付</label>
                    <input type="date" name="operation_date" value="{{old('operation_date')}}" class="form-control" id="operation_date">
                </p>
                <p>
                    <label for="author_id">作成者</label>
                    <select class="form-select" name="author_id">
                        @foreach($employees as $employee)
                        <option value="{{ $employee->id }}"> {{ $employee->employee_name }}</option>
                        @endforeach
                    </select>
                </p>
                <p>
                    <label for="content">作業</label>
                    <select class="form-select" name="process_id">
                        @foreach($processes as $process)
                        <option value="{{ $process->id }}"> {{ $process->process_name }}</option>
                        @endforeach
                    </select>

                </p>
                <p>
                    <label for="employee_id">担当</label>
                    <select class="form-select" name="employee_id[]" value="{{old('employee_id')}}" id="employee_id" multiple>
                        @foreach($employees as $employee)
                        <option value="{{ $employee->id }}"> {{ $employee->employee_name }}</option>
                        @endforeach
                    </select>
                </p>

                <p>
                    <label for="operation_hours">作業時間</label>
                    <input type="number" min="0" max="24" name="operation_hours" value="{{old('operation_hours')}}" class="form-control" id="operation_hours" step="0.5">
                </p>
                <p>
                    <input type="hidden" name="notes" value="">
                </p>
                <div class="form-group row mb-0">
                    <div class="button">
                        <input type="submit" value="登録する" class="btn btn-primary btn-lg">
                        <button type="button" onClick="history.back()" class="btn btn-outline-secondary btn-lg">戻る</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<!-- Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
   
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">ลำดับ</th>
                <th class="text-center">ชื่อแผนก</th>
                <th class="text-center">ผู้เพิ่มข้อมูล</th>
                <th class="text-center">แก้ไขข้อมูลล่าสุด</th>
            </tr>
        </thead>
        <tbody>
            @if (count($departments)>0)
                @php ($index=1)
                @foreach($departments as $row)
                    <tr>
                        <td class="text-center">{{$index}}</td>
                        <td>{{$row->department_name}}</td>
                        <td>{{$row->user->name}}</td>
                        @if ($row->updated_at)
                            <td class="text-center">{{Carbon\Carbon::parse($row->updated_at)->diffForHumans()}}</td>
                        @else ()
                            <td class="text-center">{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
                        @endif
                    </tr>
                    @php ($index++)
                @endforeach
            @endif
        </tbody>
    </table>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body style="background: linear-gradient(110deg,#C9A072 60%,#c5dff6 60%);margin-top:15%">
<div class="container">
    <div class="card">
        <div class="card-body">
    <a class="btn btn-dark" href="{{route('customer.show')}}">Students</a>
            <form method="POST" action="{{url('/')}}/register">
                @csrf
            <table class="table mt-5 table-responsive table-bordered table-striped table-light">
            <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>MO.NO</th>
                    <th>Attendence</th>
                </tr> 
                @foreach($members as $member)
                <tr>
                    <td><input type="hidden" name="id[]" value="{{$member->id}}">{{$member->id}}</td>
                    <td><input type="hidden" name="name[]" value="{{$member->name}}">{{$member->name}}</td>
                    <td><input type="hidden" name="address[]" value="{{$member->address}}">{{$member->address}}</td>
                    <td><input type="hidden" name="mono[]" value="{{$member->mono}}">{{$member->mono}}</td>
                    <td><input type="checkbox" name="checkbox[]" value="{{$member->id}}">Present <input type="checkbox" name="checkbox[]" value="0">Absent</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5">
                    <center>
                        <button class="btn btn-dark"> Submit </button>
                    </center>
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
</body>
</html>
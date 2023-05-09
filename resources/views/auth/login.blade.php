<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Testing Login Page</title>
  </head>
  <body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <center><h4>Testing Login Mikrotik</h4></center> <br>
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">IP Address</label>
                <input type="text" class="form-control @error('ip') is-invalid @enderror" value="{{ old('ip') }}" id="ip" name="ip">
                @error('ip')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">User</label>
                <input type="text" class="form-control @error('user') is-invalid @enderror" value="{{ old('user') }}" id="user" name="user"></div>
                @error('user')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control @error('pass') is-invalid @enderror" id="pass" name="pass">
                @error('pass')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <center><button type="submit" class="btn btn-primary">Login</button></center>
            </form>
            
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


  </body>
</html>
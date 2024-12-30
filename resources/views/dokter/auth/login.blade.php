<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dokter Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .divider:after,
        .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
        }
    </style>
</head>
<body style="background-color: darkgray">

    <section class="vh-100" >
        <div class="container py-5 h-100" >
          <div class="row d-flex align-items-center justify-content-center h-100 rounded-lg" style="background-color: white">
            <div class="col-md-8 col-lg-7 col-xl-6">
              <img src="https://storage.nu.or.id/storage/post/1_1/mid/dokter-freepik_1657802796.webp"
                class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
            <h1 class="text-center">Login Dokter</h1>
              <form method="POST" action="{{route('login')}}">
                @csrf   
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="name">Nama</label>
                    <input type="text" name="name" id="name" placeholder="nama dokter" class="form-control form-control-lg" />
                </div>
      
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="no_hp">No Hp</label>
                    <input type="text" name="no_hp" id="no_hp" placeholder="nomor hp dokter" class="form-control form-control-lg" />
                </div>
      
      
                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block">Login</button>
                
                <div class="divider d-flex align-items-center my-4">
                    <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                  </div>
        
                  <a data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="#!"
                    role="button">
                    <i class="fab fa-facebook-f me-2"></i>Continue with Facebook
                  </a>
                  <a data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="#!"
                    role="button">
                    <i class="fab fa-twitter me-2"></i>Continue with Twitter</a>

              </form>
            </div>
          </div>
        </div>
      </section>
    
</body>
</html>
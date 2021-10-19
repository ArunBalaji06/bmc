@extends('layouts.master')
@section('content')

@if($errors->any())
  <div class="alert alert-danger">
    <p><strong>Oops error</p>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
@endif

<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Car Registration</p>

                <form class="mx-1 mx-md-4" method="post" action="/post-car-register" enctype="multipart/form-data">
                  @csrf
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="model" class="form-control" />
                      <label class="form-label"for="form3Example1c">Car Model</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="seating_capacity" class="form-control" />
                      <label class="form-label"  for="form3Example3c">Seating capacity</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="price" class="form-control" />
                      <label class="form-label" for="form3Example4c">Price</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="availability" class="form-control" />
                      <label class="form-label" for="form3Example4cd">Car Availability</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="file" name="photo" class="form-control" />
                      <label class="form-label" for="form3Example4cd">Car Image</label>
                    </div>
                  </div>

                 

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>


                </form>
                <div>
              <p class="mb-0">Don't have an account? <a href="{{route('getlogin')}}" class="text-black fw-bold">Login</a></p>
            </div>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="{{asset('images/logo/18.jpg')}}" style="height:100px;position:absolute;left:450px;top:-40px" class="img-fluid" alt="Sample image">
                <img src="{{asset('images/car/car-register.jpg')}}" class="img-fluid" alt="register car">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
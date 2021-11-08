@extends('layouts.master')

@section('content')
<div class="container-scroller">
      
    <!-- partial:partials/_sidebar.html -->
    @include('includes.sidebar')
    
    <!-- partial -->
    @include('includes.settings')
    
    <label>Model: <label>
    <input type="text" value={{$viewCar->model}}>
    <label>Seating Capacity: <label>
    <input type="text" value={{$viewCar->seating_capacity}}>
    <label>Price: <label>
    <input type="text" value={{$viewCar->price}}>
    <label>Availability: <label>
    <input type="text" value={{$viewCar->availability}}>
    <label>Photo: <label>
    <input type="file" value={{$viewCar->photo}}>
        <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Update Car
        </button>
  
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/update-car" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value={{$viewCar->id}} class="form-control" />
                        <label class="form-label"for="form3Example1c">Car Model</label>
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                              <input type="text" name="model" value={{$viewCar->model}} class="form-control" />
                              <label class="form-label"for="form3Example1c">Car Model</label>
                            </div>
                        </div>
        
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="text" name="seating_capacity" value={{$viewCar->seating_capacity}} class="form-control" />
                                <label class="form-label"  for="form3Example3c">Seating capacity</label>
                            </div>
                        </div>
    
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="text" name="price" value={{$viewCar->price}} class="form-control" />
                                <label class="form-label" for="form3Example4c">Price</label>
                            </div>
                        </div>
    
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="text" name="availability" value={{$viewCar->availability}} class="form-control" />
                                <label class="form-label" for="form3Example4cd">Car Availability</label>
                            </div>
                        </div>
    
                        <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="file" name="car_image" class="form-control">
                                <label class="form-label" for="form3Example4cd">Car Image</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button type="submit" class="btn btn-primary btn-lg">Register</button>
                        </div>
        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                   
                </div>
            </div>
        </div>
    </div>
@endsection
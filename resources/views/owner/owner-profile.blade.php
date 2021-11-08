@extends('layouts.master')

@section('content')
    <div>
        Name: {{$detail->owner->name}}<br>
    </div>
    <div>
        Email: {{$detail->owner->email}}<br>
    </div>
    <div>
        Phone Number: {{$detail->phone_number}}<br>
    </div>
    <div>
        Address: {{$detail->address}}<br>
    </div>
    <div>
        Profile Image: <br>
      <img src="/owner/profile-image/{{$detail->owner_image}}" height="70" width="70">

    </div>
    <div>
        Proof: <br>
                
    </div>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Edit profile
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form class="mx-1 mx-md-4" method="post" action="/update-owner-profile" enctype="multipart/form-data">
          @csrf
          <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
              <input type="text" value="{{$detail->owner->name}}" name="name" class="form-control" />
              <label class="form-label"for="form3Example1c">Your Name</label>
            </div>
          </div>

          <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
              <input autocomplete="off" value="{{$detail->owner->email}}" type="email" name="email" class="form-control" />
              <label class="form-label"  for="form3Example3c">Your Email</label>
            </div>
          </div>

          <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
              <input type="number" value="{{$detail->phone_number}}" name="phone_number" class="form-control" />
              <label class="form-label" for="form3Example4cd">Phone Number</label>
            </div>
          </div>

          <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
              <input type="text" value="{{$detail->address}}" name="address" class="form-control" />
              <label class="form-label" for="form3Example4cd">Address</label>
            </div>
          </div>

          <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
              <img src="/owner/profile-image/{{$detail->owner_image}}" height="70" width="70">
              <input type="file" class="dropify" value="{{$detail->owner_image}}" name="photo" class="form-control" />
              <label class="form-label" for="form3Example4cd">Owner Photo</label>
            </div>
          </div>

          <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
              <input type="file" class="dropify" value="{{$proof->owner_proof_front}}" name="owner_proof_front" class="form-control" />
              <label class="form-label" for="form3Example4cd">Owner Proof Front</label>
            </div>
          </div>

          <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
              <input type="file" class="dropify" value="{{$proof->owner_proof_back}}" name="owner_proof_back" class="form-control" />
              <label class="form-label" for="form3Example4cd">Owner Proof Back</label>
            </div>
          </div>

          <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>


        </form>

      </div>
     
    </div>
  </div>
</div>

@endsection
    

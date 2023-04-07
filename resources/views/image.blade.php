<!DOCTYPE html>
<html>
<head>
  <title>Laravel 8 Uploading Image</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>

<div class="container mt-5">

  @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif

  <div class="card">

    <div class="card-header text-center font-weight-bold">
      <h2>Queue Task</h2>
    </div>

    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" id="upload-image" action="{{ url('save') }}" >
@csrf
            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" name="img" placeholder="Choose image" id="image">
                    @error('image')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </div>
            </div>
        </form>

    </div>

  </div>

</div>
<br>
<table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Image</th>

      </tr>
    </thead>
    <tbody>
        @forelse ($images as $image )
      <tr>
        <td>{{$image->id}}</td>

        <td><img src="{{asset('storage/images/'.$image->name)}}" alt="apple" width="200"></td>

      </tr>
      @empty
     <tr> <td> No image </td>

    <td> No image </td></tr>
      @endforelse
    </tbody>
  </table>










</body>
</html>

@if(session('delete_success'))
    <script>
        alert("Xóa thành công");
    </script>
@endif
<head>
    <!-- Thư viện Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    <div class="container"> 
        <div class="row"> 

@foreach ($data as $item)
<div class="col-md-4 col-sm-6 ">
<div class="card" style="width: 18rem;">
    <<img src="{{$item['avatar'] }} " alt="{{$item['name'] }}"class="card-img-top" >
    <div class="card-body">
      <h5 class="card-title">{{ $item['name'] }}</h5>
      <p class="card-text">{{ $item['price'] }}</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
      <form action="{{ route('data.delete', $item['id']) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>

    </div>
  </div>
</div>
  @endforeach
</div>
</div>
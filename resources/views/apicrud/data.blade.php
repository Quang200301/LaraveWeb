
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
@if (!is_array($item['avatar']) && !is_array($item['name']))
<div class="col-md-4 col-sm-6 ">
<div class="card" style="width: 18rem;">
    <img src="../images/{{ htmlspecialchars(strval($item['avatar'])) }}" alt="{{ htmlspecialchars(strval($item['name'])) }}" class="card-img-top">
    

    <div class="card-body">
      <h5 class="card-title">{{ $item['name'] }}</h5>
      <p class="card-text">{{ $item['price'] }}</p>
      <a href="/apicrud.add" class="btn btn-primary">Go somewhere</a>
      <form action="{{ route('apicrud.data.delete', $item['id']) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>

    </div>
  </div>
</div>
@endif
  @endforeach
    
    <form action="/apicrud.data.add" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên:</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Giá:</label>
            <input type="number" name="price" id="price" class="form-control">
        </div>
        <div class="form-group">
            <label for="avatar">Ảnh đại diện:</label>
            <input type="file" name="avatar" id="avatar" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    

</div>
</div>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Laravel 12 CRUD</title>
</head>

<body>

  <div class="bg-dark text-center text-white py-3">
    <h1 class="h2">Laravel 12 CRUD</h1>
  </div>
  <div class="container">
    <div class="row">
      <div class="d-flex justify-content-end p-0 mt-1">
        <a href="{{ route('product.create') }}" class="btn btn-dark">Create</a>
      </div>

      @if (Session::has('success'))
      <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{Session::get('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      @if (Session::has('error'))
      <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{Session::get('error')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      <div class="card p-0 mt-1">
        <div class="card-header bg-dark text-white">
          <h4 class="h4">Products</h4>
        </div>
        <div class="card-body shadow-lg">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Price</th>
                <th width="120">Status</th>
                <th width="120" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @if ($products->isNotEmpty())
              @foreach ($products as $product)
              <tr>

                <td>{{ $product->id }}</td>

                <td>
                  @if (!empty($product->image))
                  <img class="rounded"
                    src="{{ asset('uploads/products/'.$product->image) }}"
                    width="50">
                  @else
                  <img class="rounded"
                    src="https://placehold.co/600x700"
                    width="50">
                  @endif
                </td>

                <td>{{ $product->name }}</td>

                <td>{{ $product->sku }}</td>

                <td>{{ $product->price }}</td>

                <td>
                  @if ($product->status == 'active')
                  <span class="badge bg-success">Active</span>
                  @else
                  <span class="badge bg-danger">Inactive</span>
                  @endif
                </td>

                <td class="text-center">

                  <a href="{{ route('product.edit', $product->id) }}"
                    class="btn btn-dark btn-sm">
                    Edit
                  </a>

                  <form action="{{ route('product.destroy', $product->id) }}"
                    method="POST"
                    class="d-inline"
                    onsubmit="return confirm('Are you sure you want to delete this product ?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-sm">
                      Delete
                    </button>

                  </form>

                </td>

              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="7" class="text-center">No Products Found</td>
              </tr>

              @endif

            </tbody>

          </table>
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
```php
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">

    <title>Laravel 12 CRUD</title>
</head>

<body>

    <div class="bg-dark text-center text-white py-3">
        <h1 class="h2">Laravel 12 CRUD</h1>
    </div>

    <div class="container">
        <div class="row">

            <div class="d-flex justify-content-end p-0 mt-1">
                <a href="{{ route('product.index') }}" class="btn btn-dark">
                    Back
                </a>
            </div>

            <div class="card p-0 mt-1">

                <div class="card-header bg-dark text-white">
                    <h4 class="h4">Create Product</h4>
                </div>

                <div class="card-body shadow-lg">

                    <form action="{{ route('product.store') }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Name
                            </label>

                            <input
                                value="{{ old('name') }}"
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                placeholder="Name"
                            >

                            @error('name')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="mb-3">
                            <label for="image" class="form-label">
                                Image
                            </label>

                            <input
                                type="file"
                                class="form-control @error('image') is-invalid @enderror"
                                id="image"
                                name="image"
                            >

                            @error('image')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- SKU -->
                        <div class="mb-3">
                            <label for="sku" class="form-label">
                                SKU
                            </label>

                            <input
                                value="{{ old('sku') }}"
                                type="text"
                                class="form-control @error('sku') is-invalid @enderror"
                                id="sku"
                                name="sku"
                                placeholder="SKU"
                            >

                            @error('sku')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label for="price" class="form-label">
                                Price
                            </label>

                            <input
                                value="{{ old('price') }}"
                                type="text"
                                class="form-control @error('price') is-invalid @enderror"
                                id="price"
                                name="price"
                                placeholder="Price"
                            >

                            @error('price')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                id="status"
                                class="form-control @error('status') is-invalid @enderror"
                            >
                                <option value="Active"
                                    {{ old('status') == 'Active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="Inactive"
                                    {{ old('status') == 'Inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>

                            @error('status')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn btn-dark">
                            Submit
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl-+NtUV0F0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous">
    </script>

</body>

</html>
```

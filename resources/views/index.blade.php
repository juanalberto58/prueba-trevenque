@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Gestionar Productos</h1>

        <div class="card mb-4">
            <div class="card-header">
                <h3>Añadir Nuevo Producto</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" id="product-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                            @error('stock')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Categoría</label>
                            <select id="category" class="form-select" name="category_id" required>
                                <option value="">Seleccionar Categoría</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="active" class="form-label">Estado</label>
                            <select id="active" class="form-select" name="active" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                            @error('active')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">Añadir Producto</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Listado de Productos</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Categoría</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->active ? 'Activo' : 'Inactivo' }}</td>
                                <td>
                                    <form action="{{ route('products.toggle', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-sm btn-outline-primary" type="submit">
                                            Cambiar Estado
                                        </button>
                                    </form>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <nav aria-label="Page navigation">
                    <ul class="pagination flex justify-center space-x-2">
                        <li class="page-item">
                            @if ($products->onFirstPage())
                                <span class="page-link text-xs px-3 py-1 bg-gray-300 cursor-not-allowed">« Previous</span>
                            @else
                                <a href="{{ $products->previousPageUrl() }}" class="page-link text-xs px-3 py-1 bg-white border border-gray-300 hover:bg-gray-100">« Previous</a>
                            @endif
                        </li>

                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            <li class="page-item">
                                @if ($page == $products->currentPage())
                                    <span class="page-link text-xs px-3 py-1 bg-gray-200">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="page-link text-xs px-3 py-1 bg-white border border-gray-300 hover:bg-gray-100">{{ $page }}</a>
                                @endif
                            </li>
                        @endforeach

                        <li class="page-item">
                            @if ($products->hasMorePages())
                                <a href="{{ $products->nextPageUrl() }}" class="page-link text-xs px-3 py-1 bg-white border border-gray-300 hover:bg-gray-100">Next »</a>
                            @else
                                <span class="page-link text-xs px-3 py-1 bg-gray-300 cursor-not-allowed">Next »</span>
                            @endif
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById("product-form").addEventListener("submit", function(event) {
            let isValid = true;

            const name = document.getElementById("name");
            if (name.value.trim() === "") {
                isValid = false;
                alert("El nombre del producto es obligatorio.");
            }

            const price = document.getElementById("price");
            if (price.value <= 0) {
                isValid = false;
                alert("El precio debe ser mayor que 0.");
            }

            const stock = document.getElementById("stock");
            if (stock.value < 0) {
                isValid = false;
                alert("El stock debe ser mayor o igual a 0.");
            }

            const category = document.getElementById("category");
            if (category.value === "") {
                isValid = false;
                alert("Debe seleccionar una categoría.");
            }

            if (!isValid) {
                event.preventDefault(); 
            }
        });
    </script>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Gestionar Productos</h1>

        <div class="card mb-4">
            <div class="card-header">
                <h3>Añadir Nuevo Producto</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Categoría</label>
                            <select id="category" class="form-select" name="category_id" required>
                                <option value="">Seleccionar Categoría</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="active" class="form-label">Estado</label>
                            <select id="active" class="form-select" name="active" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
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
                    {{ $products->links() }}
                </nav>
            </div>
        </div>
    </div>
@endsection

<head>
    <title>Daftar Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<div class="container mt-5">
    <h1>Daftar Blog</h1>
    <a href="/tambah" class="btn btn-success mb-3">Tambah Blog</a>
    <div class="row">
        @foreach ($blogs as $blog)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if ($blog->foto)
                        <img src="{{ asset('storage/' . $blog->foto) }}" class="card-img-top" alt="Foto Blog">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->judul }}</h5>
                        <p class="card-text">{{ $blog->isi }}</p>
                        <p><small>Pembuat: {{ $blog->pembuat }}</small></p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('blogs.delete', $blog->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus blog ini?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <a href="/logout" class="btn btn-danger">Logout</a>
</div>

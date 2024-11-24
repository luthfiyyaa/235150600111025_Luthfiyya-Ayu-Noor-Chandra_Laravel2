<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Edit Blog</title>
</head>
<body class="container mt-5">
    <h1>Edit Blog</h1>
    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ $blog->judul }}" required>
        </div>
        <div class="mb-3">
            <label for="isi" class="form-label">Isi</label>
            <textarea name="isi" id="isi" class="form-control" rows="5" required>{{ $blog->isi }}</textarea>
        </div>
        <div class="mb-3">
            <label for="pembuat" class="form-label">Pembuat</label>
            <input type="text" name="pembuat" id="pembuat" class="form-control" value="{{ $blog->pembuat }}" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Upload Foto (Opsional)</label>
            @if ($blog->foto)
                <img src="{{ asset('storage/' . $blog->foto) }}" alt="Foto Blog" class="img-thumbnail mb-3" style="max-width: 200px;">
            @endif
            <input type="file" name="foto" id="foto" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</body>
</html>

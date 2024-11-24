<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h1>Tambah Blog</h1>
    <form action="/tambah" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="isi" class="form-label">Isi</label>
            <textarea name="isi" id="isi" class="form-control" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="pembuat" class="form-label">Pembuat</label>
            <input type="text" name="pembuat" id="pembuat" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Upload Foto (Opsional)</label>
            <input type="file" name="foto" id="foto" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</body>
</html>

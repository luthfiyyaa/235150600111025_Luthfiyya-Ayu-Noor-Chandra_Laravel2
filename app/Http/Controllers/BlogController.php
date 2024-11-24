<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function showBlogs()
    {
        $blogs = Blog::all();

        return view("blogs/list", [
            "blogs" => $blogs
        ]);
    }

    public function tambahBlog() {
        return view('blogs/create');
    }

    public function createBlog(Request $request){
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'pembuat' => 'required|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan file foto jika ada
        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        Blog::create($validatedData);

        return redirect('/blogs')->with('success', 'Blog berhasil ditambahkan!');
    }

    public function editBlog($id){
        $blog = Blog::findOrFail($id); // Cari blog berdasarkan ID
        
        return view('blogs/edit', ['blog' => $blog]); // Kirim data blog ke view
    }

    public function updateBlog(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'pembuat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog = Blog::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($blog->foto && file_exists(storage_path('app/public/' . $blog->foto))) {
                unlink(storage_path('app/public/' . $blog->foto));
            }
            $blog->foto = $request->file('foto')->store('uploads', 'public');
        }

        $blog->update($request->only('judul', 'isi', 'pembuat'));

        return redirect('/blogs')->with('success', 'Blog berhasil diperbarui!');
    }

    public function deleteBlog($id)
    {
        $blog = Blog::findOrFail($id);

        // Hapus foto jika ada
        if ($blog->foto && file_exists(storage_path('app/public/' . $blog->foto))) {
            unlink(storage_path('app/public/' . $blog->foto));
        }

        $blog->delete();

        return redirect('/blogs')->with('success', 'Blog berhasil dihapus!');
    }


}
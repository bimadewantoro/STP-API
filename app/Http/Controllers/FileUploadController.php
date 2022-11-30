<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function index()
    {
        return view('file-upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,docx,doc,png,jpg,jpeg,gif|max:2048',
        ]);

        $fileName = time().'.'.$request->file->extension();  

        $request->file->move(public_path('uploads'), $fileName);

        return response()->json([
            'success' => true,
            'message' => 'File uploaded successfully',
            'data' => $fileName
        ]);
    }
}

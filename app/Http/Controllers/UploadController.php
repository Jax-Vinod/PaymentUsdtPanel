<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index()
    {
        $files = Storage::disk('s3')->files('files');

        $data = [];
        foreach($files as $file) {
            $data[] = [
                'name' => basename($file),
                'downloadUrl' => url('/download/'.base64_encode($file)),
                'removeUrl' => url('/remove/'.base64_encode($file)),
            ];
        }

        return view('upload', ['files' => $data]);
    }

    public function uploadNoticeDocument(Request $request)
    {
        $this->validate($request, [
            'file' => ['required', 'mimes:jpeg,png,jpg'],
        ]);

        $doc_path = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if($file->getSize() > 20971520) // 20M
                return response()->json(['error' => 'The file must be less than 20M'], 500);
            try {
                $doc = $file->storeAs('notices', time().'.'.$file->getClientOriginalExtension(), 's3');
                $doc_path = Storage::disk('s3')->url($doc);
            } catch (\Throwable $th) {
                Log::error('notice upload: '.$th->getMessage());
                return response()->json(['error' => 'The file upload error'], 500);
            }

        }
        return response()->json($doc_path);
    }

    public function uploadFile(Request $request)
    {
        $this->validate($request, [
            'file' => ['required', 'mimes:jpeg,png,jpg'],
        ]);

        $doc_path = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if($file->getSize() > 20971520) // 20M
                return response()->json(['error' => 'The file must be less than 20M'], 500);
            try {
                $doc = $file->storeAs('files', time().'.'.$file->getClientOriginalExtension(), 's3');
                $doc_path = Storage::disk('s3')->url($doc);
            } catch (\Throwable $th) {
                Log::error('notice upload: '.$th->getMessage());
                return response()->json(['error' => 'The file upload error'], 500);
            }

        }
        return response()->json($doc_path);
    }

    public function destroy(Request $request)
    {
        try {

            // $file = base64_decode($file);
            Storage::disk('s3')->delete($request->file);
            return response()->json(true);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(false, 500);
        }
    }

    public function download($file)
    {
        try {
            // $file = base64_decode($file);
            $name = basename($file);
            Storage::disk('s3')->download($file, $name);
            return response()->json(true);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(true);
        }
    }
}

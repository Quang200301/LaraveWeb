<?php

namespace App\Http\Controllers;
use PDF;

use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function uploadPDF(Request $request)
    {
        if ($request->hasFile('pdf_file')) {
            $pdfFile = $request->file('pdf_file');

            // Lưu trữ file vào thư mục tạm thời
            $pdfPath = $pdfFile->store('temp', 'public');

            // Đường dẫn đầy đủ của file tạm thời
            $fullPath = storage_path('app/public/' . $pdfPath);

            // Tạo file PDF từ đường dẫn đầy đủ
            $pdf = PDF::loadFile($fullPath);

            // Xóa file tạm thời
            unlink($fullPath);

            return $pdf->download('file.pdf');
        }

        // Xử lý nếu không có file được tải lên

        return redirect()->back();
    }
}

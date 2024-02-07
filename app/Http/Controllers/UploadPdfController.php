<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class UploadPdfController extends Controller
{


    public function index()
    {
        return view('upload-pdf');
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            "file" => "required|file|mimes:pdf",
        ]);

        $file = $request->file('file');

        $file->move(public_path('files'), 'uploaded_file.pdf');

        $filePath = public_path('files/uploaded_file.pdf');

        $outputPath = public_path('files/output_file.pdf');

        $this->editPdfFile($filePath, $outputPath);

        return response()->file($outputPath);

        // return redirect()->back()->with('success','Uploaded Successfully');

    }


    public function editPdfFile($filePath, $outputPath)
    {

        $fpdi = new Fpdi();

        $count =  $fpdi->setSourceFile($filePath);

        if ($count > 0) {

            $template = $fpdi->importPage(1);

            $size = $fpdi->getTemplateSize($template);

            $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);

            $fpdi->SetFont("Times");

            $fpdi->Text(10, 10, "Hello world");

            for ($i = 1; $i <= $count; $i++) {
                $template = $fpdi->importPage($i);
                $size = $fpdi->getTemplateSize($template);

                $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);

                $fpdi->useTemplate($template);
            }

            $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);

            $fpdi->Image("https://i.ibb.co/7XK1Z5S/algharabli.jpg",10,10);

            $fpdi->Output($outputPath, 'F');
        }
    }
}

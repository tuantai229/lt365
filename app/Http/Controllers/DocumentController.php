<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Level;
use App\Models\Subject;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Placeholder for data retrieval
        $documents = []; 
        $levels = Level::active()->ordered()->get();
        $subjects = Subject::active()->ordered()->get();
        $documentTypes = DocumentType::active()->ordered()->get();

        return view('documents.index', compact('documents', 'levels', 'subjects', 'documentTypes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug, $id)
    {
        // Placeholder for data retrieval
        $document = new \stdClass();
        $document->name = 'Đề thi Toán vào lớp 10 - Trường THPT Chuyên Hà Nội Amsterdam 2025';
        $document->description = 'Đề thi Toán chính thức vào lớp 10 trường THPT Chuyên Hà Nội Amsterdam năm học 2025-2026. Đề thi gồm 8 câu hỏi, thời gian làm bài 150 phút, phù hợp cho học sinh ôn luyện thi vào các trường chuyên.';
        $document->image = 'images/2ea343b800b7ca44c1844291afa997e9.jpg';
        $document->created_at = now();
        $document->view_count = 3247;
        $document->page_count = 8;
        $document->file_size = '2.4 MB';
        $document->difficulty = 'hard';
        $document->tags = ['Đề thi Toán lớp 10', 'Chuyên Amsterdam', 'Hà Nội', '2025', 'Trường chuyên'];
        $document->document_type = 'Đề thi chính thức';
        
        $relatedDocuments = [];

        return view('documents.show', compact('document', 'relatedDocuments'));
    }

    // Methods for filtering will be implemented later
    public function byType(DocumentType $documentType)
    {
        return $this->index();
    }

    public function byLevel(Level $level)
    {
        return $this->index();
    }

    public function bySubject(Subject $subject)
    {
        return $this->index();
    }

    public function byTypeAndLevel(DocumentType $documentType, Level $level)
    {
        return $this->index();
    }

    public function byTypeAndSubject(DocumentType $documentType, Subject $subject)
    {
        return $this->index();
    }

    public function byLevelAndSubject(Level $level, Subject $subject)
    {
        return $this->index();
    }

    public function byAll(DocumentType $documentType, Level $level, Subject $subject)
    {
        return $this->index();
    }

    public function download(Request $request, $slug, $id)
    {
        // Download logic will be implemented later
        return redirect()->back();
    }
}

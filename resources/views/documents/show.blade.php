@extends('layouts.app')

@section('title', $document->name . ' | LT365')
@section('description', $document->description)

@section('content')
    @include('documents.partials.breadcrumb')
    
    <section class="py-8 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <article class="lg:col-span-8">
                    @include('documents.partials.document-header')
                    @include('documents.partials.document-content')
                    @include('documents.partials.document-footer')
                    
                    <!-- Comments Section -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <x-comments.comment-list 
                            type="documents" 
                            :type-id="$document->id" 
                        />
                    </div>
                </article>
                <aside class="lg:col-span-4">
                    @include('documents.partials.sidebar')
                </aside>
            </div>
        </div>
    </section>

    @include('partials.cta-newsletter')
@endsection

@push('styles')
<style>
    .pdf-viewer {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
    }
    .pdf-controls {
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        padding: 0.75rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .difficulty-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    .difficulty-easy {
        background-color: #dcfce7;
        color: #16a34a;
    }
    .difficulty-medium {
        background-color: #fef3c7;
        color: #d97706;
    }
    .difficulty-hard {
        background-color: #fecaca;
        color: #dc2626;
    }
</style>
@endpush

@push('scripts')
<script>
    // Check if browser supports PDF viewing
    document.addEventListener('DOMContentLoaded', function() {
        const iframe = document.querySelector('iframe[src$=".pdf"]');
        const fallback = document.getElementById('pdf-fallback');
        
        if (iframe) {
            iframe.addEventListener('error', function() {
                iframe.style.display = 'none';
                if (fallback) {
                    fallback.style.display = 'flex';
                }
            });
        }
    });

    // Download functionality
    function downloadFile() {
        const link = document.createElement('a');
        link.href = 'documents/de-thi-toan-chuyen-amsterdam-2025.pdf';
        link.download = 'De-thi-Toan-lop-10-Chuyen-Amsterdam-2025.pdf';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // Add download event listeners
    document.addEventListener('DOMContentLoaded', function() {
        const downloadButtons = document.querySelectorAll('button[class*="download"], button:has(i.ri-download-line)');
        downloadButtons.forEach(button => {
            button.addEventListener('click', downloadFile);
        });
    });
</script>
@endpush

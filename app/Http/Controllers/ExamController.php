<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display the main exam landing page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('exam.index');
    }

    /**
     * Display the landing page for grade 1 exams.
     *
     * @return \Illuminate\View\View
     */
    public function grade1()
    {
        // For now, we can redirect to the main exam page or create a specific view
        return view('exam.grade1');
    }

    /**
     * Display the landing page for grade 6 exams.
     *
     * @return \Illuminate\View\View
     */
    public function grade6()
    {
        // For now, we can redirect to the main exam page or create a specific view
        return view('exam.grade6');
    }

    /**
     * Display the landing page for grade 10 exams.
     *
     * @return \Illuminate\View\View
     */
    public function grade10()
    {
        // For now, we can redirect to the main exam page or create a specific view
        return view('exam.grade10');
    }
}

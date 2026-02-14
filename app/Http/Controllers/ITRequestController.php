<?php

namespace App\Http\Controllers;

use App\Models\ITRequest;
use App\Mail\RequestConfirmation;
use App\Mail\RequestStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ITRequestController extends Controller
{
    protected array $departments = [
        1  => 'Cell Ministry',
        2  => 'Zonal Operations',
        3  => 'Church Admin / Pioneering & Visitation',
        4  => 'Rhapsody of Realities',
        5  => 'Healing School',
        6  => 'Finance',
        7  => 'TV Production',
        8  => 'Ministry Material',
        9  => 'Foundation School & First Timer Ministries',
        10 => 'LoveWorld Music Department',
        11 => 'Global Mission Mandate / HR / Admin Department',
        12 => 'Children and Women Ministries',
        13 => 'LLM, LXP, Ministry Prog. Bibles Partnership Dept',
        14 => 'LW USA, LTM / Radio Brands, Inner City Missions',
        15 => 'Follow Up Department',
    ];

    /**
     * Show request form
     */
    public function create()
    {
        return view('requests.create', [
            'departments' => $this->departments
        ]);
    }

    /**
     * Dashboard listing
     */
    public function index()
    {
        return view('dashboard', [
            'requests'    => ITRequest::latest()->get(),
            'departments' => $this->departments,
        ]);
    }

    /**
     * Store IT request
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name'   => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'department'  => 'required|in:' . implode(',', array_keys($this->departments)),
            'title'       => 'required|string|max:100',
            'description' => 'required|string',
            // CHANGE THIS LINE:
            'attachment'  => 'nullable|file|mimes:jpg,jpeg,png,doc,docx,pdf|max:5120',
        ]);

        // Convert department ID → Name
        $data['department'] = $this->departments[$data['department']];

        /**
         * Priority Logic
         */
        $data['priority'] = 'Low';

        $urgent = ['urgent', 'emergency', 'broken', 'stopped', 'critical', 'down', 'error'];
        $medium = ['help', 'setup', 'access', 'new'];

        $content = strtolower($data['title'] . ' ' . $data['description']);

        foreach ($urgent as $word) {
            if (str_contains($content, $word)) {
                $data['priority'] = 'High';
                break;
            }
        }

        if ($data['priority'] === 'Low') {
            foreach ($medium as $word) {
                if (str_contains($content, $word)) {
                    $data['priority'] = 'Medium';
                    break;
                }
            }
        }

        /**
         * File upload
         */
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request
                ->file('attachment')
                ->store('attachments', 'public');
        }

        $itRequest = ITRequest::create($data);

        /**
         * Confirmation email
         */
        if (class_exists(RequestConfirmation::class)) {
            Mail::to($itRequest->email)
                ->queue(new RequestConfirmation($itRequest));
        }

        return redirect()
            ->back()
            ->with('success', "Ticket #{$itRequest->id} logged successfully.");
    }

    /**
     * Update ticket status (WEB FLOW)
     */
    public function updateStatus(Request $request, $id)
    {
        $itRequest = ITRequest::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,in-progress,resolved',
        ]);

        $oldStatus = $itRequest->status;

        $itRequest->update([
            'status' => $validated['status'],
        ]);

        /**
         * Send resolved email only once
         */
        if ($oldStatus !== 'resolved' && $validated['status'] === 'resolved') {
            if (class_exists(RequestStatusUpdated::class)) {
                Mail::to($itRequest->email)
                    ->queue(new RequestStatusUpdated($itRequest));
            }
        }

        return redirect()
            ->back()
            ->with(
                'success',
                "Ticket #{$itRequest->id} status updated to " . ucfirst($validated['status'])
            );
    }

    /**
     * Download the PRD Template Word Document
     */
    public function downloadTemplate()
    {
        // Define the path to the file in the public folder
        $filePath = public_path('templates/PRD_Template.docx');

        // Check if the file actually exists to prevent 404 crashes
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'The template file is currently unavailable.');
        }

        // Return the file download response
        return response()->download($filePath, 'IT_Project_PRD_Template.docx');
    }
}

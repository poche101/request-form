<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap');

        .ticket-root *, .ticket-root *::before, .ticket-root *::after { box-sizing: border-box; }

        .ticket-root {
            font-family: 'DM Sans', sans-serif;
            background: #0a0a0f;
            min-height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 56px 20px;
            position: relative;
            overflow-x: hidden;
        }

        .ticket-root::before {
            content: '';
            position: fixed;
            top: -200px; left: 50%; transform: translateX(-50%);
            width: 900px; height: 700px;
            background: radial-gradient(ellipse, rgba(196,160,80,0.07) 0%, transparent 70%);
            pointer-events: none; z-index: 0;
        }

        .ticket-wrap {
            width: 100%; max-width: 640px;
            position: relative; z-index: 1;
            animation: tkt-fadeUp 0.8s cubic-bezier(0.22,1,0.36,1) both;
        }

        @keyframes tkt-fadeUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Success */
        .tkt-success {
            background: rgba(20,50,32,0.85);
            border: 1px solid rgba(50,180,80,0.2);
            border-radius: 14px;
            padding: 14px 20px;
            color: #5cc87a;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 28px;
        }

        /* Header */
        .tkt-header { text-align: center; margin-bottom: 44px; }

        .tkt-icon {
            width: 58px; height: 58px;
            border-radius: 17px;
            background: linear-gradient(135deg, #c4a050, #e8c96a);
            display: inline-flex; align-items: center; justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 0 0 1px rgba(196,160,80,0.3), 0 10px 40px rgba(196,160,80,0.22);
        }

        .tkt-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 32px; font-weight: 700;
            color: #f0ece0; letter-spacing: -0.5px; line-height: 1.1;
        }

        .tkt-header p { color: #4a4a5a; font-size: 14px; margin-top: 8px; }

        /* Callout */
        .tkt-callout {
            background: linear-gradient(135deg, rgba(196,160,80,0.06), rgba(196,160,80,0.02));
            border: 1px solid rgba(196,160,80,0.14);
            border-radius: 18px;
            padding: 18px 22px;
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 28px;
            backdrop-filter: blur(12px);
        }

        .tkt-callout-left { display: flex; align-items: center; gap: 14px; }

        .tkt-callout-icon {
            width: 40px; height: 40px;
            background: rgba(196,160,80,0.1);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: #c4a050; flex-shrink: 0;
        }

        .tkt-callout h4 { font-size: 13px; font-weight: 600; color: #d4c9a8; }
        .tkt-callout p  { font-size: 11px; color: #3e3e4e; margin-top: 2px; }

        .tkt-dl-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 9px 16px;
            background: rgba(196,160,80,0.1);
            border: 1px solid rgba(196,160,80,0.22);
            border-radius: 10px;
            color: #c4a050;
            font-size: 11px; font-weight: 700;
            letter-spacing: 0.08em; text-transform: uppercase;
            text-decoration: none;
            transition: all 0.2s;
            flex-shrink: 0;
        }
        .tkt-dl-btn:hover {
            background: rgba(196,160,80,0.2);
            border-color: rgba(196,160,80,0.45);
            transform: translateY(-1px);
        }

        /* Card */
        .tkt-card {
            background: rgba(13,13,20,0.92);
            border: 1px solid rgba(255,255,255,0.055);
            border-radius: 28px; overflow: hidden;
            backdrop-filter: blur(20px);
            box-shadow: 0 32px 80px rgba(0,0,0,0.55), inset 0 1px 0 rgba(255,255,255,0.04);
        }

        /* Section label */
        .tkt-sec {
            display: flex; align-items: center; gap: 10px;
            padding: 28px 36px 0;
            margin-bottom: 22px;
        }
        .tkt-sec span {
            font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.18em;
            color: #2e2e3c; white-space: nowrap;
        }
        .tkt-sec::after {
            content: ''; flex: 1; height: 1px;
            background: linear-gradient(to right, rgba(255,255,255,0.05), transparent);
        }

        /* Form */
        .tkt-form { padding: 0 36px 44px; }

        .tkt-field { margin-bottom: 22px; }

        .tkt-label {
            display: block;
            font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.15em;
            color: #38384a; margin-bottom: 8px;
        }

        .tkt-input,
        .tkt-select,
        .tkt-textarea {
            width: 100%;
            background: rgba(255,255,255,0.025);
            border: 1px solid rgba(255,255,255,0.065);
            border-radius: 12px;
            padding: 14px 18px;
            color: #e8e4d8;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 400;
            outline: none;
            transition: all 0.25s;
            -webkit-appearance: none;
        }

        .tkt-input::placeholder { color: #222230; }

        .tkt-input:focus, .tkt-select:focus, .tkt-textarea:focus {
            border-color: rgba(196,160,80,0.38);
            background: rgba(196,160,80,0.028);
            box-shadow: 0 0 0 3px rgba(196,160,80,0.07);
            color: #f0ece0;
        }

        .tkt-input.error, .tkt-select.error, .tkt-textarea.error {
            border-color: rgba(220,80,80,0.5);
            box-shadow: 0 0 0 3px rgba(220,80,80,0.07);
        }

        .tkt-select-wrap { position: relative; }
        .tkt-select-arrow {
            position: absolute; right: 16px; top: 50%;
            transform: translateY(-50%);
            pointer-events: none; color: #2e2e3c;
        }
        .tkt-select option { background: #0d0d14; color: #e8e4d8; }

        .tkt-textarea { resize: none; line-height: 1.65; }

        .tkt-error {
            font-size: 10px; color: #e05757;
            margin-top: 5px; margin-left: 2px;
            font-weight: 600;
        }

        /* Divider */
        .tkt-divider {
            border: none;
            border-top: 1px solid rgba(255,255,255,0.04);
            margin: 30px 0;
        }

        /* Upload */
        .tkt-upload-zone {
            background: rgba(196,160,80,0.025);
            border: 1.5px dashed rgba(196,160,80,0.18);
            border-radius: 16px; padding: 34px 24px;
            text-align: center; cursor: pointer;
            transition: all 0.25s; position: relative;
        }
        .tkt-upload-zone:hover {
            background: rgba(196,160,80,0.055);
            border-color: rgba(196,160,80,0.38);
        }
        .tkt-upload-zone input[type="file"] {
            position: absolute; inset: 0;
            opacity: 0; width: 100%; height: 100%;
            cursor: pointer; z-index: 10;
            border: none; background: none; padding: 0;
        }
        .tkt-upload-icon { color: #c4a050; opacity: 0.6; margin-bottom: 10px; }
        .tkt-upload-title { font-size: 13px; font-weight: 600; color: #5c5040; font-style: italic; }
        .tkt-upload-hint {
            font-size: 10px; color: #28283a;
            text-transform: uppercase; letter-spacing: 0.1em; margin-top: 6px;
        }

        /* Submit */
        .tkt-submit {
            width: 100%; margin-top: 34px;
            padding: 17px;
            background: linear-gradient(135deg, #c4a050 0%, #e8c96a 50%, #c4a050 100%);
            background-size: 200% 100%;
            border: none; border-radius: 14px;
            color: #0a0805;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 700;
            letter-spacing: 0.07em; text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 8px 32px rgba(196,160,80,0.22);
            position: relative; overflow: hidden;
        }
        .tkt-submit::before {
            content: ''; position: absolute; inset: 0;
            background: rgba(255,255,255,0.12);
            opacity: 0; transition: opacity 0.2s;
        }
        .tkt-submit:hover {
            background-position: 100% 0;
            transform: translateY(-1px);
            box-shadow: 0 12px 40px rgba(196,160,80,0.32);
        }
        .tkt-submit:hover::before { opacity: 1; }
        .tkt-submit:active { transform: scale(0.986); }

        /* Footer */
        .tkt-footer {
            text-align: center; margin-top: 32px;
            font-size: 10px; font-weight: 700;
            letter-spacing: 0.22em; text-transform: uppercase;
            color: #1e1e28;
        }
    </style>

    <div class="ticket-root">
        <div class="ticket-wrap">

            {{-- Success --}}
            @if (session('success'))
                <div class="tkt-success">{{ session('success') }}</div>
            @endif

            {{-- Header --}}
            <div class="tkt-header">
                <div class="tkt-icon">
                    <svg width="22" height="22" fill="none" stroke="#0a0805" stroke-width="2.2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h1>IT Support Ticket</h1>
                <p>Fill out the details for rapid assistance.</p>
            </div>

            {{-- Template Callout --}}
            <div class="tkt-callout">
                <div class="tkt-callout-left">
                    <div class="tkt-callout-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h4>PRD Template</h4>
                        <p>Download the Word doc for project specs</p>
                    </div>
                </div>
                <a href="{{ route('template.download') }}" class="tkt-dl-btn">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M7 10l5 5m0 0l5-5m-5 5V3"/>
                    </svg>
                    Download
                </a>
            </div>

            {{-- Card --}}
            <div class="tkt-card">

                <div class="tkt-sec"><span>Identity</span></div>

                <form action="{{ route('requests.store') }}" method="POST"
                    enctype="multipart/form-data" class="tkt-form">
                    @csrf

                    {{-- Full Name --}}
                    <div class="tkt-field">
                        <label class="tkt-label">Full Name</label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" required
                            placeholder="Your full name"
                            class="tkt-input @error('full_name') error @enderror">
                        @error('full_name')
                            <p class="tkt-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="tkt-field">
                        <label class="tkt-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="yourname@company.com"
                            class="tkt-input @error('email') error @enderror">
                        @error('email')
                            <p class="tkt-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Department --}}
                    <div class="tkt-field">
                        <label class="tkt-label">Department</label>
                        <div class="tkt-select-wrap">
                            <select name="department" required
                                class="tkt-select @error('department') error @enderror">
                                <option value="" disabled {{ old('department') ? '' : 'selected' }}>Select your department</option>
                                @foreach ($departments as $id => $name)
                                    <option value="{{ $id }}" {{ old('department') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="tkt-select-arrow">
                                <svg width="14" height="14" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </div>
                        @error('department')
                            <p class="tkt-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="tkt-divider">

                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:22px;">
                        <span style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.18em;color:#2e2e3c;white-space:nowrap;">Issue Details</span>
                        <div style="flex:1;height:1px;background:linear-gradient(to right,rgba(255,255,255,0.05),transparent);"></div>
                    </div>

                    {{-- Subject --}}
                    <div class="tkt-field">
                        <label class="tkt-label">Subject</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            placeholder="Brief summary of the issue"
                            class="tkt-input @error('title') error @enderror">
                        @error('title')
                            <p class="tkt-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="tkt-field">
                        <label class="tkt-label">Description</label>
                        <textarea name="description" rows="4" required
                            placeholder="Describe the issue in detail — steps, errors, context..."
                            class="tkt-textarea @error('description') error @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="tkt-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="tkt-divider">

                    {{-- Upload --}}
                    <div class="tkt-field">
                        <label class="tkt-label">
                            Submit Filled PRD
                            <span style="color:#28283a;font-weight:400;text-transform:none;letter-spacing:0;">(JPEG, PNG, or PDF)</span>
                        </label>
                        <div class="tkt-upload-zone">
                            <input type="file" name="attachment" id="attachment"
                                accept=".jpg,.jpeg,.png,.doc,.docx,.pdf"
                                onchange="document.getElementById('tkt-fname').textContent = this.files[0].name">
                            <div class="tkt-upload-icon">
                                <svg width="32" height="32" fill="none" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                    viewBox="0 0 24 24">
                                    <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                            </div>
                            <p id="tkt-fname" class="tkt-upload-title">Drop your filled PRD here</p>
                            <p class="tkt-upload-hint">DOCX · PDF · JPG · PNG &nbsp;·&nbsp; Max 5MB</p>
                        </div>
                        @error('attachment')
                            <p class="tkt-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="tkt-submit">Submit Request</button>

                </form>
            </div>

            <p class="tkt-footer">IT Support Portal &nbsp;·&nbsp; Secure Connection</p>
        </div>
    </div>
</x-guest-layout>

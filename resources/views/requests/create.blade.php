<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap');

        .ticket-root *, .ticket-root *::before, .ticket-root *::after { box-sizing: border-box; }

        .ticket-root {
            font-family: 'DM Sans', sans-serif;
            background: #f4f2ee;
            min-height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 56px 20px;
        }

        .ticket-wrap {
            width: 100%; max-width: 620px;
            animation: tkt-up 0.7s cubic-bezier(0.22,1,0.36,1) both;
        }

        @keyframes tkt-up {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Success */
        .tkt-success {
            background: #edf7f1;
            border: 1px solid #b6dfc6;
            border-radius: 12px;
            padding: 13px 18px;
            color: #2a7a4a;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 24px;
        }

        /* Header */
        .tkt-header { text-align: center; margin-bottom: 40px; }

        .tkt-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            background: #e8650a;
            display: inline-flex; align-items: center; justify-content: center;
            margin-bottom: 18px;
            box-shadow: 0 4px 24px rgba(232,101,10,0.28);
        }

        .tkt-header h1 {
            font-family: 'Instrument Serif', serif;
            font-size: 30px; font-weight: 400;
            color: #1a1a2e; letter-spacing: -0.3px; line-height: 1.15;
        }

        .tkt-header p { color: #9a9488; font-size: 13px; margin-top: 6px; }

        /* Callout */
        .tkt-callout {
            background: #fff;
            border: 1px solid #e8e4dc;
            border-radius: 16px;
            padding: 16px 20px;
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 24px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }

        .tkt-callout-left { display: flex; align-items: center; gap: 12px; }

        .tkt-callout-icon {
            width: 38px; height: 38px;
            background: #fff4ee;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            color: #e8650a; flex-shrink: 0;
        }

        .tkt-callout h4 { font-size: 13px; font-weight: 600; color: #1a1a2e; }
        .tkt-callout p  { font-size: 11px; color: #b0aa9e; margin-top: 1px; }

        .tkt-dl-btn {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 8px 14px;
            background: #e8650a;
            border-radius: 9px;
            color: #fff;
            font-size: 11px; font-weight: 600;
            letter-spacing: 0.07em; text-transform: uppercase;
            text-decoration: none;
            transition: all 0.2s;
            flex-shrink: 0;
        }
        .tkt-dl-btn:hover { background: #cf5608; transform: translateY(-1px); }

        /* Card */
        .tkt-card {
            background: #fff;
            border: 1px solid #e8e4dc;
            border-radius: 24px; overflow: hidden;
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
        }

        /* Section label */
        .tkt-sec {
            display: flex; align-items: center; gap: 10px;
            padding: 28px 32px 0;
            margin-bottom: 20px;
        }
        .tkt-sec span {
            font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.18em;
            color: #c8c2b8; white-space: nowrap;
        }
        .tkt-sec::after {
            content: ''; flex: 1; height: 1px;
            background: linear-gradient(to right, #ece8e0, transparent);
        }

        /* Form */
        .tkt-form { padding: 0 32px 40px; }

        .tkt-field { margin-bottom: 20px; }

        .tkt-label {
            display: block;
            font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.14em;
            color: #b0aa9e; margin-bottom: 7px;
        }

        .tkt-input,
        .tkt-select,
        .tkt-textarea {
            width: 100%;
            background: #f9f7f4;
            border: 1px solid #e8e4dc;
            border-radius: 10px;
            padding: 13px 16px;
            color: #1a1a2e;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 400;
            outline: none;
            transition: all 0.2s;
            -webkit-appearance: none;
        }

        .tkt-input::placeholder { color: #c8c2b8; }

        .tkt-input:focus, .tkt-select:focus, .tkt-textarea:focus {
            border-color: #e8650a;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(232,101,10,0.1);
        }

        .tkt-input.error, .tkt-select.error, .tkt-textarea.error {
            border-color: #e05757;
            box-shadow: 0 0 0 3px rgba(224,87,87,0.08);
        }

        .tkt-select-wrap { position: relative; }
        .tkt-select-arrow {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%);
            pointer-events: none; color: #b0aa9e;
        }

        .tkt-textarea { resize: none; line-height: 1.65; }

        .tkt-error {
            font-size: 10px; color: #e05757;
            margin-top: 5px; margin-left: 2px;
            font-weight: 600;
        }

        /* Divider */
        .tkt-divider {
            border: none;
            border-top: 1px solid #f0ece6;
            margin: 26px 0;
        }

        /* Issue section label inline */
        .tkt-sec2 {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 20px;
        }
        .tkt-sec2 span {
            font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.18em;
            color: #c8c2b8; white-space: nowrap;
        }
        .tkt-sec2::after {
            content: ''; flex: 1; height: 1px;
            background: linear-gradient(to right, #ece8e0, transparent);
        }

        /* Upload */
        .tkt-upload-zone {
            background: #fff8f4;
            border: 1.5px dashed #f0c9aa;
            border-radius: 14px; padding: 30px 20px;
            text-align: center; cursor: pointer;
            transition: all 0.2s; position: relative;
        }
        .tkt-upload-zone:hover {
            background: #fff2e8;
            border-color: #e8650a;
        }
        .tkt-upload-zone input[type="file"] {
            position: absolute; inset: 0;
            opacity: 0; width: 100%; height: 100%;
            cursor: pointer; z-index: 10;
            border: none; background: none; padding: 0;
        }
        .tkt-upload-icon { color: #e8650a; margin-bottom: 8px; }
        .tkt-upload-title { font-size: 13px; font-weight: 500; color: #9a9488; font-style: italic; }
        .tkt-upload-hint {
            font-size: 10px; color: #c8c2b8;
            text-transform: uppercase; letter-spacing: 0.1em; margin-top: 5px;
        }

        /* Submit */
        .tkt-submit {
            width: 100%; margin-top: 28px;
            padding: 16px;
            background: #e8650a;
            border: none; border-radius: 12px;
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 600;
            letter-spacing: 0.07em; text-transform: uppercase;
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 4px 20px rgba(232,101,10,0.28);
        }
        .tkt-submit:hover {
            background: #cf5608;
            transform: translateY(-1px);
            box-shadow: 0 8px 28px rgba(232,101,10,0.32);
        }
        .tkt-submit:active { transform: scale(0.985); }

        /* Footer */
        .tkt-footer {
            text-align: center; margin-top: 28px;
            font-size: 10px; font-weight: 600;
            letter-spacing: 0.2em; text-transform: uppercase;
            color: #c8c2b8;
        }
    </style>

    <div class="ticket-root">
        <div class="ticket-wrap">

            @if (session('success'))
                <div class="tkt-success">{{ session('success') }}</div>
            @endif

            {{-- Header --}}
            <div class="tkt-header">
                <div class="tkt-icon">
                    <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="2.2"
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
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8"
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
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"
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

                    <div class="tkt-field">
                        <label class="tkt-label">Full Name</label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" required
                            placeholder="Your full name"
                            class="tkt-input @error('full_name') error @enderror">
                        @error('full_name')
                            <p class="tkt-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="tkt-field">
                        <label class="tkt-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="yourname@company.com"
                            class="tkt-input @error('email') error @enderror">
                        @error('email')
                            <p class="tkt-error">{{ $message }}</p>
                        @enderror
                    </div>

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
                                <svg width="13" height="13" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </div>
                        @error('department')
                            <p class="tkt-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="tkt-divider">

                    <div class="tkt-sec2"><span>Issue Details</span></div>

                    <div class="tkt-field">
                        <label class="tkt-label">Subject</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            placeholder="Brief summary of the issue"
                            class="tkt-input @error('title') error @enderror">
                        @error('title')
                            <p class="tkt-error">{{ $message }}</p>
                        @enderror
                    </div>

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

                    <div class="tkt-field">
                        <label class="tkt-label">
                            Submit Filled PRD
                            <span style="color:#c8c2b8;font-weight:400;text-transform:none;letter-spacing:0;">(JPEG, PNG, or PDF)</span>
                        </label>
                        <div class="tkt-upload-zone">
                            <input type="file" name="attachment" id="attachment"
                                accept=".jpg,.jpeg,.png,.doc,.docx,.pdf"
                                onchange="document.getElementById('tkt-fname').textContent = this.files[0].name">
                            <div class="tkt-upload-icon">
                                <svg width="28" height="28" fill="none" stroke="currentColor"
                                    stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"
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

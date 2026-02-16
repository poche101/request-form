<x-guest-layout>
    <div class="min-h-screen bg-slate-50 px-4 py-12 font-sans antialiased text-slate-900">
        <div class="max-w-2xl mx-auto">

            {{-- Global Success Message --}}
            @if (session('success'))
                <div
                    class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-600 text-sm font-bold text-center">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Header --}}
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-cyan-500 shadow-lg shadow-cyan-200 mb-4 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">IT Support Ticket</h1>
                <p class="text-slate-500 mt-1">Fill out the details for rapid assistance.</p>
            </div>

            {{-- Template Download Callout --}}
            <div
                class="mb-8 p-5 bg-white border border-slate-100 rounded-2xl shadow-sm flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-700">PRD Template</h4>
                        <p class="text-xs text-slate-400 font-medium">Download the Word doc for project specs</p>
                    </div>
                </div>
                <a href="{{ route('template.download') }}"
                    class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold rounded-lg transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M7 10l5 5m0 0l5-5m-5 5V3" />
                    </svg>
                    DOWNLOAD
                </a>
            </div>

            {{-- Form Card --}}
            <div
                class="bg-white rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-slate-100 overflow-hidden">

                <form action="{{ route('requests.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-8 sm:p-10">
                    @csrf

                    <div class="space-y-6">
                        {{-- Identity Section --}}
                        <div class="grid grid-cols-1 gap-5">
                            <div>
                                <label
                                    class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2 ml-1">Full
                                    Name</label>
                                <input type="text" name="full_name" value="{{ old('full_name') }}" required
                                    class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-900 focus:ring-2 focus:ring-cyan-500 transition-all placeholder:text-slate-300 @error('full_name') ring-2 ring-red-500 @enderror">
                                @error('full_name')
                                    <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2 ml-1">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-900 focus:ring-2 focus:ring-cyan-500 transition-all @error('email') ring-2 ring-red-500 @enderror">
                                @error('email')
                                    <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2 ml-1">Department</label>
                                <div class="relative">
                                    <select name="department" required
                                        class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-900 focus:ring-2 focus:ring-cyan-500 appearance-none @error('department') ring-2 ring-red-500 @enderror">
                                        <option value="" disabled {{ old('department') ? '' : 'selected' }}>Select
                                            your department</option>
                                        @foreach ($departments as $id => $name)
                                            <option value="{{ $id }}"
                                                {{ old('department') == $id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                                @error('department')
                                    <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <hr class="border-slate-100">

                        {{-- Issue Section --}}
                        <div class="space-y-5">
                            <div>
                                <label
                                    class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2 ml-1">Subject</label>
                                <input type="text" name="title" value="{{ old('title') }}" required
                                    class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-900 focus:ring-2 focus:ring-cyan-500 transition-all @error('title') ring-2 ring-red-500 @enderror">
                                @error('title')
                                    <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2 ml-1">Description</label>
                                <textarea name="description" rows="4" required
                                    class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-900 focus:ring-2 focus:ring-cyan-500 transition-all resize-none @error('description') ring-2 ring-red-500 @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Upload Section --}}

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2 ml-1">
                                Submit Filled PRD 
                                <span class="text-gray-500 font-normal">(Accepted: JPEG, PNG, or PDF)</span>
                            </label>
                            <div class="relative group cursor-pointer">
                                <input type="file" name="attachment" id="attachment"
                                    accept=".jpg,.jpeg,.png,.doc,.docx,.pdf"
                                    onchange="document.getElementById('file-name').textContent = this.files[0].name"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div
                                    class="bg-cyan-50 border-2 border-dashed border-cyan-200 rounded-xl p-6 text-center group-hover:bg-cyan-100 transition-colors @error('attachment') border-red-300 bg-red-50 @enderror">
                                    <div class="text-cyan-600 mb-1 @error('attachment') text-red-400 @enderror">
                                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                    </div>
                                    <p id="file-name"
                                        class="text-sm font-semibold text-cyan-700 italic @error('attachment') text-red-600 @enderror">
                                        Drop your filled PRD here
                                    </p>
                                    <p class="text-[10px] text-cyan-500 mt-1 uppercase tracking-tighter">
                                        Accepted: DOCX, PDF, JPG, PNG (Max 5MB)
                                    </p>
                                </div>
                            </div>
                            @error('attachment')
                                <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="mt-10">
                        <button type="submit"
                            class="w-full py-4 bg-slate-900 hover:bg-cyan-600 text-white font-bold rounded-xl shadow-lg transition-all active:scale-[0.98]">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>

            <p class="mt-8 text-center text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">
                IT Support Portal • Bright Mode
            </p>
        </div>
    </div>
</x-guest-layout>

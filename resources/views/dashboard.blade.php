<x-app-layout>
    <div
        x-data="{
            open: false,
            zoomOpen: false,
            req: {},
            search: '',
            matchesSearch(title, name, dept) {
                if (!this.search) return true;
                const term = this.search.toLowerCase();
                return title.toLowerCase().includes(term)
                    || name.toLowerCase().includes(term)
                    || dept.toLowerCase().includes(term);
            }
        }"
        class="py-12 bg-slate-50 min-h-screen font-sans"
    >

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="mb-8 rounded-2xl bg-emerald-50 border border-emerald-100 px-6 py-4 text-emerald-700 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Header & Search --}}
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8 mb-12">
                <div>
                    <h2 class="text-5xl font-black text-slate-900 tracking-tight">
                        Command <span class="text-indigo-600">Center</span>
                    </h2>
                    <p class="text-slate-500 font-medium mt-2 text-lg">
                        Real-time infrastructure request monitoring.
                    </p>
                </div>

                <div class="relative group w-full lg:w-96">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input
                        x-model="search"
                        type="text"
                        placeholder="Search by name, title, or dept..."
                        class="block w-full pl-12 pr-6 py-4 bg-white border-none rounded-2xl shadow-sm
                                focus:ring-4 focus:ring-indigo-500/10 transition-all font-medium text-slate-600"
                    >
                </div>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-5">
                    <div class="h-12 w-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Tickets</p>
                        <p class="text-3xl font-black text-slate-900">{{ $requests->count() }}</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-5">
                    <div class="h-12 w-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">In Progress</p>
                        <p class="text-3xl font-black text-amber-500">
                            {{ $requests->where('status','in-progress')->count() }}
                        </p>
                    </div>
                </div>

                <div class="bg-indigo-600 p-6 rounded-[2rem] shadow-xl shadow-indigo-100 flex items-center gap-5 text-white">
                    <div class="h-12 w-12 bg-indigo-500 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-indigo-200">Resolved</p>
                        <p class="text-3xl font-black">
                            {{ $requests->where('status','resolved')->count() }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Request Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($requests as $item)
                <div
                    x-show="matchesSearch('{{ $item->title }}','{{ $item->full_name }}','{{ $item->department }}')"
                    x-transition
                    class="group bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8
                            hover:shadow-2xl transition-all duration-500 relative flex flex-col"
                >

                    {{-- Priority Bar --}}
                    <div class="absolute top-8 left-0 w-1.5 h-12 rounded-r-full
                        {{ $item->priority === 'High' ? 'bg-rose-500' :
                            ($item->priority === 'Medium' ? 'bg-amber-400' : 'bg-emerald-400') }}">
                    </div>

                    {{-- Header --}}
                    <div class="flex justify-between items-start mb-6">
                        <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 px-3 py-1
                                     bg-slate-50 rounded-lg border border-slate-100">
                            {{ $item->department }}
                        </span>

                        {{-- Status Toggle --}}
                        <form method="POST" action="{{ route('requests.status',$item->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status"
                                   value="{{ $item->status === 'resolved' ? 'pending' : 'resolved' }}">
                            <button type="submit"
                                 class="relative inline-flex h-6 w-11 rounded-full transition-colors
                                 {{ $item->status === 'resolved' ? 'bg-emerald-500' : 'bg-slate-200' }}">
                                <span class="inline-block h-5 w-5 bg-white rounded-full shadow transform transition
                                {{ $item->status === 'resolved' ? 'translate-x-5' : 'translate-x-0' }}"></span>
                            </button>
                        </form>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-xl font-black text-slate-900 mb-3 group-hover:text-indigo-600 cursor-pointer"
                        @click='req=@json($item);open=true'>
                        {{ $item->title }}
                    </h3>

                    {{-- Attachment Container --}}
                    <div class="mb-6 h-40 rounded-3xl overflow-hidden bg-slate-50 group relative border border-slate-100">

                    @if($item->attachment)
                        @php $isImage = in_array(pathinfo($item->attachment, PATHINFO_EXTENSION), ['jpg','jpeg','png','gif']); @endphp

                        @if($isImage)
                            {{-- Show Image Preview --}}
                            <img src="{{ Storage::url($item->attachment) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            {{-- Show Document Icon --}}
                            <div class="h-full flex flex-col items-center justify-center bg-indigo-50 text-indigo-500">
                                <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-[10px] font-bold uppercase tracking-widest">Document Attachment</span>
                            </div>
                        @endif

                        {{-- Persistent Download Button --}}
                        <div class="absolute bottom-3 right-3">
                            <a href="{{ Storage::url($item->attachment) }}" download
                               class="bg-white shadow-lg p-3 rounded-2xl text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                <span class="text-[10px] font-black">DOWNLOAD</span>
                            </a>
                        </div>
                    @else
                        <div class="h-full flex items-center justify-center text-slate-200">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                </div>

                    <p class="text-slate-500 text-sm line-clamp-2 mb-2">
                        {{ $item->description }}
                    </p>

                    <button
                        x-on:click="req = {{ Js::from($item) }}; open = true"
                        class="text-indigo-600 text-xs font-black uppercase text-left">
                        Read Full Request →
                    </button>


                    {{-- Footer --}}
                    <div class="flex items-center gap-3 pt-6 border-t mt-8">
                        <div class="h-10 w-10 rounded-xl bg-orange-500 flex items-center justify-center text-white text-xs font-black">
                            {{ strtoupper(substr($item->full_name,0,1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-black">{{ $item->full_name }}</p>
                            <p class="text-[10px] font-bold text-slate-400">
                                {{ $item->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-span-full py-20 text-center text-slate-400">
                        No infrastructure requests found.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- MODAL --}}
        <template x-if="open">
            <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
                <div class="absolute inset-0 bg-black/90" @click="open=false"></div>

                <div class="relative bg-white rounded-[3rem] max-w-2xl w-full p-10 max-h-[90vh] overflow-y-auto">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="text-3xl font-black" x-text="req.title"></h3>
                        <button @click="open=false" class="text-slate-400 hover:text-slate-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <div class="flex items-center gap-2 mb-8">
                        <span class="px-3 py-1 bg-slate-100 rounded-full text-[10px] font-black uppercase text-slate-500" x-text="req.department"></span>
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase"
                              :class="req.priority === 'High' ? 'bg-rose-100 text-rose-600' : 'bg-emerald-100 text-emerald-600'"
                              x-text="req.priority"></span>
                    </div>

                    <p class="text-slate-600 mb-8 whitespace-pre-wrap text-lg" x-text="req.description"></p>

                    {{-- Modal Attachment Download --}}
                    <template x-if="req.attachment">
                        <div class="mb-8 p-6 bg-slate-50 rounded-3xl border border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-white rounded-2xl shadow-sm text-indigo-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-black text-slate-900">Attachment File</p>
                                    <p class="text-xs text-slate-400 font-bold">Download to view details</p>
                                </div>
                            </div>
                            <a :href="'/storage/' + req.attachment" download
                               class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-black text-xs hover:bg-indigo-700 transition-colors">
                                DOWNLOAD FILE
                            </a>
                        </div>
                    </template>

                    {{-- Status Update FORM --}}
                    <div class="pt-8 border-t border-slate-100">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">Update Ticket Status</label>
                        <form method="POST" :action="`/requests/${req.id}/status`">
                            @csrf
                            @method('PUT')
                            <select name="status" x-model="req.status"
                                    onchange="this.form.submit()"
                                    class="w-full py-4 px-6 bg-slate-900 text-white rounded-2xl font-bold focus:ring-4 focus:ring-indigo-500/20 transition-all">
                                <option value="pending">Pending Review</option>
                                <option value="in-progress">In Progress</option>
                                <option value="resolved">Mark as Resolved</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </template>

    </div>
</x-app-layout>

<x-app-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap');

    .cc-root { font-family: 'DM Sans', sans-serif; background: #f5f3ef; min-height: 100vh; padding: 44px 0; }

    /* Flash */
    .cc-flash { background: #edf7f1; border: 1px solid #b6dfc6; border-radius: 12px; padding: 12px 18px; color: #2a7a4a; font-size: 13px; font-weight: 600; margin-bottom: 28px; }

    /* Header */
    .cc-top { display: flex; align-items: flex-end; justify-content: space-between; gap: 20px; margin-bottom: 36px; flex-wrap: wrap; }
    .cc-top h2 { font-family: 'Instrument Serif', serif; font-size: 38px; font-weight: 400; color: #1c1c1c; line-height: 1.1; }
    .cc-top h2 span { color: #e8650a; }
    .cc-top p { color: #a09890; font-size: 14px; margin-top: 4px; }

    /* Search */
    .cc-search-wrap { position: relative; width: 320px; }
    .cc-search-wrap svg { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #c0b8b0; width: 15px; height: 15px; }
    .cc-search-wrap input { width: 100%; padding: 12px 16px 12px 40px; background: #fff; border: 1px solid #e8e4dc; border-radius: 12px; font-family: 'DM Sans', sans-serif; font-size: 13px; color: #1c1c1c; outline: none; transition: all 0.2s; }
    .cc-search-wrap input:focus { border-color: #e8650a; box-shadow: 0 0 0 3px rgba(232,101,10,0.08); }
    .cc-search-wrap input::placeholder { color: #c0b8b0; }

    /* Stats */
    .cc-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 32px; }
    .cc-stat { background: #fff; border: 1px solid #e8e4dc; border-radius: 20px; padding: 22px 24px; display: flex; align-items: center; gap: 16px; box-shadow: 0 1px 4px rgba(0,0,0,0.04); }
    .cc-stat-icon { width: 46px; height: 46px; border-radius: 13px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .cc-stat-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; color: #b0a898; margin-bottom: 4px; }
    .cc-stat-val { font-size: 28px; font-weight: 600; line-height: 1; color: #1c1c1c; }
    .cc-stat-val.amber { color: #f59e0b; }
    .cc-stat.orange-card { background: #e8650a; border-color: #e8650a; box-shadow: 0 4px 20px rgba(232,101,10,0.22); }
    .cc-stat.orange-card .cc-stat-label { color: rgba(255,255,255,0.65); }
    .cc-stat.orange-card .cc-stat-val { color: #fff; }
    .cc-stat.orange-card .cc-stat-icon { background: rgba(255,255,255,0.18); }

    /* Cards Grid */
    .cc-grid { display: grid; grid-template-columns: repeat(1, 1fr); gap: 20px; }
    @media(min-width:768px) { .cc-grid { grid-template-columns: repeat(2, 1fr); } }
    @media(min-width:1100px) { .cc-grid { grid-template-columns: repeat(3, 1fr); } }

    .cc-card { background: #fff; border: 1px solid #e8e4dc; border-radius: 22px; padding: 24px; display: flex; flex-direction: column; position: relative; transition: box-shadow 0.2s, transform 0.2s; }
    .cc-card:hover { box-shadow: 0 8px 32px rgba(0,0,0,0.09); transform: translateY(-2px); }

    /* Priority bar */
    .cc-pbar { position: absolute; top: 24px; left: 0; width: 4px; height: 44px; border-radius: 0 4px 4px 0; }

    /* Card top */
    .cc-card-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
    .cc-dept { font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.14em; color: #a09890; background: #f5f3ef; border: 1px solid #e8e4dc; border-radius: 7px; padding: 4px 10px; }

    /* Toggle */
    .cc-toggle { position: relative; display: inline-flex; height: 22px; width: 40px; border-radius: 11px; border: none; cursor: pointer; transition: background 0.2s; background: #e0dbd4; }
    .cc-toggle.resolved { background: #22c55e; }
    .cc-toggle span { display: inline-block; width: 18px; height: 18px; background: #fff; border-radius: 50%; box-shadow: 0 1px 4px rgba(0,0,0,0.15); position: absolute; top: 2px; transition: left 0.2s; }
    .cc-toggle.resolved span { left: 20px; }
    .cc-toggle:not(.resolved) span { left: 2px; }

    /* Attachment */
    .cc-att { height: 136px; border-radius: 14px; overflow: hidden; background: #f5f3ef; border: 1px solid #e8e4dc; margin-bottom: 14px; position: relative; display: flex; align-items: center; justify-content: center; }
    .cc-att img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
    .cc-card:hover .cc-att img { transform: scale(1.05); }
    .cc-att-doc { display: flex; flex-direction: column; align-items: center; gap: 6px; color: #c0b8b0; }
    .cc-att-doc span { font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; }
    .cc-att-dl { position: absolute; bottom: 10px; right: 10px; background: #fff; border: 1px solid #e8e4dc; border-radius: 9px; padding: 6px 12px; display: flex; align-items: center; gap: 5px; color: #e8650a; font-size: 10px; font-weight: 700; text-decoration: none; transition: all 0.2s; }
    .cc-att-dl:hover { background: #e8650a; color: #fff; border-color: #e8650a; }
    .cc-no-att { color: #e0dbd4; }

    /* Card body */
    .cc-title { font-family: 'Instrument Serif', serif; font-size: 17px; font-weight: 400; color: #1c1c1c; margin-bottom: 8px; line-height: 1.3; cursor: pointer; }
    .cc-title:hover { color: #e8650a; }
    .cc-desc { font-size: 12px; color: #a09890; line-height: 1.65; margin-bottom: 6px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .cc-read { font-size: 11px; font-weight: 700; color: #e8650a; background: none; border: none; cursor: pointer; padding: 0; text-transform: uppercase; letter-spacing: 0.06em; }

    /* Card footer */
    .cc-footer { display: flex; align-items: center; gap: 10px; padding-top: 16px; border-top: 1px solid #f0ece6; margin-top: auto; }
    .cc-avatar { width: 34px; height: 34px; border-radius: 10px; background: #e8650a; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 12px; font-weight: 700; flex-shrink: 0; }
    .cc-name { font-size: 13px; font-weight: 600; color: #1c1c1c; }
    .cc-time { font-size: 10px; color: #b0a898; }

    /* Empty */
    .cc-empty { text-align: center; padding: 60px 20px; color: #b0a898; font-size: 14px; grid-column: 1/-1; }

    /* Modal */
    .cc-backdrop { position: fixed; inset: 0; background: rgba(0,0,0,0.35); z-index: 50; display: flex; align-items: center; justify-content: center; padding: 20px; backdrop-filter: blur(4px); }
    .cc-modal { background: #fff; border-radius: 26px; max-width: 560px; width: 100%; padding: 34px; max-height: 88vh; overflow-y: auto; position: relative; }
    .cc-modal-close { position: absolute; top: 18px; right: 18px; background: #f5f3ef; border: none; border-radius: 9px; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #a09890; transition: all 0.2s; }
    .cc-modal-close:hover { background: #e8650a; color: #fff; }
    .cc-modal-title { font-family: 'Instrument Serif', serif; font-size: 24px; font-weight: 400; color: #1c1c1c; margin-bottom: 12px; line-height: 1.25; padding-right: 40px; }
    .cc-modal-badges { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 20px; }
    .cc-badge { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; padding: 5px 12px; border-radius: 8px; }
    .cc-badge-dept { background: #f5f3ef; color: #a09890; border: 1px solid #e8e4dc; }
    .cc-badge-high { background: #fef2f2; color: #ef4444; }
    .cc-badge-med  { background: #fffbeb; color: #f59e0b; }
    .cc-badge-low  { background: #f0fdf4; color: #22c55e; }
    .cc-modal-desc { font-size: 14px; color: #6b6560; line-height: 1.8; margin-bottom: 24px; }
    .cc-modal-att { background: #f9f7f4; border: 1px solid #e8e4dc; border-radius: 14px; padding: 16px 18px; display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
    .cc-modal-att-left { display: flex; align-items: center; gap: 12px; }
    .cc-modal-att-icon { width: 38px; height: 38px; background: #fff; border-radius: 10px; border: 1px solid #e8e4dc; display: flex; align-items: center; justify-content: center; color: #e8650a; flex-shrink: 0; }
    .cc-modal-att-title { font-size: 13px; font-weight: 600; color: #1c1c1c; }
    .cc-modal-att-sub { font-size: 11px; color: #b0a898; }
    .cc-modal-dl { background: #e8650a; color: #fff; border: none; border-radius: 10px; padding: 10px 18px; font-size: 11px; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; cursor: pointer; text-decoration: none; display: inline-block; transition: background 0.2s; }
    .cc-modal-dl:hover { background: #cf5608; }
    .cc-status-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; color: #b0a898; margin-bottom: 10px; display: block; padding-top: 20px; border-top: 1px solid #f0ece6; }
    .cc-modal-select { width: 100%; padding: 13px 16px; background: #f9f7f4; border: 1px solid #e8e4dc; border-radius: 12px; font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 600; color: #1c1c1c; outline: none; cursor: pointer; transition: all 0.2s; -webkit-appearance: none; }
    .cc-modal-select:focus { border-color: #e8650a; box-shadow: 0 0 0 3px rgba(232,101,10,0.08); }
</style>

<div
    x-data="{
        open: false,
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
    class="cc-root"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="cc-flash">{{ session('success') }}</div>
        @endif

        {{-- Header --}}
        <div class="cc-top">
            <div>
                <h2>Command <span>Center</span></h2>
                <p>Real-time infrastructure request monitoring.</p>
            </div>
            <div class="cc-search-wrap">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input x-model="search" type="text" placeholder="Search by name, title, or dept...">
            </div>
        </div>

        {{-- Stats --}}
        <div class="cc-stats">
            <div class="cc-stat">
                <div class="cc-stat-icon" style="background:#fff4ee">
                    <svg width="22" height="22" fill="none" stroke="#e8650a" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <div>
                    <p class="cc-stat-label">Total Tickets</p>
                    <p class="cc-stat-val">{{ $requests->count() }}</p>
                </div>
            </div>
            <div class="cc-stat">
                <div class="cc-stat-icon" style="background:#fffbeb">
                    <svg width="22" height="22" fill="none" stroke="#f59e0b" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="cc-stat-label">In Progress</p>
                    <p class="cc-stat-val amber">{{ $requests->where('status','in-progress')->count() }}</p>
                </div>
            </div>
            <div class="cc-stat orange-card">
                <div class="cc-stat-icon">
                    <svg width="22" height="22" fill="none" stroke="#fff" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <p class="cc-stat-label">Resolved</p>
                    <p class="cc-stat-val">{{ $requests->where('status','resolved')->count() }}</p>
                </div>
            </div>
        </div>

        {{-- Grid --}}
        <div class="cc-grid">
            @forelse($requests as $item)
            <div
                x-show="matchesSearch('{{ addslashes($item->title) }}','{{ addslashes($item->full_name) }}','{{ addslashes($item->department) }}')"
                x-transition
                class="cc-card"
            >
                <div class="cc-pbar {{ $item->priority === 'High' ? 'bg-red-500' : ($item->priority === 'Medium' ? 'bg-amber-400' : 'bg-green-400') }}"
                     style="{{ $item->priority === 'High' ? 'background:#ef4444' : ($item->priority === 'Medium' ? 'background:#f59e0b' : 'background:#22c55e') }}">
                </div>

                <div class="cc-card-top">
                    <span class="cc-dept">{{ $item->department }}</span>
                    <form method="POST" action="{{ route('requests.status', $item->id) }}">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="{{ $item->status === 'resolved' ? 'pending' : 'resolved' }}">
                        <button type="submit" class="cc-toggle {{ $item->status === 'resolved' ? 'resolved' : '' }}">
                            <span></span>
                        </button>
                    </form>
                </div>

                {{-- Attachment --}}
                <div class="cc-att">
                    @if($item->attachment)
                        @php $isImage = in_array(pathinfo($item->attachment, PATHINFO_EXTENSION), ['jpg','jpeg','png','gif']); @endphp
                        @if($isImage)
                            <img src="{{ Storage::url($item->attachment) }}" alt="">
                        @else
                            <div class="cc-att-doc">
                                <svg width="30" height="30" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span>Document Attachment</span>
                            </div>
                        @endif
                        <a href="{{ route('tickets.download', $item->id) }}" class="cc-att-dl">
                            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Download
                        </a>
                    @else
                        <svg class="cc-no-att" width="36" height="36" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                            <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    @endif
                </div>

                <p class="cc-title" @click="req = {{ Js::from($item) }}; open = true">{{ $item->title }}</p>
                <p class="cc-desc">{{ $item->description }}</p>
                <button class="cc-read" @click="req = {{ Js::from($item) }}; open = true">Read Full Request →</button>

                <div class="cc-footer">
                    <div class="cc-avatar">{{ strtoupper(substr($item->full_name, 0, 1)) }}</div>
                    <div>
                        <p class="cc-name">{{ $item->full_name }}</p>
                        <p class="cc-time">{{ $item->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
            @empty
                <div class="cc-empty">No infrastructure requests found.</div>
            @endforelse
        </div>
    </div>

    {{-- Modal --}}
    <template x-if="open">
        <div class="cc-backdrop" @click.self="open = false">
            <div class="cc-modal">
                <button class="cc-modal-close" @click="open = false">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <p class="cc-modal-title" x-text="req.title"></p>

                <div class="cc-modal-badges">
                    <span class="cc-badge cc-badge-dept" x-text="req.department"></span>
                    <span class="cc-badge"
                          :class="req.priority === 'High' ? 'cc-badge-high' : (req.priority === 'Medium' ? 'cc-badge-med' : 'cc-badge-low')"
                          x-text="req.priority"></span>
                </div>

                <p class="cc-modal-desc" x-text="req.description"></p>

                <template x-if="req.attachment">
                    <div class="cc-modal-att">
                        <div class="cc-modal-att-left">
                            <div class="cc-modal-att-icon">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                </svg>
                            </div>
                            <div>
                                <p class="cc-modal-att-title">Attachment File</p>
                                <p class="cc-modal-att-sub">Download to view details</p>
                            </div>
                        </div>
                        <a :href="'/tickets/' + req.id + '/download'" class="cc-modal-dl">Download File</a>
                    </div>
                </template>

                <span class="cc-status-label">Update Ticket Status</span>
                <form method="POST" :action="'/requests/' + req.id + '/status'">
                    @csrf @method('PUT')
                    <select name="status" x-model="req.status" onchange="this.form.submit()" class="cc-modal-select">
                        <option value="pending">Pending Review</option>
                        <option value="in-progress">In Progress</option>
                        <option value="resolved">Mark as Resolved</option>
                    </select>
                </form>
            </div>
        </div>
    </template>
</div>
</x-app-layout>

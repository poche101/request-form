<x-guest-layout title="Admin Login | IT Connect">
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100">
            <div class="bg-indigo-600 p-8 text-white text-center">
                <h2 class="text-2xl font-bold">IT Dashboard</h2>
                <p class="text-indigo-100 mt-1">Authorized Personnel Only</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="p-8 space-y-6">
                @csrf

                @if ($errors->any())
                    <div class="p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm font-medium">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-semibold text-slate-700 ml-1">Email Address</label>
                    <input type="email" name="email" required autofocus
                        class="mt-1 block w-full px-4 py-3 rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 transition-colors">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 ml-1">Password</label>
                    <input type="password" name="password" required
                        class="mt-1 block w-full px-4 py-3 rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 transition-colors">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <label for="remember" class="ml-2 text-sm text-slate-600">Remember me</label>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-xl font-bold hover:bg-indigo-700 transition-all shadow-lg hover:shadow-indigo-200">
                    Sign In to Dashboard
                </button>
            </form>
        </div>

        <div class="mt-6 text-center">
            <a href="/" class="text-sm text-slate-400 hover:text-indigo-600 transition">← Back to Public Request Form</a>
        </div>
    </div>
</x-guest-layout>

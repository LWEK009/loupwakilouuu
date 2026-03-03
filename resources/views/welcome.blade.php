<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoupWakil | لو واكيل</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;400;600;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Cairo', sans-serif;
            background: #050505;
            color: #d1d5db;
            min-height: 100vh;
            overflow-x: hidden;
            background-image: 
                radial-gradient(circle at 50% 120%, #1e1b4b 0%, transparent 60%);
        }
        .cairo-title {
            font-family: 'Cairo', sans-serif;
            color: #f87171;
            text-shadow: 0 0 25px rgba(239, 68, 68, 0.5);
            font-weight: 800;
        }
        .wolf-gradient {
            background: linear-gradient(135deg, #111827 0%, #030712 100%);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.7);
        }
        .card-revealed {
            background: linear-gradient(135deg, #1e1b4b 0%, #050505 100%);
            border: 1px solid rgba(99, 102, 241, 0.3);
        }
        .glow-red { filter: drop-shadow(0 0 12px #f87171); }
        input, select { text-align: right; }
    </style>
</head>
<body x-data="{ 
    tab: 'setup', 
    newPlayer: '', 
    customRoles: ['ذئب', 'ذئب', 'عرافة', 'ساحرة', 'حارس', 'قناص', 'قروي', 'قروي'],
    players: @js($players),
    allRoles: [
        {en: 'Wolf', ar: 'ذئب'},
        {en: 'Villager', ar: 'قروي'},
        {en: 'Seer', ar: 'عرافة'},
        {en: 'Witch', ar: 'ساحرة'},
        {en: 'Healer', ar: 'حارس'},
        {en: 'Hunter', ar: 'قناص'},
        {en: 'Cupid', ar: 'كيوبيد'},
        {en: 'Thief', ar: 'لص'},
        {en: 'Wild Child', ar: 'الطفل البري'},
        {en: 'White Wolf', ar: 'الذئب الأبيض'}
    ]
}">

    <div class="fixed top-0 left-0 w-full h-full opacity-10 pointer-events-none z-[-1]" style="background-image: url('https://www.transparenttextures.com/patterns/dark-matter.png')"></div>

    <div class="max-w-4xl mx-auto px-6 py-12">
        <header class="text-center mb-16">
            <h1 class="text-7xl cairo-title mb-4">LoupWakil</h1>
            <p class="text-slate-500 uppercase tracking-[0.4em] text-xs font-bold">الظلال تختار ضحيتها التالية...</p>
        </header>

        <!-- Navigation -->
        <div class="flex justify-center gap-8 mb-12 border-b border-white/5 pb-4">
            <button @click="tab = 'setup'" :class="tab === 'setup' ? 'text-red-400 border-b-2 border-red-500' : 'text-slate-500'" class="px-6 py-2 font-bold text-sm transition-all hover:text-red-300">قائمة اللاعبين</button>
            <button @click="tab = 'roles'" :class="tab === 'roles' ? 'text-red-400 border-b-2 border-red-500' : 'text-slate-500'" class="px-6 py-2 font-bold text-sm transition-all hover:text-red-300">توزيع الأدوار</button>
            <button @click="tab = 'nexus'" :class="tab === 'nexus' ? 'text-red-400 border-b-2 border-red-500' : 'text-slate-500'" class="px-6 py-2 font-bold text-sm transition-all hover:text-red-300">المختارون</button>
        </div>

        <!-- TAB: SETUP -->
        <div x-show="tab === 'setup'" x-transition x-cloak class="space-y-8">
            <section class="wolf-gradient rounded-[2.5rem] p-8 md:p-12 shadow-2xl">
                <h3 class="text-2xl font-bold mb-8 text-slate-100 flex items-center gap-3">
                    <span class="w-2 h-8 bg-red-600 rounded-full"></span>
                    استدعاء اللاعبين
                </h3>
                <form action="/players/add" method="POST" class="flex flex-col sm:flex-row gap-4">
                    @csrf
                    <input type="text" name="name" x-model="newPlayer" placeholder="أدخل اسم اللاعب..." class="flex-1 bg-white/5 border border-white/10 rounded-2xl px-8 py-4 text-white focus:border-red-500 outline-none transition-all text-xl" required>
                    <button type="submit" class="bg-red-600 hover:bg-red-500 text-white font-bold px-10 py-4 rounded-2xl transition shadow-xl shadow-red-600/20 active:scale-95 text-lg">إضافة</button>
                </form>
                
                <div class="mt-12 grid grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($players as $player)
                        <div class="bg-white/5 border border-white/5 rounded-2xl p-5 text-center group transition hover:bg-white/10 relative">
                            <span class="text-lg font-bold text-slate-300">{{ $player->name }}</span>
                            <form action="/players/remove/{{ $player->id }}" method="POST" class="absolute -top-2 -left-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                @csrf
                                <button type="submit" class="bg-red-600/80 hover:bg-red-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold shadow-lg">×</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>

            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <form action="/game/reset" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-slate-500 hover:text-red-400 transition underline tracking-wider font-semibold">تضحية بجميع اللاعبين (حذف الكل)</button>
                </form>
                @if($players->count() > 0)
                <button @click="tab = 'roles'" class="w-full sm:w-auto bg-white text-slate-950 font-extrabold px-12 py-4 rounded-2xl hover:scale-105 active:scale-95 transition text-lg shadow-lg">التالي: تحديد الأدوار ←</button>
                @endif
            </div>
        </div>

        <!-- TAB: ROLES -->
        <div x-show="tab === 'roles'" x-transition x-cloak class="space-y-8">
             <section class="wolf-gradient rounded-[2.5rem] p-8 md:p-12">
                <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
                    <h3 class="text-2xl font-bold text-slate-100 flex items-center gap-3">
                         <span class="w-2 h-8 bg-indigo-600 rounded-full"></span>
                         مجموعة الأدوار المختارة
                    </h3>
                    <div class="flex items-center gap-4 bg-white/5 px-6 py-2 rounded-full border border-white/5">
                        <span class="text-sm text-slate-400 font-bold" :class="customRoles.length < {{ $players->count() }} ? 'text-red-400' : 'text-green-400'" x-text="`${customRoles.length} دور لـ {{ $players->count() }} لاعب`"></span>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-4">
                    <template x-for="(role, index) in customRoles" :key="index">
                        <div class="bg-red-900/40 border border-red-500/30 text-red-200 px-5 py-3 rounded-2xl text-sm font-bold flex items-center gap-4 shadow-sm hover:border-red-500 transition cursor-default">
                            <span x-text="role"></span>
                            <span @click="customRoles.splice(index, 1)" class="cursor-pointer text-red-500 hover:text-white transition text-lg font-light leading-none">×</span>
                        </div>
                    </template>
                    <div x-show="customRoles.length === 0" class="w-full text-center py-8 opacity-40 italic">لم يتم اختيار أي دور بعد...</div>
                </div>

                <div class="mt-12 pt-10 border-t border-white/5 space-y-4">
                    <p class="text-xs text-slate-500 font-bold uppercase tracking-widest mb-4">انقر لإضافة دور جديد:</p>
                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                        <template x-for="r in allRoles">
                            <button @click="customRoles.push(r.ar)" class="bg-white/5 hover:bg-white/10 hover:border-white/20 border border-white/5 p-4 rounded-2xl text-sm font-bold transition-all active:scale-95" x-text="r.ar"></button>
                        </template>
                    </div>
                </div>
            </section>

            <div class="text-center">
                 <form action="/game/shuffle" method="POST">
                    @csrf
                    <template x-for="role in customRoles">
                         <input type="hidden" name="roles[]" :value="role">
                    </template>
                    <button type="submit" class="bg-red-600 hover:bg-red-500 text-white text-4xl cairo-title px-16 py-8 rounded-[2rem] transition shadow-2xl shadow-red-600/30 hover:scale-[1.02] active:scale-95 disabled:opacity-50 disabled:scale-100" :disabled="players.length === 0 || customRoles.length !== players.length">
                        بدء طقس التوزيع العشوائي
                    </button>
                    <p x-show="customRoles.length !== players.length" class="mt-4 text-red-400 text-sm font-bold">يجب أن يتطابق عدد الأدوار مع عدد اللاعبين!</p>
                 </form>
            </div>
        </div>

        <!-- TAB: THE CHOSEN -->
        <div x-show="tab === 'nexus'" x-transition x-cloak class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($players as $player)
                <div x-data="{ revealed: false, role: @js($player->role) }" 
                     @click="revealed = !revealed"
                     :class="revealed ? 'card-revealed border-indigo-500/50' : 'wolf-gradient'"
                     class="rounded-[2rem] p-8 cursor-pointer transition-all duration-700 hover:scale-[1.03] relative overflow-hidden group border border-transparent">
                    
                    <div class="flex justify-between items-center h-full relative z-10">
                        <div class="text-right">
                            <p class="text-3xl font-extrabold text-white mb-2 leading-tight">{{ $player->name }}</p>
                            <span class="text-[11px] uppercase tracking-[0.2em] text-slate-500 font-bold" x-text="revealed ? 'تم كشف الحقيقة' : 'المس لكشف هويتك السرية'"></span>
                        </div>
                        
                        <div class="flex items-center justify-center">
                            <template x-if="revealed">
                                <span x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-50" class="text-4xl font-black text-red-400 glow-red" x-text="role || 'بدون قدر'"></span>
                            </template>
                            <template x-if="!revealed">
                                <div class="w-16 h-16 flex items-center justify-center opacity-30 group-hover:opacity-60 transition">
                                     <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Decorative glow back -->
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-red-600/5 rounded-full blur-3xl pointer-events-none"></div>
                </div>
            @empty
                <div class="md:col-span-2 text-center py-32 opacity-25">
                    <p class="text-3xl font-light italic tracking-widest cairo-title text-slate-400">لا توجد أقدار مكتوبة بعد...</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Tab Logic Sync -->
    @if($players->count() > 0 && collect($players)->whereNotNull('role')->count() > 0)
        <script> document.addEventListener('DOMContentLoaded', () => { setTimeout(() => { window.dispatchEvent(new CustomEvent('set-tab', {detail: 'nexus'})); }, 50); }); </script>
    @endif

    <script>
        window.addEventListener('set-tab', e => {
            const el = document.querySelector('[x-data]');
            if(el.__x) el.__x.$data.tab = e.detail;
        });
    </script>
</body>
</html>

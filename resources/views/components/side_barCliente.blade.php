<!-- resources/views/components/sidebar.blade.php -->

<aside class="sidebar fixed -left-full top-0 w-72 h-screen bg-gradient-to-b bg-color-bg text-white flex flex-col shadow-lg z-50 transition-transform duration-300
 max-md:w-screen" id="sidebar">
    <button class="absolute top-4 left-full mx-2 z-50 p-2 bg-black/50 hover:bg-color-main/80 rounded-lg focus:outline-none
     max-md:left-3/4" id="sidebarClose" aria-label="Close sidebar">
        <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M20.7457 3.32851C20.3552 2.93798 19.722 2.93798 19.3315 3.32851L12.0371 10.6229L4.74275 3.32851C4.35223 2.93798 3.71906 2.93798 3.32854 3.32851C2.93801 3.71903 2.93801 4.3522 3.32854 4.74272L10.6229 12.0371L3.32856 19.3314C2.93803 19.722 2.93803 20.3551 3.32856 20.7457C3.71908 21.1362 4.35225 21.1362 4.74277 20.7457L12.0371 13.4513L19.3315 20.7457C19.722 21.1362 20.3552 21.1362 20.7457 20.7457C21.1362 20.3551 21.1362 19.722 20.7457 19.3315L13.4513 12.0371L20.7457 4.74272C21.1362 4.3522 21.1362 3.71903 20.7457 3.32851Z" fill="#fff"/>
        </svg>
    </button>    
    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-6 border-b border-white/10">
        <h1 class="text-2xl font-bold tracking-tight text-color-main">COMARICO</h1>
        <button class="sm:hidden flex flex-col gap-1.5 p-2 hover:bg-white/10 rounded-lg transition-colors" id="sidebarToggle">
            <span class="w-6 h-0.5 bg-white rounded transition-all"></span>
            <span class="w-6 h-0.5 bg-white rounded transition-all"></span>
            <span class="w-6 h-0.5 bg-white rounded transition-all"></span>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-5 px-3">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('menu') }}" class="nav-link @if(request()->routeIs('menu')) active @endif flex items-center gap-3 px-4 py-3 rounded-lg text-white/80 hover:bg-white/15 hover:text-white transition-all duration-200 font-medium">
                    <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span>Menú</span>
                </a>
            </li>

            <li>
                <a href="{{ route('creadores') }}" class="nav-link @if(request()->routeIs('creadores')) active @endif flex items-center gap-3 px-4 py-3 rounded-lg text-white/80 hover:bg-white/15 hover:text-white transition-all duration-200 font-medium">
                    <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span>Creadores</span>
                </a>
            </li>

            <li>
                <a href="" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg text-white/80 hover:bg-white/15 hover:text-white transition-all duration-200 font-medium">
                    <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span>Contáctanos</span>
                </a>
            </li>
        </ul>
    </nav>
    </div>
</aside>

<style>
    .nav-link.active {
        @apply bg-white/25 text-white border-l-4 border-white pl-3;
    }

    .sidebar::-webkit-scrollbar {
        @apply w-1.5;
    }

    .sidebar::-webkit-scrollbar-track {
        @apply bg-white/5;
    }

    .sidebar::-webkit-scrollbar-thumb {
        @apply bg-white/20 rounded hover:bg-white/30;
    }

    @media (max-width: 768px) {
        .sidebar {
            @apply -translate-x-full;
        }

        .sidebar.active {
            @apply translate-x-0;
        }
    }
</style>

<script>
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('active');
    });

    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                document.getElementById('sidebar').classList.remove('active');
            }
        });
    });
    
    document.getElementById('sidebarClose').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('-left-full');
        document.getElementById('sidebar').classList.remove('left-0');
    });
</script>
<div 
    x-data="{ open: true }" 
    class="flex flex-col bg-white shadow-lg border-r border-gray-200 transition-all duration-300"
    :class="{ 'w-64': open, 'w-20': !open }"
>
    <!-- Logo et bouton toggle -->
    <div class="flex items-center justify-between h-16 px-4 border-b border-gray-100">
            <span x-show="open" class="text-xl font-semibold text-gray-750">Ministre de la justice</span>
        
        
        <button 
            @click="open = !open" 
            class="text-gray-500 hover:text-gray-700 focus:outline-none"
        >
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>

    <!-- Menu -->

    <div class="flex items-center justify-center py-4 border-b border-gray-100">
    <a href="{{ route('dashboard') }}">
        <img src="{{ asset('images/3.jfif') }}" alt="Logo Tribunal" class="h-12 w-auto rounded-full">
    </a>
</div>

    <nav class="flex-1 px-2 py-4 space-y-2">
        <a href="{{ route('dashboard') }}" 
           class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-indigo-100 hover:text-indigo-700 transition-colors"
           :class="{ 'justify-center': !open }">
            <i class="fa-solid fa-gauge text-lg"></i>
            <span x-show="open">Tableau de bord</span>
        </a>

        <a href="{{ route('dossiers.index') }}" 
           class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-indigo-100 hover:text-indigo-700 transition-colors"
           :class="{ 'justify-center': !open }">
            <i class="fa-solid fa-folder-open text-lg"></i>
            <span x-show="open">    gestion des dossiers</span>
        </a>


        <a href="{{ route('audiences.index') }}" 
           class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-indigo-100 hover:text-indigo-700 transition-colors"
           :class="{ 'justify-center': !open }">
            <i class="fa-solid fa-scale-unbalanced text-lg"></i>
            <span x-show="open">    gestion des audiences</span>
        </a>

        <a href="{{ route('courriers.index') }}" 
           class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-indigo-100 hover:text-indigo-700 transition-colors"
           :class="{ 'justify-center': !open }">
            <i class="fa-solid fa-landmark text-lg"></i>
            <span x-show="open" >    gestion des courriers</span>
        </a>

        
      <a href="{{ route('users.index') }}" 
           class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-indigo-100 hover:text-indigo-700 transition-colors"
           :class="{ 'justify-center': !open }">
            <i class="fa-solid fa-gavel text-lg"></i>
            <span x-show="open">    gestion des utilisateurs</span>
        </a>
    </nav>
</div>

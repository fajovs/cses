<?php
   
    $addButton = "";
    
    if($role === "admin" || ($heading === "Activities" && $role === "student")){
        $addButton =
        <<<HTML
             <button class="inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition-colors focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 outline-none">
                 <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                 </svg>
                 Add {$heading}
             </button>
        HTML ;
    }

   $banner = 
        <<<HTML
                <div class="flex flex-col sm:flex-row gap-3">
             <!-- Search Input -->
             <div class="relative">
                 <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                     <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                     </svg>
                 </div>
                 <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition-colors w-full sm:w-64">
             </div>
         HTML ;
?>
 
 <header class="bg-white shadow-sm">
     <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

         <div>
             <h1 class="text-3xl font-bold text-gray-900 mb-2"><?= $heading === "Dashboard" ? $heading : $heading . " Management" ?> </h1>

         </div>
         <?= $heading != "Dashboard" ? $banner : "" ?>
         <?= $heading != "Dashboard" ? $addButton : "" ?>
          

     </div>
 </header>
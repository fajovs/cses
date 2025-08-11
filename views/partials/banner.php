<?php
   
    $addButton = "";
    $id = strtoLower($heading);
    
    if($role === "admin" || ($heading === "Activities" && $role === "student")){
        $addButton =
        <<<HTML
             <button id="openDrawer" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 outline-none">
                 <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                 </svg>
                 Add {$heading}
             </button>
        HTML ;
    }

  
?>
 
 <header class="bg-white shadow-sm">
     <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

         <div>
             <h1 class="text-3xl font-bold text-gray-900 mb-2"><?= 'Hi! '. $_SESSION['first_name']?> </h1>

         </div>
 
         <?= $heading != "Dashboard" ? $addButton : "" ?>
          
     </div>
 </header>
<?php $heading = '404 Page Not Found';$baseUrl = "/CSES";require ("views/partials/head.php");?>

<!-- Enhanced 404 page with gradient background and glassmorphic design -->
<main class="min-h-screen bg-gradient-to-br from-slate-50 via-green-50 to-slate-100 relative overflow-hidden">
  <!-- Background blur elements -->
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute -top-40 -right-40 w-80 h-80 bg-green-400/20 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-slate-400/20 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-green-300/10 rounded-full blur-3xl"></div>
  </div>

  <div class="relative grid min-h-full place-items-center px-6 py-24 sm:py-32 lg:px-8">
    <div class="text-center max-w-lg">
      <!-- Error code with glassmorphic background -->
      <div class="inline-flex items-center justify-center w-24 h-24 rounded-2xl bg-white/70 backdrop-blur-sm border border-white/20 shadow-xl mb-8">
        <p class="text-2xl font-bold bg-gradient-to-r from-green-600 to-slate-700 bg-clip-text text-transparent">404</p>
      </div>
      
      <!-- Main heading with gradient text -->
      <h1 class="text-5xl font-bold tracking-tight text-balance sm:text-7xl mb-6">
        <span class="bg-gradient-to-r from-slate-900 via-slate-700 to-slate-900 bg-clip-text text-transparent">
          Page not found
        </span>
      </h1>
      
      <!-- Description -->
      <p class="text-lg font-medium text-slate-600 sm:text-xl/8 mb-10">
        Sorry, we couldn't find the page you're looking for.
      </p>
      
      <!-- Action button -->
      <div class="flex items-center justify-center">
        <a href="<?= base_url('/') ?>" 
           class="group relative inline-flex items-center justify-center px-8 py-3 text-sm font-semibold text-white bg-gradient-to-r from-green-600 to-green-700 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
          <svg class="w-4 h-4 mr-2 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
          </svg>
          Go back home
        </a>
      </div>
    </div>
  </div>
</main>

<?php require ("views/partials/foot.php"); ?>

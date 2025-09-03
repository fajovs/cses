<?php $heading = '403 Forbidden';require ("views/partials/head.php");?>

<!-- Added gradient background with floating blur elements for visual interest -->
<main class="relative min-h-screen bg-gradient-to-br from-slate-50 via-indigo-50/30 to-slate-100 px-6 py-24 sm:py-32 lg:px-8 overflow-hidden">
  <!-- Background decorative elements -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute -top-40 -right-32 w-80 h-80 bg-indigo-400/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -left-32 w-80 h-80 bg-slate-400/10 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-indigo-300/5 rounded-full blur-3xl"></div>
  </div>

  <!-- Enhanced error content with glassmorphic card design -->
  <div class="relative grid min-h-full place-items-center">
    <div class="text-center max-w-2xl mx-auto">
      <!-- Enhanced error code with better styling -->
      <div class="inline-flex items-center justify-center w-20 h-20 bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg shadow-slate-200/50 border border-white/20 mb-8">
        <p class="text-2xl font-bold text-slate-800">403</p>
      </div>
      
      <!-- Improved typography hierarchy with slate colors -->
      <h1 class="text-6xl font-bold tracking-tight text-slate-900 sm:text-8xl mb-6">
        <span class="bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent">
          Forbidden
        </span>
      </h1>
      
      <!-- Enhanced description with better spacing and color -->
      <p class="text-xl text-slate-600 mb-4 leading-relaxed">
        Access to this resource is denied.
      </p>
      <p class="text-base text-slate-500 mb-12 max-w-md mx-auto leading-relaxed">
        You don't have permission to access this page. Please contact your administrator if you believe this is an error.
      </p>
      
      <!-- Enhanced button with glassmorphic design and hover effects -->
      <div class="flex items-center justify-center gap-x-6">
        <a href="<?= base_url('/') ?>" 
           class="group relative inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-xl shadow-lg shadow-indigo-600/25 hover:shadow-xl hover:shadow-indigo-600/30 hover:from-indigo-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-50 transition-all duration-200 transform hover:-translate-y-0.5">
          <svg class="w-5 h-5 mr-2 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
          </svg>
          Go back home
        </a>
      </div>
      
      <!-- Added subtle help text -->
      <div class="mt-16 pt-8 border-t border-slate-200/60">
        <p class="text-sm text-slate-400">
          Error Code: 403 • Access Denied
        </p>
      </div>
    </div>
  </div>
</main>

<?php require ("views/partials/foot.php"); ?>

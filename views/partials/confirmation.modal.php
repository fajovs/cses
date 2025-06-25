<!-- Modal Backdrop & Container -->
<div id="dialogWrapper" class="hidden fixed inset-0 z-10 w-screen overflow-y-auto bg-gray-500/75 backdrop-blur-sm flex items-center justify-center">
    <div id="dialogPanel" class="opacity-0 scale-95 transition-all duration-300 ease-out relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl sm:w-full sm:max-w-lg">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                    <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-base font-semibold text-gray-900">Delete Item</h3>
                    <p class="mt-2 text-sm text-gray-500">Are you sure you want to delete the Item? The item will be permanently removed. This action cannot be undone.</p>
                </div>
            </div>
        </div>
        <form method="POST" action="<?= base_url('/admin/department/delete') ?>">
            <input type="hidden" name="id" id="confirmDeleteId">

            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="submit"
                    class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto">
                    Delete
                </button>
                <button id="cancelDialog" type="button"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const openBtn = document.getElementById('openDialog');
        const cancelBtn = document.getElementById('cancelDialog');
        const wrapper = document.getElementById('dialogWrapper');
        const panel = document.getElementById('dialogPanel');

        openBtn.addEventListener('click', () => {
            wrapper.classList.remove('hidden');
            setTimeout(() => {
                panel.classList.remove('opacity-0', 'scale-95');
                panel.classList.add('opacity-100', 'scale-100');
            }, 10);
        });

        cancelBtn.addEventListener('click', () => {
            panel.classList.remove('opacity-100', 'scale-100');
            panel.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                wrapper.classList.add('hidden');
            }, 300);
        });
    });
</script>
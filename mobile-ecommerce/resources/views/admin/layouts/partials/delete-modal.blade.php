<!-- GLOBAL DELETE CONFIRMATION MODAL (Native JS) -->
<div id="delete-modal"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-xs hidden">
    <!-- Modal Card -->
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 text-center ring-1 ring-slate-200">
        <!-- Warning Icon -->
        <div class="w-12 h-12 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                </path>
            </svg>
        </div>

        <!-- Title & Description -->
        <h3 class="text-lg font-bold text-slate-900 mb-1">Delete Confirmation</h3>
        <p class="text-sm text-slate-500 mb-6">
            Are you sure you want to delete <span id="modal-item-title" class="font-semibold text-slate-700">this
                item</span>? This action cannot be undone.
        </p>

        <!-- Action Buttons -->
        <div class="flex items-center justify-center gap-3">
            <button type="button" id="modal-cancel-btn"
                class="flex-1 bg-slate-100 text-slate-700 px-4 py-2.5 rounded-xl hover:bg-slate-200 font-medium text-sm transition">
                Cancel
            </button>

            <form id="modal-delete-form" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-full bg-rose-600 text-white px-4 py-2.5 rounded-xl hover:bg-rose-500 font-medium text-sm transition shadow-sm shadow-rose-200">
                    Yes, Delete
                </button>
            </form>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', () => {
        const deleteModal = document.getElementById('delete-modal');
        const modalDeleteForm = document.getElementById('modal-delete-form');
        const modalItemTitle = document.getElementById('modal-item-title');
        const cancelBtn = document.getElementById('modal-cancel-btn');

        // Sabhi delete buttons par click event lagayein
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', () => {
                const url = button.getAttribute('data-url');
                const title = button.getAttribute('data-title');

                // Form ka action aur title set karein
                modalDeleteForm.setAttribute('action', url);
                modalItemTitle.textContent = title;

                // Modal show karein
                deleteModal.classList.remove('hidden');
            });
        });

        // Cancel button ya background click par modal band karein
        function closeModal() {
            deleteModal.classList.add('hidden');
        }

        if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
        if (deleteModal) {
            deleteModal.addEventListener('click', (e) => {
                if (e.target === deleteModal) closeModal();
            });
        }
    });
</script>

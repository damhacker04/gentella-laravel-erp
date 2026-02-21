// Bootstrap 5
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// jQuery (required for DataTables & Select2)
import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

// DataTables
import 'datatables.net';
import 'datatables.net-bs5';

// Select2
import select2 from 'select2';
select2(jQuery);

// Flatpickr
import flatpickr from 'flatpickr';
window.flatpickr = flatpickr;

// SweetAlert2
import Swal from 'sweetalert2';
window.Swal = Swal;

// ============================================
// SIDEBAR TOGGLE
// ============================================
document.addEventListener('DOMContentLoaded', function () {
    // Sidebar toggle
    const toggleBtn = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            if (window.innerWidth >= 992) {
                document.body.classList.toggle('sidebar-collapsed');
            } else {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            }
        });
    }

    if (overlay) {
        overlay.addEventListener('click', function () {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    }

    // Submenu toggle
    document.querySelectorAll('.menu-item.has-submenu > a').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const parent = this.parentElement;
            // Close other open submenus
            parent.parentElement.querySelectorAll('.menu-item.has-submenu.open').forEach(function (item) {
                if (item !== parent) item.classList.remove('open');
            });
            parent.classList.toggle('open');
        });
    });

    // User dropdown toggle
    const userDropdownBtn = document.getElementById('user-dropdown-btn');
    const userDropdown = document.getElementById('user-dropdown');

    if (userDropdownBtn && userDropdown) {
        userDropdownBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });

        document.addEventListener('click', function () {
            userDropdown.classList.remove('show');
        });
    }

    // Initialize DataTables
    document.querySelectorAll('.datatable').forEach(function (table) {
        $(table).DataTable({
            responsive: true,
            language: {
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                infoEmpty: 'Tidak ada data',
                infoFiltered: '(disaring dari _MAX_ total data)',
                zeroRecords: 'Data tidak ditemukan',
                paginate: {
                    first: 'Pertama',
                    last: 'Terakhir',
                    next: '›',
                    previous: '‹'
                }
            }
        });
    });

    // Initialize Select2
    document.querySelectorAll('.select2').forEach(function (el) {
        $(el).select2({
            theme: 'default',
            placeholder: el.getAttribute('data-placeholder') || 'Pilih...',
            allowClear: true,
            width: '100%'
        });
    });

    // Initialize Flatpickr
    document.querySelectorAll('.datepicker').forEach(function (el) {
        flatpickr(el, {
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'd M Y',
        });
    });

    // Initialize Money Format
    document.querySelectorAll('.money-format').forEach(function (el) {
        el.addEventListener('input', function () {
            let value = this.value.replace(/[^0-9]/g, '');
            if (value) {
                this.value = parseInt(value).toLocaleString('id-ID');
            }
        });

        el.addEventListener('focus', function () {
            let value = this.value.replace(/[^0-9]/g, '');
            this.value = value;
        });

        el.addEventListener('blur', function () {
            let value = this.value.replace(/[^0-9]/g, '');
            if (value) {
                this.value = parseInt(value).toLocaleString('id-ID');
            }
        });
    });

    // Delete confirmation with SweetAlert2
    document.querySelectorAll('.btn-delete').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const form = this.closest('form') || document.getElementById(this.dataset.form);

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data yang dihapus tidak bisa dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#E74C3C',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed && form) {
                    form.submit();
                }
            });
        });
    });

    // Status change confirmation
    document.querySelectorAll('.btn-status-change').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const form = this.closest('form');
            const action = this.dataset.action || 'mengubah status';

            Swal.fire({
                title: 'Konfirmasi',
                text: `Yakin ingin ${action}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1ABB9C',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Lanjutkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed && form) {
                    form.submit();
                }
            });
        });
    });
});

// ============================================
// DYNAMIC LINE ITEMS (Transaction Forms)
// ============================================
window.DynamicItems = {
    counter: 0,

    init: function (tableId, templateId) {
        this.table = document.getElementById(tableId);
        this.template = document.getElementById(templateId);
        if (this.table) {
            this.counter = this.table.querySelectorAll('.item-row').length;
        }
    },

    addRow: function () {
        if (!this.template) return;
        const clone = this.template.content.cloneNode(true);
        // Replace INDEX placeholder
        const html = clone.querySelector('tr');
        if (html) {
            html.innerHTML = html.innerHTML.replace(/__INDEX__/g, this.counter);
            html.classList.add('item-row');
            this.table.querySelector('tbody').appendChild(html);
            // Re-init select2/flatpickr for new row
            $(html).find('.select2').select2({ width: '100%', placeholder: 'Pilih...' });
            this.counter++;
            this.recalculate();
        }
    },

    removeRow: function (btn) {
        const row = btn.closest('.item-row');
        if (this.table.querySelectorAll('.item-row').length > 1) {
            row.remove();
            this.recalculate();
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Minimal 1 item',
                text: 'Tidak bisa menghapus semua item.',
                confirmButtonColor: '#1ABB9C'
            });
        }
    },

    recalculate: function () {
        let grandTotal = 0;
        this.table.querySelectorAll('.item-row').forEach(function (row) {
            const qty = parseFloat(row.querySelector('.item-qty')?.value) || 0;
            const price = parseFloat(row.querySelector('.item-price')?.value.replace(/[^0-9.]/g, '')) || 0;
            const subtotal = qty * price;
            const subtotalEl = row.querySelector('.item-subtotal');
            if (subtotalEl) {
                subtotalEl.textContent = subtotal.toLocaleString('id-ID');
            }
            // Also set hidden input
            const subtotalInput = row.querySelector('.item-subtotal-input');
            if (subtotalInput) subtotalInput.value = subtotal;
            grandTotal += subtotal;
        });

        const grandTotalEl = document.getElementById('grand-total');
        if (grandTotalEl) {
            grandTotalEl.textContent = grandTotal.toLocaleString('id-ID');
        }
        const grandTotalInput = document.getElementById('grand-total-input');
        if (grandTotalInput) grandTotalInput.value = grandTotal;
    }
};

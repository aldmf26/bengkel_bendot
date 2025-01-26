{{-- <script src="{{asset('assets')}}/static/js/components/dark.js"></script> --}}
<script src="{{ asset('assets') }}/static/js/pages/horizontal-layout.js"></script>
<script src="{{ asset('assets') }}/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="{{ asset('assets') }}/extensions/toastify-js/src/toastify.js"></script>
<script src="{{ asset('assets') }}/compiled/js/app.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.1.8/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $("#example").dataTable({
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
        }]
    });
    $(document).ready(function() {
        $('.select2').select2({
            dropdownParent: $('#tambah'), // Ganti dengan ID modal kamu
            width: '100%'
        });
    });

    function printOut(divId) {
            var printOutContent = document.getElementById(divId).innerHTML;
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = printOutContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
        
</script>

<script>
    function alertToast(jenis = 'sukses', pesan) {
        var ava = jenis == 'sukses' ? "https://cdn-icons-png.flaticon.com/512/190/190411.png" :
            "https://cdn-icons-png.flaticon.com/512/564/564619.png"
        var bg = jenis == 'sukses' ? "#EAF7EE" : "#FCEDE9"
        $(document).ready(function() {
            Toastify({
                text: pesan,
                duration: 3000,
                position: "center",
                style: {
                    background: bg,
                    color: "#7F8B8B",
                    fontSize: "15px", // Menyesuaikan ukuran teks
                    padding: "15px", // Menyesuaikan jarak padding
                    borderRadius: "10px" // Menambahkan sudut elemen
                },
                close: true,
                avatar: ava
            }).showToast();
        });
    }

    document.addEventListener('livewire:initialized', () => {
        Livewire.on('showAlert', ([{
            type,
            message
        }]) => {
            alertToast(type, message);
        });
    });
</script>



@yield('scripts')
@livewireScripts

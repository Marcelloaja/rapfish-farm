<div class="page-content">
    <div class="container-fluid">
        <!-- page title and alerts here... -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="card-title">Data Carousel Utama</h4>
                            <button type="button" class="btn btn-primary" onclick="openModalForm()">
                                <i class="fas fa-plus"></i> Tambahkan Carousel Utama
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>IMG</th>
                                    <th>Title</th>
                                    <th>Sub Title</th>
                                    <th>URL</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_cu as $cu)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $cu->IMG_CU) }}" alt="Image" style="width: 100px; height: auto;">
                                    </td>
                                    <td>{{ $cu->TITLE_CU }}</td>
                                    <td>{{ $cu->SUB_TITLE_CU }}</td>
                                    <td>{{ $cu->URL_CU }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="openModalForm('{{ json_encode($cu) }}')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="openModalDelete('{{ $cu->ID_CU }}')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>

<!-- Modal for form -->
<div class="modal fade" id="modalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormLabel">Form Carousel Utama</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-cu" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_cu">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">IMG</label>
                                <input type="file" class="form-control" name="img_cu" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title_cu" placeholder="Enter your title" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Sub Title</label>
                                <input type="text" class="form-control" name="sub_title_cu" placeholder="Enter your sub title" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Url</label>
                                <input type="text" class="form-control" name="url_cu" placeholder="Enter your url" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><span id="text-btn"></span></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts for DataTables and Modal -->
<script>
    $(document).ready(function() {
        $("#datatable-buttons").DataTable({
            lengthChange: !1,
            buttons: ["pageLength", "colvis"]
        }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
    });

    function openModalForm(dataRaw = "") {
        if (dataRaw.length > 0) {
            var data = JSON.parse(dataRaw);
            $('input[name="id_cu"]').val(data.ID_CU);
            $('input[name="img_cu"]').val(''); // Kosongkan input file untuk keamanan
            $('input[name="title_cu"]').val(data.TITLE_CU);
            $('input[name="sub_title_cu"]').val(data.SUB_TITLE_CU);
            $('input[name="url_cu"]').val(data.URL_CU);
            $('#text-btn').html('Simpan Perubahan');
            $('#form-cu').attr('action', '{{ route("admin.edit-cu") }}');
        } else {
            $('#text-btn').html('Tambahkan Carousel Utama');
            $('#form-cu').attr('action', '{{ route("admin.save-cu") }}');
        }
        $('#modalForm').modal('show');
    }

    function openModalDelete(idCu) {
        Swal.fire({
            title: "Apakah kamu yakin?",
            text: "Kamu tidak akan bisa mengembalikan data Carousel Utama yang sudah dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = "{{ route('admin.delete-cu', '') }}/" + idCu;
            }
        });
    }
</script>
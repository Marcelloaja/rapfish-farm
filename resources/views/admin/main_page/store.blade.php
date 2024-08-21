<div class="page-content">
    <div class="container-fluid">
        <!-- page title and alerts here... -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="card-title">Data Store</h4>
                            <button type="button" class="btn btn-primary" onclick="openModalForm()">
                                <i class="fas fa-plus"></i> Tambahkan Item Store
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>IMG</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Url</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_store as $ds)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $ds->IMG_STORE) }}" alt="Image" style="width: 50px; height: auto;">
                                    </td>
                                    <td>{{ $ds->TITLE_STORE }}</td>
                                    <td>{{ $ds->DESC_STORE }}</td>
                                    <td>{{ $ds->PRICE_STORE }}</td>
                                    <td>{{ $ds->URL_STORE }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="openModalForm('{{ json_encode($ds) }}')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="openModalDelete('{{ $ds->ID_STORE }}')">
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
                <h5 class="modal-title" id="modalFormLabel">Form Store</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-ds" action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                @csrf
                <input type="hidden" name="id_store">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">IMG</label>
                                <input type="file" class="form-control" name="img_store" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title_store" placeholder="Enter your title" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" name="desc_store" placeholder="Enter your description" required>
                                <small id="desc-error" class="text-danger" style="display: none;">Description must not exceed 255 characters.</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="text" class="form-control" name="price_store" placeholder="Enter your price item" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Url</label>
                                <input type="text" class="form-control" name="url_store" placeholder="Enter your url" required>
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

    function validateForm() {
        const descField = document.querySelector('input[name="desc_store"]');
        const errorField = document.getElementById('desc-error');

        if (descField.value.length > 255) {
            errorField.style.display = 'block';
            return false; // Prevent form submission
        } else {
            errorField.style.display = 'none';
        }

        return true; // Allow form submission
    }

    function openModalForm(dataRaw = "") {
        if (dataRaw.length > 0) {
            var data = JSON.parse(dataRaw);
            $('input[name="id_store"]').val(data.ID_STORE);
            $('input[name="img_store"]').val(''); // Kosongkan input file untuk keamanan
            $('input[name="title_store"]').val(data.TITLE_STORE);
            $('input[name="desc_store"]').val(data.DESC_STORE);
            $('input[name="price_store"]').val(data.PRICE_STORE);
            $('input[name="url_store"]').val(data.URL_STORE);
            $('#text-btn').html('Simpan Perubahan');
            $('#form-ds').attr('action', '{{ route("admin.edit-ds") }}');
        } else {
            $('#text-btn').html('Tambahkan Item Store Baru');
            $('#form-ds').attr('action', '{{ route("admin.save-ds") }}');
        }
        $('#modalForm').modal('show');
    }

    function openModalDelete(idDs) {
        Swal.fire({
            title: "Apakah kamu yakin?",
            text: "Kamu tidak akan bisa mengembalikan data item store yang sudah dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = "{{ route('admin.delete-ds', '') }}/" + idDs;
            }
        });
    }
</script>

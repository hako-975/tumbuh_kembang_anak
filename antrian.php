<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $antrian = mysqli_query($conn, "SELECT * FROM antrian
        ORDER BY
            CASE
                WHEN status = 'Diproses' THEN 1
                WHEN status = 'Menunggu' THEN 2
                ELSE 3
            END,
            id_antrian ASC;
    ");

?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Antrian</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/sidebar.php'; ?>
        <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-user-friends"></i> Antrian</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Antrian
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div>
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!-- Info boxes -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-2">
                                <a href="tambah_antrian.php" class="mb-3 btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Antrian</a>
                                <table class="table table-bordered" id="table_id">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center align-middle">Antrian No.</th>
                                            <th class="text-center align-middle">Status Antrian</th>
                                            <th class="text-center align-middle">Dibuat Pada</th>
                                            <th class="text-center align-middle">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($antrian as $da): ?>
                                            <tr>
                                                <td class="text-center align-middle"><?= $da['id_antrian']; ?>.</td>
                                                <td class="align-middle"><?= $da['status']; ?></td>
                                                <td class="align-middle"><?= date('d-m-Y, H:i:s', strtotime($da['waktu_antrian']));; ?></td>
                                                <td class="text-center align-middle">
                                                    <!-- Tombol Ubah -->
                                                    <button type="button" class="m-1 btn btn-success btn-edit" 
                                                            data-id="<?= $da['id_antrian']; ?>" 
                                                            data-status="<?= $da['status']; ?>" 
                                                            data-bs-toggle="modal" data-bs-target="#editModal">
                                                        <i class="fas fa-fw fa-edit"></i> Ubah
                                                    </button>
                                                    <a href="hapus_antrian.php?id_antrian=<?= $da['id_antrian']; ?>" data-nama="Antrian No. <?= $da['id_antrian']; ?>" class="m-1 btn btn-danger btn-delete"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- /.row --> <!--begin::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main--> 
        <?php include_once 'include/footer.php'; ?>
    </div> <!--end::App Wrapper--> 
    <?php include_once 'include/script.php'; ?>
    <!-- Modal Ubah Status -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editModalLabel">Ubah Status Antrian</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="ubah_status_antrian.php" method="post">
              <input type="hidden" name="id_antrian" id="modal_id_antrian">
              <div class="mb-3">
                <label for="modal_status" class="form-label">Status</label>
                <select class="form-select" name="status" id="modal_status">
                  <option value="Menunggu">Menunggu</option>
                  <option value="Diproses">Diproses</option>
                  <option value="Selesai">Selesai</option>
                  <option value="Dilewati">Dilewati</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Script untuk Mengisi Data di Modal -->
    <script>
        $(document).ready(function () {
            $('.btn-edit').on('click', function () {
                var idAntrian = $(this).data('id');
                var status = $(this).data('status');
                
                $('#modal_id_antrian').val(idAntrian);
                $('#modal_status').val(status);
            });
        });
    </script>
</body><!--end::Body-->

</html>
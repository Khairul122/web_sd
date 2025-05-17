<?php include('template/header.php'); ?>

<body class="with-welcome-text">
  <div class="container-scroller">
    <?php include 'template/navbar.php'; ?>
    <div class="container-fluid page-body-wrapper">
      <?php include 'template/setting_panel.php'; ?>
      <?php include 'template/sidebar.php'; ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="text-primary">Data Kelas</h4>
                <a href="index.php?controller=Kelas&action=tambah" class="btn btn-success btn-sm">+ Tambah Kelas</a>
              </div>

              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead class="table-light">
                    <tr>
                      <th>No</th>
                      <th>Nama Kelas</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach ($data['kelas'] as $k): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($k['nama_kelas']) ?></td>
                        <td>
                          <a href="index.php?controller=Kelas&action=edit&id=<?= $k['kelas_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                          <a href="index.php?controller=Kelas&action=hapus&id=<?= $k['kelas_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kelas ini?')">Hapus</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    <?php if (empty($data['kelas'])): ?>
                      <tr>
                        <td colspan="3" class="text-center text-muted">Belum ada data kelas</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'template/script.php'; ?>
</body>
</html>

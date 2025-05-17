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
                <h4 class="text-primary">Data Kriteria Penilaian</h4>
                <a href="index.php?controller=Kriteria&action=tambah" class="btn btn-success btn-sm">+ Tambah Kriteria</a>
              </div>

              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead class="table-light">
                    <tr>
                      <th>No</th>
                      <th>Kode</th>
                      <th>Nama Kriteria</th>
                      <th>Bobot</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach ($data['kriteria'] as $k): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($k['kode']) ?></td>
                        <td><?= htmlspecialchars($k['nama_kriteria']) ?></td>
                        <td><?= $k['bobot'] ?></td>
                        <td>
                          <a href="index.php?controller=Kriteria&action=edit&id=<?= $k['kriteria_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                          <a href="index.php?controller=Kriteria&action=hapus&id=<?= $k['kriteria_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kriteria ini?')">Hapus</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    <?php if (empty($data['kriteria'])): ?>
                      <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data kriteria</td>
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

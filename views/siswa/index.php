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
                <h4 class="text-primary">Data Siswa</h4>
                <a href="index.php?controller=Siswa&action=tambah" class="btn btn-success btn-sm">+ Tambah Siswa</a>
              </div>

              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead class="table-light">
                    <tr>
                      <th>No</th>
                      <th>Nama Siswa</th>
                      <th>Jenis Kelamin</th>
                      <th>Kelas</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach ($data['siswa'] as $s): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($s['nama_siswa']) ?></td>
                        <td><?= $s['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                        <td><?= htmlspecialchars($s['nama_kelas']) ?></td>
                        <td>
                          <a href="index.php?controller=Siswa&action=edit&id=<?= $s['siswa_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                          <a href="index.php?controller=Siswa&action=hapus&id=<?= $s['siswa_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus siswa ini?')">Hapus</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    <?php if (empty($data['siswa'])): ?>
                      <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data siswa</td>
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

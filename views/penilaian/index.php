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
                <h4 class="text-primary">Data Penilaian Kedisiplinan</h4>
                <a href="index.php?controller=Penilaian&action=tambah" class="btn btn-success btn-sm">+ Tambah Penilaian</a>
              </div>

              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead class="table-light">
                    <tr>
                      <th>No</th>
                      <th>Nama Siswa</th>
                      <th>Kelas</th>
                      <th>C1</th>
                      <th>C2</th>
                      <th>C3</th>
                      <th>C4</th>
                      <th>C5</th>
                      <th>C6</th>
                      <th>C7</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach ($data['penilaian'] as $p): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($p['nama_siswa']) ?></td>
                        <td><?= htmlspecialchars($p['nama_kelas']) ?></td>
                        <td><?= $p['c1'] ?></td>
                        <td><?= $p['c2'] ?></td>
                        <td><?= $p['c3'] ?></td>
                        <td><?= $p['c4'] ?></td>
                        <td><?= $p['c5'] ?></td>
                        <td><?= $p['c6'] ?></td>
                        <td><?= $p['c7'] ?></td>
                        <td>
                          <a href="index.php?controller=Penilaian&action=edit&id=<?= $p['penilaian_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                          <a href="index.php?controller=Penilaian&action=hapus&id=<?= $p['penilaian_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    <?php if (empty($data['penilaian'])): ?>
                      <tr>
                        <td colspan="11" class="text-center text-muted">Belum ada data penilaian</td>
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

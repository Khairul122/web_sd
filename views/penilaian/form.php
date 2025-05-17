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

              <div class="mb-4">
                <h4 class="text-primary"><?= isset($data['penilaian']) ? 'Edit' : 'Tambah' ?> Penilaian</h4>
              </div>

              <form action="index.php?controller=Penilaian&action=<?= isset($data['penilaian']) ? 'update' : 'simpan' ?>" method="POST">
                <?php if (isset($data['penilaian'])): ?>
                  <input type="hidden" name="penilaian_id" value="<?= $data['penilaian']['penilaian_id'] ?>">
                <?php endif; ?>

                <div class="mb-3">
                  <label for="siswa_id" class="form-label">Nama Siswa</label>
                  <select name="siswa_id" id="siswa_id" class="form-control" required>
                    <option value="">-- Pilih Siswa --</option>
                    <?php foreach ($data['siswa'] as $s): ?>
                      <option value="<?= $s['siswa_id'] ?>" <?= (isset($data['penilaian']) && $data['penilaian']['siswa_id'] == $s['siswa_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($s['nama_siswa']) ?> (<?= $s['nama_kelas'] ?>)
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <?php
                  $label = [
                    'c1' => 'Kehadiran',
                    'c2' => 'Mengikuti Upacara',
                    'c3' => 'Piket Mingguan',
                    'c4' => 'Kerapian Seragam',
                    'c5' => 'Ketepatan Waktu',
                    'c6' => 'Pengumpulan Tugas',
                    'c7' => 'Kehadiran di Kelas'
                  ];
                  foreach ($label as $kode => $nama):
                ?>
                  <div class="mb-3">
                    <label for="<?= $kode ?>" class="form-label"><?= $nama ?> (<?= strtoupper($kode) ?>)</label>
                    <input type="number" step="0.01" min="0" max="100" name="<?= $kode ?>" id="<?= $kode ?>" class="form-control" required
                           value="<?= isset($data['penilaian']) ? $data['penilaian'][$kode] : '' ?>">
                  </div>
                <?php endforeach; ?>

                <button type="submit" class="btn btn-primary"><?= isset($data['penilaian']) ? 'Update' : 'Simpan' ?></button>
                <a href="index.php?controller=Penilaian&action=index" class="btn btn-secondary">Batal</a>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'template/script.php'; ?>
</body>
</html>

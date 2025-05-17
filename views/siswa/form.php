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
                <h4 class="text-primary"><?= isset($data['siswa']) ? 'Edit' : 'Tambah' ?> Siswa</h4>
              </div>

              <form action="index.php?controller=Siswa&action=<?= isset($data['siswa']) ? 'update' : 'simpan' ?>" method="POST">
                <?php if (isset($data['siswa'])): ?>
                  <input type="hidden" name="siswa_id" value="<?= $data['siswa']['siswa_id'] ?>">
                <?php endif; ?>

                <div class="mb-3">
                  <label for="nama_siswa" class="form-label">Nama Siswa</label>
                  <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" required
                         value="<?= isset($data['siswa']) ? htmlspecialchars($data['siswa']['nama_siswa']) : '' ?>">
                </div>

                <div class="mb-3">
                  <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                  <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="L" <?= (isset($data['siswa']) && $data['siswa']['jenis_kelamin'] == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="P" <?= (isset($data['siswa']) && $data['siswa']['jenis_kelamin'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="kelas_id" class="form-label">Kelas</label>
                  <select name="kelas_id" id="kelas_id" class="form-control" required>
                    <option value="">-- Pilih Kelas --</option>
                    <?php foreach ($data['kelas'] as $k): ?>
                      <option value="<?= $k['kelas_id'] ?>" <?= (isset($data['siswa']) && $data['siswa']['kelas_id'] == $k['kelas_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($k['nama_kelas']) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <button type="submit" class="btn btn-primary"><?= isset($data['siswa']) ? 'Update' : 'Simpan' ?></button>
                <a href="index.php?controller=Siswa&action=index" class="btn btn-secondary">Batal</a>
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

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
                <h4 class="text-primary"><?= isset($data['kelas']) ? 'Edit' : 'Tambah' ?> Kelas</h4>
              </div>

              <form action="index.php?controller=Kelas&action=<?= isset($data['kelas']) ? 'update' : 'simpan' ?>" method="POST">
                <?php if (isset($data['kelas'])): ?>
                  <input type="hidden" name="kelas_id" value="<?= $data['kelas']['kelas_id'] ?>">
                <?php endif; ?>

                <div class="mb-3">
                  <label for="nama_kelas" class="form-label">Nama Kelas</label>
                  <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" required
                         value="<?= isset($data['kelas']) ? htmlspecialchars($data['kelas']['nama_kelas']) : '' ?>">
                </div>

                <button type="submit" class="btn btn-primary"><?= isset($data['kelas']) ? 'Update' : 'Simpan' ?></button>
                <a href="index.php?controller=Kelas&action=index" class="btn btn-secondary">Batal</a>
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

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
                <h4 class="text-primary"><?= isset($data['kriteria']) ? 'Edit' : 'Tambah' ?> Kriteria</h4>
              </div>

              <form action="index.php?controller=Kriteria&action=<?= isset($data['kriteria']) ? 'update' : 'simpan' ?>" method="POST">
                <?php if (isset($data['kriteria'])): ?>
                  <input type="hidden" name="kriteria_id" value="<?= $data['kriteria']['kriteria_id'] ?>">
                <?php endif; ?>

                <div class="mb-3">
                  <label for="kode" class="form-label">Kode</label>
                  <input type="text" name="kode" id="kode" class="form-control" required maxlength="5"
                         value="<?= isset($data['kriteria']) ? htmlspecialchars($data['kriteria']['kode']) : '' ?>">
                </div>

                <div class="mb-3">
                  <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                  <input type="text" name="nama_kriteria" id="nama_kriteria" class="form-control" required
                         value="<?= isset($data['kriteria']) ? htmlspecialchars($data['kriteria']['nama_kriteria']) : '' ?>">
                </div>

                <div class="mb-3">
                  <label for="bobot" class="form-label">Bobot</label>
                  <input type="number" step="0.01" min="0" max="1" name="bobot" id="bobot" class="form-control" required
                         value="<?= isset($data['kriteria']) ? $data['kriteria']['bobot'] : '' ?>">
                </div>

                <button type="submit" class="btn btn-primary"><?= isset($data['kriteria']) ? 'Update' : 'Simpan' ?></button>
                <a href="index.php?controller=Kriteria&action=index" class="btn btn-secondary">Batal</a>
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

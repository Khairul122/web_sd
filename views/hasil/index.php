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
                <h4 class="text-primary">Hasil Evaluasi Siswa (Metode WSM)</h4>
                <div>
                  <a href="index.php?controller=Hasil&action=hitung" class="btn btn-success btn-sm">Lakukan Perhitungan WSM</a>
                  <button onclick="cetakHasil()" class="btn btn-primary btn-sm">Cetak PDF</button>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tabel-hasil">
                  <thead class="table-light">
                    <tr>
                      <th>No</th>
                      <th>Nama Siswa</th>
                      <th>Kelas</th>
                      <th>Total Nilai</th>
                      <th>Ranking</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach ($data['hasil'] as $h): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($h['nama_siswa']) ?></td>
                        <td><?= htmlspecialchars($h['nama_kelas']) ?></td>
                        <td><?= number_format($h['total_nilai'], 2) ?></td>
                        <td><?= $h['ranking'] ?></td>
                      </tr>
                    <?php endforeach; ?>
                    <?php if (empty($data['hasil'])): ?>
                      <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada hasil perhitungan</td>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
  <script>
    function cetakHasil() {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();
      doc.text("Laporan Hasil Evaluasi Siswa", 14, 15);
      const rows = [];

      document.querySelectorAll("#tabel-hasil tbody tr").forEach(tr => {
        const cols = Array.from(tr.querySelectorAll("td")).map(td => td.textContent.trim());
        rows.push(cols);
      });

      doc.autoTable({
        head: [['No', 'Nama Siswa', 'Kelas', 'Total Nilai', 'Ranking']],
        body: rows,
        startY: 25,
        styles: { fontSize: 10 },
        headStyles: { fillColor: [52, 58, 64] }
      });

      doc.save("hasil_evaluasi.pdf");
    }
  </script>
</body>
</html>

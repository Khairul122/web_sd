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

              <div class="card mb-4">
                <div class="card-header bg-light">
                  <h5 class="card-title">Perhitungan Manual Weighted Sum Model (WSM)</h5>
                </div>
                <div class="card-body">
                  <div class="row mb-4">
                    <div class="col-md-6">
                      <h6 class="fw-bold">Bobot Kriteria:</h6>
                      <?php 
                      $kriteria = $this->model->getKriteria();
                      foreach ($kriteria as $k): 
                      ?>
                        <div class="d-flex justify-content-between mb-2">
                          <span><strong><?= $k['kode'] ?></strong> - <?= htmlspecialchars($k['nama_kriteria']) ?>:</span>
                          <span class="badge bg-info"><?= $k['bobot'] ?></span>
                        </div>
                      <?php endforeach; ?>
                    </div>
                    <div class="col-md-6">
                      <h6 class="fw-bold">Formula WSM:</h6>
                      <div class="bg-light p-3 rounded border">
                        <p class="mb-0">Total Nilai = (C1 × <?= $kriteria[0]['bobot'] ?>) + (C2 × <?= $kriteria[1]['bobot'] ?>) + (C3 × <?= $kriteria[2]['bobot'] ?>) + (C4 × <?= $kriteria[3]['bobot'] ?>) + (C5 × <?= $kriteria[4]['bobot'] ?>) + (C6 × <?= $kriteria[5]['bobot'] ?>) + (C7 × <?= $kriteria[6]['bobot'] ?>)</p>
                      </div>
                    </div>
                  </div>
                  
                  <h6 class="fw-bold mt-4 mb-3">Detail Perhitungan:</h6>
                  
                  <?php 
                  $penilaian = $this->model->getPenilaian();
                  foreach ($penilaian as $index => $p): 
                    $nilai1 = $p['c1'] * $kriteria[0]['bobot'];
                    $nilai2 = $p['c2'] * $kriteria[1]['bobot'];
                    $nilai3 = $p['c3'] * $kriteria[2]['bobot'];
                    $nilai4 = $p['c4'] * $kriteria[3]['bobot'];
                    $nilai5 = $p['c5'] * $kriteria[4]['bobot'];
                    $nilai6 = $p['c6'] * $kriteria[5]['bobot'];
                    $nilai7 = $p['c7'] * $kriteria[6]['bobot'];
                    $total = $nilai1 + $nilai2 + $nilai3 + $nilai4 + $nilai5 + $nilai6 + $nilai7;
                  ?>
                    <div class="card mb-3 border <?= $index % 2 == 0 ? 'border-primary' : 'border-info' ?>">
                      <div class="card-header <?= $index % 2 == 0 ? 'bg-primary text-white' : 'bg-info text-white' ?>">
                        <strong><?= htmlspecialchars($p['nama_siswa']) ?></strong>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-9">
                            <div class="calculation-steps">
                              <p class="mb-1">
                                <span class="badge bg-secondary">C1</span> <?= $p['c1'] ?> × <?= $kriteria[0]['bobot'] ?> = <strong><?= number_format($nilai1, 2) ?></strong>
                              </p>
                              <p class="mb-1">
                                <span class="badge bg-secondary">C2</span> <?= $p['c2'] ?> × <?= $kriteria[1]['bobot'] ?> = <strong><?= number_format($nilai2, 2) ?></strong>
                              </p>
                              <p class="mb-1">
                                <span class="badge bg-secondary">C3</span> <?= $p['c3'] ?> × <?= $kriteria[2]['bobot'] ?> = <strong><?= number_format($nilai3, 2) ?></strong>
                              </p>
                              <p class="mb-1">
                                <span class="badge bg-secondary">C4</span> <?= $p['c4'] ?> × <?= $kriteria[3]['bobot'] ?> = <strong><?= number_format($nilai4, 2) ?></strong>
                              </p>
                              <p class="mb-1">
                                <span class="badge bg-secondary">C5</span> <?= $p['c5'] ?> × <?= $kriteria[4]['bobot'] ?> = <strong><?= number_format($nilai5, 2) ?></strong>
                              </p>
                              <p class="mb-1">
                                <span class="badge bg-secondary">C6</span> <?= $p['c6'] ?> × <?= $kriteria[5]['bobot'] ?> = <strong><?= number_format($nilai6, 2) ?></strong>
                              </p>
                              <p class="mb-1">
                                <span class="badge bg-secondary">C7</span> <?= $p['c7'] ?> × <?= $kriteria[6]['bobot'] ?> = <strong><?= number_format($nilai7, 2) ?></strong>
                              </p>
                            </div>
                          </div>
                          <div class="col-md-3 d-flex align-items-center justify-content-center">
                            <div class="text-center">
                              <div class="display-6 fw-bold"><?= number_format($total, 2) ?></div>
                              <small class="text-muted">Total Nilai</small>
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="calculation-formula">
                          <small class="text-muted">
                            Total = <?= $p['c1'] ?> × <?= $kriteria[0]['bobot'] ?> + 
                            <?= $p['c2'] ?> × <?= $kriteria[1]['bobot'] ?> + 
                            <?= $p['c3'] ?> × <?= $kriteria[2]['bobot'] ?> + 
                            <?= $p['c4'] ?> × <?= $kriteria[3]['bobot'] ?> + 
                            <?= $p['c5'] ?> × <?= $kriteria[4]['bobot'] ?> + 
                            <?= $p['c6'] ?> × <?= $kriteria[5]['bobot'] ?> + 
                            <?= $p['c7'] ?> × <?= $kriteria[6]['bobot'] ?> = 
                            <strong><?= number_format($total, 2) ?></strong>
                          </small>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>

              <div class="card">
                <div class="card-header bg-primary text-white">
                  <h5 class="card-title mb-0">Hasil Akhir Evaluasi</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="tabel-hasil">
                      <thead class="table-light">
                        <tr>
                          <th>No</th>
                          <th>Nama Siswa</th>
                          <th>Kelas</th>
                          <th>Total Nilai</th>
                          <th>Ranking</th>
                          <th>Penilaian</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1;
                        foreach ($data['hasil'] as $h): ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($h['nama_siswa']) ?></td>
                            <td><?= htmlspecialchars($h['nama_kelas']) ?></td>
                            <td><?= number_format($h['total_nilai'], 2) ?></td>
                            <td><?= $h['ranking'] ?></td>
                            <td>
                              <?php
                              if ($h['total_nilai'] < 3.4) {
                                echo "Kedisiplinan Kurang";
                              } elseif ($h['total_nilai'] >= 3.4 && $h['total_nilai'] < 3.7) {
                                echo "Kedisiplinan Cukup";
                              } else {
                                echo "Kedisiplinan Baik";
                              }
                              ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                        <?php if (empty($data['hasil'])): ?>
                          <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada hasil perhitungan</td>
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
        head: [['No', 'Nama Siswa', 'Kelas', 'Total Nilai', 'Ranking', 'Penilaian']],
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
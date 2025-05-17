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
              <div class="home-tab">
                <div class="row">
                  <div class="col-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                      <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                          <div>
                            <h4 class="card-title card-title-dash">Dashboard Evaluasi Kedisiplinan Siswa</h4>
                            <p class="card-subtitle card-subtitle-dash">Sistem Pendukung Keputusan Menggunakan Metode Weighted Sum Model (WSM)</p>
                          </div>
                          <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                          <div>
                            <a href="index.php?controller=Dashboard&action=hitungWSM" class="btn btn-primary btn-lg text-white mb-0 me-0">
                              <i class="mdi mdi-calculator"></i>Hitung WSM
                            </a>
                          </div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xl-3 col-lg-6 col-md-6 grid-margin stretch-card">
                    <div class="card card-rounded">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                          <h4 class="card-title card-title-dash">Total Siswa</h4>
                          <i class="mdi mdi-account-multiple icon-lg text-primary"></i>
                        </div>
                        <div class="row">
                          <div class="col-8">
                            <h2 class="mb-0"><?= $data['totalSiswa'] ?></h2>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-6 col-md-6 grid-margin stretch-card">
                    <div class="card card-rounded">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                          <h4 class="card-title card-title-dash">Rata-rata Nilai</h4>
                          <i class="mdi mdi-poll icon-lg text-success"></i>
                        </div>
                        <div class="row">
                          <div class="col-8">
                            <h2 class="mb-0"><?= number_format($data['rataRataNilai'], 2) ?></h2>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-6 col-md-6 grid-margin stretch-card">
                    <div class="card card-rounded">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                          <h4 class="card-title card-title-dash">Nilai Tertinggi</h4>
                          <i class="mdi mdi-trophy icon-lg text-warning"></i>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <h2 class="mb-0"><?= isset($data['nilaiTertinggi']) ? number_format($data['nilaiTertinggi']['total_nilai'], 2) : '-' ?></h2>
                            <p class="text-muted"><?= isset($data['nilaiTertinggi']) ? $data['nilaiTertinggi']['nama_siswa'] : '-' ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-6 col-md-6 grid-margin stretch-card">
                    <div class="card card-rounded">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                          <h4 class="card-title card-title-dash">Nilai Terendah</h4>
                          <i class="mdi mdi-alert-circle icon-lg text-danger"></i>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <h2 class="mb-0"><?= isset($data['nilaiTerendah']) ? number_format($data['nilaiTerendah']['total_nilai'], 2) : '-' ?></h2>
                            <p class="text-muted"><?= isset($data['nilaiTerendah']) ? $data['nilaiTerendah']['nama_siswa'] : '-' ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

             

                <div class="row">
                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                      <div class="card-body">
                        <h4 class="card-title">Rata-Rata Nilai Per Kriteria</h4>
                        <div class="table-responsive mt-3">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>Kode</th>
                                <th>Kriteria</th>
                                <th>Bobot</th>
                                <th>Rata-Rata Nilai</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if (isset($data['kriteriaValues']) && !empty($data['kriteriaValues'])): ?>
                                <?php foreach ($data['kriteriaValues'] as $kriteria): ?>
                                <tr>
                                  <td><?= $kriteria['kode'] ?></td>
                                  <td><?= $kriteria['nama_kriteria'] ?></td>
                                  <td><?= $kriteria['bobot'] ?></td>
                                  <td><?= number_format($kriteria['rata_nilai'], 2) ?></td>
                                </tr>
                                <?php endforeach; ?>
                              <?php else: ?>
                                <tr>
                                  <td colspan="4" class="text-center">Tidak ada data kriteria</td>
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
      </div>
    </div>
  </div>

  <?php include 'template/script.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <script>
    $(document).ready(function() {
      // Chart data
      <?php if (isset($data['chartData']) && !empty($data['chartData']['labels'])): ?>
      var ctx = document.getElementById('performanChart').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: <?= json_encode($data['chartData']['labels']) ?>,
          datasets: [{
            label: 'Nilai Kedisiplinan',
            data: <?= json_encode($data['chartData']['values']) ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              max: 5
            }
          },
          responsive: true,
          maintainAspectRatio: false
        }
      });
      <?php endif; ?>

      // Doughnut chart
      <?php if (isset($data['distribusiNilai'])): ?>
      var doughnutCtx = document.getElementById('doughnutChart').getContext('2d');
      var doughnutChart = new Chart(doughnutCtx, {
        type: 'doughnut',
        data: {
          labels: ['Sangat Baik', 'Baik', 'Cukup', 'Kurang'],
          datasets: [{
            data: [
              <?= $data['distribusiNilai']['sangat_baik'] ?>,
              <?= $data['distribusiNilai']['baik'] ?>,
              <?= $data['distribusiNilai']['cukup'] ?>,
              <?= $data['distribusiNilai']['kurang'] ?>
            ],
            backgroundColor: [
              'rgba(75, 192, 192, 0.7)',
              'rgba(54, 162, 235, 0.7)',
              'rgba(255, 206, 86, 0.7)',
              'rgba(255, 99, 132, 0.7)'
            ],
            borderColor: [
              'rgba(75, 192, 192, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false
        }
      });
      <?php endif; ?>

      // DataTable
      $('#dataTable').DataTable({
        "order": [[0, "asc"]],
        "pageLength": 10,
        "language": {
          "lengthMenu": "Tampilkan _MENU_ data per halaman",
          "zeroRecords": "Data tidak ditemukan",
          "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
          "infoEmpty": "Tidak ada data yang tersedia",
          "infoFiltered": "(difilter dari _MAX_ total data)",
          "search": "Cari:",
          "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "next": "Selanjutnya",
            "previous": "Sebelumnya"
          }
        }
      });
    });
  </script>
</body>
</html>
<style>
  h5 {
    color: darkblue;
    font-weight: bold;
  }
</style>

<div class="row" id="tabel-3">
  <h5><?= $judul; ?></h5>
  <p></p>
  <div class="row">
    <!-- TABEL -->
    <div class="table-responsive">
      <table class="table table-bordered table-striped" id="tabel-master">
        <?php if (!empty($tabel) && is_array($tabel) && count($tabel) > 0) : ?>
          <thead>
            <tr>
              <?php foreach (array_keys($tabel[0]) as $key) : ?>
                <th><?= htmlspecialchars($key); ?></th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($tabel as $row) : ?>
              <tr>
                <?php foreach ($row as $column) : ?>
                  <td><?= htmlspecialchars($column); ?></td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        <?php else : ?>
          <thead>
            <tr>
              <th>No data available</th>
            </tr>
          </thead>
        <?php endif; ?>

      </table>
      <br>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 deskripsi">
      <img src="<?= base_url(); ?>/dist/images/explain.jpg" alt="" srcset="" width="200px">
      <h6>Definisi Miskin Ekstrem: </h6>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis excepturi minus soluta ad animi odio numquam corporis natus fuga porro ipsa veritatis quia, totam dignissimos iure obcaecati aspernatur aliquid atque.</p>
      <h6>Interpretasi: </h6> 
      <p>
        <?php foreach ($deskripsi as $des) : ?>
          <?= $des->deskripsi; ?>
        <?php endforeach; ?>
      </p>
    </div>
  </div>
  
</div>


<!-- script datatables -->
<script>
  $(document).ready(function() {

    $('#tabel-master tfoot th').each(function() {
      var title = $(this).text();
      $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    });

    var tabel = $("#tabel-master").DataTable({
      "responsive": false,
      "lengthChange": false,
      "autoWidth": false,
      "order": [
        [0, 'desc']
      ],
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      initComplete: function() {
        // Apply the search
        this.api().columns().every(function() {
          var that = this;

          $('input', this.footer()).on('keyup change clear', function() {
            if (that.search() !== this.value) {
              that
                .search(this.value)
                .draw();
            }
          });
        });
      }
    });

    tabel.buttons().container()
      .appendTo('#tabel-master_wrapper .col-md-6:eq(0)');

  });
</script>

<!-- HIGH CHARTS -->
<script src="<?= base_url(); ?>/dist/js/podes/podes-bar.js"></script>
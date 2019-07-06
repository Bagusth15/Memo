<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Detail Memo</h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="<?= base_url('memo'); ?>" class="btn btn-primary btn-sm">Kembali</a>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="border-bottom text-center pb-2">
            <h5>PT. HIROTO GROUP</h5>
            <small>Ruko Grand Ciomas 1, RT.002/011 Desa Ciomas, Kec Ciomas, Bogor, Jawa Baray 16610</small>
          </div>
          <h6 class="pt-3 pb-3 text-center"><b>MEMO</b></h6>
          <div class="row">
            <div class="col-md-1">
              <span class="float-left"> Dari </span>
            </div>
            <div class="col-md-11">
              <span class="float-left text-muted">: <?= $memo_pengirim['user_name']; ?> (<?= $memo_pengirim['user_role']; ?> <?= $memo_pengirim['user_bagian']; ?>)</span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1">
              <span class="float-left"> Untuk </span>
            </div>
            <div class="col-md-11">
              <span class="float-left text-muted">: <?= $memo_penerima['user_name']; ?> (<?= $memo_penerima['user_role']; ?> <?= $memo_penerima['user_bagian']; ?>)</span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1">
              <span class="float-left"> Perihal </span>
            </div>
            <div class="col-md-11">
              <span class="float-left text-muted">: <?= $memo['mm_perihal']; ?></span>
            </div>
          </div>
          <div class="py-2">
            <p class="clearfix pt-2">
              <span class="float-left text-muted"><?= $memo['mm_isi']; ?></span>
            </p>
            <p class="clearfix pt-3">
              <span class="float-right text-muted">Bogor, <?= date('d F Y', $memo['mm_tgl_buat']); ?></span>
            </p>
          </div>
          <?php if ($user['user_nik'] == $memo['mm_pengirim'] && $memo['mm_status'] != 3) { ?>
            <a href="<?= base_url('memo/edit/'); ?><?= $memo['mm_id']; ?>" class="btn btn-info btn-block">Edit</a>
          <?php } else if ($user['user_nik'] == $memo['mm_tujuan'] && $user['user_role'] == 'Manager'){ ?>
            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#approved_m">Approved</button>
            <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#not_approved">Not Approved</button>
          <?php } else if ($user['user_nik'] == $memo['mm_tujuan'] && $user['user_role'] == 'Direktur'){ ?>
            <button class="btn btn-info btn-block" data-toggle="modal" data-target="#perlu_pertimbangan">Perlu Pertimbangan</button>
            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#approved_d">Approved & Publish</button>
            <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#not_approved">Not Approved</button>
          <?php } ?>
          
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-body">
      <h5 class="text-center"><b>Activity Memo</b></h5>
      <hr>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr align="center">
              <th>#</th>
              <th>Name</th>
              <th>Jabatan</th>
              <th>Date Activity</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>

            <?php 
            $no = 1;
            foreach ($memo_a as $ma): ?>
              <tr align="center">
                <td><?= $no++; ?></td>
                <td><?= $ma['user_name']; ?></td>
                <td><?= $ma['user_role']; ?> <?= $ma['user_bagian']; ?></td>
                <td><?= date('d F Y', $ma['ma_date']); ?></td>
                <td>
                  <?php if ($ma['ma_status'] == 2) {
                    echo "Approved";
                  } else if ($ma['ma_status'] == 3) {
                    echo "Not Approved";
                  } else if ($ma['ma_status'] == 4) {
                    echo "Publish";
                  } ?>
                    
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

<!-- Modal Approved Manager-->
<div class="modal fade" id="approved_m" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newRoleModalLabel">Approved</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('memo/approved_m/'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" id="mm_id" name="mm_id" value="<?= $memo['mm_id']; ?>">
            <input type="hidden" id="mm_tujuan_l" name="mm_tujuan_l" value="<?= $memo['mm_tujuan']; ?>">
            <select class="form-control" id="mm_tujuan" name="mm_tujuan">
              <option>-- Pilih Bagian --</option>
              <?php foreach ($user_role_d as $urd): ?>
                <option value="<?= $urd['user_nik'] ?>"><?= $urd['user_name'] ?> | <?= $urd['user_role'] ?> <?= $urd['user_bagian'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
      </form>
    </div>
  </div>
</div> 

<!-- Modal Approved Direktur-->
<div class="modal fade" id="approved_d" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newRoleModalLabel">Approved & Publish</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="# method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="note" name="note" placeholder="Note">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Publish</button>
        </div>
      </form>
    </div>
  </div>
</div> 

<!-- Modal Not Approved Manager-->
<div class="modal fade" id="not_approved" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newRoleModalLabel">Not Approved</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('memo/not_approved/'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="form-group">
              <input type="hidden" id="mm_id" name="mm_id" value="<?= $memo['mm_id']; ?>">
              <input type="hidden" id="mm_tujuan_l" name="mm_tujuan_l" value="<?= $memo['mm_tujuan']; ?>">
              <input type="text" class="form-control" id="mm_note" name="mm_note" placeholder="Note">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
      </form>
    </div>
  </div>
</div> 

<!-- Modal Pertimbangan-->
<div class="modal fade" id="perlu_pertimbangan" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newRoleModalLabel">Perlu Pertimbangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('memo/pertimbangan/'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" id="mm_id" name="mm_id" value="<?= $memo['mm_id']; ?>">
            <select class="form-control" id="mm_tujuan" name="mm_tujuan">
              <option>-- Pilih Bagian --</option>
              <?php foreach ($user_role_m as $urm): ?>
                <option value="<?= $urm['user_nik'] ?>"><?= $urm['user_name'] ?> | <?= $urm['user_role'] ?> <?= $urm['user_bagian'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
      </form>
    </div>
  </div>
</div> 
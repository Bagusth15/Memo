<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Tambah Memo</h1>

  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <?= form_open_multipart('memo/tambah'); ?>
          <form class="forms-sample">
            <div class="form-group">
              <label for="nik">Memo No</label>
              <input type="text" class="form-control" id="mm_no" name="mm_no" value="">
            </div>
            <div class="form-group">
              <label for="exampleSelectGender">Untuk</label>
              <input type="hidden" id="mm_pengirim" name="mm_pengirim" value="<?= $user['user_nik']; ?>">
              <select class="form-control" id="mm_tujuan" name="mm_tujuan">
                <option>-- Pilih Bagian --</option>
                <?php foreach ($user_role_m as $urm): ?>
                <option value="<?= $urm['user_nik'] ?>"><?= $urm['user_name'] ?> | <?= $urm['user_role'] ?> <?= $urm['user_bagian'] ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label for="name">Perihal</label>
              <input type="text" class="form-control" id="mm_perihal" name="mm_perihal" value="">
            </div>
            <div class="form-group">
              <label for="name">Isi Memo</label>
              <textarea class="ckeditor" id="mm_isi" name="mm_isi"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail3">Note</label>
              <input type="text" class="form-control" id="mm_note" name="mm_note" value="">
            </div>
            
            <button type="submit" class="btn btn-primary mr-1">Tambah</button>
            <button type="reset" class="btn btn-success mr-1">Reset</button>
            <a href="<?= base_url('memo'); ?>" class="btn btn-danger">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php
if(substr($this->session->userdata('id_wilayah'),2,2)=='00') echo form_dropdown('',$this->wilayah_model->arr_all(),$id_wilayah,array('class'=>'form-control','id'=>'pilih_wilayah'));?>

<div class="box box-info">
  <table class="table" id="tabel-user">
    <thead>
      <tr>
        <th style="width:20px">#</th>
        <th>Wilayah</th>
        <th>Instansi</th>
        <th>Username</th>
        <th>Email</th>
        <th style="width:20px"></th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; foreach($this->user_model->all($id_wilayah) as $row){
        echo '<tr key="'.$row->userid.'" role="'.$row->role.'">'.
        '<td>'.($no++).'</td>'.
        '<td>'.$row->id_wilayah.'</td>'.
        '<td>'.$row->instansi.'</td>'.
        '<td>'.$row->username.'</td>'.
        '<td>'.$row->email.'</td>'.
        '<td></td>'.
        '</tr>'."\n";
      } ?>
    </tbody>
  </table>
</div>

<button id='tambah-user' class='btn btn-sm pull-right'><i class="fa fa-plus-circle"></i> Tambah</button>

<div id="myDialog" style="display: none">
  <form method="post" action="<?=base_url('admin/user_save');?>">
  <input type="hidden" name="id_wilayah" value="<?=$id_wilayah;?>">
  <input type="hidden" id="userid" name="userid" value="">
  <div class="row">
    <label>Instansi</label>
    <input id="instansi" name="instansi" class="form-control" required>
  </div>
  <div class="row">
    <label>Role</label>
    <select id="role" name="role" class="form-control" required>
      <option value='1'>OPD</option><option value="2">BPS</option><option value='3'>Diskominfo</option><option value="9">Admin</option>
    </select>
  </div>
  <div class="row">
    <label>Username</label>
    <input id="username" name="username" class="form-control" required placeholder="<?=$id_wilayah;?>_" value="<?=$id_wilayah;?>_">
  </div>
  <div class="row">
    <label>Password</label>
    <input type="password" id="password" name="password" class="form-control" required>
  </div>
  <div class="row">
    <label>Email</label>
    <input type="email" id="email" name="email" class="form-control">
  </div>
  <div class="row">
    <button class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
    <a id="hapus" href="#" class="btn btn-flat btn-sm pull-right"><i class="fa fa-trash"></i></a>
  </div>
  </form>
</div>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/jquery/jquery-ui.css');?>">
<script src="<?=base_url('assets/jquery/jquery-ui.min.js');?>"></script>

<style>
  tr th:first-child, tr th:nth-child(2), tr td:first-child, tr td:nth-child(2) {text-align:center;}
  thead tr th {position:sticky; top:0;}
  div[role=dialog] {font-size:small}
  #myDialog {padding:0 20px}
  #myDialog button {margin-top:10px}
</style>

<script>
var autocomplete_url = '<?=base_url('admin/json_instansi');?>';

$('#tabel-user tbody tr').each(function(){
  $(this).find('td:last-child').html('<a href="#"><i class="fa fa-edit"></i></a>');
});

$('#tabel-user .fa-edit').click(function(e){
  e.preventDefault();
  var tr = $(this).closest('tr'); 

  $('#userid').val(tr.attr('key'));
  $('#role').val(tr.attr('role'));
  $('#instansi').val(tr.find('td:nth-child(3)').text());
  $('#username').val(tr.find('td:nth-child(4)').text());
  $('#email').val(tr.find('td:nth-child(5)').text());

  $('#myDialog').dialog({
    title:'Edit Pengguna',
  });

  $('#myDialog #hapus').show()
    .click(function(e){
      e.preventDefault();
      if(confirm('Hapus pengguna ini?')){
        location.href = '<?=base_url('admin/user_del/');?>'+tr.attr('key');
      }
    });

  $('#instansi').autocomplete({
    source : autocomplete_url
  });

  $('#username').change(function(){
    $('#password').val($(this).val());
  });

});

$('#tambah-user').click(function(){
  $('#myDialog').dialog({
    title:'Tambah Pengguna',
  });
  $('#myDialog #hapus').hide();

  $('#instansi').autocomplete({
    source : autocomplete_url
  });

  $('#username').change(function(){
    $('#password').val($(this).val());
  });

  $('#userid').val('');
  $('#role').val('OPD').change();
  $('#instansi').val('');
  $('#username').val('<?=$id_wilayah;?>_');
  $('#password').val('');
  $('#email').val('');
});

<?php if(substr($this->session->userdata('id_wilayah'),2,2)=='00') { ?>
$('#pilih_wilayah').change(function(){
	location.href = '<?=base_url('admin/user/');?>'+$(this).val();
});
<?php } ?>
</script>
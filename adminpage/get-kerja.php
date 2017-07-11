<?php
	$kerja = $_GET['kerja'];
	if ($kerja==1) {

?>
		<div class="col-md-6 form-group">
			<label class="control-label">Nama Perusahaan</label>
            <input id="perusahaan" class="form-control" type="text" placeholder="Nama Perusahaan" name="perusahaan">
        </div>

        <div class="col-md-6 form-group">
			<label class="control-label">Jabatan</label>
            <input id="jbtn" class="form-control" type="text" placeholder="Jabatan" name="jbtn">
        </div>

		<div class="col-md-6 form-group">
			<label class="control-label">Gaji Pokok</label>
            <input id="gaji" class="form-control" type="number" placeholder="Gaji Pokok" name="gaji">
        </div>

        <div class="col-md-6 form-group">
			<label class="control-label">Total Tunjangan</label>
            <input id="tunjangan" class="form-control" type="number" placeholder="Total Tunjangan" name="tunjangan">
        </div>

        <div class="col-md-6 form-group">
            <label class="control-label">Lama Bekerja</label>
            <input id="lkerja" class="form-control" type="number" placeholder="Lama Bekerja" name="lkerja" style="display: inline-block; width: 89%;">
            <label class="control-label" style="display: inline;">Tahun</label>
        </div>

        <div class="col-md-6 form-group">
			<label class="control-label">FC Slip Gaji</label>
            <input id="fgaji" type="file" placeholder="FC Slip Gaji" name="fgaji">
        </div>
<?php		# code...
	}else if ($kerja==2) {
?>
        <div class="col-md-6 form-group">
            <label class="control-label">Nama Usaha</label>
            <input id="nusaha" class="form-control" type="text" placeholder="Nama Usaha" name="nusaha">
        </div>

        <div class="col-md-6 form-group">
            <label class="control-label" for="selector1">Jenis Usaha</label>
            <select name="j-usaha" class="form-control" id="j-usaha">
                <option value="1">Produksi</option>
                <option value="2">Transportasi</option>
                <option value="3">Jual-Beli</option>
            </select>
        </div>

        <div class="col-md-6 form-group">
            <label class="control-label">Keuntungan Perbulan</label>
            <input id="untung" class="form-control" type="number" placeholder="Untung" name="untung">
        </div>

        <div class="col-md-6 form-group">
            <label class="control-label">Jumlah Karyawan</label>
            <input id="karyawan" class="form-control" type="number" placeholder="Jumlah Karyawan" name="karyawan">
        </div>

        <div class="col-md-6 form-group">
            <label class="control-label">FC SPT PPH 21</label>
            <input id="fpajak" type="file" placeholder="FC SPT PPH 21" name="fpajak">
        </div>

        <div class="col-md-6 form-group">
            <label class="control-label">FC Rek. Tabungan/Rek. Koran</label>
            <input id="fpenghasilan" type="file" placeholder="FC Rek. Tabungan/Rek. Koran" name="fpenghasilan">
        </div>
<?php		
	}else{
?>
        <div class="col-md-6 form-group">
            <label class="control-label">Nama Instansi</label>
            <input id="perusahaan" class="form-control" type="text" placeholder="Nama Perusahaan" name="perusahaan">
        </div>

        <div class="col-md-6 form-group">
            <label class="control-label">Jabatan</label>
            <input id="jbtn" class="form-control" type="text" placeholder="Jabatan" name="jbtn">
        </div>

        <div class="col-md-6 form-group">
            <label class="control-label">Gaji Pokok</label>
            <input id="gaji" class="form-control" type="number" placeholder="Gaji Pokok" name="gaji">
        </div>
        
        <div class="col-md-6 form-group">
            <label class="control-label">Total Tunjangan</label>
            <input id="tunjangan" class="form-control" type="number" placeholder="Total Tunjangan" name="tunjangan">
        </div>

        <div class="col-md-6 form-group">
            <label class="control-label">Lama Bekerja</label>
            <input id="lkerja" class="form-control" type="number" placeholder="Lama Bekerja" name="lkerja" style="display: inline-block; width: 89%;">
            <label class="control-label" style="display: inline;">Tahun</label>
        </div>

        <div class="col-md-6 form-group">
            <label class="control-label">FC Slip Gaji</label>
            <input id="fgaji" type="file" placeholder="FC Slip Gaji" name="fgaji">
        </div>
<?php
    }
?>
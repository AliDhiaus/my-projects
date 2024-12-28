<template>
    <h1><router-link to="penyiar" class="linkBar"><img src="image/back.png" class="imgBack"></router-link> Tambah Penyiar</h1>
    <form action="inputData" class="boxInputData">
        <div class="form-group">
            <label for="kodeNRP">Kode NRP</label><span>:</span>
            <input type="text" class="form-control" id="kodeNRP" placeholder="Masukkan Kode NRP">
        </div>
        <div class="form-group">
            <label for="namaLengkap">Nama Lengkap:</label><span>:</span>
            <input type="text" class="form-control" id="namaLengkap" placeholder="Masukkan Nama Lengkap">
        </div>
        <div class="form-group">
            <label for="jabatan">Jabatan:</label><span>:</span>
            <input type="text" class="form-control" id="jabatan" placeholder="Masukkan Jabatan">
        </div>
        <div class="form-group">
            <label for="tugas">Tugas:</label><span>:</span>
            <input type="text" class="form-control" id="tugas" placeholder="Masukkan Tugas">
        </div>
        <div class="boxBtn">
            <button type="submit" class="btn">Submit</button>
        </div>
    </form>
</template>
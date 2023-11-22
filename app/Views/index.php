<?php $this->extend('tamplate/user'); ?>
<?php $this->section('content'); ?>
<section class="pt-36 pb-36">
    <div class="container grid w-full lg:w-1/2 bg-white shadow-lg rounded-md p-4">
        <h2 class="text-lg font-semibold mb-6 place-self-center">Surat Lamaran Kerja</h2>
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('pesanmerah')) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo session()->getFlashdata('pesanmerah'); ?>
            </div>
        <?php endif; ?>
        <form action="/Home/generatePDF" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <h2 class="text-md mb-2 ml-2 text-gray-500">Role</h2>
                <input type="text" name="role" class="form-control rounded <?= ($validation->hasError('role')) ? 'is-invalid' : '' ?>" placeholder="Role..">
                <div class="invalid-feedback ml-2">
                    <?php echo $validation->getError('role'); ?>
                </div>
            </div>
            <div class="mb-6">
                <h2 class="text-md mb-2 ml-2 text-gray-500">Perusahaan yang dituju</h2>
                <input type="text" name="perusahaan" class="form-control rounded <?= ($validation->hasError('perusahaan')) ? 'is-invalid' : '' ?>" placeholder="Perusahaan yang dituju..">
                <div class="invalid-feedback ml-2">
                    <?php echo $validation->getError('perusahaan'); ?>
                </div>
            </div>
            <div class="flex justify-center">
                <button class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none ">
                    Kirim
                </button>
                <a href="<?= base_url('/mahasiswa') ?>" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none ">
                    Kembali
                </a>
            </div>
        </form>
    </div>

</section>
<script>
    // Inisialisasi Flatpickr
    flatpickr("#tanggal", {
        // Opsi-opsi konfigurasi datepicker di sini
        dateFormat: "d F Y", // Contoh: Format tanggal YYYY-MM-DD
        locale: "id",
    });
</script>
<?php $this->endSection(); ?>
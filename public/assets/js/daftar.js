(function ($) {
  var form = $("#signup-form");

  form.steps({
    headerTag: "h3",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    labels: {
      previous: "Sebelumnya",
      next: "Selanjutnya",
      finish: "Kirim",
      current: "",
    },
    titleTemplate: '<h3 class="title">#title#</h3>',
    onStepChanging: function (event, currentIndex, newIndex) {
      if (newIndex > currentIndex) {
        return form.valid();
      }
      return true;
    },
    onFinished: function (event, currentIndex) {
      if (form.valid()) {
        form.submit();
      } else {
        form.find(":input.error:first").focus();
      }
    },
  });

  form.validate({
    rules: {
      nama_depan: "required",
      nama_belakang: "required",
      nisn: {
        required: true,
        digits: true
      },
      nik: {
        required: true,
        digits: true
      },
      no_kk: {
        required: true,
        digits: true
      },
      jenis_kelamin: "required",
      agama: "required",
      tanggal_lahir: "required",
      tempat_lahir: "required",
      asal_sekolah: "required",
      nama_ayah: "required",
      id_pekerjaan_ayah: "required",
      no_telp_ayah: {
        required: true,
        digits: true
      },
      nama_ibu: "required",
      id_pekerjaan_ibu: "required",
      no_telp_ibu: {
        required: true,
        digits: true
      },
      rapor_semester_9: {
        required: true
      },
      rapor_semester_10: {
        required: true
      },
      rapor_semester_11: {
        required: true
      },
      sertifikat_tpq: {
        required: true
      },
      foto: {
        required: true
      },
      nilai_mtk_5_1: {
        required: true,
        number: true
      },
      nilai_ipa_5_1: {
        required: true,
        number: true
      },
      nilai_bi_5_1: {
        required: true,
        number: true
      },
      nilai_mtk_5_2: {
        required: true,
        number: true
      },
      nilai_ipa_5_2: {
        required: true,
        number: true
      },
      nilai_bi_5_2: {
        required: true,
        number: true
      },
      nilai_mtk_6_1: {
        required: true,
        number: true
      },
      nilai_ipa_6_1: {
        required: true,
        number: true
      },
      nilai_bi_6_1: {
        required: true,
        number: true
      },
    },
    messages: {
      nama_depan: {
        required: "Silakan masukkan nama depan Anda"
      },
      nama_belakang: {
        required: "Silakan masukkan nama belakang Anda"
      },
      nisn: {
        required: "Silakan masukkan NISN Anda",
        digits: "Silakan masukkan hanya angka"
      },
      nik: {
        required: "Silakan masukkan NIK Anda",
        digits: "Silakan masukkan hanya angka"
      },
      no_kk: {
        required: "Silakan masukkan nomor KK Anda",
        digits: "Silakan masukkan hanya angka"
      },
      jenis_kelamin: "Silakan pilih jenis kelamin Anda",
      agama: "Silakan pilih agama Anda",
      tanggal_lahir: "Silakan masukkan tanggal lahir Anda",
      tempat_lahir: "Silakan masukkan tempat lahir Anda",
      asal_sekolah: "Silakan masukkan nama sekolah asal Anda",
      nama_ayah: "Silakan masukkan nama ayah Anda",
      id_pekerjaan_ayah: "Silakan pilih pekerjaan ayah Anda",
      no_telp_ayah: {
        required: "Silakan masukkan nomor telepon ayah Anda",
        digits: "Silakan masukkan nomor telepon yang valid"
      },
      nama_ibu: "Silakan masukkan nama ibu Anda",
      id_pekerjaan_ibu: "Silakan pilih pekerjaan ibu Anda",
      no_telp_ibu: {
        required: "Silakan masukkan nomor telepon ibu Anda",
        digits: "Silakan masukkan nomor telepon yang valid"
      },
      rapor_semester_9: {
        required: "Silakan unggah rapor Semester 9 Anda"
      },
      rapor_semester_10: {
        required: "Silakan unggah rapor Semester 10 Anda"
      },
      rapor_semester_11: {
        required: "Silakan unggah rapor Semester 11 Anda"
      },
      sertifikat_tpq: {
        required: "Silakan unggah sertifikat TPQ Anda"
      },
      foto: {
        required: "Silakan unggah foto Anda"
      },
      nilai_mtk_5_1: {
        required: "Silakan masukkan nilai Matematika Kelas 5 Semester 1",
        digits: "Silakan masukkan hanya angka"
      },
      nilai_ipa_5_1: {
        required: "Silakan masukkan nilai IPA Kelas 5 Semester 1",
        digits: "Silakan masukkan hanya angka"
      },
      nilai_bi_5_1: {
        required: "Silakan masukkan nilai Bahasa Indonesia Kelas 5 Semester 1",
        digits: "Silakan masukkan hanya angka"
      },
      nilai_mtk_5_2: {
        required: "Silakan masukkan nilai Matematika Kelas 5 Semester 2",
        digits: "Silakan masukkan hanya angka"
      },
      nilai_ipa_5_2: {
        required: "Silakan masukkan nilai IPA Kelas 5 Semester 2",
        digits: "Silakan masukkan hanya angka"
      },
      nilai_bi_5_2: {
        required: "Silakan masukkan nilai Bahasa Indonesia Kelas 5 Semester 2",
        digits: "Silakan masukkan hanya angka"
      },
      nilai_mtk_6_1: {
        required: "Silakan masukkan nilai Matematika Kelas 6 Semester 1",
        digits: "Silakan masukkan hanya angka"
      },
      nilai_ipa_6_1: {
        required: "Silakan masukkan nilai IPA Kelas 6 Semester 1",
        digits: "Silakan masukkan hanya angka"
      },
      nilai_bi_6_1: {
        required: "Silakan masukkan nilai Bahasa Indonesia Kelas 6 Semester 1",
        digits: "Silakan masukkan hanya angka"
      },

    },
    invalidHandler: function (event, validator) {
      var errors = validator.numberOfInvalids();
      if (errors) {
        var firstInvalidElement = $(validator.errorList[0].element);
        firstInvalidElement.focus();
      }
    },
  });
})(jQuery);

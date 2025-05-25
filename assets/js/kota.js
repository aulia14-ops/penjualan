document.addEventListener("DOMContentLoaded", function () {
    const kotaOptions = { 
        "Banten": ["Cilegon", "Serang", "Tangerang", "Tangerang Selatan", "Pandeglang", "Lebak"],
        "Jawa Barat": ["Bandung", "Banjar", "Bekasi", "Bogor", "Cimahi", "Cirebon", "Depok", "Sukabumi", "Tasikmalaya"],
        "DKI Jakarta": ["Jakarta Barat", "Jakarta Pusat", "Jakarta Selatan", "Jakarta Timur", "Jakarta Utara", "Kepulauan Seribu"],
        "DI Yogyakarta": ["Yogyakarta", "Bantul", "Gunung Kidul", "Kulon Progo", "Sleman"],
        "Jawa Tengah": ["Magelang", "Pekalongan", "Salatiga", "Semarang", "Surakarta", "Tegal", "Banjarnegara", "Batang","Banyumas", "Blora", "Boyolali", "Brebes", "Cilacap", "Demak", "Grobogan", "Jepara", "Karanganyar", "Kebumen", "Kendal", "Klaten", "Kudus", "Pati", "Pemalang", "Purbalingga", "Purworejo", "Rembang", "Sragen", "Sukoharjo", "Temanggung", "Wonogiri", "Wonosobo"],
        "Jawa Timur": ["Batu", "Blitar", "Kediri", "Madiun", "Malang", "Bangkalan", "Banyuwangi", "Bojonegoro", "Bondowoso", "Gresik", "Jember", "Jombang", "Lamongan", "Lumajang", "Magetan", "Mojokerto", "Nganjuk", "Ngawi", "Pacitan", "Pamekasan", "Pasuruan", "Ponorogo", "Probolinggo", "Sampang", "Sidoarjo", "Sumenep", "Trenggalek", "Tuban", "Tulungagung"]
    };

    const provinsiSelect = document.getElementById("provinsi");
    const kotaSelect = document.getElementById("kota");

    provinsiSelect.addEventListener("change", function () {
        const selectedProvinsi = this.value;
        const cities = kotaOptions[selectedProvinsi] || [];

        // Kosongkan dropdown kota
        kotaSelect.innerHTML = '<option value="">- Pilih Kota/Kabupaten -</option>';

        // Tambahkan kota sesuai provinsi
        cities.forEach(function (city) {
            const option = document.createElement("option");
            option.value = city;
            option.textContent = city;
            kotaSelect.appendChild(option);
        });
    });

    // Ambil ongkir setelah kota dipilih
    kotaSelect.addEventListener("change", function () {
        const selectedKota = this.value;

        if (selectedKota) {
            fetch(`/user/get_ongkir?kota=${selectedKota}`)
                .then(response => response.json())
                .then(data => {
                    if (data.ongkir !== undefined) {
                        document.getElementById("ongkir").textContent = `Rp ${data.ongkir.toLocaleString()}`;
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
});

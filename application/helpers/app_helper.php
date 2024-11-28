<?php 

function level($level)
{
	return isset($_SESSION[$level]) || !empty($_SESSION[$level]) ? true : false;
}

function getLevel()
{
	if (isset($_SESSION['admin']) || !empty($_SESSION['admin'])) {
		return 'admin';
	}
	else if (isset($_SESSION['member']) || !empty($_SESSION['member'])) {
		return 'member';
	}
	else {
		return '';
	}
}

function pengaturan($pengaturan_nama)
{
	$CI =& get_instance();
	$CI->db->where('pengaturan_nama', $pengaturan_nama);
	$pengaturan = $CI->db->get('pengaturan')->row_array();

	return $pengaturan['pengaturan_isi'];
}

function tanggal_indo($input="")
{
	if (empty($input) || $input == '0000-00-00 00:00:00') 
	{
		return "-";
	}
	else
	{
		$date = explode('-', substr($input, 0, 10));

		$tahun		= $date[0];
		$bulan		= $date[1];
		$tanggal	= $date[2];

		$array_bulan["1"]	= "Jan";
		$array_bulan["01"]	= "Jan";
		$array_bulan["2"]	= "Feb";
		$array_bulan["02"]	= "Feb";
		$array_bulan["3"]	= "Mar";
		$array_bulan["03"]	= "Mar";
		$array_bulan["4"]	= "Apr";
		$array_bulan["04"]	= "Apr";
		$array_bulan["5"]	= "Mei";
		$array_bulan["05"]	= "Mei";
		$array_bulan["6"]	= "Jun";
		$array_bulan["06"]	= "Jun";
		$array_bulan["7"]	= "Jul";
		$array_bulan["07"]	= "Jul";
		$array_bulan["8"]	= "Agu";
		$array_bulan["08"]	= "Agu";
		$array_bulan["9"]	= "Sep";
		$array_bulan["09"]	= "Sep";
		$array_bulan["10"]	= "Okt";
		$array_bulan["11"]	= "Nov";
		$array_bulan["12"]	= "Des";

		return $tanggal.'-'.$array_bulan[$bulan].'-'.$tahun;
	}
}

function bulan_indo($bulan = 0)
{
	$array_bulan["0"]	= "";
	$array_bulan["1"]	= "Januari";
	$array_bulan["01"]	= "Januari";
	$array_bulan["2"]	= "Februari";
	$array_bulan["02"]	= "Februari";
	$array_bulan["3"]	= "Maret";
	$array_bulan["03"]	= "Maret";
	$array_bulan["4"]	= "April";
	$array_bulan["04"]	= "April";
	$array_bulan["5"]	= "Mei";
	$array_bulan["05"]	= "Mei";
	$array_bulan["6"]	= "Juni";
	$array_bulan["06"]	= "Juni";
	$array_bulan["7"]	= "Juli";
	$array_bulan["07"]	= "Juli";
	$array_bulan["8"]	= "Agustus";
	$array_bulan["08"]	= "Agustus";
	$array_bulan["9"]	= "September";
	$array_bulan["09"]	= "September";
	$array_bulan["10"]	= "Oktober";
	$array_bulan["11"]	= "November";
	$array_bulan["12"]	= "Desember";

	return $array_bulan[$bulan];
}

function kota()
{
	$data = [
		'Prov. Aceh' => [ 'Kab. Aceh Barat', 'Kab. Aceh Barat Daya', 'Kab. Aceh Besar', 'Kab. Aceh Jaya', 'Kab. Aceh Selatan', 'Kab. Aceh Singkil', 'Kab. Aceh Tamiang', 'Kab. Aceh Tengah', 'Kab. Aceh Tenggara', 'Kab. Aceh Timur', 'Kab. Aceh Utara', 'Kab. Bener Meriah', 'Kab. Bireuen', 'Kab. Gayo Lues', 'Kab. Nagan Raya', 'Kab. Pidie', 'Kab. Pidie Jaya', 'Kab. Simeulue', 'Kota Banda Aceh', 'Kota Langsa', 'Kota Lhokseumawe', 'Kota Sabang', 'Kota Subulussalam', ],
		'Prov. Sumatera Utara' => [ 'Kab. Asahan', 'Kab. Batubara', 'Kab. Dairi', 'Kab. Deli Serdang', 'Kab. Humbang Hasundutan', 'Kab. Karo', 'Kab. Labuhanbatu', 'Kab. Labuhanbatu Selatan', 'Kab. Labuhanbatu Utara', 'Kab. Langkat', 'Kab. Mandailing Natal', 'Kab. Nias', 'Kab. Nias Barat', 'Kab. Nias Selatan', 'Kab. Nias Utara', 'Kab. Padang Lawas', 'Kab. Padang Lawas Utara', 'Kab. Pakpak Bharat', 'Kab. Samosir', 'Kab. Serdang Bedagai', 'Kab. Simalungun', 'Kab. Tapanuli Selatan', 'Kab. Tapanuli Tengah', 'Kab. Tapanuli Utara', 'Kab. Toba Samosir', 'Kota Binjai', 'Kota Gunungsitoli', 'Kota Medan', 'Kota Padangsidempuan', 'Kota Pematangsiantar', 'Kota Sibolga', 'Kota Tanjungbalai', 'Kota Tebing Tinggi', ],
		'Prov. Sumatera Barat' => [ 'Kab. Agam', 'Kab. Dharmasraya', 'Kab. Kepulauan Mentawai', 'Kab. Lima Puluh Kota', 'Kab. Padang Pariaman', 'Kab. Pasaman', 'Kab. Pasaman Barat', 'Kab. Pesisir Selatan', 'Kab. Sijunjung', 'Kab. Solok', 'Kab. Solok Selatan', 'Kab. Tanah Datar', 'Kota Bukittinggi', 'Kota Padang', 'Kota Padangpanjang', 'Kota Pariaman', 'Kota Payakumbuh', 'Kota Sawahlunto', 'Kota Solok', ],
		'Prov. Riau' => [ 'Kab. Bengkalis', 'Kab. Indragiri Hilir', 'Kab. Indragiri Hulu', 'Kab. Kampar', 'Kab. Kepulauan Meranti', 'Kab. Kuantan Singingi', 'Kab. Pelalawan', 'Kab. Rokan Hilir', 'Kab. Rokan Hulu', 'Kab. Siak', 'Kota Dumai', 'Kota Pekanbaru', ],
		'Prov. Jambi' => [ 'Kab. Batanghari', 'Kab. Bungo', 'Kab. Kerinci', 'Kab. Merangin', 'Kab. Muaro Jambi', 'Kab. Sarolangun', 'Kab. Tanjung Jabung Barat', 'Kab. Tanjung Jabung Timur', 'Kab. Tebo', 'Kota Jambi', 'Kota Sungai Penuh', ],
		'Prov. Sumatera Selatan' => [ 'Kab. Banyuasin', 'Kab. Empat Lawang', 'Kab. Lahat', 'Kab. Muara Enim', 'Kab. Musi Banyuasin', 'Kab. Musi Rawas', 'Kab. Musi Rawas Utara', 'Kab. Ogan Ilir', 'Kab. Ogan Komering Ilir', 'Kab. Ogan Komering Ulu', 'Kab. Ogan Komering Ulu Selatan', 'Kab. Ogan Komering Ulu Timur', 'Kab. Penukal Abab Lematang Ilir', 'Kota Lubuklinggau', 'Kota Pagar Alam', 'Kota Palembang', 'Kota Prabumulih', ],
		'Prov. Bengkulu' => [ 'Kab. Bengkulu Selatan', 'Kab. Bengkulu Tengah', 'Kab. Bengkulu Utara', 'Kab. Kaur', 'Kab. Kepahiang', 'Kab. Lebong', 'Kab. Mukomuko', 'Kab. Rejang Lebong', 'Kab. Seluma', 'Kota Bengkulu', ],
		'Prov. Lampung' => [ 'Kab. Lampung Tengah', 'Kab. Lampung Utara', 'Kab. Lampung Selatan', 'Kab. Lampung Barat', 'Kab. Lampung Timur', 'Kab. Mesuji', 'Kab. Pesawaran', 'Kab. Pesisir Barat', 'Kab. Pringsewu', 'Kab. Tulang Bawang', 'Kab. Tulang Bawang Barat', 'Kab. Tanggamus', 'Kab. Way Kanan', 'Kota Bandar Lampung', 'Kota Metro', ],
		'Prov. Kepulauan Riau' => [ 'Kab. Bintan', 'Kab. Karimun', 'Kab. Kepulauan Anambas', 'Kab. Lingga', 'Kab. Natuna', 'Kota Batam', 'Kota Tanjung Pinang', ],
		'Prov. Kepulauan Bangka Belitung' => [ 'Kab. Bangka', 'Kab. Bangka Barat', 'Kab. Bangka Selatan', 'Kab. Bangka Tengah', 'Kab. Belitung', 'Kab. Belitung Timur', 'Kota Pangkal Pinang', ],
		'Prov. DKI Jakarta' => [ 'Kota Jakarta Barat', 'Kota Jakarta Pusat', 'Kota Jakarta Selatan', 'Kota Jakarta Timur', 'Kota Jakarta Utara', 'Kab. Kepulauan Seribu', ],
		'Prov. Jawa Barat' => [ 'Kab. Bandung', 'Kab. Bandung Barat', 'Kab. Bekasi', 'Kab. Bogor', 'Kab. Ciamis', 'Kab. Cianjur', 'Kab. Cirebon', 'Kab. Garut', 'Kab. Indramayu', 'Kab. Karawang', 'Kab. Kuningan', 'Kab. Majalengka', 'Kab. Pangandaran', 'Kab. Purwakarta', 'Kab. Subang', 'Kab. Sukabumi', 'Kab. Sumedang', 'Kab. Tasikmalaya', 'Kota Bandung', 'Kota Banjar', 'Kota Bekasi', 'Kota Bogor', 'Kota Cimahi', 'Kota Cirebon', 'Kota Depok', 'Kota Sukabumi', 'Kota Tasikmalaya', ],
		'Prov. Jawa Tengah' => [ 'Kab. Banjarnegara', 'Kab. Banyumas', 'Kab. Batang', 'Kab. Blora', 'Kab. Boyolali', 'Kab. Brebes', 'Kab. Cilacap', 'Kab. Demak', 'Kab. Grobogan', 'Kab. Jepara', 'Kab. Karanganyar', 'Kab. Kebumen', 'Kab. Kendal', 'Kab. Klaten', 'Kab. Kudus', 'Kab. Magelang', 'Kab. Pati', 'Kab. Pekalongan', 'Kab. Pemalang', 'Kab. Purbalingga', 'Kab. Purworejo', 'Kab. Rembang', 'Kab. Semarang', 'Kab. Sragen', 'Kab. Sukoharjo', 'Kab. Tegal', 'Kab. Temanggung', 'Kab. Wonogiri', 'Kab. Wonosobo', 'Kota Magelang', 'Kota Pekalongan', 'Kota Salatiga', 'Kota Semarang', 'Kota Surakarta', 'Kota Tegal', ],
		'Prov. Daerah Istimewa Yogyakarta' => [ 'Kab. Bantul', 'Kab. Gunungkidul', 'Kab. Kulon Progo', 'Kab. Sleman', 'Kota Yogyakarta', ],
		'Prov. Jawa Timur' => [ 'Kab. Bangkalan', 'Kab. Banyuwangi', 'Kab. Blitar', 'Kab. Bojonegoro', 'Kab. Bondowoso', 'Kab. Gresik', 'Kab. Jember', 'Kab. Jombang', 'Kab. Kediri', 'Kab. Lamongan', 'Kab. Lumajang', 'Kab. Madiun', 'Kab. Magetan', 'Kab. Malang', 'Kab. Mojokerto', 'Kab. Nganjuk', 'Kab. Ngawi', 'Kab. Pacitan', 'Kab. Pamekasan', 'Kab. Pasuruan', 'Kab. Ponorogo', 'Kab. Probolinggo', 'Kab. Sampang', 'Kab. Sidoarjo', 'Kab. Situbondo', 'Kab. Sumenep', 'Kab. Trenggalek', 'Kab. Tuban', 'Kab. Tulungagung', 'Kota Batu', 'Kota Blitar', 'Kota Kediri', 'Kota Madiun', 'Kota Malang', 'Kota Mojokerto', 'Kota Pasuruan', 'Kota Probolinggo', 'Kota Surabaya', ],
		'Prov. Banten' => [ 'Kab. Lebak', 'Kab. Pandeglang', 'Kab. Serang', 'Kab. Tangerang', 'Kota Cilegon', 'Kota Serang', 'Kota Tangerang', 'Kota Tangerang Selatan', ],
		'Prov. Bali' => [ 'Kab. Badung', 'Kab. Bangli', 'Kab. Buleleng', 'Kab. Gianyar', 'Kab. Jembrana', 'Kab. Karangasem', 'Kab. Klungkung', 'Kab. Tabanan', 'Kota Denpasar', ],
		'Prov. Nusa Tenggara Barat' => [ 'Kab. Bima', 'Kab. Dompu', 'Kab. Lombok Barat', 'Kab. Lombok Tengah', 'Kab. Lombok Timur', 'Kab. Lombok Utara', 'Kab. Sumbawa', 'Kab. Sumbawa Barat', 'Kota Bima', 'Kota Mataram', ],
		'Prov. Nusa Tenggara Timur' => [ 'Kab. Alor', 'Kab. Belu', 'Kab. Ende', 'Kab. Flores Timur', 'Kab. Kupang', 'Kab. Lembata', 'Kab. Malaka', 'Kab. Manggarai', 'Kab. Manggarai Barat', 'Kab. Manggarai Timur', 'Kab. Ngada', 'Kab. Nagekeo', 'Kab. Rote Ndao', 'Kab. Sabu Raijua', 'Kab. Sikka', 'Kab. Sumba Barat', 'Kab. Sumba Barat Daya', 'Kab. Sumba Tengah', 'Kab. Sumba Timur', 'Kab. Timor Tengah Selatan', 'Kab. Timor Tengah Utara', 'Kota Kupang', ],
		'Prov. Kalimantan Barat' => [ 'Kab. Bengkayang', 'Kab. Kapuas Hulu', 'Kab. Kayong Utara', 'Kab. Ketapang', 'Kab. Kubu Raya', 'Kab. Landak', 'Kab. Melawi', 'Kab. Mempawah', 'Kab. Sambas', 'Kab. Sanggau', 'Kab. Sekadau', 'Kab. Sintang', 'Kota Pontianak', 'Kota Singkawang', ],
		'Prov. Kalimantan Tengah' => [ 'Kab. Barito Selatan', 'Kab. Barito Timur', 'Kab. Barito Utara', 'Kab. Gunung Mas', 'Kab. Kapuas', 'Kab. Katingan', 'Kab. Kotawaringin Barat', 'Kab. Kotawaringin Timur', 'Kab. Lamandau', 'Kab. Murung Raya', 'Kab. Pulang Pisau', 'Kab. Sukamara', 'Kab. Seruyan', 'Kota Palangka Raya', ],
		'Prov. Kalimantan Selatan' => [ 'Kab. Balangan', 'Kab. Banjar', 'Kab. Barito Kuala', 'Kab. Hulu Sungai Selatan', 'Kab. Hulu Sungai Tengah', 'Kab. Hulu Sungai Utara', 'Kab. Kotabaru', 'Kab. Tabalong', 'Kab. Tanah Bumbu', 'Kab. Tanah Laut', 'Kab. Tapin', 'Kota Banjarbaru', 'Kota Banjarmasin', ],
		'Prov. Kalimantan Timur' => [ 'Kab. Berau', 'Kab. Kutai Barat', 'Kab. Kutai Kartanegara', 'Kab. Kutai Timur', 'Kab. Mahakam Ulu', 'Kab. Paser', 'Kab. Penajam Paser Utara', 'Kota Balikpapan', 'Kota Bontang', 'Kota Samarinda', ],
		'Prov. Kalimantan Utara' => [ 'Kab. Bulungan', 'Kab. Malinau', 'Kab. Nunukan', 'Kab. Tana Tidung', 'Kota Tarakan', ],
		'Prov. Sulawesi Utara' => [ 'Kab. Bolaang Mongondow', 'Kab. Bolaang Mongondow Selatan', 'Kab. Bolaang Mongondow Timur', 'Kab. Bolaang Mongondow Utara', 'Kab. Kepulauan Sangihe', 'Kab. Kepulauan Siau Tagulandang Biaro', 'Kab. Kepulauan Talaud', 'Kab. Minahasa', 'Kab. Minahasa Selatan', 'Kab. Minahasa Tenggara', 'Kab. Minahasa Utara', 'Kota Bitung', 'Kota Kotamobagu', 'Kota Manado', 'Kota Tomohon', ],
		'Prov. Sulawesi Tengah' => [ 'Kab. Banggai', 'Kab. Banggai Kepulauan', 'Kab. Banggai Laut', 'Kab. Buol', 'Kab. Donggala', 'Kab. Morowali', 'Kab. Morowali Utara', 'Kab. Parigi Moutong', 'Kab. Poso', 'Kab. Sigi', 'Kab. Tojo Una-Una', 'Kab. Toli-Toli', 'Kota Palu', ],
		'Prov. Sulawesi Selatan' => [ 'Kab. Bantaeng', 'Kab. Barru', 'Kab. Bone', 'Kab. Bulukumba', 'Kab. Enrekang', 'Kab. Gowa', 'Kab. Jeneponto', 'Kab. Kepulauan Selayar', 'Kab. Luwu', 'Kab. Luwu Timur', 'Kab. Luwu Utara', 'Kab. Maros', 'Kab. Pangkajene dan Kepulauan', 'Kab. Pinrang', 'Kab. Sidenreng Rappang', 'Kab. Sinjai', 'Kab. Soppeng', 'Kab. Takalar', 'Kab. Tana Toraja', 'Kab. Toraja Utara', 'Kab. Wajo', 'Kota Makassar', 'Kota Palopo', 'Kota Parepare', ],
		'Prov. Sulawesi Tenggara' => [ 'Kab. Bombana', 'Kab. Buton', 'Kab. Buton Selatan', 'Kab. Buton Tengah', 'Kab. Buton Utara', 'Kab. Kolaka', 'Kab. Kolaka Timur', 'Kab. Kolaka Utara', 'Kab. Konawe', 'Kab. Konawe Kepulauan', 'Kab. Konawe Selatan', 'Kab. Konawe Utara', 'Kab. Muna', 'Kab. Muna Barat', 'Kab. Wakatobi', 'Kota Bau-Bau', 'Kota Kendari', ],
		'Prov. Gorontalo' => [ 'Kab. Boalemo', 'Kab. Bone Bolango', 'Kab. Gorontalo', 'Kab. Gorontalo Utara', 'Kab. Pohuwato', 'Kota Gorontalo', ],
		'Prov. Sulawesi Barat' => [ 'Kab. Majene', 'Kab. Mamasa', 'Kab. Mamuju', 'Kab. Mamuju Tengah', 'Kab. Pasangkayu', 'Kab. Polewali Mandar', ],
		'Prov. Maluku' => [ 'Kab. Buru', 'Kab. Buru Selatan', 'Kab. Kepulauan Aru', 'Kab. Maluku Barat Daya', 'Kab. Maluku Tengah', 'Kab. Maluku Tenggara', 'Kab. Maluku Tenggara Barat', 'Kab. Seram Bagian Barat', 'Kab. Seram Bagian Timur', 'Kota Ambon', 'Kota Tual', ],
		'Prov. Maluku Utara' => [ 'Kab. Halmahera Barat', 'Kab. Halmahera Tengah', 'Kab. Halmahera Utara', 'Kab. Halmahera Selatan', 'Kab. Kepulauan Sula', 'Kab. Halmahera Timur', 'Kab. Pulau Morotai', 'Kab. Pulau Taliabu', 'Kota Ternate', 'Kota Tidore Kepulauan', ],
		'Prov. Papua' => [ 'Kab. Biak Numfor', 'Kab. Jayapura', 'Kab. Keerom', 'Kab. Kepulauan Yapen', 'Kab. Mamberamo Raya', 'Kab. Sarmi', 'Kab. Supiori', 'Kab. Waropen', 'Kota Jayapura', ],
		'Prov. Papua Barat' => [ 'Kab. Fakfak', 'Kab. Kaimana', 'Kab. Manokwari', 'Kab. Manokwari Selatan', 'Kab. Pegunungan Arfak', 'Kab. Teluk Bintuni', 'Kab. Teluk Wondama', ],
		'Prov. Papua Selatan' => [ 'Kab. Asmat', 'Kab. Boven Digoel', 'Kab. Mappi', 'Kab. Merauke', ],
		'Prov. Papua Tengah' => [ 'Kab. Deiyai', 'Kab. Dogiyai', 'Kab. Intan Jaya', 'Kab. Mimika', 'Kab. Nabire', 'Kab. Paniai', 'Kab. Puncak', 'Kab. Puncak Jaya', ],
		'Prov. Papua Pegunungan' => [ 'Kab. Jayawijaya', 'Kab. Lanny Jaya', 'Kab. Mamberamo Tengah', 'Kab. Nduga', 'Kab. Pegunungan Bintang', 'Kab. Tolikara', 'Kab. Yalimo', 'Kab. Yahukimo', ],
		'Prov. Papua Barat Daya' => [ 'Kab. Maybrat', 'Kab. Raja Ampat', 'Kab. Sorong', 'Kab. Sorong Selatan', 'Kab. Tambrauw', 'Kota Sorong',  ],
	];

	return $data;
}
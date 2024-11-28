<div class="row">

    <!-- Left side columns -->
    <div class="col-lg-8">
        <div class="row">

		<div class="col-xxl-4 col-md-6">
        <div class="card info-card weather-card">

            <div class="card-body">
                <h5 class="card-title">Cuaca Jakarta</h5>

                <div class="d-flex align-items-center">
				<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <!-- Ikon cuaca -->
                    <img id="weather-icon" src="" alt="Weather Icon" style="width: 50px; height: 50px;">
                </div>
                    <div class="ps-3">
                        <!-- Menampilkan data cuaca -->
                        <h6 id="weather-temp">--°C</h6>
                        <span id="weather-desc" class="text-muted small pt-2">Loading...</span>
                        <br>
                        <span id="weather-humidity" class="text-muted small pt-2">Humidity: --%</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
	<!-- End Weather Data Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">

                    <div class="card-body">
                        <h5 class="card-title">Data pelanggan</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-clipboard-x-fill"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?php echo $total_pelanggan['data_pelanggan']?></h6>
                                <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- End Revenue Card -->

        </div>
    </div><!-- End Left side columns -->

    <!-- Right side columns -->
</div>
<script>
$(document).ready(function() {
	get_data();	
});

	function get_data(){
			$.ajax({
		    	url: "https://api.openweathermap.org/data/2.5/weather?lat=-6.175110&lon=106.865036&appid=6bf4bc0ae3697ba551da858ac145ea37",
		    	type: 'GET',
	    		"content_type": 'application/json',
	    		success: function(res) {
						$('#weather-temp').text(res.main.temp + '°C');
						$('#weather-desc').text(res.weather[0].description);
						$('#weather-humidity').text('Humidity: ' + res.main.humidity + '%');
						// Tampilkan ikon cuaca
						let iconUrl = "https://openweathermap.org/img/wn/" + res.weather[0].icon + "@2x.png";
            			$('#weather-icon').attr('src', iconUrl);
					},
					error: function(err) {
						console.error('Error:', err);
					}
				});
	}

</script>


<div class="loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer">
                <div class="circle-clipper float-left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper float-right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>

<!-- loader js -->
<script type="text/javascript">
	$(document).ready(function(){
		setTimeout(function(){
			$(".loader-wrapper").fadeOut("medium");
		},500)
	})
</script>
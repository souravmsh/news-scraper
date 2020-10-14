<!DOCTYPE html>
<html>
	<head>
		<title><?= (!empty($title)?$title:null) ?></title>
		<link href="<?= base_url('public/css/bootstrap.min.css') ?>" rel="stylesheet"/>
		<link href="<?= base_url('public/css/font-awesome.min.css') ?>" rel="stylesheet"/>
		<link href="<?= base_url('public/css/custom.css') ?>" rel="stylesheet"/>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<?= (!empty($content)?$content:null) ?>	
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>

		<script src="<?= base_url('public/js/bootstrap.min.js') ?>"></script>
		<script type="text/javascript">
		$(function() {    
	        $('#input-search').on('keyup', function() {
	          var rex = new RegExp($(this).val(), 'i');
	            $('.news').hide();
	            $('.news').filter(function() {
	                return rex.test($(this).text());
	            }).show();
	        });
	    });

        // PRINT PARTICULAR AREA 
		$('.print').click(function(){
			$id = $(this).parent().parent().parent().parent().attr('id');
			printMe($id);
		});
        function printMe(el){
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
            window.location='<?= current_url() ?>';
        }
        //ENDS OF PRINT PARTICULAR AREA 
		</script>
	</body>
</html>




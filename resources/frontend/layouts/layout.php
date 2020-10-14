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
				<nav class="navbar navbar-inverse">
				  <div class="container-fluid">
				    <!-- Brand and toggle get grouped for better mobile display -->
				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				      <a class="navbar-brand" href="<?= base_url() ?>">CodeKernel</a>
				    </div>

				    <!-- Collect the nav links, forms, and other content for toggling -->
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				      <ul class="nav navbar-nav">
				        <li class="active"><a href="<?= base_url('') ?>">Home <span class="sr-only">(current)</span></a></li> 
				        <li><a href="<?= base_url('home/dom_read') ?>">Dom Reader</a></li>  
				        <li><a href="<?= base_url('home/xml_read') ?>">XML Read From File</a></li> 
				        <li><a href="<?= base_url('home/xml_single_read') ?>">XML Single Read From File</a></li> 
				        <li><a href="<?= base_url('home/xml_write_by_config') ?>">XML Write With Config</a></li> 
				        <li><a href="<?= base_url('home/xml_write_from_db') ?>">XML Write From DB</a></li>   
				      </ul> 
				    </div><!-- /.navbar-collapse -->
				  </div><!-- /.container-fluid -->
				</nav>
			</div>
		</div>
		
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




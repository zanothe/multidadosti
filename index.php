<!-- Trabalho para Processo Seletivo MultidadosTI -->
<!-- 17 de junho de 2023 -->
<!-- Ivan Cilento -->

<!DOCTYPE html>
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Multidados TI</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="MobileOptimized" content="320">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/themes/default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>





</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">

<?php 
	include('cabecalho.php'); 
?>

<div class="clearfix">
</div>

<?php 
	include('menu.php'); 
	include('rodape.php');
?>



<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script src="assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.cockie.min.js" type="text/javascript"></script>
<script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/scripts/app.js" type="text/javascript"></script>
<script src="assets/scripts/index.js" type="text/javascript"></script>
<!-- END JAVASCRIPTS -->
</body>

<script>
jQuery(document).ready(function() {    
   App.init(); // initlayout and core plugins
   Index.init();
   
   //ATIVIDADE 4
	$.ajax({
		url: 'DataRequest.php',
		dataType: 'json',
		success: function(response) {
			var descbox = document.getElementsByClassName('desc');
			var numberbox = document.getElementsByClassName('number');
			var response = Object.entries(response);
			for(var i = 0; i < response.length; i++) {
				var textNode = document.createTextNode(response[i][0]);
				descbox[i].appendChild(textNode);
				numberbox[i].innerHTML = response[i][1].length;	
		
			}			 		
		}
	});		   
   
 
		
});

//ATIVIDADE 5
$('.more').click(function() {
	var classe = $(this).attr('class');
	var classe = classe.split(' ')[1];

	switch(classe) {
		case "suppliers":
			var clr = "purple";
			break;
		case "clients":
			var clr = "blue";
			break;
		case "users":
			var clr = "green";
	}
	$.ajax({
		url: 'DataRequest.php',
		dataType: 'json',
		success: function(response) {			
			var table = document.getElementById('table');
			var response = Object.entries(response);
			
			for(var i = 0; i < response.length; i++) {								
				if(response[i][0].toLowerCase()==classe) {
					while(table.firstChild) {
						table.removeChild(table.lastChild);					
					}
					var thead = document.createElement('thead');
					table.appendChild(thead);					
					var arr = Array.from(response[i][1]);
					var tr = document.createElement('tr');
					thead.appendChild(tr);
					for(var l in arr[0]) {		
						var textNode = document.createTextNode(l.toUpperCase());
						var th = document.createElement('th');
						th.appendChild(textNode);
						tr.appendChild(th);
					}	
					var tbody = document.createElement('tbody');
					for(var j = 0; j < response[i][1].length; j++) {
							var tr = document.createElement('tr');
							for(var k in arr[j]) {
									var td = document.createElement('td');									
									var textNode = document.createTextNode(arr[j][k]);
									td.appendChild(textNode);
									tr.appendChild(td);
							}	
							tbody.appendChild(tr);						
					}
					table.appendChild(tbody);
					var grey_el = document.getElementsByClassName('portlet box')[0];
					arr = grey_el.getAttribute('class').split(' ');
					arr[2] = clr;
					new_class = arr.join(' ');
					grey_el.setAttribute('class', new_class);
				}	
			}			 		
		}
	})});	

</script>
<!-- END BODY -->
</html>
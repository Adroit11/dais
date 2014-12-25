<!doctype html>
<html>
	<head>
	<title>Advisers - NUMUN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='//fonts.googleapis.com/css?family=Raleway:400,700,300' rel='stylesheet' type='text/css'>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://dl.dropboxusercontent.com/s/kuf4za5pbv9kbbx/style.min.css" rel="stylesheet">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css"/>
	<style type="text/css">
	/* Sticky footer styles
-------------------------------------------------- */
html {
  position: relative;
  min-height: 100%;
  margin-top: 100px;
}
body {
  /* Margin bottom by footer height */
  margin-bottom: 240px;
}
div.dark-footer{
	background: #333;
	color: #fff;
	padding: 2.75em 0px 2em 0px;
}
div.light-footer{
	background: #777;
	color: #eee;
	padding: 1.75em 0px 1em 0px;
}
a.light-footer:link{
	color: #fff;
}
a.light-footer:visited{
	color: #fff;
}
a.light-footer:hover{
	color: #eee;
	text-decoration: none;
}
a.light-footer:active{
	color: #fff;
}
.footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  background-color: #bbb;
}
.container .text-muted {
  margin: 20px 0;
}
*/
/* Navbar
-------------------------------------------------- */
.navbar-default {
border-color: transparent;
background-color: #dadada;
}
.navbar.container{
	height: 50px;
}
div#main-nav-content{
	height: 50px;
}
div#main-nav-content.compact{
	height: 30px;
	font-size: 0.8em;
}
.navbar-toggle {
border-color: transparent;
border: 0px solid transparent;
}

.navbar-default .navbar-nav > li > a:hover,
.navbar-default .navbar-nav > li > a:focus {
	background-color: #16a085;
	color: white;
}
/*.navbar-header{
	background: url('https://dl.dropboxusercontent.com/s/qxo7l62zezl8hdi/numun-bootstrap-nav.png') no-repeat;
	background-size: 100%;
	width: 240px;
	height: 60px;
	border-top: 8px transparent solid;
	border-left: 10px transparent solid;
}*/
.navbar{
	font-family: 'Raleway', 'Helvetica Neue', Helvetica, Arial, sans-serif;
	font-size: 0.99em;
}
.navbar-brand > img{
	height: 54px;
	padding: 0px;
	margin: 0px;
	margin-top: -15px;
	border: 0;
	display: block;
	
}

div#numun-main-navbar{
	background-color: #520062;
}


/* Custom styles
-------------------------------------------------- */
	.hidden-welcome{
	    display: none;
    }
    .hidden-emergency{
	    display: none;
    }
	.header{
		color:#f0f0f0;
		font-family: 'Raleway', sans-serif;
		padding-top: 0.5em;
		padding-left: 1em;	
	}
	h1.header{
		font-weight: 800;
	}
	h2.header{
		font-weight: 400;
	}
	
	.main-container{
		margin-top: 1em;
		width: 70%;
		margin-right: auto;
		margin-left: auto;
	}
	.default-head{
		padding: 15px 0px 10px 0px;
		font-family: 'Raleway', sans-serif;	
		font-weight: 600;
		font-size: 3em;
		color: #74007d;
		text-transform: uppercase;
		border-bottom: 1px solid rgba(116,0,125,0.75);
		margin-bottom: 1.5em;
	}
	.emergency-head{
		padding:10px;
		font-family: 'Raleway', sans-serif;	
		font-weight: 400;
		color: white;
		background: #e21a1a;
	}
	#emergency, #emergency-link{
		display: none;
	}
	i#emergency-link-icon{
		color: #e21a1a;
	}
	#emergency-icon{
		color: #e21a1a;
		padding: 0.5em;
	}
	.reg-container.form-control{
		width: 60% !important;
	}
	.third-adviser, .fourth-adviser{
		display: none;
	}
	.invoice-container{
		width: 60%;
	}
	tr#total-row{
		border-top: solid #333 2px;
	}
	tr.double-del {
	border-left: 3px solid #317bb4;
	}
	.print-header{
		display: none;
	}
	.logo-font{
		font-family: "Century Gothic", "Futura Medium", sans-serif;
		font-weight: normal;
	}
	.spacious{
	background-color: #f0f0f0;
	padding: 30px 0px;
	margin-top:-21px;
	margin-bottom: 40px;
	}
	.print-only{
		display: none;
	}
	/*---Stack buttons---*/
	@media (max-width: 767px) {
    .btn-vert-block + .btn-vert-block {
        margin-top: 10px;    
    }    
	}
	@media print {
	html{
	margin-top:0px;
	}
	.print-header{
		display: block;
	}
	.default-head{
		font-size: 2em;
	}
	.btn{
		display: none;
	}
	.footer{
		display: none;
	}
	.print-only{
		display: block;
	}
	.hide-print{
		display: none;
	}
	tr.double-del {
	border-left: none;
	}
	#usg-finance-thanks{
		page-break-after: always;
	}
	table{
		page-break-inside: avoid;
		font-size: 11pt;
	}
	
	.table-hover>thead>tr>th, .table-hover>tbody>tr>td{
		padding: 2px !important;
	}
	
  /*[class*="col-sm-"] {
    float: left;
  }*/

  }

	</style>
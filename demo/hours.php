<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<link rel="SHORTCUT ICON" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	
	<title></title>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
	
	<style type="text/css" media="screen">

		@import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,700,400italic);
		
		/*---- CSS Reset ----*/
		html, body, div, span, object, iframe,
		h1, h2, h3, h4, h5, h6, p, a, img, ul, li { margin: 0; padding: 0; border: 0; font-size: 100%; font: inherit; vertical-align: baseline; }
		ol, ul { list-style: none; }
		table { border-collapse: collapse; width: 100%; }

		* {margin:0;padding:0;
			-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}

		/*---- HTML5 display-role reset for older browsers ----*/
		article, aside, details, figcaption, figure, 
		footer, header, hgroup, menu, nav, section { display: block; }

		img {vertical-align:bottom;max-width:100%;height:auto;}

		/* !Globals */
		/*-------------------------------------------------*/
		.left { float: left; }
		.right { float: right; }
		.clear { clear: both; }
		.clrafter:after{ clear:both;content: ".";display:block;height:0;visibility:hidden; }
		.ctr {margin:0 auto;}
		.rel { position: relative; }
		.abs { position: absolute; }
		.block { display: block; }
		.zoom { overflow:hidden; zoom:1; }
		.strong { font-weight: bold; }
		.uline { text-decoration: underline; }
		.italic { font-style:italic; }
		.none { display:none; }
		.no-un { text-decoration: none; }
		.tleft { text-align: left; }
		.tright { text-align:right; }
		.tcenter { text-align: center; }
		.ltshadow { box-shadow: 1px 1px 6px rgba(255,255,255,0.6);}
		.push-left {margin-right:auto;}
		.push-right {margin-left:auto;}
		.round1 {border-radius:1px;-moz-border-radius:1px;}
		.round3 {border-radius:3px;-moz-border-radius:3px;}
		.inset {box-shadow: inset 0 0 3px rgba(0,0,0,0.6);}
		.third {width:33%;}
		.twenty {width:20%;}
		.thirty {width:30%;}
		.half {width:50%;}
		.sixty {width:60%;}
		.forty {width:40%;}
		.seventy {width:70%;}
		.eighty {width:80%;}
		.full {width:100%;}

		body {font: normal 1em/1.4 'Source Sans Pro', sans-serif;background:rgb(30,30,30);color:rgb(30,30,30);-webkit-font-smoothing:anti-aliased;}
		h1, h2, h3, h4 {font-size:1.5em;margin-bottom:0.7em;color:rgb(220,220,220);}
		#content h1 {text-align:left;}
		.info {border:1px solid rgb(150,150,150);background:rgb(180,180,180);padding:1em;}
		.hidden {display:none;}
		.ui-helper-hidden-accessible { position: absolute; left: -9999px; display:none;}
		.ui-autocomplete.ui-menu {background:white;padding:0.5em;border:1px solid rgb(160,160,160);z-index:1000;position:absolute;cursor:pointer;max-height:350px;overflow:scroll;}
		.ui-autocomplete li {padding:0.2em 0.5em;}
		.ui-autocomplete li:hover {background:rgb(230,230,230);}
		.ui-menu-item {font-size:0.8em;}
	/**==============================================
	*	Structure
	*==============================================*/
		#container {width:100%;text-align:center;}
		#content {width:750px;margin:0 auto;min-height:500px;margin-top:10%;padding:2%;text-align:center;}
		
		.hours {margin:2em auto;text-align:center;overflow:hidden;display:inline-block;}
			.hours > div {float:left;margin-right:2em;}
		.hours-day {margin-right:1em;}
		.display {width:100%;text-align:left;
				-webkit-box-shadow: 0 0 2px rgba(255,255,255,0.7);
				   -moz-box-shadow: 0 0 2px rgba(255,255,255,0.7);
					 -o-box-shadow: 0 0 2px rgba(255,255,255,0.7);
					-ms-box-shadow: 0 0 2px rgba(255,255,255,0.7);
						box-shadow: 0 0 2px rgba(255,255,255,0.7);}
			.hour-entry {border-radius:4px;border:1px solid rgb(200,200,255);background:rgb(240,240,255);padding:0.3em 0.5em;margin:0.5em;display:inline-block;
						-webkit-transition: all .2s ease-in-out;
						   -moz-transition: all .2s ease-in-out;
							 -o-transition: all .2s ease-in-out;
							-ms-transition: all .2s ease-in-out;
								transition: all .2s ease-in-out;}
			.hour-entry:hover {background:rgb(230,230,255);border-color:rgb(50,50,50);}
		.days {overflow:hidden;padding:4px;margin-bottom:1em;margin:2em auto;display:inline-block;}
		
	/**==============================================
	*	BUTTONS
	*==============================================*/
		button {padding:1em 1.4em;cursor:pointer;color:rgb(255,255,255);
				background: rgb(149,149,149);
				background: -moz-linear-gradient(top,  rgb(149,149,149) 0%, rgb(13,13,13) 46%, rgb(1,1,1) 50%, rgb(10,10,10) 53%, rgb(78,78,78) 76%, rgb(56,56,56) 87%, rgb(27,27,27) 100%);
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgb(149,149,149)), color-stop(46%,rgb(13,13,13)), color-stop(50%,rgb(1,1,1)), color-stop(53%,rgb(10,10,10)), color-stop(76%,rgb(78,78,78)), color-stop(87%,rgb(56,56,56)), color-stop(100%,rgb(27,27,27)));
				background: -webkit-linear-gradient(top,  rgb(149,149,149) 0%,rgb(13,13,13) 46%,rgb(1,1,1) 50%,rgb(10,10,10) 53%,rgb(78,78,78) 76%,rgb(56,56,56) 87%,rgb(27,27,27) 100%);
				background: -o-linear-gradient(top,  rgb(149,149,149) 0%,rgb(13,13,13) 46%,rgb(1,1,1) 50%,rgb(10,10,10) 53%,rgb(78,78,78) 76%,rgb(56,56,56) 87%,rgb(27,27,27) 100%);
				background: -ms-linear-gradient(top,  rgb(149,149,149) 0%,rgb(13,13,13) 46%,rgb(1,1,1) 50%,rgb(10,10,10) 53%,rgb(78,78,78) 76%,rgb(56,56,56) 87%,rgb(27,27,27) 100%);
				background: linear-gradient(to bottom,  rgb(149,149,149) 0%,rgb(13,13,13) 46%,rgb(1,1,1) 50%,rgb(10,10,10) 53%,rgb(78,78,78) 76%,rgb(56,56,56) 87%,rgb(27,27,27) 100%);
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#959595', endColorstr='#1b1b1b',GradientType=0 );
				border-radius:2px;border:1px solid rgba(0,0,0,0.8);border-bottom:1px solid rgba(40,40,40,1);
				-webkit-text-shadow: -1px -1px 0 rgba(0,0,0,1);
				   -moz-text-shadow: -1px -1px 0 rgba(0,0,0,1);
					 -o-text-shadow: -1px -1px 0 rgba(0,0,0,1);
					-ms-text-shadow: -1px -1px 0 rgba(0,0,0,1);
						text-shadow: -1px -1px 0 rgba(0,0,0,1);
				-webkit-box-shadow: inset 0 0 4px rgba(0,0,0,0.8);
				   -moz-box-shadow: inset 0 0 4px rgba(0,0,0,0.8);
					 -o-box-shadow: inset 0 0 4px rgba(0,0,0,0.8);
					-ms-box-shadow: inset 0 0 4px rgba(0,0,0,0.8);
						box-shadow: inset 0 0 4px rgba(0,0,0,0.8);}
		button:hover, button.day.pressed {
			background: rgb(149,149,149);
			background: -moz-linear-gradient(top,  rgb(149,149,149) 9%, rgb(71,71,71) 39%, rgb(48,48,48) 51%, rgb(78,78,78) 76%, rgb(56,56,56) 87%, rgb(56,56,56) 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(9%,rgb(149,149,149)), color-stop(39%,rgb(71,71,71)), color-stop(51%,rgb(48,48,48)), color-stop(76%,rgb(78,78,78)), color-stop(87%,rgb(56,56,56)), color-stop(100%,rgb(56,56,56)));
			background: -webkit-linear-gradient(top,  rgb(149,149,149) 9%,rgb(71,71,71) 39%,rgb(48,48,48) 51%,rgb(78,78,78) 76%,rgb(56,56,56) 87%,rgb(56,56,56) 100%);
			background: -o-linear-gradient(top,  rgb(149,149,149) 9%,rgb(71,71,71) 39%,rgb(48,48,48) 51%,rgb(78,78,78) 76%,rgb(56,56,56) 87%,rgb(56,56,56) 100%);
			background: -ms-linear-gradient(top,  rgb(149,149,149) 9%,rgb(71,71,71) 39%,rgb(48,48,48) 51%,rgb(78,78,78) 76%,rgb(56,56,56) 87%,rgb(56,56,56) 100%);
			background: linear-gradient(to bottom,  rgb(149,149,149) 9%,rgb(71,71,71) 39%,rgb(48,48,48) 51%,rgb(78,78,78) 76%,rgb(56,56,56) 87%,rgb(56,56,56) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#959595', endColorstr='#383838',GradientType=0 );
			}
		button:focus {outline:none;}
		button.day, .actions button {border:1px solid rgb(60,60,60);border-bottom:1px solid rgb(150,150,150);position:relative;float:left;letter-spacing:1px;
					font: bold 0.9em/1.9 'Tahoma', sans-serif;border-radius:0;
					-webkit-transition: all .05s ease-in-out;
					   -moz-transition: all .05s ease-in-out;
						 -o-transition: all .05s ease-in-out;
						-ms-transition: all .05s ease-in-out;
							transition: all .05s ease-in-out;
					}
		.actions {margin: 1em auto;display:inline-block;}
		button.day:first-child, .actions button:first-child {border-top-left-radius:5px;border-bottom-left-radius:5px;}
		button.day:last-child, .actions button:last-child {border-top-right-radius:5px;border-bottom-right-radius:5px;}
		button.day.unpressed, .actions button {z-index:0;
			-webkit-box-shadow: 0 3px 0 rgba(80,80,80,1), 0 2px 0 rgba(80,80,80,1), 0 1px 0 rgba(80,80,80,1);
			   -moz-box-shadow: 0 3px 0 rgba(80,80,80,1), 0 2px 0 rgba(80,80,80,1), 0 1px 0 rgba(80,80,80,1);
				 -o-box-shadow: 0 3px 0 rgba(80,80,80,1), 0 2px 0 rgba(80,80,80,1), 0 1px 0 rgba(80,80,80,1);
				-ms-box-shadow: 0 3px 0 rgba(80,80,80,1), 0 2px 0 rgba(80,80,80,1), 0 1px 0 rgba(80,80,80,1);
					box-shadow: 0 3px 0 rgba(80,80,80,1), 0 2px 0 rgba(80,80,80,1), 0 1px 0 rgba(80,80,80,1);
		}
		button.day.pressed, .actions button:active {margin-top:2px;margin-bottom:-2px;
							-webkit-box-shadow: inset 0 0 3px rgba(0,0,0,0.2), 0 1px 0 rgba(80,80,80,1);
							   -moz-box-shadow: inset 0 0 3px rgba(0,0,0,0.2), 0 1px 0 rgba(80,80,80,1);
								 -o-box-shadow: inset 0 0 3px rgba(0,0,0,0.2), 0 1px 0 rgba(80,80,80,1);
								-ms-box-shadow: inset 0 0 3px rgba(0,0,0,0.2), 0 1px 0 rgba(80,80,80,1);
									box-shadow: inset 0 0 3px rgba(0,0,0,0.2), 0 1px 0 rgba(80,80,80,1);
									background: rgb(76,76,76);
									background: -moz-linear-gradient(top,  rgb(76,76,76) 0%, rgb(13,13,13) 46%, rgb(1,1,1) 50%, rgb(10,10,10) 53%, rgb(51,51,51) 76%, rgb(56,56,56) 87%, rgb(27,27,27) 100%);
									background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgb(76,76,76)), color-stop(46%,rgb(13,13,13)), color-stop(50%,rgb(1,1,1)), color-stop(53%,rgb(10,10,10)), color-stop(76%,rgb(51,51,51)), color-stop(87%,rgb(56,56,56)), color-stop(100%,rgb(27,27,27)));
									background: -webkit-linear-gradient(top,  rgb(76,76,76) 0%,rgb(13,13,13) 46%,rgb(1,1,1) 50%,rgb(10,10,10) 53%,rgb(51,51,51) 76%,rgb(56,56,56) 87%,rgb(27,27,27) 100%);
									background: -o-linear-gradient(top,  rgb(76,76,76) 0%,rgb(13,13,13) 46%,rgb(1,1,1) 50%,rgb(10,10,10) 53%,rgb(51,51,51) 76%,rgb(56,56,56) 87%,rgb(27,27,27) 100%);
									background: -ms-linear-gradient(top,  rgb(76,76,76) 0%,rgb(13,13,13) 46%,rgb(1,1,1) 50%,rgb(10,10,10) 53%,rgb(51,51,51) 76%,rgb(56,56,56) 87%,rgb(27,27,27) 100%);
									background: linear-gradient(to bottom,  rgb(76,76,76) 0%,rgb(13,13,13) 46%,rgb(1,1,1) 50%,rgb(10,10,10) 53%,rgb(51,51,51) 76%,rgb(56,56,56) 87%,rgb(27,27,27) 100%);
									filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4c4c4c', endColorstr='#1b1b1b',GradientType=0 );
							}
		a.delete {padding:0.1em 0.2em;background:none;border:none;border-radius:2px;margin:0 0.2em 0 0.5em;cursor:pointer;}
		a.delete:hover {background:rgba(100,0,0,0.5);color:white;}
	/**==============================================
	*	JSON DUMP
	*==============================================*/
		.output {margin:2em 0; clear:both;word-wrap:break-word;}
		
	/**==============================================
	*	INputs
	*==============================================*/
		label {color:rgb(220,220,220)}
		input:focus {outline:none;}
		input {font-family:'Source Sans Pro'}
		input[type='text'] {padding:0.5em 0.4em;margin:0 1em;font-size:1em;max-width:6em;outline: none;border: 1px solid rgb(100,100,100);}
		
		.trans {
			-webkit-transition: all .3s ease-in-out;
			   -moz-transition: all .3s ease-in-out;
				 -o-transition: all .3s ease-in-out;
				-ms-transition: all .3s ease-in-out;
					transition: all .3s ease-in-out;
		}
		.hide {opacity:0;}
		
	</style>
</head>
<body>

	<div id="container">
		<div id="content" class="round3">
			<h1>Hours</h1>
			<div class="display forty">
				<div id="display" class="round3 inset info">
				
				</div>
			</div>
			<form id="hours-form">
			<div class="days">
				<button class="day unpressed" data-day="6">Sun</button>
				<button class="day unpressed" data-day="0">Mon</button>
				<button class="day unpressed" data-day="1">Tue</button>
				<button class="day unpressed" data-day="2">Wed</button>
				<button class="day unpressed" data-day="3">Thu</button>
				<button class="day unpressed" data-day="4">Fri</button>
				<button class="day unpressed" data-day="5">Sat</button>
			</div>
			<div>
				<div class="hours">
					<div>
						<label>From</label>
						<input type="text" class="round3 inset" maxlength="8" name="hours-from" value="" id="from">
						<input type="hidden" name="hours[]" value="" id="begHours">
					</div>
					<div>
						<label>To</label>
						<input type="text" class="round3 inset" maxlength="8" name="hours-to" value="" id="to">
						<input type="hidden" name="hours[]" value="" id="endHours">
					</div>
				</div>
			</div>
			<div>
				<div class="actions">
					<button id="add" class="clrafter">Add Hours</button>
					<button id="clear" class="clrafter">Reset</button>
				</div>
			</div>
			<br>
			<br>
			<pre>
			<div class="dump none" id="output">
				
			</div>
			</pre>
		</div>
		</form>
	</div>

</body>
</html>

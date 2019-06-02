<?php

function writecss($conn,$csstype)
{
echo "<style type = \"text/css\">\n";

echo "

body
{ 
	font-family:  Helvetica, 'MS Verdana', sans-serif;
	text-color: #0066FF;
	background-image: url('notes1.jpeg');
	background-size: 100%;
	background-repeat: no-repeat;
}
		
h1
{
	color: #0066FF;
	text-align: center;
	font-size: 2.0vw;
	line-height:0;
}

h70
{
	font-size: 0.7vw;
	font-size: 0.7vh;
	line-height:0;
}

h80
{
	font-size: 0.8vw;
	line-height:1;
}

h100
{
	font-size: 1.0vw;
	line-height:0;
}

h120
{
	font-size: 1.2vw;
	line-height:0;
}

h130
{
	font-size: 1.3vw;
	line-height:0;
}

h140
{
	font-size: 1.4vw;
	line-height:1;
}

h150
{
	font-size: 1.5vw;
	line-height:0;
}

h200
{
	font-size: 2.0vw;
}

h250
{
	font-size: 2.5vw;
}

h300
{
	font-size: 3.0vw;
}



input.label
{
    font-size: 2.0vw;
    width: 100%;
}

select.label
{
    font-size: 2.0vw;
	overflow:hidden;
}

textarea,
{
	font-size: 2.0vw;
}

button.period
{
    position: relative;
    width: 100%;
    height: 100%;
    color: white;
	padding: 0px 0px;
	margin: 0px 0px 0px 0px;
	float: left;
	border-radius: 10px;
	font-family:  Helvetica, 'MS Verdana', sans-serif;
	font-size: 2.0vw;
	text-decoration: none;	
	color: #EBEEF2; 
	border-bottom: 2px solid #004280;
	box-shadow: #B4B5B5 3px 3px 3px ;
	text-shadow: 0px -1px #4d4d4d; 
	background: linear-gradient(#e6e6e6,#B8B8B8,#e6e6e6); 
}

button.period:hover
{
    background: #FF6ADA;
    z-index: 100;
 /*   transform: scale(1,1);*/
	cursor:pointer;
	

/*        -webkit-transform: scale(1.3);
        -ms-transform: scale(1.3);
        transform: scale(1.3); */

	
	
}

button.ttavail 
{
	color: #6600FF;
	background: #99FF7F;
}

button.ttnotavail 
{
	color: white;
	background:#FF0044;
}

button.otherbooking
{
	color: white;
	background:red;	
}

button.label
{
	color: blue;
	background: transparent;
	border :0;
	text-align: left;
	z-index: 0;
	font-size: 2.0vw;
	line-height: 2.0vw;
}

button.label:hover
{
	box-shadow: 0 0 0 0
}

button.labelwhite
{
	color: black;
	background: white;
	border :0;
	text-align: left;
}

#container
{
	margin: 0 auto;
	width: 50%;
}

#accordion input
{
	display: none;
}

#accordion label
{
	background: transparent;
	border-radius: 10px; 
	cursor: pointer;
	display: block;
text-align: center;
	color:gray;
/*	border-color:gray;*/
	border-style: solid;
}

#accordion label:hover
{
	background: #FF6ADA;
}

#accordion input:checked + label
{
	background: green;
	border-bottom-right-radius: 0.5;
	border-bottom-left-radius: 0.5; 
	color: white;
	margin-bottom: 0em;
	z-index: 10;
}

#accordion article
{
	background: transparent;
	height: 0px;
	overflow: hidden;
	z-index: 10;
	padding: .25em 0em 0em 0em;
}

#accordion article p
{
	padding: 0em;
}

#accordion input:checked ~ article
{
	height: auto;
	width: 300%;
}

form textarea,

form input 
{ 
    width: 100%;
}

.animate
{
	transition: all 0.1s;
	-webkit-transition: all 0.1s;
}

button
{
	display: block;
	width: 100%;
	height: 100%;
	overflow:hidden;
	padding: 0px 0px;
	margin: 0px 0px 0px 0px;
	float: left;
}

.menu-button
{
	position: relative;
	border-radius: 1vw;
	font-family:  Helvetica, 'MS Verdana', sans-serif;
 	font-size: 2.0vw;
	text-decoration: none;	
	color: #EBEEF2; 
	border: 0vw 0.3vw 0.3vw 0.3vw solid gray; 
	border-bottom: 0.4vw solid #004280;
	box-shadow: #B4B5B5 0.5vw 0.5vw 0.5vw ;
	background: linear-gradient(#4d94ff,#0066ff,#4d94ff); 
}

.menu-button:after
{
	content: '';
	position: absolute;
	top: 2vw;
	left: 2vw;
	width: calc(100% - 4vw);
	height: 50%;
}

.smallfont 
{
	font-size: 1.5vw;
}

.menu-button:disabled
{
	border-bottom: 0px;
	text-shadow: 0px;
	pointer-events:none;
}

.menu-button:active
{
	transform: translateY(10%);
}

.menu-button:hover 
{
    background: #FF00FF;
    z-index: 100;
    transform: scale(1,1);
	color: #000000; 
	cursor:pointer;
	
}

.mediummenu-button
{
	position: relative;
	padding: 0px 0px;
	margin: 0px 0px 0px 0px;
	float: left;
	border-radius: .5vw;
	font-family:  Helvetica, 'MS Verdana', sans-serif;
 	font-size: 1.5vw;
	text-decoration: none;	
	color: #EBEEF2; 
	border: 0.3vw solid gray; 
	border-bottom: 0.4vw solid #004280;
	background: linear-gradient(#4d94ff,#0066ff,#4d94ff); 
}

.mediummenu-button:active
{
	transform: translateY(10%);
}

.mediummenu-button:disabled
{
	border-bottom: 0px; 
	text-shadow: 0px;
	border-radius: 0px;
	pointer-events:none;
}

.mediummenu-button:hover
{
    background: #FF00FF;
    z-index: 100;
    transform: scale(1,1);
	color: #000000; 
	cursor:pointer;

}

.smallmenu-button
{
	position: relative;
	padding: 0px 0px;
	margin: 0px 0px 0px 0px;
	float: left;
	border-radius: .3vw;
	font-family:  Helvetica, 'MS Verdana', sans-serif;
	font-size: 1vw;
	text-decoration: none;	
	color: #EBEEF2; 
	border: 2px solid gray; 
	border-bottom: 1px solid #004280;
	background: linear-gradient(#4d94ff,#0066ff,#4d94ff); 
}

.smallmenu-button:active
{
	transform: translateY(10%);
}

.smallmenu-button:disabled
{
	border-bottom: 0px;
	text-shadow: 0px;
	border-radius: 0px;
	pointer-events:none;
	
}

.smallmenu-button:hover {
    background: #FF00FF;
    z-index: 100;
    transform: scale(1,1);
	color: #000000; 
	cursor:pointer;
	
	

}

.timesel-button
{
	position: relative;
	padding: 0px 0px;
	margin: 0px 0px 0px 0px;
	float: left;
	border-radius: .5vw;
	font-family:  Helvetica, 'MS Verdana', sans-serif;
	font-size: 2.5vw;
	text-decoration: none;	
	background: linear-gradient(#4d94ff,#0066ff,#4d94ff); 
	color: white;
}

.timesel-button:active
{
	transform: translateY(10%);
}

.timesel-button:disabled
{
	border-bottom: 0px; 
	text-shadow: 0px;
	border-radius: 0px;
	pointer-events:none;
}

.timesel-button:hover
{
  background: transparent; 
    z-index: 100;
    transform: scale(1,1);
	color: blue; 
	cursor:pointer;
	
/*	-webkit-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5); */
}

.blue
{
	background: linear-gradient(#4d94ff,#0066ff,#4d94ff); 
}

.red
{
	background: linear-gradient(#ff4d4d,#ff0000,#ff4d4d); 
}

.green
{
	background: linear-gradient(#009900,#00cc00,#009900); 
	color: #330000;
}

.yellow
{
	background-color: #F2CF66;
	border-bottom: 5px solid #D1B358;
	text-shadow: 0px -2px #D1B358;
}

.action-button:active
{
	transform: translate(0px,5px);
	-webkit-transform: translate(0px,5px);
	border-bottom: 1px solid;
}

";

echo "</style>\n";

}
?>
var current_action=null;var actions=["crop","scale","rotate","measure","save"];var orginal_width=null,orginal_height=null;function toggle(a){if(current_action!=a){for(var b in actions){if(actions[b]!=a){var d=document.getElementById("tools_"+actions[b]);d.style.display="none";var g=document.getElementById("icon_"+actions[b]);g.className=""}}current_action=a;var d=document.getElementById("tools_"+a);d.style.display="block";var g=document.getElementById("icon_"+a);g.className="iconActive";var k=document.getElementById("indicator_image");k.src="img/"+a+".gif";editor.setMode(current_action);if(a=="scale"){var f=editor.window.document.getElementById("theImage");orginal_width=f._width;orginal_height=f._height;var l=document.getElementById("sw");l.value=orginal_width;var c=document.getElementById("sh");c.value=orginal_height}if(a=="save"){var e=document.getElementById("save_format");var j=document.getElementById("save_filename").value.match(/\.(gif|png|jpe?g)/i)[1].toLowerCase();switch(j){case"png":e.selectedIndex="3";break;case"gif":e.selectedIndex="4";break;default:e.selectedIndex="0";break}e.onchange()}}}function toggleMarker(){var a=document.getElementById("markerImg");if(a!=null&&a.src!=null){if(a.src.indexOf("t_black.gif")>=0){a.src="img/t_white.gif"}else{a.src="img/t_black.gif"}editor.toggleMarker()}}function toggleConstraints(){var a=document.getElementById("scaleConstImg");var b=document.getElementById("constProp");if(a!=null&&a.src!=null){if(a.src.indexOf("unlocked2.gif")>=0){a.src="img/islocked2.gif";b.checked=true;checkConstrains("width")}else{a.src="img/unlocked2.gif";b.checked=false}}}function checkConstrains(f){var e=document.getElementById("constProp");if(e.checked){var b=document.getElementById("sw");var d=b.value;var c=document.getElementById("sh");var a=c.value;if(orginal_width>0&&orginal_height>0){if(f=="width"&&d>0){c.value=parseInt((d/orginal_width)*orginal_height)}else{if(f=="height"&&a>0){b.value=parseInt((a/orginal_height)*orginal_width)}}}}updateMarker("scale")}function updateMarker(f){if(f=="crop"){var e=document.getElementById("cx");var d=document.getElementById("cy");var g=document.getElementById("cw");var b=document.getElementById("ch");editor.setMarker(parseInt(e.value),parseInt(d.value),parseInt(g.value),parseInt(b.value))}else{if(f=="scale"){var a=document.getElementById("sw");var c=document.getElementById("sh");editor.setMarker(0,0,parseInt(a.value),parseInt(c.value))}}}function rotateSubActionSelect(a){var c=a.options[a.selectedIndex].value;var b=document.getElementById("rotate_preset_select");var d=document.getElementById("flip");var e=document.getElementById("ra").parentNode;switch(c){case"rotate":b.style.display="";d.style.display="none";e.style.display="";break;case"flip":b.style.display="none";d.style.display="";e.style.display="none";break}}function rotatePreset(a){var b=a.options[a.selectedIndex].value;if(b.length>0&&parseInt(b)!=0){var c=document.getElementById("ra");c.value=parseInt(b)}}function updateFormat(c){var b=c.options[c.selectedIndex].value;var a=b.split(",");if(a[0]!="jpeg"){document.getElementById("slider").style.display="none"}else{document.getElementById("slider").style.display="inline"}if(a.length>1){updateSlider(parseInt(a[1]))}}function zoom(){var a=editor.window.document.getElementById("theImage");var b=document.getElementById("zoom").value;a.width=a._width*parseInt(b,10)/100;a.height=a._height*parseInt(b,10)/100;editor.reset();editor.pic_width=null;editor.pic_height=null}function addEvent(d,c,a){if(d.addEventListener){d.addEventListener(c,a,true);return true}else{if(d.attachEvent){var b=d.attachEvent("on"+c,a);return b}else{return false}}}var init=function(){if(window.opener){__xinha_dlg_init();__dlg_translate("ExtendedFileManager")}addEvent(window,"resize",winOnResize);try{window.moveTo(0,0)}catch(a){}window.resizeTo(window.screen.availWidth,window.screen.availHeight);winOnResize()};function winOnResize(){if(typeof editor.reset=="function"&&typeof editor.ant!="undefined"){editor.reset()}var a=Xinha.viewportSize(window);document.getElementById("contents").style.height=a.y-parseInt(document.getElementById("indicator").offsetHeight,10)-5+"px"}Xinha.addOnloadHandler(init,window);
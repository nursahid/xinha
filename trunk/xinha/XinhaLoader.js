var Xinha={};_editor_url=_editor_url.replace(/\x2f*$/,"/");Xinha.agt=navigator.userAgent.toLowerCase();Xinha.is_ie=((Xinha.agt.indexOf("msie")!=-1)&&(Xinha.agt.indexOf("opera")==-1));Xinha.ie_version=parseFloat(Xinha.agt.substring(Xinha.agt.indexOf("msie")+5));Xinha.is_opera=(Xinha.agt.indexOf("opera")!=-1);Xinha.is_khtml=(Xinha.agt.indexOf("khtml")!=-1);Xinha.is_webkit=(Xinha.agt.indexOf("applewebkit")!=-1);Xinha.is_safari=(Xinha.agt.indexOf("safari")!=-1);Xinha.opera_version=navigator.appVersion.substring(0,navigator.appVersion.indexOf(" "))*1;Xinha.is_mac=(Xinha.agt.indexOf("mac")!=-1);Xinha.is_mac_ie=(Xinha.is_ie&&Xinha.is_mac);Xinha.is_win_ie=(Xinha.is_ie&&!Xinha.is_mac);Xinha.is_gecko=(navigator.product=="Gecko"&&!Xinha.is_safari);Xinha.isRunLocally=document.URL.toLowerCase().search(/^file:/)!=-1;Xinha.is_designMode=(typeof document.designMode!="undefined"&&!Xinha.is_ie);Xinha.isSupportedBrowser=Xinha.is_gecko||(Xinha.is_opera&&Xinha.opera_version>=9.1)||Xinha.ie_version>=5.5||Xinha.is_safari;Xinha.loadPlugins=function(a,b){if(!Xinha.isSupportedBrowser){return}Xinha.loadStyle(typeof _editor_css=="string"?_editor_css:"Xinha.css","XinhaCoreDesign");Xinha.createLoadingMessages(xinha_editors);var c=Xinha.loadingMessages;Xinha._loadback(_editor_url+"XinhaCore.js",function(){Xinha.removeLoadingMessages(xinha_editors);Xinha.createLoadingMessages(xinha_editors);b()});return false};Xinha._loadback=function(f,b,a,e){var c=!Xinha.is_ie?"onload":"onreadystatechange";var d=document.createElement("script");d.type="text/javascript";d.src=f;if(b){d[c]=function(){if(Xinha.is_ie&&(!(/loaded|complete/.test(window.event.srcElement.readyState)))){return}b.call(a?a:this,e);d[c]=null}}document.getElementsByTagName("head")[0].appendChild(d)};Xinha.getElementTopLeft=function(a){var b=curtop=0;if(a.offsetParent){b=a.offsetLeft;curtop=a.offsetTop;while(a=a.offsetParent){b+=a.offsetLeft;curtop+=a.offsetTop}}return{top:curtop,left:b}};Xinha.findPosX=function(a){var b=0;if(a.offsetParent){return Xinha.getElementTopLeft(a).left}else{if(a.x){b+=a.x}}return b};Xinha.findPosY=function(b){var a=0;if(b.offsetParent){return Xinha.getElementTopLeft(b).top}else{if(b.y){a+=b.y}}return a};Xinha.createLoadingMessages=function(b){if(Xinha.loadingMessages||!Xinha.isSupportedBrowser){return}Xinha.loadingMessages=[];for(var a=0;a<b.length;a++){if(!document.getElementById(b[a])){continue}Xinha.loadingMessages.push(Xinha.createLoadingMessage(document.getElementById(b[a])))}};Xinha.createLoadingMessage=function(a,e){if(document.getElementById("loading_"+a.id)||!Xinha.isSupportedBrowser){return}var d=document.createElement("div");d.id="loading_"+a.id;d.className="loading";d.style.left=(Xinha.findPosX(a)+a.offsetWidth/2)-106+"px";d.style.top=(Xinha.findPosY(a)+a.offsetHeight/2)-50+"px";var c=document.createElement("div");c.className="loading_main";c.id="loading_main_"+a.id;c.appendChild(document.createTextNode(Xinha._lc("Loading in progress. Please wait!")));var b=document.createElement("div");b.className="loading_sub";b.id="loading_sub_"+a.id;e=e?e:Xinha._lc("Loading Core");b.appendChild(document.createTextNode(e));d.appendChild(c);d.appendChild(b);document.body.appendChild(d);return b};Xinha.loadStyle=function(c,e){var a=_editor_url||"";a+=c;var b=document.getElementsByTagName("head")[0];var d=document.createElement("link");d.rel="stylesheet";d.href=a;if(e){d.id=e}b.appendChild(d)};Xinha._lc=function(a){return a};Xinha._addEvent=function(a,c,b){if(document.addEventListener){a.addEventListener(c,b,true)}else{a.attachEvent("on"+c,b)}};Xinha.addOnloadHandler=function(b){var c=function(){if(arguments.callee.done){return}arguments.callee.done=true;if(Xinha.onloadTimer){clearInterval(Xinha.onloadTimer)}b.call()};if(Xinha.is_ie){document.write("<script id=__ie_onload defer src=javascript:void(0)><\/script>");var a=document.getElementById("__ie_onload");a.onreadystatechange=function(){if(this.readyState=="loaded"){c()}}}else{if(/WebKit/i.test(navigator.userAgent)){Xinha.onloadTimer=setInterval(function(){if(/loaded|complete/.test(document.readyState)){c()}},10)}else{document.addEventListener("DOMContentLoaded",c,false)}}};
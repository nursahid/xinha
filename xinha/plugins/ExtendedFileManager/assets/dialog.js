function Dialog(a,c,d){if(typeof d=="undefined"){d=window}if(typeof window.showModalDialog=="function"){Dialog._return=c;var b=window.showModalDialog(a,d,"dialogheight=10;dialogwidth=10;resizable=yes")}else{Dialog._geckoOpenModal(a,c,d)}}Dialog._parentEvent=function(a){setTimeout(function(){if(Dialog._modal&&!Dialog._modal.closed){Dialog._modal.focus()}},50);if(Dialog._modal&&!Dialog._modal.closed){Dialog._stopEvent(a)}};Dialog._return=null;Dialog._modal=null;Dialog._arguments=null;Dialog._geckoOpenModal=function(a,c,j){var f="hadialog"+a;var h=/\W/g;f=f.replace(h,"_");var g=window.open(a,f,"toolbar=no,menubar=no,personalbar=no,width=10,height=10,scrollbars=no,resizable=yes,modal=yes,dependable=yes");Dialog._modal=g;Dialog._arguments=j;function b(i){Dialog._addEvent(i,"click",Dialog._parentEvent);Dialog._addEvent(i,"mousedown",Dialog._parentEvent);Dialog._addEvent(i,"focus",Dialog._parentEvent)}function e(i){Dialog._removeEvent(i,"click",Dialog._parentEvent);Dialog._removeEvent(i,"mousedown",Dialog._parentEvent);Dialog._removeEvent(i,"focus",Dialog._parentEvent)}b(window);for(var d=0;d<window.frames.length;b(window.frames[d++])){}Dialog._return=function(l){if(l&&c){c(l)}e(window);for(var k=0;k<window.frames.length;e(window.frames[k++])){}Dialog._modal=null}};Dialog._addEvent=function(a,c,b){if(Dialog.is_ie){a.attachEvent("on"+c,b)}else{a.addEventListener(c,b,true)}};Dialog._removeEvent=function(a,c,b){if(Dialog.is_ie){a.detachEvent("on"+c,b)}else{a.removeEventListener(c,b,true)}};Dialog._stopEvent=function(a){if(Dialog.is_ie){a.cancelBubble=true;a.returnValue=false}else{a.preventDefault();a.stopPropagation()}};Dialog.agt=navigator.userAgent.toLowerCase();Dialog.is_ie=((Dialog.agt.indexOf("msie")!=-1)&&(Dialog.agt.indexOf("opera")==-1));
var topDoc=window.top.document;var t_cx=topDoc.getElementById("cx");var t_cy=topDoc.getElementById("cy");var t_cw=topDoc.getElementById("cw");var t_ch=topDoc.getElementById("ch");var m_sx=topDoc.getElementById("sx");var m_sy=topDoc.getElementById("sy");var m_w=topDoc.getElementById("mw");var m_h=topDoc.getElementById("mh");var m_a=topDoc.getElementById("ma");var m_d=topDoc.getElementById("md");var s_sw=topDoc.getElementById("sw");var s_sh=topDoc.getElementById("sh");var r_ra=topDoc.getElementById("ra");var pattern="img/2x2.gif";function doSubmit(d){if(d=="crop"){var b=_backend_url+"__function=editorFrame&img="+currentImageFile+"&action=crop&params="+parseInt(t_cx.value)+","+parseInt(t_cy.value)+","+parseInt(t_cw.value)+","+parseInt(t_ch.value);location.href=b}else{if(d=="scale"){var b=_backend_url+"__function=editorFrame&img="+currentImageFile+"&action=scale&params="+parseInt(s_sw.value)+","+parseInt(s_sh.value);location.href=b}else{if(d=="rotate"){var e=topDoc.getElementById("flip");if(e.value=="hoz"||e.value=="ver"){location.href=_backend_url+"__function=editorFrame&img="+currentImageFile+"&action=flip&params="+e.value}else{if(isNaN(parseFloat(r_ra.value))==false){location.href=_backend_url+"__function=editorFrame&img="+currentImageFile+"&action=rotate&params="+parseFloat(r_ra.value)}}}else{if(d=="save"){var c=topDoc.getElementById("save_filename");var g=topDoc.getElementById("save_format");var f=topDoc.getElementById("quality");var h=g.value.split(",");if(c.value.length<=0){alert(i18n("Please enter a filename to save."))}else{var a=encodeURI(c.value);var i=parseInt(f.value);var b=_backend_url+"__function=editorFrame&img="+currentImageFile+"&action=save&params="+h[0]+","+i+"&file="+a;location.href=b}}}}}}function addEvent(d,c,a){if(d.addEventListener){d.addEventListener(c,a,true);return true}else{if(d.attachEvent){var b=d.attachEvent("on"+c,a);return b}else{return false}}}var jg_doc;init=function(){jg_doc=new jsGraphics("imgCanvas");jg_doc.setColor("#000000");initEditor()};addEvent(window,"load",init);
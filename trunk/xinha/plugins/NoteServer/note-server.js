function NoteServer(c){this.editor=c;var a=c.config;var b=this;a.registerButton({id:"insertscore",tooltip:this._lc("Insert GUIDO Music Notation"),image:c.imgURL("note.gif","NoteServer"),textMode:false,action:function(d){b.buttonPress(d)}});a.addToolbarElement("insertscore","insertimage",1)}NoteServer._pluginInfo={name:"NoteServer",version:"1.1",developer:"Richard Christophe",developer_url:"http://piano-go.chez.tiscali.fr/guido.html",c_owner:"Richard Christophe",sponsor:"",sponsor_url:"",license:"htmlArea"};NoteServer.prototype._lc=function(a){return Xinha._lc(a,"NoteServer")};NoteServer.prototype.buttonPress=function(a){a._popupDialog("plugin://NoteServer/codenote",function(b){if(!b){return false}else{IncludeGuido(a,b)}},null)};var noteserveraddress="clef.cs.ubc.ca";var htmlbase="/salieri/nview";var versionstring="";function GetGIFURL(c,d,a){c=escape(c);c=c.replace(/\//g,"%2F");if(!d){d="1.0"}if(!a){a="1"}var b="http://"+noteserveraddress+"/scripts/salieri"+versionstring+"/gifserv.pl?pagewidth=21&pageheight=29.7&zoomfactor="+d+"&pagesizeadjust=yes&outputformat=gif87&pagenum="+a+"&gmndata="+c;return b}function GetMIDIURL(b){b=escape(b);b=b.replace(/\//g,"%2F");var a="http://"+noteserveraddress+"/scripts/salieri"+versionstring+"/midserv.pl?gmndata="+b;return a}function GetAPPLETURL(b,c){b=escape(b);b=b.replace(/\//g,"%2F");var a='<applet code="NoteServerApplet" codebase="http://'+noteserveraddress+htmlbase+'/java"  width=700 height=300><param name=server value="'+noteserveraddress+'"><param name=serverVersion value="'+versionstring+'"><param name=zoomFactor value="'+c+'"><param name=pageWidth value="21"><param name=pageHeight value="29.7"><param name=gmn value="'+b+'"></applet>';return a}function IncludeGuido(e,b){if(!b.f_zoom){zoom=""}var d=GetGIFURL(b.f_code,b.f_zoom,"");var h=GetMIDIURL(b.f_code);var f="<br>";if(b.f_applet==false){if(((navigator.userAgent.toLowerCase().indexOf("msie")!=-1)&&(navigator.userAgent.toLowerCase().indexOf("opera")==-1))){e.focusEditor();e.insertHTML("<img src="+d+">")}else{img=new Image();img.src=d;var g=e._doc;var a=e._getSelection();var c=e._createRange(a);e._doc.execCommand("insertimage",false,img.src)}}else{var i=GetAPPLETURL(b.f_code,b.f_zoom);f=f+i+"<br>"}if(b.f_affcode){f=f+Xinha._lc("GUIDO Code","NoteServer")+" : "+b.f_code+"<br>"}if(b.f_midi){f=f+"<a href="+h+">"+Xinha._lc("MIDI File","NoteServer")+"</a> <br>"}e.focusEditor();e.insertHTML(f)}function IncludeGuidoStringAsApplet(c,b,d){b=escape(b);b=b.replace(/\//g,"%2F");var a='<applet codebase="http://'+noteserveraddress+htmlbase+'/java"\ncode="NoteServerApplet" width=480 height=230><PARAM NAME=server VALUE=\''+noteserveraddress+"'><PARAM NAME=serverVersion VALUE='"+versionstring+"'><PARAM NAME=zoomFactor VALUE='"+d+'\'><param name=pageWidth value="21"><param name=pageHeight value="29.7"><PARAM NAME=gmn VALUE=\''+b+"'></applet>";alert(a);c.focusEditor();c.insertHTML(a)};
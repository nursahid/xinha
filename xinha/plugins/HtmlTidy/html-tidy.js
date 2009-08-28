function HtmlTidy(e){this.editor=e;var f=e.config;var c=HtmlTidy.btnList;var l=this;this.onMode=this.__onMode;var k=[];for(var d=0;d<c.length;++d){var b=c[d];if(b=="html-tidy"){var a="HT-html-tidy";f.registerButton(a,this._lc("HTML Tidy"),e.imgURL(b[0]+".gif","HtmlTidy"),true,function(i,m){l.buttonPress(i,m)},b[1]);k.push(a)}else{if(b=="html-auto-tidy"){var j=[this._lc("Auto-Tidy"),this._lc("Don't Tidy")];var g=new Object();g[j[0]]="auto";g[j[1]]="noauto";var h={id:"HT-auto-tidy",options:g,action:function(i){l.__onSelect(i,this)},refresh:function(i){},context:"body"};f.registerDropdown(h)}}}for(var d in k){f.toolbar[0].push(k[d])}}HtmlTidy._pluginInfo={name:"HtmlTidy",version:"1.0",developer:"Adam Wright",developer_url:"http://blog.hipikat.org/",sponsor:"The University of Western Australia",sponsor_url:"http://www.uwa.edu.au/",license:"htmlArea"};HtmlTidy.prototype._lc=function(a){return Xinha._lc(a,"HtmlTidy")};HtmlTidy.prototype.__onSelect=function(a,c){var b=a._toolbarObjects[c.id].element;if(b.value=="auto"){this.onMode=this.__onMode}else{this.onMode=null}};HtmlTidy.prototype.__onMode=function(a){if(a=="textmode"){this.buttonPress(this.editor,"HT-html-tidy")}};HtmlTidy.btnList=[null,["html-tidy"],["html-auto-tidy"]];HtmlTidy.prototype.buttonPress=function(editor,id){switch(id){case"HT-html-tidy":var oldhtml=editor.getHTML();if(oldhtml==""){break}Xinha._postback(_editor_url+"plugins/HtmlTidy/html-tidy-logic.php",{htisource_name:oldhtml},function(javascriptResponse){eval(javascriptResponse)});break}};HtmlTidy.prototype.processTidied=function(a){editor=this.editor;editor.setHTML(a)};
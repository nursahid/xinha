function FindReplace(c){this.editor=c;var a=c.config;var b=this;a.registerButton("FR-findreplace",this._lc("Find and Replace"),c.imgURL("ed_find.gif","FindReplace"),false,function(d){b.buttonPress(d)});a.addToolbarElement(["FR-findreplace","separator"],["formatblock","fontsize","fontname"],-1)}FindReplace.prototype.buttonPress=function(a){FindReplace.editor=a;var b=a.getSelectedHTML();if(/\w/.test(b)){b=b.replace(/<[^>]*>/g,"");b=b.replace(/&nbsp;/g,"")}var c=/\w/.test(b)?{fr_pattern:b}:null;a._popupDialog("plugin://FindReplace/find_replace",null,c)};FindReplace._pluginInfo={name:"FindReplace",version:"1.0 - beta",developer:"Cau Guanabara",developer_url:"mailto:caugb@ibest.com.br",c_owner:"Cau Guanabara",sponsor:"Independent production",sponsor_url:"http://www.netflash.com.br/gb/HA3-rc1/examples/find-replace.html",license:"htmlArea"};FindReplace.prototype._lc=function(a){return Xinha._lc(a,"FindReplace")};
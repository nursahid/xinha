function HtmlEntities(a){this.editor=a}HtmlEntities._pluginInfo={name:"HtmlEntities",version:"1.0",developer:"Raimund Meyer",developer_url:"http://rheinauf.de",c_owner:"Xinha community",sponsor:"",sponsor_url:"",license:"Creative Commons Attribution-ShareAlike License"};Xinha.Config.prototype.HtmlEntities={Encoding:"iso-8859-1",EntitiesFile:_editor_url+"plugins/HtmlEntities/Entities.js"};HtmlEntities.prototype.onGenerate=function(){var e=this.editor;var url=(e.config.HtmlEntities.Encoding)?_editor_url+"plugins/HtmlEntities/"+e.config.HtmlEntities.Encoding+".js":e.config.HtmlEntities.EntitiesFile;var callback=function(getback){var specialReplacements=e.config.specialReplacements;eval("var replacements ="+getback);for(var i in replacements){specialReplacements[i]=replacements[i]}};Xinha._getback(url,callback)};
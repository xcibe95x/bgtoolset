<!DOCTYPE html>
<html lang="en">
	<head id="toolset_head">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Playstation 3 - Toolset</title>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
		<script type='text/javascript' src="js/logger.min.js"></script>
		<script>
			"use strict"
			var token='';
			// remember to minify the js files to include latest changes
			// jstree.js was modded, jquery.contextMenu.js too, maybe more...
			var libraries = [
				{'library':'cookies','async':true,'fail':0,'url':'js/js.cookie.min.js','data':null}
				,{'library':'jquery','async':true,'fail':0,'url':'js/jquery-1.12.4.min.js','data':null}
				,{'library':'jqueryui','async':true,'fail':0,'url':'js/jquery-ui.min.js','data':null}
				,{'library':'mscb','async':true,'fail':0,'url':'js/mCustomScrollbar.concat.min.js','data':null}
				,{'library':'toast','async':true,'fail':0,'url':'js/toastmessage.min.js','data':null}
				//,{'library':'dom4','async':true,'fail':0,'url':'js/dom4.min.js','data':null}
	
				,{'library':'jstree','async':true,'fail':0,'url':'js/jstree.min.js','data':null}
				 ,{'library':'switch','async':true,'fail':0,'url':'js/jquery.switchButton.min.js','data':null}
				,{'library':'fe_splitter','async':true,'fail':0,'url':'fe/scripts/jquery.splitter/jquery.splitter-1.5.1.min.js','data':null}
				,{'library':'fe_cm','async':true,'fail':0,'url':'fe/scripts/contextMenu-2.9.2/jquery.contextMenu.min.js','data':null}
				,{'library':'fe_tablesorter','async':true,'fail':0,'url':'fe/scripts/tablesorter-2.31.3/js/jquery.tablesorter.combined.min.js','data':null}

					];
			var css = [
				{'library':'sunny','async':true,'fail':0,'url':'assets/jqueryui/sunny/jquery-ui.min.css','data':null}
				,{'library':'eggplant','async':true,'fail':0,'url':'assets/jqueryui/eggplant/jquery-ui.min.css','data':null}
				,{'library':'redmond','async':true,'fail':0,'url':'assets/jqueryui/redmond/jquery-ui.min.css','data':null}
				,{'library':'hot-sneaks','async':true,'fail':0,'url':'assets/jqueryui/hot-sneaks/jquery-ui.min.css','data':null}
				,{'library':'mcsb','async':true,'fail':0,'url':'assets/css/mCustomScrollbar.min.css','data':null}
				,{'library':'fe_cm','async':true,'fail':0,'url':'fe/scripts/contextMenu-2.9.2/jquery.contextMenu.min.css','data':null}
				,{'library':'fe_ts_juitheme','async':true,'fail':0,'url':'fe/scripts/tablesorter-2.31.3/css/theme.jui.min.css','data':null}
				//,{'library':'fe_reset','async':true,'fail':0,'url':'fe/styles/reset.css','data':null}
				//,{'library':'fe_cm','async':true,'fail':0,'url':'fe/scripts/jquery.contextmenu/jquery.contextMenu-1.01.css','data':null}
				//,{'library':'fe_fm','async':true,'fail':0,'url':'fe/styles/filemanager.css','data':null}
				,{'library':'main','async':true,'fail':0,'url':'assets/css/main.min.css','data':null}
			];
			var logdone=0;
	
			var ldiag=null;
			var sdiag=null;
			var pbfm1=null;
			var pbfm2=null;
			var fp9loaded = false;
			var fp9loader = function(){
				fp9loaded = true;
			};
			var insertSWF = function(divid,swfid,fid){
				var el = document.getElementById(divid);
				if(el){
					var o = document.createElement('object');
					o.setAttribute('type','application/x-shockwave-flash');
					o.setAttribute('data',divid==='TSound' ? fid : 'file.php?tk=FByIgrQn5mRRJwf7YFUrJRj2PtVgNX3GqvgyscXMJ6s1&id='+fid);
					o.id = swfid;
					o.setAttribute('width','1px');
					o.setAttribute('height','1px');
					var pobj=[{name:'menu',value:'false'},{name:'scale',value:'noScale'},{name:'allowScriptAccess',value:'always'},{name:'bgcolor',value:''}];
					for(var i=0;i<pobj.length;i++){
						var p = document.createElement('param');
						p.setAttribute('name',pobj[i].name);
						p.setAttribute('value',pobj[i].value);
						o.appendChild(p);
					}
					el.parentNode.replaceChild(o,el);
					return true;
				}
				else{
					return false;
				}
			};
			<?php
				if( ! ini_get('date.timezone') )
					date_default_timezone_set('UTC');
				
				printf("var get_year =function() {return '".date('Y')."';};\n");
				printf("			var get_day =function() {return '".date('w')."';};\n");
			?>
			var fwv = '4.89';
			token ='bVBwcJUOF3x5Mi1jEhA4RR/STnwicOfara+atTbAJSE=';
					function loadLib(idx){
				var lib_xhr = new XMLHttpRequest();
				lib_xhr.addEventListener("load", transferLibComplete);
				lib_xhr.addEventListener("error", transferLibFailed);
				function cleanLibRequest(){
					lib_xhr.removeEventListener("load", transferLibComplete);
					lib_xhr.removeEventListener("error", transferLibFailed);
				}
				function transferLibComplete(){
					console.log('loaded '+libraries[idx].library);
					cleanLibRequest();
					libraries[idx].data = this.responseText;
					var sc = document.createElement('script');
					sc.id = 'js_'+idx.toString();
					sc.text = libraries[idx].data;
					document.getElementById('toolset_head').appendChild(sc);

					if(libraries[idx].library==='jquery' || libraries[idx].library==='mscb'){
						logdone++;
						if(logdone===2){
							var event = document.createEvent('Event');
							event.initEvent('loadLog', false, false);
							frames['ifrlog'].window.document.dispatchEvent(event);
						}
					}
					if(libraries[idx].library==='jquery'){		
						loadCss(0);
					}	
					libraries[idx].fail=0;
					idx++;
					if(idx<libraries.length){
						loadLib(idx);
					}
					else{
						console.log('loaded all js libraries');
						setTimeout(complete, 500);
					}
				}
				function transferLibFailed(){
					cleanLibRequest();
					if(libraries[idx].fail<3){
						libraries[idx].fail++;
						loadLib(idx);
					}
					else{
						console.log('failed to load '+libraries[idx].library);
						//alert('Failed to load js support library '+libraries[idx].library+' after 3 attempts');
						throw 'Failed to load js support library '+libraries[idx].library;
					}
				}
				lib_xhr.open("get", libraries[idx].url, libraries[idx].async);
				lib_xhr.send();
			}
			loadLib(0);
			function loadCss(idx){
				var css_xhr = new XMLHttpRequest();
				css_xhr.addEventListener("load", transferCssComplete);
				css_xhr.addEventListener("error", transferCssFailed);
				function cleanCssRequest(){
					css_xhr.removeEventListener("load", transferCssComplete);
					css_xhr.removeEventListener("error", transferCssFailed);
				}
				function transferCssComplete(){
					cleanCssRequest();
					console.log('loaded '+css[idx].library);
					css[idx].data = '<style>'+this.responseText+'</style>';
					if(css[idx].library!='sunny' && css[idx].library!='eggplant' && css[idx].library!='redmond' && css[idx].library!='hot-sneaks'){
						$('head').append(css[idx].data);
					}
					css[idx].fail=0;
					idx++;
					if(idx<css.length){
						loadCss(idx);
					}
					else{
						console.log('loaded all css libraries');
					}
				}
				function transferCssFailed(){
					cleanCssRequest();
					if(css[idx].fail<3){
						css[idx].fail++;
						console.log('retry to load '+css[idx].library);
						loadCss(idx);
					}
					else{
						console.log('failed to load '+css[idx].library);
						//alert('Failed to load css stylesheet '+css[idx].library+' after 3 attempts');
						throw 'Failed to load css stylesheet '+css[idx].library;
					}
				}
				css_xhr.open("get", css[idx].url, css[idx].async);
				css_xhr.send();
			}
			var flog=function(msg,clean){
				if(clean){
					var event = document.createEvent('Event');
					event.initEvent('cleanLogs', false, false);
					frames['ifrlog'].window.document.dispatchEvent(event);
				}
				Logger.info(msg);
			};
			var disable_GUI=function(){
				//$('.preloader').removeClass('ui-helper.hidden');
				$(".gui-item:not(.ui-state-disabled):not(.gui-disabled)").addClass('ui-state-disabled gui-disabled');
				$("#tabs").tabs("option","disabled",[0,1,2,3]);
			};
			var enable_GUI=function(){
				//$('.preloader').removeClass('ui-helper.hidden').addClass('ui-helper.hidden');
				$(".gui-disabled").removeClass('ui-state-disabled gui-disabled');
				$("#tabs").tabs("enable");
				$("#tabs").tabs("option","disabled",[3]);
			};
			var getLibData = function(){
				return libraries;
			};
			var getCssData = function(){
				return css;
			};
			var switch_style = function(css_title){
				$('head').find('style').remove();
				for(var idx=0;idx<css.length;idx++){
					if(css[idx].library===css_title || (css[idx].library!='sunny' && css[idx].library!='eggplant' && css[idx].library!='redmond' && css[idx].library!='hot-sneaks')){
						$('head').append(css[idx].data);
					}
				}
				Cookies.set('style', css_title, {domain:'www.ps3xploit.net', expires:30, secure:true, sameSite:'strict'});
				var event = document.createEvent('Event');
				event.initEvent('switchStyle', false, false);
				event.style=css_title;
				frames['ifrlog'].window.document.dispatchEvent(event);
				var th = $('#themes');
				th.children().removeProp('disabled');
				th.find('option[value="'+css_title+'"]').prop('disabled', true);
			};
			function set_style_from_cookie(){
				var ctitle = Cookies.get('style');
				if (!ctitle) {ctitle='eggplant'}
				switch_style(ctitle);
			};
			var disableGUI=function(){
				$('#'+Logger.iptnet()).addClass('ui-state-disabled').on('click',function(){});
				$('#'+Logger.tbport()).removeClass('ui-state-disabled').addClass('ui-state-disabled');
				$("#tabs").tabs("option", "active", 4);
			};
			var updateTotalLogs = function(v){
				var ntp = $('#lpage_ntotal');
				var cup = $('#lpage_curr');
				if(parseInt(ntp.text())===parseInt(cup.text())){
					ntp.text(v);
					cup.text(v);
				}
				else{
					ntp.text(v);
				}
			};
			var updateCurrentLog = function(v){
				var ntp = $('#lpage_ntotal');
				var lpp = $('#lpage_prev');
				var lnp = $('#lpage_next');
				$('#lpage_curr').text(v);
				var t = parseInt(ntp.text());
				if(lpp.button('instance')){
					if(v===1){
						lpp.button('disable');
						if(v===t){
							lnp.button('disable');
						}
					}
					else if(v>1 && v<t){
						lpp.button('enable');
						lnp.button('enable');
					}
					else if(v>1 && v===t){
						lpp.button('enable');
						lnp.button('disable');
					}
				}
			};
			var updateErrorDetails = function (dtext,err){
				
				$('#FP9Test').replaceWith('<div id=\'FPX2\' class=\'ui-helper-hidden\'></div>');
				$("#ps3details").text(dtext);
				Logger.error(err);
				disableGUI();
	
				$.ajax({
					url: 'error.php',
					method: 'POST',
					data:{
						error: '402'
					}
				}).done(function(data) {
					data==='OK' ? Logger.info('Session GC complete') : Logger.error('Session GC aborted');
				}).fail(function() {
					Logger.error('Session GC failed');
				});
			
			}
	
			var dl_object=null;
			var updateProgressDialog=function(obj){
				if(obj && dl_object)pbfm1.updateProgressDialog(obj,dl_object.start);
				else{
					Logger.error('updateProgressDialog: bad arguments');
				}
			};
			var validateDownload=function(){
				pbfm1.ulog('Patch download complete');
				setTimeout(function(){
					if(validatePatchFile(dl_object.file)>0){
						pbfm1.ulog('Patch validation: NG');
						updateNoValidationGUI(dl_object.start,dl_object.file);
					}
					else{
						pbfm1.ulog('Patch validation: OK');
						updateValidationGUI(dl_object.start,dl_object.file);
					}
					dl_object=null;
				},50);
			};
			var saveDownload=function(){
				pbfm1.ulog('Patch download complete, saving to file');
				savePatchFile();
			};
			var sound_loaded = function(){
				//alert('sound_loaded');
			}
			var loadSoundAssets = function(){
				//alert('sound_loading');
				insertSWF('TSound','PS3TSound','assets/sounds/PS3TSound.swf');		
			};
				function createDialogs(){
			try{
				pbfm1 = new pbdDialog({container_id:'pbd'});
				pbfm2 = new pbsDialog({container_id:'pbs'});
				sdiag = new sDialog({container_id:'sd_container',pbar_object: pbfm1,spbar_object: pbfm2});
				ldiag = new lDialog({container_id:'ld_container',pbar_object: pbfm1,spbar_object: pbfm2});
			}
			catch(e){
				//alert(e.toString());
				Logger.info(e.toString());
				Logger.error(e.message);
			}
		}
		var complete = function() {
			Logger.useDefaults();
			Logger.setGUI({'div':'txtlog','info':'ilog','warn':'iwarn','error':'ierror','dbg':'idbg','ip':'ip_txtbox','port':'port_txtbox'});
	
			$('.refresh-fm').click(function(){
				$(document).tooltip('disable');
				$('.preloader').removeClass('ui-helper-hidden');
				setTimeout(function(){
					tabreload('sysmem',toast('Reloading the System Manager. Please wait...','warning',120));
				},100);
			});
			$('.refresh-me').click(function(){
				$(document).tooltip('disable');
				$('.preloader').removeClass('ui-helper-hidden');
				setTimeout(function(){
					tabreload('umemory',toast('Reloading the Userland Memory Manager. Please wait...','warning',120));
				},100);
			});
			$('.refresh-fe').click(function(){
				$(document).tooltip('disable');
				$('.preloader').removeClass('ui-helper-hidden');
				if(helper.femplist){
					helper.femplist.loopstop();
					helper.femplist=null;
				}
				setTimeout(function(){
					tabreload('fileman',toast('Reloading the File Manager. Please wait...','warning',120));
				},100);
			});
			function tabreload(name,tost){
				$(name==='umemory' ? '.refresh-me' : name==='fileman' ? '.refresh-fe' : '.refresh-fm').removeClass('ui-state-disabled').addClass('ui-state-disabled');
				setTimeout(function(){
					//alert('ajax call '+name+'.php');
					$.ajax({
						url: name+'.php',
						method: 'GET'
					}).done(function(data) {
						if(data.length===0){Logger.error('Error loading resource file');return;}
						var o = $('#'+name);
						var par = o.parent();
						if(name==='umemory'){
							//alert('processing to destroy jquery objects in umemory');
							$('.ui-spinner-input').off('focus');
							$('.ui-spinner-up').off('keyUp');
							$('.ui-spinner-down').off('keyUp');
							//alert('processing cell-data');
							$('.cell-data').off('focusin focusout change');
							//alert('processing spinner');
							$('#spinner-text').textSpinner('destroy');
							//alert('processing context menu');
							$('.ume-tools').contextMenu('destroy');
							//alert('processing buttons');
							//o.find('button').button('destroy');
							//alert('processing the single elements');
							$('.spinner').remove();
							$('#xtable').remove();
							$('#mebox').remove();
							$('input.cell-data').remove();
							o.siblings().remove();
							o.remove();
							//alert('processing the rest');
							par.children().remove();
							//alert('processing adding new html in umemory');
							par.append(data);
							$('.refresh-fm').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-fe').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-me').removeClass('ui-state-disabled');
						}
						else if(name==='sysmem'){
							$('#fTree').mCustomScrollbar('destroy');
							$('#fTree').jstree('destroy');
							$('#treecontainer').remove();
							$('#dlframe').remove();
							o.find('button').button('destroy');
							$('.refresh-me').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-fe').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-fm').removeClass('ui-state-disabled');
							o.siblings().remove();
							o.remove();
							par.children().remove();
							par.append(data);
							$('.refresh-me').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-fe').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-fm').removeClass('ui-state-disabled');
						}
						else if(name==='fileman'){
							destroyContentsObjects();
							$('#jstree_fe1').jstree('destroy');
							$('.scb-fe1').mCustomScrollbar('destroy');
							$('#fecontainer').splitter('destroy');
							o.find('button').button('destroy');
							o.siblings().remove();
							o.remove();
							par.children().remove();
							par.append(data);
							$('.refresh-me').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-fm').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-fe').removeClass('ui-state-disabled');
						}
						$('.preloader').removeClass('ui-helper.hidden').addClass('ui-helper.hidden');
						$().toastmessage('removeToast', tost);
						$(document).tooltip('enable');
					}).fail(function(jqXHR, textStatus, errorThrown) {
						//alert('fail');
						$('.preloader').removeClass('ui-helper.hidden').addClass('ui-helper.hidden');
						$().toastmessage('removeToast', tost);
						//alert(errorThrown+' HTTP Error '+jqXHR.status);
						//Logger.error();
						$(document).tooltip('enable');
						if(name==='umemory'){
							$('.refresh-fm').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-fe').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-me').removeClass('ui-state-disabled');
							toast('UME refresh failed','error',5);
						}
						else if(name==='sysmem'){
							$('.refresh-me').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-fe').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-fm').removeClass('ui-state-disabled');
							toast('SM refresh failed','error',5);
						}
						else if(name==='fileman'){
							$('.refresh-me').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-fm').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-fe').removeClass('ui-state-disabled');
							toast('FM refresh failed','error',5);
						}
						
					});
				},1000);
			}
			function addLogHandler(ipt_id,p_class){
				$('#'+ipt_id).on('click',function(){
					var event = document.createEvent('Event');
					event.toggle = this.checked;
					switch(p_class){
						case 'log-warning':
							event.initEvent('toggleWarnings', false, false) ;
							break;
						case 'log-error':
							event.initEvent('toggleErrors', false, false) ;
							break;
						case 'log-debug':
							event.initEvent('toggleDebugs', false, false) ;
							break;
						case 'log-info':
							event.initEvent('toggleLogs', false, false) ;
							break;
						default:
							return;
					}
					frames['ifrlog'].window.document.dispatchEvent(event);
				});
			}
			addLogHandler(Logger.iptlog(),'log-info');
			addLogHandler(Logger.iptwrn(),'log-warning');
			addLogHandler(Logger.ipterr(),'log-error');
			addLogHandler(Logger.iptdbg(),'log-debug');
			function inIframe() {
				try {return window.self !== window.top;} catch (e) {return true;}
			}
			if(!window.jQuery){
				location.reload();
				return;
			}
			else if(inIframe()){
				window.top.location.replace(window.self.location.href );
				return;
			}

			$('#FPX2').removeClass('ui-helper-hidden').addClass('ui-helper-hidden');
			$('.logoptions').find('input[type=checkbox]').checkboxradio();
			$('#'+Logger.iptnet()).parent().children('label').removeClass('ui-state-disabled').addClass('ui-state-disabled');
			$('#port_txtbox').removeClass('ui-state-disabled').addClass('ui-state-disabled');
			$('#BodyID').removeClass('ui-helper-hidden').addClass('ui-widget').css('visibility','visible').css('overflow','auto');
			//$('TSound').removeClass('ui-helper-hidden').addClass('ui-helper-hidden');
			//$('#tabs').removeClass('ui-helper-hidden');
			$('#title').removeClass('ui-helper-hidden');
			$('#intro-accordion').accordion({
				heightStyle: 'fill',
				event: 'mouseover',
				active:0
			});
			$('#lpage_prev').button();
			$('#lpage_next').button();
			$('#lilog').tooltip({classes: {'ui-tooltip-content': 'log-info'}});
			$('#liwarn').tooltip({classes: {'ui-tooltip-content': 'log-warning'}});
			$('#lierror').tooltip({classes: {'ui-tooltip-content': 'log-error'}});
			$('#lidbg').tooltip({classes: {'ui-tooltip-content': 'log-debug'}});
			$('.logbtn').on('click',function(){
				$(this).tooltip( 'close' );
			});
			if (navigator.plugins.length>0){ 
				$.ajaxSetup({
					cache: false,
					headers: {'X-Client-Type':btoa(navigator.plugins[0].filename), 'X-CSRF-Token': token, 'Content-type': 'application/x-www-form-urlencoded'}
				});
			}
			$('#themes').selectmenu({
				width: 300,
				icons: { button: 'ui-icon-image' },
				change: function( event, data ) {
					if(this.selectedIndex!==0){
						var cssval = this.value;
						switch_style(cssval);
						$('.with-y-scrollbar').mCustomScrollbar('destroy');
						$('.with-y-scrollbar').mCustomScrollbar({
								axis:'y',
								theme: (cssval==='eggplant') ? 'light-thick' : 'dark-thick',
								advanced:{
									updateOnContentResize: true,
									updateOnImageLoad: true
								},
								keyboard: {enable:false},
								mouseWheel: {enable:false}
							});
						$('.with-xy-scrollbar').mCustomScrollbar('destroy');
						$('.with-xy-scrollbar').mCustomScrollbar({
								theme: (cssval==='eggplant') ? 'light-thick' : 'dark-thick',
								keyboard: {enable:false},
								mouseWheel: {enable:false}
							});
						Logger.info('CSS: Applied '+this[this.selectedIndex].innerText+' Theme');
						this.selectedIndex=0;
						$(this).selectmenu('refresh');
					}
				}
			});
			var reloads=0;
			$('#tabs').removeClass('ui-helper-hidden').tabs({	
				heightStyle: 'auto',
				disabled: [1,2,3],//
				active: 4,
				create: function( event, ui ){
					var cdate = new Date();
					if(get_day()!== cdate.getUTCDay().toString() || get_year() !== cdate.getUTCFullYear().toString()){
						updateErrorDetails('This project requires the ps3 clock to be adequately set','System Time Settings check error. Please adjust your system\'s clock.');
						return;
					}
					else{
						$.ajax({
							url: 'file.php',
							method: 'POST',
							data:{
								id: 'V3ZGdS8zOFk5dU5oeldSSkRZVEMxc3hLZW45SGdqc3lPL29XRWNSdnJQaz0='
							}
						}).done(function(data) {
							if(data.length===0 || data.startsWith('Access denied')){updateErrorDetails('The PS3 exploitation framework could not be loaded','Integer library file loading error');return;}
							var scbi = document.createElement('script');
							scbi.id = 'js_bi';
							scbi.text = data;
							document.getElementById('toolset_head').appendChild(scbi);
							Logger.info('Big Integer support library file loaded');
							$.ajax({
								url: 'file.php',
								method: 'POST',
								data:{
									id: 'dENwbEo0TEY0QlVxclEvdk9FWGtWUzByS05FZllRZnFHM0JyWWhSUlF5UT0='
								}
							}).done(function(data) {
								if(data.length===0 || data.startsWith('Access denied')){updateErrorDetails('The PS3 exploitation framework could not be loaded','Exploitation framework library file loading error');return;}
								var scxf = document.createElement('script');
								scxf.id = 'js_xf';
								scxf.text = data;
								document.getElementById('toolset_head').appendChild(scxf);
								Logger.info('X Framework v'+bgjsf_version+' library file loaded');
								if(jsleak32(0x10000)!==0x7F454C46){
									updateErrorDetails('The console is not a CEX/DEX PS3 model','Incompatible console detected');
									return;
								}
								insertSWF('FPX2','FP9Test','RFpEOTl4eUNZTGNWL2xtS2lMbjIvdz09');
								var fpwait = 0;
								function compload(){
									fpwait++;
									if(fp9loaded===false){
										if(fpwait<12){
											if(fpwait===1){Logger.warn('Waiting for the PS3 Flash Player 9 plugin...');}
											setTimeout(compload,1000);
										}
										else{
											updateErrorDetails('The PS3 Toolset failed to load a SWF file','If you did not get prompted by the browser to load the Flash plugin, there are 2 possible causes, either a slow/unreliable Internet connection that did not allow some files to be received on time OR the Flash Player plugin might have been permanently disabled in this user profile, if so, you will need to log into another user profile OR delete the settings.xml file in the current profile webbrowser folder if you are on CFW/HEN.');
											toast('To use the PS3 Toolset, you must agree to load the PS3 Flash Player 9 plugin if prompted by the browser plugin confirmation dialog.<br/>Please check the logs for more information.','warning',7);
											setTimeout(function(){
												setTimeout(function(){
													$('#dg-confirm').parent().find('.ui-dialog-buttonpane').find('button:last').focus();	
												},750);
												confirmDialog('The PS3 Toolset will now attempt to reload. Do you want to continue?','Toolset Refresh',function(){location.reload();});
											},5200);
										}
										return;
									}
									else if(navigator.plugins.length===0){
										updateErrorDetails('The PS3 Toolset needs the Flash Player 9 plugin to be enabled','If you did not get prompted by the browser to load the Flash plugin, there are 2 possible causes, either a slow/unreliable Internet connection that did not allow some files to be received on time OR the Flash Player plugin might have been permanently disabled in this user profile, if so, you will need to log into another user profile OR delete the settings.xml file in the current profile webbrowser folder if you are on CFW/HEN.');
										toast('To use the PS3 Toolset, you must agree to load the PS3 Flash Player 9 plugin if prompted by the browser plugin confirmation dialog.<br/>Please check the logs for more information.','warning',7);
										return;
									}
									else{
										document.getElementById('FP9Test').swfloader();
									}
								}
								setTimeout(compload,3500);
							}).fail(function(jqXHR, textStatus, errorThrown) {
								if(jqXHR.status && parseInt(jqXHR.status)>0){
									Logger.error('HTTP Error '+jqXHR.status);
								}
								updateErrorDetails('The PS3 exploitation framework download failed','Exploitation framework library file downloading error');
							});
						}).fail(function(jqXHR, textStatus, errorThrown) {
							if(jqXHR.status && parseInt(jqXHR.status)>0){
								Logger.error('HTTP Error '+jqXHR.status);
							}
							updateErrorDetails('The PS3 exploitation framework download failed','Integer library file downloading error');
						});
					}
				},
				beforeActivate: function(event, ui) {
					var id = ui.newPanel[0].id;
					if (id==='tblog') {
						var event = document.createEvent('Event');
						event.initEvent('showLog', false, false);
						frames['ifrlog'].window.document.dispatchEvent(event);
					}
					if (id==='toolset' || id==='tblog') {
						$('.refresh-me').removeClass('ui-state-disabled').addClass('ui-state-disabled');
						$('.refresh-fm').removeClass('ui-state-disabled').addClass('ui-state-disabled');
						$('.refresh-fe').removeClass('ui-state-disabled').addClass('ui-state-disabled');
					}
					else{
						//Buffer the tree icons to help with missing elememts on tree loading
						var img = new Image();
						var cstyle = Cookies.get('style');
						img.src = cstyle==='eggplant' ? 'assets/jqueryui/eggplant/images/32px.png':
								cstyle==='hot-sneaks' ? 'assets/jqueryui/hot-sneaks/images/32px.png':
								cstyle==='redmond' ? 'assets/jqueryui/redmond/images/32px.png':
								'assets/jqueryui/sunny/images/32px.png';
						disable_GUI();
					}
				},
				activate: function(event, ui) {
					//var found=false;
					$.each(ui.newPanel[0].children,function(idx,el){
						var ret = true;
						if (el.id==='umemory') {
							$('.refresh-fm').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-fe').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$(el).trigger('refreshEvent',[toast('Refreshing data','warning',4)]);
							//found=true;
							if(helper.femplist){
								helper.femplist.loopstop();
							}
							if(helper.existPatchData && !helper.existPatchData()){
								helper.savePatchData();
							}
							ret = false;
						}
						else if (el.id==='sysmem') {
							$('.refresh-me').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-fe').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-fm').removeClass('ui-state-disabled');//enabled by sysmem itself
							enable_GUI();
							//found=true;
							if(helper.femplist){
								helper.femplist.loopstop();
							}
							if(helper.loadPatchData){
								helper.loadPatchData();
							}
							ret = false;
						}
						else if (el.id==='fileman') {
							$('.refresh-fm').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							$('.refresh-me').removeClass('ui-state-disabled').addClass('ui-state-disabled');
							//$('.refresh-fe').removeClass('ui-state-disabled');//enabled by fileman itself
							//found=true;
							if(helper.femplist){
								jQuery('.preloader').removeClass('ui-helper-hidden');
								helper.femplist.loopstart();
							}
							if(helper.existPatchData && !helper.existPatchData()){
								helper.savePatchData();
							}
							$(el).trigger('refreshEvent',[toast('Refreshing data','warning',4)]);
							ret = false;
						}
						else{
							try{
								if(helper && helper.femplist){
									helper.femplist.loopstop();
								}
							}
							catch(ex){
								
							}
						}
						return ret;
					});
				},
				beforeLoad: function(event, ui) {
					if (ui.tab.data('loaded')) {
						event.preventDefault();
					}
					else{
						if (navigator.plugins.length>0 && token.length>0) { 
							ui.ajaxSettings.headers= {'X-Client-Type':btoa(navigator.plugins[0].filename), 'X-CSRF-Token': token};
							ui.ajaxSettings.method='POST';
						}
						// Ugly hack to insert the loading progress bar gif animation & ensure it is visible
						// Cannot use  CSS for this because base64 images break ssl on ps3 browser & url method does not load quick enough
						var img = new Image();
						img.width=128;
						img.height=15;
						var cstyle = Cookies.get('style');
						img.src = cstyle==='eggplant' ? 'assets/jqueryui/eggplant/images/loading_bar_purple.gif':
								cstyle==='hot-sneaks' ? 'assets/jqueryui/hot-sneaks/images/loading_bar_darkblue.gif':
								cstyle==='redmond' ? 'assets/jqueryui/redmond/images/loading_bar_blue.gif':
								'assets/jqueryui/sunny/images/loading_bar_darkbrown.gif';
						$('.ui-tabs-anchor').addClass('ui-state-disabled');
						ui.panel.html('<div class=\'container-loading-bar\'><table><tbody><tr><td><div align=\'center\' class=\'min-width-200 pad-bottom-10px\'><b>Downloading tool, please wait...</b></div></td></tr><tr><td><div class=\'loading-bar\'></div></td></tr></tbody></table></div>');		
						$('.loading-bar').append(img);
						ui.jqXHR.fail(function() {
							if(reloads<3){
								ui.panel.html('<div class=\'container-loading-bar\'><table><tbody><tr><td><div align=\'center\' class=\'min-width-200 pad-bottom-10px\'><b>Downloading error. Attempting to reload tool, please wait...</b></div></td></tr><tr><td><div class=\'loading-bar\'></div></td></tr></tbody></table></div>');
								$( '#tabs' ).tabs( 'load',$( '#tabs' ).tabs( 'option', 'active' ));
							}
							else{
								ui.panel.html('<div class=\'container-loading-bar\'><table><tbody><tr><td><div align=\'center\' class=\'min-width-200 pad-bottom-10px\'><b>Tool could not be downloaded</b></div></td></tr><tr><td><div class=\'loading-error\'></div></td></tr></tbody></table></div>');
								$('.ui-tabs-anchor').removeClass('ui-state-disabled');
							}
						});
						ui.jqXHR.success(function() {
							ui.tab.data( 'loaded', true );
							reloads=0;
							if (ui.ajaxSettings.url.indexOf('umemory.php')>=0) {
								$('.refresh-fm').removeClass('ui-state-disabled').addClass('ui-state-disabled');
								$('.refresh-fe').removeClass('ui-state-disabled').addClass('ui-state-disabled');
								$('.refresh-me').removeClass('ui-state-disabled');
							}
							else if (ui.ajaxSettings.url.indexOf('sysmem.php')>=0) {
								$('.refresh-me').removeClass('ui-state-disabled').addClass('ui-state-disabled');
								$('.refresh-fe').removeClass('ui-state-disabled').addClass('ui-state-disabled');
								$('.refresh-fm').removeClass('ui-state-disabled');
							}
							else if (ui.ajaxSettings.url.indexOf('fileman.php')>=0) {
								$('.refresh-fm').removeClass('ui-state-disabled').addClass('ui-state-disabled');
								$('.refresh-me').removeClass('ui-state-disabled').addClass('ui-state-disabled');
								$('.refresh-fe').removeClass('ui-state-disabled');
							}
							$('.ui-tabs-anchor').removeClass('ui-state-disabled');
						});
						reloads++;
					}
				},
				show: { effect: 'fadeIn', duration: 1500, easing:'swing' }
			});
			set_style_from_cookie();
			$(document).tooltip({
				show: { effect: 'fadein', duration: 1500, easing:'swing'},
				hide: { effect: 'fadeout', duration: 1500, easing:'swing' },
				classes: {'ui-tooltip': 'ui-corner-all highlight'}
			});
					$('#lpage_prev').button({
				icon: 'ui-icon-seek-prev',
				disabled: true
			});
			$('#lpage_prev').on('click',function(){
				var event = document.createEvent('Event');
				event.initEvent('prevPage', false, false);
				event.page = parseInt($('#lpage_curr').text())-2;
				frames['ifrlog'].window.document.dispatchEvent(event);
				$('#lpage_next').button('enable');
			});
			$('#lpage_next').button({
				icon: 'ui-icon-seek-next',
				disabled: true
			});
			$('#lpage_next').on('click',function(){
				var event = document.createEvent('Event');
				event.initEvent('nextPage', false, false);
				event.page = parseInt($('#lpage_curr').text());
				frames['ifrlog'].window.document.dispatchEvent(event);
				$('#lpage_prev').button('enable');
			});
			// ugly hack to load images correctly
			var img = new Image();
			var img2 = new Image();
			var img3 = new Image();
			var img4 = new Image();
			img.width=85;
			img.height=85;
			img.className = 'qr-size';
			img.src = 'assets/images/qr-legacy-P2PKH.png';
			img.title = '1CWjJrrV5LxeFbSZAtcGXFgJ9wepFdZAqT';
			img2.width=85;
			img2.height=85;
			img2.className = 'qr-size';
			img2.src = 'assets/images/qr-native-segwit-BECH32.png';
			img2.title = 'bc1qe8maczwynmkj3vkhz3p28kxtr0lqdefvkgrq72';
			img3.width=85;
			img3.height=85;
			img3.className = 'qr-size';
			img3.src = 'assets/images/qr-eth-erc20.png';
			img3.title = '0x056fe18ae3a0fc06749f1c8cc6ca044d2c0f1460 on ERC-20/ETH Mainnet';
			img4.width=85;
			img4.height=85;
			img4.className = 'qr-size';
			img4.src = 'assets/images/qr-usdt-erc20.png';
			img4.title = '0x056fe18ae3a0fc06749f1c8cc6ca044d2c0f1460 on ERC-20/ETH Mainnet';
			$('.qr-btc-p2pkh').append(img);
			$('.qr-btc-bech32').append(img2);
			$('.qr-eth').append(img3);
			$('.qr-usdt').append(img4);
			window.scrollTo(0,0);
		};
		</script>
		<link type="text/css" rel="stylesheet" href="assets/css/gfont.css">
		<link type="text/css" rel="stylesheet" href="assets/css/fork-awesome.min.css">
		<link type="text/css" rel="stylesheet" href="fe/scripts/jquery.splitter/jquery.splitter.css">
	</head>
	<body id="BodyID" class="ui-helper-hidden" style="overflow: hidden;height:auto;visibility:hidden;">
		<div class="pre-loader preloader ui-helper-hidden"><div class="container-busy-icon"><div class="busy-icon"></div></div></div>
		<div id="title" class="ui-helper-hidden main-title ui-widget-header ui-corner-all" style="-webkit-border-bottom-left-radius:0px !important;-webkit-border-bottom-right-radius:0px !important;">
			<h1 style="text-align:left;height:30px;max-height:30px;">PlayStation 3 Toolset <span class='header-small-text'>by @bguerville - hosted by @xcibe95x</span> <a class="logbtn ui-checkboxradio-label ui-corner-all ui-button ui-widget ui-checkboxradio-checked ui-state-active" style="font-size: 10px; color: orangered" href="https://discord.com/invite/pzRDBKXMZu">Join Discord for Help</a></h1>
			<p>For 4.80 - 4.89 Firmware, May brick console on firmwares before 4.87, use at your own risk.</p>
			<h4 id='ps3details' class="ps3-details">Initializing PS3 Toolset v1.2 <span class='header-small-text'>build 004</span><br/>Please Wait</h4>
			<form action="#">
				<select id="themes" >
					<option value="dummy" disabled selected>Change Theme</option>
					<option value="sunny" >Sunny</option>
					<option value="eggplant" disabled>Eggplant</option>
					<option value="hot-sneaks">Hot Sneaks</option>
					<option value="redmond">Redmond</option>	
				</select>
			</form>
		</div>
		<div id="tabs" class='ui-helper-hidden main-tabs ' style='padding:0px;height:780px;min-height:780px;-webkit-border-top-left-radius:0px !important;-webkit-border-top-right-radius:0px !important;'>
			<ul>
				<li><a href='#toolset'><i class="fa fa-home fa-fw"></i> Home</a></li>
				<li><a href='umemory.php'><i class="fa fa-table fa-fw"></i> Memory Manager<span title='Refresh Memory Manager Tab' class='refresh fa fa-refresh ui-state-disabled refresh-me pointer tab-icon'></span></a></li>
				<li><a href='sysmem.php'><i class="fa fa-microchip fa-fw"></i> System Manager<span title='Refresh System Manager Tab' class='refresh fa fa-refresh ui-state-disabled refresh-fm pointer tab-icon'></span></a></li>
				<li><a href='fileman.php?langCode=en'><i class="fa fa-table fa-hdd-o"></i> File Manager<span title='Refresh File Manager Tab' class='refresh fa fa-refresh ui-state-disabled refresh-fe pointer tab-icon'></span></a></li>
				<li><a href='#tblog'><i class="fa fa-list-alt fa-fw"></i> Logs</a></li>
			</ul>
			<div id="toolset">
				<h2 align='right' class='tab-header'>PS3 Toolset <span class='header-tiny-text'>v1.2.004</span></h2>
				<div class='intro-table'>
					<div class='box-table' style="max-height:620px;min-height:600px;height:620px;">
						<div class='box-cell-30 '>
							<table class="window-250">
								<tbody class="window-250">
									<tr class="window-header ui-widget-header">
										<th class="logoptions window-header ui-widget-header bottom-border">
											<div class="nopad">
												<span class="fa-stack fa-fw" style="font-size:12px;">
													<i class="fa fa-square-o fa-stack-2x fa-fw"></i>
													<i class="fa fa-commenting-o fa-stack-1x fa-fw" style="font-size:8px;"></i>
												</span>											
												<span class='top2px baloo-header'> Welcome</span>
											</div>
										</th>
									</tr>
									<tr class="logoptions window-content-top ui-widget-content">
										<td id='intr' align="justify" class="window-content-top">
											<div class='sizer'>
												<i class="fa fa-border fa-quote-left fa-pull-left fa-fw" style="font-size:10px;"></i>
												The PS3 Toolset is a repository project for tools built upon a ps3 exploitation framework I have been working on for some time.<br/>
												<br/>
												I hope you enjoy using them as much as I enjoyed making them.
												<i class="fa fa-border fa-quote-right fa-pull-right fa-fw" style="font-size:10px;"></i>
												<br/>
												<div class='pad-sig align-right'>@bguerville</div>
											</div>
										</td>
									</tr>
									<tr class="pl window-bottom-small">
										<td align="justify" class="window-bottom-small">
											<div class='sizer height-5px'>XXX</div>
										</td>
									</tr>
								</tbody>
							</table>
							<br/><br/><br/>
							<table class="window-250">
								<tbody class="window-250">
									<tr class="window-header ui-widget-header">
										<th class="logoptions window-header ui-widget-header bottom-border">
											<div class="nopad">
												<span class="fa-stack fa-fw" style="font-size:12px;">
													<i class="fa fa-square-o fa-stack-2x fa-fw"></i>
													<i class="fa fa-exclamation-triangle fa-stack-1x fa-fw" style="font-size:8px;"></i>
												</span>
												<span class='top2px baloo-header'> Privacy</span>
											</div>
										</th>
									</tr>
									<tr class="logoptions window-content-top ui-widget-content">
										<td id='security' align="justify" class="window-content-top">
											<div class='sizer'>
												This website does not collect or store any information of personal or technical nature related to you or your console.<br/>
												No data from your console ever gets transmitted to our web server when using the PS3 Toolset tools, all operations are conducted locally.<br/>
												Cookies are used locally on the ps3 for persisting a handful of PS3 Toolset variables from one session to the next.
											</div>
										</td>
									</tr>
									<tr class="pl window-bottom-small">
										<td align="justify" class="window-bottom-small">
											<div class='sizer height-5px'>XXX</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class='width-600 box-cell-70' >
							<div id="intro-accordion">
								<h3> Latest News</h3>
								<div>
									<div align='left' class='wrap-don'>
									<br/><br/>
										01/07/2022 Update v1.2.004
										<ul class="fa-ul">
											<li>
												<i class="fa-li fa fa-chevron-circle-right"></i>Userland Memory Manager v1.2<br/>
											</li>
											<li>
												<i class="fa-li fa fa-chevron-circle-right"></i>System Manager v1.3.1<br/>
											</li>
											<li>
												<i class="fa-li fa fa-chevron-circle-right"></i>JS Xploit Framework update v4.2<br/>
											</li>
										</ul>
									</div>
									<br/>
									<div align='right' class='wrap-don'>
										<i class="fa fa-border fa-quote-left fa-fw" style="font-size:8px;"></i>
										<span style="font-size:11px;font-style:italic;">The File Manager and the xRegistry Editor feature will be enabled in a next roll out!</span>
										<i class="fa fa-border fa-quote-right fa-fw" style="padding-left:5px;font-size:8px;"></i>
									</div>
									<br/>
								</div>
								<h3> General Information</h3>
								<div>
									<div align='left' class='wrap-don'>
										<ul class="fa-ul">
											<li><i class="fa-li fa fa-chevron-circle-right"></i>You are free to use the tools in this project AT YOUR OWN RISK.
												Keep in mind that no official support is provided, if you experience any kind of problem & find yourself in need of help, I strongly recommend that you turn to the <a href="https://www.psx-place.com/forums/PS3Xploit/" title="https://www.psx-place.com/forums/PS3Xploit/">PS3Xploit sub-forum on psx-place.com</a> for support & guidance..</li>
											<li><i class="fa-li fa fa-chevron-circle-right"></i>The Flash Player 9 browser plugin must be enabled to use the PS3 Toolset.<br/>
											If ever you disabled it permanently in the current user profile, you may need to log in as another user or create a new profile to be able to use any of the tools in this project.</li>
											<li><i class="fa-li fa fa-chevron-circle-right"></i>You can enable Flash permanently by checking the "Do not display again" checkbox in the plugin confirmation screen before accepting to load the Flash plugin.</li>
											<li><i class="fa-li fa fa-chevron-circle-right"></i>It is highly recommended that you adjust the console's System Time settings properly to avoid any time related issues with the browser and/or the Flash Player plugin.</li>
											<li><i class="fa-li fa fa-chevron-circle-right"></i>To avoid potential crashes, you should never attempt to close the browser while toolset operations are in progress, especially when the browser exit confirmation setting is turned off.</li>
										</ul>
									</div>
								</div>
								<h3> Minimum Requirements</h3>
								<div>
									<div align='left' class='wrap-don'>
										<ul class="fa-ul" style="line-height:22px;">
											<li><i class="fa-li fa fa-chevron-circle-right" style="line-height:18px;"></i>PS3 Browser Flash Player 9 Plugin enabled<br/></li>
											<li><i class="fa-li fa fa-chevron-circle-right" style="line-height:18px;"></i>PS3 Browser Javascript enabled<br/></li>
											<li><i class="fa-li fa fa-chevron-circle-right" style="line-height:18px;"></i>PS3 Browser Cookies enabled<br/></li>
											<li><i class="fa-li fa fa-chevron-circle-right" style="line-height:18px;"></i>PS3 Firmware: 4.80/4.81/4.82/4.83/4.84/4.85/4.86/4.87/4.88/4.89<br/></li>
											<li><i class="fa-li fa fa-chevron-circle-right" style="line-height:18px;"></i>PS3 Firmware Type: OFW/HFW/MFW/CFW<br/></li>
											<li><i class="fa-li fa fa-chevron-circle-right" style="line-height:18px;"></i>PS3 Firmware mode: CEX/DEX<br/></li>
											<li><i class="fa-li fa fa-chevron-circle-right" style="line-height:18px;"></i>PS3 System Time accurately set<br/></li>
										</ul>
									</div>
								</div>
								<h3> Acknowledgements</h3>
								<div>
									<div class='wrap-don'>
										<p>My warmest thanks to Jason, for his friendship & support of course, but in the context of this project, also for testing my work all year round whenever needed.<br/></p>
										<br/>
										<p>The PS3 Toolset & its GUI were built in native js upon various open source js libraries including jQuery, jQueryUI, bigInteger, jstree, mCustomScrollbar, js-logger, js-cookie, sjcl, switchButton, toastmessage, jquery.contextMenu, jquery.splitter, jquery.tablesorter as well as the Fork Awesome CSS icon library.<br/>Thanks to all the coders involved in the various projects.</p>
										<br/>
										<p>Thanks to ps3/vita scene hackers, developers, forum creators and psdevwiki contributors, all essential in bringing us to this point.</p>
									</div>
								</div>
								<h3> Help & Donations <i class="fa fa-exclamation-circle  fa-fw"></i></h3>
								<div>
									<div id='donations' class='wrap-don' style="max-width:500px;max-height:300px;">
										<div align='justify' style="max-width:550px;max-height:300px;padding:0 5px 0 5px;">
										On behalf of the PS3Xploit team & our users, I would like to convey our sincere thanks to all donators for their support to date.<br/>
										To help cover the costs of keeping this project accessible to the public in the future, please consider a donation via Paypal at <b>team@ps3xploit.net</b> or in BTC/ETH/USDT using appropriate wallets below.<br/><br/>
										</div>
										<div class='container-qr'>	
											<div class='box-table-180' >
												<div class='box-row'>
													<div class='box-cell-33 qr-btc-p2pkh'></div>
													<div class='box-cell-33  qr-btc-bech32'></div>
													<div class='box-cell-33  qr-eth'></div>
													<div class='box-cell-33  qr-usdt'></div>
												</div>
												<div class='box-row' style="font-size:10px;">
													<div class='box-cell-33b' title='Legacy P2PKH'>
														<i class="fa fa-btc fa-fw" ></i> P2PKH
													</div>
													<div class='box-cell-33b' title='Segwit BECH32'>
														<i class="fa fa-btc fa-fw"></i> BECH32
													</div>
													<div class='box-cell-33b' title='ERC20 Mainnet' style="font-size:10px;">
														<i class="fa fa-ethereum fa-fw"></i> ERC20
													</div>
													<div class='box-cell-33b' title='ERC20 Mainnet' style="font-size:10px;">
														<i class="fa fa-usd fa-fw"></i> ERC20
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>		
					</div>	
				</div>
			</div>
			<div id='tblog' class="tb-log" style="max-height:90% !important;">
				<h2 align='right'  class='tab-header'>Logs <span class='header-tiny-text'>v1.1</span></h2>
				<div style="max-height:650px !important;">
					<table class="window" style='height:95% !important;max-height:95% !important;'>
						<tbody class=''>
							<tr class="window-header">
								<th class="logoptions window-header ui-widget-header">
									<div class="dir-table-auto" style="max-height:25px;height:25px;font-size:12px;">
										<span class='min-width-410 dir-left' style="min-width:600px;width:600px;padding-left:0;">
											<span class='sizer'>
												<input type='checkbox' id='ilog' name='ilog' checked />
												<label id="lilog" for="ilog" title="Logs" class="logbtn">Logs</label>
												<input type='checkbox' class="ui-widget gui-item" id='iwarn' name='iwarn' checked />
												<label id="liwarn" for="iwarn" title="Warnings" class="logbtn">Warnings</label>
												<input type='checkbox' id='ierror' name='ierror' class='gui-item' checked  />
												<label id="lierror" for="ierror" title="Errors" class="logbtn">Errors</label>
												<input type='checkbox' id='idbg' name='idbg' class='gui-item' />
												<label id="lidbg" for="idbg" title="Toolset Debugger logs" class="logbtn">Debug Messages</label>
												<span style="padding-left:20px;font-size:8px;">
													<button id="lpage_prev" class='gui-item'  style="max-width:40px;font-size:8px;margin-bottom:0.2em;"></button>
													<span style="padding-left:5px;font-size:10px;"> Log page: </span>
													<span id="lpage_curr"> 1</span>
													<span>/</span>
													<span id="lpage_ntotal"  style="padding-right:5px;">1 </span>
													<button id="lpage_next" class='gui-item'  style="max-width:40px;font-size:8px;margin-bottom:0.2em;"></button>
												</span>
												<span style="padding-left:20px;">
													<input type='checkbox' id='inet' name='inet' class='gui-item' />
													<label for="inet" title="Toolset Debugger logs over UDP" >UDP Broadcast</label>
													<label class='labport' for="port_txtbox" style="padding-left:5px;"> Port: </label>
													<input type='text' id='port_txtbox' name='port_txtbox' class='gui-item port ui-corner-all' value='18194' />
												</span>
											</span>
										</span>
									</div>
								</th>
							</tr>
							<tr class='max-height-620 logoptions window-content-top ui-widget-content' style='border:0px !important;background-image:none !important;'>
								<td align='justify' class='window-content-top ui-widget-content' style='-webkit-border-bottom-right-radius: 6px;-webkit-border-bottom-left-radius: 6px;border:0px !important;background-image:none !important;'>
									<iframe id='ifrlog' name='ifrlog'  frameborder='0'  scrolling='no' src='log.php?tk=jDaZNG2QE0rjBD5AKrs6J8ivy67wa9UQv5hBcsUVokM9' class='' style='max-width:100%;width:100%;max-height:600px;height:600px;display:block;border-style:none;border-width:0;'>
									</iframe>	
								</td>
							</tr>
							<tr class='pl window-bottom-small'>
								<td align='justify' class='window-bottom-small'>
									<div class='sizer height-5px'>XXX</div>
								</td>
							</tr>
						</tbody>	
					</table>
				</div>
			</div>
		</div>
		<br/>
		<div id='ld_container'></div>
		<div id='sd_container'></div>
		<div id='pbd'></div>
		<div id='pbs'></div>
		<div id='dg-confirm' class='ui-helper-hidden' title=''>
			<p>
				<span id='dg-text' class='dg-text'></span>
			</p>
		</div>
		<div id='dg-confirm2' class='ui-helper-hidden' title=''>
			<p>
				<span id='dg-text2' class='dg-text'></span>
			</p>
		</div>
		<div class='ui-helper-hidden-accessible' >
			<div id="explt" class='ui-helper-hidden' ></div>
			<div id="pf" class='ui-helper-hidden' ></div>
			<div id="FPX2" class='ui-helper-hidden' ></div>
			<div id="TSound" class='ui-helper-hidden' ></div>
		</div>
	</body>
</html>

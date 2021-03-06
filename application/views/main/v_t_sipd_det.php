<style>
	.checked{
		background-image:url(../assets/images/icons/check.png) !important;
	}
</style>
<h4 class="container">IZIN PRAKTEK DOKTER</h4>
<script>
	Ext.onReady(function(){
/* Start variabel declaration */
		var sipd_det_componentItemTitle="Izin Praktek Dokter";
		var sipd_det_dataStore;
		
		var sipd_det_shorcut;
		var sipd_det_contextMenu;
		var sipd_det_gridSearchField;
		var sipd_det_gridPanel;
		var sipd_det_formPanel;
		var sipd_det_formWindow;
		var sipd_det_searchPanel;
		var sipd_det_searchWindow;
		
		var det_sipd_idField;
		var det_sipd_sipd_idField;
		var det_sipd_jenisField;
		var det_sipd_sklamaField;
		var det_sipd_tanggalField;
		var det_sipd_pemohon_idField;
		var det_sipd_nomorregField;
		var det_sipd_prosesField;
		var det_sipd_skField;
		var det_sipd_skurutField;
		var det_sipd_berlakuField;
		var det_sipd_kadaluarsaField;
		var det_sipd_terimaField;
		var det_sipd_terimatanggalField;
		var det_sipd_kelengkapanField;
		var det_sipd_bapField;
		var det_sipd_keputusanField;
		var det_sipd_baptanggalField;
		var det_sipd_sipField;
		var det_sipd_nropField;
		var det_sipd_strField;
		var det_sipd_kompetensiField;
		
		var sipd_namaField;
		var sipd_alamatField;
		var sipd_telpField;
		var sipd_urutanField;
		var sipd_jenisdokterField;
		
		var sipd_det_dbTask = 'CREATE';
		var sipd_det_dbTaskMessage = 'Tambah';
		var sipd_det_dbPermission = 'CRUD';
		var sipd_det_dbListAction = 'GETLIST';
/* End variabel declaration */
/* Start function declaration */
		function sipd_det_switchToGrid(){
			sipd_det_formPanel.setDisabled(true);
			sipd_det_gridPanel.setDisabled(false);
			sipd_det_formWindow.hide();
		}
		
		function sipd_det_switchToForm(){
			sipd_det_gridPanel.setDisabled(true);
			sipd_det_formPanel.setDisabled(false);
			sipd_det_formWindow.show();
		}
		
		function sipd_det_confirmAdd(){
			sipd_det_dbTask = 'CREATE';
			sipd_det_dbTaskMessage = 'created';
			sipd_det_resetForm();
			sipd_det_syaratDataStore.proxy.extraParams = { 
				currentAction : 'create',
				action : 'GETSYARAT'
			};
			sipd_det_syaratDataStore.load();
			sipd_det_switchToForm();
		}
		
		function sipd_det_confirmUpdate(){
			if(sipd_det_gridPanel.selModel.getCount() == 1) {
				sipd_det_dbTask = 'UPDATE';
				sipd_det_dbTaskMessage = 'updated';
				sipd_det_switchToForm();
				sipd_det_setForm();
			}else{
				Ext.MessageBox.show({
					title : 'Warning',
					msg : globalNoSelection,
					buttons : Ext.MessageBox.OK,
					animEl : 'save',
					icon : Ext.MessageBox.WARNING
				});
			}
		}
		
		function sipd_det_confirmDelete(){
			if(sipd_det_gridPanel.selModel.getCount() == 1){
				Ext.MessageBox.confirm(globalConfirmationTitle,globalDeleteConfirmation, sipd_det_delete);
			}else if(sipd_det_gridPanel.selModel.getCount() > 1){
				Ext.MessageBox.confirm(globalConfirmationTitle,globalMultiDeleteConfirmation, sipd_det_delete);
			}else{
				Ext.MessageBox.show({
					title : 'Warning',
					msg : globalNoSelection,
					buttons : Ext.MessageBox.OK,
					animEl : 'save',
					icon : Ext.MessageBox.WARNING
				});
			}
		}
		
		function sipd_det_save(){
			var pattU=new RegExp("U");
			var pattC=new RegExp("C");
			var ajaxWaitMessage = Ext.MessageBox.wait(globalWaitMessage, globalWaitMessageTitle);
			if(pattU.test(sipd_det_dbPermission)==false && pattC.test(sipd_det_dbPermission)==false){
				Ext.MessageBox.show({
					title : 'Warning',
					msg : globalFailedPermission,
					buttons : Ext.MessageBox.OK,
					animEl : 'security',
					icon : Ext.MessageBox.WARNING
				});
			}else{
				if(sipd_det_confirmFormValid()){
					var array_sipd_cek_id=new Array();
					var array_sipd_cek_syarat_id=new Array();
					var array_sipd_cek_status=new Array();
					var array_sipd_cek_keterangan=new Array();
					if(sipd_det_syaratDataStore.getCount() > 0){
						for(var i=0;i<sipd_det_syaratDataStore.getCount();i++){
							array_sipd_cek_id.push(sipd_det_syaratDataStore.getAt(i).data.sipd_cek_id);
							array_sipd_cek_syarat_id.push(sipd_det_syaratDataStore.getAt(i).data.sipd_cek_syarat_id);
							array_sipd_cek_status.push(sipd_det_syaratDataStore.getAt(i).data.sipd_cek_status);
							array_sipd_cek_keterangan.push(sipd_det_syaratDataStore.getAt(i).data.sipd_cek_keterangan);
						}
					}
					
					var params = sipd_det_formPanel.getForm().getValues();
					params.ijin_id = 26;
					params.action = sipd_det_dbTask;
					params.sipd_cek_id = array_sipd_cek_id;
					params.sipd_cek_syarat_id = array_sipd_cek_syarat_id;
					params.sipd_cek_status = array_sipd_cek_status;
					params.sipd_cek_keterangan = array_sipd_cek_keterangan;
					
					params = Ext.encode(params);
					Ext.Ajax.request({
						waitMsg: 'Please wait...',
						url: 'c_t_sipd_det/switchAction',
						params: {
							action : sipd_det_dbTask,
							params : params
						},
						success: function(response){
							ajaxWaitMessage.hide();
							var result = response.responseText;
							switch(result){
								case 'success':
									sipd_det_dataStore.reload();
									sipd_det_resetForm();
									Ext.MessageBox.alert(globalSuccessSaveTitle,globalSuccessSave, function(){
										window.scrollTo(0,0);
									});
									sipd_det_switchToGrid();
									sipd_det_gridPanel.getSelectionModel().deselectAll();
									break;
								case 'duplicateCode':
									Ext.MessageBox.show({
										title : 'Warning',
										msg : globalFailedDuplicateCode,
										buttons : Ext.MessageBox.OK,
										animEl : 'save',
										icon : Ext.MessageBox.WARNING
									});
									break;
								case 'sessionExpired':
									Ext.MessageBox.show({
										title : 'Warning',
										msg : globalSessionExpiredMessage,
										buttons : Ext.MessageBox.OK,
										animEl : 'save',
										icon : Ext.MessageBox.WARNING,
										fn : function(btn){
											window.location="../index.php";
										}
									});
									break;
								default:
									Ext.MessageBox.show({
										title : 'Warning',
										msg : globalFailedSave,
										buttons : Ext.MessageBox.OK,
										animEl : 'save',
										icon : Ext.MessageBox.WARNING
									});
									break;
							}
						},
						failure: function(response){
							ajaxWaitMessage.hide();
							var result=response.responseText;
							Ext.MessageBox.show({
								title : 'Error',
								msg : globalFailedConnection,
								buttons : Ext.MessageBox.OK,
								animEl : 'database',
								icon : Ext.MessageBox.ERROR
							});
						}
					});
				}else{
					Ext.MessageBox.show({
						title : 'Warning',
						msg : globalInvalidForm,
						buttons : Ext.MessageBox.OK,
						animEl : 'save',
						icon : Ext.MessageBox.WARNING
					});
				}
			}
		}
		
		function sipd_det_delete(btn){
			if(btn=='yes'){
				var ajaxWaitMessage = Ext.MessageBox.wait(globalWaitMessage, globalWaitMessageTitle);
				var patt = new RegExp("D");
				if(patt.test(sipd_det_dbPermission)==false){
					Ext.MessageBox.show({
						title : 'Warning',
						msg : globalFailedPermission,
						buttons : Ext.MessageBox.OK,
						animEl : 'security',
						icon : Ext.MessageBox.WARNING
					});
				}else{
					var selections = sipd_det_gridPanel.selModel.getSelection();
					var arrayId = [];
					for(i = 0; i< sipd_det_gridPanel.selModel.getCount(); i++){
						arrayId.push(selections[i].data.det_sipd_id);
					}
					var encoded_arrayId = Ext.encode(arrayId);
					Ext.Ajax.request({
						waitMsg: 'Please Wait',
						url : 'c_t_sipd_det/switchAction',
						params : { action : "DELETE", ids : encoded_arrayId },
						success : function(response){
							ajaxWaitMessage.hide();
							var result = response.responseText;
							switch(result){
								case 'success':
									sipd_det_dataStore.reload();
									break;
								default:
									Ext.MessageBox.show({
										title : 'Warning',
										msg : globalFailedDelete,
										buttons : Ext.MessageBox.OK,
										animEl : 'save',
										icon : Ext.MessageBox.WARNING
									});
									break;
							}
						},
						failure: function(response){
							ajaxWaitMessage.hide();
							var result=response.responseText;
							Ext.MessageBox.show({
								title : 'Error',
								msg : globalFailedConnection,
								buttons : Ext.MessageBox.OK,
								animEl : 'database',
								icon : Ext.MessageBox.ERROR
							});
						}
					});
				}
			}
		}
		
		function sipd_det_refresh(){
			sipd_det_dbListAction = "GETLIST";
			sipd_det_gridSearchField.reset();
			sipd_det_dataStore.proxy.extraParams = { action : 'GETLIST' };
			sipd_det_dataStore.proxy.extraParams.query = "";
			sipd_det_dataStore.currentPage = 1;
			sipd_det_gridPanel.store.reload({params: {start: 0, limit: globalPageSize, page : 1, query : ''}});
		}
		
		function sipd_det_confirmFormValid(){
			return sipd_det_formPanel.getForm().isValid();
		}
		
		function sipd_det_resetForm(){
			sipd_det_dbTask = 'CREATE';
			sipd_det_dbTaskMessage = 'create';
			sipd_det_formPanel.getForm().reset();
			det_sipd_idField.setValue(0);
			window.scrollTo(0,0);
		}
		
		function sipd_det_setForm(){
			sipd_det_dbTask = 'UPDATE';
            sipd_det_dbTaskMessage = 'update';
			
			var record = sipd_det_gridPanel.getSelectionModel().getSelection()[0];
			sipd_det_formPanel.loadRecord(record);
			det_sipd_idField.setValue(record.data.det_sipd_id);
			det_sipd_sipd_idField.setValue(record.data.det_sipd_sipd_id);
			det_sipd_jenisField.setValue(record.data.det_sipd_jenis);
			det_sipd_tanggalField.setValue(record.data.det_sipd_tanggal);
			if(record.data.det_sipd_retribusi != 0){
				sipd_det_retribusiField.setValue({ sipd_retribusi : ['1'] });
			}else{
				sipd_det_retribusiField.setValue({ sipd_retribusi : ['0'] });
			}
			sipd_det_retibusiNilaiField.setValue(record.data.det_sipd_retribusi);
			sipd_det_syaratDataStore.proxy.extraParams = { 
				sipd_id : record.data.det_sipd_sipd_id,
				sipd_det_id : record.data.det_sipd_id,
				currentAction : 'update',
				action : 'GETSYARAT'
			};
			sipd_det_syaratDataStore.load();
		}
		
		function sipd_det_showSearchWindow(){
			sipd_det_searchWindow.show();
		}
		
		function sipd_det_printExcel(outputType){
			var searchText = "";
			if(sipd_det_dataStore.proxy.extraParams.query!==null){searchText = sipd_det_dataStore.proxy.extraParams.query;}
			var ajaxWaitMessage = Ext.MessageBox.wait(globalWaitMessage, globalWaitMessageTitle);
			Ext.Ajax.request({
				waitMsg : 'Please Wait...',
				url : 'c_t_sipd_det/switchAction',
				params : {
					action : outputType,
					query : searchText,
					currentAction : sipd_det_dbListAction
				},
				success: function(response){
					ajaxWaitMessage.hide();
					var result = response.responseText;
					switch(result){
						case 'success':
							if(outputType == 'EXCEL'){
								window.open('../print/t_sipd_det_list.xls');
							}else{
								window.open('../print/t_sipd_det_list.html','sipd_detlist','height=600,width=800,resizable=1,scrollbars=1, menubar=0');
							}
						break;
						default:
							Ext.MessageBox.show({
							title : 'Warning',
							msg : globalFailedPrint,
							buttons : Ext.MessageBox.OK,
							animEl : 'save',
							icon : Ext.MessageBox.WARNING
						});
						break;
					}
				},
				failure: function(response){
					ajaxWaitMessage.hide();
					var result = response.responseText;
					Ext.MessageBox.show({
						title : 'Error',
						msg : globalFailedConnection,
						buttons : Ext.MessageBox.OK,
						animEl : 'database',
						icon : Ext.MessageBox.ERROR
					});
				}
			});
		}
/* End function declaration */
/* Start DataStore declaration */
		sipd_det_dataStore = Ext.create('Ext.data.Store',{
			id : 'sipd_det_dataStore',
			pageSize : globalPageSize,
			proxy : Ext.create('Ext.data.HttpProxy',{
				url : 'c_t_sipd_det/switchAction',
				reader : {
					type : 'json',
					root : 'results',
					rootProperty : 'results',
					totalProperty : 'total',
					idProperty : 'det_sipd_id'
				},
				actionMethods : {
					read : 'POST'
				},
				extraParams : {
					action : 'GETLIST'
				}
			}),
			fields : [
				{ name : 'det_sipd_id', type : 'int', mapping : 'det_sipd_id' },
				{ name : 'det_sipd_sipd_id', type : 'int', mapping : 'det_sipd_sipd_id' },
				{ name : 'det_sipd_jenis', type : 'int', mapping : 'det_sipd_jenis' },
				{ name : 'det_sipd_tanggal', type : 'date', dateFormat : 'Y-m-d', mapping : 'det_sipd_tanggal' },
				{ name : 'det_sipd_pemohon_id', type : 'int', mapping : 'det_sipd_pemohon_id' },
				{ name : 'det_sipd_nomorreg', type : 'string', mapping : 'det_sipd_nomorreg' },
				{ name : 'det_sipd_proses', type : 'string', mapping : 'det_sipd_proses' },
				{ name : 'lamaproses', type : 'string', mapping : 'lamaproses' },
				{ name : 'det_sipd_sk', type : 'string', mapping : 'det_sipd_sk' },
				{ name : 'det_sipd_skurut', type : 'int', mapping : 'det_sipd_skurut' },
				{ name : 'det_sipd_berlaku', type : 'date', dateFormat : 'Y-m-d', mapping : 'det_sipd_berlaku' },
				{ name : 'det_sipd_kadaluarsa', type : 'date', dateFormat : 'Y-m-d', mapping : 'det_sipd_kadaluarsa' },
				{ name : 'det_sipd_terima', type : 'string', mapping : 'det_sipd_terima' },
				{ name : 'det_sipd_terimatanggal', type : 'date', dateFormat : 'Y-m-d', mapping : 'det_sipd_terimatanggal' },
				{ name : 'det_sipd_kelengkapan', type : 'int', mapping : 'det_sipd_kelengkapan' },
				{ name : 'det_sipd_bap', type : 'string', mapping : 'det_sipd_bap' },
				{ name : 'det_sipd_keputusan', type : 'int', mapping : 'det_sipd_keputusan' },
				{ name : 'det_sipd_baptanggal', type : 'date', dateFormat : 'Y-m-d', mapping : 'det_sipd_baptanggal' },
				{ name : 'det_sipd_sip', type : 'string', mapping : 'det_sipd_sip' },
				{ name : 'det_sipd_nrop', type : 'string', mapping : 'det_sipd_nrop' },
				{ name : 'det_sipd_str', type : 'string', mapping : 'det_sipd_str' },
				{ name : 'det_sipd_kompetensi', type : 'string', mapping : 'det_sipd_kompetensi' },
				{ name : 'sipd_nama', type : 'string', mapping : 'sipd_nama' },
				{ name : 'sipd_alamat', type : 'string', mapping : 'sipd_alamat' },
				{ name : 'sipd_telp', type : 'string', mapping : 'sipd_telp' },
				{ name : 'sipd_urutan', type : 'int', mapping : 'sipd_urutan' },
				{ name : 'sipd_jenisdokter', type : 'string', mapping : 'sipd_jenisdokter' },
				{ name : 'det_sipd_retribusi', type : 'int', mapping : 'det_sipd_retribusi' },
				{ name : 'permohonan_id', type : 'int', mapping : 'permohonan_id' },
				{ name : 'pemohon_id', type : 'int', mapping : 'pemohon_id' },
				{ name : 'pemohon_nama', type : 'string', mapping : 'pemohon_nama' },
				{ name : 'pemohon_alamat', type : 'string', mapping : 'pemohon_alamat' },
				{ name : 'pemohon_telp', type : 'string', mapping : 'pemohon_telp' },
				{ name : 'pemohon_npwp', type : 'string', mapping : 'pemohon_npwp' },
				{ name : 'pemohon_rt', type : 'int', mapping : 'pemohon_rt' },
				{ name : 'pemohon_rw', type : 'int', mapping : 'pemohon_rw' },
				{ name : 'pemohon_kel', type : 'string', mapping : 'pemohon_kel' },
				{ name : 'pemohon_kec', type : 'string', mapping : 'pemohon_kec' },
				{ name : 'pemohon_nik', type : 'string', mapping : 'pemohon_nik' },
				{ name : 'pemohon_stra', type : 'string', mapping : 'pemohon_stra' },
				{ name : 'pemohon_surattugas', type : 'string', mapping : 'pemohon_surattugas' },
				{ name : 'pemohon_pekerjaan', type : 'string', mapping : 'pemohon_pekerjaan' },
				{ name : 'pemohon_tempatlahir', type : 'string', mapping : 'pemohon_tempatlahir' },
				{ name : 'pemohon_tanggallahir', type : 'date', dateFormat : 'Y-m-d', mapping : 'pemohon_tanggallahir' },
				{ name : 'pemohon_user_id', type : 'int', mapping : 'pemohon_user_id' },
				{ name : 'pemohon_pendidikan', type : 'string', mapping : 'pemohon_pendidikan' },
				{ name : 'pemohon_tahunlulus', type : 'int', mapping : 'pemohon_tahunlulus' },
				{ name : 'perusahaan_id', type : 'int', mapping : 'perusahaan_id' },
				{ name : 'perusahaan_npwp', type : 'string', mapping : 'perusahaan_npwp' },
				{ name : 'perusahaan_nama', type : 'string', mapping : 'perusahaan_nama' },
				{ name : 'perusahaan_noakta', type : 'string', mapping : 'perusahaan_noakta' },
				{ name : 'perusahaan_notaris', type : 'string', mapping : 'perusahaan_notaris' },
				{ name : 'perusahaan_tglakta', type : 'date', dateFormat : 'Y-m-d', mapping : 'perusahaan_tglakta' },
				{ name : 'perusahaan_bentuk_id', type : 'int', mapping : 'perusahaan_bentuk_id' },
				{ name : 'perusahaan_kualifikasi_id', type : 'int', mapping : 'perusahaan_kualifikasi_id' },
				{ name : 'perusahaan_alamat', type : 'string', mapping : 'perusahaan_alamat' },
				{ name : 'perusahaan_rt', type : 'int', mapping : 'perusahaan_rt' },
				{ name : 'perusahaan_rw', type : 'int', mapping : 'perusahaan_rw' },
				{ name : 'perusahaan_propinsi_id', type : 'int', mapping : 'perusahaan_propinsi_id' },
				{ name : 'perusahaan_kabkota_id', type : 'int', mapping : 'perusahaan_kabkota_id' },
				{ name : 'perusahaan_kecamatan_id', type : 'int', mapping : 'perusahaan_kecamatan_id' },
				{ name : 'perusahaan_desa_id', type : 'int', mapping : 'perusahaan_desa_id' },
				{ name : 'perusahaan_kodepos', type : 'string', mapping : 'perusahaan_kodepos' },
				{ name : 'perusahaan_telp', type : 'string', mapping : 'perusahaan_telp' },
				{ name : 'perusahaan_fax', type : 'string', mapping : 'perusahaan_fax' },
				{ name : 'perusahaan_stempat_id', type : 'int', mapping : 'perusahaan_stempat_id' },
				{ name : 'perusahaan_sperusahaan_id', type : 'int', mapping : 'perusahaan_sperusahaan_id' },
				{ name : 'perusahaan_usaha', type : 'string', mapping : 'perusahaan_usaha' },
				{ name : 'perusahaan_butara', type : 'string', mapping : 'perusahaan_butara' },
				{ name : 'perusahaan_bselatan', type : 'string', mapping : 'perusahaan_bselatan' },
				{ name : 'perusahaan_btimur', type : 'string', mapping : 'perusahaan_btimur' },
				{ name : 'perusahaan_bbarat', type : 'string', mapping : 'perusahaan_bbarat' },
				{ name : 'perusahaan_modal', type : 'float', mapping : 'perusahaan_modal' },
				{ name : 'perusahaan_merk', type : 'int', mapping : 'perusahaan_merk' },
				{ name : 'perusahaan_jusaha_id', type : 'int', mapping : 'perusahaan_jusaha_id' }
				]
		});
		kelurahan_dataStore = Ext.create('Ext.data.Store',{
			pageSize : globalPageSize,
			proxy : Ext.create('Ext.data.HttpProxy',{
				url : 'c_public_function/get_kelurahan',
				reader : {
					type : 'json',
					root : 'results',
					rootProperty : 'results',
					totalProperty : 'total',
					idProperty : 'id'
				},
				actionMethods : {
					read : 'POST'
				}
			}),
			fields : [
				{ name : 'id', type : 'int', mapping : 'id' },
				{ name : 'desa', type : 'string', mapping : 'desa' }
			]
		});
		kecamatan_dataStore = Ext.create('Ext.data.Store',{
			pageSize : globalPageSize,
			proxy : Ext.create('Ext.data.HttpProxy',{
				url : 'c_public_function/get_kecamatan',
				reader : {
					type : 'json',
					root : 'results',
					rootProperty : 'results',
					totalProperty : 'total',
					idProperty : 'id'
				},
				actionMethods : {
					read : 'POST'
				}
			}),
			fields : [
				{ name : 'id', type : 'int', mapping : 'id' },
				{ name : 'kecamatan', type : 'string', mapping : 'kecamatan' }
			]
		});
/* End DataStore declaration */
/* Start Shorcut Declaration */
		sipd_det_shorcut = {
			binding : [
				{
					key : 'a',
					alt : true,
					fn : function(e, f){
						sipd_det_confirmAdd();
						f.stopEvent();
					}
				},{
					key : 'f',
					alt : true,
					shift : false,
					fn : function(e, f){
						sipd_det_showSearchWindow();
						f.stopEvent();
					}
				},{
					key : 'f',
					alt : true,
					shift : true,
					fn : function(e, f){
						sipd_det_gridSearchField.focus(true, 1000);
						f.stopEvent();
					}
				},{
					key : 'e',
					alt : true,
					fn : function(e, f){
						sipd_det_confirmUpdate();
						f.stopEvent();
					}
				},{
					key : 'd',
					alt : true,
					fn : function(e, f){
						sipd_det_confirmDelete();
						f.stopEvent();
					}
				},{
					key : 'r',
					alt : true,
					fn : function(e, f){
						sipd_det_refresh();
						f.stopEvent();
					}
				},{
					key : 'p',
					alt : true,
					fn : function(e, f){
						sipd_det_printExcel('PRINT');
						f.stopEvent();
					}
				},{
					key : 'x',
					alt : true,
					fn : function(e, f){
						sipd_det_printExcel('EXCEL');
						f.stopEvent();
					}
				}
			]
		};
/* End Shorcut Declaration */
/* Start GridPanel declaration */
		var sipd_det_addButton = Ext.create('Ext.Button',{
			text : globalAddButtonTitle,
			tooltip : globalAddTooltip,
			iconCls : 'icon16x16-add',
			handler : sipd_det_confirmAdd
		});
		var sipd_det_editButton = Ext.create('Ext.Button',{
			text : globalEditButtonTitle,
			tooltip : globalEditTooltip,
			iconCls : 'icon16x16-edit',
			handler : sipd_det_confirmUpdate
		});
		var sipd_det_deleteButton = Ext.create('Ext.Button',{
			text : globalDeleteButtonTitle,
			tooltip : globalDeleteTooltip,
			iconCls : 'icon16x16-delete',
			handler : sipd_det_confirmDelete
		});
		var sipd_det_refreshButton = Ext.create('Ext.Button',{
			text : globalRefreshButtonTitle,
			tooltip : globalRefreshTooltip,
			iconCls : 'icon16x16-refresh',
			handler : sipd_det_refresh
		});
		var sipd_det_searchButton = Ext.create('Ext.Button',{
			text : globalSearchButtonTitle,
			tooltip : globalSearchTooltip,
			iconCls : 'icon16x16-search',
			handler : sipd_det_showSearchWindow
		});
		var sipd_det_printButton = Ext.create('Ext.Button',{
			text : globalPrintButtonTitle,
			tooltip : globalPrintTooltip,
			iconCls : 'icon16x16-print',
			handler : function(){
				sipd_det_printExcel('PRINT');
			}
		});
		var sipd_det_excelButton = Ext.create('Ext.Button',{
			text : globalExportButtonTitle,
			tooltip : globalExportTooltip,
			iconCls : 'icon16x16-table',
			handler : function(){
				sipd_det_printExcel('EXCEL');
			}
		});
		
		var sipd_det_contextMenuEdit = Ext.create('Ext.menu.Item',{
			text : globalEditButtonTitle,
			tooltip : globalEditTooltip,
			iconCls :'icon16x16-edit',
			handler : sipd_det_confirmUpdate
		});
		var sipd_det_contextMenuDelete = Ext.create('Ext.menu.Item',{
			text : globalDeleteButtonTitle,
			tooltip : globalDeleteTooltip,
			iconCls :'icon16x16-delete',
			handler : sipd_det_confirmDelete
		});
		var sipd_det_contextMenuRefresh = Ext.create('Ext.menu.Item',{
			text : globalRefreshButtonTitle,
			tooltip : globalRefreshTooltip,
			iconCls :'icon16x16-refresh',
			handler : sipd_det_refresh
		});
		sipd_det_contextMenu = Ext.create('Ext.menu.Menu',{
			id: 'sipd_det_contextMenu',
			items: [
				sipd_det_contextMenuEdit,sipd_det_contextMenuDelete,'-',sipd_det_contextMenuRefresh
			]
		});
		var sipd_det_bp_printCM = Ext.create('Ext.menu.Item',{
			text : 'Bukti Penerimaan',
			tooltip : 'Cetak Bukti Penerimaan',
			handler : function(){
				var record = sipd_det_gridPanel.getSelectionModel().getSelection()[0];
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'c_t_sipd_det/switchAction',
					params: {
						sipddet_id : record.get('det_sipd_id'),
						action : 'CETAKBP'
					},success : function(){
						window.open('../print/sipd_buktipenerimaan.html');
					}
				});
			}
		});
		var sipd_det_sk_printCM = Ext.create('Ext.menu.Item',{
			text : 'Surat Keputusan',
			tooltip : 'Cetak Surat Keputusan',
			handler : function(){
				var record = sipd_det_gridPanel.getSelectionModel().getSelection()[0];
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'c_t_sipd_det/switchAction',
					params: {
						sipddet_id : record.get('det_sipd_id'),
						action : 'CETAKSK'
					},success : function(response){
						var result = response.responseText;
						switch(result){
							case 'success':
								window.open('../print/sipd_sk.html');
								break;
							case 'nosk':
								Ext.MessageBox.alert('Warning.','Nomor SK Belum ditetapkan.');
								break;
							case 'notglkadaluarsa':
								Ext.MessageBox.alert('Warning.','Tanggal kadaluarsa belum ditetapkan.');
								break;
							default:
								Ext.MessageBox.show({
									title : 'Warning',
									msg : 'Cetak gagal',
									buttons : Ext.MessageBox.OK,
									animEl : 'save',
									icon : Ext.MessageBox.WARNING
								});
							break;
						}
					}
				});
			}
		});
		var sipd_det_bap_printCM = Ext.create('Ext.menu.Item',{
			text : 'Berita Acara Pemeriksaan',
			tooltip : 'Cetak Berita Acara Pemeriksaan',
			handler : function(){
				var record = sipd_det_gridPanel.getSelectionModel().getSelection()[0];
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'c_t_sipd_det/switchAction',
					params: {
						sipddet_id : record.get('det_sipd_id'),
						action : 'CETAKLEMBARKONTROL'
					},success : function(){
						window.open('../print/sipd_lembarkontrol.html');
					}
				});
			}
		});
		var sipd_det_lk_printCM = Ext.create('Ext.menu.Item',{
			text : 'Lembar Kontrol',
			tooltip : 'Cetak Lembar Kontrol',
			handler : function(){
				var record = sipd_det_gridPanel.getSelectionModel().getSelection()[0];
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'c_t_sipd_det/switchAction',
					params: {
						sipddet_id : record.get('det_sipd_id'),
						action : 'CETAKLEMBARKONTROL'
					},success : function(){
						window.open('../print/sipd_lembarkontrol.html');
					}
				});
			}
		});
		var sipd_det_printContextMenu = Ext.create('Ext.menu.Menu',{
			items: [
				sipd_det_bp_printCM,sipd_det_lk_printCM,sipd_det_bap_printCM,sipd_det_sk_printCM
			]
		});
		function sipd_det_ubahProses(proses){
			var record = sipd_det_gridPanel.getSelectionModel().getSelection()[0];
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'c_t_sipd_det/switchAction',
				params: {
					sipddet_id : record.get('det_sipd_id'),
					sipddet_nosk : record.get('det_sipd_sk'),
					proses : proses,
					action : 'UBAHPROSES'
				},success : function(){
					sipd_det_dataStore.reload();
				}
			});
		}
		
		var sipd_det_prosesContextMenu = Ext.create('Ext.menu.Menu',{
			items: [
				{
					text : 'Selesai, belum diambil',
					tooltip : 'Ubah Menjadi Selesai, belum diambil',
					handler : function(){
						sipd_det_ubahProses('Selesai, belum diambil');
					}
				},
				{
					text : 'Selesai, sudah diambil',
					tooltip : 'Ubah Menjadi Selesai, sudah diambil',
					handler : function(){
						sipd_det_ubahProses('Selesai, sudah diambil');
					}
				},
				{
					text : 'Ditolak',
					tooltip : 'Ubah Menjadi Ditolak',
					handler : function(){
						sipd_det_ubahProses('Ditolak');
					}
				}
			]
		});
		
		sipd_det_gridSearchField = Ext.create('Ext.ux.form.SearchField', {
			store : sipd_det_dataStore,
			listeners : {
				specialkey: function(f,e){
					if(e.getKey() == e.ENTER){
						sipd_det_dataStore.proxy.extraParams = { action : 'GETLIST'};
						sipd_det_dbListAction = 'GETLIST';
					}
				},
				render: function(c){
					Ext.get(this.id).set({qtitle : globalSimpleSearchTooltip});
				}
			},
			width: 150
		});
		sipd_det_gridPanel = Ext.create('Ext.grid.Panel',{
			id : 'sipd_det_gridPanel',
			constrain : true,
			store : sipd_det_dataStore,
			loadMask : true,
            enableColLock : false,
			renderTo : 'sipd_detGrid',
			width : '95%',
			selModel : Ext.selection.Model(),
			viewConfig : { 
				forceFit:true,
				listeners: {
					itemcontextmenu: function(view, rec, node, index, e) {
						e.stopEvent();
						sipd_det_contextMenu.showAt(e.getXY());
						return false;
					}
				}
			},
			multiSelect : true,
			keys : sipd_det_shorcut,
			columns : [
				{
					text : 'Jenis',
					dataIndex : 'det_sipd_jenis',
					width : 100,
					sortable : false,
					renderer : function(value){
						if(value == 1){
							return 'BARU';
						}else{
							return 'PERPANJANGAN';
						}
					}
				},
				{
					text : 'Tanggal',
					dataIndex : 'det_sipd_tanggal',
					width : 100,
					sortable : false,
					renderer : Ext.util.Format.dateRenderer('d-m-Y')
				},
				{
					text : 'Pemohon',
					dataIndex : 'pemohon_nama',
					width : 150,
					sortable : false
				},
				{
					text : 'Alamat',
					dataIndex : 'pemohon_alamat',
					width : 100,
					flex : 1,
					sortable : false
				},
				{
					text : 'Telp',
					dataIndex : 'pemohon_telp',
					width : 100,
					sortable : false
				},
				{
					text : 'Nama Praktek',
					dataIndex : 'sipd_nama',
					width : 150,
					sortable : false
				},
				{
					text : 'Nomor SK',
					dataIndex : 'det_sipd_sk',
					width : 200,
					sortable : false,
					hidden : true
				},
				{
					text : 'Tanggal Berlaku',
					dataIndex : 'det_sipd_berlaku',
					width : 100,
					sortable : false,
					renderer : Ext.util.Format.dateRenderer('d-m-Y'),
					hidden : true
				},
				{
					text : 'Tanggal Kadaluarsa',
					dataIndex : 'det_sipd_kadaluarsa',
					width : 100,
					sortable : false,
					renderer : Ext.util.Format.dateRenderer('d-m-Y'),
					hidden : true
				},
				{
					text : 'Lama Proses',
					dataIndex : 'lamaproses',
					width : 100,
					sortable : false
				},
				{
					text : 'Status',
					dataIndex : 'det_sipd_proses',
					width : 125,
					sortable : false
				},
				{
					xtype:'actioncolumn',
					text : 'Action',
					hideable : false,
					width:50,
					items: [{
						iconCls: 'icon16x16-edit',
						tooltip: 'Ubah Data',
						handler: function(grid, rowIndex){
							grid.getSelectionModel().select(rowIndex);
							sipd_det_confirmUpdate();
						}
					},{
						iconCls: 'icon16x16-delete',
						tooltip: 'Hapus Data',
						handler: function(grid, rowIndex){
							grid.getSelectionModel().select(rowIndex);
							sipd_det_confirmDelete();
						}
					}]
				},
				{
					xtype:'actioncolumn',
					text : 'Proses',
					hideable : false,
					width:50,
					items: [{
						iconCls : 'checked',
						tooltip : 'Ubah Status',
						handler: function(grid, rowIndex, colIndex, node, e) {
							e.stopEvent();
							sipd_det_prosesContextMenu.showAt(e.getXY());
							return false;
						}
					}]
				},
				{
					xtype:'actioncolumn',
					text : 'Cetak',
					hideable : false,
					width:50,
					items: [{
						iconCls: 'icon16x16-print',
						tooltip: 'Cetak Dokumen',
						handler: function(grid, rowIndex, colIndex, node, e) {
							e.stopEvent();
							sipd_det_printContextMenu.showAt(e.getXY());
							return false;
						}
					}]
				}
			],
			tbar : [
				sipd_det_addButton,
				sipd_det_gridSearchField,
				sipd_det_refreshButton,
				sipd_det_printButton,
				sipd_det_excelButton
			],
			bbar : Ext.create('Ext.PagingToolbar', {
				store : sipd_det_dataStore,
				displayInfo : true
			})/* ,
			listeners : {
				afterrender : function(){
					sipd_det_dataStore.reload({params: {start: 0, limit: globalPageSize}});
				}
			} */
		});
/* End GridPanel declaration */
/* Start FormPanel declaration */
		det_sipd_idField = Ext.create('Ext.form.NumberField',{
			name : 'det_sipd_id',
			fieldLabel : 'det_sipd_id<font color=red>*</font>',
			allowNegatife : false,
			blankText : '0',
			allowDecimals : false,
			hidden : true,
			maskRe : /([0-9]+)$/
		});
		det_sipd_sipd_idField = Ext.create('Ext.form.NumberField',{
			name : 'det_sipd_sipd_id',
			fieldLabel : 'det_sipd_sipd_id',
			allowNegatife : false,
			blankText : '0',
			allowDecimals : false,
			hidden : true,
			maskRe : /([0-9]+)$/
		});
		permohonan_idField = Ext.create('Ext.form.NumberField',{
			name : 'permohonan_id',
			allowNegatife : false,
			blankText : '0',
			allowDecimals : false,
			hidden : true,
			maskRe : /([0-9]+)$/
		});
		det_sipd_jenisField = Ext.create('Ext.form.ComboBox',{
			name : 'permohonan_jenis',
			fieldLabel : 'Jenis',
			store : new Ext.data.ArrayStore({
				fields : ['jenispermohonan_id', 'jenispermohonan_nama'],
				data : [[1,'BARU'],[2,'PERPANJANGAN']]
			}),
			displayField : 'jenispermohonan_nama',
			valueField : 'jenispermohonan_id',
			queryMode : 'local',
			triggerAction : 'all',
			forceSelection : true,
			listeners : {
				select : function(cmb, rec){
					if(cmb.getValue() == '2'){
						det_sipd_sklamaField.show();
					}else{
						det_sipd_sklamaField.hide();
					}
				}
			}
		});
		
		det_sipd_sklamaField = Ext.create('Ext.form.ComboBox',{
			name : 'det_sipd_lama',
			fieldLabel : 'Nomor SK Lama',
			store : sipd_det_dataStore,
			displayField : 'det_sipd_sk',
			valueField : 'det_sipd_sipd_id',
			queryMode : 'remote',
			triggerAction : 'query',
			repeatTriggerClick : true,
			minChars : 100,
			triggerCls : 'x-form-search-trigger',
			forceSelection : false,
			hidden : true,
			onTriggerClick: function(event){
				var store = det_sipd_sklamaField.getStore();
				var val = det_sipd_sklamaField.getRawValue();
				store.proxy.extraParams = {action : 'SEARCH',det_sipd_sk : val};
				store.load();
				det_sipd_sklamaField.expand();
				det_sipd_sklamaField.fireEvent("ontriggerclick", this, event);
			},  
			tpl: Ext.create('Ext.XTemplate',
				'<tpl for=".">',
					'<div class="x-boundlist-item">SK : {det_sipd_sk}<br>Nama Praktek : {sipd_nama}<br>Alamat : {sipd_alamat}<br></div>',
				'</tpl>'
			),
			listeners : {
				select : function(cmb, record){
					var rec=record[0];
					sipd_det_pemohon_idField.setValue(rec.get('pemohon_id'));
					sipd_det_pemohon_nikField.setValue(rec.get('pemohon_nik'));
					sipd_det_pemohon_namaField.setValue(rec.get('pemohon_nama'));
					sipd_det_pemohon_alamatField.setValue(rec.get('pemohon_alamat'));
					sipd_det_pemohon_telpField.setValue(rec.get('pemohon_telp'));
					sipd_det_pemohon_npwpField.setValue(rec.get('pemohon_npwp'));
					sipd_det_pemohon_rtField.setValue(rec.get('pemohon_rt'));
					sipd_det_pemohon_rwField.setValue(rec.get('pemohon_rw'));
					sipd_det_pemohon_kelField.setValue(rec.get('pemohon_kel'));
					sipd_det_pemohon_kecField.setValue(rec.get('pemohon_kec'));
					sipd_det_pemohon_straField.setValue(rec.get('pemohon_stra'));
					sipd_det_pemohon_surattugasField.setValue(rec.get('pemohon_surattugas'));
					sipd_det_pemohon_pekerjaanField.setValue(rec.get('pemohon_pekerjaan'));
					sipd_det_pemohon_tempatlahirField.setValue(rec.get('pemohon_tempatlahir'));
					sipd_det_pemohon_tanggallahirField.setValue(rec.get('pemohon_tanggallahir'));
					sipd_det_pemohon_user_idField.setValue(rec.get('pemohon_user_id'));
					sipd_det_pemohon_pendidikanField.setValue(rec.get('pemohon_pendidikan'));
					sipd_det_pemohon_tahunlulusField.setValue(rec.get('pemohon_tahunlulus'));
					sipd_namaField.setValue(rec.get('sipd_nama'));
					sipd_alamatField.setValue(rec.get('sipd_alamat'));
					sipd_telpField.setValue(rec.get('sipd_telp'));
					sipd_urutanField.setValue(rec.get('sipd_urutan'));
					sipd_jenisdokterField.setValue(rec.get('sipd_jenisdokter'));
					det_sipd_kompetensiField.setValue(rec.get('det_sipd_kompetensi'));
					det_sipd_strField.setValue(rec.get('det_sipd_str'));
					det_sipd_nropField.setValue(rec.get('det_sipd_nrop'));
					det_sipd_sipField.setValue(rec.get('det_sipd_sip'));
				}
			}
		});
		det_sipd_tanggalField = Ext.create('Ext.form.field.Date',{
			name : 'permohonan_tanggal',
			fieldLabel : 'Tanggal <font color=red>*</font>',
			format : 'd-m-Y',
			readOnly : true,
			value : new Date('<?php echo date('Y-m-d').'T'.date('H:i:s'); ?>')
		});
		det_sipd_pemohon_idField = Ext.create('Ext.form.NumberField',{
			name : 'det_sipd_pemohon_id',
			fieldLabel : 'det_sipd_pemohon_id',
			allowNegatife : false,
			blankText : '0',
			hidden : true,
			allowDecimals : false,
			maskRe : /([0-9]+)$/
		});
		det_sipd_nomorregField = Ext.create('Ext.form.TextField',{
			name : 'det_sipd_nomorreg',
			fieldLabel : 'det_sipd_nomorreg',
			maxLength : 50,
			hidden : true
		});
		det_sipd_prosesField = Ext.create('Ext.form.TextField',{
			name : 'det_sipd_proses',
			fieldLabel : 'det_sipd_proses',
			maxLength : 50,
			hidden : true
		});
		det_sipd_skField = Ext.create('Ext.form.TextField',{
			name : 'det_sipd_sk',
			fieldLabel : 'det_sipd_sk',
			maxLength : 50,
			hidden : true
		});
		det_sipd_skurutField = Ext.create('Ext.form.NumberField',{
			name : 'det_sipd_skurut',
			fieldLabel : 'det_sipd_skurut',
			allowNegatife : false,
			blankText : '0',
			allowDecimals : false,
			maskRe : /([0-9]+)$/,
			hidden : true
		});
		det_sipd_berlakuField = Ext.create('Ext.form.field.Date',{
			name : 'det_sipd_berlaku',
			fieldLabel : 'Tanggal Berlaku',
			format : 'd-m-Y'
		});
		det_sipd_kadaluarsaField = Ext.create('Ext.form.field.Date',{
			name : 'permohonan_kadaluarsa',
			fieldLabel : 'Kadaluarsa',
			format : 'd-m-Y'
		});
		det_sipd_terimaField = Ext.create('Ext.form.TextField',{
			name : 'det_sipd_terima',
			fieldLabel : 'Penerima',
			maxLength : 50
		});
		det_sipd_terimatanggalField = Ext.create('Ext.form.field.Date',{
			name : 'det_sipd_terimatanggal',
			fieldLabel : 'Tanggal Terima',
			format : 'd-m-Y'
		});
		det_sipd_kelengkapanField = Ext.create('Ext.form.ComboBox',{
			name : 'det_sipd_kelengkapan',
			fieldLabel : 'Kelengkapan',
			store : new Ext.data.ArrayStore({
				fields : ['kelengkapan_id', 'kelengkapan_nama'],
				data : [[1,'LENGKAP'],[2,'TIDAK LENGKAP']]
			}),
			displayField : 'kelengkapan_nama',
			valueField : 'kelengkapan_id',
			queryMode : 'local',
			triggerAction : 'all',
			forceSelection : true
		});
		det_sipd_bapField = Ext.create('Ext.form.TextField',{
			name : 'det_sipd_bap',
			fieldLabel : 'Bap',
			maxLength : 50
		});
		det_sipd_keputusanField = Ext.create('Ext.form.ComboBox',{
			name : 'det_sipd_keputusan',
			fieldLabel : 'Keputusan',
			store : new Ext.data.ArrayStore({
				fields : ['status_id', 'status_nama'],
				data : [[1,'DISETUJUI'],[2,'DITOLAK'],[3,'DITANGGUHKAN']]
			}),
			displayField : 'status_nama',
			valueField : 'status_id',
			queryMode : 'local',
			triggerAction : 'all',
			forceSelection : true
		});
		det_sipd_baptanggalField = Ext.create('Ext.form.field.Date',{
			name : 'det_sipd_baptanggal',
			fieldLabel : 'Tanggal BAP',
			format : 'd-m-Y'
		});
		det_sipd_sipField = Ext.create('Ext.form.TextField',{
			name : 'det_sipd_sip',
			fieldLabel : 'No. SIP',
			maxLength : 50
		});
		det_sipd_nropField = Ext.create('Ext.form.TextField',{
			name : 'det_sipd_nrop',
			fieldLabel : 'Nomor OP',
			maxLength : 50
		});
		det_sipd_strField = Ext.create('Ext.form.TextField',{
			name : 'det_sipd_str',
			fieldLabel : 'Nomor STR',
			maxLength : 50
		});
		det_sipd_kompetensiField = Ext.create('Ext.form.TextField',{
			name : 'det_sipd_kompetensi',
			fieldLabel : 'Kompetensi',
			maxLength : 50
		});
		
		sipd_namaField = Ext.create('Ext.form.TextField',{
			name : 'sipd_nama',
			fieldLabel : 'Nama',
			maxLength : 50
		});
		sipd_alamatField = Ext.create('Ext.form.TextField',{
			name : 'sipd_alamat',
			fieldLabel : 'Alamat',
			maxLength : 100
		});
		sipd_telpField = Ext.create('Ext.form.TextField',{
			name : 'sipd_telp',
			fieldLabel : 'Telp',
			maxLength : 20
		});
		sipd_urutanField = Ext.create('Ext.form.NumberField',{
			name : 'sipd_urutan',
			fieldLabel : 'Praktek ke-',
			allowNegatife : false,
			value : 1,
			allowDecimals : false,
			minValue : 1,
			maskRe : /([0-9]+)$/
			});
		sipd_jenisdokterField = Ext.create('Ext.form.TextField',{
			name : 'sipd_jenisdokter',
			fieldLabel : 'Jenis Dokter',
			maxLength : 50
		});
		
		/* START DATA PEMOHON */
		var sipd_det_pemohon_idField = Ext.create('Ext.form.Hidden',{
			name : 'pemohon_id'
		});
		var sipd_det_pemohon_namaField = Ext.create('Ext.form.TextField',{
			name : 'pemohon_nama',
			fieldLabel : 'Nama',
			maxLength : 50
		});
		var sipd_det_pemohon_alamatField = Ext.create('Ext.form.TextField',{
			name : 'pemohon_alamat',
			fieldLabel : 'Alamat',
			maxLength : 100
		});
		var sipd_det_pemohon_telpField = Ext.create('Ext.form.TextField',{
			name : 'pemohon_telp',
			fieldLabel : 'Telp',
			maxLength : 20,
			maskRe : /([0-9]+)$/
		});
		var sipd_det_pemohon_npwpField = Ext.create('Ext.form.TextField',{
			name : 'pemohon_npwp',
			fieldLabel : 'NPWP',
			maxLength : 50
		});
		var sipd_det_pemohon_rtField = Ext.create('Ext.form.TextField',{
			name : 'pemohon_rt',
			fieldLabel : 'RT',
			maskRe : /([0-9]+)$/
		});
		var sipd_det_pemohon_rwField = Ext.create('Ext.form.TextField',{
			name : 'pemohon_rw',
			fieldLabel : 'RW',
			maskRe : /([0-9]+)$/
		});
		var sipd_det_pemohon_kelField = Ext.create('Ext.form.ComboBox',{
			name : 'pemohon_kel',
			fieldLabel : 'Kelurahan',
			store : kelurahan_dataStore,
			displayField : 'desa',
			valueField : 'id',
			triggerAction : 'all',
			queryMode : 'local',
			listeners : {
				afterrender : function(){
					kelurahan_dataStore.load();
				}
			}
		});
		var sipd_det_pemohon_kecField = Ext.create('Ext.form.ComboBox',{
			name : 'pemohon_kec',
			fieldLabel : 'Kecamatan',
			store : kecamatan_dataStore,
			displayField : 'kecamatan',
			valueField : 'id',
			triggerAction : 'all',
			queryMode : 'local',
			listeners : {
				afterrender : function(){
					kecamatan_dataStore.load();
				}
			}
		});
		var sipd_det_pemohon_nikField = Ext.create('Ext.form.ComboBox',{
			name : 'pemohon_nik',
			fieldLabel : 'NIK',
			store : Ext.create('Ext.data.Store',{
				pageSize : globalPageSize,
				proxy : Ext.create('Ext.data.HttpProxy',{
					url : 'c_m_pemohon/switchAction',
					reader : {
						type : 'json', root : 'results', rootProperty : 'results', totalProperty : 'total', idProperty : 'pemohon_id'
					},
					actionMethods : { read : 'POST' },
					extraParams : { action : 'SEARCH' }
				}),
				fields : [
					{ name : 'pemohon_id', type : 'int', mapping : 'pemohon_id' },
					{ name : 'pemohon_nama', type : 'string', mapping : 'pemohon_nama' },
					{ name : 'pemohon_alamat', type : 'string', mapping : 'pemohon_alamat' },
					{ name : 'pemohon_telp', type : 'string', mapping : 'pemohon_telp' },
					{ name : 'pemohon_npwp', type : 'string', mapping : 'pemohon_npwp' },
					{ name : 'pemohon_rt', type : 'int', mapping : 'pemohon_rt' },
					{ name : 'pemohon_rw', type : 'int', mapping : 'pemohon_rw' },
					{ name : 'pemohon_kel', type : 'string', mapping : 'pemohon_kel' },
					{ name : 'pemohon_kec', type : 'string', mapping : 'pemohon_kec' },
					{ name : 'pemohon_nik', type : 'string', mapping : 'pemohon_nik' },
					{ name : 'pemohon_stra', type : 'string', mapping : 'pemohon_stra' },
					{ name : 'pemohon_surattugas', type : 'string', mapping : 'pemohon_surattugas' },
					{ name : 'pemohon_pekerjaan', type : 'string', mapping : 'pemohon_pekerjaan' },
					{ name : 'pemohon_tempatlahir', type : 'string', mapping : 'pemohon_tempatlahir' },
					{ name : 'pemohon_tanggallahir', type : 'date', dateFormat : 'Y-m-d', mapping : 'pemohon_tanggallahir' },
					{ name : 'pemohon_user_id', type : 'int', mapping : 'pemohon_user_id' },
					{ name : 'pemohon_pendidikan', type : 'string', mapping : 'pemohon_pendidikan' },
					{ name : 'pemohon_tahunlulus', type : 'int', mapping : 'pemohon_tahunlulus' },
				]
			}),
			displayField : 'pemohon_nik',
			valueField : 'pemohon_id',
			queryMode : 'remote',
			triggerAction : 'query',
			repeatTriggerClick : true,
			minChars : 100,
			triggerCls : 'x-form-search-trigger',
			forceSelection : false,
			onTriggerClick: function(event){
				var store = sipd_det_pemohon_nikField.getStore();
				var val = sipd_det_pemohon_nikField.getRawValue();
				store.proxy.extraParams = {action : 'SEARCH',pemohon_nik : val};
				store.load();
				sipd_det_pemohon_nikField.expand();
				sipd_det_pemohon_nikField.fireEvent("ontriggerclick", this, event);
			},  
			tpl: Ext.create('Ext.XTemplate',
				'<tpl for=".">',
					'<div class="x-boundlist-item">NIK : {pemohon_nik}<br>Nama : {pemohon_nama}<br>Alamat : {pemohon_alamat}<br>Telp : {pemohon_telp}<br></div>',
				'</tpl>'
			),
			listeners : {
				select : function(cmb, record){
					var rec=record[0];
					sipd_det_pemohon_idField.setValue(rec.get('pemohon_id'));
					sipd_det_pemohon_nikField.setValue(rec.get('pemohon_nik'));
					sipd_det_pemohon_namaField.setValue(rec.get('pemohon_nama'));
					sipd_det_pemohon_alamatField.setValue(rec.get('pemohon_alamat'));
					sipd_det_pemohon_telpField.setValue(rec.get('pemohon_telp'));
					sipd_det_pemohon_npwpField.setValue(rec.get('pemohon_npwp'));
					sipd_det_pemohon_rtField.setValue(rec.get('pemohon_rt'));
					sipd_det_pemohon_rwField.setValue(rec.get('pemohon_rw'));
					sipd_det_pemohon_kelField.setValue(rec.get('pemohon_kel'));
					sipd_det_pemohon_kecField.setValue(rec.get('pemohon_kec'));
					sipd_det_pemohon_straField.setValue(rec.get('pemohon_stra'));
					sipd_det_pemohon_surattugasField.setValue(rec.get('pemohon_surattugas'));
					sipd_det_pemohon_pekerjaanField.setValue(rec.get('pemohon_pekerjaan'));
					sipd_det_pemohon_tempatlahirField.setValue(rec.get('pemohon_tempatlahir'));
					sipd_det_pemohon_tanggallahirField.setValue(rec.get('pemohon_tanggallahir'));
					sipd_det_pemohon_user_idField.setValue(rec.get('pemohon_user_id'));
					sipd_det_pemohon_pendidikanField.setValue(rec.get('pemohon_pendidikan'));
					sipd_det_pemohon_tahunlulusField.setValue(rec.get('pemohon_tahunlulus'));
				}
			}
		});
		var sipd_det_pemohon_straField = Ext.create('Ext.form.TextField',{
			name : 'pemohon_stra',
			fieldLabel : 'STRA',
			hidden : true,
			maxLength : 50
		});
		var sipd_det_pemohon_surattugasField = Ext.create('Ext.form.TextField',{
			name : 'pemohon_surattugas',
			fieldLabel : 'Surat Tugas',
			hidden : true,
			maxLength : 50
		});
		var sipd_det_pemohon_pekerjaanField = Ext.create('Ext.form.TextField',{
			name : 'pemohon_pekerjaan',
			fieldLabel : 'Pekerjaan',
			maxLength : 50
		});
		var sipd_det_pemohon_tempatlahirField = Ext.create('Ext.form.TextField',{
			name : 'pemohon_tempatlahir',
			fieldLabel : 'Tempat Lahir',
			maxLength : 50
		});
		var sipd_det_pemohon_tanggallahirField = Ext.create('Ext.form.field.Date',{
			name : 'pemohon_tanggallahir',
			fieldLabel : 'Tanggal Lahir',
			format : 'd-m-Y'
		});
		var sipd_det_pemohon_user_idField = Ext.create('Ext.form.Hidden',{
			name : 'pemohon_user_id',
		});
		var sipd_det_pemohon_pendidikanField = Ext.create('Ext.form.TextField',{
			name : 'pemohon_pendidikan',
			fieldLabel : 'Pendidikan',
			maxLength : 50
		});
		var sipd_det_pemohon_tahunlulusField = Ext.create('Ext.form.TextField',{
			name : 'pemohon_tahunlulus',
			fieldLabel : 'Tahun Lulus',
			maxLength : 4,
			maskRe : /([0-9]+)$/
		});
		sipd_det_syaratDataStore = Ext.create('Ext.data.Store',{
			id : 'sipd_det_syaratDataStore',
			pageSize : globalPageSize,
			proxy : Ext.create('Ext.data.HttpProxy',{
				url : 'c_t_sipd_det/switchAction',
				reader : {
					type : 'json',
					root : 'results',
					rootProperty : 'results',
					totalProperty : 'total'
				},
				actionMethods : {
					read : 'POST'
				},
				extraParams : {
					action : 'GETSYARAT'
				}
			}),
			fields : [
				{ name : 'sipd_cek_id', type : 'int', mapping : 'sipd_cek_id' },
				{ name : 'sipd_cek_syarat_id', type : 'int', mapping : 'sipd_cek_syarat_id' },
				{ name : 'sipd_cek_sipddet_id', type : 'int', mapping : 'sipd_cek_sipddet_id' },
				{ name : 'sipd_cek_sipd_id', type : 'int', mapping : 'sipd_cek_sipd_id' },
				{ name : 'sipd_cek_status', type : 'boolean', mapping : 'sipd_cek_status' },
				{ name : 'sipd_cek_keterangan', type : 'string', mapping : 'sipd_cek_keterangan' },
				{ name : 'sipd_cek_syarat_nama', type : 'string', mapping : 'sipd_cek_syarat_nama' }
				]
		});
		var det_sipd_syaratGridEditor = new Ext.grid.plugin.CellEditing({
			clicksToEdit: 1
		});
		det_sipd_syaratGrid = Ext.create('Ext.grid.Panel',{
			id : 'det_sipd_syaratGrid',
			store : sipd_det_syaratDataStore,
			loadMask : true,
			width : '100%',
			plugins : [
				Ext.create('Ext.grid.plugin.CellEditing', {
					clicksToEdit: 1
				})
			],
			selType: 'cellmodel',
			columns : [
				{
					text : 'Id',
					dataIndex : 'sipd_cek_id',
					width : 100,
					hidden : true,
					hideable: false,
					sortable : false
				},
				{
					text : 'Syarat',
					dataIndex : 'sipd_cek_syarat_nama',
					width : 300,
					sortable : false,
					editor : {
						xtype : 'textfield',
						readOnly : true
					}
				},
				{
					xtype: 'checkcolumn',
					text: 'Ada?',
					dataIndex: 'sipd_cek_status',
					width: 55,
					stopSelection: false
				},
				{
					text : 'Keterangan',
					dataIndex : 'sipd_cek_keterangan',
					width : 100,
					sortable : false,
					editor: 'textfield',
					flex : 1
				}
			]
		});
		var sipd_det_saveButton = Ext.create('Ext.Button',{
			text : globalSaveButtonTitle,
			handler : sipd_det_save
		});
		var sipd_det_cancelButton = Ext.create('Ext.Button',{
			text : globalCancelButtonTitle,
			handler : function(){
				sipd_det_resetForm();
				sipd_det_switchToGrid();
			}
		});
		var sipd_det_pendukungfieldset = Ext.create('Ext.form.FieldSet',{
			title : '5. Data Pendukung',
			columnWidth : 0.5,
			checkboxToggle : false,
			collapsible : false,
			layout :'form',
			items : [
				det_sipd_nomorregField,
				det_sipd_prosesField,
				det_sipd_skField,
				det_sipd_skurutField,
				det_sipd_berlakuField,
				det_sipd_terimaField,
				det_sipd_terimatanggalField,
				det_sipd_kelengkapanField,
				det_sipd_bapField,
				det_sipd_keputusanField,
				det_sipd_baptanggalField,
				det_sipd_kadaluarsaField
			]
		});
		/* START DATA RETRIBUSI */
		var sipd_det_retribusiField = Ext.create('Ext.form.RadioGroup',{
			fieldLabel : 'Retribusi ',
			vertical : false,
			items : [
				{ boxLabel : 'Gratis', name : 'sipd_retribusi', inputValue : '0', checked : true},
				{ boxLabel : 'Bayar', name : 'sipd_retribusi', inputValue : '1'}
			],
			listeners : {
				change : function(com, newval, oldval, e){
					if(newval.sipd_retribusi == 1){
						sipd_det_retibusiNilaiField.show();
					}else{
						sipd_det_retibusiNilaiField.hide();
					}
				}
			}
		});
		var sipd_det_retibusiNilaiField = Ext.create('Ext.form.TextField',{
			name : 'permohonan_retribusi',
			fieldLabel : 'Nominal Retribusi ',
			maxLength : 100,
			hidden : true,
			value : 0
		});
		sipd_det_retibusiTanggalField = Ext.create('Ext.form.field.Date',{
			name : 'permohonan_retribusi_tanggal',
			fieldLabel : 'Tanggal',
			format : 'd-m-Y',
			hidden : true,
			value : new Date('<?php echo date('Y-m-d').'T'.date('H:i:s'); ?>')
		});
		var sipd_det_retribusifieldset = Ext.create('Ext.form.FieldSet',{
			title : '6. Data Retribusi',
			columnWidth : 0.5,
			checkboxToggle : false,
			collapsible : false,
			layout :'form',
			items : [
				sipd_det_retribusiField,
				sipd_det_retibusiNilaiField,
				sipd_det_retibusiTanggalField
			]
		});
		/* END DATA RETRIBUSI */
		
		/* START DATA PERUSAHAAN */
		perusahaan_idField = Ext.create('Ext.form.TextField',{
			name : 'perusahaan_id',
			hidden : true
		});
		perusahaan_npwpField = Ext.create('Ext.form.ComboBox',{
			name : 'perusahaan_npwp',
			fieldLabel : 'NPWP/NPWPD',
			pageSize : 15,
			store : Ext.create('Ext.data.Store',{
				pageSize : globalPageSize,
				proxy : Ext.create('Ext.data.HttpProxy',{
					url : 'c_perusahaan/switchAction',
					reader : {
						type : 'json', root : 'results', rootProperty : 'results', totalProperty : 'total', idProperty : 'id'
					},
					actionMethods : { read : 'POST' },
					extraParams : { action : 'GETLIST' }
				}),
				fields : [
					{ name : 'id', type : 'int', mapping : 'id' },
					{ name : 'npwp', type : 'string', mapping : 'npwp' },
					{ name : 'nama', type : 'string', mapping : 'nama' },
					{ name : 'noakta', type : 'string', mapping : 'noakta' },
					{ name : 'notaris', type : 'string', mapping : 'notaris' },
					{ name : 'tglakta', type : 'date',dateFormat : 'Y-m-d', mapping : 'tglakta' },
					{ name : 'bentuk_id', type : 'int', mapping : 'bentuk_id' },
					{ name : 'kualifikasi_id', type : 'int', mapping : 'kualifikasi_id' },
					{ name : 'alamat', type : 'string', mapping : 'alamat' },
					{ name : 'rt', type : 'int', mapping : 'rt' },
					{ name : 'rw', type : 'int', mapping : 'rw' },
					{ name : 'propinsi_id', type : 'int', mapping : 'propinsi_id' },
					{ name : 'kabkota_id', type : 'int', mapping : 'kabkota_id' },
					{ name : 'kecamatan_id', type : 'int', mapping : 'kecamatan_id' },
					{ name : 'desa_id', type : 'int', mapping : 'desa_id' },
					{ name : 'kodepos', type : 'string', mapping : 'kodepos' },
					{ name : 'telp', type : 'string', mapping : 'telp' },
					{ name : 'fax', type : 'string', mapping : 'fax' },
					{ name : 'stempat_id', type : 'int', mapping : 'stempat_id' },
					{ name : 'sperusahaan_id', type : 'int', mapping : 'sperusahaan_id' },
					{ name : 'usaha', type : 'string', mapping : 'usaha' },
					{ name : 'butara', type : 'string', mapping : 'butara' },
					{ name : 'bselatan', type : 'string', mapping : 'bselatan' },
					{ name : 'btimur', type : 'string', mapping : 'btimur' },
					{ name : 'bbarat', type : 'string', mapping : 'bbarat' },
					{ name : 'modal', type : 'float', mapping : 'modal' },
					{ name : 'merk', type : 'int', mapping : 'merk' },
					{ name : 'jusaha_id', type : 'int', mapping : 'jusaha_id' }
				]
			}),
			displayField : 'npwp',
			valueField : 'id',
			queryMode : 'remote',
			triggerAction : 'query',
			repeatTriggerClick : true,
			minChars : 100,
			triggerCls : 'x-form-search-trigger',
			forceSelection : false,
			onTriggerClick: function(event){
				var store = perusahaan_npwpField.getStore();
				var val = perusahaan_npwpField.getRawValue();
				store.proxy.extraParams = {action : 'GETLIST',query : val};
				store.load();
				perusahaan_npwpField.expand();
				perusahaan_npwpField.fireEvent("ontriggerclick", this, event);
			},  
			tpl: Ext.create('Ext.XTemplate',
				'<tpl for=".">',
					'<div class="x-boundlist-item">NPWP : {npwp}<br>Nama : {nama}<br>Alamat : {alamat}</div>',
				'</tpl>'
			),
			listeners : {
				select : function(cmb, record){
					var rec=record[0];
					perusahaan_idField.setValue(rec.get('id'));
					perusahaan_npwpField.setValue(rec.get('npwp'));
					perusahaan_namaField.setValue(rec.get('nama'));
					perusahaan_noaktaField.setValue(rec.get('noakta'));
					perusahaan_notarisField.setValue(rec.get('notaris'));
					perusahaan_tglaktaField.setValue(rec.get('tglakta'));
					perusahaan_bentuk_idField.setValue(rec.get('bentuk_id'));
					perusahaan_kualifikasi_idField.setValue(rec.get('kualifikasi_id'));
					perusahaan_alamatField.setValue(rec.get('alamat'));
					perusahaan_rtField.setValue(rec.get('rt'));
					perusahaan_rwField.setValue(rec.get('rw'));
					perusahaan_propinsi_idField.setValue(rec.get('propinsi_id'));
					perusahaan_kabkota_idField.setValue(rec.get('kabkota_id'));
					perusahaan_desa_idField.setValue(rec.get('desa_id'));
					perusahaan_kecamatan_idField.setValue(rec.get('kecamatan_id'));
					perusahaan_kodeposField.setValue(rec.get('kodepos'));
					perusahaan_telpField.setValue(rec.get('telp'));
					perusahaan_faxField.setValue(rec.get('fax'));
					perusahaan_stempat_idField.setValue(rec.get('stempat_id'));
					perusahaan_sperusahaan_idField.setValue(rec.get('sperusahaan_id'));
					perusahaan_usahaField.setValue(rec.get('usaha'));
					perusahaan_butaraField.setValue(rec.get('butara'));
					perusahaan_bselatanField.setValue(rec.get('bselatan'));
					perusahaan_btimurField.setValue(rec.get('btimur'));
					perusahaan_bbaratField.setValue(rec.get('bbarat'));
					perusahaan_modalField.setValue(rec.get('modal'));
					perusahaan_merkField.setValue(rec.get('merk'));
					perusahaan_jusaha_idField.setValue(rec.get('jusaha_id'));
				}
			}
		});
		perusahaan_namaField = Ext.create('Ext.form.TextField',{
			name : 'perusahaan_nama',
			fieldLabel : 'Nama',
			maxLength : 100
		});
		perusahaan_noaktaField = Ext.create('Ext.form.TextField',{
			name : 'perusahaan_noakta',
			fieldLabel : 'No. Akta',
			maxLength : 100
		});
		perusahaan_notarisField = Ext.create('Ext.form.TextField',{
			name : 'perusahaan_notaris',
			fieldLabel : 'Notaris',
			maxLength : 100
		});
		perusahaan_tglaktaField = Ext.create('Ext.form.field.Date',{
			name : 'perusahaan_tglakta',
			fieldLabel : 'Tgl Akta',
			format : 'd-m-Y',
			value : new Date('<?php echo date('Y-m-d').'T'.date('H:i:s'); ?>')
		});
		perusahaan_bentuk_idField = Ext.create('Ext.form.ComboBox',{
			name : 'perusahaan_bentuk_id',
			fieldLabel : 'Bentuk',
			store : Ext.create('Ext.data.Store',{
				pageSize : globalPageSize,
				proxy : Ext.create('Ext.data.HttpProxy',{
					url : 'c_public_function/get_bentuk_perusahaan',
					reader : {
						type : 'json',
						root : 'results',
						rootProperty : 'results',
						totalProperty : 'total',
						idProperty : 'id'
					},
					actionMethods : {
						read : 'POST'
					}
				}),
				fields : [
					{ name : 'id', type : 'int', mapping : 'id' },
					{ name : 'nama', type : 'string', mapping : 'nama' }
				]
			}),
			displayField : 'nama',
			valueField : 'id',
			triggerAction : 'all',
			queryMode : 'local',
			listeners : {
				afterrender : function(){
					perusahaan_bentuk_idField.getStore().load();
				}
			}
		});
		perusahaan_kualifikasi_idField = Ext.create('Ext.form.ComboBox',{
			name : 'perusahaan_kualifikasi_id',
			fieldLabel : 'Kualifikasi',
			store : Ext.create('Ext.data.Store',{
				pageSize : globalPageSize,
				proxy : Ext.create('Ext.data.HttpProxy',{
					url : 'c_public_function/get_kualifikasi',
					reader : {
						type : 'json',
						root : 'results',
						rootProperty : 'results',
						totalProperty : 'total',
						idProperty : 'id'
					},
					actionMethods : {
						read : 'POST'
					}
				}),
				fields : [
					{ name : 'id', type : 'int', mapping : 'id' },
					{ name : 'kualifikasi', type : 'string', mapping : 'kualifikasi' }
				]
			}),
			displayField : 'kualifikasi',
			valueField : 'id',
			triggerAction : 'all',
			queryMode : 'local',
			listeners : {
				afterrender : function(){
					perusahaan_kualifikasi_idField.getStore().load();
				}
			}
		});
		perusahaan_alamatField = Ext.create('Ext.form.TextField',{
			name : 'perusahaan_alamat',
			fieldLabel : 'Alamat',
			maxLength : 100
		});
		perusahaan_rtField = Ext.create('Ext.form.TextField',{
			name : 'perusahaan_rt',
			fieldLabel : 'RT',
			maxLength : 10
		});
		perusahaan_rwField = Ext.create('Ext.form.TextField',{
			name : 'perusahaan_rw',
			fieldLabel : 'RW',
			maxLength : 10
		});
		perusahaan_propinsi_idField = Ext.create('Ext.form.ComboBox',{
			name : 'perusahaan_propinsi_id',
			fieldLabel : 'Propinsi',
			store : Ext.create('Ext.data.Store',{
				pageSize : globalPageSize,
				proxy : Ext.create('Ext.data.HttpProxy',{
					url : 'c_public_function/get_propinsi',
					reader : {
						type : 'json',
						root : 'results',
						rootProperty : 'results',
						totalProperty : 'total',
						idProperty : 'id'
					},
					actionMethods : {
						read : 'POST'
					}
				}),
				fields : [
					{ name : 'id', type : 'int', mapping : 'id' },
					{ name : 'propinsi', type : 'string', mapping : 'propinsi' }
				]
			}),
			displayField : 'propinsi',
			valueField : 'id',
			triggerAction : 'all',
			queryMode : 'local',
			listeners : {
				afterrender : function(){
					perusahaan_propinsi_idField.getStore().load();
				}
			}
		});
		perusahaan_kabkota_idField = Ext.create('Ext.form.ComboBox',{
			name : 'perusahaan_kabkota_id',
			fieldLabel : 'Kota',
			store : Ext.create('Ext.data.Store',{
				pageSize : globalPageSize,
				proxy : Ext.create('Ext.data.HttpProxy',{
					url : 'c_public_function/get_kabkota',
					reader : {
						type : 'json',
						root : 'results',
						rootProperty : 'results',
						totalProperty : 'total',
						idProperty : 'id'
					},
					actionMethods : {
						read : 'POST'
					}
				}),
				fields : [
					{ name : 'id', type : 'int', mapping : 'id' },
					{ name : 'kabkota', type : 'string', mapping : 'kabkota' }
				]
			}),
			displayField : 'kabkota',
			valueField : 'id',
			triggerAction : 'all',
			queryMode : 'local',
			listeners : {
				afterrender : function(){
					perusahaan_kabkota_idField.getStore().load();
				}
			}
		});
		perusahaan_desa_idField = Ext.create('Ext.form.ComboBox',{
			name : 'perusahaan_desa_id',
			fieldLabel : 'Desa',
			store : kelurahan_dataStore,
			displayField : 'desa',
			valueField : 'id',
			triggerAction : 'all',
			queryMode : 'local'
		});
		perusahaan_kecamatan_idField = Ext.create('Ext.form.ComboBox',{
			name : 'perusahaan_kecamatan_id',
			fieldLabel : 'Kecamatan',
			store : kecamatan_dataStore,
			displayField : 'kecamatan',
			valueField : 'id',
			triggerAction : 'all',
			queryMode : 'local'
		});
		perusahaan_kodeposField = Ext.create('Ext.form.TextField',{
			name : 'perusahaan_kodepos',
			fieldLabel : 'Kodepos',
			maxLength : 20
		});
		perusahaan_telpField = Ext.create('Ext.form.TextField',{
			name : 'perusahaan_telp',
			fieldLabel : 'Telp',
			maxLength : 50
		});
		perusahaan_faxField = Ext.create('Ext.form.TextField',{
			name : 'perusahaan_fax',
			fieldLabel : 'Fax',
			maxLength : 50
		});
		perusahaan_stempat_idField = Ext.create('Ext.form.ComboBox',{
			name : 'perusahaan_stempat_id',
			fieldLabel : 'Status Tempat',
			store : Ext.create('Ext.data.Store',{
				pageSize : globalPageSize,
				proxy : Ext.create('Ext.data.HttpProxy',{
					url : 'c_public_function/get_status_tempat',
					reader : {
						type : 'json',
						root : 'results',
						rootProperty : 'results',
						totalProperty : 'total',
						idProperty : 'id'
					},
					actionMethods : {
						read : 'POST'
					}
				}),
				fields : [
					{ name : 'id', type : 'int', mapping : 'id' },
					{ name : 'status', type : 'string', mapping : 'status' }
				]
			}),
			displayField : 'status',
			valueField : 'id',
			triggerAction : 'all',
			queryMode : 'local',
			listeners : {
				afterrender : function(){
					perusahaan_stempat_idField.getStore().load();
				}
			}
		});
		perusahaan_sperusahaan_idField = Ext.create('Ext.form.ComboBox',{
			name : 'perusahaan_sperusahaan_id',
			fieldLabel : 'Status Usaha',
			store : Ext.create('Ext.data.Store',{
				pageSize : globalPageSize,
				proxy : Ext.create('Ext.data.HttpProxy',{
					url : 'c_public_function/get_status_usaha',
					reader : {
						type : 'json',
						root : 'results',
						rootProperty : 'results',
						totalProperty : 'total',
						idProperty : 'id'
					},
					actionMethods : {
						read : 'POST'
					}
				}),
				fields : [
					{ name : 'id', type : 'int', mapping : 'id' },
					{ name : 'status', type : 'string', mapping : 'status' }
				]
			}),
			displayField : 'status',
			valueField : 'id',
			triggerAction : 'all',
			queryMode : 'local',
			listeners : {
				afterrender : function(){
					perusahaan_sperusahaan_idField.getStore().load();
				}
			}
		});
		perusahaan_usahaField = Ext.create('Ext.form.TextField',{
			name : 'perusahaan_usaha',
			fieldLabel : 'Usaha',
			maxLength : 100
		});
		perusahaan_butaraField = Ext.create('Ext.form.TextField',{
			name : 'perusahaan_butara',
			fieldLabel : 'Batas Utara',
			maxLength : 100
		});
		perusahaan_bselatanField = Ext.create('Ext.form.TextField',{
			name : 'perusahaan_bselatan',
			fieldLabel : 'Batas Selatan',
			maxLength : 100
		});
		perusahaan_btimurField = Ext.create('Ext.form.TextField',{
			name : 'perusahaan_btimur',
			fieldLabel : 'Batas Timur',
			maxLength : 100
		});
		perusahaan_bbaratField = Ext.create('Ext.form.TextField',{
			name : 'perusahaan_bbarat',
			fieldLabel : 'Batas Barat',
			maxLength : 100
		});
		perusahaan_modalField = Ext.create('Ext.form.TextField',{
			name : 'perusahaan_modal',
			fieldLabel : 'Modal',
			maxLength : 50
		});
		perusahaan_merkField = Ext.create('Ext.form.ComboBox',{
			name : 'perusahaan_merk',
			fieldLabel : 'Merk',
			store : Ext.create('Ext.data.Store',{
				pageSize : globalPageSize,
				proxy : Ext.create('Ext.data.HttpProxy',{
					url : 'c_public_function/get_merk',
					reader : {
						type : 'json',
						root : 'results',
						rootProperty : 'results',
						totalProperty : 'total',
						idProperty : 'id'
					},
					actionMethods : {
						read : 'POST'
					}
				}),
				fields : [
					{ name : 'id', type : 'int', mapping : 'id' },
					{ name : 'merk', type : 'string', mapping : 'merk' }
				]
			}),
			displayField : 'merk',
			valueField : 'id',
			triggerAction : 'all',
			queryMode : 'local',
			listeners : {
				afterrender : function(){
					perusahaan_merkField.getStore().load();
				}
			}
		});
		perusahaan_jusaha_idField = Ext.create('Ext.form.ComboBox',{
			name : 'perusahaan_jusaha_id',
			fieldLabel : 'Jenis Usaha',
			store : Ext.create('Ext.data.Store',{
				pageSize : globalPageSize,
				proxy : Ext.create('Ext.data.HttpProxy',{
					url : 'c_public_function/get_jenis_usaha',
					reader : {
						type : 'json',
						root : 'results',
						rootProperty : 'results',
						totalProperty : 'total',
						idProperty : 'id'
					},
					actionMethods : {
						read : 'POST'
					}
				}),
				fields : [
					{ name : 'id', type : 'int', mapping : 'id' },
					{ name : 'usaha', type : 'string', mapping : 'usaha' }
				]
			}),
			displayField : 'usaha',
			valueField : 'id',
			triggerAction : 'all',
			queryMode : 'local',
			listeners : {
				afterrender : function(){
					perusahaan_jusaha_idField.getStore().load();
				}
			}
		});
		/* END DATA PERUSAHAAN */
		sipd_det_formPanel = Ext.create('Ext.form.Panel', {
			disabled : true,
			fieldDefaults: {
				msgTarget: 'side'
			},
			layout : {
				type : 'vbox',
				align : 'stretch',
				padding : 5
			},
			items: [
				{
					xtype : 'container',
					layout : 'hbox',
					style : {borderWidth :'0px'},
					defaultType : 'textfield',
					defaults : {anchor : '95%'},
					layout : 'anchor',
					flex : 2,
					items : [
						{
							xtype : 'fieldset',
							title : '1. Data Permohonan',
							checkboxToggle : false,
							collapsible : false,
							layout :'form',
							items : [
								det_sipd_idField,
								det_sipd_sipd_idField,
								permohonan_idField,
								det_sipd_jenisField,
								det_sipd_sklamaField,
								det_sipd_tanggalField
							]
						},{
							xtype : 'fieldset',
							title : '2. Data Pemohon',
							checkboxToggle : false,
							collapsible : false,
							layout :'form',
							items : [
								sipd_det_pemohon_idField,
								sipd_det_pemohon_nikField,
								sipd_det_pemohon_namaField,
								sipd_det_pemohon_alamatField,
								sipd_det_pemohon_telpField,
								sipd_det_pemohon_npwpField,
								sipd_det_pemohon_rtField,
								sipd_det_pemohon_rwField,
								sipd_det_pemohon_kelField,
								sipd_det_pemohon_kecField,
								sipd_det_pemohon_straField,
								sipd_det_pemohon_surattugasField,
								sipd_det_pemohon_pekerjaanField,
								sipd_det_pemohon_tempatlahirField,
								sipd_det_pemohon_tanggallahirField,
								sipd_det_pemohon_user_idField,
								sipd_det_pemohon_pendidikanField,
								sipd_det_pemohon_tahunlulusField
							]
						},{
							xtype : 'fieldset',
							title : '3. Data Praktek',
							columnWidth : 0.5,
							checkboxToggle : false,
							collapsible : false,
							layout :'form',
							items : [
								sipd_namaField,
								sipd_alamatField,
								sipd_telpField,
								sipd_urutanField,
								sipd_jenisdokterField,
								det_sipd_kompetensiField,
								det_sipd_strField,
								det_sipd_nropField,
								det_sipd_sipField,
							]
						},{
							xtype : 'fieldset',
							title : '4. Data Syarat',
							columnWidth : 0.5,
							checkboxToggle : false,
							collapsible : false,
							layout :'form',
							items : [
								det_sipd_syaratGrid
							]
						},sipd_det_pendukungfieldset,sipd_det_retribusifieldset
					]
				}, {
					bodyPadding : 5,
					items : [Ext.create('Ext.form.Label',{ html : 'Keterangan : ' + globalRequiredInfo })],
					flex : 2
				}],
			buttons : [sipd_det_saveButton,sipd_det_cancelButton]
		});
		sipd_det_formWindow = Ext.create('Ext.window.Window',{
			id : 'sipd_det_formWindow',
			renderTo : 'sipd_detSaveWindow',
			title : globalFormAddEditTitle + ' ' + sipd_det_componentItemTitle,
			width : 500,
			minHeight : 300,
			autoHeight : true,
			constrain : true,
			closeAction : 'hide',
			modal : true,
			closable : false,
			items : [sipd_det_formPanel]
		});
/* End FormPanel declaration */
	<?php if(@$_SESSION['IDHAK'] == 2){ ?>
		sipd_det_lk_printCM.hide();
		sipd_det_bap_printCM.hide();
		sipd_det_sk_printCM.hide();
		sipd_det_pendukungfieldset.hide();
		sipd_det_gridPanel.columns[10].setVisible(false);
		sipd_det_gridPanel.columns[11].setVisible(false);
	<?php } ?>
});
</script>
<div id="sipd_detSaveWindow"></div>
<div class="container col-md-12" id="sipd_detGrid"></div>
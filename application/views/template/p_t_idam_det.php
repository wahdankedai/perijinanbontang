<?php if(@$type=="EXCEL"){ ?>
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Daftar Data IDAM</title>
	<xml>
	 <x:ExcelWorkbook>
	  <x:ExcelWorksheets>
	   <x:ExcelWorksheet>
		<x:Name>Sheet</x:Name>
		<x:WorksheetOptions>
		 <x:Print>
			<x:Gridlines />
		 </x:Print>
		</x:WorksheetOptions>
	   </x:ExcelWorksheet>
	  </x:ExcelWorksheets>
	 </x:ExcelWorkbook>
	</xml>
</head>
<body>
<?php }else{ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Daftar Data IDAM</title>
	<link rel='stylesheet' type='text/css' href='../assets/css/printstyle.css'/>
</head>
<body onload="window.print();">
<?php } ?>	<table>
		<caption>Data Izin Depo Air Minum</caption>
		<thead>
			<tr>
				<th align="center" width="50">No</td>
				<th align="center">Jenis</td>
				<th align="center">Tanggal</td>
				<th align="center">Nama Pemohon</td>
				<th align="center">Alamat</td>
				<th align="center">No. Telp</td>
				<th align="center">Usaha</td>
				<th align="center">Lama Proses</td>
			</tr>
		</thead>
		<tbody>
			<?php
			$total_record = 0; 
			if(count($records) > 0){ 
				foreach($records as $subrecord){
					$total_record++;
			?>
				<tr>
					<td><?php echo $total_record; ?></td>
					<td><?php echo $subrecord->det_idam_jenis_nama; ?></td>
					<td><?php echo date('d-m-Y', strtotime($subrecord->det_idam_tanggal)); ?></td>
					<td><?php echo $subrecord->pemohon_nama; ?></td>
					<td><?php echo $subrecord->pemohon_alamat; ?></td>
					<td><?php echo $subrecord->pemohon_telp; ?></td>
					<td><?php echo $subrecord->idam_usaha; ?></td>
					<td><?php echo $subrecord->lamaproses; ?></td>
					</tr>
			<?php }} ?>			<tr>
				<td>Total</td>
				<td colspan="7"><?php echo $total_record; ?></td>
			</tr>
		<tbody>
	</table>
</body>
</html>
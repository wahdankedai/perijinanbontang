<!DOCTYPE html>
<html>
<head>
	<title>Laporan Permohonan</title>
</head>
<body onLoad="window.print();">
	<table width="900px" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="7" align="center">BADAN PELAYANAN PERIJINAN TERPADU DAN PENANAMAN MODAL</td>
		</tr>
		<tr>
			<td colspan="7" align="center">KOTA BONTANG</td>
		</tr>
		<tr>
			<td colspan="7" align="center">LAPORAN PENERBITAN SK <?php echo strtoupper($params['laporan_ijin_nama']); ?></td>
		</tr>
		<tr>
			<td colspan="5">Tanggal Permohonan : <?php if($params['laporan_opsi'] == 'tanggal'){echo $params['laporan_tanggalAwal'] . ' s/d ' .$params['laporan_tanggalAkhir'];}else{echo $params['laporan_bulan'] . '-' . $params['laporan_tahun']; } ?> </td>
			<td colspan="2" align="right">Tanggal Cetak : <?php echo date('d-m-Y'); ?></td>
		</tr>
		<tr>
			<td colspan="7" align="center">&nbsp;</td>
		</tr>
		<tr>
			<td align="center">No.</td>
			<td align="center">No. SK</td>
			<td align="center">Tgl. Terbit</td>
			<td align="center">Nama Pemohon</td>
			<td align="center">Alamat</td>
			<td align="center">Tgl. Permohonan</td>
			<td align="center">Waktu Penyelesaian</td>
		</tr>
		<?php $n=0; if(count($printrecord)>0){ 
		foreach($printrecord AS $subrecord){ $n++; ?>
			<tr>
				<td><?php echo $n; ?></td>
				<td><?php echo $subrecord->permohonan_sk; ?></td>
				<td><?php echo $subrecord->permohonan_terbit; ?></td>
				<td><?php echo $subrecord->pemohon_nama; ?></td>
				<td><?php echo $subrecord->pemohon_alamat; ?></td>
				<td><?php echo $subrecord->permohonan_tanggal; ?></td>
				<td><?php echo $subrecord->lamaproses; ?></td>
			</tr>
		<?php }}else{ ?>
		<tr>
			<td colspan="7" align="center">Tidak Ada Data</td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>
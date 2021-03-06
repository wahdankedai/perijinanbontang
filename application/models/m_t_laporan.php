<?php
class M_t_laporan extends App_Model{
	
	function __construct(){
        parent::__construct();
        $this->table_name = '';
        $this->column_primary = '';
        $this->column_order = '';
		$this->column_unique = '';
    }
	
	function getrecords($params){
		extract($params);
		$sql = "";
		switch($laporan_ijin){
			case 22:
				$sql = "
					SELECT CASE WHEN det_idam_jenis = 1 THEN 'BARU' ELSE 'PERPANJANGAN' END AS permohonan_jenis,
						pemohon_nama, pemohon_alamat, det_idam_proses AS permohonan_proses,
						det_idam_tanggal AS permohonan_tanggal, det_idam_sk AS permohonan_sk,
						det_idam_berlaku AS permohonan_terbit
						FROM t_idam_det 
						JOIN t_idam ON t_idam_det.det_idam_idam_id = t_idam.idam_id
						JOIN m_pemohon ON t_idam_det.det_idam_pemohon_id = m_pemohon.pemohon_id
					WHERE det_idam_id IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_idam_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_idam_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_idam_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 23:
				$sql = "
					SELECT CASE WHEN det_ipmbl_jenis = 1 THEN 'BARU' ELSE 'PERPANJANGAN' END AS permohonan_jenis,
						pemohon_nama, pemohon_alamat, det_ipmbl_proses AS permohonan_proses,
						det_ipmbl_tanggal AS permohonan_tanggal, det_ipmbl_sk AS permohonan_sk,
						det_ipmbl_berlaku AS permohonan_terbit
						FROM t_ipmbl_det 
						JOIN t_ipmbl ON t_ipmbl_det.det_ipmbl_ipmbl_id = t_ipmbl.ipmbl_id
						JOIN m_pemohon ON t_ipmbl_det.det_ipmbl_pemohon_id = m_pemohon.pemohon_id
					WHERE det_ipmbl_id IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_ipmbl_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_ipmbl_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_ipmbl_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 24:
				$sql = "
					SELECT CASE WHEN det_iujt_jenis = 1 THEN 'BARU' ELSE 'PERPANJANGAN' END AS permohonan_jenis,
						pemohon_nama, pemohon_alamat, det_iujt_proses AS permohonan_proses,
						det_iujt_tanggal AS permohonan_tanggal, det_iujt_sk AS permohonan_sk,
						det_iujt_berlaku AS permohonan_terbit
						FROM t_iujt_det 
						JOIN t_iujt ON t_iujt_det.det_iujt_iujt_id = t_iujt.iujt_id
						JOIN m_pemohon ON t_iujt_det.det_iujt_pemohon_id = m_pemohon.pemohon_id
					WHERE det_iujt_id IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_iujt_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_iujt_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_iujt_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 5:
				$sql = "
					SELECT CASE WHEN det_iujk_jenis = 1 THEN 'BARU' ELSE 'PERPANJANGAN' END AS permohonan_jenis,
						pemohon_nama, pemohon_alamat, det_iujk_proses AS permohonan_proses,
						det_iujk_tanggal AS permohonan_tanggal, det_iujk_sk AS permohonan_sk,
						det_iujk_berlaku AS permohonan_terbit
						FROM t_iujk_det 
						JOIN t_iujk ON t_iujk_det.det_iujk_iujk_id = t_iujk.iujk_id
						JOIN m_pemohon ON t_iujk_det.det_iujk_pemohon_id = m_pemohon.pemohon_id
					WHERE det_iujk_id IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_iujk_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_iujk_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_iujk_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 25:
				$sql = "
					SELECT CASE WHEN det_apotek_jenis = 1 THEN 'BARU' ELSE 'PERPANJANGAN' END AS permohonan_jenis,
						pemohon_nama, pemohon_alamat, det_apotek_proses AS permohonan_proses,
						det_apotek_tanggal AS permohonan_tanggal, det_apotek_sk AS permohonan_sk,
						det_apotek_berlaku AS permohonan_terbit
						FROM t_apotek_det 
						JOIN t_apotek ON t_apotek_det.det_apotek_apotek_id = t_apotek.apotek_id
						JOIN m_pemohon ON t_apotek_det.det_apotek_pemohon_id = m_pemohon.pemohon_id
					WHERE det_apotek_id IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_apotek_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_apotek_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_apotek_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 28:
				$sql = "
					SELECT CASE WHEN JENIS_PERMOHONAN = 1 THEN 'BARU' ELSE 'PERPANJANGAN' END AS permohonan_jenis,
						pemohon_nama, pemohon_alamat, STATUS AS permohonan_proses,
						TGL_PERMOHONAN AS permohonan_tanggal, NO_SK AS permohonan_sk,
						TGL_AWAL AS permohonan_terbit
						FROM ijin_lingkungan 
						JOIN ijin_lingkungan_inti ON ijin_lingkungan_inti.ID_IJIN_LINGKUNGAN_INTI = ijin_lingkungan.ID_IJIN_LINGKUNGAN_INTI
						JOIN m_pemohon ON ijin_lingkungan_inti.ID_PEMOHON = m_pemohon.pemohon_id
					WHERE ID_IJIN_LINGKUNGAN IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 29:
				$sql = "
					SELECT CASE WHEN JENIS_PERMOHONAN = 1 THEN 'BARU' ELSE 'PERPANJANGAN' END AS permohonan_jenis,
						pemohon_nama, pemohon_alamat, STATUS AS permohonan_proses,
						TGL_PERMOHONAN AS permohonan_tanggal, NO_SK AS permohonan_sk,
						TGL_BERLAKU AS permohonan_terbit
						FROM sppl 
						JOIN m_pemohon ON sppl.ID_PEMOHON = m_pemohon.pemohon_id
					WHERE ID_SPPL IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 30:
				$sql = "
					SELECT CASE WHEN JENIS_PERMOHONAN = 1 THEN 'BARU' ELSE 'PERPANJANGAN' END AS permohonan_jenis,
						pemohon_nama, pemohon_alamat, STATUS AS permohonan_proses,
						TGL_PERMOHONAN AS permohonan_tanggal, NO_SK AS permohonan_sk,
						TGL_BERLAKU AS permohonan_terbit
						FROM sktr 
						JOIN m_pemohon ON sktr.ID_PEMOHON = m_pemohon.pemohon_id
					WHERE ID_SKTR IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 31:
				$sql = "
					SELECT CASE WHEN JENIS_PERMOHONAN = 1 THEN 'BARU' ELSE 'PERPANJANGAN' END AS permohonan_jenis,
						pemohon_nama, pemohon_alamat, STATUS AS permohonan_proses,
						TGL_PERMOHONAN AS permohonan_tanggal, NO_SK AS permohonan_sk,
						TGL_BERLAKU AS permohonan_terbit
						FROM iuiphhk 
						JOIN m_pemohon ON iuiphhk.ID_PEMOHON = m_pemohon.pemohon_id
					WHERE ID_IUIPHHK IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 32:
				$sql = "
					SELECT CASE WHEN JENIS_PERMOHONAN = 1 THEN 'BARU' ELSE 'PERPANJANGAN' END AS permohonan_jenis,
						pemohon_nama, pemohon_alamat, STATUS AS permohonan_proses,
						TGL_PERMOHONAN AS permohonan_tanggal, NO_SK AS permohonan_sk,
						TGL_BERLAKU AS permohonan_terbit
						FROM ijin_prinsip 
						JOIN m_pemohon ON ijin_prinsip.ID_PEMOHON = m_pemohon.pemohon_id
					WHERE ID_IJIN_PRINSIP IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 33:
				$sql = "
					SELECT CASE WHEN JENIS_PERMOHONAN = 1 THEN 'BARU' ELSE 'PERPANJANGAN' END AS permohonan_jenis,
						pemohon_nama, pemohon_alamat, STATUS AS permohonan_proses,
						TGL_PERMOHONAN AS permohonan_tanggal, NO_SK AS permohonan_sk,
						TGL_BERLAKU AS permohonan_terbit
						FROM trotoar 
						JOIN m_pemohon ON trotoar.ID_PEMOHON = m_pemohon.pemohon_id
					WHERE ID_TROTOAR IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 27:
				$sql = "
					SELECT CASE WHEN det_simb_jenis = 1 THEN 'BARU' ELSE 'PERPANJANGAN' END AS permohonan_jenis,
						pemohon_nama, pemohon_alamat, det_simb_proses AS permohonan_proses,
						det_simb_tanggal AS permohonan_tanggal, det_simb_sk AS permohonan_sk,
						det_simb_berlaku AS permohonan_terbit
						FROM t_simb_det 
						JOIN t_simb ON t_simb_det.det_simb_simb_id = t_simb.simb_id
						JOIN m_pemohon ON t_simb_det.det_simb_pemohon_id = m_pemohon.pemohon_id
					WHERE det_simb_id IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_simb_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_simb_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_simb_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 26:
				$sql = "
					SELECT CASE WHEN det_sipd_jenis = 1 THEN 'BARU' ELSE 'PERPANJANGAN' END AS permohonan_jenis,
						pemohon_nama, pemohon_alamat, det_sipd_proses AS permohonan_proses,
						det_sipd_tanggal AS permohonan_tanggal, det_sipd_sk AS permohonan_sk,
						det_sipd_berlaku AS permohonan_terbit
						FROM t_sipd_det 
						JOIN t_sipd ON t_sipd_det.det_sipd_sipd_id = t_sipd.sipd_id
						JOIN m_pemohon ON t_sipd_det.det_sipd_pemohon_id = m_pemohon.pemohon_id
					WHERE det_sipd_id IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_sipd_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_sipd_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_sipd_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
		}
		$result = $this->__listCore($sql, $params);
		return $result;
	}
	
	function getrecordssk($params){
		extract($params);
		$sql = "";
		switch($laporan_ijin){
			case 22:
				$sql = "
					SELECT 
						pemohon_nama, pemohon_alamat,
						det_idam_tanggal AS permohonan_tanggal, 
						det_idam_sk AS permohonan_sk,
						det_idam_berlaku AS permohonan_terbit,
						CONCAT(5 * (DATEDIFF(det_idam_tanggal, det_idam_berlaku) DIV 7) + 
							MID('0123444401233334012222340111123400001234000123450', 7 * WEEKDAY(det_idam_tanggal) + WEEKDAY(det_idam_berlaku) + 
								1, 1),' Hari') as lamaproses
						FROM t_idam_det 
						JOIN t_idam ON t_idam_det.det_idam_idam_id = t_idam.idam_id
						JOIN m_pemohon ON t_idam_det.det_idam_pemohon_id = m_pemohon.pemohon_id
					WHERE det_idam_id IS NOT NULL 
					AND det_idam_sk IS NOT NULL
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_idam_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_idam_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_idam_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 23:
				$sql = "
					SELECT 
						pemohon_nama, pemohon_alamat,
						det_ipmbl_tanggal AS permohonan_tanggal, 
						det_ipmbl_sk AS permohonan_sk,
						det_ipmbl_berlaku AS permohonan_terbit,
						CONCAT(5 * (DATEDIFF(det_ipmbl_tanggal, det_ipmbl_berlaku) DIV 7) + 
							MID('0123444401233334012222340111123400001234000123450', 7 * WEEKDAY(det_ipmbl_tanggal) + WEEKDAY(det_ipmbl_berlaku) + 
								1, 1),' Hari') as lamaproses
						FROM t_ipmbl_det 
						JOIN t_ipmbl ON t_ipmbl_det.det_ipmbl_ipmbl_id = t_ipmbl.ipmbl_id
						JOIN m_pemohon ON t_ipmbl_det.det_ipmbl_pemohon_id = m_pemohon.pemohon_id
					WHERE det_ipmbl_id IS NOT NULL 
					AND det_ipmbl_sk IS NOT NULL
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_ipmbl_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_ipmbl_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_ipmbl_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 24:
				$sql = "
					SELECT 
						pemohon_nama, pemohon_alamat,
						det_iujt_tanggal AS permohonan_tanggal, 
						det_iujt_sk AS permohonan_sk,
						det_iujt_berlaku AS permohonan_terbit,
						CONCAT(5 * (DATEDIFF(det_iujt_tanggal, det_iujt_berlaku) DIV 7) + 
							MID('0123444401233334012222340111123400001234000123450', 7 * WEEKDAY(det_iujt_tanggal) + WEEKDAY(det_iujt_berlaku) + 
								1, 1),' Hari') as lamaproses
						FROM t_iujt_det 
						JOIN t_iujt ON t_iujt_det.det_iujt_iujt_id = t_iujt.iujt_id
						JOIN m_pemohon ON t_iujt_det.det_iujt_pemohon_id = m_pemohon.pemohon_id
					WHERE det_iujt_id IS NOT NULL 
					AND det_iujt_sk IS NOT NULL
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_iujt_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_iujt_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_iujt_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 5:
				$sql = "
					SELECT 
						pemohon_nama, pemohon_alamat,
						det_iujk_tanggal AS permohonan_tanggal, 
						det_iujk_sk AS permohonan_sk,
						det_iujk_berlaku AS permohonan_terbit,
						CONCAT(5 * (DATEDIFF(det_iujk_tanggal, det_iujk_berlaku) DIV 7) + 
							MID('0123444401233334012222340111123400001234000123450', 7 * WEEKDAY(det_iujk_tanggal) + WEEKDAY(det_iujk_berlaku) + 
								1, 1),' Hari') as lamaproses
						FROM t_iujk_det 
						JOIN t_iujk ON t_iujk_det.det_iujk_iujk_id = t_iujk.iujk_id
						JOIN m_pemohon ON t_iujk_det.det_iujk_pemohon_id = m_pemohon.pemohon_id
					WHERE det_iujk_id IS NOT NULL 
					AND det_iujk_sk IS NOT NULL
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_iujk_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_iujk_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_iujk_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 25:
				$sql = "
					SELECT 
						pemohon_nama, pemohon_alamat,
						det_apotek_tanggal AS permohonan_tanggal, 
						det_apotek_sk AS permohonan_sk,
						det_apotek_berlaku AS permohonan_terbit,
						CONCAT(5 * (DATEDIFF(det_apotek_tanggal, det_apotek_berlaku) DIV 7) + 
							MID('0123444401233334012222340111123400001234000123450', 7 * WEEKDAY(det_apotek_tanggal) + WEEKDAY(det_apotek_berlaku) + 
								1, 1),' Hari') as lamaproses
						FROM t_apotek_det 
						JOIN t_apotek ON t_apotek_det.det_apotek_apotek_id = t_apotek.apotek_id
						JOIN m_pemohon ON t_apotek_det.det_apotek_pemohon_id = m_pemohon.pemohon_id
					WHERE det_apotek_id IS NOT NULL 
					AND det_apotek_sk IS NOT NULL
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_apotek_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_apotek_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_apotek_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 28:
				$sql = "
					SELECT 
						pemohon_nama, pemohon_alamat,
						TGL_PERMOHONAN AS permohonan_tanggal, 
						NO_SK AS permohonan_sk,
						TGL_AWAL AS permohonan_terbit,
						CONCAT(5 * (DATEDIFF(TGL_PERMOHONAN, TGL_AWAL) DIV 7) + 
							MID('0123444401233334012222340111123400001234000123450', 7 * WEEKDAY(TGL_PERMOHONAN) + WEEKDAY(TGL_AWAL) + 
								1, 1),' Hari') as lamaproses
						FROM ijin_lingkungan 
						JOIN ijin_lingkungan_inti ON ijin_lingkungan_inti.ID_IJIN_LINGKUNGAN_INTI = ijin_lingkungan.ID_IJIN_LINGKUNGAN_INTI
						JOIN m_pemohon ON ijin_lingkungan_inti.ID_PEMOHON = m_pemohon.pemohon_id
					WHERE ID_IJIN_LINGKUNGAN IS NOT NULL 
					AND NO_SK IS NOT NULL
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 29:
				$sql = "
					SELECT 
						pemohon_nama, pemohon_alamat,
						TGL_PERMOHONAN AS permohonan_tanggal, 
						NO_SK AS permohonan_sk,
						TGL_BERLAKU AS permohonan_terbit,
						CONCAT(5 * (DATEDIFF(TGL_PERMOHONAN, TGL_BERLAKU) DIV 7) + 
							MID('0123444401233334012222340111123400001234000123450', 7 * WEEKDAY(TGL_PERMOHONAN) + WEEKDAY(TGL_BERLAKU) + 
								1, 1),' Hari') as lamaproses
						FROM sppl 
						JOIN m_pemohon ON sppl.ID_PEMOHON = m_pemohon.pemohon_id
					WHERE ID_SPPL IS NOT NULL 
					AND NO_SK IS NOT NULL
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 30:
				$sql = "
					SELECT 
						pemohon_nama, pemohon_alamat,
						TGL_PERMOHONAN AS permohonan_tanggal, 
						NO_SK AS permohonan_sk,
						TGL_BERLAKU AS permohonan_terbit,
						CONCAT(5 * (DATEDIFF(TGL_PERMOHONAN, TGL_BERLAKU) DIV 7) + 
							MID('0123444401233334012222340111123400001234000123450', 7 * WEEKDAY(TGL_PERMOHONAN) + WEEKDAY(TGL_BERLAKU) + 
								1, 1),' Hari') as lamaproses
						FROM sktr 
						JOIN m_pemohon ON sktr.ID_PEMOHON = m_pemohon.pemohon_id
					WHERE ID_SKTR IS NOT NULL 
					AND NO_SK IS NOT NULL
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 31:
				$sql = "
					SELECT 
						pemohon_nama, pemohon_alamat,
						TGL_PERMOHONAN AS permohonan_tanggal, 
						NO_SK AS permohonan_sk,
						TGL_BERLAKU AS permohonan_terbit,
						CONCAT(5 * (DATEDIFF(TGL_PERMOHONAN, TGL_BERLAKU) DIV 7) + 
							MID('0123444401233334012222340111123400001234000123450', 7 * WEEKDAY(TGL_PERMOHONAN) + WEEKDAY(TGL_BERLAKU) + 
								1, 1),' Hari') as lamaproses
						FROM iuiphhk 
						JOIN m_pemohon ON iuiphhk.ID_PEMOHON = m_pemohon.pemohon_id
					WHERE ID_IUIPHHK IS NOT NULL 
					AND NO_SK IS NOT NULL
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 32:
				$sql = "
					SELECT 
						pemohon_nama, pemohon_alamat,
						TGL_PERMOHONAN AS permohonan_tanggal, 
						NO_SK AS permohonan_sk,
						TGL_BERLAKU AS permohonan_terbit,
						CONCAT(5 * (DATEDIFF(TGL_PERMOHONAN, TGL_BERLAKU) DIV 7) + 
							MID('0123444401233334012222340111123400001234000123450', 7 * WEEKDAY(TGL_PERMOHONAN) + WEEKDAY(TGL_BERLAKU) + 
								1, 1),' Hari') as lamaproses
						FROM ijin_prinsip 
						JOIN m_pemohon ON ijin_prinsip.ID_PEMOHON = m_pemohon.pemohon_id
					WHERE ID_IJIN_PRINSIP IS NOT NULL 
					AND NO_SK IS NOT NULL
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 33:
				$sql = "
					SELECT 
						pemohon_nama, pemohon_alamat,
						TGL_PERMOHONAN AS permohonan_tanggal, 
						NO_SK AS permohonan_sk,
						TGL_BERLAKU AS permohonan_terbit,
						CONCAT(5 * (DATEDIFF(TGL_PERMOHONAN, TGL_BERLAKU) DIV 7) + 
							MID('0123444401233334012222340111123400001234000123450', 7 * WEEKDAY(TGL_PERMOHONAN) + WEEKDAY(TGL_BERLAKU) + 
								1, 1),' Hari') as lamaproses
						FROM trotoar 
						JOIN m_pemohon ON trotoar.ID_PEMOHON = m_pemohon.pemohon_id
					WHERE ID_TROTOAR IS NOT NULL 
					AND NO_SK IS NOT NULL
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 27:
				$sql = "
					SELECT 
						pemohon_nama, pemohon_alamat,
						det_simb_tanggal AS permohonan_tanggal, 
						det_simb_sk AS permohonan_sk,
						det_simb_berlaku AS permohonan_terbit,
						CONCAT(5 * (DATEDIFF(det_simb_tanggal, det_simb_berlaku) DIV 7) + 
							MID('0123444401233334012222340111123400001234000123450', 7 * WEEKDAY(det_simb_tanggal) + WEEKDAY(det_simb_berlaku) + 
								1, 1),' Hari') as lamaproses
						FROM t_simb_det 
						JOIN t_simb ON t_simb_det.det_simb_simb_id = t_simb.simb_id
						JOIN m_pemohon ON t_simb_det.det_simb_pemohon_id = m_pemohon.pemohon_id
					WHERE det_simb_id IS NOT NULL 
					AND det_simb_sk IS NOT NULL
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_simb_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_simb_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_simb_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
			case 26:
				$sql = "
					SELECT 
						pemohon_nama, pemohon_alamat,
						det_sipd_tanggal AS permohonan_tanggal, 
						det_sipd_sk AS permohonan_sk,
						det_sipd_berlaku AS permohonan_terbit,
						CONCAT(5 * (DATEDIFF(det_sipd_tanggal, det_sipd_berlaku) DIV 7) + 
							MID('0123444401233334012222340111123400001234000123450', 7 * WEEKDAY(det_sipd_tanggal) + WEEKDAY(det_sipd_berlaku) + 
								1, 1),' Hari') as lamaproses
						FROM t_sipd_det 
						JOIN t_sipd ON t_sipd_det.det_sipd_sipd_id = t_sipd.sipd_id
						JOIN m_pemohon ON t_sipd_det.det_sipd_pemohon_id = m_pemohon.pemohon_id
					WHERE det_sipd_id IS NOT NULL 
					AND det_sipd_sk IS NOT NULL
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_sipd_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_sipd_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_sipd_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
			break;
		}
		$result = $this->__listCore($sql, $params);
		return $result;
	}
	
	function getrecordsrekap($params){
		extract($params);
		$sql = "";
		switch($laporan_ijin){
			case 22:
				$sql = "
					SELECT
						induk.det_idam_tanggal AS permohonan_tanggal,
						(SELECT count(sub1.det_idam_id) FROM t_idam_det sub1 WHERE sub1.det_idam_tanggal = induk.det_idam_tanggal) AS jumlah_daftar,
						(SELECT count(sub1.det_idam_id) FROM t_idam_det sub1 WHERE sub1.det_idam_tanggal = induk.det_idam_tanggal AND sub1.det_idam_proses = '') AS jumlah_proses,
						(SELECT count(sub1.det_idam_id) FROM t_idam_det sub1 WHERE sub1.det_idam_tanggal = induk.det_idam_tanggal AND sub1.det_idam_proses = 'Selesai, belum diambil') AS jumlah_belum,
						(SELECT count(sub1.det_idam_id) FROM t_idam_det sub1 WHERE sub1.det_idam_tanggal = induk.det_idam_tanggal AND sub1.det_idam_proses = 'Selesai, sudah diambil') AS jumlah_diambil,
						(SELECT count(sub1.det_idam_id) FROM t_idam_det sub1 WHERE sub1.det_idam_tanggal = induk.det_idam_tanggal AND sub1.det_idam_proses = 'Ditolak') AS jumlah_ditolak
					FROM t_idam_det induk 
					WHERE det_idam_id IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_idam_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_idam_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_idam_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
				$sql .= " GROUP BY induk.det_idam_tanggal ";
			break;
			case 23:
				$sql = "
					SELECT
						induk.det_ipmbl_tanggal AS permohonan_tanggal,
						(SELECT count(sub1.det_ipmbl_id) FROM t_ipmbl_det sub1 WHERE sub1.det_ipmbl_tanggal = induk.det_ipmbl_tanggal) AS jumlah_daftar,
						(SELECT count(sub1.det_ipmbl_id) FROM t_ipmbl_det sub1 WHERE sub1.det_ipmbl_tanggal = induk.det_ipmbl_tanggal AND sub1.det_ipmbl_proses = '') AS jumlah_proses,
						(SELECT count(sub1.det_ipmbl_id) FROM t_ipmbl_det sub1 WHERE sub1.det_ipmbl_tanggal = induk.det_ipmbl_tanggal AND sub1.det_ipmbl_proses = 'Selesai, belum diambil') AS jumlah_belum,
						(SELECT count(sub1.det_ipmbl_id) FROM t_ipmbl_det sub1 WHERE sub1.det_ipmbl_tanggal = induk.det_ipmbl_tanggal AND sub1.det_ipmbl_proses = 'Selesai, sudah diambil') AS jumlah_diambil,
						(SELECT count(sub1.det_ipmbl_id) FROM t_ipmbl_det sub1 WHERE sub1.det_ipmbl_tanggal = induk.det_ipmbl_tanggal AND sub1.det_ipmbl_proses = 'Ditolak') AS jumlah_ditolak
					FROM t_ipmbl_det induk 
					WHERE det_ipmbl_id IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_ipmbl_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_ipmbl_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_ipmbl_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
				$sql .= " GROUP BY induk.det_ipmbl_tanggal ";
			break;
			case 24:
				$sql = "
					SELECT
						induk.det_iujt_tanggal AS permohonan_tanggal,
						(SELECT count(sub1.det_iujt_id) FROM t_iujt_det sub1 WHERE sub1.det_iujt_tanggal = induk.det_iujt_tanggal) AS jumlah_daftar,
						(SELECT count(sub1.det_iujt_id) FROM t_iujt_det sub1 WHERE sub1.det_iujt_tanggal = induk.det_iujt_tanggal AND sub1.det_iujt_proses = '') AS jumlah_proses,
						(SELECT count(sub1.det_iujt_id) FROM t_iujt_det sub1 WHERE sub1.det_iujt_tanggal = induk.det_iujt_tanggal AND sub1.det_iujt_proses = 'Selesai, belum diambil') AS jumlah_belum,
						(SELECT count(sub1.det_iujt_id) FROM t_iujt_det sub1 WHERE sub1.det_iujt_tanggal = induk.det_iujt_tanggal AND sub1.det_iujt_proses = 'Selesai, sudah diambil') AS jumlah_diambil,
						(SELECT count(sub1.det_iujt_id) FROM t_iujt_det sub1 WHERE sub1.det_iujt_tanggal = induk.det_iujt_tanggal AND sub1.det_iujt_proses = 'Ditolak') AS jumlah_ditolak
					FROM t_iujt_det induk 
					WHERE det_iujt_id IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_iujt_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_iujt_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_iujt_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
				$sql .= " GROUP BY induk.det_iujt_tanggal ";
			break;
			case 5:
				$sql = "
					SELECT
						induk.det_iujk_tanggal AS permohonan_tanggal,
						(SELECT count(sub1.det_iujk_id) FROM t_iujk_det sub1 WHERE sub1.det_iujk_tanggal = induk.det_iujk_tanggal) AS jumlah_daftar,
						(SELECT count(sub1.det_iujk_id) FROM t_iujk_det sub1 WHERE sub1.det_iujk_tanggal = induk.det_iujk_tanggal AND sub1.det_iujk_proses = '') AS jumlah_proses,
						(SELECT count(sub1.det_iujk_id) FROM t_iujk_det sub1 WHERE sub1.det_iujk_tanggal = induk.det_iujk_tanggal AND sub1.det_iujk_proses = 'Selesai, belum diambil') AS jumlah_belum,
						(SELECT count(sub1.det_iujk_id) FROM t_iujk_det sub1 WHERE sub1.det_iujk_tanggal = induk.det_iujk_tanggal AND sub1.det_iujk_proses = 'Selesai, sudah diambil') AS jumlah_diambil,
						(SELECT count(sub1.det_iujk_id) FROM t_iujk_det sub1 WHERE sub1.det_iujk_tanggal = induk.det_iujk_tanggal AND sub1.det_iujk_proses = 'Ditolak') AS jumlah_ditolak
					FROM t_iujk_det induk 
					WHERE det_iujk_id IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_iujk_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_iujk_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_iujk_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
				$sql .= " GROUP BY induk.det_iujk_tanggal ";
			break;
			case 25:
				$sql = "
					SELECT
						induk.det_apotek_tanggal AS permohonan_tanggal,
						(SELECT count(sub1.det_apotek_id) FROM t_apotek_det sub1 WHERE sub1.det_apotek_tanggal = induk.det_apotek_tanggal) AS jumlah_daftar,
						(SELECT count(sub1.det_apotek_id) FROM t_apotek_det sub1 WHERE sub1.det_apotek_tanggal = induk.det_apotek_tanggal AND sub1.det_apotek_proses = '') AS jumlah_proses,
						(SELECT count(sub1.det_apotek_id) FROM t_apotek_det sub1 WHERE sub1.det_apotek_tanggal = induk.det_apotek_tanggal AND sub1.det_apotek_proses = 'Selesai, belum diambil') AS jumlah_belum,
						(SELECT count(sub1.det_apotek_id) FROM t_apotek_det sub1 WHERE sub1.det_apotek_tanggal = induk.det_apotek_tanggal AND sub1.det_apotek_proses = 'Selesai, sudah diambil') AS jumlah_diambil,
						(SELECT count(sub1.det_apotek_id) FROM t_apotek_det sub1 WHERE sub1.det_apotek_tanggal = induk.det_apotek_tanggal AND sub1.det_apotek_proses = 'Ditolak') AS jumlah_ditolak
					FROM t_apotek_det induk 
					WHERE det_apotek_id IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_apotek_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_apotek_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_apotek_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
				$sql .= " GROUP BY induk.det_apotek_tanggal ";
			break;
			case 28:
				$sql = "
					SELECT
						induk.TGL_PERMOHONAN AS permohonan_tanggal,
						(SELECT count(sub1.ID_IJIN_LINGKUNGAN) FROM ijin_lingkungan sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN) AS jumlah_daftar,
						(SELECT count(sub1.ID_IJIN_LINGKUNGAN) FROM ijin_lingkungan sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = '') AS jumlah_proses,
						(SELECT count(sub1.ID_IJIN_LINGKUNGAN) FROM ijin_lingkungan sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Selesai, belum diambil') AS jumlah_belum,
						(SELECT count(sub1.ID_IJIN_LINGKUNGAN) FROM ijin_lingkungan sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Selesai, sudah diambil') AS jumlah_diambil,
						(SELECT count(sub1.ID_IJIN_LINGKUNGAN) FROM ijin_lingkungan sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Ditolak') AS jumlah_ditolak
					FROM ijin_lingkungan induk 
					WHERE ID_IJIN_LINGKUNGAN IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
				$sql .= " GROUP BY induk.TGL_PERMOHONAN ";
			break;
			case 29:
				$sql = "
					SELECT
						induk.TGL_PERMOHONAN AS permohonan_tanggal,
						(SELECT count(sub1.ID_SPPL) FROM sppl sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN) AS jumlah_daftar,
						(SELECT count(sub1.ID_SPPL) FROM sppl sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = '') AS jumlah_proses,
						(SELECT count(sub1.ID_SPPL) FROM sppl sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Selesai, belum diambil') AS jumlah_belum,
						(SELECT count(sub1.ID_SPPL) FROM sppl sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Selesai, sudah diambil') AS jumlah_diambil,
						(SELECT count(sub1.ID_SPPL) FROM sppl sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Ditolak') AS jumlah_ditolak
					FROM sppl induk 
					WHERE ID_SPPL IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
				$sql .= " GROUP BY induk.TGL_PERMOHONAN ";
			break;
			case 30:
				$sql = "
					SELECT
						induk.TGL_PERMOHONAN AS permohonan_tanggal,
						(SELECT count(sub1.ID_SKTR) FROM sktr sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN) AS jumlah_daftar,
						(SELECT count(sub1.ID_SKTR) FROM sktr sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = '') AS jumlah_proses,
						(SELECT count(sub1.ID_SKTR) FROM sktr sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Selesai, belum diambil') AS jumlah_belum,
						(SELECT count(sub1.ID_SKTR) FROM sktr sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Selesai, sudah diambil') AS jumlah_diambil,
						(SELECT count(sub1.ID_SKTR) FROM sktr sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Ditolak') AS jumlah_ditolak
					FROM sktr induk 
					WHERE ID_SKTR IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
				$sql .= " GROUP BY induk.TGL_PERMOHONAN ";
			break;
			case 31:
				$sql = "
					SELECT
						induk.TGL_PERMOHONAN AS permohonan_tanggal,
						(SELECT count(sub1.ID_IUIPHHK) FROM iuiphhk sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN) AS jumlah_daftar,
						(SELECT count(sub1.ID_IUIPHHK) FROM iuiphhk sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = '') AS jumlah_proses,
						(SELECT count(sub1.ID_IUIPHHK) FROM iuiphhk sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Selesai, belum diambil') AS jumlah_belum,
						(SELECT count(sub1.ID_IUIPHHK) FROM iuiphhk sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Selesai, sudah diambil') AS jumlah_diambil,
						(SELECT count(sub1.ID_IUIPHHK) FROM iuiphhk sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Ditolak') AS jumlah_ditolak
					FROM iuiphhk induk 
					WHERE ID_IUIPHHK IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
				$sql .= " GROUP BY induk.TGL_PERMOHONAN ";
			break;
			case 32:
				$sql = "
					SELECT
						induk.TGL_PERMOHONAN AS permohonan_tanggal,
						(SELECT count(sub1.ID_IJIN_PRINSIP) FROM ijin_prinsip sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN) AS jumlah_daftar,
						(SELECT count(sub1.ID_IJIN_PRINSIP) FROM ijin_prinsip sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = '') AS jumlah_proses,
						(SELECT count(sub1.ID_IJIN_PRINSIP) FROM ijin_prinsip sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Selesai, belum diambil') AS jumlah_belum,
						(SELECT count(sub1.ID_IJIN_PRINSIP) FROM ijin_prinsip sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Selesai, sudah diambil') AS jumlah_diambil,
						(SELECT count(sub1.ID_IJIN_PRINSIP) FROM ijin_prinsip sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Ditolak') AS jumlah_ditolak
					FROM ijin_prinsip induk 
					WHERE ID_IJIN_PRINSIP IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
				$sql .= " GROUP BY induk.TGL_PERMOHONAN ";
			break;
			case 33:
				$sql = "
					SELECT
						induk.TGL_PERMOHONAN AS permohonan_tanggal,
						(SELECT count(sub1.ID_TROTOAR) FROM trotoar sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN) AS jumlah_daftar,
						(SELECT count(sub1.ID_TROTOAR) FROM trotoar sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = '') AS jumlah_proses,
						(SELECT count(sub1.ID_TROTOAR) FROM trotoar sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Selesai, belum diambil') AS jumlah_belum,
						(SELECT count(sub1.ID_TROTOAR) FROM trotoar sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Selesai, sudah diambil') AS jumlah_diambil,
						(SELECT count(sub1.ID_TROTOAR) FROM trotoar sub1 WHERE sub1.TGL_PERMOHONAN = induk.TGL_PERMOHONAN AND sub1.STATUS = 'Ditolak') AS jumlah_ditolak
					FROM trotoar induk 
					WHERE ID_TROTOAR IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND TGL_PERMOHONAN <= '".$laporan_tanggalAkhir."' 
						AND TGL_PERMOHONAN >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(TGL_PERMOHONAN,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
				$sql .= " GROUP BY induk.TGL_PERMOHONAN ";
			break;
			case 27:
				$sql = "
					SELECT
						induk.det_simb_tanggal AS permohonan_tanggal,
						(SELECT count(sub1.det_simb_id) FROM t_simb_det sub1 WHERE sub1.det_simb_tanggal = induk.det_simb_tanggal) AS jumlah_daftar,
						(SELECT count(sub1.det_simb_id) FROM t_simb_det sub1 WHERE sub1.det_simb_tanggal = induk.det_simb_tanggal AND sub1.det_simb_proses = '') AS jumlah_proses,
						(SELECT count(sub1.det_simb_id) FROM t_simb_det sub1 WHERE sub1.det_simb_tanggal = induk.det_simb_tanggal AND sub1.det_simb_proses = 'Selesai, belum diambil') AS jumlah_belum,
						(SELECT count(sub1.det_simb_id) FROM t_simb_det sub1 WHERE sub1.det_simb_tanggal = induk.det_simb_tanggal AND sub1.det_simb_proses = 'Selesai, sudah diambil') AS jumlah_diambil,
						(SELECT count(sub1.det_simb_id) FROM t_simb_det sub1 WHERE sub1.det_simb_tanggal = induk.det_simb_tanggal AND sub1.det_simb_proses = 'Ditolak') AS jumlah_ditolak
					FROM t_simb_det induk 
					WHERE det_simb_id IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_simb_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_simb_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_simb_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
				$sql .= " GROUP BY induk.det_simb_tanggal ";
			break;
			case 26:
				$sql = "
					SELECT
						induk.det_sipd_tanggal AS permohonan_tanggal,
						(SELECT count(sub1.det_sipd_id) FROM t_sipd_det sub1 WHERE sub1.det_sipd_tanggal = induk.det_sipd_tanggal) AS jumlah_daftar,
						(SELECT count(sub1.det_sipd_id) FROM t_sipd_det sub1 WHERE sub1.det_sipd_tanggal = induk.det_sipd_tanggal AND sub1.det_sipd_proses = '') AS jumlah_proses,
						(SELECT count(sub1.det_sipd_id) FROM t_sipd_det sub1 WHERE sub1.det_sipd_tanggal = induk.det_sipd_tanggal AND sub1.det_sipd_proses = 'Selesai, belum diambil') AS jumlah_belum,
						(SELECT count(sub1.det_sipd_id) FROM t_sipd_det sub1 WHERE sub1.det_sipd_tanggal = induk.det_sipd_tanggal AND sub1.det_sipd_proses = 'Selesai, sudah diambil') AS jumlah_diambil,
						(SELECT count(sub1.det_sipd_id) FROM t_sipd_det sub1 WHERE sub1.det_sipd_tanggal = induk.det_sipd_tanggal AND sub1.det_sipd_proses = 'Ditolak') AS jumlah_ditolak
					FROM t_sipd_det induk 
					WHERE det_sipd_id IS NOT NULL 
				";
				if($laporan_opsi == 'tanggal'){
					$sql .= " AND det_sipd_tanggal <= '".$laporan_tanggalAkhir."' 
						AND det_sipd_tanggal >= '".$laporan_tanggalAwal."' 
					";
				}else{
					$sql .= " AND DATE_FORMAT(det_sipd_tanggal,'%Y-%m') = '".$laporan_tahun.'-'.$laporan_bulan."' ";
				}
				$sql .= " GROUP BY induk.det_sipd_tanggal ";
			break;
		}
		$result[] = 0;
		$result[] = $this->db->query($sql)->result();
		
		return $result;
	}
	
}
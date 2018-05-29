<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title></title>
	<style type="text/css">
		.page-break {
		    page-break-after: always;
		}
		.header_logo {
			height: 100px; padding: 5px; float: left;
		}
		.header_logo img {
			height: 100px
		}
		.header_title {
			float: right; padding: 5px; width: 87%; margin-top: 12px;
		}
		p.header_text {
			font-size: 12px;
			font-weight: bold;
			margin: 2px;
		}
		.container_table {
			width: 100%; height: auto; display: inline-table; float: left;
		}
		.table {
			width: 100%;
		}
		.table th,td {
			padding: 5px;
		}
		.table_header {
			width: 80%;
		}
		p.title_pages {
			text-align: center;
			font-weight: bold; font-size: 18px;margin-bottom: 25px;border-bottom: 1px #000 solid;padding-bottom: 15px;
		}
		.container_table_header {
			margin-bottom: 10px; 
		}
		.footer {
			width: 100%;height: auto;display: inline-table; float: left;
		}
		.footer_wrapper_left {
			width: 25%; float: left; margin:10px; padding:5px; font-weight: bold; font-size:12px;
		}
		.footer_wrapper_right {
			width: 25%; float: right; margin:10px; padding:5px; font-weight: bold; font-size:12px;
		}
		span.text_name {
			border-bottom: 1px #000 solid; padding-bottom: 10px;
		}
	</style>
</head>
<body>
	<div style="width: 100%; height: 100px; float: left; border-bottom: 1px #000 solid">
		<div class="header_logo">
			<img src="{{ asset('themes/images/logo.png') }}">
		</div>
		<div class="header_title">
			<p class="header_text">LABORATORIUM KARANTINA PERTANIAN KELAS I BALIKPAPAN</p>
			<p class="header_text">BALAI KARANTINA KELAS I BALIKPAPAN</p>
			<p class="header_text">JL. Bridgend A.W. Syahrani No.37 RT. 48 Balikpapan</p>
			<p class="header_text">Telp : 0542-418994, Fax : 0542-418994, Email : bkpbpn@gmail.com</p>
		</div>
	</div>
	<p class="title_pages">TANDA TERIMA DISTRIBUSI SAMPLE KARANTINA HEWAN</p>
	<table class="table_header" cellpadding="1" cellspacing="0" style="margin-bottom: 10px;">
		<tbody>
		<tr>
			<td><b>Tanggal</b></td><td>: {{ $tanggal }}</td><td>Jenis Sample</td><td>
		</tr>
		<tr>
			<td><b>Kode Sample</b></td><td>: {{ isset($kode_sample) ? $kode_sample : '' }}</td>
			<td><b>Jumlah Sample</b></td><td>: {{ isset($jml_vol) ? $jml_vol : '' }} ({{ isset($satuan_sample) ? $satuan_sample : '' }})</td>
		</tr>
		<tr>
			<td>Media Pembawa</td><td></td>
			<td><b>Laboratorium</b></td>
			<td>: {{ isset($laboratorium) ? $laboratorium : '' }}</td>
			
		</tr>
		</tbody>
	</table>
	<table class="table" border="1" cellpadding="1" cellspacing="0">
		
		<tbody>

			<tr>
				<th style="text-align: center;">Target Pengujian</th>
				<th style="text-align: center;">Metode Pengujian</th>
			</tr>
			<tr>
				<td style="text-align: center;">{{ isset($target_pengujian) ? $target_pengujian : '' }}</td>
				<td style="text-align: center;">{{ isset($metode_pengujian) ? $metode_pengujian : '' }}</td>

			</tr>
		</tbody>
	</table>
	<div class="footer">
		<div class="footer_wrapper_left">
			<p>Yang Menerima</p>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<p>NIP: {{ isset($nip_dokter) ? $nip_dokter : '' }}</p>
		</div>
		<div class="footer_wrapper_right">
			<p>Yang Menyerahkan</p>
			<p>Manager Teknis</p>
			<br/>
			<br/>
			<br/>
			<br/>
			<p>NIP: {{ isset($nama_dokter) ? $nama_dokter : '' }}</p>
		</div>
	</div>
</body>
</html>

<div id="app">
	<div class="bg__gray">
		<div class="page-title">
			<div class="title_left">
		        <h3>PERMOHONAN </h3>
		        <p>CMS MANAGEMENT SYSTEM</p>
		    </div>
		</div>
	</div>
    <div class="col-md-12 col-sm-12 col-xs-12">
    	<!-- Include form -->
    	@include('pages.karantina-hewan.partials.form')
    	<!-- / End include form -->
		<div class="main__content__layer">
			<div class="content__top flex-between">
				<div class="content__title">
					<h2>@{{ form_add_title }}</h2>
				</div>
				<div class="content__btn">
					<a href="#" class="btn__add" id="toggle-form">Add Permohonan</a>
		       	</div>
		    </div>
		    <div class="content__bottom">
		    	<table class="table">
		    		<thead>
		    			<tr>
			    			<th>#</th>
			    			<th>Nomer Permohonan</th>
			    			<th>Tanggal</th>
			    			<th>Kodefikasi Sample</th>
			    			<th>Asal Kegiatan</th>
			    			<th>Pengirim</th>
			    			<th>Tgl. Terima</th>
			    			<th>NIP Petugas</th>
			    			<th>Status</th>
			    			<th>Option</th>
			    			<th>Update</th>
			    		</tr>
		    		</thead>

		    		<tbody>
		    			<tr v-for="(list_permohonan, index) in list_permohonan">
		    				<td>@{{ index+1 }}</td>
		    				<td>@{{ list_permohonan.no_permohonan }}</td>
		    				<td>@{{ list_permohonan.tgl_permohonan }}</td>
		    				<td>@{{ list_permohonan.kodefikasi_sample }}</td>
		    				<td>@{{ list_permohonan.kegiatan }}</td>
		    				<td>@{{ list_permohonan.nama_pengantar }}</td>
		    				<td>@{{ list_permohonan.tgl_terima_sample }}</td>
		    				<td>@{{ list_permohonan.nip_petugas_penerima }}</td>
		    				<td v-if="list_permohonan.status == 0">Ditolak</td>
		    				<td v-if="list_permohonan.status == 1">Menunggu Konfirmasi</td>
		    				<td v-if="list_permohonan.status == 2">Telah Disetujui</td>
		    				<td>
		    					<a class="" :href="'{{ route('cms_karantina_hewan_print_terima_sample','id=') }}'+list_permohonan.id" >Cetak Tanda Terima Sample</a>
		    				</td>
		    				<td>
		    					<a v-if="list_permohonan.status == 1" href="#" @click="editData(list_permohonan.id)">Update Data</a>
		    				</td>
		    			</tr>
		    		</tbody>
		    	</table>
			</div>
		</div>

    </div>
</div>

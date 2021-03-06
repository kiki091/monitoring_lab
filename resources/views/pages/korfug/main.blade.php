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
    	@include('pages.korfug.partials.form')
    	<!-- / End include form -->
		<div class="main__content__layer">
			<div class="content__top flex-between">
				<div class="content__title">
					<h2>@{{ form_add_title }}</h2>
				</div>
				<div class="content__btn">
		       	</div>
		    </div>
		    <div class="content__bottom">
		    	<table class="table">
		    		<thead>
		    			<tr>
			    			<th>#</th>
			    			<th>Nomer</th>
			    			<th>Tanggal</th>
			    			<th>Kodefikasi</th>
			    			<th>Kategori Uji</th>
			    			<th>Asal Kegiatan</th>
			    			<th>Pengirim</th>
			    			<th>Tgl. Terima</th>
			    			<th>NIP Petugas</th>
			    			<th>Verifikasi</th>
			    		</tr>
		    		</thead>

		    		<tbody>
		    			<tr v-for="(obj, index) in data">
		    				<td>@{{ index+1 }}</td>
		    				<td>@{{ obj.no_permohonan }}</td>
		    				<td>@{{ obj.tgl_permohonan }}</td>
		    				<td>@{{ obj.kodefikasi_sample }}</td>
		    				<td>@{{ obj.kategori }}</td>
		    				<td>@{{ obj.kegiatan }}</td>
		    				<td>@{{ obj.nama_pengantar }}</td>
		    				<td>@{{ obj.tgl_terima_sample }}</td>
		    				<td>@{{ obj.nip_petugas_penerima }}</td>
		    				<td>
		    					<a href="#" class="btn__form" @click="showData(obj.id)">Korfug</a>
		    				</td>
		    			</tr>
		    		</tbody>
		    	</table>
			</div>
		</div>

    </div>
</div>

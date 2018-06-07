<div id="app">
	<div class="bg__gray">
		<div class="page-title">
			<div class="title_left">
		        <h3>@{{ form_add_title }} </h3>
		        <p>CMS MANAGEMENT SYSTEM</p>
		    </div>
		</div>
	</div>
    <div class="col-md-12 col-sm-12 col-xs-12">
    	<!-- Include form -->
    	@include('pages.monitoring.sample.partials.form')
    	<!-- / End include form -->
		<div class="main__content__layer">
			<div class="content__top flex-between">
				<div class="content__title">
					<h2>@{{ form_add_title }}</h2>
				</div>
				<div class="content__btn">
					<a href="#" class="btn__add" id="toggle-form">Add Data</a>
		       	</div>
		    </div>
		    <div class="content__bottom">
		    	<table class="table">
		    		<thead>
		    			<tr>
			    			<th>#</th>
			    			<th>Kode Sample</th>
			    			<th>Nama Sample</th>
			    			<th>Jenis Sample</th>
			    			<th>Nama Komoditas</th>
			    			<th>Jumlah Vol</th>
			    			<th>Satuan</th>
			    			<th>Tanggal Pengambilan</th>
			    			<th>Metode Pengambilan</th>
			    			<th>Kondisi Sample</th>
			    			<th>Target Pengujian</th>
			    			<th>Nama Customer / Pemilik</th>
			    			<th>Option</th>
			    		</tr>
		    		</thead>

		    		<tbody>
		    			<tr v-for="(obj, index) in data">
		    				<td>@{{ index+1 }}</td>
		    				<td>@{{ obj.kode_sample }}</td>
		    				<td>@{{ obj.nama_sample }}</td>
		    				<td>@{{ obj.jenis_sample }}</td>
		    				<td>@{{ obj.nama_komoditas }}</td>
		    				<td>@{{ obj.jml_vol }}</td>
		    				<td>@{{ obj.satuan }}</td>
		    				<td>@{{ obj.tgl_pengambilan_sample }}</td>
		    				<td>@{{ obj.metode_pengambilan_sample }}</td>
		    				<td>
		    					<template v-if="obj.kondisi_sample == 1">
		    						Baik
		    					</template>
		    					<template v-if="obj.kondisi_sample == 0">
		    						Buruk
		    					</template>
		    				</td>
		    				<td>@{{ obj.target_pengujian }}</td>
		    				<td>@{{ obj.nama_customer }}</td>
		    				<td>
		    					<a href="#" @click="editData(obj.id)">Edit</a>
		    				</td>
		    			</tr>
		    		</tbody>
		    	</table>
			</div>
		</div>

    </div>
</div>

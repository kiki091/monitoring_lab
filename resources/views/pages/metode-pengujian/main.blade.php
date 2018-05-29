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
    	@include('pages.metode-pengujian.partials.form')
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
			    			<th>Metode Pengujian</th>
			    			<th>Target Pengujian</th>
			    			<th>Kelompok Pengujian</th>
			    			<th>Nama Laboratorium</th>
			    			<th>Option</th>
			    		</tr>
		    		</thead>

		    		<tbody>
		    			<tr v-for="(obj, index) in data">
		    				<td>@{{ index+1 }}</td>
		    				<td>@{{ obj.nama_kelompok }}</td>
		    				<td>@{{ obj.target_pengujian }}</td>
		    				<td>@{{ obj.kelompok_pengujian }}</td>
		    				<td>@{{ obj.laboratorium }}</td>
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

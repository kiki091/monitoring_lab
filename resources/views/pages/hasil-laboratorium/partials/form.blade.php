<form action="{{ route('cms_hasil_laboratorium_store') }}" method="POST" id="form__hasil_laboratorium" enctype="multipart/form-data" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-content" style="display: none; margin-top: 5%;">
		<div class="create__form__wrapper">
			<div class="form--top flex-between">
				<div class="form__title"><h2>@{{ form_add_title }}</h2></div>
				<div class="form--top__btn">
					<a href="#" class="btn__add__cancel" @click="resetForm">Cancel</a>
				</div>
			</div>
			<div class="form--mid">
				<div class="create__form content__tab active__content">
					<div class="form__group__row">
						<div id="form-accordion">
							<div class="create__form__row">
								<span class="form__group__title">General Information<a href="javascript:void(0);" class="style__accordion" data-accordion="form-accordion-1"><i>@include('svg-logo.ico-expand-arrow')</i></a></span>
							</div>
							<div id="form-accordion-1" style="display: block;">
								<div class="create__form__row">

									<div class="new__form__field">
										<label>Daftar Permohonan</label>
										<select class="chosen-sample form-control" v-model="permohonan_selector" name="karantina_tumbuhan_id" id="karantina_tumbuhan_id">
											<option v-for="permohonan in list_permohonan" :value="permohonan.id">
												@{{ permohonan.no_permohonan }}
											</option>
										</select>
										<div class="form--error--message--left" id="form--error--message--karantina_tumbuhan_id"></div>
									</div>
								</div>

								<div class="create__form__row">
									<table class="table">
										<thead>
							    			<th>Laboratorium</th>
							    			<th>Kode Sample</th>
							    			<th>Nama Sample</th>
							    			<th>Tgl Terima Lab</th>
							    			<th>Tgl Pengujian</th>
							    			<th>Target Uji</th>
							    			<th>Metode Pengujian</th>
										</thead>
										<tbody>
											<tr>
												<td>@{{ detail.laboratorium }}</td>
												<td>@{{ detail.kode_sample }}</td>
												<td>@{{ detail.nama_sample }}</td>
												<td>@{{ detail.tgl_terima_sample }}</td>
												<td>@{{ detail.tgl_permohonan }}</td>
												<td>@{{ detail.target_pengujian }}</td>
												<td>@{{ detail.metode_pengujian }}</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="create__form__row">


									<div class="new__form__field">
										<label>Hasil</label>
										<input type="text" name="hasil" class="form-control" v-model="models.hasil" id="hasil">
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Kesimpulan</label>
										<ul class="to_do">
											<li>
												<div class="radio icheck-primary">
	    											<input class="checkbox__data" type="radio" v-model="models.kesimpulan" name="kesimpulan" id="kesimpulan_1" value="Negatif" />
												    <label for="kesimpulan_1">
												    	Negatif (-)
												    </label>
												</div>
											</li>
											<li>
												<div class="radio icheck-primary">
	    											<input class="checkbox__data" type="radio" v-model="models.kesimpulan" name="kesimpulan" id="kesimpulan_2"  value="Positif"/>
												    <label for="kesimpulan_2">
												    	Positif (+)
												    </label>
												</div>
											</li>
											<li>
												<div class="radio icheck-primary">
	    											<input class="checkbox__data" type="radio" v-model="models.kesimpulan" name="kesimpulan" id="kesimpulan_3"  value="Dubius"/>
												    <label for="kesimpulan_3">
												    	Dubius
												    </label>
												</div>
											</li>
										</ul>
										
										<div class="form--error--message--left" id="form--error--message--kesimpulan"></div>
									</div>
								</div>
								
								<div class="create__form__row">

									<div class="new__form__field">
										<label>Keterangan</label>
										<textarea name="keterangan" class="form-control" v-model="models.keterangan" id="keterangan"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="form--bot">
				<div class="create__form">
					<div class="create__form__row flex-between">
						<div></div>
						<div class="new__form__btn">
							<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
							<input v-model="models.id" v-if="edit == true" type="hidden" name="id">
							<button class="btn__form" type="submit" @click="storeData">Save</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>
